<div class="container-fluid">

    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>

            <?= $this->session->flashdata('message'); ?>
            <button type="button" class="btn btn-outline-success mb-2" data-toggle="modal" data-target="#tambahDataKaryawan"><i class="fas fa-plus"></i>
                Tambah Karyawan
            </button>
            <table id="example1" class="table table-bordered table-striped">
            <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama Karyawan</th>
                        <th>Email</th>
                        <th>Posisi</th>
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
                            <td><?= $k['email']; ?></td>
                            <td><?= $k['nama_posisi']; ?></td>
                            <td><?= $k['status']; ?></td>
                            <td><?= $k['gajipokok']; ?></td>
                            <td><?= $k['level']; ?></td>
                            <td><?= $k['foto']; ?></td>
                            <td>
                                <a href="" class="badge bg-success">edit</a>
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
            <form action="<?= base_url('master/datakaryawan/tambah'); ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" class="form-control" id="nik" name="nik" placeholder="Masukan NIK">
                    </div>
                    <div class="form-group">
                        <label for="nama_karyawan">Nama Karyawan</label>
                        <input type="text" class="form-control" id="nama_karyawan" name="nama" placeholder="Masukan Nama Karyawan">
                    </div>
                    <div class="form-group">
                        <label>Posisi</label>
                        <select class="form-control" id="posisi" name="posisi">
                            <option>-- Pilih Posisi --</option>
                            <?php foreach ($datakaryawan as $p) : ?>   
                            <option value="<?= $p['id_posisi']; ?>"><?= $p['nama_posisi']; ?></option>
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