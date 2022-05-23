<?php

namespace App\Controllers;

class Pengarang extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    //--------------------------------------------------------------------

    private function array_default()
    {
        return array(
            'header_title' => 'Data Pengarang',
            'badges' => 'Pages Data Pengarang',
            'sidebar' => 6,
            'link_breadcrumb' => route_to('view_pengarang')
        );
    }

    //--------------------------------------------------------------------

    public function index()
    {
        $dataset = $this->model->getAllDataArray('PENGARANG');
        $components = array(
            'is_show_badge3' => false,
            'link_add' => route_to('view_add_pengarang'),
            'desc_badges' => 'Berikut adalah daftar semua data pengarang yang terdaftar',
            'dataset' => $dataset
        );

        return view('admin/pages/layouts/pengarang', array_merge($this->array_default(), $components));
    }

    //--------------------------------------------------------------------

    public function add()
    {

        $components = array(
            'is_show_badge3' => true,
            'badge_3' => 'Tambah Pengarang',
            'link_back' => route_to('view_pengarang'),
            'desc_badges' => 'Tambahkan data pengarang pada form dibawah ini',
            'text_header_form' => 'Tambah Pengarang',
            'valid' => $this->validation,
        );

        return view('admin/pages/adds/add-pengarang', array_merge($this->array_default(), $components));
    }

    //--------------------------------------------------------------------

    public function save()
    {
        if (!$this->validate([
            'nama_pengarang' => [
                'label' => 'Nama Pengarang',
                'rules' => 'required|is_unique[PENGARANG.nama_pengarang]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah tersedia, harap ganti',
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        };

        /* Set random 5 character for id pengarang */
        $id_random = $this->utility->get_random(5);

        /* ======= Saving data ======= */

        // Save field column value to array
        $data = array(
            'id_pengarang' => $id_random,
            'nama_pengarang' => strtoupper($this->request->getPost('nama_pengarang')),
        );

        // Save data to pengarang table
        $this->model->insertData('PENGARANG', $data);

        /* ======= Show message and redirect back to index pengarang ======= */
        // Set message where data successful inserted
        session()->setFlashData('pesan', 'Data pengarang berhasil disimpan');
        // Redirected back to index pengarang
        return redirect()->to(route_to('view_pengarang'));
    }

    //--------------------------------------------------------------------

    public function delete($id)
    {
        /* ======= Deleting data from table pengarang where id = $id ======= */
        $this->model->deleteData('PENGARANG', array('id_pengarang' => $id));

        /* ======= Show message and redirect back to index pengarang ======= */
        // Set message where data successful deleted
        session()->setFlashData('pesan', 'Data pengarang berhasil dihapus');
        // Redirected back to index pengarang
        return redirect()->to(route_to('view_pengarang'));
    }

    //--------------------------------------------------------------------

    public function edit($id)
    {
        $dataset = $this->model->getDataWhereArray('PENGARANG', ['id_pengarang' => $id]);

        $components = array(
            'is_show_badge3' => true,
            'badge_3' => 'Ubah Pengarang',
            'link_back' => route_to('view_pengarang'),
            'desc_badges' => 'Ubah data pengarang pada form dibawah ini',
            'text_header_form' => 'Ubah Pengarang',
            'valid' => $this->validation,
            'dataset' => $dataset[0],
        );

        return view('admin/pages/edits/edit-pengarang', array_merge($this->array_default(), $components));
    }

    // //--------------------------------------------------------------------


    public function update($id)
    {
        if (!$this->validate([
            'nama_pengarang' => [
                'label' => 'Nama Pengarang',
                'rules' => 'required|is_unique[pengarang.nama_pengarang, id_pengarang, ' . $id . ']',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah tersedia, harap ganti',
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        };

        /* ======= Saving data ======= */

        // Save field column value to array
        $data = array(
            'nama_pengarang' => strtoupper($this->request->getPost('nama_pengarang')),
        );

        // Update data to pengarang table
        $this->model->updateData('PENGARANG', 'id_pengarang', $id, $data);

        /* ======= Show message and redirect back to index pengarang ======= */
        // Set message where data successful inserted
        session()->setFlashData('pesan', 'Data pengarang berhasil diubah');
        // Redirected back to index pengarang
        return redirect()->to(route_to('view_pengarang'));
    }


    //--------------------------------------------------------------------





}
