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
<h3>Laporan Penilaian Kinerja Karyawan</h3>
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
            <th class="text-center">Total Kerja</th>
            <th class="text-center">Done Kerja</th>
            <th class="text-center">Nilai</th>
            <th class="text-center">Kategorisasi</th>

        </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        <?php foreach ($cetak_kinerja as $ck): ?>
            <tr>
                <td style="text-align: center;">
                    <?= $no++ ?>
                </td>
                <td style="text-align: center;">

                    <?= "'" . $ck['nik'] . "' <br> " . $ck['nama_karyawan']; ?>

                </td>

                <td style="text-align: center;">
                    <?= $ck['total_kerja']; ?>
                </td>

                <td style="text-align: center;">
                    <?= $ck['done_kerja']; ?>
                </td>
                <td style="text-align: center;">
                    <?= $ck['nilai']; ?>
                </td>
                <td style="text-align: center;">
                    <?= $ck['kategorisasi']; ?>
                </td>


            </tr>
        <?php endforeach; ?>
    </tbody>
</table>