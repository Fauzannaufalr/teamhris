<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-6">
            <!-- general form elements -->
            <div class="card">
                <?= $this->session->flashdata('message'); ?>
<<<<<<< Updated upstream
                <div class="card-header" style="background-color: #cc0000;">
=======
                <div class="card-header" style="background-color: #8b0000;">
>>>>>>> Stashed changes
                    <h3 class="card-title" style="color: #ffffff;">Ubah Profile</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="<?= base_url('hris/ubahprofile') ?>" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?= $user['nama_karyawan']; ?>">
                            <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" value="<?= $user['email']; ?>">
                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $user['alamat']; ?>">
                            <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="telepon">Nomor Telepon</label>
                            <input type="text" class="form-control" id="telepon" name="telepon" value="<?= $user['telepon']; ?>">
                            <?= form_error('no_telp', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <div class="row" style="vertical-align: middle;">
                                <div class="col-sm-3">
                                    <img src="<?= base_url('dist/img/profile/') . $user['foto']; ?>" class="img-thumbnail">
                                </div>
                                <div class="col-sm-9">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="foto" name="foto">
                                        <label class=" custom-file-label" for="foto">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer" style="text-align: right;">
<<<<<<< Updated upstream
                        <button type="submit" class="btn btn-danger" style="background-color: #cc0000;">Simpan</button>
                        <a href="<?= base_url('hris/profile'); ?>" class="btn" style="background-color: #d4d4d4;">Kembali</a>
=======
                        <button type="submit" class="btn btn-danger" style="background-color: #8b0000;">Simpan</button>
                        <a href="<?= base_url('hris/profile'); ?>" class="btn"
                            style="background-color: #d4d4d4;">Kembali</a>
>>>>>>> Stashed changes
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->