<div class="container-fluid">

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header" style="background-color: #8b0000;">
                    <h3 class="card-title" style="color: white;">Aspek Penilaian</h3>
                </div>
                <div class="card-body">
                    <div class="col-lg-7">
                        <canvas id="karyawan"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header" style="background-color: #8b0000;">
                    <h3 class="card-title" style="color: white;">Laporan Penilaian</h3>
                </div>
                <div class="card-body">
                    <h5>Bulan
                    </h5>
                    <div class="col-lg-12">
                        <canvas id="nilai"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header" style="color: white; background-color: #8b0000;">
            <h4> Filter Data Penilaian Karyawan</h4>
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
                        $bulantahun = $bulan . "/" . $tahun;
                    } else {
                        $bulan = date('m');
                        $tahun = date('Y');
                        $bulantahun = $bulan . "/" . $tahun;

                    }

                    ?>
                    <button type="submit" class="btn btn-outline-success ml-auto"><i class="fas fa-eye"> Tampilkan
                            Data
                        </i>
                    </button>

                    <?php if (count($akumulasi) > 0) { ?>
                        <a class="btn btn-outline-success ml-2"
                            href="<?= base_url('Hris/cetakPdfKaryawan?bulan=' . $bulan), '&tahun=' . $tahun ?>"><i
                                class="fas fa-print"></i> Cetak PDF</a>
                        <a class="btn btn-outline-success ml-2"
                            href="<?= base_url('Hris/cetakExcelKaryawan?bulan=' . $bulan), '&tahun=' . $tahun ?>"><i
                                class="fas fa-print"></i> Cetak Excel</a>
                    <?php } else { ?>
                        <button type="button" class="btn btn-outline-success ml-2" data-toggle="modal"
                            data-target="#exampleModal"><i class="fas fa-print"></i> Cetak PDF</button>
                        <button type="button" class="btn btn-outline-success ml-2" data-toggle="modal"
                            data-target="#exampleModal"><i class="fas fa-print"></i> Cetak Excel</button>
                    <?php } ?>

                </div>
        </form>
    </div>

    <div class="alert alert" style="background-color: #8b0000; color: white;">
        Menampilkan Penilaian Karyawan Bulan:<span class="font-weight-bold">
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
                    <thead style="text-align: center;  background-color:#8b0000; color: white;">
                        <tr>
                            <th>No</th>
                            <th>Bulan/Tahun</th>
                            <th>Karyawan</th>
                            <th>Nilai</th>
                            <th>Kategorisasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        <?php
                        $nik = $this->session->userdata("nik");
                        $level = $this->session->userdata("level");
                        $arr_char = [];
                        foreach ($akumulasi as $ak):
                            if ($nik !== $ak['nik'] && $level !== "hc") {
                                continue;
                            }
                            $nilaiakumulasi = (($ak['total_nilai_kuesioner']) + ($ak['total_nilai_kinerja'])) / 2; ?>
                            <tr style="text-align: center;">
                                <th>
                                    <?= $no++; ?>
                                </th>
                                <td>
                                    <?= $ak['tanggal'] ?>
                                    <?php
                                    $arr_tgl = explode('/', $ak['tanggal']);
                                    if ($arr_tgl[0] == '01') {
                                        array_push($arr_char, $nilaiakumulasi);
                                    } else {
                                        array_push($arr_char, 0);
                                    }
                                    if ($arr_tgl[0] == '02') {
                                        array_push($arr_char, $nilaiakumulasi);
                                    } else {
                                        array_push($arr_char, 0);
                                    }
                                    if ($arr_tgl[0] == '03') {
                                        array_push($arr_char, $nilaiakumulasi);
                                    } else {
                                        array_push($arr_char, 0);
                                    }
                                    if ($arr_tgl[0] == '04') {
                                        array_push($arr_char, $nilaiakumulasi);
                                    } else {
                                        array_push($arr_char, 0);
                                    }
                                    if ($arr_tgl[0] == '05') {
                                        array_push($arr_char, $nilaiakumulasi);
                                    } else {
                                        array_push($arr_char, 0);
                                    }
                                    if ($arr_tgl[0] == '06') {
                                        array_push($arr_char, $nilaiakumulasi);
                                    } else {
                                        array_push($arr_char, 0);
                                    }
                                    if ($arr_tgl[0] == '07') {
                                        array_push($arr_char, $nilaiakumulasi);
                                    } else {
                                        array_push($arr_char, 0);
                                    }
                                    if ($arr_tgl[0] == '08') {
                                        array_push($arr_char, $nilaiakumulasi);
                                    } else {
                                        array_push($arr_char, 0);
                                    }
                                    if ($arr_tgl[0] == '09') {
                                        array_push($arr_char, $nilaiakumulasi);
                                    } else {
                                        array_push($arr_char, 0);
                                    }
                                    if ($arr_tgl[0] == '10') {
                                        array_push($arr_char, $nilaiakumulasi);
                                    } else {
                                        array_push($arr_char, 0);
                                    }
                                    if ($arr_tgl[0] == '11') {
                                        array_push($arr_char, $nilaiakumulasi);
                                    } else {
                                        array_push($arr_char, 0);
                                    }
                                    if ($arr_tgl[0] == '12') {
                                        array_push($arr_char, $nilaiakumulasi);
                                    } else {
                                        array_push($arr_char, 0);
                                    }

                                    ?>


                                </td>
                                <td>
                                    <?= $ak['nik'], "<br>" .
                                        $ak['nama_karyawan']; ?>
                                </td>
                                <td>
                                    <?= number_format((float) $nilaiakumulasi, 2, '.', '') ?>
                                </td>
                                <td style="text-align: center;">
                                    <?php
                                    if ($nilaiakumulasi >= 80 && $nilaiakumulasi <= 100) {
                                        echo "Sangat Baik";
                                    } else if ($nilaiakumulasi >= 60 && $nilaiakumulasi <= 79) {
                                        echo "Baik";
                                    } else if ($nilaiakumulasi >= 40 && $nilaiakumulasi <= 59) {
                                        echo "Cukup";
                                    } else if ($nilaiakumulasi >= 20 && $nilaiakumulasi <= 39) {
                                        echo "Kurang";
                                    } else if ($nilaiakumulasi >= 0 && $nilaiakumulasi <= 19) {
                                        echo "Sangat Kurang";
                                    }
                                    ?>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <span class="badge badge-danger"><i class="fas fa-info-circle"></i>
                    Data masih kosong, silahkan memilih bulan dan tahun!</span>
            <?php } ?>
        </div>
    </div>
    <!-- /.card-body -->
</div>

<!-- Modal cetak akumulasi keseluruhan -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Informasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Data Penilaian masih kosong.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const karyawan = document.getElementById('karyawan');
    const d_karyawan = {
        labels: [
            'Sangat Baik : 80 - 100',
            'Baik : 60 - 79',
            'Cukup: 40 - 59',
            'Kurang : 20 - 39',
            'Sangat Kurang : 0 - 19'
        ],
        datasets: [{
            label: 'My First Dataset',
            data: [50, 50, 50, 50, 50],
            backgroundColor: [
                '#28a745',
                'rgb(255, 205, 86)',
                '#cc0000',
                '#8FBC8F',
                '#5F9EA0',

            ],
            hoverOffset: 4
        }]
    };

    new Chart(karyawan, {
        type: 'pie',
        data: d_karyawan
    });
    const test = document.getElementById('nilai');
    const a = <?= $nilai ?>
    <?php
    $text = '';
    for ($i = 0; $i < count($arr_char); $i++) {
        $text .= $arr_char[$i] . ',';
    }
    ?>
    // data nilai kalo bisa berskan data bulan, / nilai bentuk array, nilainya berdsaarkan bulan kalo bisa
    new Chart(test, {
        type: 'bar',
        data: {
            labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            datasets: [{
                label: 'Nilai Akumulasi',
                data: [<?= $text; ?>],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)'
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<script>


</script>