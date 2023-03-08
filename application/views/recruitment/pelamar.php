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
                                <button class="badge badge-success" href="#" data-toggle="modal" data-target="#sendGoogleMeetLinkModal"><i class="fas fa-paper-plane"></i> Jadwalkan Interview</button>
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




<!-- Send Google Meet Link Modal -->
<div class="modal fade" id="sendGoogleMeetLinkModal" tabindex="-1" role="dialog" aria-labelledby="sendGoogleMeetLinkModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sendGoogleMeetLinkModalLabel">Jadwalkan Interview</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="sendGoogleMeetLinkForm" method="post" action="<?= base_url('send_google_meet_link'); ?>">
                    <div class="form-group">
                        <label for="recipientEmail">Recipient Email</label>
                        <input type="email" class="form-control" id="recipientEmail" name="recipientEmail" required>
                    </div>
                    <div class="form-group">
                        <label for="googleMeetLink">Google Meet Link</label>
                        <input type="text" class="form-control" id="googleMeetLink" name="googleMeetLink" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Send</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>