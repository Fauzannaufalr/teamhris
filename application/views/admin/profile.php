<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>
    <div class="card mb-3 col-lg-8" style="max-width: 540px;">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="<?= base_url('dist/img/profile/') . $user['foto'];  ?>" class="card-img" alt="">

            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?= $user['nama_karyawan'];  ?></h5>
                    <p class="card-text"><?= $user['email'];  ?></p>
                    <div class="mt-lg-5">
                        <button href="<?= base_url('admin/ubahprofile');  ?>" class="btn btn-info"><i class="fas fa-user-edit"></i>Ubah Profile</button>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>