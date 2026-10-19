<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Produk</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Starter Page
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text">
                                <i class="fas fa-table me-1"></i>
                                Semua Produk

                                <a href="<?= base_url('admin/produk/tambah') ?>"
                                   class="btn btn-labeled btn-primary">
                                    <span class="btn-label">
                                        <i class="fa fa-plus"></i>
                                    </span>
                                    Produk
                                </a>

                                <?php if ($this->session->flashdata('message')) : ?>
                                    <?= $this->session->flashdata('message') ?>
                                <?php endif; ?>

                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Kategori</th>
                                            <th scope="col">Harga</th>
                                            <th scope="col">Stok</th>
                                            <th scope="col">Deskripsi</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php foreach ($list_produk as $produk) : ?>
                                            <tr>
                                                <th scope="row"><?= $no ?></th>
                                                <td><?= $produk['pd_nama'] ?></td>
                                                <td><?= $produk['kt_nama'] ?></td>
                                                <td>Rp. <?= number_format($produk['harga']) ?></td>
                                                <td><?= $produk['stok'] ?></td>
                                                <td><?= $produk['deskripsi'] ?></td>
                                                <td>
                                                    <a href="<?= base_url('index.php/admin/produk/ubah_produk/') . $produk['id_produk'] ?>">
    <span class="badge bg-success">Ubah</span>
</a>

                                                    <a href="<?= base_url('index.php/admin/produk/hapus_produk/') . $produk['id_produk'] ?>">
    <span class="badge bg-danger">Hapus</span>
</a>
                                                </td>
                                            </tr>
                                            <?php $no++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>