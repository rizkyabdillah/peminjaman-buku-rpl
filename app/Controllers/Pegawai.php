<?php

namespace App\Controllers;

class Pegawai extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    //--------------------------------------------------------------------

    private function array_default()
    {
        return array(
            'header_title' => 'Data Pegawai',
            'badges' => 'Pages Data Pegawai',
            'sidebar' => 8,
            'link_breadcrumb' => route_to('view_pegawai')
        );
    }

    //--------------------------------------------------------------------

    public function index()
    {

        $query = $this->query->query_user_filter_pegawai_all();
        $dataset = $this->model->queryArray($query);
        $components = array(
            'is_show_badge3' => false,
            'link_add' => route_to('view_add_pegawai'),
            'desc_badges' => 'Berikut adalah daftar semua data pegawai yang terdaftar',
            'dataset' => $dataset
        );

        return view('admin/pages/layouts/pegawai', array_merge($this->array_default(), $components));
    }

    //--------------------------------------------------------------------

    public function add()
    {

        $components = array(
            'is_show_badge3' => true,
            'badge_3' => 'Tambah Pegawai',
            'link_back' => route_to('view_pegawai'),
            'desc_badges' => 'Tambahkan data pegawai pada form dibawah ini',
            'text_header_form' => 'Tambah Pegawai',
            'valid' => $this->validation,
        );

        return view('admin/pages/adds/add-pegawai', array_merge($this->array_default(), $components));
    }

    //--------------------------------------------------------------------

    public function save()
    {
        if (!$this->validate([
            'nama_pegawai' => [
                'label' => 'Nama pegawai',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ], 'no_telp' => [
                'label' => 'Nomor telepon',
                'rules' => 'required|numeric|max_length[13]|min_length[3]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'numeric' => '{field} harus berupa angka',
                    'max_length' => '{field} tidak boleh lebih dari 13 angka',
                    'min_length' => '{field} tidak boleh kurang dari 3',
                ]
            ], 'username' => [
                'label' => 'Username',
                'rules' => 'required|is_unique[USER.username]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah tersedia',
                ]
            ], 'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ], 're_password' => [
                'label' => 'Ulangi password',
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'matches' => 'Password tidak sama',
                ]
            ], 'alamat' => [
                'label' => 'Alamat',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        };

        /* Set random 8 character for id pegawai */
        $id_random = $this->utility->get_random(8);

        /* ======= Saving data ======= */

        // Save field column value to array
        $data = array(
            'id_pegawai' => $id_random,
            'nama_pegawai' => ucfirst($this->request->getPost('nama_pegawai')),
            'nomor_telpon' => $this->request->getPost('no_telp'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'alamat' => $this->request->getPost('alamat')
        );

        // Save data to pegawai table
        $this->model->insertData('PEGAWAI', $data);

        // Save field column value to array
        $data = array(
            'id_user' => $id_random,
            'username' => strtolower($this->request->getPost('username')),
            'password' => $this->utility->get_bcrypt($this->request->getPost('password')),
            'level' => 'pegawai',
        );

        // Save data to user table
        $this->model->insertData('USER', $data);

        /* ======= Show message and redirect back to index pegawai ======= */
        // Set message where data successful inserted
        session()->setFlashData('pesan', 'Data pegawai berhasil disimpan');
        // Redirected back to index pegawai
        return redirect()->to(route_to('view_pegawai'));
    }

    //--------------------------------------------------------------------

    public function delete($id)
    {
        /* ======= Deleting data from table pegawai where id = $id ======= */
        $this->model->deleteData('PEGAWAI', array('id_pegawai' => $id));
        /* ======= Deleting data from table user where id = $id ======= */
        $this->model->deleteData('USER', array('id_user' => $id));

        /* ======= Show message and redirect back to index pegawai ======= */
        // Set message where data successful deleted
        session()->setFlashData('pesan', 'Data pegawai berhasil dihapus');
        // Redirected back to index pegawai
        return redirect()->to(route_to('view_pegawai'));
    }

    //--------------------------------------------------------------------

    public function edit($id)
    {

        $query = $this->query->query_user_filter_pegawai_where($id);
        $dataset = $this->model->queryRowArray($query);

        $components = array(
            'is_show_badge3' => true,
            'badge_3' => 'Ubah Pegawai',
            'link_back' => route_to('view_pegawai'),
            'desc_badges' => 'Ubah data pegawai pada form dibawah ini',
            'text_header_form' => 'Ubah Pegawai',
            'valid' => $this->validation,
            'dataset' => $dataset,
        );

        return view('admin/pages/edits/edit-pegawai', array_merge($this->array_default(), $components));
    }

    //--------------------------------------------------------------------


    public function update($id)
    {
        if (!$this->validate([
            'nama_pegawai' => [
                'label' => 'Nama pegawai',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ], 'no_telp' => [
                'label' => 'Nomor telepon',
                'rules' => 'required|numeric|max_length[13]|min_length[3]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'numeric' => '{field} harus berupa angka',
                    'max_length' => '{field} tidak boleh lebih dari 13 angka',
                    'min_length' => '{field} tidak boleh kurang dari 3',
                ]
            ], 'username' => [
                'label' => 'Username',
                'rules' => 'required', //is_unique[USER.username,id_user,' . $id . ']',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    // 'is_unique' => '{field} sudah tersedia',
                ]
            ], 'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ]
            ], 're_password' => [
                'label' => 'Ulangi password',
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'matches' => 'Password tidak sama',
                ]
            ], 'alamat' => [
                'label' => 'Alamat',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        };

        /* ======= Saving data ======= */

        // Save field column value to array
        $data = array(
            'nama_pegawai' => ucfirst($this->request->getPost('nama_pegawai')),
            'nomor_telpon' => $this->request->getPost('no_telp'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'alamat' => $this->request->getPost('alamat')
        );

        // Update data to pegawai table
        $this->model->updateData('PEGAWAI', 'id_pegawai', $id, $data);

        // Save field column value to array
        $data = array(
            'username' => strtolower($this->request->getPost('username')),
            'password' => $this->utility->get_bcrypt($this->request->getPost('password')),
        );

        // Update data to user table
        $this->model->updateData('USER', 'id_user', $id, $data);

        /* ======= Show message and redirect back to index pegawai ======= */
        // Set message where data successful inserted
        session()->setFlashData('pesan', 'Data pegawai berhasil diubah');
        // Redirected back to index pegawai
        return redirect()->to(route_to('view_pegawai'));
    }


    //--------------------------------------------------------------------





}
