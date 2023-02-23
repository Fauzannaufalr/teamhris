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
                    <h5 class="card-title" style="margin-bottom: 3px;"><?= $user['nama_karyawan'];  ?></h5>
                    <p class="card-text"style="margin-bottom: 3px;"><?= $user['email'];  ?></p>
                    <p class="card-text"style="margin-bottom: 3px;"><?= $user['alamat'];  ?></p>
                    <p class="card-text"style="margin-bottom: 3px;"></p><?= $user['telepon'];  ?></p>
                    <a class="btn" style="background-color: #ff0000; color: white;" href="<?= base_url('admin/ubahprofile'); ?>">Ubah Profile</a>
                </div>
            </div>
        </div>

    </div>

</div>

</div>