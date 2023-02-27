<div class="container-fluid">

    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-lg-4">
                    <?= $this->session->flashdata('message'); ?>
                </div>
            </div>
            <button type="button" class="btn btn-outline-success mb-2" data-toggle="modal" data-target="#tambahPajakKaryawan"><i class="fas fa-plus"></i>
                Tambah Pajak Karyawan
            </button>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama Karyawan</th>
                        <th>Golongan</th>
                        <th>Kode</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($pajakkaryawan as $pk) : ?>
                        <tr>
                            <th><?= $no++; ?></th>
                            <td><?= $pk['nik']; ?></td>
                            <td><?= $pk['nama_karyawan']; ?></td>
                            <td><?= $pk['golongan']; ?></td>
                            <td><?= $pk['kode']; ?></td>
                            <td>
                                <a href="" class="badge" style="background-color: #fbff39; color: black;" data-toggle="modal" data-target="#ubahPajakKaryawan<?= $pk['id_pajak']; ?>">ubah</a>
                                <a href="" class="badge" style="background-color: #ff0000; color: black;" data-toggle="modal" data-target="#modal-sm<?= $pk['id_pajak']; ?>">hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>

<!-- Modal tambah -->
<div class="modal fade" id="tambahPajakKaryawan" tabindex="-1" aria-labelledby="tambahPajakKaryawanLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahPajakKaryawanLabel">Tambah Pajak Karyawan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('payroll/pajak/tambah'); ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nik_nama">NIK & Nama Karyawan</label>
                        <select name="nik_nama" id="nik_nama" class="form-control">
                            <option value="">-- Pilih NIK & Nama --</option>
                            <?php foreach ($datakaryawan as $dk) : ?>
                                <option value="<?= $dk['id_karyawan']; ?>"><?= $dk['nik']; ?> - <?= $dk['nama_karyawan'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="golongan_kode">Golongan & Kode</label>
                        <select name="golongan_kode" id="golongan_kode" class="form-control">
                            <option value="">-- Pilih Golongan & Kode --</option>
                            <?php foreach ($datapajak as $dp) : ?>
                                <option value="<?= $dp['id']; ?>"><?= $dp['golongan']; ?> - <?= $dp['kode'] ?></option>
                            <?php endforeach; ?>
                        </select>
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
<?php foreach ($pajakkaryawan as $pk) : ?>
    <div class="modal fade" id="ubahPajakKaryawan<?= $pk['id_pajak']; ?>" tabindex="-1" aria-labelledby="ubahPajakKaryawanLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahPajakKaryawanLabel">Tambah Pajak Karyawan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('payroll/pajak/ubah'); ?>" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?= $pk['id_pajak']; ?>">
                            <label for="nik_nama">NIK & Nama Karyawan</label>
                            <select name="nik_nama" id="nik_nama" class="form-control">
                                <option value="">-- Pilih NIK & Nama --</option>
                                <?php foreach ($datakaryawan as $dk) : ?>
                                    <?php if ($dk['id_karyawan'] == $pk['id_datakaryawan']) : ?>
                                        <option value="<?= $dk['id_karyawan']; ?>" selected><?= $dk['nik']; ?> - <?= $dk['nama_karyawan'] ?></option>
                                    <?php else : ?>
                                        <option value="<?= $dk['id_karyawan']; ?>"><?= $dk['nik']; ?> - <?= $dk['nama_karyawan'] ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="golongan_kode">Golongan & Kode</label>
                            <select name="golongan_kode" id="golongan_kode" class="form-control">
                                <option value="">-- Pilih Golongan & Kode --</option>
                                <?php foreach ($datapajak as $dp) : ?>
                                    <?php if ($dp['id'] == $pk['id_datapajak']) : ?>
                                        <option value="<?= $dp['id']; ?>" selected><?= $dp['golongan']; ?> - <?= $dp['kode'] ?></option>
                                    <?php else : ?>
                                        <option value="<?= $dp['id']; ?>"><?= $dp['golongan']; ?> - <?= $dp['kode'] ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
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
<?php foreach ($pajakkaryawan as $pk) : ?>
    <div class="modal fade" id="modal-sm<?= $pk['id_pajak']; ?>">
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
                    <a href="<?= base_url() ?>payroll/pajak/hapus/<?= $pk['id_pajak']  ?>" type="submit" class="btn btn-primary">Ya</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach; ?>