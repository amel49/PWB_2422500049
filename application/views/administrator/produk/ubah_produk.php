
<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <h1>Ubah Produk</h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Form Ubah Produk</h3>
                </div>

                <div class="card-body">

                    <?= form_open('admin/produk/ubah_produk/' . $produk['id_produk']) ?>

                    <div class="form-group">
                        <label>Nama Produk</label>
                        <input type="text"
                               name="nama_produk"
                               class="form-control"
                               value="<?= html_escape(set_value('nama_produk', $produk['nama'])) ?>"
                               required>
                        <?= form_error('nama_produk', '<small class="text-danger">', '</small>') ?>
                    </div>

                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="kategori_produk" class="form-control" required>
                            <option value="">-- Pilih Kategori --</option>

                            <?php foreach ($list_kategori as $kategori): ?>
                                <option
                                    value="<?= $kategori['id_kategori'] ?>"
                                    <?= (string) set_value(
                                        'kategori_produk',
                                        $produk['categori_id']
                                    ) === (string) $kategori['id_kategori']
                                        ? 'selected'
                                        : '' ?>>
                                    <?= html_escape($kategori['nama']) ?>
                                </option>
                            <?php endforeach; ?>

                        </select>
                        <?= form_error('kategori_produk', '<small class="text-danger">', '</small>') ?>
                    </div>

                    <div class="form-group">
                        <label>Harga</label>
                        <input type="number"
                               name="harga_produk"
                               class="form-control"
                               value="<?= html_escape(set_value('harga_produk', $produk['harga'])) ?>"
                               min="0"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Stok</label>
                        <input type="number"
                               name="stok_produk"
                               class="form-control"
                               value="<?= html_escape(set_value('stok_produk', $produk['stok'])) ?>"
                               min="0">
                    </div>

                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi_produk"
                                  class="form-control"
                                  rows="4"><?= html_escape(set_value('deskripsi_produk', $produk['deskripsi'])) ?></textarea>
                    </div>
                    <div class="form-group">
    <label>Gambar Produk Saat Ini</label>
    <div>
        <?php if (!empty($list_gambar)): ?>
            <?php foreach ($list_gambar as $gambar): ?>
                <img
                    src="<?= base_url('uploads/produk/' . $gambar['nama_gambar']) ?>"
                    alt="Gambar Produk"
                    style="width: 180px; margin: 5px; border: 1px solid #ddd; padding: 5px;"
                >
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-muted">Belum ada gambar produk.</p>
        <?php endif; ?>
    </div>
</div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>

                    <a href="<?= base_url('index.php/admin/produk') ?>"
                       class="btn btn-secondary">
                        Kembali
                    </a>

                    <?= form_close() ?>

                </div>
            </div>

        </div>
    </section>

</div>
