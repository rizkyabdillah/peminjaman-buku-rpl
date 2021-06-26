<?php

namespace App\Models;

class Query
{

    public function query_buku_show()
    {
        return "SELECT BUKU.id_buku, BUKU.nama_buku, KATEGORI_BUKU.nama_kategori, PENERBIT.nama_penerbit, PENGARANG.nama_pengarang, RAK_BUKU.nomor_rak, BUKU.jumlah_halaman, BUKU.tahun_cetakan, BUKU.gambar FROM BUKU, KATEGORI_BUKU, PENERBIT, PENGARANG, RAK_BUKU WHERE BUKU.id_kategori = KATEGORI_BUKU.id_kategori AND BUKU.id_penerbit = PENERBIT.id_penerbit AND BUKU.id_pengarang = PENGARANG.id_pengarang AND BUKU.id_rak = RAK_BUKU.id_rak";
    }

    public function query_buku_short()
    {
        return "SELECT BUKU.id_buku, BUKU.nama_buku, KATEGORI_BUKU.nama_kategori, PENERBIT.nama_penerbit, PENGARANG.nama_pengarang, BUKU.jumlah_halaman, BUKU.gambar FROM BUKU, KATEGORI_BUKU, PENERBIT, PENGARANG WHERE BUKU.id_kategori = KATEGORI_BUKU.id_kategori AND BUKU.id_penerbit = PENERBIT.id_penerbit AND BUKU.id_pengarang = PENGARANG.id_pengarang";
    }

    public function query_buku_show_all()
    {
        return "SELECT * FROM BUKU";
    }

    public function query_buku_show_where($id)
    {
        return "SELECT * FROM BUKU WHERE id_buku ='$id'";
    }

    public function query_katogori_show_all()
    {
        return "SELECT * FROM KATEGORI_BUKU";
    }

    public function query_rak_show_all()
    {
        return "SELECT * FROM RAK_BUKU ORDER BY nomor_rak ASC";
    }

    public function query_kategori_show_all()
    {
        return "SELECT * FROM KATEGORI_BUKU";
    }

    public function query_kategori_show_where($id)
    {
        return "SELECT * FROM KATEGORI_BUKU WHERE id_kategori ='$id'";
    }

    public function query_user_show_all()
    {
        return "SELECT * FROM USER";
    }

    public function query_user_filter_pegawai()
    {
        return "SELECT * FROM USER WHERE level ='PEGAWAI'";
    }

    public function query_user_filter_pegawai_where($id)
    {
        return "SELECT PEGAWAI.id_pegawai, PEGAWAI.nama_pegawai, PEGAWAI.jenis_kelamin, PEGAWAI.nomor_telpon, USER.username, PEGAWAI.alamat FROM PEGAWAI, USER WHERE PEGAWAI.id_pegawai = USER.id_user AND PEGAWAI.id_pegawai = '$id'";
    }

    public function query_user_filter_pegawai_all()
    {
        return "SELECT PEGAWAI.id_pegawai, PEGAWAI.nama_pegawai, PEGAWAI.nomor_telpon, PEGAWAI.jenis_kelamin, USER.username FROM PEGAWAI, USER WHERE PEGAWAI.id_pegawai = USER.id_user";
    }

    // public function query_anggota_show_all()
    // {
    //     return "SELECT * FROM anggota";
    // }

    // public function query_anggota_show_where($id)
    // {
    //     return "SELECT * FROM anggota WHERE id_anggota ='$id'";
    // }

    public function query_rakbuku_show_all()
    {
        return "SELECT * FROM RAK_BUKU";
    }

    public function query_rakbuku_show_where($id)
    {
        return "SELECT * FROM RAK_BUKU where id_rak ='$id'";
    }

    public function query_penerbit_show_all()
    {
        return "SELECT * FROM PENERBIT";
    }

    public function query_penerbit_show_where($id)
    {
        return "SELECT * FROM PENERBIT WHERE id_penerbit = '$id'";
    }

    public function query_pengarang_show_all()
    {
        return "SELECT * FROM PENGARANG";
    }

    public function query_pengarang_show_where($id)
    {
        return "SELECT * FROM PENGARANG WHERE id_pengarang ='$id'";
    }
}
