<div class="container-fluid">

    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4">
                    <?php if (validation_errors()) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= validation_errors(); ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <?= $this->session->flashdata('message'); ?>
                </div>
            </div>
            <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#tambahdatasoal"><i
                    class="fas fa-plus"></i>
                Tambah Data
            </button>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Posisi</th>
                        <th>Tanggal Ujian</th>
                        <th>Jam Ujian</th>
                        <th>Jenis Ujian</th>
                        <th>Durasi Ujian</th>
                        <th>Soal</th>
                        <th>Jawaban</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($filesoal as $dk) : ?>
                    <tr>
                        <th><?= $no++; ?></th>
                        <td><?= $dk['nama_karyawan']; ?></td>
                        <td><?= $dk['nama_posisi']; ?></td>
                        <td><?= $dk['jenis_ujian']; ?></td>
                        <td><?= $dk['tanggal_ujian']; ?></td>
                        <td><?= $dk['jam_ujian']; ?></td>
                        <td><?= $dk['durasi_ujian']; ?></td>
                        <td><?= $dk['timer_ujian']; ?></td>
                        <td><?= $dk['file_soal']; ?></td>
                        <td><a href="<?php echo base_url('training/dataadmin/download_file/' . $dk['file']); ?>"><span
                                    class="glyphicon glyphicon-download-alt">Download Dokumen</a></td>
                    </tr>
                    <td>
                        <button type="button" class="badge" style="color: black; background-color: gold;"
                            data-toggle="modal" data-target="#ubahDataKaryawan<?= $dk['id_soal']; ?>"><i
                                class="fas fa-edit"></i> Edit</button>
                        <button type="button" class="btn btn-danger"
                            style="font-size: 12px; color: white; background-color:  #ff0000;" data-toggle="modal"
                            data-target="#modal-sm<?= $dk['id_soal'] ?>">hapus</button>
                    </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>

<!-- modal untuk tambah data -->
<div class="modal fade" id="tambahdatasoal" tabindex="-1" aria-labelledby="tambahdatasoalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahdatakeseluruhanLabel">Tambah Data soal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('training/file_soal/tambah') ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Nama">
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">posisi</label>
                        <div class="form-group">
                            <label>Posisi</label>
                            <select class="form-control" name="posisi">
                                <option value="">-- Pilih Posisi --</option>
                                <?php foreach ($dataposisi as $dp) : ?>
                                <option value="<?= $dp['id_posisi']; ?>"><?= $dp['nama_posisi']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Tanggal Ujian</label>
                        <div class="col-sm-10">
                            <div class="input-group date">
                                <input type="date" class="form-control pull-right" id="date" name="tanggal"
                                    placeholder="2019-12-30" autocomplete="off" required="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Jam Ujian</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input type="time" class="form-control" id="time" name="jam" required="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Jenis Ujian</label>
                        <div class="form-group">
                            <select class="form-control" name="jenis_ujian">
                                <option value="">-- Pilih jenis ujian --</option>
                                <?php foreach ($jenis_ujian as $a) : ?>
                                <option value="<?= $a['id_jenis_ujian']; ?>"><?= $a['jenis_ujian']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Durasi Ujian</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="durasi_ujian"
                                placeholder="Masukan Waktu Lama Ujian dalam Menit" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="dokumen">Soal</label>
                        <input type="file" class="form-control" name="dokumen soal" placeholder="Masukan Dokumen">
                    </div>
                    <!-- <div class="form-group">
                        <label for="dokumen">Jawaban</label>
                        <input type="file" class="form-control" name="dokumen jawaban" placeholder="Masukan Dokumen">
                    </div> -->
                    <div class="box-footer">
                        <a href="<?= base_url('training/file_soal') ?>" class="btn btn-default btn-flat"><span
                                class="fa fa-arrow-left"></span>
                            Kembali</a>
                        <button type="submit" class="btn btn-primary btn-flat"><span class="fa fa-save"></span>
                            Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Akhir tambah Modal -->

<!-- modal untuk edit data -->
<?php foreach ($filesoal as $dk) : ?>
<div class="modal fade" id="ubahdatasoal" tabindex="-1" aria-labelledby="ubahdatasoalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahdatapesLabel">Tambah Data soal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('training/file_soal/ubah') ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Nama">
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">posisi</label>
                        <div class="col-sm-10">
                            <select class="select2 form-control" name="id_posisi" required="">
                                <option selected="selected" disabled="" value="">- Pilih posisi -</option>
                                <?php foreach ($posisi as $a) { ?>
                                <option value="<?= $a->id_posisi ?>"><?= $a->kode; ?> | <?= $a->nama_posisi; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Tanggal Ujian</label>
                        <div class="col-sm-10">
                            <div class="input-group date">
                                <input type="date" class="form-control pull-right" id="date" name="tanggal"
                                    placeholder="2019-12-30" autocomplete="off" required="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Jam Ujian</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input type="time" class="form-control" id="time" name="jam" required="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Jenis Ujian</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="id_jenis_ujian" required>
                                <option selected="selected" disabled="" value="">- Pilih Jenis Ujian -
                                </option>
                                <?php foreach ($jenis_ujian as $a) { ?>
                                <option value="<?= $a->id_jenis_ujian ?>"><?= $a->jenis_ujian; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Durasi Ujian</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="durasi_ujian"
                                placeholder="Masukan Waktu Lama Ujian dalam Menit" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="dokumen">Soal</label>
                        <input type="file" class="form-control" name="dokumen soal" placeholder="Masukan Dokumen">
                    </div>
                    <div class="form-group">
                        <label for="dokumen">Jawaban</label>
                        <input type="file" class="form-control" name="dokumen jawaban" placeholder="Masukan Dokumen">
                    </div>
                    <div class="box-footer">
                        <a href="<?= base_url('training/file_soal') ?>" class="btn btn-default btn-flat"><span
                                class="fa fa-arrow-left"></span>
                            Kembali</a>
                        <button type="submit" class="btn btn-primary btn-flat"><span class="fa fa-save"></span>
                            Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>


<!-- Modal Hapus -->
<?php foreach ($filesoal as $dk) : ?>
<div class="modal fade" id="modal-sm<?= $dk['id_pes']; ?>" tabindek="-1" role+dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Hapus Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                x
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin untuk menghapus data ?</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn" data-dismiss="modal" style="background-color: #d4d4d4;">Tidak</button>
                <a href="<?= base_url() ?>training/datakeseluruhan/hapus/<?= $dk['id_pes'] ?>" type="submit" class="btn"
                    style="background-color: #ff0000; color: white;">Ya</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<?php endforeach; ?>
<!-- akhir modal hapus -->