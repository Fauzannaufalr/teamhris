<div class="container-fluid">

    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <button type="button" class="btn btn-outline-success mb-2" data-toggle="modal" data-target="#modal-AddData"><i class="fas fa-plus"></i>
                Tambah Karyawan
            </button>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama Karyawan</th>
                        <th>Posisi</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Gaji Pokok</th>
                        <th>Level</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($datakaryawan as $k) : ?>
                        <tr>
                            <th><?= $no++; ?></th>
                            <td><?= $k['nik']; ?></td>
                            <td><?= $k['nama_karyawan']; ?></td>
                            <td><?= $k['id_posisi']; ?></td>
                            <td><?= $k['email']; ?></td>
                            <td><?= $k['status']; ?></td>
                            <td><?= $k['gajipokok']; ?></td>
                            <td><?= $k['level']; ?></td>
                            <td><?= $k['foto']; ?></td>
                            <td>
                                <a href="" class="badge bg-success">edit</a>
                                <a href="<?= base_url() ?>master/DataKaryawan/hapus/<?= $k['id']  ?>" class="badge bg-danger">delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>


<div class="modal fade" id="modal-AddData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-AddData">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     
      <div class="modal-body">
      <form class="form-horizontal" name="frmdatakaryawan" method="post" action="<?= base_url() ?>master/DataKaryawan/addData">
        <div class="card-body">
            <div class="form-group row">
       <label for="inputNik" class="col-sm-2 col-form-label">NIK</label>
    <div class="col-sm-10">
        <input type="text" name="nik" class="form-control" id="inputNik" placeholder="NIK">
    </div>  
    </div>

    <div class="form-group row">
       <label for="inputNama" class="col-sm-2 col-form-label">Nama</label>
    <div class="col-sm-10">
        <input type="text" name="nama" class="form-control" id="inputNama" placeholder="Masukan Nama">
    </div>  
    </div>

    <div class="form-group row">
       <label for="inputPosisi" class="col-sm-2 col-form-label">Posisi</label>
    <div class="col-sm-10">
        <input type="text" name="posisi" class="form-control" id="inputPosisi" placeholder="Pilih Posisi">
    </div>  
    </div>

    <div class="form-group row">
       <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
        <input type="text" name="email"  class="form-control" id="inputEmail" placeholder="Email">
    </div>  
    </div>

    <div class="form-group row">
       <label for="inputStatus" class="col-sm-2 col-form-label">Status</label>
    <div class="col-sm-10">
        <input type="text" name="status"  class="form-control" id="inputStatus" placeholder="Status">
    </div>  
    </div>

    <div class="form-group row">
       <label for="inputGaji" class="col-sm-2 col-form-label">Gajipokok</label>
    <div class="col-sm-10">
        <input type="text" name="gajipokok"  class="form-control" id="inputGajipokok" placeholder="GajiPokok">
    </div>  
    </div>
    
    <div class="form-group row">
       <label for="inputLevel" class="col-sm-2 col-form-label">Level</label>
    <div class="col-sm-10">
        <input type="text" name="level"  class="form-control" id="inputLevel" placeholder="Masukan Level">
    </div>  
    </div>
    
    <div class="form-group row">
       <label for="inputFoto" class="col-sm-2 col-form-label">Foto</label>
    <div class="col-sm-10">
        <input type="file" name="foto"  class="form-control" id="inputFoto" placeholder="Pilih Foto">
    </div>  
    </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
</div>
</form>