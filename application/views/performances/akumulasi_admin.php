<div class="container-fluid">

    <div class="card">
        <div class="card-header" style="color: white; background-color: #cc0000;">
            <h4> Filter Data Akumulasi Penilaian Karyawan</h4>
        </div>

        <form class="form-horizontal">
            <div class="card-body">
                <div class="form-group row">
                    <label for="bulan" class="col-form-label">Bulan: </label>
                    <div class="col-md-2">
                        <select class="form-control select2" name="bulan">
                            <option value="">-- Pilih Bulan--</option>
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>
                    <label for="tahun" class="col-form-label">Tahun: </label>
                    <div class="col-md-2 ml-2">
                        <select class="form-control" name="tahun">
                            <option value="">--Pilih Tahun--</option>
                            <?php $tahun = date('Y');
                            for ($i = 2020; $i < $tahun + 3; $i++) { ?>
                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <?php
                    if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
                        $bulan = $_GET['bulan'];
                        $tahun = $_GET['tahun'];
                        $bulantahun = $bulan . $tahun;
                    } else {
                        $bulan = date('m');
                        $tahun = date('Y');
                        $bulantahun = $bulan . $tahun;

                    }

                    ?>
                    <button type="submit" class="btn btn-outline-success mb-2 ml-auto"><i class="fas fa-eye"> Tampilkan
                            Data
                        </i>
                    </button>


                </div>
        </form>
    </div>

    <div class="alert alert" style="background-color: #cc0000; color: white;">
        Menampilkan Akumulasi Penilaian Bulan:<span class="font-weight-bold">
            <?php echo $bulan ?>
        </span> Tahun:<span class="font-weight-bold">
            <?php echo $tahun ?>
    </div>
    <div class="card">
        <div class="card-body">

            <!-- validation crud -->
            <?php if (validation_errors()): ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-lg-4">
                    <?= $this->session->flashdata('message'); ?>
                </div>
            </div>

            <?php

            $jml_data = COUNT($akumulasi);
            if ($jml_data > 0) { ?>



                <table id="example1" class="table table-bordered table-striped">
                    <thead style="text-align: center;  background-color:#cc0000; color: white;">
                        <tr>
                            <th>No</th>
                            <th>NIK & Nama Karyawan</th>
                            <th>Aksi</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        <?php foreach ($akumulasi as $ak): ?>
                            <tr style="text-align: center;">
                                <th>
                                    <?= $no++; ?>
                                </th>

                                <td>
                                    <?= $ak['nik'],
                                        $ak['nama_karyawan']; ?>
                                </td>
                                <td>
                                    <a href="<?= base_url() ?>performances/akumulasi/detail/<?= $ak['nik'] ?>" type="button"
                                        style="background-color: #d4d4d4" ; class="btn btn-Info">
                                        Detail
                                    </a>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <span class="badge badge-danger"><i class="fas fa-info-circle"></i>
                    Data masih kosong, silahkan mengisi form penilaian!</span>
            <?php } ?>
        </div>
    </div>
    <!-- /.card-body -->
</div>