<div class="container-fluid">

    <div class="row">
        <div class="col-lg-9">
            <?= form_open_multipart('profile/ubahprofile');  ?>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="email" name="email" value="<?= $user['email'];  ?>" readonly>

                </div>
                <div class=" form-group row">
                    <label for="nama" class="col-sm-2 clo-form-label">Nama Lengkap</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" value="<?= $user['name']; ?>">
                        <? form_error('name', '<small class="text-danget pl-3">', '</small>');  ?>

                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">Gambar</div>
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col-sm-3">
                                <img src="<?= base_url('dist/img/profile/') . $user['image'];  ?>" class="img-thumbnai " alt="">
                            </div>
                            <div class="col-sm-9">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image" name="image">
                                    <label for="image" class="custom-file-label">Pilih file</label>

                                </div>
                            </div>

                        </div>

                    </div>


                </div>
                <div class="form-group row justify-contet-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Ubah</button>
                        <button class="btn btn-dark" onclick="window.history. go(-1)">Kembali</button>

                    </div>

                </div>

            </div>

        </div>

    </div>


</div>