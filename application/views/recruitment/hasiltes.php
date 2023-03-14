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
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Posisi</th>
                        <th>Email</th>
                        <th>Hasil Tes</th>
                        <th>Nilai PG</th>
                        <th>Nilai Essay</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($hasiltes as $ko) : ?>
                        <tr>
                            <th><?= $no++; ?></th>
                            <?php foreach ($dataposisi as $dp) : ?>
                                <?php if ($dp['id_posisi'] == $ds['id_pekerjaan']) : ?>
                                    <td><?= $dp['nama_posisi']; ?></td>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <td><?= $ko['email']; ?></td>
                            <td><?= $ko['upload']; ?></td>
                            <td><?= $ko['pg']; ?></td>
                            <td><?= $ko['essay']; ?></td>
                            <td><?= $ko['status']; ?></td>
                            <td>
                                <?php if ($ds['status'] == 'pengerjaan soal') : ?>
                                    <button class="badge badge-success" data-toggle="modal" data-target="#nilaiModal<?= $ds['id_hasiltes']; ?>"><i class="fas fa-paper-plane"></i> Beri Nilai</button>
                                <?php elseif ($ds['status'] == 'beri nilai') : ?>
                                    <button class="badge badge-primary" data-toggle="modal" data-target="#jadwalModal<?= $ds['id_hasiltes']; ?>"><i class="far fa-calendar-alt"></i>Jadwalkan Interview lanjutan</button>
                                <?php endif; ?>
                                <button class="badge badge-danger" data-toggle="modal" data-target="#modal-sm<?= $ds['id_hasiltes']; ?>">Hapus</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>