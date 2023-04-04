<!DOCTYPE html>
<!---Coding By CodingLab | www.codinglabweb.com--->
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <!--<title>Registration Form in HTML CSS</title>-->
    <!---Custom CSS File--->
    <link rel="stylesheet" href="<?= base_url() ?>dist/css/styleupload.css" type="text/css" />
    <title>Upload Hasil Tes</title>
</head>

<body>

    <section class="container">
        <header>Upload Hasil Tes</header>
        <form action="<?= base_url('uploadtes/upload_hasiltes') ?>" method="POST" enctype="multipart/form-data" class="form">
            <div class="input-box">
                <label>Nama</label>
                <input type="text" placeholder="Masukan Nama Anda" name="nama" required />
            </div>

            <div class="input-box">
                <label>Posisi</label>
                <select class="form-control" id="posisi" name="posisi">
                    <option>-- Pilih Posisi --</option>
                    <?php foreach ($dataposisi as $dp) : ?>
                        <option value="<?= $dp['id_posisi']; ?>"><?= $dp['nama_posisi']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="input-box">
                <label for="uploadlink">Upload Hasil Tes(LINK)</label>
                <input type="text" class="form-control" id="uploadlink" name="uploadlink">
            </div>
            <div class="input-box">
                <label for="uploadfile">Upload Hasil Tes(FILE)</label>
                <input type="file" class="form-control" id="uploadfile" name="uploadfile">
            </div>
            <button>Submit</button>
        </form>

    </section>
</body>

</html>