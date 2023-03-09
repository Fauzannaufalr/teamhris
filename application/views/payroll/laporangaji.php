<div class="container-fluid">
    <div class="card">
        <div class="card-header" style="background-color: #ff0000;">
            <h3 class="card-title" style="color: white;">Filter Data</h3>
        </div>
        <form class="form-horizontal">
            <div class="card-body">
                <div class="form-group row">
                    <label for="bulan" class="col-form-label">Bulan</label>
                    <div class="col-md-2">
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
                    <div class="col-md-2">
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
                    <a class="btn btn-outline-success ml-auto" href="<?= base_url('payroll/laporangaji/generate'); ?>"><i class="fas fa-archive"></i> Generate Data</a>
                    <a class="btn btn-outline-success ml-2" href="<?= base_url('payroll/laporangaji/cetaklaporan'); ?>"><i class="fas fa-print"></i> Cetak Laporan</a>
                </div>
            </div>
            <!-- /.card-body -->
        </form>
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
                        <th>Tunjangan</th>
                        <th>Potongan</th>
                        <th>Bonus</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($laporan as $lg) : ?>
                        <tr>
                            <th><?= $no++; ?></th>
                            <td><?= $lg['nik']; ?></td>
                            <td><?= $lg['nama_karyawan']; ?></td>
                            <td><?= $lg['nama_posisi']; ?></td>
                            <td>Rp <?= number_format($lg['gajipokok'], 0, ',', '.'); ?></td>
                            <td>Rp <?= number_format($lg['bpjs'], 0, ',', '.'); ?></td>
                            <td>Rp <?= number_format($lg['pajak'], 0, ',', '.'); ?></td>
                            <td>Rp <?= number_format($lg['tunjangan'], 0, ',', '.'); ?></td>
                            <td>Rp <?= number_format($lg['potongan'], 0, ',', '.'); ?></td>
                            <td>Rp <?= number_format($lg['bonus'], 0, ',', '.'); ?></td>
                            <td>Rp <?= number_format($lg['total'], 0, ',', '.'); ?></td>
                            <td><?= $lg['status']; ?></td>
                            <td style="text-align: center;">
                                <button class="badge" style="background-color: #fbff39;" href="" data-toggle="modal" data-target="#modal-sm<?= $lg['id']; ?>"><i class="fas fa-check-circle"></i> Status Bayar</button>
                                <button class="badge badge-success" data-toggle="modal" data-target="#kirimSlipModal<?= $lg['id']; ?>"><i class="fas fa-paper-plane"></i> Kirim Slip Gaji</button>
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
<?php foreach ($laporan as $lg) : ?>
    <div class="modal fade" id="modal-sm<?= $lg['id']; ?>">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Status Bayar</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin untuk ubah status bayar?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn" data-dismiss="modal" style="background-color: #fbff39;">Tidak</button>
                    <a href="<?= base_url() ?>payroll/laporangaji/status/<?= $lg['id']  ?>" type="submit" class="btn btn-primary">Ya</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach; ?>

<?php foreach ($laporan as $lg) : ?>
    <!-- Modal kirim slip -->
    <div class="modal fade" id="kirimSlipModal<?= $lg['id']; ?>" tabindex="-1" aria-labelledby="kirimSlipModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kirimSlipModalLabel">Kirim Slip Gaji</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('payroll/laporangaji/kirimslip') ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="email" id="email" value="<?= $lg['email']; ?>">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="slipgaji" name="slipgaji">
                            <label class=" custom-file-label" for="slipgaji">Pilih Slip Gaji <b><?= $lg['nama_karyawan']; ?></b></label>
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