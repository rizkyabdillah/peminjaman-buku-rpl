<?php

namespace App\Controllers;

class Buku extends BaseController
{

    private $data_kategori, $data_penerbit, $data_pengarang, $data_rak;

    public function __construct()
    {
        parent::__construct();
        $this->data_kategori = $this->model->getAllDataArray('KATEGORI_BUKU');
        $this->data_penerbit = $this->model->getAllDataArray('PENERBIT');
        $this->data_pengarang = $this->model->getAllDataArray('PENGARANG');
        $this->data_rak = $this->model->getDataOrderByArray('RAK_BUKU', 'nomor_rak', 'ASC');
    }

    //--------------------------------------------------------------------

    private function array_default()
    {
        return array(
            'header_title' => 'Data Buku',
            'badges' => 'Pages Data Buku',
            'sidebar' => 2,
            'link_breadcrumb' => route_to('view_buku')
        );
    }

    //--------------------------------------------------------------------

    public function index()
    {

        $query = $this->query->query_buku_short();
        $dataset = $this->model->queryArray($query);
        $components = array(
            'is_show_badge3' => false,
            'link_add' => route_to('view_add_buku'),
            'desc_badges' => 'Berikut adalah daftar semua data buku yang terdaftar',
            'dataset' => $dataset
        );

        return view('admin/pages/layouts/buku', array_merge($this->array_default(), $components));
    }

    //--------------------------------------------------------------------

    public function add()
    {

        $components = array(
            'is_show_badge3' => true,
            'badge_3' => 'Tambah Buku',
            'link_back' => route_to('view_buku'),
            'desc_badges' => 'Tambahkan data buku pada form dibawah ini',
            'text_header_form' => 'Tambah Buku',
            'valid' => $this->validation,

            'data_kategori' => $this->data_kategori,
            'data_penerbit' => $this->data_penerbit,
            'data_pengarang' => $this->data_pengarang,
            'data_rak' => $this->data_rak
        );

        return view('admin/pages/adds/add-buku', array_merge($this->array_default(), $components));
    }

    //--------------------------------------------------------------------

    public function save()
    {
        if (!$this->validate([
            'nama_buku' => [
                'label' => 'Nama buku',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ], 'jumlah_halaman' => [
                'label' => 'Jumlah halaman',
                'rules' => 'required|numeric|greater_than[0]|less_than_equal_to[10000]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'numeric' => '{field} harus berupa angka',
                    'greater_than' => '{field} harus lebih dari 1',
                    'less_than_equal_to' => '{field} tidak boleh lebih dari 10000',
                ]
            ], 'tahun_cetakan' => [
                'label' => 'Tahun cetakan',
                'rules' => 'required|numeric|greater_than_equal_to[1000]|less_than_equal_to[' . date('Y') . ']',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'numeric' => '{field} harus berupa angka',
                    'greater_than_equal_to' => '{field} harus lebih dari 1000',
                    'less_than_equal_to' => '{field} tidak boleh lebih dari tahun sekarang (' . date('Y') . ')',
                ]
            ], 'gambar' => [
                'label' => 'Gambar',
                'rules' => 'max_size[gambar,2048]|is_image[gambar]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'file harus berupa gambar',
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        };

        /* Set random 5 character for id buku */
        $id_random = $this->utility->get_random(5);

        /* ======= File uploader ======= */

        // Get image from POST action
        $file = $this->request->getFile('gambar');
        // Set name image using random name
        $nama_gambar = $file->getRandomName();
        // Checked if file is not uploaded, (*note = error code 4 file is not uploaded)
        if ($file->getError() == 4) {
            // Set nama gambar to default.png where found error
            $nama_gambar = 'default.png';
        } else {
            // Move image from POST action to public/assets/images/buku
            $file->move(ROOTPATH . 'public/assets/images/buku', $nama_gambar);
        }


        /* ======= Saving data ======= */

        // Save field column value to array
        $data = array(
            'id_buku' => $id_random,
            'nama_buku' => ucfirst($this->request->getPost('nama_buku')),
            'id_kategori' => $this->request->getPost('data_kategori'),
            'id_penerbit' => $this->request->getPost('data_penerbit'),
            'id_pengarang' => $this->request->getPost('data_pengarang'),
            'id_rak' => $this->request->getPost('data_rak'),
            'jumlah_halaman' => $this->request->getPost('jumlah_halaman'),
            'tahun_cetakan' => $this->request->getPost('tahun_cetakan'),
            'gambar' => $nama_gambar,
        );
        // Save data to buku table
        $this->model->insertData('BUKU', $data);

        /* ======= Show message and redirect back to index buku ======= */
        // Set message where data successful inserted
        session()->setFlashData('pesan', 'Data buku berhasil disimpan');
        // Redirected back to index buku
        return redirect()->to(route_to('view_buku'));
    }

    //--------------------------------------------------------------------

    public function delete($id)
    {
        /* ======= Deleting image from public/assets/images/buku/ ======= */
        // Get name image from data deleted
        $name_image = $this->model->getDataColumnWhereArray('BUKU', 'gambar', array('id_buku' => $id));
        // Setting path to data images
        $path = ROOTPATH . 'public/assets/images/buku/' . $name_image[0]['gambar'];
        // Deleting images using unlink command
        if (!hash_equals($name_image[0]['gambar'], 'default.png')) {
            if (file_exists($path)) {
                unlink($path);
            }
        }
        /* ======= Deleting data from table buku where id = $id ======= */
        $this->model->deleteData('BUKU', array('id_buku' => $id));

        /* ======= Show message and redirect back to index buku ======= */
        // Set message where data successful deleted
        session()->setFlashData('pesan', 'Data buku berhasil dihapus');
        // Redirected back to index buku
        return redirect()->to(route_to('view_buku'));
    }

    //--------------------------------------------------------------------

    public function edit($id)
    {
        $dataset = $this->model->getDataWhereArray('BUKU', ['id_buku' => $id]);

        $components = array(
            'is_show_badge3' => true,
            'badge_3' => 'Ubah Buku',
            'link_back' => route_to('view_buku'),
            'desc_badges' => 'Ubah data buku pada form dibawah ini',
            'text_header_form' => 'Ubah Buku',
            'valid' => $this->validation,

            'data_kategori' => $this->data_kategori,
            'data_penerbit' => $this->data_penerbit,
            'data_pengarang' => $this->data_pengarang,
            'data_rak' => $this->data_rak,

            'dataset' => $dataset[0],
        );

        return view('admin/pages/edits/edit-buku', array_merge($this->array_default(), $components));
    }

    //--------------------------------------------------------------------


    public function update($id)
    {
        if (!$this->validate([
            'nama_buku' => [
                'label' => 'Nama buku',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ], 'jumlah_halaman' => [
                'label' => 'Jumlah halaman',
                'rules' => 'required|numeric|greater_than[0]|less_than_equal_to[10000]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'numeric' => '{field} harus berupa angka',
                    'greater_than' => '{field} harus lebih dari 1',
                    'less_than_equal_to' => '{field} tidak boleh lebih dari 10000',
                ]
            ], 'tahun_cetakan' => [
                'label' => 'Tahun cetakan',
                'rules' => 'required|numeric|greater_than_equal_to[1000]|less_than_equal_to[' . date('Y') . ']',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'numeric' => '{field} harus berupa angka',
                    'greater_than_equal_to' => '{field} harus lebih dari 1000',
                    'less_than_equal_to' => '{field} tidak boleh lebih dari tahun sekarang (' . date('Y') . ')',
                ]
            ], 'gambar' => [
                'label' => 'Gambar',
                'rules' => 'max_size[gambar,2048]|is_image[gambar]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'file harus berupa gambar',
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        };

        /* ======= File uploader ======= */

        // Get image from POST action
        $file = $this->request->getFile('gambar');
        // Set name image using random name
        $nama_gambar = $file->getRandomName();


        /* ======= Saving data ======= */

        // Save field column value to array
        $data = array(
            'nama_buku' => ucfirst($this->request->getPost('nama_buku')),
            'id_kategori' => $this->request->getPost('data_kategori'),
            'id_penerbit' => $this->request->getPost('data_penerbit'),
            'id_pengarang' => $this->request->getPost('data_pengarang'),
            'id_rak' => $this->request->getPost('data_rak'),
            'jumlah_halaman' => $this->request->getPost('jumlah_halaman'),
            'tahun_cetakan' => $this->request->getPost('tahun_cetakan'),
        );

        // Checked if file is not error
        if (!$file->getError()) {
            // Move image from POST action to public/assets/images/buku
            $file->move(ROOTPATH . 'public/assets/images/buku', $nama_gambar);
            // Merge data with name gambar where gambar is edited
            $data = array_merge($data, array('gambar' => $nama_gambar));
            // Get gambar name
            $gambar = $this->request->getPost('gambar_temp');
            // Setting path to data images
            $path = ROOTPATH . 'public/assets/images/buku/' . $gambar;
            // Deleting images using unlink command
            if (!hash_equals($gambar, 'default.png')) {
                if (file_exists($path)) {
                    unlink($path);
                }
            }
        }

        // Update data to buku table
        $this->model->updateData('BUKU', 'id_buku', $id, $data);

        /* ======= Show message and redirect back to index buku ======= */
        // Set message where data successful inserted
        session()->setFlashData('pesan', 'Data buku berhasil diubah');
        // Redirected back to index buku
        return redirect()->to(route_to('view_buku'));
    }


    //--------------------------------------------------------------------





}
