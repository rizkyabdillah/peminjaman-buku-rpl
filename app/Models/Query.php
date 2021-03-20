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
}
