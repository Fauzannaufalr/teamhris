<div class="container-fluid">

    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">

            <?php if ($this->session->userdata('level') !== 'biasa')
                if ($this->session->userdata('level') !== 'leader') { ?>

                <?php } ?>


            <form method="POST">
                <div class=" table-responsive">
                    <table id="" class="table table-bordered table-striped">
                        <thead style="background-color: #cc0000; color: white;">
                            <tr style="text-align: center;">
                                <th>No</th>
                                <th>NIk & Nama Karyawan</th>
                                <th>Nilai Kinerja</th>
                                <th>Nilai Kuesioner</th>
                                <th>Nilai </th>
                                <th>Kategorisasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            $total = 0;
                            ?>
                            <?php foreach ($detail as $d):

                                ?>
                                <tr>
                                    <td style="text-align: center;">
                                        <?= $no++ ?>
                                    </td>

                                    <td>
                                        <?= $d['nik'],
                                            $d['nama_karyawan']; ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?= $d['nilai'] ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?= $d['total'] ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?= ($d['nilai'] + $d['total']) / 2; ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?php
                                        $total_nilai = ($d['nilai'] + $d['total']) / 2;
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
                    <a href=<?= base_url("performances/akumulasi") ?> type="button" style="background-color: #d4d4d4" ;
                        class="btn btn-Info">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>