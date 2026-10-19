
<!-- Content Wrapper -->
<div class="content-wrapper">

    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Kategori</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('index.php/admin') ?>">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Kategori</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Kategori</h3>
                        </div>

                        <div class="card-body">

                            <!-- Pesan sukses atau error -->
                            <?php if ($this->session->flashdata('message')): ?>
                                <div class="alert alert-info">
                                    <?= $this->session->flashdata('message') ?>
                                </div>
                            <?php endif; ?>

                            <!-- Tombol Tambah: hanya satu -->
                            <a href="<?= base_url('index.php/admin/kategori/tambah') ?>"
                               class="btn btn-primary mb-3">
                                <i class="fas fa-plus"></i> Tambah Kategori
                            </a>

                            <!-- Tabel Kategori -->
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 60px;">No</th>
                                        <th>Nama</th>
                                        <th>Deskripsi</th>
                                        <th style="width: 150px;">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $no = 1; ?>

                                    <?php if (!empty($list_kategori)): ?>
                                        <?php foreach ($list_kategori as $kategori): ?>
                                            <tr>
                                                <td><?= $no++ ?></td>

                                                <td>
                                                    <?= html_escape($kategori['nama']) ?>
                                                </td>

                                                <td>
                                                    <?= html_escape($kategori['deskripsi']) ?>
                                                </td>

                                                <td>
                                                    <!-- Tombol Ubah -->
                                                    <a href="<?= base_url('index.php/admin/kategori/ubah/' . $kategori['id_kategori']) ?>"
                                                       class="btn btn-success btn-sm">
                                                        Ubah
                                                    </a>

                                                    <!-- Tombol Hapus -->
                                                    <a href="<?= base_url('index.php/admin/kategori/hapus/' . $kategori['id_kategori']) ?>"
                                                       class="btn btn-danger btn-sm"
                                                       onclick="return confirm('Yakin ingin menghapus kategori ini?')">
                                                        Hapus
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>

                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4" class="text-center">
                                                Belum ada data kategori.
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>
