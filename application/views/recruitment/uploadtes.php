<form action="<?php echo site_url('recruitment/uploadtes/upload_hasiltes'); ?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Posisi</label>
        <select class="form-control" id="posisi" name="posisi">
            <option>-- Pilih Posisi --</option>
            <?php foreach ($dataposisi as $dp) : ?>
                <option value="<?= $dp['id_posisi']; ?>"><?= $dp['nama_posisi']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" id="email" name="email" placeholder="Masukan Deskripsi email">
    </div>
    <div class="form-group">
        <label for="cv">Pilih file CV</label>
        <input type="file" class="form-control-file" id="cv" name="cv">
    </div>
    <button type="submit">Upload File</button>
</form>