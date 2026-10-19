<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Starter Page</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Starter Page</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tambah Kategori</h5>

                            <p class="card-text">
                                <form method="post">
                                    <div class="mb-3">
                                        <label for="nama_kategori" class="form-label">
                                            Nama Kategori
                                        </label>

                                        <input type="text"
                                               class="form-control"
                                               name="nama_kategori"
                                               id="nama_kategori"
                                               aria-describedby="Nama Kategori">
                                    </div>

                                    <div class="mb-3">
                                        <label for="deskripsi_kategori" class="form-label">
                                            Deskripsi
                                        </label>

                                        <textarea name="deskripsi_kategori"
                                                  id="deskripsi_kategori"
                                                  cols="30"
                                                  rows="10"
                                                  class="form-control"></textarea>
                                    </div>

                                    <button type="submit" class="btn btn-primary">
                                        Tambah
                                    </button>

                                    <a href="<?= base_url('admin/kategori') ?>"
                                       class="btn btn-danger">
                                        Kembali
                                    </a>
                                </form>
                            </p>

                        </div>
                    </div>
                </div>

                <!-- /.col-md-6 -->

            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

private function __simpan_kategori()
{
    $data = [
        'nama' => ucwords($this->input->post('nama_kategori')),
        'deskripsi' => ucfirst($this->input->post('deskripsi_kategori'))
    ];

    $simpan = $this->produk_kategori_model->tambah($data);

    if ($simpan) {
        $this->session->set_flashdata('message', '
            <div class="alert alert-success d-flex align-items-center alert-dismissible fade show"
                role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                    aria-label="Success:">
                    <use xlink:href="#check-circle-fill" />
                </svg>
                <div>
                    Berhasil menambahkan kategori!!
                </div>
                <button type="button" class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>
        ');
    } else {
        $this->session->set_flashdata('message', '
            <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show"
                role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                    aria-label="Danger:">
                    <use xlink:href="#exclamation-triangle-fill" />
                </svg>
                <div>
                    Gagal menambahkan kategori!!
                </div>
                <button type="button" class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>
        ');
    }

    redirect('admin/kategori');
}