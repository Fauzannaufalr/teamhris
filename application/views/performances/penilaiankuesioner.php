<div class="container-fluid">

    <div class="card">
<<<<<<< Updated upstream
        <div class="card-header" style="color: white; background-color: #cc0000;">
            <h4> Filter Data Penilaian Kinerja</h4>
=======
        <div class="card-header" style="color: white; background-color: #ff0000;">
            <h4> Filter Data Penilaian Kuesioner</h4>
>>>>>>> Stashed changes
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
                    <div class="col-md-2 ml-5">
                        <select class="form-control" name="tahun">
                            <option value="">--Pilih Tahun--</option>
                            <?php $tahun = date('Y');
                            for ($i = 2020; $i < $tahun + 3; $i++) { ?>
                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                            <?php } ?>
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
    <div class="alert alert" style="background-color: #ff0000; color: white;">
        Menampilkan penilaian kuesioner Bulan:<span class="fofnt-weight-bold">
            <?php echo $bulan ?>
        </span> Tahun:<span class="fofnt-weight-bold">
            <?php echo $tahun ?>
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

            <!-- perulangan -->
            <?php

            $jml_data = count($penilaiankuesioner);
            if ($jml_data > 0) { ?>

                <table id="example1" class="table table-bordered table-striped">
                    <thead style="text-align: center;">
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
                            <tr style="text-align: center;">
                                <th>
                                    <?= $no++; ?>
                                </th>
                                <td>
                                    <?= $pr['nik']; ?>
                                </td>
                                <td>
                                    <?= $pr['nama_karyawan']; ?>
                                </td>

                                <td>
                                    <?= $pr['kategorisasi']; ?>
                                </td>

                            </tr>
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

</div>
<!-- ak.hir modal hapus -->
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