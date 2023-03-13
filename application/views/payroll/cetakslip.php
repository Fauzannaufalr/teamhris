<!DOCTYPE html>
<html lang="en"><head>
    <title>Slip Gaji</title>
    <style type="text/css">
        body {
            font-family: Arial;
            color: black;
        }
    </style>
</head><body>
    <center>
        <h1>PT. Sahaware Teknologi Indonesia</h1>
        <h2>Slip Gaji Karyawan</h2>
        <hr style="width: 50%; border-width: 5px; color: black">
    </center>

    <?php foreach ($slipgaji as $sg) : ?>

        <table style="width: 100%">
            <tr>
                <td width="20%">Nama Pegawai</td>
                <td width="2%">:</td>
                <td><?= is_array($sg['nama_karyawan']) ?></td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>:</td>
                <td><?= is_array($sg['nik']) ?></td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td><?= is_array($sg['nama_posisi']) ?></td>
            </tr>
        </table>

        <table class="table table-striped table-bordered mt-3">
            <tr>
                <th class="text-center" width="5%">No</th>
                <th class="text-center">Keterangan</th>
                <th class="text-center">Jumlah</th>
            </tr>
            <tr>
                <td>1</td>
                <td>Gaji Pokok</td>
                <td>Rp. <?= number_format(is_array($sg['gajipokok']), 0, ',', '.') ?></td>
            </tr>

            <tr>
                <td>2</td>
                <td>BPJS Kesehatan</td>
                <td>Rp. <?= number_format(is_array($sg['bpjs']), 0, ',', '.') ?></td>
            </tr>

            <tr>
                <td>3</td>
                <td>Pajak Karyawan</td>
                <td>Rp. <?= number_format(is_array($sg['pajak']), 0, ',', '.') ?></td>
            </tr>

            <tr>
                <td>4</td>
                <td>Tunjangan Kinerja</td>
                <td>Rp. <?= number_format(is_array($sg['t_kinerja']), 0, ',', '.') ?></td>
            </tr>

            <tr>
                <td>5</td>
                <td>Tunjangan Fungsional</td>
                <td>Rp. <?= number_format(is_array($sg['t_fungsional']), 0, ',', '.') ?></td>
            </tr>

            <tr>
                <td>6</td>
                <td>Tunjangan Jabatan</td>
                <td>Rp. <?= number_format(is_array($sg['t_jabatan']), 0, ',', '.') ?></td>
            </tr>

            <tr>
                <td>6</td>
                <td>Potongan</td>
                <td>Rp. <?= number_format(is_array($sg['potongan']), 0, ',', '.') ?></td>
            </tr>

            <tr>
                <td>7</td>
                <td>Bonus</td>
                <td>Rp. <?= number_format(is_array($sg['bonus']), 0, ',', '.') ?></td>
            </tr>

            <tr>
                <th colspan="2" style="text-align: right;">Total Gaji : </th>
                <th>Rp. <?= number_format(is_array($sg['total']), 0, ',', '.') ?></th>
            </tr>
        </table>

        <table width="100%">
            <tr>
                <td></td>
                <td width="200px">
                    <p>Bandung, <?= date("d M Y") ?> <br> Finance,</p>
                    <br>
                    <br>
                    <p>___________________</p>
                </td>
            </tr>
        </table>
    <?php endforeach; ?>
</body></html>