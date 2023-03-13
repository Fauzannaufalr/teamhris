<div class="container-fluid">

    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4">
                    <?php if (validation_errors()) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= validation_errors(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <?= $this->session->flashdata('message'); ?>
                </div>
            </div>
            <button type="button" class="btn btn-outline-success mb-2" data-toggle="modal" data-target="#tambahPerhitungan"><i class="fas fa-plus"></i>
                Tambah Perhitungan Gaji
            </button>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama Karyawan</th>
                        <th>Tj. Kinerja</th>
                        <th>Tj. Fungsional</th>
                        <th>Tj. Jabatan</th>
                        <th>Potongan</th>
                        <th>Bonus</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($perhitungan as $pg) : ?>
                        <tr>
                            <th><?= $no++; ?></th>
                            <td><?= $pg['nik']; ?></td>
                            <td><?= $pg['nama_karyawan']; ?></td>
                            <td>Rp <?= number_format($pg['t_kinerja'], 0, ',', '.'); ?></td>
                            <td>Rp <?= number_format($pg['t_fungsional'], 0, ',', '.'); ?></td>
                            <td>Rp <?= number_format($pg['t_jabatan'], 0, ',', '.'); ?></td>
                            <td>Rp <?= number_format($pg['potongan'], 0, ',', '.'); ?></td>
                            <td>Rp <?= number_format($pg['bonus'], 0, ',', '.'); ?></td>
                            <td style="text-align: center;">
                                <a href="" class="badge" style="background-color: #fbff39; color: black;" data-toggle="modal" data-target="#ubahPerhitungan<?= $pg['id_perhitungan']; ?>">ubah</a>
                                <a href="" class="badge" style="background-color: #ff0000; color: white;" data-toggle="modal" data-target="#modal-sm<?= $pg['id_perhitungan']; ?>">hapus</a>
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
<div class="modal fade" id="tambahPerhitungan" tabindex="-1" aria-labelledby="tambahPerhitunganLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahPerhitunganLabel">Tambah Perhitungan Gaji Karyawan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('payroll/perhitungan/tambah'); ?>" method="POST">
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
                        <label for="t_kinerja">Tunjangan Kinerja</label>
                        <input type="text" class="form-control" id="t_kinerja" name="t_kinerja" placeholder="Masukan tunjangan kinerja">
                    </div>
                    <div class="form-group">
                        <label for="t_fungsional">Tunjangan Fungsional</label>
                        <input type="text" class="form-control" id="t_fungsional" name="t_fungsional" placeholder="Masukan tunjangan fungsional">
                    </div>
                    <div class="form-group">
                        <label for="t_jabatan">Tunjangan Jabatan</label>
                        <input type="text" class="form-control" id="t_jabatan" name="t_jabatan" placeholder="Masukan tunjangan jabatan">
                    </div>
                    <div class="form-group">
                        <label for="potongan">Potongan</label>
                        <input type="text" class="form-control" id="potongan" name="potongan" placeholder="Masukan potongan">
                    </div>
                    <div class="form-group">
                        <label for="bonus">Bonus</label>
                        <input type="text" class="form-control" id="bonus" name="bonus" placeholder="Masukan bonus">
                    </div>
                </div>
                <div class=" modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-danger">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal ubah -->
<?php foreach ($perhitungan as $pg) : ?>
    <div class="modal fade" id="ubahPerhitungan<?= $pg['id_perhitungan']; ?>" tabindex="-1" aria-labelledby="ubahPerhitunganLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahPerhitunganLabel">Ubah Perhitungan Gaji Karyawan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('payroll/perhitungan/ubah'); ?>" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="id" value="<?= $pg['id_perhitungan']; ?>">
                        <div class="form-group">
                            <label for="nik_nama">NIK & Nama Karyawan</label>
                            <select name="nik_nama" id="nik_nama" class="form-control">
                                <option value="">-- Pilih NIK & Nama --</option>
                                <?php foreach ($datakaryawan as $dk) : ?>
                                    <?php if ($dk['id_karyawan'] == $pg['id_datakaryawan']) : ?>
                                        <option value="<?= $dk['id_karyawan']; ?>" selected><?= $dk['nik']; ?> - <?= $dk['nama_karyawan'] ?></option>
                                    <?php else : ?>
                                        <option value="<?= $dk['id_karyawan']; ?>"><?= $dk['nik']; ?> - <?= $dk['nama_karyawan'] ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="t_kinerja">Tunjangan Kinerja</label>
                            <input type="text" class="form-control" id="t_kinerja" name="t_kinerja" value="<?= $pg['t_kinerja']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="t_fungsional">Tunjangan Fungsional</label>
                            <input type="text" class="form-control" id="t_fungsional" name="t_fungsional" value="<?= $pg['t_fungsional']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="t_jabatan">Tunjangan Jabatan</label>
                            <input type="text" class="form-control" id="t_jabatan" name="t_jabatan" value="<?= $pg['t_jabatan']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="potongan">Potongan</label>
                            <input type="text" class="form-control" id="potongan" name="potongan" value="<?= $pg['potongan']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="bonus">Bonus</label>
                            <input type="text" class="form-control" id="bonus" name="bonus" value="<?= $pg['bonus']; ?>">
                        </div>
                    </div>
                    <div class=" modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-danger">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal hapus -->
<?php foreach ($perhitungan as $pg) : ?>
    <div class="modal fade" id="modal-sm<?= $pg['id_perhitungan']; ?>">
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
                    <a href="<?= base_url() ?>payroll/perhitungan/hapus/<?= $pg['id_perhitungan']  ?>" type="submit" class="btn btn-primary">Ya</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach; ?>