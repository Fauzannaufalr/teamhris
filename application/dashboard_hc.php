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
                <a href="<?= base_url('master/datakaryawan'); ?>" class="small-box-footer">Info Lengkap <i class="fas fa-arrow-circle-right"></i></a>
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
                <a href="<?= base_url('master/dataposisi'); ?>" class="small-box-footer">Info Lengkap <i class="fas fa-arrow-circle-right"></i></a>
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
                <a href="<?= base_url('master/datamitra'); ?>" class="small-box-footer">Info Lengkap <i class="fas fa-arrow-circle-right"></i></a>
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
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header" style="background-color: #cc0000;">
                    <h3 class="card-title" style="color: white;">Laporan Gaji Bulan <?= $bulan; ?> (Office/Project Base)</h3>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" method="get" action="<?= base_url('hris/filter_per_type'); ?>">
                        <div class="card-body p-0">
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <select class="form-control select2" id="bulan_type" name="bulan_type">
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
                                <div class="col-lg-6">
                                    <select class="form-control select2" id="tahun_type" name="tahun_type">
                                        <?php for ($i = date('Y'); $i >= 2020; $i--) : ?>
                                            <option value="<?= $i ?>"><?= $i ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </form>
                    <div class="col-lg-12">
                        <canvas id="type"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header" style="background-color: #cc0000;">
                    <h3 class="card-title" style="color: white;">Laporan Gaji Karyawan Bulan <?= $bulan; ?></h3>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" method="post" action="<?= base_url('payroll/pengajuangaji/excel'); ?>">
                        <div class="card-body p-0">
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <select class="form-control select2" id="bulan" name="bulan">
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
                                <div class="col-lg-6">
                                    <select class="form-control select2" id="tahun" name="tahun">
                                        <?php for ($i = date('Y'); $i >= 2020; $i--) : ?>
                                            <option value="<?= $i ?>"><?= $i ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </form>
                    <div class="col-lg-12">
                        <canvas id="karyawan"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header" style="background-color: #cc0000;">
                    <h3 class="card-title" style="color: white;">Laporan Rate Mitra Bulan <?= $bulan; ?></h3>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" method="post" action="<?= base_url('payroll/pengajuangaji/excel'); ?>">
                        <div class="card-body p-0">
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <select class="form-control select2" id="bulan" name="bulan">
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
                                <div class="col-lg-6">
                                    <select class="form-control select2" id="tahun" name="tahun">
                                        <?php for ($i = date('Y'); $i >= 2020; $i--) : ?>
                                            <option value="<?= $i ?>"><?= $i ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </form>
                    <div class="col-lg-12">
                        <canvas id="mitra"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table id="example2" class="table table-bordered table-striped" style="text-align: center;">
                <thead style="background-color: #cc0000;">
                    <tr style="color: #ffffff;">
                        <th rowspan="2" style="vertical-align: middle;">Nama Karyawan</th>
                        <th colspan="7">Nilai</th>
                    </tr>
                    <tr style="color: #ffffff;">
                        <th>Januari</th>
                        <th>Februari</th>
                        <th>Maret</th>
                        <th>April</th>
                        <th>Mei</th>
                        <th>Juni</th>
                        <th>Total</th>
                    </tr>
                    <tr style="color: #ffffff;">
                        <th>Karyawan A</th>
                        <th>SB</th>
                        <th>SB</th>
                        <th>B</th>
                        <th>C</th>
                        <th>SB</th>
                        <th>SB</th>
                        <th>SB</th>
                    </tr>
                </thead>
            </table>
            <!-- /.card-body -->
        </div>
    </div>
    <!-- /.card-body -->
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
                    label: function(tooltipItem, data) {
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
                    label: function(tooltipItem, data) {
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

    const e = <?= $laporan_type[0]['Office'] ?>;
    const f = <?= $laporan_type[0]['Project'] ?>;
    const type = document.getElementById('type');
    const d_type = {
        labels: [
            'Office',
            'Project Base'
        ],
        datasets: [{
            label: 'My First Dataset',
            data: [e, f],
            backgroundColor: [
                '#28a745',
                'rgb(255, 205, 86)'
            ],
            hoverOffset: 4
        }]
    };

    new Chart(type, {
        type: 'pie',
        data: d_type,
        options: {
            // maintainAspectRatio: false,
            legend: {
                display: true,
                labels: {
                    display: false,
                    fontSize: 10
                }
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
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

<script type="text/javascript">
    // START TYPE
    $('#bulan_type,#tahun_type').change(function() {
        bulanType = document.getElementById('bulan_type').value;
        tahunType = document.getElementById('tahun_type').value;
        console.log(bulanType);
        console.log(tahunType);
        $.ajax({
            url: '<?= base_url() ?>hris/filter_per_type',
            dataType: 'json',
            type: "POST",
            data: {
                bulanType,
                tahunType
            },
            success: function(result) {

                const e2 = result[0]['Office'];
                const f2 = result[0]['Project'];
                const type = document.getElementById('type');
                const d_type = {
                    labels: [
                        'Office',
                        'Project Base'
                    ],
                    datasets: [{
                        label: 'My First Dataset',
                        data: [e2, f2],
                        backgroundColor: [
                            '#28a745',
                            'rgb(255, 205, 86)'
                        ],
                        hoverOffset: 4
                    }]
                };

                new Chart(type, {
                    type: 'pie',
                    data: d_type,
                    options: {
                        // maintainAspectRatio: false,
                        legend: {
                            display: true,
                            labels: {
                                display: false,
                                fontSize: 10
                            }
                        },
                        tooltips: {
                            callbacks: {
                                label: function(tooltipItem, data) {
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
            }
        });
    });
    // END TYPE
</script>