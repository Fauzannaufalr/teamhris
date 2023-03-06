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
                    <?php foreach ($pelamar as $xz) : ?>
                        <tr>
                            <th><?= $no++; ?></th>
                            <td><?= $bs['nama_posisi']; ?></td>
                            <td><?= $bs['email']; ?></td>
                            <td><?= $bs['file_cv']; ?></td>
                            <td><?= $bs['status']; ?></td>
                            <td><?= $bs['nilai']; ?></td>
                            <td>
                                <button type="button" class="btn btn-default" style="font-size: 14px; color: black; background-color: #fbff39;">Jadwalkan Interview</button>
                                <button type="button" class="btn btn-danger" style="font-size: 12px; color: white; background-color:  #ff0000;" data-toggle="modal" data-target="#modal-sm<?= $bs['id_pekerjaan'] ?>">hapus</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>