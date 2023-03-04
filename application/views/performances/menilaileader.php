<div class="container-fluid">

  <div class="card">
    <!-- /.card-header -->
    <div class="card-body">
      <?php if (validation_errors()): ?>
        <div class="alert alert-danger" role="alert">
          <?= validation_errors(); ?>
        </div>
      <?php endif; ?>
      <div class="row">
        <div class="col-lg-4">
          <?= $this->session->flashdata('message'); ?>
        </div>
      </div>

      <?php if ($this->session->userdata('level') === 'biasa') { ?>

        <div class="form-group">
          <label>Penilai</label>
          <input type="hidden" readonly value="<?= $user['id_karyawan']; ?>" id="id_karyawan" class="form-control" />
          <input type="text" readonly value="<?= $user['nama_karyawan']; ?>" class="form-control" />
        </div>
      <?php } ?>
      <div class=" form-group">

        <label>Menilai</label>
        <select class="form-control" name="nik_nama" id="nik_nama">
          <option>-- Pilih Karyawan --</option>
          <?php foreach ($datakaryawan as $dk): ?>
            <option value="<?= $dk['id_karyawan']; ?>"><?= $dk['nik']; ?> - <?= $dk['nama_karyawan']; ?></option>
          <?php endforeach; ?>
        </select>
      </div>


      <form method="POST">
        <div class="table-responsive">
          <table id="" class="table table-bordered table-striped">
            <thead style="background-color: #ff0000; color: white;">
              <tr style="text-align: center;">
                <th>No</th>
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
                    <select name="data2" class="form-control">
                      <option disabled="" selected="">--Berikan Penilaian--</option>
                      <option value="10">Sangat Baik</option>
                      <option value="9">Baik</option>
                      <option value="8">Cukup</option>
                      <option value="7">Kurang Baik</option>
                      <option value="6">Sangat Kurang Baik</option>
                    </select>
                  </td>
                </tr>
              <?php endforeach; ?>
              <tr>
            </tbody>

          </table>
          <input type="text" name="saran" placeholder="Masukan Saran Anda" class="form-control">
          <br>
          <button name="simpan" type="submit" class="btn btn-info">Simpan Penilaian</button>
        </div>
      </form>
    </div>