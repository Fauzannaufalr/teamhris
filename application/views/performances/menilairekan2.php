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

      <form method="POST" action="<?= base_url('performances/MenilaiRekan2/simpan') ?>">

        <div class=" form-group col-md-4">

          <label>Menilai</label>
          <select required class=" form-control" name="nik_menilai" id="nik_menilai">
            <option>-- Pilih Karyawan --</option>
            <?php foreach ($datakaryawan as $dk):
              if (in_array($dk['nik'], $sudah_menilai))
                continue; ?>
              <option value="<?= $dk['nik']; ?>"><?= $dk['nik']; ?> - <?= $dk['nama_karyawan']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>


        <div class="table-responsive">
          <table id="" class="table table-bordered table-striped">
            <thead style="background-color:  #8b0000; color: white;">
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
                    <select required name="nilai[<?= $sk['id_kuesioner']; ?>]" class="form-control">
                      <option disabled="" selected="">--Berikan Penilaian--</option>
                      <option value="5">Sangat Baik</option>
                      <option value="4">Baik</option>
                      <option value="3">Cukup</option>
                      <option value="2">Kurang Baik</option>
                      <option value="1">Sangat Kurang Baik</option>
                    </select>
                  </td>
                </tr>
              <?php endforeach; ?>
              <tr>
            </tbody>

          </table>
          <input required type="text" name="saran" placeholder="Masukan Saran Anda" class="form-control">
          <br>
          <button name="simpan" value="kirim" type="submit" class="btn btn-info">Simpan Penilaian</button>
        </div>
      </form>
    </div>