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
                            <?php if (count($ratemitra) > 0) { ?>
                                <a class="btn btn-outline-success ml-2" href="<?= base_url('payroll/pengajuanratemitra/cetakgaji?bulan=' . $bulan), '&tahun=' . $tahun ?>"><i class="fas fa-print"></i> Cetak Data</a>
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
                            <a class="btn btn-outline-success" href="<?= base_url('payroll/pengajuanratemitra/generate'); ?>"><i class="fas fa-archive"></i> Generate Data <?= date('F', strtotime('+1 month')); ?></a>
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
                        <th>Nama Perusahaan</th>
                        <th>Nama Karyawan</th>
                        <th>Keahlian</th>
                        <th>Tools</th>
                        <th>Rate Total</th>
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
<?php foreach ($ratemitra as $rm) : ?>
    <div class="modal fade" id="modal-sm<?= $rm['id']; ?>">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Status Bayar</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin untuk ubah status bayar <b><?= $rm['nama_karyawan']; ?></b>?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn" data-dismiss="modal" style="background-color: #fbff39;">Tidak</button>
                    <a href="<?= base_url() ?>payroll/pengajuanratemitra/status/<?= $rm['id']  ?>" type="submit" class="btn btn-primary">Ya</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach; ?>

<script type="text/javascript">
    $(document).ready(function() {
        var userDataTable = $('#data').DataTable({
            'responsive': true,
            'orderable': true,
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'searching': true, // Remove default Search Control
            'ajax': {
                'url': '<?= base_url() ?>payroll/pengajuanratemitra/list',
                'data': function(data) {
                    data.searchBulan = $('#bulan').val();
                    data.searchTahun = $('#tahun').val();
                }
            },
            'columns': [{
                    data: 'no'
                },
                {
                    data: 'nama_perusahaan'
                },
                {
                    data: 'nama_karyawan'
                },
                {
                    data: 'keahlian'
                },
                {
                    data: 'tools'
                },
                {
                    data: 'rate_total'
                },
                {
                    data: 'status'
                },
                {
                    data: 'aksi'
                }
            ]
        });

        $('#bulan,#tahun').change(function() {
            userDataTable.draw();
        });
    });
</script>