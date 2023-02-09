<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h2><?= $title; ?></h2>

    <div class="row">
        <div class="col-lg-6">
            <form action="<?= base_url('admin/ubahpassword'); ?>" method="POST">
                <div class="form-group">
                    <label for="current_password">Password Lama</label>
                    <input type="password" class="form-control" id="current_password" name="current_password">
                </div>
                <div class="form-group">
                    <label for="new_password1">Password Baru</label>
                    <input type="password" class="form-control" id="new_password1" name="new_password1">
                </div>
                <div class="form-group">
                    <label for="new_password2">Konfirmasi Password</label>
                    <input type="password" class="form-control" id="new_password2" name="new_password2">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-outline-secondary">Ubah Password</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->