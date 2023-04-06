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
        <h2>Hasil Akumulasi Penilaian</h2>
    </center>

    <?php
    if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
        $bulan = $_GET['bulan'];
        $tahun = $_GET['tahun'];
        $bulantahun = $bulan . "/" . $tahun;
    } else {
        $bulan = date('m');
        $tahun = date('Y');
        $bulantahun = $bulan . "/" . $tahun;
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
                $akumulasi = ($ck['nilai'] + $ck['total_nilai']) / 2;
                ?>
                <tr>
                    <td style="text-align: center;">
                        <?= $no++ ?>
                    </td>

                    <td style="text-align: center;">
                        <?= $ck['nik'], "<br>" .
                            $ck['nama_karyawan']; ?>
                    </td>
                    <td style="text-align: center;">
                        <?= $ck['nilai'] ?>
                    </td>
                    <td style="text-align: center;">
                        <?= $ck['total_nilai'] ?>
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

    <table width="100%">
        <tr>
            <td></td>
            <td width="200px">
                <p>Bandung,
                    <?= date("d M Y") ?> <br>Human Capital
                </p>
                <br>
                <br>
                <p>Aisyiah Ummul Mutqinah S.Psi.M.Psi</p>

            </td>
        </tr>
    </table>
</body>

</html>


<script type="text/javascript">
    window.print();
</script>