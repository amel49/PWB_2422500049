
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        is_admin_logged_in();

        $this->load->model('produk_model');
        $this->load->model('produk_kategori_model');
        $this->load->model('produk_gambar_model');

        $this->load->library('form_validation');
        $this->load->library('session');
    }

    // TAMPIL PRODUK
    public function index()
    {
        $data['title'] = 'Daftar Produk';
        $data['list_produk'] = $this->produk_model->get_all();

        $this->load->view('administrator/templates/header', $data);
        $this->load->view('administrator/templates/sidebar');
        $this->load->view('administrator/produk/index', $data);
        $this->load->view('administrator/templates/footer');
    }

    // TAMBAH PRODUK
    public function tambah_produk()
    {
        $data['title'] = 'Tambah Produk';

        $this->form_validation->set_rules(
            'nama_produk',
            'Nama Produk',
            'required'
        );

        $this->form_validation->set_rules(
            'kategori_produk',
            'Kategori',
            'required'
        );

        if ($this->form_validation->run() === TRUE) {
            $this->__simpan_produk();
            return;
        }

        $data['list_kategori'] = $this->produk_kategori_model->get_all();

        $this->load->view('administrator/templates/header', $data);
        $this->load->view('administrator/templates/sidebar');
        $this->load->view('administrator/produk/tambah_produk', $data);
        $this->load->view('administrator/templates/footer');
    }

    // SIMPAN PRODUK
    private function __simpan_produk()
    {
        $data = array(
            'nama'        => ucwords(trim($this->input->post('nama_produk'))),
            'categori_id' => $this->input->post('kategori_produk'),
            'harga'       => $this->input->post('harga_produk'),
            'stok'        => $this->input->post('stok_produk'),
            'deskripsi'   => ucfirst(trim($this->input->post('deskripsi_produk')))
        );

        $id_produk = $this->produk_model->tambah($data);

        if ($id_produk) {
            if (
                isset($_FILES['gambar_produk']['name']) &&
                is_array($_FILES['gambar_produk']['name'])
            ) {
                $count = count($_FILES['gambar_produk']['name']);

                if ($count > 0) {
                    $this->__produk_gambar_upload($count, $id_produk);
                }
            }

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success">Berhasil menambahkan produk!</div>'
            );
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger">Gagal menambahkan produk!</div>'
            );
        }

        redirect('admin/produk');
    }

    // UPLOAD GAMBAR PRODUK
    private function __produk_gambar_upload($count, $id_produk)
    {
        for ($i = 0; $i < $count; $i++) {
            if (
                empty($_FILES['gambar_produk']['name'][$i]) ||
                $_FILES['gambar_produk']['error'][$i] !== UPLOAD_ERR_OK
            ) {
                continue;
            }

            $_FILES['file']['name'] =
                $_FILES['gambar_produk']['name'][$i];
            $_FILES['file']['type'] =
                $_FILES['gambar_produk']['type'][$i];
            $_FILES['file']['tmp_name'] =
                $_FILES['gambar_produk']['tmp_name'][$i];
            $_FILES['file']['error'] =
                $_FILES['gambar_produk']['error'][$i];
            $_FILES['file']['size'] =
                $_FILES['gambar_produk']['size'][$i];

            $config['upload_path'] = FCPATH . 'uploads/produk/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = 5000;
            $config['file_name'] = 'produk-' . $id_produk . '-' . $i;

            if (!is_dir($config['upload_path'])) {
                mkdir($config['upload_path'], 0755, TRUE);
            }

            $this->load->library('upload');
            $this->upload->initialize($config);

            if ($this->upload->do_upload('file')) {
                $uploadData = $this->upload->data();

                $data_gambar = array(
                    'nama_gambar' => $uploadData['file_name'],
                    'produk_id'   => $id_produk
                );

                $this->produk_gambar_model->tambah($data_gambar);
            }
        }
    }

    // UBAH PRODUK
    public function ubah_produk($id)
    {
        $produk = $this->produk_model->get_by_id($id);

        if (!$produk) {
            show_404();
            return;
        }

        $this->form_validation->set_rules(
            'nama_produk',
            'Nama Produk',
            'required'
        );

        $this->form_validation->set_rules(
            'kategori_produk',
            'Kategori',
            'required'
        );

        if ($this->form_validation->run() === TRUE) {
            $this->__ubah_produk($id);
            return;
        }

        $data['title'] = 'Ubah Produk';
        $data['produk'] = $produk;
        $data['list_kategori'] = $this->produk_kategori_model->get_all();
       $data['list_gambar'] =
    $this->produk_gambar_model->get_by_produk_id($id);

        $this->load->view('administrator/templates/header', $data);
        $this->load->view('administrator/templates/sidebar');
        $this->load->view('administrator/produk/ubah_produk', $data);
        $this->load->view('administrator/templates/footer');
    }

    // SIMPAN PERUBAHAN PRODUK
    private function __ubah_produk($id)
    {
        $data = array(
            'nama'        => ucwords(trim($this->input->post('nama_produk'))),
            'categori_id' => $this->input->post('kategori_produk'),
            'harga'       => $this->input->post('harga_produk'),
            'stok'        => $this->input->post('stok_produk'),
            'deskripsi'   => ucfirst(trim($this->input->post('deskripsi_produk')))
        );

        $berhasil = $this->produk_model->ubah($data, $id);

        $this->session->set_flashdata(
            'message',
            $berhasil
                ? '<div class="alert alert-success">Berhasil mengubah produk!</div>'
                : '<div class="alert alert-warning">Tidak ada perubahan atau gagal menyimpan produk.</div>'
        );

        redirect('admin/produk');
    }

    // HAPUS PRODUK
    public function hapus_produk($id)
    {
        $produk = $this->produk_model->get_by_id($id);

        if (!$produk) {
            show_404();
            return;
        }

        $list_gambar = $this->produk_gambar_model->get_by_produk_id($id);

        if (!empty($list_gambar)) {
            foreach ($list_gambar as $gambar) {
                $this->produk_gambar_model->hapus($gambar['id_gambar']);

                $path = FCPATH . 'uploads/produk/' . $gambar['nama_gambar'];

                if (is_file($path)) {
                    unlink($path);
                }
            }
        }

        $this->produk_model->hapus($id);

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success">Berhasil menghapus produk!</div>'
        );

        redirect('admin/produk');
    }
}
