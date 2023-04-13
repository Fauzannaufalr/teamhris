<div class="container-fluid">

    <div class="card">
        <div class="card-header" style="color: white; background-color: #8b0000;">
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
                    <div class="col-md-2 ">
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
                        $bulantahun = $bulan . $tahun;
                    } else {
                        $bulan = date('m');
                        $tahun = date('Y');
                        $bulantahun = $bulan . $tahun;

                    }

                    ?>
                    <button type="submit" class="btn btn-outline-success ml-auto"><i class="fas fa-eye"> Tampilkan
                            Data
                        </i>
                    </button>
                    <?php if (count($penilaiankinerja) > 0) { ?>
                        <a class="btn btn-outline-success  ml-2"
                            href="<?= base_url('Performances/PenilaianKinerja/cetakkinerja?bulan=' . $bulan), '&tahun=' . $tahun ?>"><i
                                class="fas fa-print"></i> Cetak PDF</a>
                        <a class="btn btn-outline-success ml-2"
                            href="<?= base_url('Performances/PenilaianKinerja/cetakExcel?bulan=' . $bulan), '&tahun=' . $tahun ?>"><i
                                class="fas fa-print"></i> Cetak Excel</a>
                    <?php } else { ?>
                        <button type="button" class="btn btn-outline-success ml-2" data-toggle="modal"
                            data-target="#exampleModal"><i class="fas fa-print"></i> Cetak PDF</button>
                        <button type="button" class="btn btn-outline-success ml-2" data-toggle="modal"
                            data-target="#exampleModal"><i class="fas fa-print"></i> Cetak Excel</button>
                    <?php } ?>
                </div>

            </div>
        </form>
    </div>

    <div class="alert alert" style="background-color: #8b0000; color: white;">
        Menampilkan penilaian kinerja Bulan:<span class="fofnt-weight-bold">
            <?php echo $bulan ?>
        </span> Tahun:<span class="fofnt-weight-bold">
            <?php echo $tahun ?>
    </div>
    <div class="card">
        <div class="card-body">


            <div class="form-group row">
                <div class="col-mb-1">
                    <button type="button" class="btn btn-outline-success" data-toggle="modal"
                        data-target="#tambahPenilaianKinerja"><i class="fas fa-plus"></i>
                        Tambah Penilaian
                    </button>
                    <button type="button" class="btn btn-outline-success" data-toggle="modal"
                        data-target="#importPenilaianKinerja"><i class="fas fa-plus"></i>
                        Import
                    </button>
                </div>
            </div>
            <!-- perulangan -->
            <?php

            $jml_data = count($penilaiankinerja);
            if ($jml_data > 0) { ?>
                <!-- jml data > 0 artinya jika nilai lebih dari nol maka data atau nilainya itu ada -->

                <table id="example1" class="table table-bordered table-striped">
                    <thead style="text-align: center; background-color: #8b0000; color: white;  ">
                        <tr>
                            <th>No</th>
                            <th>NIK & Nama Karyawan</th>
                            <th>Total Kerja</th>
                            <th>Done Kerja</th>
                            <th>Nilai</th>
                            <th>Kategorisasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        <?php

                        foreach ($penilaiankinerja as $pk):

                            ?>

                            <tr style=" text-align: center;">
                                <th>
                                    <?= $no++; ?>
                                </th>
                                <td>
                                    <?= $pk['nik'], "<br>" .
                                        $pk['nama_karyawan']; ?>
                                </td>

                                <td>
                                    <?= $pk['total_kerja']; ?>
                                </td>
                                <td>
                                    <?= $pk['done_kerja']; ?>
                                </td>
                                <td>
                                    <?= $pk['nilai']; ?>
                                </td>
                                <td>
                                    <?= $pk['kategorisasi']; ?>
                                </td>

                                <td>

                                    <button class="badge" style="background-color: gold; color: black;" data-toggle="modal"
                                        data-target="#ubahPenilaianKinerja<?= $pk['id_penilaian_kinerja']; ?>"><i
                                            class="fas fa-edit"></i> Edit</button>
                                    <button class="badge" style="background-color: #8b0000; color: antiquewhite"
                                        data-toggle="modal" data-target="#modal-sm<?= $pk['id_penilaian_kinerja']; ?>"><i
                                            class="fas fa-trash-alt"></i> Hapus</button>

                                </td>
                            <?php endforeach; ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <span class="badge badge-danger"><i class="fas fa-info-circle"></i>
                    Data masih kosong, silahkan pilih bulan dan tahun terlebih dahulu!</span>
            <?php } ?>
        </div>
    </div>
    <!-- /.card-body -->
</div>



<!-- modal untuk impor excel -->

<!-- Modal Hapus -->
<div class="modal fade" id="importPenilaianKinerja" tabindek="-1" role+dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Import Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('Performances/Penilaiankinerja/import') ?>" method="POST"
                enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="import" name="import" accept=".xlsx,.xls">
                            <label class="custom-file-label" for="import">Choose file</label>
                        </div>
                    </div>
                    <!-- modal footer  -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn"
                            style="background-color: #8b0000; color:#ffffff;">Import</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Akhir tambah data masal Modal -->

<!-- modal untuk tambah data -->
<div class="modal fade" id="tambahPenilaianKinerja" tabindex="-1" aria-labelledby="tambahPenilaianKinerjaLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahPenilaianKinerjaLabel">Tambah Penilaian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('Performances/Penilaiankinerja/tambah') ?>" method="POST">
                <div class="modal-body">
                    <div class=" form-group">

                        <label>NIK & Nama Karyawan</label>
                        <select class="form-control" name="nik_nama" id="nik_nama">
                            <option>-- Pilih Karyawan --</option>
                            <?php foreach ($datakaryawan as $dk): ?>
                                <option value="<?= $dk['nik']; ?>"><?= $dk['nik']; ?> - <?= $dk['nama_karyawan']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Posisi</label>
                        <input type="text" readonly id="id_posisi" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="total_kerja">Total Kerja</label>
                        <input type="text" class="form-control" id="total_kerja" name="total_kerja">
                    </div>
                    <div class="form-group">
                        <label for="done_kerja">Done Kerja</label>
                        <input type="text" class="form-control" id="done_kerja" name="done_kerja">
                    </div>

                    <!-- modal footer  -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn"
                            style="background-color: #8b0000; color:#ffffff;">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Akhir tambah Modal -->

<!-- Modal edit data -->
<?php foreach ($penilaiankinerja as $pk): ?>
    <div class="modal fade" id="ubahPenilaianKinerja<?= $pk['id_penilaian_kinerja']; ?>" tabindex="-1"
        aria-labelledby="ubahPenilaianKinerjaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahPenilaianKinerjaLabel">Ubah Data Karyawan</h5><br>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="<?= base_url('Performances/Penilaiankinerja/ubah') ?>" method="POST">
                    <div class="modal-body">
                        <h6 style="color: black;"><i>WAJIB MEMILIH NIK & NAMA KARYAWAN KEMBALI, SEBELUM MERUBAH NILAI!!</i>
                        </h6>
                        <input type="hidden" name="id_penilaian_kinerja" value="<?= $pk['id_penilaian_kinerja']; ?>">
                        <div class=" form-group">
                            <label>NIK & Nama Karyawan</label>
                            <select class="form-control" name="nik_nama" id="nik_nama" placeholder="-- Pilih Karyawan --">
                                <?php foreach ($datakaryawan as $dk): ?>
                                    <?php if ($dk['nik'] == $pk['nik']): ?>
                                        <option value="<?= $dk['nik']; ?>" selected><?= $dk['nama_karyawan'] ?></option>
                                    <?php else: ?>
                                        <option value="<?= $pk['nik']; ?>"><?= $dk['nama_karyawan'] ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Posisi</label>
                            <?php foreach ($datakaryawan as $dk): ?>
                                <?php if ($dk['nik'] == $pk['nik']): ?>
                                    <?php foreach ($dataposisi as $dp): ?>
                                        <?php if ($dp['id_posisi'] == $dk['id_posisi']): ?>
                                            <input type="text" readonly id="id_posisi" class="form-control"
                                                value="<?= $dp['nama_posisi']; ?>" />
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <!-- <input type="text" readonly id="id_posisi" class="form-control" /> -->
                        </div>

                        <div class="form-group">
                            <label for="total_kerja">Total Kerja</label>
                            <input type="text" class="form-control" id="total_kerja" name="total_kerja"
                                value="<?= $pk['total_kerja']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="done_kerja">Done Kerja</label>
                            <input type="text" class="form-control" id="done_kerja" name="done_kerja"
                                value="<?= $pk['done_kerja']; ?>">
                        </div>

                        <!-- modal footer  -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn"
                                style="background-color: #8b0000; color:#ffffff;">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>


<!-- Modal Hapus -->
<?php foreach ($penilaiankinerja as $pk): ?>
    <div class="modal fade" id="modal-sm<?= $pk['id_penilaian_kinerja']; ?>" tabindek="-1" role+dialog">
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
                    <a href="<?= base_url() ?>Performances/Penilaiankinerja/hapus/<?= $pk['id_penilaian_kinerja'] ?>"
                        type="submit" class="btn" style="background-color: #8b0000; color:#ffffff;">Ya</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach; ?>
</div>
</div>

<!-- Modal cetak penlilaian kinerja -->
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
                Data Penilaian Kinerja masih kosong.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" style="background-color: #8b0000; color:#ffffff;"
                    data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Akhir modal cetak penlilaian kinerja -->


<script>
    const nik_nama = document.getElementById("nik_nama");
    const id_posisi = document.getElementById("id_posisi");
    nik_nama.onchange = function (e) {
        const nik = e.target.value;
        fetch(`/teamhris/performances/penilaiankinerja/ajax_category?nik=${nik}`, {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
            },
        })
            .then(response => response.json())
            .then(response => {
                id_posisi.value = response?.nama_posisi || ""
            })
    }
</script>


<script>
    $(function () {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000
        });
        <?php if ($this->session->flashdata('message')): ?>
            const flashData = <?= json_encode($this->session->flashdata('message')) ?>;
            Toast.fire({
                icon: 'success',
                title: flashData
            })
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')): ?>
            const flashData = <?= json_encode($this->session->flashdata('error')) ?>;
            Toast.fire({
                icon: 'error',
                title: flashData
            })
        <?php endif; ?>
        <?php if (validation_errors()): ?>
            const flashData = <?= json_encode(validation_errors()) ?>;
            Toast.fire({
                icon: 'error',
                title: flashData
            })
        <?php endif; ?>
    });
</script>