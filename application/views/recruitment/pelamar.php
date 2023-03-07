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
            <div class="dropdown">
                <button class="btn btn-danger dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                    Status Pelamar
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Pelamar</a>
                    <a class="dropdown-item" href="#">Proses Interview</a>
                    <a class="dropdown-item" href="#">Pengerjaan Soal</a>
                    <a class="dropdown-item" href="#">Pelamar Diterima</a>
                    <a class="dropdown-item" href="#">Pelamar Ditolak</a>
                </div>
            </div>
            <br>
            <table id="" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Posisi</th>
                        <th>Email</th>
                        <th>File CV</th>
                        <th>Status</th>
                        <th>Nilai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($pelamar as $ds) : ?>
                        <tr>
                            <th><?= $no++; ?></th>
                            <?php foreach ($dataposisi as $dp) : ?>
                                <?php if ($dp['id_posisi'] == $ds['id_pekerjaan']) : ?>
                                    <td><?= $dp['nama_posisi']; ?></td>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <td><?= $ds['email']; ?></td>
                            <td><?= $ds['file_cv']; ?></td>
                            <td><?= $ds['status']; ?></td>
                            <td><?= $ds['nilai']; ?></td>
                            <td>
                                <button class="badge badge-success" href="#"><i class="fas fa-paper-plane"></i> Jadwalkan Interview</button>
                                <button type="button" class="btn btn-danger" style="font-size: 12px; color: white; background-color:  #ff0000;" data-toggle="modal" data-target="#modal-sm<?= $ds['id_pelamar'] ?>">hapus</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>


<?php foreach ($pelamar as $ds) : ?>
    <div class="modal fade" id="modal-sm<?= $ds['id_pelamar']; ?>" tabindek="-1" role+dialog">
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
                    <button type="button" class="btn" data-dismiss="modal" style="background-color: #d4d4d4;">Tidak</button>
                    <a href="<?= base_url() ?>recruitment/pelamar/hapus/<?= $ds['id_pelamar']  ?>" type="submit" class="btn" style="background-color: #ff0000; color: white;">Ya</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach; ?>