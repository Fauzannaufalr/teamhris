<div class="container-fluid">

    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <?php if (validation_errors()): ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-lg-4">
                    <?= $this->session->flashdata('message'); ?>
                </div>
            </div>

            <?php if ($this->session->userdata('level') !== 'biasa')
                if ($this->session->userdata('level') !== 'leader') { ?>

                <?php } ?>


            <form method="POST">
                <div class=" table-responsive">
                    <table id="" class="table table-bordered table-striped">
                        <thead style="background-color: #cc0000; color: white;">
                            <tr style="text-align: center;">
                                <th>No</th>
                                <th>Soal</th>
                                <th>Nilai</th>
                                <th>Aksi</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($detailkuesioner as $dk): ?>
                                <tr>
                                    <td style="text-align: center;">
                                        <?= $no++ ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?= $dk['total_soal'] ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?= $dk['total_nilai'] ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <a href=<?= base_url("performances/penilaiankuesioner") ?> type="button"
                                            style="background-color: #d4d4d4" ; class="btn btn-Info">
                                            Kembali
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                        </tbody>

                    </table>

                </div>
            </form>
        </div>
    </div>
</div>