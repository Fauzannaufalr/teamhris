<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>

            <?= $this->session->flashdata('message'); ?>
            <button type="button" class="btn btn-outline-success mb-2" data-toggle="modal" data-target="#tambahDataPajak"><i class="fas fa-plus"></i>
                Tambah Data Pajak
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <table class="table table-bordered">
                <thead style="text-align: center; background-color: #ff0000; color: #ffffff;">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Golongan</th>
                        <th scope="col">Kode</th>
                        <th scope="col">Tarif</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody style="text-align: center;">
                    <?php $no = 1 ?>
                    <?php foreach ($datapajak as $dp) : ?>
                        <tr>
                            <th><?= $no++; ?></th>
                            <td><?= $dp['golongan']; ?></td>
                            <td><?= $dp['kode']; ?></td>
                            <td>Rp <?= number_format($dp['tarif'], 0, ',', '.'); ?></td>
                            <td>
                                <a href="" class="badge" style="background-color: #fbff39; color: black;" data-toggle="modal" data-target="#ubahDataPajak<?= $dp['id']; ?>">ubah</a>
                                <a href="" class="badge" style="background-color: #ff0000; color: black;" data-toggle="modal" data-target="#modal-sm<?= $dp['id']; ?>">hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal tambah -->
<div class="modal fade" id="tambahDataPajak" tabindex="-1" aria-labelledby="tambahDataPajakLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahDataPajakLabel">Tambah Data Pajak</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('payroll/datapajak/tambah'); ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="golongan">Golongan</label>
                        <select name="golongan" id="golongan" class="form-control">
                            <option value="">-- Pilih Golongan --</option>
                            <option>Tidak Kawin (TK)</option>
                            <option>Kawin (K)</option>
                            <option>Kawin + Istri (KI)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kode">Kode</label>
                        <input type="text" class="form-control" id="kode" name="kode" placeholder="Masukan Kode">
                    </div>
                    <div class="form-group">
                        <label for="tarif">Tarif</label>
                        <input type="text" class="form-control" id="tarif" name="tarif" placeholder="Masukan Tarif">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-danger">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal ubah -->
<?php foreach ($datapajak as $dp) : ?>
    <div class="modal fade" id="ubahDataPajak<?= $dp['id']; ?>" tabindex="-1" aria-labelledby="ubahDataPajakLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahDataPajakLabel">Ubah Data Pajak</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('payroll/datapajak/ubah'); ?>" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="id" value="<?= $dp['id']; ?>">
                        <div class="form-group">
                            <label for="golongan">Golongan</label>
                            <select name="golongan" id="golongan" class="form-control">
                                <option value="">-- Pilih Golongan --</option>
                                <option>Tidak Kawin (TK)</option>
                                <option>Kawin (K)</option>
                                <option>Kawin + Istri (KI)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kode">Kode</label>
                            <input type="text" class="form-control" id="kode" name="kode" value="<?= $dp['kode']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="tarif">Tarif</label>
                            <input type="text" class="form-control" id="tarif" name="tarif" value="<?= $dp['tarif']; ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-danger">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal hapus -->
<?php foreach ($datapajak as $dp) : ?>
    <div class="modal fade" id="modal-sm<?= $dp['id']; ?>">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin untuk menghapus data ?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn" data-dismiss="modal" style="background-color: #fbff39;">Tidak</button>
                    <a href="<?= base_url() ?>payroll/datapajak/hapus/<?= $dp['id']  ?>" type="submit" class="btn btn-primary">Ya</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach; ?>