
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Ubah Kategori</h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">

                    <?= form_open('admin/kategori/ubah/' . $kategori['id_kategori']) ?>

                    <div class="form-group">
                        <label>Nama Kategori</label>
                        <input type="text"
                               name="nama_kategori"
                               class="form-control"
                               value="<?= html_escape(set_value('nama_kategori', $kategori['nama'])) ?>"
                               required>
                        <?= form_error('nama_kategori', '<small class="text-danger">', '</small>') ?>
                    </div>

                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi_kategori"
                                  class="form-control"
                                  rows="4"><?= html_escape(set_value('deskripsi_kategori', $kategori['deskripsi'])) ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Simpan Perubahan
                    </button>

                    <a href="<?= base_url('index.php/admin/kategori') ?>"
                       class="btn btn-secondary">
                        Kembali
                    </a>

                    <?= form_close() ?>

                </div>
            </div>
        </div>
    </section>
</div>
