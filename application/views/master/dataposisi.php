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
            <button type="button" class="btn btn-outline-success mb-2" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i>
                Tambah Posisi
            </button>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Posisi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($dataposisi as $p) : ?>
                        <tr>
                            <th><?= $no++; ?></th>
                            <td><?= $p['nama_posisi']; ?></td>
                            <td>
                                <a href="" class="badge" style="background-color: #fbff39; color: black;">edit</a>
                                <a href="" class="badge" style="background-color: #ff0000; color: black" data-toggle="modal" data-target="#modal-sm">hapus</a>
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
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Posisi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url() ?>master/DataPosisi/tambah/" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="posisi">Posisi</label>
                        <input type="text" class="form-control" name="posisi" id="posisi" placeholder="Masukan Posisi">
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
                <a href="<?= base_url() ?>master/dataposisi/hapus/<?= $p['id_posisi']  ?>" type="submit" class="btn btn-primary">Ya</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>