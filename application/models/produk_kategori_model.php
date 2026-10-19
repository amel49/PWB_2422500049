
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_kategori_model extends CI_Model
{
    private $_table = 'kategori';

    // Mengambil semua kategori
    public function get_all()
    {
        return $this->db->get($this->_table)->result_array();
    }

    // Mengambil kategori berdasarkan ID
    public function get_by_id($id)
    {
        return $this->db
                    ->get_where($this->_table, array('id_kategori' => $id))
                    ->row_array();
    }

    // Menambahkan kategori
    public function tambah($data)
    {
        return $this->db->insert($this->_table, $data);
    }

    // Mengubah kategori
    public function ubah($id, $data)
    {
        $this->db->where('id_kategori', $id);
        return $this->db->update($this->_table, $data);
    }

    // Menghapus kategori
    public function hapus($id)
    {
        return $this->db->delete(
            $this->_table,
            array('id_kategori' => $id)
        );
    }
}
