<?php

namespace App\Controllers;

class Kategori extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    //--------------------------------------------------------------------

    private function array_default()
    {
        return array(
            'header_title' => 'Data Kategori Buku',
            'badges' => 'Pages Data Kategori Buku',
            'sidebar' => 3,
            'link_breadcrumb' => route_to('view_kategori')
        );
    }

    //--------------------------------------------------------------------

    public function index()
    {
        $dataset = $this->model->getAllDataArray('KATEGORI_BUKU');
        $components = array(
            'is_show_badge3' => false,
            'link_add' => route_to('view_add_kategori'),
            'desc_badges' => 'Berikut adalah daftar semua data kategori yang terdaftar',
            'dataset' => $dataset,
        );

        return view('admin/pages/layouts/kategori', array_merge($this->array_default(), $components));
    }

    //--------------------------------------------------------------------

    public function add()
    {

        $components = array(
            'is_show_badge3' => true,
            'badge_3' => 'Tambah Kategori',
            'link_back' => route_to('view_kategori'),
            'desc_badges' => 'Tambahkan data kategori pada form dibawah ini',
            'text_header_form' => 'Tambah Kategori',
            'valid' => $this->validation,
        );

        return view('admin/pages/adds/add-kategori', array_merge($this->array_default(), $components));
    }

    //--------------------------------------------------------------------

    public function save()
    {
        if (!$this->validate([
            'nama_kategori' => [
                'label' => 'Nama kategori',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        };

        /* Set random 5 character for id kategori */
        $id_random = $this->utility->get_random(5);
        /* ======= Saving data ======= */
        // Save field column value to array
        $data = array(
            'id_kategori' => $id_random,
            'nama_kategori' => strtoupper($this->request->getPost('nama_kategori')),
        );
        // Save data to kategori table
        $this->model->insertData('KATEGORI_BUKU', $data);

        /* ======= Show message and redirect back to index kategori ======= */
        // Set message where data successful inserted
        session()->setFlashData('pesan', 'Data kategori berhasil disimpan');
        // Redirected back to index buku
        return redirect()->to(route_to('view_kategori'));
    }

    //--------------------------------------------------------------------

    public function delete($id)
    {

        /* ======= Deleting data from table kategori_buku where id = $id ======= */
        $this->model->deleteData('KATEGORI_BUKU', array('id_kategori' => $id));

        /* ======= Show message and redirect back to index kategori ======= */
        // Set message where data successful deleted
        session()->setFlashData('pesan', 'Data kategori berhasil dihapus');
        // Redirected back to index kategori
        return redirect()->to(route_to('view_kategori'));
    }

    //--------------------------------------------------------------------

    public function edit($id)
    {
        $dataset = $this->model->getDataWhereArray('KATEGORI_BUKU', ['id_kategori' => $id]);

        $components = array(
            'is_show_badge3' => true,
            'badge_3' => 'Ubah Kategori',
            'link_back' => route_to('view_kategori'),
            'desc_badges' => 'Ubah data kategori pada form dibawah ini',
            'text_header_form' => 'Ubah Kategori',
            'valid' => $this->validation,
            'dataset' => $dataset[0],
        );

        return view('admin/pages/edits/edit-kategori', array_merge($this->array_default(), $components));
    }

    //--------------------------------------------------------------------


    public function update($id)
    {
        if (!$this->validate([
            'nama_kategori' => [
                'label' => 'Nama Kategori',
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
            'nama_kategori' => strtoupper($this->request->getPost('nama_kategori')),
        );

        // Update data to kategori table
        $this->model->updateData('KATEGORI_BUKU', 'id_kategori', $id, $data);

        /* ======= Show message and redirect back to index kategori ======= */
        // Set message where data successful inserted
        session()->setFlashData('pesan', 'Data kategori berhasil diubah');
        // Redirected back to index kategori
        return redirect()->to(route_to('view_kategori'));
    }


    //--------------------------------------------------------------------


}
