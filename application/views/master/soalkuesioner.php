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
            <button type="button" class="btn btn-outline-success mb-2" data-toggle="modal" data-target="#tambahSoalKuesioner"><i class="fas fa-plus"></i>
                Tambah Pertanyaan
            </button>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pertanyaan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($soalkuesioner as $s) : ?>
                        <tr>
                            <th><?= $no++; ?></th>
                            <td><?= $s['kuesioner']; ?></td>
                            <td>
                                <a href="" class="badge bg-success">edit</a>
                                <a href="<?= base_url() ?>master/SoalKuesioner/hapus/<?= $s['id_kuesioner'] ?>" class="badge bg-danger">delete</a>
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
<div class="modal fade" id="tambahSoalKuesioner" tabindex="-1" aria-labelledby="tambahSoalKuesionerLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahSoalKuesionerLabel">Tambah Soal Kuesioner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('master/soalkuesioner/tambah'); ?>" method="POST">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="kuesioner">Pertanyaan</label>
                        <input type="text" name="kuesioner" class="form-control" id="kuesioner" placeholder="Masukan Pertanyaan">
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-danger">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
