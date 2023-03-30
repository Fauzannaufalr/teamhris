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
                        <th>File CV</th>
                        <th>Nilai PG</th>
                        <th>Nilai Tes</th>
                        <th>Status</th>
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
                            <td><a href="<?php echo base_url('recruitment/pelamar/download_file/' . $ds['file_cv']); ?>"><span class="glyphicon glyphicon-download-alt">Download CV</a></td>
                            <td><?= $ds['pg']  ?></td>
                            <td><?= $ds['essay']  ?></td>
                            <td><?= $ds['status']; ?></td>
                            <td>
                                <?php if ($ds['status'] == 'pelamar') : ?>
                                    <button class="badge badge-success" data-toggle="modal" data-target="#interviewModal<?= $ds['id_pelamar']; ?>"><i class="fas fa-paper-plane"></i> Jadwalkan Interview</button>
                                <?php elseif ($ds['status'] == 'Proses Interview') : ?>
                                    <button class="badge badge-secondary" data-toggle="modal" data-target="#jadwalModal<?= $ds['id_pelamar']; ?>"><i class="far fa-calendar-alt"></i> Lihat Jadwal</button>
                                    <button class="badge badge-warning" data-toggle="modal" data-target="#soalModal<?= $ds['id_pelamar']; ?>"><i class="fas fa-paper-plane"></i> Kirim Soal</button>
                                <?php elseif ($ds['status'] == 'Proses Pengerjaan Soal') : ?>
                                    <button class="badge badge-primary" data-toggle="modal" data-target="#nilaiModal<?= $ds['id_pelamar']; ?>"><i class="far fa-calendar-alt"></i> Beri Nilai</button>
                                <?php elseif ($ds['status'] == 'Diterima') : ?>
                                <?php endif; ?>
                                <button class="badge badge-danger" data-toggle="modal" data-target="#modal-sm<?= $ds['id_pelamar']; ?>">Hapus</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>



<!-- Modal Hapus -->
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
                    <a href="<?= base_url() ?>recruitment/pelamar/hapus/<?= $ds['id_pelamar'] ?>" type="submit" class="btn" style="background-color: #ff0000; color: white;">Ya</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach; ?>
<!-- akhir modal hapus --






<!-- Modal kirim slip -->
<?php foreach ($pelamar as $ds) : ?>
    <div class="modal fade" id="interviewModal<?= $ds['id_pelamar']; ?>" tabindex="-1" aria-labelledby="interviewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="interviewModalLabel">Jadwalkan Interview</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('recruitment/pelamar/interview/' . $ds['id_pelamar']) ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="email" id="email" value="<?= $ds['email']; ?>">
                        <div class="form-group">
                            <label for="tanggal">Tanggal Interview</label>
                            <input type="datetime-local" class="form-control" id="tanggal" name="tanggal">
                        </div>
                        <div class="form-group">
                            <label for="gmeet">Link Google Meet</label>
                            <input type="text" class="form-control" id="gmeet" name="gmeet">
                        </div>
                        <div class="form-group">
                            <label for="bertemu">Bertemu dengan</label>
                            <input type="text" class="form-control" id="bertemu" name="bertemu">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-danger">Kirim</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>


<?php foreach ($pelamar as $ds) : ?>
    <!-- Modal kirim slip -->
    <div class="modal fade" id="jadwalModal<?= $ds['id_pelamar']; ?>" tabindex="-1" aria-labelledby="jadwalModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="jadwalModalLabel">Lihat Jadwal Interview</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('recruitment/pelamar/interview/' . $ds['id_pelamar']) ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="email" id="email" value="<?= $ds['email']; ?>">
                        <div class="form-group">
                            <label for="tanggal">Tanggal Interview</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal">
                        </div>
                        <div class="form-group">
                            <label for="gmeet">Link Google Meet</label>
                            <input type="text" class="form-control" id="gmeet" name="gmeet">
                        </div>
                        <div class="form-group">
                            <label for="bertemu">Bertemu dengan</label>
                            <input type="text" class="form-control" id="bertemu" name="bertemu">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-danger">Kirim</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>


<?php foreach ($pelamar as $ds) : ?>
    <!-- Modal kirim Soal -->
    <div class="modal fade" id="soalModal<?= $ds['id_pelamar']; ?>" tabindex="-1" aria-labelledby="soalModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="soalModalLabel">Kirim Soal Tes </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('recruitment/pelamar/soal/' . $ds['id_pelamar']) ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="email" id="email" value="<?= $ds['email']; ?>">
                        <div class="form-group">
                            <label>Posisi</label>
                            <select class="form-control" id="posisi" name="posisi">
                                <option>-- Pilih Posisi --</option>
                                <?php foreach ($dataposisi as $dp) : ?>
                                    <option value="<?= $dp['id_posisi']; ?>"><?= $dp['nama_posisi']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pg">Link Soal PG</label>
                            <input type="text" class="form-control" id="pg" name="pg">
                        </div>
                        <div class="form-group">
                            <label for="essay">Soal Essay</label>
                            <input type="file" class="form-control" id="essay" name="essay">
                        </div>
                        <div class="form-group">
                            <label for="linkuploadjawaban">Link Upload Jawaban</label>
                            <input type="text" class="form-control" name="linkuploadjawaban">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-danger">Kirim</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>







<?php foreach ($pelamar as $ds) : ?>
    <!-- Modal kirim Nilai -->
    <div class="modal fade" id="nilaiModal<?= $ds['id_pelamar']; ?>" tabindex="-1" aria-labelledby="nilaiModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="soalModalLabel">Beri nilai dan Surat diterima/ ditolak </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('recruitment/pelamar/nilai/' . $ds['id_pelamar']) ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="email" id="email" value="<?= $ds['email']; ?>">
                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select id="status<?= $ds['id_pelamar']; ?>" name="status<?= $ds['id_pelamar']; ?>" class="form-control" onchange="changeStatus<?= $ds['id_pelamar']; ?>()">
                                <option value="Tidak Lulus">Tidak Lulus</option>
                                <option value="Lulus" selected>Lulus</option>
                            </select>
                        </div>
                        <div id="nilai<?= $ds['id_pelamar']; ?>">

                        </div>
                        <script>
                            function clear<?= $ds['id_pelamar']; ?>() {
                                const nilai = document.getElementById('nilai<?= $ds['id_pelamar']; ?>');
                                nilai.textContent = '';
                            }

                            function changeStatus<?= $ds['id_pelamar']; ?>() {
                                var e = document.getElementById('status<?= $ds['id_pelamar']; ?>');
                                const nilai = document.getElementById('nilai<?= $ds['id_pelamar']; ?>');
                                console.log(nilai);
                                if (e.value == 'Tidak Lulus') {
                                    clear<?= $ds['id_pelamar']; ?>();
                                    const node = document.createElement('div');
                                    node.innerHTML = `
                                    <div class="form-group">
                                        <label for="pg">Beri Nilai pg:</label>
                                        <input type="text"  name="pg" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="essay">Beri Nilai :</label>
                                        <input type="text"  name="essay" class="form-control">
                                    </div>
        
                                    <div class="form-group">
                                        <label for="berkas">Upload Berkas (Ditolak):</label>
                                        <input type="file" id="berkas" name="berkas" class="form-control">
                                    </div>`;

                                    nilai.appendChild(node);
                                } else if (e.value == 'Lulus') {
                                    var e = document.getElementById('status<?= $ds['id_pelamar']; ?>');
                                    clear<?= $ds['id_pelamar']; ?>();
                                    const node = document.createElement('div');
                                    node.innerHTML = `
                                    <div class="form-group">
                                        <label for="nilai">Beri Nilai Pg:</label>
                                        <input type="text" id="nilai" name="nilai" class="form-control">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="nilai">Beri Nilai :</label>
                                        <input type="text" id="nilai" name="nilai" class="form-control">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="berkas">Upload Berkas (Diterima):</label>
                                        <input type="file" id="berkas" name="berkas" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="jadwal">Jadwalkan Interview Lanjutan:</label>
                                        <input type="date" id="jadwal" name="jadwal" class="form-control">
                                    </div>
        
                                    <div class="form-group">
                                        <label for="gmeet">Link Google Meet</label>
                                        <input type="text" id="gmeet" name="gmeet" class="form-control">
                                    </div>`;
                                    nilai.appendChild(node);

                                }
                            }
                            // e.addEventListener('change', changeStatus)
                        </script>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-danger">Kirim</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>