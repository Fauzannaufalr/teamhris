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
    <!-- Begin Page Content -->
    <?php foreach ($pekerjaan as $pk) : ?>
        <div class="card" style="width: 18rem;">

            <h5><?= $pk['nama_posisi']; ?></h5>

            <img src="<?= base_url('dist/img/profile/') . $pk['foto']; ?>" class="card-img-top" alt="...">
            <div class="card-body">


                <a href="#" class="btn btn-primary">Info Lengkap</a>
                <a href="#" class="btn btn-primary">Daftar Sekarang</a>
            </div>
        </div>
    <?php endforeach; ?>
</body>

</html>