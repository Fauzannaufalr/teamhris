<!DOCTYPE html>
<html>

<head>
    <title>
        <?= $title ?>
    </title>
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
        <h2>Bukti Penilaian</h2>
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
            <td>
                <?= $bulan ?>
            </td>
        </tr>
        <tr>
            <td>Tahun</td>
            <td>:</td>
            <td>
                <?= $tahun ?>
            </td>
        </tr>
    </table>
    <table class="table table-bordered table-triped">
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">NIK</th>
            <th class="text-center">Nama Karyawan</th>
            <th class="text-center">NIK Penilai</th>
            <th class="text-center">NIK Menilai</th>
            <th class="text-center">Total Nilai</th>
            <th class="text-center">Aksi</th>

        </tr>
        <?php $no = 1; ?>
        <?php foreach ($cetak_kuesioner as $cr): ?>
            <tr>
                <td class="text-center">
                    <?= $no++ ?>
                </td>
                <td class="text-center">
                    <?= $cr['nik']; ?>
                </td>
                <td class="text-center">
                    <?= $cr['nama_karyawan']; ?>
                </td>
                <td class="text-center">
                    <?= $cr['nik_penilai']; ?>
                </td>
                <td class="text-center">
                    <?= $cr['nik_menilai']; ?>
                </td>
                <td class="text-center"></td>
                <?= $cr['tanggal']; ?>
                </td>
                <td class="text-center">
                    <?= $cr['total_nilai']; ?>
                </td>

            </tr>
        <?php endforeach; ?>
    </table>

    <table width="100%">
        <tr>
            <td></td>
            <td width="200px">
                <p>Bandung,
                    <?= date("d M Y") ?> <br> Finance
                </p>
                <br>
                <br>
                <p>Human Capital</p>

            </td>
        </tr>
    </table>
</body>

</html>

<script type="text/javascript">
    window.print();
</script>