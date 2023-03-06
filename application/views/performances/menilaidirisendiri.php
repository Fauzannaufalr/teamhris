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

      <!-- mengapa dikasih logika session, karena untk menilai diri sendiri, scr otomatis dia yang menilai
           berdaskarkan dari nik karyawan -->
      <?php if ($this->session->userdata('level') !== 'ceo')
        if ($this->session->userdata('level') !== 'hc')
          if ($this->session->userdata('level') !== 'leader')
            if ($this->session->userdata('level') !== 'biasa') { ?>
              <div class="form-group">
                <label>Penilai</label>
                <input type="hidden" readonly value="<?= $user['id_karyawan']; ?>" id="id_karyawan" class="form-control" />
                <input type="text" readonly value="<?= $user['nama_karyawan']; ?>" class="form-control" />
              </div>
            <?php } ?>
      <div class=" form-group">

        <label>Menilai</label>
        <input type="hidden" readonly value="<?= $user['id_karyawan']; ?>" id="id_karyawan" class="form-control" />
        <input type="text" readonly value="<?= $user['nama_karyawan']; ?>" class="form-control" />
      </div>
    </div>


    <form method="POST">
      <div class="table-responsive">
        <table id="" class="table table-bordered table-striped">
          <thead style="background-color: #ff0000; color: white;">
            <tr style="text-align: center;">
              <th>No</ths>
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
          </tbody>
        </table>
        <input type="text" name="saran" placeholder="Masukan Saran Anda" class="form-control">
        <br>
        <button name="simpan" type="submit" class="btn btn-info">Simpan Penilaian</button>
      </div>
    </form>
  </div>