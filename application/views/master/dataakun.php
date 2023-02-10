<div class="container-fluid">
    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModal">
                Tambah Akun
            </button>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Level</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($dataakun as $k) : ?>
                        <tr>
                            <th><?= $no++; ?></th>
                            <td><?= $k['nama']; ?></td>
                            <td><?= $k['username']; ?></td>
                            <td><?= $k['password']; ?></td>
                            <td><?= $k['level']; ?></td>
                            <td>
                                <a href="" class="badge bg-warning">detail</a>
                                <a href="" class="badge bg-success">edit</a>
                                <a href="<?= base_url() ?>master/DataAkun/hapus/<?= $k['id']  ?>" class="badge bg-danger">delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group"><label>Nama Lengkap</label><input type="text" name="nama" class="form-control"></div>
                <div class="form-group"><label>Username</label><input type="text" name="username" class="form-control"></div>
                <div class="form-group"><label>Password</label><input type="hidden" name="password" class="form-control"></div>
                <div class="form-group"><label>Level</label><input type="text" name="level" class="form-control"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>