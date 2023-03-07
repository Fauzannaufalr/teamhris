<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('dist/css/stylejob.css') ?>" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <div class="gambar-teks">
        <img src="<?php echo base_url('dist/img/job1.jpeg'); ?>" alt="Gambar Latar Belakang">
        <h1>PT. SAHAWARE TEKNOLOGI INDONESIA</h1>
        <button type="button" class="btn btn-danger" style="background-color: #ff0000;">LOGIN ADMIN</button>
        <h2>Lowongan Pekerjaan</h2>
    </div>
    <br>
    <!-- Begin Page Content -->
    <div class="container" style="margin: auto; max-width: fit-content; padding: 10px;">
        <div class="row">
            <?php foreach ($pekerjaan as $pk) : ?>
                <div class="card" style="width: 20rem; margin-left: 5px; margin-right: 5px;">
                    <center>
                        <h3><?= $pk['nama_posisi']; ?></h3>
                    </center>
                    <img src="<?= base_url('dist/img/profile/') . $pk['foto']; ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <div class="row">

                            <a href="<?= base_url() ?>detailpekerjaan/detail/<?= $pk['id_pekerjaan'] ?>" type="button" style="background-color: #d4d4d4" ; class="btn btn-">
                                Info Lengkap
                            </a>
                            <a type="button" style="margin-left:50px; background-color: #ff0000" ; class="btn btn-primary" data-toggle="modal" data-target="#modal-upload-cv<?= $pk['id_pekerjaan'] ?>">
                                Upload CV
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>




    <?php foreach ($pekerjaan as $pk) : ?>
        <div class="modal fade" id="modal-upload-cv<?= $pk['id_pekerjaan'] ?>" tabindex="-1" role="dialog" aria-labelledby="modal-upload-cv-label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-upload-cv-label">Upload CV</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" enctype="multipart/form-data" action="<?= base_url('tampilan/upload_cv') ?>">
                        <div class="modal-body">
                            <input type="hidden" class="form-control" id="id_posisi" name="id_posisi" value="<?= $pk['id_posisi'] ?>">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Masukan Email">
                            </div>
                            <div class="form-group">
                                <label for="cv">Pilih file CV</label>
                                <input type="file" class="form-control-file" id="cv" name="cv">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach ?>




    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>

</html>