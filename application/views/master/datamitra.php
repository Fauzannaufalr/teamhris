<div class="container-fluid">

    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <button type="button" class="btn btn-outline-success mb-2" data-toggle="modal" data-target="#tambahDataMitra"><i class="fas fa-plus"></i>
                Tambah Mitra
            </button>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Perusahaan</th>
                        <th>NIK</th>
                        <th>Nama Karyawan</th>
                        <th>Posisi</th>
                        <th>Email</th>
                        <th>Tanggal Masuk</th>
                        <th>Tanggal Keluar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($datamitra as $m) : ?>
                        <tr>
                            <th><?= $no++; ?></th>
                            <td><?= $m['nama_perusahaan']; ?></td>
                            <td><?= $m['nik']; ?></td>
                            <td><?= $m['nama_karyawan']; ?></td>
                            <td><?= $m['posisi']; ?></td>
                            <td><?= $m['email']; ?></td>
                            <td><?= $m['tanggal_masuk']; ?></td>
                            <td><?= $m['tanggal_keluar']; ?></td>
                            <td>
                                <a href="" class="badge bg-success">edit</a>
                                <a href="<?= base_url() ?>master/DataKaryawan/hapus/<?= $k['id']  ?>" class="badge bg-danger">delete</a>
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
            <form action="" method="POST">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="perusahaan">Nama Perusahaan</label>
                        <input type="text" class="form-control" id="perusahaan" placeholder="Masukan Nama Perusahaan">
                    </div>
                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" class="form-control" id="nik" placeholder="Masukan NIK">
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Karyawan</label>
                        <input type="text" class="form-control" id="nama" placeholder="Masukan Nama Karyawan">
                    </div>
                    <div class="form-group">
                        <label>Posisi</label>
                        <select class="form-control">
                            <option>-- Pilih Posisi --</option>
                            <option>option 2</option>
                            <option>option 3</option>
                            <option>option 4</option>
                            <option>option 5</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Masuk:</label>
                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" />
                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Keluar:</label>
                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" />
                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
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
</div>