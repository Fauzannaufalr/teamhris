<div class="row">
        <div class="col-md-12">
            <div class="box box-success" style="overflow-x: scroll;">
                <div class="box-header">
                    <center><h4 class="box-title">Daftar Soal Ujian</h4></center>
                </div>
                <form action="" method="get" class="form-horizontal">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">posisi</label>
                            <div class="col-sm-10">
                                <select class="select2 form-control" name="id" required="">
                                    <option selected="selected" disabled="">- Pilih posisi -</option>
                                    <?php foreach ($kelas as $a) { ?>
                                        <option value="<?= $a->id_matapelajaran ?>"><?= $a->id_posisi; ?> | <?= $a->nama_matapelajaran; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-10">
                                <a href="<?= base_url('soal'); ?>" class="btn btn-default btn-flat"><span class="fa fa-refresh"></span> Refresh</a>
                                <button type="submit" class="btn btn-primary btn-flat" title="Filter Data Soal Ujian"><span class="fa fa-filter"></span> Filter</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">

                    </div>
                    <!-- /.box-footer -->
                </form>

            </div>
            <?= $this->session->flashdata('message'); ?>
            <!-- Default box -->
             <div class="box box-success" style="overflow-x: scroll;">
            <div class="box-header">
                <h3 class="box-title"></h3>
                
                <a href="<?= base_url('training/soal_ujian') ?>"><button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#modal-default"><span class="fa fa-plus"></span> Tambah</button></a>

                <a href="<?php echo base_url('DataPosisi'); ?>"><button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#" ><span ></span>Data Posisi</button></a>
            </div>

                    <table id="data" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="1%">No</th>
                                <th width="10%">KODE </th>
                                <th width="20%">MATA PELAJARAN</th>
                                <th>SOAL UJIAN</th>
                                <th width="13%">KUNCI JAWABAN</th>
                                <th width="8%">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                       

                                    </td>
                                    <td><b></b></td>
                                    <td>
                                        <a href="" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-edit" title="Ubah"></span></a> |
                                        <a href="" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash" onclick="return confirm('Apakah yakin data soal ini akan di hapus?')" title="Hapus"></span></a>
                                    </td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.col-->
        </div>