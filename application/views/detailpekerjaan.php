<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('dist/css/styledetail.css') ?>" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <section class="foto">
        <div class="foto-carve">
            <div class="overlay">
                <h3>PT. Sahaware Teknologi Indonesia</h3>
                <p>Membuka kesempatan berkarir <br> bersama kami <br> untuk posisi </BR></p>

            </div>
        </div>
    </section>
    <div class="job">
        <h4>DESKRIPSI PEKERJAAN</h4>


        <h3>KUALIFIKASI</h3>


    </div>
    <ul>
        <?php foreach ($array_deskripsi as $deskripsi) : ?>
            <li><?= $deskripsi ?></li>
        <?php endforeach; ?>
    </ul>
    <div class="ombak">
        <h1>ombak</h1>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>

</html>