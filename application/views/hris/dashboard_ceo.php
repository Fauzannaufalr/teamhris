<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-6">

            <div class="small-box bg-info">
                <div class="inner">
                    <h3>
                        <?= $bariskaryawan; ?>
                    </h3>
                    <p>Jumlah Karyawan</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="<?= base_url('master/datakaryawan'); ?>" class="small-box-footer">Info Lengkap <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>
                        <?= $barisposisi; ?>
                    </h3>
                    <p>Jumlah Posisi</p>
                </div>
                <div class="icon">
                    <i class="fas fa-briefcase"></i>
                </div>
                <a href="<?= base_url('master/dataposisi'); ?>" class="small-box-footer">Info Lengkap <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>
                        <?= $barismitra; ?>
                    </h3>
                    <p>Jumlah Mitra</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-lock"></i>
                </div>
                <a href="<?= base_url('master/datamitra'); ?>" class="small-box-footer">Info Lengkap <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>65</h3>
                    <p>Jumlah Pelamar</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <a href="#" class="small-box-footer">Info Lengkap <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <?php switch (date('m')) {
        case '01':
            $bulan = 'Januari';
            break;
        case '02':
            $bulan = 'Februari';
            break;
        case '03':
            $bulan = 'Maret';
            break;
        case '04':
            $bulan = 'April';
            break;
        case '05':
            $bulan = 'Mei';
            break;
        case '06':
            $bulan = 'Juni';
            break;
        case '07':
            $bulan = 'Juli';
            break;
        case '08':
            $bulan = 'Agustus';
            break;
        case '09':
            $bulan = 'September';
            break;
        case '10':
            $bulan = 'Oktober';
            break;
        case '11':
            $bulan = 'November';
            break;
        case '12':
            $bulan = 'Desember';
            break;
    } ?>
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header" style="background-color: #cc0000;">
                    <h3 class="card-title" style="color: white;">Laporan Gaji Karyawan</h3>
                </div>
                <div class="card-body">
                    <h5>Bulan
                        <?= $bulan; ?>
                    </h5>
                    <div class="col-lg-12">
                        <canvas id="karyawan"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header" style="background-color: #cc0000;">
                    <h3 class="card-title" style="color: white;">Laporan Rate Mitra</h3>
                </div>
                <div class="card-body">
                    <h5>Bulan
                        <?= $bulan; ?>
                    </h5>
                    <div class="col-lg-12">
                        <canvas id="mitra"></canvas>
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

                        foreach ($akumulasi as $ak):
                            if ($nik === $ak['nik'] && $level !== "hc")
                                continue;
                            $nilaiakumulasi = (($ak['total_nilai_kuesioner']) + ($ak['total_nilai_kinerja'])) / 2; ?>
                            <tr style="text-align: center;">
                                <th>
                                    <?= $no++; ?>
                                </th>
                                <td>
                                    <?= $ak['tanggal'] ?>
                                </td>
                                <td>
                                    <?= $ak['nik'], "<br>" .
                                        $ak['nama_karyawan']; ?>
                                </td>
                                <td>
                                    <?= $nilaiakumulasi ?>
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
                Data penilaian masih kosong.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script>
    const a = <?= $laporan_gk[0]['Sudah'] ?>;
    const b = <?= $laporan_gk[0]['Belum'] ?>;

    const karyawan = document.getElementById('karyawan');
    const d_karyawan = {
        labels: [
            'Sudah dibayar',
            'Belum dibayar'
        ],
        datasets: [{
            label: 'Gaji Karyawan',
            data: [a, b],
            backgroundColor: [
                '#28a745',
                'rgb(255, 205, 86)'
            ],
            hoverOffset: 4
        }]
    };

    new Chart(karyawan, {
        type: 'pie',
        data: d_karyawan,
        options: {
            legend: {
                display: true,
                labels: {
                    display: false,
                    fontSize: 10
                }
            },
            tooltips: {
                callbacks: {
                    label: function (tooltipItem, data) {
                        var totalData = data['datasets'][0]['data'][tooltipItem['index']];
                        if (parseInt(totalData) >= 1000) {
                            return data['labels'][tooltipItem['index']] + ': Rp ' + totalData.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        } else {
                            return 'Rp ' + totalData;
                        }
                    }
                }
            }
        }
    });

    const c = <?= $laporan_rm[0]['Sudah'] ?>;
    const d = <?= $laporan_rm[0]['Belum'] ?>;
    const mitra = document.getElementById('mitra');
    const d_mitra = {
        labels: [
            'Sudah dibayar',
            'Belum dibayar'
        ],
        datasets: [{
            label: 'My First Dataset',
            data: [c, d],
            backgroundColor: [
                '#28a745',
                'rgb(255, 205, 86)'
            ],
            hoverOffset: 4
        }]
    };

    new Chart(mitra, {
        type: 'pie',
        data: d_mitra,
        options: {
            legend: {
                display: true,
                labels: {
                    display: false,
                    fontSize: 10
                }
            },
            tooltips: {
                callbacks: {
                    label: function (tooltipItem, data) {
                        var totalData = data['datasets'][0]['data'][tooltipItem['index']];
                        if (parseInt(totalData) >= 1000) {
                            return data['labels'][tooltipItem['index']] + ': Rp ' + totalData.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        } else {
                            return 'Rp ' + totalData;
                        }
                    }
                }
            }
        }
    });
</script>