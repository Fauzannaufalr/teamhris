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
                                <select class="form-control select2">
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
                                <select class="form-control select2">
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
                                <button type="button" class="btn btn-outline-success ml-2" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-print"></i> Cetak Laporan</button>
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
                            <a class="btn btn-outline-success" href="<?= base_url('payroll/pengajuangaji/generate'); ?>"><i class="fas fa-archive"></i> Generate Data</a>
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
            <table id="example1" class="table table-bordered table-striped">
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
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($pengajuan as $pg) : ?>
                        <tr>
                            <th><?= $no++; ?></th>
                            <td><?= $pg['nik']; ?></td>
                            <td><?= $pg['nama_karyawan']; ?></td>
                            <td><?= $pg['nama_posisi']; ?></td>
                            <td>Rp <?= number_format($pg['gajipokok'], 0, ',', '.'); ?></td>
                            <td>Rp <?= number_format($pg['bpjs'], 0, ',', '.'); ?></td>
                            <td>Rp <?= number_format($pg['pajak'], 0, ',', '.'); ?></td>
                            <td>Rp <?= number_format($pg['t_kinerja'], 0, ',', '.'); ?></td>
                            <td>Rp <?= number_format($pg['t_fungsional'], 0, ',', '.'); ?></td>
                            <td>Rp <?= number_format($pg['t_jabatan'], 0, ',', '.'); ?></td>
                            <td>Rp <?= number_format($pg['potongan'], 0, ',', '.'); ?></td>
                            <td>Rp <?= number_format($pg['bonus'], 0, ',', '.'); ?></td>
                            <td>Rp <?= number_format($pg['total'], 0, ',', '.'); ?></td>
                            <td><?= $pg['status']; ?></td>
                            <td style="text-align: center;">
                                <button class="badge" style="background-color: #fbff39;" href="" data-toggle="modal" data-target="#modal-sm<?= $pg['id']; ?>"><i class="fas fa-check-circle"></i> Status Bayar</button>
                                <a href="<?= base_url(); ?>payroll/pengajuangaji/cetak_slip/<?= $pg['id']  ?>" class="badge badge-success"><i class="fas fa-paper-plane"></i> Kirim Slip Gaji</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
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
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach; ?>

<?php foreach ($pengajuan as $pg) : ?>
    <!-- Modal kirim slip -->
    <div class="modal fade" id="kirimSlipModal<?= $pg['id']; ?>" tabindex="-1" aria-labelledby="kirimSlipModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kirimSlipModalLabel">Kirim Slip Gaji</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('payroll/pengajuangaji/kirimslip') ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="email" id="email" value="<?= $pg['email']; ?>">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="slipgaji" name="slipgaji">
                            <label class=" custom-file-label" for="slipgaji">Pilih Slip Gaji <b><?= $pg['nama_karyawan']; ?></b></label>
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
<?php endforeach; ?>
<!-- akhir modal tambah -->

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

<script>
    $(function() {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        $('.swalDefaultSuccess').click(function() {
            Toast.fire({
                icon: 'success',
                title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
    });
</script>