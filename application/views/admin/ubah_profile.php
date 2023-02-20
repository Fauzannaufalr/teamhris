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

                </div>


            </div>

        </div>

    </div>


</div>