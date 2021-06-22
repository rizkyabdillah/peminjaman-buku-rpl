<?php

namespace App\Controllers;

class Anggota extends BaseController
{


    public function __construct()
    {
        parent::__construct();
    }

    //--------------------------------------------------------------------

    private function array_default()
    {
        return array(
            'header_title' => 'Data Anggota',
            'badges' => 'Pages Data Anggota',
            'sidebar' => 7,
            'link_breadcrumb' => route_to('view_anggota')
        );
    }

    //--------------------------------------------------------------------

    public function index()
    {
        $dataset = $this->model->getAllDataArray('ANGGOTA');
        $components = array(
            'is_show_badge3' => false,
            'link_add' => route_to('view_add_anggota'),
            'desc_badges' => 'Berikut adalah daftar semua data anggota yang terdaftar',
            'dataset' => $dataset
        );

        return view('admin/pages/layouts/anggota', array_merge($this->array_default(), $components));
    }

    //--------------------------------------------------------------------

    public function add()
    {

        $components = array(
            'is_show_badge3' => true,
            'badge_3' => 'Tambah Anggota',
            'link_back' => route_to('view_anggota'),
            'desc_badges' => 'Tambahkan data anggota pada form dibawah ini',
            'text_header_form' => 'Tambah Anggota',
            'valid' => $this->validation,
        );

        return view('admin/pages/adds/add-anggota', array_merge($this->array_default(), $components));
    }

    //--------------------------------------------------------------------

    public function save()
    {
        if (!$this->validate([
            'nama_anggota' => [
                'label' => 'Nama anggota',
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

        /* Set random 8 character for id anggota */
        $id_random = $this->utility->get_random(8);

        /* ======= Saving data ======= */

        // Save field column value to array
        $data = array(
            'id_anggota' => $id_random,
            'nama_anggota' => ucfirst($this->request->getPost('nama_anggota')),
            'nomor_telpon' => $this->request->getPost('no_telp'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'tanggal_bergabung' => $this->request->getPost('tanggal_gabung') . ' ' . date("h:i:s"),
            'alamat' => $this->request->getPost('alamat')
        );

        // Save data to anggota table
        $this->model->insertData('anggota', $data);

        /* ======= Show message and redirect back to index anggota ======= */
        // Set message where data successful inserted
        session()->setFlashData('pesan', 'Data anggota berhasil disimpan');
        // Redirected back to index anggota
        return redirect()->to(route_to('view_anggota'));
    }

    //--------------------------------------------------------------------

    public function delete($id)
    {
        /* ======= Deleting data from table anggota where id = $id ======= */
        $this->model->deleteData('anggota', array('id_anggota' => $id));

        /* ======= Show message and redirect back to index anggota ======= */
        // Set message where data successful deleted
        session()->setFlashData('pesan', 'Data anggota berhasil dihapus');
        // Redirected back to index anggota
        return redirect()->to(route_to('view_anggota'));
    }

    //--------------------------------------------------------------------

    public function edit($id)
    {

        // $query = $this->query->query_anggota_show_where($id);
        // $dataset = $this->model->queryRowArray($query);
        $dataset = $this->model->getDataWhereArray('ANGGOTA', ['id_anggota' => $id]);

        $components = array(
            'is_show_badge3' => true,
            'badge_3' => 'Ubah Anggota',
            'link_back' => route_to('view_anggota'),
            'desc_badges' => 'Ubah data anggota pada form dibawah ini',
            'text_header_form' => 'Ubah anggota',
            'valid' => $this->validation,
            'dataset' => $dataset[0],
        );

        return view('admin/pages/edits/edit-anggota', array_merge($this->array_default(), $components));
    }

    //--------------------------------------------------------------------


    public function update($id)
    {
        if (!$this->validate([
            'nama_anggota' => [
                'label' => 'Nama anggota',
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
            'nama_anggota' => ucfirst($this->request->getPost('nama_anggota')),
            'nomor_telpon' => $this->request->getPost('no_telp'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'tanggal_bergabung' => $this->request->getPost('tanggal_gabung') . ' ' . date("h:i:s"),
            'alamat' => $this->request->getPost('alamat')
        );

        // Update data to anggota table
        $this->model->updateData('anggota', 'id_anggota', $id, $data);

        /* ======= Show message and redirect back to index anggota ======= */
        // Set message where data successful inserted
        session()->setFlashData('pesan', 'Data anggota berhasil diubah');
        // Redirected back to index anggota
        return redirect()->to(route_to('view_anggota'));
    }


    //--------------------------------------------------------------------





}
