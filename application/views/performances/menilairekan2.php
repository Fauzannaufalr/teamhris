<div class="container-fluid">

    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-lg-4">
                    <?= $this->session->flashdata('message'); ?>
                </div>
            </div>

            <div class=" form-group mr-auto">
                            <label>Pilih Penilaian</label>
                            <select class="form-control" name="nik_nama" id="nik_nama">
                                <option >-- Pilih Karyawan --</option>
                                <?php foreach ($datakaryawan as $dk) : ?>
                                    <option value="<?= $dk['id_karyawan']; ?>"><?= $dk['nik']; ?> - <?= $dk['nama_karyawan']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
         
               <div class=" form-group">
                           
                           <label>Menilai</label>
                           <select class="form-control" name="nik_nama" id="nik_nama">
                               <option >-- Pilih Karyawan --</option>
                               <?php foreach ($datakaryawan as $dk) : ?>
                                   <option value="<?= $dk['id_karyawan']; ?>"><?= $dk['nik']; ?> - <?= $dk['nama_karyawan']; ?></option>
                               <?php endforeach; ?>
                           </select>
                       </div>
         

<form method="POST">
          <div class="table-responsive">
            <table id="" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Pertanyaan</th>
                  <th>Jawaban</th>
                </tr>
              </thead>
              <tbody>

             <tr>
                  <td>Methode pembelajaran bervariasi ?</td>
                  <td>
                    <select name="soal_kuesioner" class="form-control">
                      <option disabled="" selected="">--Berikan Penilaian--</option>
                      <?php foreach ($soalkuesioner as $sk) : ?>
                                    <option value="<?= $sk['id_kuesioner']; ?>"></option>
                       <?php endforeach; ?>
                    </select>
                  </td>
                </tr>
                                <tr>
                  <td>Apakah Dosen Datang Tepat Waktu ??</td>
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
                                <tr>
                  <td>Karyawan mampu menanggapi keluhan wajib pajak</td>
                  <td>
                    <select name="data3" class="form-control">
                      <option disabled="" selected="">--Berikan Penilaian--</option>
                      <option value="10">Sangat Baik</option>
                      <option value="9">Baik</option>
                      <option value="8">Cukup</option>
                      <option value="7">Kurang Baik</option>
                      <option value="6">Sangat Kurang Baik</option>
                    </select>
                  </td>
                </tr>
                                <tr>
                  <td>Karyawan berada ditempat saat dibutuhkan wajib pajak</td>
                  <td>
                    <select name="data4" class="form-control">
                      <option disabled="" selected="">--Berikan Penilaian--</option>
                      <option value="10">Sangat Baik</option>
                      <option value="9">Baik</option>
                      <option value="8">Cukup</option>
                      <option value="7">Kurang Baik</option>
                      <option value="6">Sangat Kurang Baik</option>
                    </select>
                  </td>
                </tr>
                 <tr>
                  <td>Pengetahuan dan kecakapan karyawan dalam menjalankan tugas</td>
                  <td>
                    <select name="data5" class="form-control">
                      <option disabled="" selected="">--Berikan Penilaian--</option>
                      <option value="10">Sangat Baik</option>
                      <option value="9">Baik</option>
                      <option value="8">Cukup</option>
                      <option value="7">Kurang Baik</option>
                      <option value="6">Sangat Kurang Baik</option>
                    </select>
                  </td>
                </tr>
                                <tr>
                  <td>Ketelitian karyawan dalam menjalankan tugas</td>
                  <td>
                    <select name="data6" class="form-control">
                      <option disabled="" selected="">--Berikan Penilaian--</option>
                      <option value="10">Sangat Baik</option>
                      <option value="9">Baik</option>
                      <option value="8">Cukup</option>
                      <option value="7">Kurang Baik</option>
                      <option value="6">Sangat Kurang Baik</option>
                    </select>
                  </td>
                </tr>
                                <tr>
                  <td>Pelayanan tidak membedakan status sosial wajib pajak</td>
                  <td>
                    <select name="data7" class="form-control">
                      <option disabled="" selected="">--Berikan Penilaian--</option>
                      <option value="10">Sangat Baik</option>
                      <option value="9">Baik</option>
                      <option value="8">Cukup</option>
                      <option value="7">Kurang Baik</option>
                      <option value="6">Sangat Kurang Baik</option>
                    </select>
                  </td>
                </tr>
                                <tr>
                  <td>Kebersihan dan kenyamanan kantor</td>
                  <td>
                    <select name="data8" class="form-control">
                      <option disabled="" selected="">--Berikan Penilaian--</option>
                      <option value="10">Sangat Baik</option>
                      <option value="9">Baik</option>
                      <option value="8">Cukup</option>
                      <option value="7">Kurang Baik</option>
                      <option value="6">Sangat Kurang Baik</option>
                    </select>
                  </td>
                </tr>
                                <tr>
                  <td>sistem antrian yang teratur tampa membedakan status tiap nasabah</td>
                  <td>
                    <select name="data9" class="form-control">
                      <option disabled="" selected="">--Berikan Penilaian--</option>
                      <option value="10">Sangat Baik</option>
                      <option value="9">Baik</option>
                      <option value="8">Cukup</option>
                      <option value="7">Kurang Baik</option>
                      <option value="6">Sangat Kurang Baik</option>
                    </select>
                  </td>
                </tr>
                                <tr>
                  <td>Jasa yang diberikan karyawan sudah tercapai</td>
                  <td>
                    <select name="data10" class="form-control">
                      <option disabled="" selected="">--Berikan Penilaian--</option>
                      <option value="10">Sangat Baik</option>
                      <option value="9">Baik</option>
                      <option value="8">Cukup</option>
                      <option value="7">Kurang Baik</option>
                      <option value="6">Sangat Kurang Baik</option>
                    </select>
                  </td>
                </tr>
              
              </tbody>

            </table>

            <button name="simpan" type="submit" class="btn btn-info">Simpan Penilaian</button>
          </div>
        </form>
 </div>