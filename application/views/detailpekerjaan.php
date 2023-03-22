<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('dist/css/styledetail.css') ?>" type="text/css" />
    <link rel="stylesheet" href="<?= base_url() ?>plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <section class="foto">
        <div class="foto-carve">
            <div class="overlay">
                <div class="lowongan">

                    <h3>Detail Karir</h3>
                    <p style="margin-left: 90px;"> posisi </BR></p>
                    <?php foreach ($posisi as $dp) : ?>
                        <?php if ($dp['id_posisi'] == $pekerjaan['id_posisi']) : ?>
                            <h1><?= $dp['nama_posisi']  ?></h1>
                        <?php endif ?>
                    <?php endforeach ?>
                </div>

            </div>
        </div>
    </section>
    <button>Daftar Sekarang </button>

    <div class="job">
        <h3>DESKRIPSI PEKERJAAN</h3>
        <ul>
            <?php foreach ($array_deskripsi as $deskripsi) : ?>
                <li><?= $deskripsi ?></li>
            <?php endforeach; ?>
        </ul>
        <h3>KUALIFIKASI</h3>
        <ul>
            <?php foreach ($array_kualifikasi as $kualifikasi) : ?>
                <li><?= $kualifikasi ?></li>
            <?php endforeach; ?>
        </ul>
        <h3>Deadline Pendaftaran</h3>
        <p><?= $pekerjaan['tanggal_berakhir']  ?></p>

    </div>

    <footer class="footer-distributed">

        <div class="footer-left">

            <img src="<?php echo base_url('dist/img/sahaware.jpg'); ?>" width="100px" height="80px" alt="Gambar Latar Belakang"><br><br><br><br><br>

            <p class="footer-company-name">© 2023 Sahaware Indonesia</p>
        </div>

        <div class="footer-center">

            <div>
                <i>Information</i><br><br>
                <p><i class="fas fa-map-marker-alt"></i><a href="https://goo.gl/maps/QP4dvUvw1e3TRaMd9">Jl. Terusan Jakarta Utara, Komplek Daichi No. 69 Antapani - Bandung 40282</a></p><br><br>
                <p><i class="fas fa-phone-alt"></i><a href="">0811-1244-040</a></p><br><br>
                <p><i class="fas fa-envelope"></i><a href="">office@sahaware.co.id</a></p>
            </div>

        </div>

        <div class="footer-right">

            <p class="footer-company-about">
                <span>Layanan Kami</span><br><br>
            </p>
            <p href="">Custom Applicatiop Development</p><br><br>
            <p href="">Digital Product Development</p><br><br>
            <p href="">Software Development Outsourcing</p>

        </div>

    </footer>


    <?php foreach ($pekerjaan as $pk) : ?>
        <div class="modal fade" id="uploadcv<?= $pk['id_pekerjaan'] ?>" tabindex="-1" aria-labelledby="uploadcvLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="uploadcvLabel">Upload CV Anda</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('tampilan/upload_cv') ?>" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id_posisi" value="<?= $pk['id_posisi'] ?>">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Masukan Email Anda">
                            </div>
                            <div class="form-group">
                                <label for="cv">Upload CV (PDF)</label>
                                <input type="file" class="form-control" id="cv" name="cv">
                            </div>
                            <!-- modal footer  -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                <button type="submit" class="btn btn-danger">Simpan</button>
                            </div>
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