<div class="row">
    <div class="col-md-12">

        <?= $this->session->flashdata('message'); ?>
    </div>

    <!-- /. modal tambah data siswa  -->
    <div class="col-md-12">
        <div class="box box-success" style="overflow-x: scroll;">
            <div class="box-header with-border">
                <center>
                    <h3 class="box-title">Tambah Peserta Ujian</h3>
                </center>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="" method="get">
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Pilih Kelas</label>

                        <div class="col-sm-10">
                            <select class="select2 form-control" name="kelas" required="">
                                <option selected="selected" disabled="" value="">- Pilih Kelas -</option>
                                <?php foreach ($kelas as $a) { ?>
                                <option value="<?= $a->id_kelas ?>"><?= $a->nama_kelas; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label"></label>

                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary btn-flat" title="Pilih Kelas">Pilih
                                Kelas</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- /.col-->


    <div class="col-md-12">
        <div class="box box-success" style="overflow-x: scroll;">
            <form class="form-horizontal" action="<?= base_url('peserta_tambah/insert_'); ?>" method="post">
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">posisi</label>
                        <div class="col-sm-10">
                            <select class="select2 form-control" name="mapel" required="">
                                <option selected="selected" disabled="" value="">- Pilih posisi -</option>

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
                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                                <input type="text" class="form-control" id="time" name="jam" required="">
                            </div>
                        </div>
                    </div>




                    <div class="form-group">
                        <label class="col-sm-2 control-label">Jenis Ujian</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="jenis_ujian" required>
                                <option selected="selected" disabled="" value="">- Pilih Jenis Ujian -</option>
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



                </div>
                <!-- /.box-body -->

                <div class="box-body">
                    <table id="data" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="1%">No</th>
                                <th>Nama karyawan</th>
                                <th>NIK</th>
                                <th>Kelas</th>
                                <th width="13%">
                                    <input type="checkbox" class="check-all" id="cek-semua" /> Pilih Semua
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <input type="checkbox" name="id[]" value="" />
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>

                <div class="box-footer">
                    <a href="<?= base_url('peserta') ?>" class="btn btn-default btn-flat"><span
                            class="fa fa-arrow-left"></span> Kembali</a>
                    <button type="submit" class="btn btn-primary btn-flat"><span class="fa fa-save"></span>
                        Simpan</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
    <!-- /.col-->
</div>