<!DOCTYPE html>
<html>

<head>
    <title><?= $title ?></title>
    <style type="text/css">
        body {
            font-family: Arial;
            color: black;
        }
    </style>
</head>

<body>
    <center>
        <h1>PT. Sahaware Teknologi Indonesia</h1>
        <h2>Daftar Gaji Pegawai</h2>
    </center>

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
    <table>
        <tr>
            <td>Bulan</td>
            <td>:</td>
            <td><?= $bulan ?></td>
        </tr>
        <tr>
            <td>Tahun</td>
            <td>:</td>
            <td><?= $tahun ?></td>
        </tr>
    </table>
    <table class="table table-bordered table-triped">
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">NIK</th>
            <th class="text-center">Nama Karyawan</th>
            <th class="text-center">Posisi</th>
            <th class="text-center">Gaji Pokok</th>
            <th class="text-center">BPJS Kesehatan</th>
            <th class="text-center">Pajak</th>
            <th class="text-center">Tunjangan</th>
            <th class="text-center">Potongan</th>
            <th class="text-center">Bonus</th>
            <th class="text-center">Total Gaji</th>
        </tr>
        <?php $no = 1; ?>
        <?php foreach ($cetak_gaji as $g) : ?>
            <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td class="text-center"><?= $g['nik']; ?></td>
                <td class="text-center"><?= $g['nama_karyawan']; ?></td>
                <td class="text-center"><?= $g['nama_posisi']; ?></td>
                <td class="text-center">Rp <?= number_format($g['gajipokok'], 0, ',', '.'); ?></td>
                <td class="text-center">Rp <?= number_format($g['bpjs'], 0, ',', '.'); ?></td>
                <td class="text-center">Rp <?= number_format($g['pajak'], 0, ',', '.'); ?></td>
                <td class="text-center">Rp <?= number_format($g['tunjangan'], 0, ',', '.'); ?></td>
                <td class="text-center">Rp <?= number_format($g['potongan'], 0, ',', '.'); ?></td>
                <td class="text-center">Rp <?= number_format($g['bonus'], 0, ',', '.'); ?></td>
                <td class="text-center">Rp <?= number_format($g['total'], 0, ',', '.'); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <table width="100%">
        <tr>
            <td></td>
            <td width="200px">
                <p>Bandung, <?= date("d M Y") ?> <br> Finance</p>
                <br>
                <br>
                <p>_____________________</p>
            </td>
        </tr>
    </table>
</body>

</html>

<script type="text/javascript">
    window.print();
</script>