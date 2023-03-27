<div class="container-fluid">

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header" style="background-color: #cc0000;">
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
                <div class="card-header" style="background-color: #cc0000;">
                    <h3 class="card-title" style="color: white;">Persentase Penilaian</h3>
                </div>
                <div class="card-body">
                    <div class="col-lg-7">
                        <canvas id="karyawan2"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" style="color: white; background-color: #cc0000;">
            <h4> Filter Data Akumulasi Penilaian</h4>
        </div>

        <form class="form-horizontal">
            <div class="card-body">
                <div class="form-group row">
                    <label for="bulan" class="col-form-label">Bulan: </label>
                    <div class="col-md-2">
                        <select class="form-control select2" name="periode">
                            <option value="">-- Pilih Periode--</option>
                            <option value=" 01">Periode 1</option>
                            <option value="02">Periode 2</option>

                        </select>
                    </div>
                    <label for="tahun" class="col-form-label">Tahun: </label>
                    <div class="col-md-2">
                        <select class="form-control" name="tahun">
                            <option value="">--Pilih Tahun--</option>
                            <option value="">2017</option>
                            <option value="">2018</option>
                            <option value="">2019</option>
                            <option value="">2020</option>
                            <option value="">2021</option>
                            <option value="">2022</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-outline-success mb-2 ml-auto"><i class="fas fa-eye"> Tampilkan
                            Data
                        </i>
                    </button>
                    <button type="button" class="btn btn-outline-success mb-2 ml-2"><i class="fas fa-print"></i> Cetak
                        Laporan</button>
                </div>

            </div>
        </form>
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

            <div class="card">
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead style="background-color: #cc0000; text-align: center ;">
                            <tr style="color: #ffffff;">
                                <th>No</th>
                                <th>Nama Karyawan</th>
                                <th>Nilai Kinerja</th>
                                <th>Nilai Kuesioner</th>
                                <th>Total</th>
                                <th>Kategorisasi</th>
                            </tr>
                        </thead>

                    </table>
                </div>
            </div>
        </div>
        <!-- /.card-body -->

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const karyawan = document.getElementById('karyawan');
            const d_karyawan = {
                labels: [
                    'Sangat Baik',
                    'Baik',
                    'Cukup ',
                    'Kurang',
                    'Sangat Kurang'
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
        </script>
        <script>
            const karyawan2 = document.getElementById('karyawan2');
            const d_karyawan2 = {
                labels: [
                    'Penilaian Kinerja : 55%',
                    'Penilaian Kuesioner : 45%'
                ],
                datasets: [{
                    label: 'My First Dataset',
                    data: [55, 45],
                    backgroundColor: [
                        '#28a745',
                        'rgb(255, 205, 86)',
                    ],
                    hoverOffset: 4
                }]
            };

            new Chart(karyawan2, {
                type: 'pie',
                data: d_karyawan2
            });
        </script>