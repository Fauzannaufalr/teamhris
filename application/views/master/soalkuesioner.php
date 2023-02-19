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
                    <?php foreach ($soalkuesioner as $sk) : ?>
                        <tr>
                            <th><?= $no++; ?></th>
                            <td><?= $sk['kuesioner']; ?></td> 
                            <!-- // kuesioner diambil dari controller -->
                            <td>
                                <a href="" class="badge bg-warning" data-toggle="modal" data-target="">edit</a>
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
<div class="modal fade" id="tambahSoalKuesioner" tabindex="-1" aria-labelledby="tambahSoalKuesionerLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahSoalKuesionerLabel">Tambah Pertanyaan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('master/soalkuesioner/tambah') ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kuesioner">Pertanyaan</label>
                        <input type="text" class="form-control" id="kuesioner" name="kuesioner" placeholder="Masukan Pertanyaan">
                    </div>
                    <!-- modal footer  -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-danger">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
  </div>

    
<!-- Modal Hapus -->
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
                <a href="<?= base_url() ?>master/soalkuesioner/hapus/<?= $sk['id_kuesioner']  ?>" type="submit" class="btn btn-primary">Ya</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- akhir modal hapus -->
</div>
