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
                        <th>Tunjangan</th>
                        <th>Potongan</th>
                        <th>Bonus</th>
                        <th>BPJS Kesehatan</th>
                        <th>Pajak</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th></th>
                        <td></td>
                        <td style="width: 150px;"></td>
                        <td></td>
                        <td style="width: 150px;"></td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td style="width: 100px;">
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="text-align: center;">
                            <button class="badge" style="background-color: #fbff39;" href="#"><i class="fas fa-check-circle"></i> Status Bayar</button>
                            <button class="badge badge-success" href="#"><i class="fas fa-paper-plane"></i> Kirim Slip Gaji</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>