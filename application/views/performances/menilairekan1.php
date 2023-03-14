<div class="container-fluid">

  <div class="card">
    <!-- /.card-header -->
    <div class="card-body">
      <?php if (validation_errors()): ?>
        <div class="alert alert-danger" role="alert">
          <?= validation_errors(); ?>
        </div>
      <?php endif; ?>

      <?php if ($this->session->flashdata('success')): ?>
        <div style="color: green;">
          <?php echo $this->session->flashdata('success'); ?>
        </div>
      <?php endif; ?>
      <div class="form-group col-md-4">
        <label>Penilai</label>
        <input type="hidden" readonly value="<?= $user['id_karyawan']; ?>" id="id_karyawan" class="form-control" />
        <input type="text" readonly value="<?= $user['nama_karyawan']; ?>" class="form-control" />
      </div>

      <div class=" form-group col-md-4">

        <label>Menilai</label>
        <select class=" form-control" name="nik_nama" id="nik_nama">
          <option>-- Pilih Karyawan --</option>
          <?php foreach ($datakaryawan as $dk): ?>
            <option value="<?= $dk['id_karyawan']; ?>"><?= $dk['nik']; ?> - <?= $dk['nama_karyawan']; ?></option>
          <?php endforeach; ?>
        </select>
      </div>


      <form method="POST" action="<?php base_url('performances/MenilaiRekan1/Hasil') ?>">
        <div class="table-responsive">
          <table id="" class="table table-bordered table-striped">
            <thead style="background-color:  #cc0000; color: white;">
              <tr style="text-align: center;">
                <th style="text-align: center;">No</th>
                <th>Pertanyaan</th>
                <th>Jawaban</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; ?>
              <?php foreach ($soalkuesioner as $sk): ?>
                <tr>
                  <td style="text-align: center;">
                    <?= $no++ ?>
                  </td>
                  <td>
                    <?= $sk['kuesioner'] ?>
                  </td>
                  <td>
                    <select name="nilai[<?= $sk['id_kuesioner']; ?>]" class="form-control">
                      <option disabled="" selected="">--Berikan Penilaian--</option>
                      <option value="5" name="jawaban1">Sangat Baik</option>
                      <option value="4" name="jawaban2">Baik</option>
                      <option value="3" name="jawaban3">Cukup</option>
                      <option value="2" name="jawaban4">Kurang Baik</option>
                      <option value="1" name="jawaban5">Sangat Kurang Baik</option>
                    </select>
                  </td>
                </tr>
              <?php endforeach; ?>
              <tr>
            </tbody>

          </table>
          <input type="text" name="saran" placeholder="Masukan Saran Anda" class="form-control">
          <br>
          <button name="simpan" value="kirim" type="submit" class="btn btn-info">Simpan Penilaian</button>
        </div>
      </form>
    </div>