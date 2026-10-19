
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        is_admin_logged_in();

        $this->load->model('produk_kategori_model');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    // Menampilkan daftar kategori
    public function index()
    {
        $data['title'] = 'Data Kategori';
        $data['list_kategori'] = $this->produk_kategori_model->get_all();

        $this->load->view('administrator/templates/header', $data);
        $this->load->view('administrator/templates/sidebar');
        $this->load->view('administrator/kategori/index', $data);
        $this->load->view('administrator/templates/footer');
    }

    // Menampilkan form tambah dan menyimpan kategori
    public function tambah_kategori()
    {
        $this->form_validation->set_rules(
            'nama_kategori',
            'Nama Kategori',
            'required|trim'
        );

        if ($this->form_validation->run() === TRUE) {
            $data_kategori = array(
                'nama' => ucwords(trim($this->input->post('nama_kategori'))),
                'deskripsi' => ucfirst(trim($this->input->post('deskripsi_kategori')))
            );

            $berhasil = $this->produk_kategori_model->tambah($data_kategori);

            if ($berhasil) {
                $this->session->set_flashdata(
                    'message',
                    'Berhasil menambahkan kategori!'
                );
                redirect('admin/kategori');
                return;
            }

            $this->session->set_flashdata(
                'message',
                'Gagal menambahkan kategori. Periksa database.'
            );
        }

        $data['title'] = 'Tambah Kategori';

        $this->load->view('administrator/templates/header', $data);
        $this->load->view('administrator/templates/sidebar');
        $this->load->view('administrator/kategori/tambah_kategori', $data);
        $this->load->view('administrator/templates/footer');
    }

    // Mengubah kategori
    public function ubah_kategori($id)
    {
        $kategori = $this->produk_kategori_model->get_by_id($id);

        if (!$kategori) {
            show_404();
            return;
        }

        $this->form_validation->set_rules(
            'nama_kategori',
            'Nama Kategori',
            'required|trim'
        );

        if ($this->form_validation->run() === TRUE) {
            $data_kategori = array(
                'nama' => ucwords(trim($this->input->post('nama_kategori'))),
                'deskripsi' => ucfirst(trim($this->input->post('deskripsi_kategori')))
            );

            $berhasil = $this->produk_kategori_model->ubah($id, $data_kategori);

            if ($berhasil) {
                $this->session->set_flashdata(
                    'message',
                    'Berhasil mengubah kategori!'
                );
                redirect('admin/kategori');
                return;
            }

            $this->session->set_flashdata(
                'message',
                'Tidak ada perubahan atau gagal menyimpan kategori.'
            );
        }

        $data['title'] = 'Ubah Kategori';
        $data['kategori'] = $kategori;

        $this->load->view('administrator/templates/header', $data);
        $this->load->view('administrator/templates/sidebar');
        $this->load->view('administrator/kategori/ubah_kategori', $data);
        $this->load->view('administrator/templates/footer');
    }

    // Menghapus kategori
    public function hapus_kategori($id)
    {
        $kategori = $this->produk_kategori_model->get_by_id($id);

        if (!$kategori) {
            $this->session->set_flashdata(
                'message',
                'Kategori tidak ditemukan.'
            );
            redirect('admin/kategori');
            return;
        }

        $berhasil = $this->produk_kategori_model->hapus($id);

        $this->session->set_flashdata(
            'message',
            $berhasil
                ? 'Berhasil menghapus kategori!'
                : 'Gagal menghapus kategori. Periksa apakah kategori digunakan oleh data produk.'
        );

        redirect('admin/kategori');
    }
}
