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
        <h2>Hasil Penilaian Perbulan</h2>
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
                <th class="text-center">NIK</th>
                <th class="text-center">Nama Karyawan</th>
                <th class="text-center">Nilai</th>
                <th class="text-center">Kategorisasi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            $total = 0;
            ?>
            <?php
            $nik = $this->session->userdata("nik");
            $level = $this->session->userdata("level");

            foreach ($cetak_dashboard_pdf as $cdk):
                if ($nik !== $cdk['nik'] && $level !== "hc") {
                    continue;
                }
                $nilaiakumulasi = (($cdk['total_nilai_kuesioner']) + ($cdk['total_nilai_kinerja'])) / 2; ?>

                <tr>
                    <td style="text-align: center;">
                        <?= $no++ ?>
                    </td>

                    <td style="text-align: center;">
                        <?= $cdk['nik']; ?>
                    </td>
                    <td style="text-align: center;">
                        <?= $cdk['nama_karyawan']; ?>
                    </td>

                    <td style="text-align: center;">
                        <?= $nilaiakumulasi ?>
                    </td>
                    <td style="text-align: center;">
                        <?php

                        if ($nilaiakumulasi >= 80 && $nilaiakumulasi <= 100) {
                            echo "Sangat Baik";
                        } else if ($nilaiakumulasi >= 60 && $nilaiakumulasi <= 79) {
                            echo "Baik";
                        } else if ($nilaiakumulasi >= 40 && $nilaiakumulasi <= 59) {
                            echo "Cukup";
                        } else if ($nilaiakumulasi >= 20 && $nilaiakumulasi <= 39) {
                            echo "Kurang";
                        } else if ($nilaiakumulasi >= 0 && $nilaiakumulasi <= 19) {
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