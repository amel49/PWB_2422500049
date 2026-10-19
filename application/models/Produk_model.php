
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_model extends CI_Model
{
    private $_table = 'produk';

    // TAMPIL SEMUA PRODUK
    public function get_all()
    {
        $this->db->select(
            'produk.id_produk,
             produk.nama AS pd_nama,
             produk.stok,
             produk.deskripsi,
             produk.harga,
             kategori.nama AS kt_nama'
        );

        $this->db->from($this->_table);

        $this->db->join(
            'kategori',
            'kategori.id_kategori = produk.categori_id',
            'left'
        );

        return $this->db->get()->result_array();
    }

    // TAMBAH PRODUK
    public function tambah($data)
    {
        $berhasil = $this->db->insert($this->_table, $data);

        if ($berhasil) {
            return $this->db->insert_id();
        }

        return FALSE;
    }

    // AMBIL PRODUK BERDASARKAN ID
    public function get_by_id($id)
    {
        return $this->db
            ->get_where($this->_table, array('id_produk' => $id))
            ->row_array();
    }

    // UBAH PRODUK
    public function ubah($data, $id)
    {
        $this->db->where('id_produk', $id);
        $this->db->update($this->_table, $data);

        return $this->db->affected_rows() >= 0
            && $this->db->error()['code'] == 0;
    }

    // HAPUS PRODUK
    public function hapus($id)
    {
        $this->db->where('id_produk', $id);
        return $this->db->delete($this->_table);
    }
}
