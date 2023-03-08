<div class="container-fluid">

    <div class="card">
        <div class="card-header" style="color: white; background-color: #cc0000;">
            <h4> Filter Data Penilaian Kinerja</h4>
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
                    <button type="submit" class="btn btn-info mb-2 ml-3"><i class="fas fa-eye"> Tampilkan
                            Data
                        </i>
                    </button>
                </div>

            </div>
        </form>
    </div>
    <div class="card">
        <div class="card-body">

            <!-- validation crud -->
            <?php if (validation_errors()): ?>
                <div class="alert alert-default" role="alert" style="background-color: #800000;">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-lg-4">
                    <?= $this->session->flashdata('message'); ?>
                </div>
            </div>

            <!-- table -->
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama Karyawan</th>
                        <th>Nilai</th>
                        <th>Kategorisasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($penilaiankuesioner as $pr): ?>
                        <tr>
                            <th>
                                <?= $no++; ?>
                            </th>
                            <td>
                                <?= $pr['nik']; ?>
                            </td>
                            <td>
                                <?= $pr['nama_karyawan']; ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                if ($row['nilai'] > 74 - 94 && $row['nilai'] <= 10) {
                                    echo "SB";
                                } elseif ($row['nilai'] > 63 - 73 && $row['nilai'] <= 9) {
                                    echo "B";
                                } elseif ($row['nilai'] > 42 - 62 && $row['nilai'] <= 8) {
                                    echo "C";
                                } elseif ($row['nilai'] > 21 - 41 && $row['nilai'] <= 7) {
                                    echo "K";
                                } elseif ($row['nilai'] > 0 - 20 && $row['nilai'] <= 6) {
                                    echo "SK";
                                } else {
                                    echo "N/A";
                                }
                                ?>

                            </td>

                            <button type="button" class="btn btn-danger"
                                style="font-size: 12px; color: white; background-color:  #ff0000;" data-toggle="modal"
                                data-target="#modal-sm<?= $pk['id_penilaian_kuesioner'] ?>">hapus</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.card-body -->
</div>



<!-- Modal Hapus -->
<?php foreach ($penilaiankuesioner as $pr): ?>
    <div class="modal fade" id="modal-sm<?= $pk['id_penilaian_kuesioner']; ?>" tabindek="-1" role+dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin untuk menghapus data ?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn" data-dismiss="modal" style="background-color: #d4d4d4;">Tidak</button>
                    <a href="<?= base_url() ?>performances/penilaiankuesioner/hapus/<?= $pr['id_penilaian_kuesioner'] ?>"
                        type="submit" class="btn" style="background-color: #ff0000; color: white;">Ya</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach; ?>
</div>