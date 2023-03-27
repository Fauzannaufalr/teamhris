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
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header" style="background-color: #cc0000;">
                    <h3 class="card-title" style="color: white;">Laporan Gaji Karyawan</h3>
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
                <div class="card-header" style="background-color: #cc0000;">
                    <h3 class="card-title" style="color: white;">Laporan Rate Mitra</h3>
                </div>
                <div class="card-body">
                    <div class="col-lg-7">
                        <canvas id="mitra"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: #cc0000;">
                    <h3 class="card-title" style="color: white;">Laporan Gaji Karyawan</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <canvas id="keahlian"></canvas>
                        </div>
                        <div class="col-lg-6">
                            <canvas id="Tools"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="card-body">
        <table id="example2" class="table table-bordered table-striped" style="text-align: center;">
            <thead style="background-color: #cc0000;">
                <tr style="color: #ffffff;">
                    <th rowspan="2">Nama Karyawan</th>
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
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
        </table>

    </div>
    <!-- /.card-body -->
</div>


</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const karyawan = document.getElementById('karyawan');
    const d_karyawan = {
        labels: [
            'Sudah dibayar',
            'Belum dibayar'
        ],
        datasets: [{
            label: 'My First Dataset',
            data: [200, 50],
            backgroundColor: [
                '#28a745',
                'rgb(255, 205, 86)'
            ],
            hoverOffset: 4
        }]
    };

    new Chart(karyawan, {
        type: 'pie',
        data: d_karyawan
    });

    const mitra = document.getElementById('mitra');
    const d_mitra = {
        labels: [
            'Sudah dibayar',
            'Belum dibayar'
        ],
        datasets: [{
            label: 'My First Dataset',
            data: [200, 50],
            backgroundColor: [
                '#28a745',
                'rgb(255, 205, 86)'
            ],
            hoverOffset: 4
        }]
    };

    new Chart(mitra, {
        type: 'pie',
        data: d_mitra
    });


    const keahlian = document.getElementById('keahlian');
    new Chart(keahlian, {
        type: 'bar',
        data: {
            labels: ['Developer', 'UI/UX', 'QA'],
            datasets: [{
                label: 'Keahlian',
                data: [12, 130, 3],
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

    const Tools = document.getElementById('Tools');
    new Chart(Tools, {
        type: 'bar',
        data: {
            labels: ['PHP', 'Figma', 'Java', 'Vue.js', 'Javascript', 'Python'],
            datasets: [{
                label: 'Tools',
                data: [12, 19, 3, 5, 2, 3],
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