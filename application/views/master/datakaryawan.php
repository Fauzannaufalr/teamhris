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
            <button type="button" class="btn btn-outline-success mb-2" data-toggle="modal" data-target="#tambahDataKaryawan"><i class="fas fa-plus"></i>
                Tambah Karyawan
            </button>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama Karyawan</th>
                        <th>Posisi</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Gaji Pokok</th>
                        <th>Level</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($datakaryawan as $k) : ?>
                        <tr>
                            <th><?= $no++; ?></th>
                            <td><?= $k['nik']; ?></td>
                            <td><?= $k['nama_karyawan']; ?></td>
                            <td><?= $k['nama_posisi']; ?></td>
                            <td><?= $k['email']; ?></td>
                            <td><?= $k['status']; ?></td>
                            <td><?= $k['gajipokok']; ?></td>
                            <td><?= $k['level']; ?></td>
                            <td><?= $k['foto']; ?></td>
                            <td>
                            <button type="button" class="btn btn-outline-success mb-2" data-toggle="modal" data-target="#ubahDataKaryawan<?= $k->id_karyawan ?>">
                Edit
            </button>
                                <a href="<?= base_url() ?>master/DataKaryawan/hapus/<?= $k['id_karyawan']  ?>" class="badge bg-danger">delete</a>
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
<div class="modal fade" id="tambahDataKaryawan" tabindex="-1" aria-labelledby="tambahDataKaryawanLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahDataKaryawanLabel">Tambah Data Karyawan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('master/datakaryawan/tambah')?>" method="POST">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" class="form-control" id="nik" name="nik" placeholder="Masukan NIK">
                    </div>
                    <div class="form-group">
                        <label for="nama_karyawan">Nama Karyawan</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Nama Karyawan">
                    </div>
                    <div class="form-group">
                        <label>Posisi</label>
                        <select class="form-control" name="posisi">
                            <option>-- Pilih Posisi --</option>
                            <?php foreach ($datakaryawan as $k) : ?>   
                            <option value="<?= $k['id_posisi']; ?>"><?= $k['nama_posisi']; ?></option>
                            <?php  endforeach; ?>
                        </select>
                    </div>  
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email"class="form-control" id="email">
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <input type="text" name="status" class="form-control" id="status">
                    </div>
                    <div class="form-group">
                        <label for="gaji">Gaji Pokok</label>
                        <input type="text" name="gajipokok" class="form-control" id="gajipokok">
                    </div>
                    <div class="form-group">
                        <label for="gaji">Password</label>
                        <input type="text" name="password" class="form-control" id="password">
                    </div>
                    <div class="form-group">
                        <label for="level">Level</label>
                        <input type="text" name="level" class="form-control" id="level">
                    </div>
                    <div class="form-group">
                        <label for="foto">Foto</label>
                        <input type="file" name="foto" class="form-control" id="foto">
                    </div>
                   <!-- modal footer  -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-danger">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal untuk edit data -->

<!-- Modal -->
<?php foreach($datakaryawan as $k) : ?>
<div class="modal fade" id="ubahDataKaryawan<?= $k->id_karyawan ?>" tabindex="-1" aria-labelledby="editDataKaryawanLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDataKaryawanLabel">Edit Data Karyawan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('master/datakaryawan/edit'); ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                          <label for="nik">NIK</label>
                        <input type="hidden" class="form-control" id="nik" name="nik" value="<?= $k->id_karyawan; ?>">
                        <input type="text" class="form-control" id="nik" name="nik" value="<?= $k->nik; ?>">
                    </div>
                    <div class="form-group">
                        <label for="nama_karyawan">Nama Karyawan</label>
                        <input type="text" class="form-control" id="nama_karyawan" name="nama" value="<?= $k->nama_karyawan; ?>">
                    </div>
                    <div class="form-group">
                        <label>Posisi</label>
                        <select class="form-control" id="posisi" name="posisi" value="<?= $k->posisi; ?>">
                            <option>-- Pilih Posisi --</option>
                            <?php foreach ($datakaryawan as $k) : ?>   
                            <option value="<?= $k['id_posisi']; ?>"><?= $k['nama_posisi']; ?></option>
                            <?php  endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="<?= $k->email; ?>">
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <input type="text" class="form-control" id="status" name="status" value="<?= $k->status; ?>">
                    </div>
                    <div class="form-group">
                        <label for="gaji">Gaji Pokok</label>
                        <input type="text" class="form-control" id="gaji" name="gajipokok" value="<?= $k->gajipokok; ?>">
                    </div>
                    <div class="form-group">
                        <label for="level">Level</label>
                        <input type="text" class="form-control" id="level" name="level" value="<?= $k->level; ?>">
                    </div>
                    <div class="form-group">
                        <label for="foto">Foto</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="foto" name="foto" value="<?= $k->foto; ?>">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-danger">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div> <?php endforeach; ?>

<div class="modal fade" id="modal-sm">
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
                <a href="<?= base_url() ?>master/Datakaryawan/hapus/<?= $k['id_karyawan']  ?>" type="submit" class="btn btn-primary">Ya</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>