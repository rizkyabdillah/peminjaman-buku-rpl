<?php

namespace App\Controllers;

class Rakbuku extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    //--------------------------------------------------------------------

    private function array_default()
    {
        return array(
            'header_title' => 'Data Rak Buku',
            'badges' => 'Pages Data Rak Buku',
            'sidebar' => 4,
            'link_breadcrumb' => route_to('view_rakbuku')
        );
    }

    //--------------------------------------------------------------------

    public function index()
    {

        $query = $this->query->query_rakbuku_show_all();
        $dataset = $this->model->queryArray($query);
        $components = array(
            'is_show_badge3' => false,
            'link_add' => route_to('view_add_rakbuku'),
            'desc_badges' => 'Berikut adalah daftar semua data rak buku yang terdaftar',
            'dataset' => $dataset
        );

        return view('admin/pages/layouts/rakbuku', array_merge($this->array_default(), $components));
    }

    //--------------------------------------------------------------------

    public function add()
    {

        $components = array(
            'is_show_badge3' => true,
            'badge_3' => 'Tambah Rak Buku',
            'link_back' => route_to('view_rakbuku'),
            'desc_badges' => 'Tambahkan data rak buku pada form dibawah ini',
            'text_header_form' => 'Tambah Rak Buku',
            'valid' => $this->validation,
        );

        return view('admin/pages/adds/add-rakbuku', array_merge($this->array_default(), $components));
    }

    //--------------------------------------------------------------------

    public function save()
    {
        if (!$this->validate([
            'nomor_rak' => [
                'label' => 'Nomor Rak',
                'rules' => 'required|numeric|is_unique[rak_buku.nomor_rak]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'numeric' => '{field} harus berupa angka',
                    'is_unique' => '{field} sudah tersedia, harap ganti',
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        };

        /* Set random 5 character for id rakbuku */
        $id_random = $this->utility->get_random(5);

        /* ======= Saving data ======= */

        // Save field column value to array
        $data = array(
            'id_rak' => $id_random,
            'nomor_rak' => $this->request->getPost('nomor_rak'),
        );

        // Save data to rak_buku table
        $this->model->insertData('rak_buku', $data);

        /* ======= Show message and redirect back to index rakbuku ======= */
        // Set message where data successful inserted
        session()->setFlashData('pesan', 'Data rak buku berhasil disimpan');
        // Redirected back to index rakbuku
        return redirect()->to(route_to('view_rakbuku'));
    }

    //--------------------------------------------------------------------

    public function delete($id)
    {
        /* ======= Deleting data from table rak_buku where id = $id ======= */
        $this->model->deleteData('rak_buku', array('id_rak' => $id));

        /* ======= Show message and redirect back to index rakbuku ======= */
        // Set message where data successful deleted
        session()->setFlashData('pesan', 'Data rak buku berhasil dihapus');
        // Redirected back to index rakbuku
        return redirect()->to(route_to('view_rakbuku'));
    }

    //--------------------------------------------------------------------

    public function edit($id)
    {

        $query = $this->query->query_rakbuku_show_where($id);
        $dataset = $this->model->queryRowArray($query);

        $components = array(
            'is_show_badge3' => true,
            'badge_3' => 'Ubah Rak Buku',
            'link_back' => route_to('view_rakbuku'),
            'desc_badges' => 'Ubah data rak buku pada form dibawah ini',
            'text_header_form' => 'Ubah Rak Buku',
            'valid' => $this->validation,
            'dataset' => $dataset,
        );

        return view('admin/pages/edits/edit-rakbuku', array_merge($this->array_default(), $components));
    }

    // //--------------------------------------------------------------------


    public function update($id)
    {
        if (!$this->validate([
            'nomor_rak' => [
                'label' => 'Nomor Rak',
                'rules' => 'required|numeric|is_unique[rak_buku.nomor_rak, id_rak, ' . $id . ']',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'numeric' => '{field} harus berupa angka',
                    'is_unique' => '{field} sudah tersedia, harap ganti',
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        };

        /* ======= Saving data ======= */

        // Save field column value to array
        $data = array(
            'nomor_rak' => $this->request->getPost('nomor_rak'),
        );

        // Update data to rak_buku table
        $this->model->updateData('rak_buku', 'id_rak', $id, $data);

        /* ======= Show message and redirect back to index rak_buku ======= */
        // Set message where data successful inserted
        session()->setFlashData('pesan', 'Data rak buku berhasil diubah');
        // Redirected back to index rak_buku
        return redirect()->to(route_to('view_rakbuku'));
    }


    //--------------------------------------------------------------------





}
