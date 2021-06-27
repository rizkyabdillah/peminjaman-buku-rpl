<?php

namespace App\Controllers;

class Penerbit extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    //--------------------------------------------------------------------

    private function array_default()
    {
        return array(
            'header_title' => 'Data Penerbit',
            'badges' => 'Pages Data Penerbit',
            'sidebar' => 5,
            'link_breadcrumb' => route_to('view_penerbit')
        );
    }

    //--------------------------------------------------------------------

    public function index()
    {
        $dataset = $this->model->getAllDataArray('PENERBIT');
        $components = array(
            'is_show_badge3' => false,
            'link_add' => route_to('view_add_penerbit'),
            'desc_badges' => 'Berikut adalah daftar semua data penerbit yang terdaftar',
            'dataset' => $dataset
        );

        return view('admin/pages/layouts/penerbit', array_merge($this->array_default(), $components));
    }

    //--------------------------------------------------------------------

    public function add()
    {

        $components = array(
            'is_show_badge3' => true,
            'badge_3' => 'Tambah Penerbit',
            'link_back' => route_to('view_penerbit'),
            'desc_badges' => 'Tambahkan data penerbit pada form dibawah ini',
            'text_header_form' => 'Tambah Penerbit',
            'valid' => $this->validation,
        );

        return view('admin/pages/adds/add-penerbit', array_merge($this->array_default(), $components));
    }

    //--------------------------------------------------------------------

    public function save()
    {
        if (!$this->validate([
            'nama_penerbit' => [
                'label' => 'Nama penerbit',
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

        /* Set random 5 character for id penerbit */
        $id_random = $this->utility->get_random(5);

        /* ======= Saving data ======= */

        // Save field column value to array
        $data = array(
            'id_penerbit' => $id_random,
            'nama_penerbit' => strtoupper($this->request->getPost('nama_penerbit')),
            'telp_penerbit' => $this->request->getPost('no_telp'),
            'alamat_penerbit' => $this->request->getPost('alamat')
        );

        // Save data to penerbit table
        $this->model->insertData('PENERBIT', $data);

        /* ======= Show message and redirect back to index penerbit ======= */
        // Set message where data successful inserted
        session()->setFlashData('pesan', 'Data penerbit berhasil disimpan');
        // Redirected back to index pegpenerbitawai
        return redirect()->to(route_to('view_penerbit'));
    }

    //--------------------------------------------------------------------

    public function delete($id)
    {
        /* ======= Deleting data from table penerbit where id = $id ======= */
        $this->model->deleteData('PENERBIT', array('id_penerbit' => $id));

        /* ======= Show message and redirect back to index penerbit ======= */
        // Set message where data successful deleted
        session()->setFlashData('pesan', 'Data penerbit berhasil dihapus');
        // Redirected back to index penerbit
        return redirect()->to(route_to('view_penerbit'));
    }

    //--------------------------------------------------------------------

    public function edit($id)
    {
        $dataset = $this->model->getDataWhereArray('PENERBIT', ['id_penerbit' => $id]);
        $components = array(
            'is_show_badge3' => true,
            'badge_3' => 'Ubah Penerbit',
            'link_back' => route_to('view_penerbit'),
            'desc_badges' => 'Ubah data penerbit pada form dibawah ini',
            'text_header_form' => 'Ubah penerbit',
            'valid' => $this->validation,
            'dataset' => $dataset[0],
        );

        return view('admin/pages/edits/edit-penerbit', array_merge($this->array_default(), $components));
    }

    //--------------------------------------------------------------------


    public function update($id)
    {
        if (!$this->validate([
            'nama_penerbit' => [
                'label' => 'Nama penerbit',
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
            'nama_penerbit' => strtoupper($this->request->getPost('nama_penerbit')),
            'telp_penerbit' => $this->request->getPost('no_telp'),
            'alamat_penerbit' => $this->request->getPost('alamat')
        );

        // Update data to penerbit table
        $this->model->updateData('PENERBIT', 'id_penerbit', $id, $data);

        /* ======= Show message and redirect back to index penerbit ======= */
        // Set message where data successful inserted
        session()->setFlashData('pesan', 'Data penerbit berhasil diubah');
        // Redirected back to index penerbit
        return redirect()->to(route_to('view_penerbit'));
    }


    //--------------------------------------------------------------------





}
