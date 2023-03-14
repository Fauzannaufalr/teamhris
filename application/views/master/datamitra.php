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
            <button type="button" class="btn btn-outline-success mb-2" data-toggle="modal" data-target="#tambahDataMitra"><i class="fas fa-plus"></i>
                Tambah Mitra
            </button>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Perusahaan</th>
                        <th>Nama Karyawan</th>
                        <th>Keahlian</th>
                        <th>Tools</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th>Rate Total</th>
                        <th>Dokumen Kerja Sama</th>
                        <th>Tanggal Masuk</th>
                        <th>Tanggal Keluar</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($datamitra as $dm) : ?>
                        <tr>
                            <th><?= $no++; ?></th>
                            <td><?= $dm['nama_perusahaan']; ?></td>
                            <td><?= $dm['nama_karyawan']; ?></td>
                            <td><?= $dm['keahlian']; ?></td>
                            <td><?= $dm['tools']; ?></td>
                            <td><?= $dm['email']; ?></td>
                            <td><?= $dm['telepon']; ?></td>
                            <td><?= $dm['alamat']; ?></td>
                            <td>Rp <?= number_format($dm['rate_total'], 0, ',', '.'); ?></td>
                            <td><?= $dm['dokumen_kerjasama']; ?></td>
                            <td><?= $dm['tanggal_masuk']; ?></td>
                            <td><?= $dm['tanggal_keluar']; ?></td>
                            <td><?= $dm['status']; ?></td>
                            <td>
                                <button type="button" class="btn btn-default" style="font-size: 14px; color: black; background-color: #ffcc00;" data-toggle="modal" data-target="#ubahDataMitra<?= $dm['id'] ?>">edit</button>
                                <button type="button" class="btn btn-danger" style="font-size: 12px; color: white; background-color:  #cc0000;" data-toggle="modal" data-target="#modal-sm<?= $dm['id'] ?>">hapus</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="tambahDataMitra" tabindex="-1" aria-labelledby="tambahDataMitraLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahDataMitraLabel">Tambah Data Mitra</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('master/datamitra/tambah'); ?>" method="POST">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="nama_perusahaan">Nama Perusahaan</label>
                        <input type="text" class="form-control" id="nama_perusahaan" name="perusahaan" placeholder="Masukan Nama Perusahaan">
                    </div>
                    <div class="form-group">
                        <label for="nama_karyawan">Nama Karyawan</label>
                        <input type="text" class="form-control" id="nama_karyawan" name="nama" placeholder="Masukan Nama Karyawan">
                    </div>
                    <div class="form-group">
                        <label for="keahlian">Keahlian</label>
                        <input type="text" class="form-control" id="keahlian" name="keahlian" placeholder="Masukan keahlian">
                    </div>
                    <div class="form-group">
                        <label for="tools">Tools</label>
                        <input type="text" class="form-control" id="tools" name="tools" placeholder="Masukan tools">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Masukan email">
                    </div>
                    <div class="form-group">
                        <label for="telepon">Telepon</label>
                        <input type="text" class="form-control" id="telepon" name="telepon" placeholder="Masukan telepon">
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukan alamat">
                    </div>
                    <div class="form-group">
                        <label for="rate_total">Rate total</label>
                        <input type="text" class="form-control" id="rate_total" name="rate_total" placeholder="Masukan rate total">
                    </div>
                    <div class="form-group">
                        <label for="dokumen_kerjasama">Dokumen Kerja sama</label>
                        <input type="text" class="form-control" id="dokumen_kerjasama" name="dokumen_kerjasama" placeholder="Masukan link dokumen">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_masuk">Tanggal Masuk</label>
                        <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_keluar">Tanggal Keluar</label>
                        <input type="date" class="form-control" id="tanggal_keluar" name="tanggal_keluar">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-danger">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal edit -->
<?php foreach ($datamitra as $dm) : ?>
    <div class="modal fade" id="ubahDataMitra<?= $dm['id'] ?>" tabindex="-1" aria-labelledby="ubahDataMitraLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahDataMitraLabel">Ubah Data Mitra</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('master/datamitra/ubah'); ?>" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="id" value="<?= $dm['id']; ?>">
                        <div class="form-group">
                            <label for="nama_perusahaan">Nama Perusahaan</label>
                            <input type="text" class="form-control" id="nama_perusahaan" name="perusahaan" value="<?= $dm['nama_perusahaan']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="nama_karyawan">Nama Karyawan</label>
                            <input type="text" class="form-control" id="nama_karyawan" name="nama" value="<?= $dm['nama_karyawan']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="keahlian">Keahlian</label>
                            <input type="text" class="form-control" id="keahlian" name="keahlian" value="<?= $dm['keahlian']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="tools">Tools</label>
                            <input type="text" class="form-control" id="tools" name="tools" value="<?= $dm['tools']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" value="<?= $dm['email']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="telepon">Telepon</label>
                            <input type="text" class="form-control" id="telepon" name="telepon" value="<?= $dm['telepon']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $dm['alamat']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="rate_total">Rate total</label>
                            <input type="text" class="form-control" id="rate_total" name="rate_total" value="<?= $dm['rate_total']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="dokumen_kerjasama">Dokumen Kerja sama</label>
                            <input type="text" class="form-control" id="dokumen_kerjasama" name="dokumen_kerjasama" value="<?= $dm['dokumen_kerjasama']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="tanggal_masuk">Tanggal Masuk</label>
                            <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" value="<?= $dm['tanggal_masuk']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="tanggal_keluar">Tanggal Keluar</label>
                            <input type="date" class="form-control" id="tanggal_keluar" name="tanggal_keluar" value="<?= $dm['tanggal_keluar']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" name="status">
                                <option value="Aktif">Aktif</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-danger">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?php foreach ($datamitra as $dm) : ?>
    <div class="modal fade" id="modal-sm<?= $dm['id'] ?>">
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
                    <a href="<?= base_url() ?>master/datamitra/hapus/<?= $dm['id']  ?>" type="submit" class="btn btn-primary">Ya</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach; ?>