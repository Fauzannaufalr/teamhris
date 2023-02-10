<!DOCTYPE html>
<!-- Created By CodingLab - www.codinglabweb.com -->
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <!---<title> Responsive Registration Form | CodingLab </title>--->
    <link rel="stylesheet" href="<?= base_url('dist/css/style.css') ?>" />
    <link rel="stylesheet" href="<?= base_url()  ?> dist/css/adminlte.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="container">
        <div class="title">Masukan Data Anda</div>
        <div class="content">
            <form action="#">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Nama Posisi</span>
                        <input type="text" placeholder="Masukan Nama Posisi" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Alamat Lengkap</span>
                        <input type="text" placeholder="Masukan Alamat Lengkap" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Nama Lengkap</span>
                        <input type="text" placeholder="Masukan Nama Lengkap" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Deskripsi Diri</span>
                        <input type="text" placeholder="Masukan Deskripsi Diri" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Pendidikan</span>
                        <input type="text" placeholder="Pendidikan" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Nomor Telepon</span>
                        <input type="text" placeholder="Masukan Nomor Telepon" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Upload File CV (PDF)</span>
                        <input type="text" placeholder="Upload File CV" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Email</span>
                        <input type="text" placeholder="Masukan Email " required>
                    </div>
                    <div class="button" style="display: flex; text-align: right;">
                        <input type="submit" value="Simpan">
                        <input type="submit" value="Batal">
                    </div>
                </div>
            </form>
        </div>
    </div>

</body>

</html>