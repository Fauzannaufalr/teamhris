<div class="container-fluid">

    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-lg-4">
                    <?= $this->session->flashdata('message'); ?>
                </div>
            </div>
            <br>
            <table id="" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Posisi</th>
                        <th>Email</th>
                        <th>Hasil tes</th>
                        <th>Nilai PG</th>
                        <th>Nilai Essay</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>