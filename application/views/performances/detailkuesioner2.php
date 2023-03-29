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
                        <thead style="background-color: #8b0000; color: white;">
                            <tr style="text-align: center;">
                                <th>No</th>
                                <th>Menilai</th>
                                <th>Menilai</th>
                                <th>Aksi</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            // $total = $total + $d["nilai"];
                            ?>
                            <?php foreach ($detailkuesioner as $d):

                                ?>
                                <tr>
                                    <td style="text-align: center;">
                                        <?= $no++ ?>
                                    </td>

                                    <td style="text-align: center;">
                                        <?= $d['nik'], "<br>" .
                                            $d['nama_karyawan']; ?>
                                    </td>
                                    <td>
                                        <?= $d['menilai_orang']; ?> Orang

                                    </td>

                                    <td style="text-align: center;">
                                        <a class=" badge"
                                            href="<?= base_url() ?>performances/penilaiankuesioner/detail1/<?= $d['nik'] ?>"
                                            type=" button" style="background-color: #d4d4d4" ;><i class="fas fa-share"></i>
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>


                </div>
            </form>
        </div>
    </div>
</div>