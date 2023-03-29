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
        <h2>Hasil Penilaian Kinerja</h2>
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
        </tr>
    </table>
    <table class="table table-bordered table-triped">
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
            <?php $no = 1;
            $total = 0;
            ?>
            <?php foreach ($cetak_akumulasi_admin as $ck):

                ?>
                <tr>
                    <td style="text-align: center;">
                        <?= $no++ ?>
                    </td>

                    <td>
                        <?= $ck['nik'],
                            $ck['nama_karyawan']; ?>
                    </td>
                    <td style="text-align: center;">
                        <?= $ck['nilai'] ?>
                    </td>
                    <td style="text-align: center;">
                        <?= $ck['total'] ?>
                    </td>
                    <td style="text-align: center;">
                        <?= ($ck['nilai'] + $ck['total']) / 2; ?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        $total_nilai = ($ck['nilai'] + $ck['total']) / 2;
                        if ($total_nilai >= 80 && $total_nilai <= 100) {
                            echo "Sangat Baik";
                        } else if ($total_nilai >= 60 && $total_nilai <= 79) {
                            echo "Baik";
                        } else if ($total_nilai >= 40 && $total_nilai <= 59) {
                            echo "Cukup";
                        } else if ($total_nilai >= 20 && $total_nilai <= 39) {
                            echo "Kurang";
                        } else if ($total_nilai >= 0 && $total_nilai <= 19) {
                            echo "Sangat Kurang";
                        }
                        ?>

                    </td>

                </tr>
            <?php endforeach; ?>

        </tbody>

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