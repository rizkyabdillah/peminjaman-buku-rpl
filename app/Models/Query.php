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

    public function query_transaksi()
    {
        return "SELECT TRANSAKSI.id_transaksi, TRANSAKSI.tanggal_peminjaman, TRANSAKSI.tanggal_harus_kembali, ANGGOTA.nama_anggota, (SELECT SUM(banyak_buku) FROM DETAIL_PEMINJAMAN WHERE DETAIL_PEMINJAMAN.id_transaksi = TRANSAKSI.id_transaksi) AS banyak_buku, TRANSAKSI.status FROM TRANSAKSI, ANGGOTA WHERE TRANSAKSI.id_anggota = ANGGOTA.id_anggota";
    }

    public function query_detail_peminjaman($id_transaksi)
    {
        return "SELECT DETAIL_PEMINJAMAN.id_buku, BUKU.nama_buku, PENERBIT.nama_penerbit, PENGARANG.nama_pengarang, BUKU.jumlah_halaman, DETAIL_PEMINJAMAN.banyak_buku FROM DETAIL_PEMINJAMAN, BUKU, PENERBIT, PENGARANG WHERE DETAIL_PEMINJAMAN.id_buku = BUKU.id_buku AND BUKU.id_penerbit = PENERBIT.id_penerbit AND BUKU.id_pengarang = PENGARANG.id_pengarang AND DETAIL_PEMINJAMAN.id_transaksi = '$id_transaksi'";
    }
}
