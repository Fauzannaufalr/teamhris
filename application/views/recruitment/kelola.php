<br>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?= $title ?></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahPekerjaanModal">
                Tambah Pekerjaan Baru
            </button>
            <table id="example2" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pekerjaan</th>
                        <th>Kualifikasi</th>
                        <th>Tanggal Berakhir</th>
                        <th>foto</th>
                        <th>Aksi</th>


                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($kelolapekerjaan as $k) : ?>
                        <tr>
                            <th><?= $no++; ?></th>
                            <td><?= $k['nama_pekerjaan']; ?></td>
                            <td><?= $k['kualifikasi']; ?></td>
                            <td><?= $k['tanggal_berakhir']; ?></td>
                            <td><?= $k['img']; ?></td>
                            <td>
                                <a href="" class="badge bg-warning">detail</a>
                                <a href="" class="badge bg-success">edit</a>
                                <a href="<?= base_url() ?>recruitment/kelola/hapus/<?= $k['id']  ?>" class="badge bg-danger">delete</a>
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
<div class="modal fade" id="tambahPekerjaanModal" tabindex="-1" role="dialog" aria-labelledby="tambahPekerjaanModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahPekerjaanModalLabel">Tambah Pekerjaan Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form Tambah Pekerjaan -->
                <form action="" method="post">
                    <div class="form-group">
                        <label for="namaPekerjaan">Nama Pekerjaan</label>
                        <input type="text" class="form-control" id="namaPekerjaan" placeholder="Masukkan Nama Pekerjaan">
                    </div>
                    <div class="form-group">
                        <label for="deskripsiPekerjaan">Kualifikasi</label>
                        <input type="text" class="form-control" id="kualifikasi" placeholder="Masukkan kualifikasi">
                    </div>
                    <div class="form-group">
                        <label for="deskripsiPekerjaan">Tanggal Berakhir</label>
                        <input type="date" class="form-control" id="tanggalberakhir">
                    </div>
                    <div class="form-group">
                        <label for="deskripsiPekerjaan">Foto</label>
                        <input type="file" class="form-control" id="img">
                    </div>
                    <!-- ... tambahkan input lain sesuai dengan data yang ingin ditambahkan ... -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" id="simpanPekerjaan">Simpan</button>
            </div>
        </div>
    </div>
</div>