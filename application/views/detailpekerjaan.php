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

    </div>
    <br>
    <!-- Begin Page Content -->
    <div class="container" style="margin: auto; max-width: fit-content; padding: 10px;">
        <div class="row">
            <div style="width: 20rem; margin-left: 5px; margin-right: 5px;">
                <center>
                    <?php foreach ($posisi as $dp) : ?>
                        <?php if ($dp['id_posisi'] == $pekerjaan['id_posisi']) : ?>
                            <h3><?= $dp['nama_posisi']; ?></h3>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </center>
                <p> <?= $pekerjaan['kualifikasi']  ?> </p>

            </div>
        </div>
    </div>









    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>

</html>