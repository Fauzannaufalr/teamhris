<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header" style="background-color: #cc0000;">
                    <h3 class="card-title" style="color: white;">Cetak Data</h3>
                </div>
                <form class="form-horizontal">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="bulan" class="col-form-label">Bulan</label>
                            <div class="col">
                                <select class="form-control select2" id="bulan">
                                    <option selected="selected">Januari</option>
                                    <option>Februari</option>
                                    <option>Maret</option>
                                    <option>April</option>
                                    <option>Mei</option>
                                    <option>Juni</option>
                                    <option>Juli</option>
                                    <option>Agustus</option>
                                    <option>September</option>
                                    <option>Oktober</option>
                                    <option>November</option>
                                    <option>Desember</option>
                                </select>
                            </div>
                            <label for="tahun" class="col-form-label">Tahun</label>
                            <div class="col">
                                <select class="form-control select2" id="tahun">
                                    <option selected="selected">2023</option>
                                    <option>2024</option>
                                    <option>2025</option>
                                    <option>2026</option>
                                    <option>2027</option>
                                    <option>2028</option>
                                    <option>2029</option>
                                    <option>2030</option>
                                </select>
                            </div>
                            <?php
                            if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
                                $bulan = $_GET['bulan'];
                                $tahun = $_GET['tahun'];
                                $bulantahun = $tahun . $bulan;
                            } else {
                                $bulan = date('m', strtotime('+1 month'));
                                $tahun = date('Y');
                                $bulantahun = $tahun . $bulan;
                            }
                            ?>
                            <?php if (count($pengajuan) > 0) { ?>
                                <a class="btn btn-outline-success ml-2" href="<?= base_url('payroll/pengajuangaji/cetakgaji?bulan=' . $bulan), '&tahun=' . $tahun ?>"><i class="fas fa-print"></i> Cetak Data</a>
                            <?php } else { ?>
                                <button type="button" class="btn btn-outline-success ml-2" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-print"></i> Cetak Data</button>
                            <?php } ?>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </form>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header" style="background-color: #cc0000;">
                    <h3 class="card-title" style="color: white;">Generate Data</h3>
                </div>
                <form class="form-horizontal">
                    <div class="card-body">
                        <div class="form-group row">
                            <a class="btn btn-outline-success" href="<?= base_url('payroll/pengajuangaji/generate'); ?>"><i class="fas fa-archive"></i> Generate Data <?= date('F', strtotime('+1 month')); ?></a>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </form>
            </div>
        </div>
    </div>

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
            <table id="data" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama Karyawan</th>
                        <th>Posisi</th>
                        <th>Gaji Pokok</th>
                        <th>BPJS Kesehatan</th>
                        <th>Pajak</th>
                        <th>Tj. Kinerja</th>
                        <th>Tj. Fungsional</th>
                        <th>Tj. Jabatan</th>
                        <th>Potongan</th>
                        <th>Bonus</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>

<!-- Modal status -->
<?php foreach ($pengajuan as $pg) : ?>
    <div class="modal fade" id="modal-sm<?= $pg['id']; ?>">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Status Bayar</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin untuk ubah status bayar <b><?= $pg['nama_karyawan']; ?></b>?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn" data-dismiss="modal" style="background-color: #fbff39;">Tidak</button>
                    <a href="<?= base_url() ?>payroll/pengajuangaji/status/<?= $pg['id']  ?>" type="submit" class="btn btn-primary">Ya</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?php foreach ($pengajuan as $pg) : ?>
    <!-- Modal kirim slip -->
    <div class="modal fade" id="kirimSlipModal<?= $pg['id']; ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Preview Slip Gaji</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-horizontal" action="<?= base_url('payroll/pengajuangaji/kirimslip'); ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="email" value="<?= $pg['email']; ?>">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="nik" class="col-form-label">NIK</label>
                                <input type="text" class="form-control" id="nik" name="nik" disabled value="<?= $pg['nik']; ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="nama" class="col-form-label">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama_karyawan" disabled value="<?= $pg['nama_karyawan']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="posisi" class="col-form-label">Posisi</label>
                                <input type="text" class="form-control" id="posisi" name="posisi" disabled value="<?= $pg['nama_posisi']; ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="gaji" class="col-form-label">Gaji Pokok</label>
                                <input type="text" class="form-control" id="gaji" name="gaji" disabled value="Rp <?= number_format($pg['gajipokok'], 0, ',', '.'); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="bpjs" class="col-form-label">BPJS Kesehatan</label>
                                <input type="text" class="form-control" id="bpjs" name="bpjs" disabled value="Rp <?= number_format($pg['bpjs'], 0, ',', '.'); ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="pajak" class="col-form-label">Pajak</label>
                                <input type="text" class="form-control" id="pajak" name="pajak" disabled value="Rp <?= number_format($pg['pajak'], 0, ',', '.'); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="kinerja" class="col-form-label">Tunjangan kinerja</label>
                                <input type="text" class="form-control" id="kinerja" name="kinerja" disabled value="Rp <?= number_format($pg['t_kinerja'], 0, ',', '.'); ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="nama" class="col-form-label">Tunjangan Fungsional</label>
                                <input type="text" class="form-control" id="nama" name="nama" disabled value="Rp <?= number_format($pg['t_fungsional'], 0, ',', '.'); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="nama" class="col-form-label">Tunjangan Jabatan</label>
                                <input type="text" class="form-control" id="nama" name="nama" disabled value="Rp <?= number_format($pg['t_jabatan'], 0, ',', '.'); ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="nama" class="col-form-label">Potongan</label>
                                <input type="text" class="form-control" id="nama" name="nama" disabled value="Rp <?= number_format($pg['potongan'], 0, ',', '.'); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="nama" class="col-form-label">Bonus</label>
                                <input type="text" class="form-control" id="nama" name="nama" disabled value="Rp <?= number_format($pg['bonus'], 0, ',', '.'); ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="nama" class="col-form-label">Total</label>
                                <input type="text" class="form-control" id="nama" name="nama" disabled value="Rp <?= number_format($pg['total'], 0, ',', '.'); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama" class="col-form-label">File</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="slipgaji" name="slipgaji">
                                <label class=" custom-file-label" for="slipgaji">Choose file</label>
                            </div>
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
    <!-- /.modal -->
<?php endforeach; ?>

<!-- Modal cetak gaji -->
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
                Data gaji masih kosong.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Akhir modal cetak gaji -->

<script type="text/javascript">
    $(document).ready(function() {
        var userDataTable = $('#data').DataTable({
            'responsive': true,
            'orderable': true,
            'processing': true,
            'serverSide': true,
            "autoWidth": false,
            'serverMethod': 'post',
            'searching': true, // Remove default Search Control
            'ajax': {
                'url': '<?= base_url() ?>payroll/pengajuangaji/list',
                'data': function(data) {
                    data.searchBulan = $('#bulan').val();
                    data.searchTahun = $('#tahun').val();
                }
            },
            'columns': [{
                    data: 'no'
                },
                {
                    data: 'nik'
                },
                {
                    data: 'nama'
                },
                {
                    data: 'posisi'
                },
                {
                    data: 'gaji'
                },
                {
                    data: 'bpjs'
                },
                {
                    data: 'pajak'
                },
                {
                    data: 'kinerja'
                },
                {
                    data: 'fungsional'
                },
                {
                    data: 'jabatan'
                },
                {
                    data: 'potongan'
                },
                {
                    data: 'bonus'
                },
                {
                    data: 'total'
                },
                {
                    data: 'status'
                },
                {
                    data: 'aksi'
                },
            ]
        });

        $('#bulan,#tahun').change(function() {
            userDataTable.draw();
        });
    });
</script>