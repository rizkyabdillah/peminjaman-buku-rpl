<?php

namespace App\Models;

class Query
{

    public function query_buku_show()
    {
        return "SELECT buku.id_buku, buku.nama_buku, kategori_buku.nama_kategori, penerbit.nama_penerbit, pengarang.nama_pengarang, rak_buku.nomor_rak, buku.jumlah_halaman, buku.tahun_cetakan, buku.gambar FROM buku, kategori_buku, penerbit, pengarang, rak_buku WHERE buku.id_kategori = kategori_buku.id_kategori AND buku.id_penerbit = penerbit.id_penerbit AND buku.id_pengarang = pengarang.id_pengarang AND buku.id_rak = rak_buku.id_rak";
    }

    public function query_buku_short()
    {
        return "SELECT buku.id_buku, buku.nama_buku, kategori_buku.nama_kategori, penerbit.nama_penerbit, pengarang.nama_pengarang, buku.jumlah_halaman, buku.gambar FROM buku, kategori_buku, penerbit, pengarang WHERE buku.id_kategori = kategori_buku.id_kategori AND buku.id_penerbit = penerbit.id_penerbit AND buku.id_pengarang = pengarang.id_pengarang";
    }

    public function query_buku_show_all()
    {
        return "SELECT * FROM buku";
    }

    public function query_buku_show_where($id)
    {
        return "SELECT * FROM buku WHERE id_buku ='$id'";
    }

    public function query_katogori_show_all()
    {
        return "SELECT * FROM kategori_buku";
    }

    public function query_rak_show_all()
    {
        return "SELECT * FROM rak_buku ORDER BY nomor_rak ASC";
    }

    public function query_kategori_show_all()
    {
        return "SELECT * FROM kategori_buku";
    }

    public function query_kategori_show_where($id)
    {
        return "SELECT * FROM kategori_buku WHERE id_kategori ='$id'";
    }

    public function query_user_show_all()
    {
        return "SELECT * FROM user";
    }

    public function query_user_filter_pegawai()
    {
        return "SELECT * FROM user WHERE level ='PEGAWAI'";
    }

    public function query_user_filter_pegawai_where($id)
    {
        return "SELECT pegawai.id_pegawai, pegawai.nama_pegawai, pegawai.jenis_kelamin, pegawai.nomor_telpon, user.username, pegawai.alamat FROM pegawai, user WHERE pegawai.id_pegawai = user.id_user AND pegawai.id_pegawai = '$id'";
    }

    public function query_user_filter_pegawai_all()
    {
        return "SELECT pegawai.id_pegawai, pegawai.nama_pegawai, pegawai.nomor_telpon, pegawai.jenis_kelamin, user.username FROM pegawai, user WHERE pegawai.id_pegawai = user.id_user";
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
        return "SELECT * FROM rak_buku";
    }

    public function query_rakbuku_show_where($id)
    {
        return "SELECT * FROM rak_buku where id_rak ='$id'";
    }

    public function query_penerbit_show_all()
    {
        return "SELECT * FROM penerbit";
    }

    public function query_penerbit_show_where($id)
    {
        return "SELECT * FROM penerbit WHERE id_penerbit = '$id'";
    }

    public function query_pengarang_show_all()
    {
        return "SELECT * FROM pengarang";
    }

    public function query_pengarang_show_where($id)
    {
        return "SELECT * FROM pengarang WHERE id_pengarang ='$id'";
    }
}
