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
    <!-- Begin Page Content -->
    <div class="row">
        <?php foreach ($posisi as $dp) : ?>
            <?php if ($dp['id_posisi'] == $pekerjaan['id_posisi']) : ?>
                <center>
                    <h3></h3>
                </center>
                <h3>Deskripsi Pekerjaan</h3>
                <p> </p>
                <h3>kualifikasi</h3>
                <p> <?= $pekerjaan['kualifikasi']  ?> </p>
                <p> <?= $pekerjaan['deskripsi_pekerjaan']  ?> </p>
            <?php endif; ?>
        <?php endforeach; ?>

    </div>
    </div>










    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>

</html>