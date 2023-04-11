<?php
header("Content-type:application/octet-stream/");

header("Content-Disposition:attachment; filename=$title.xls");

header("Pragma: no-cache");

header("Expires: 0");

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
<h3>Laporan Akumulasi Penilaian Karyawan</h3>
<table>
    <tr>
        <td>Bulan</td>
        <td>:
            <?= $bulan ?>
        </td>

    </tr>
    <tr>
        <td>Tahun</td>
        <td>:
            <?= $tahun ?>
        </td>

    </tr>
</table>
<br>
<table border="1" width="100%">
    <thead>
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">NIK & Nama Karyawan</th>
            <th class="text-center">Nilai Kerja</th>
            <th class="text-center">Nilai Kuesioner</th>
            <th class="text-center">Nilai</th>
            <th class="text-center">Kategorisasi</th>

        </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        <?php foreach ($cetak_akumulasi_admin as $ck):
            $akumulasi = ($ck['nilai_kinerja'] + $ck['nilai_kuesioner']) / 2;
            ?>
            <tr>
                <td style="text-align: center;">
                    <?= $no++ ?>
                </td>

                <td style="text-align: center;">
                    <?= $ck['nik'] . " - " .
                        $ck['nama_karyawan']; ?>
                </td>
                <td style="text-align: center;">
                    <?= $ck['nilai_kinerja'] ?>
                </td>
                <td style="text-align: center;">
                    <?= $ck['nilai_kuesioner'] ?>
                </td>
                <td style="text-align: center;">
                    <?= $akumulasi ?>
                </td>
                <td style="text-align: center;">
                    <?php

                    if ($akumulasi >= 80 && $akumulasi <= 100) {
                        echo "Sangat Baik";
                    } else if ($akumulasi >= 60 && $akumulasi <= 79) {
                        echo "Baik";
                    } else if ($akumulasi >= 40 && $akumulasi <= 59) {
                        echo "Cukup";
                    } else if ($akumulasi >= 20 && $akumulasi <= 39) {
                        echo "Kurang";
                    } else if ($akumulasi >= 0 && $akumulasi <= 19) {
                        echo "Sangat Kurang";
                    }
                    ?>

                </td>

            </tr>
        <?php endforeach; ?>

    </tbody>
</table>