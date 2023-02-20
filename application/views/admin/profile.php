<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-6 justify-content-x">
            <?= $this->session->flashdata('pesan'); ?>

        </div>
        <div class="card mb-3" style="max-width: 540px;">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <img src="<?= base_url('dist/img/profile/') . $user['image'];  ?>" class="card-img" alt="">

                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"><?= $user['name'];  ?></h5>
                        <p class="card-text"><?= $user['nik'];  ?></p>
                        <p class="card-text"><?= $user['email'];  ?></p>
                        <p class="card-text"><?= $user['posisi']  ?></p>

                    </div>
                    <div class="btn btn-info ml-3 my-3">
                        <a href="<?= base_url('profile/ubahprofile');  ?>" class="text text-white"><i class="fas fa-user-edit"></i>Ubah Profile</a>

                    </div>

                </div>

            </div>

        </div>

    </div>
</div>