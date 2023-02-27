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
            <button type="button" class="btn btn-outline-success mb-2" data-toggle="modal" data-target="#tambahPenilaianKinerja"><i class="fas fa-plus"></i>
                Tambah Penilaian
            </button>
             <button type="button" class="btn btn-outline-success mb-2" data-toggle="modal" data-target="#tambahDataMasal"><i class="fas fa-plus"></i>
                Tambah Data Masal
            </button>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama Karyawan</th>
                        <th>Posisi</th>
                        <th>Tanggal</th>
                        <th>Total Kerja</th>
                        <th>Done Kerja</th>
                        <th>Nilai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($penilaiankinerja as $pk) : ?>
                        <tr>
                            <th><?= $no++; ?></th>
                            <td><?= $pk['nik']; ?></td>
                            <td><?= $pk['nama_karyawan']; ?></td>
                            <td><?= $pk['nama_posisi']; ?></td>
                            <td><?= $pk['tanggal']; ?></td>
                            <td><?= $pk['total_kerja']; ?></td>
                            <td><?= $pk['done_kerja']; ?></td>
                            <td><?= $pk['nilai']; ?></td>
                           
                            <td>
                                <button type="button" class="btn btn-default" style="font-size: 14px; color: black; background-color: #fbff39;" data-toggle="modal" data-target="#ubahPenilaianKinerja<?= $pk['id_penilaian_kinerja']; ?>">edit</button>
                                <button type="button" class="btn btn-danger" style="font-size: 12px; color: white; background-color:  #ff0000;" data-toggle="modal" data-target="#modal-sm<?= $pk['id_penilaian_kinerja'] ?>">hapus</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>

<!-- modal untuk tambah data masal -->
<div class="modal fade" id="tambahDataMasal" tabindex="-1" aria-labelledby="tambahDataMasalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahDataMasalLabel">Tambah Penilaian Masal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('performances/penilaiankinerja/tambahdatamasal') ?>" method="POST">
            <div class="modal-body">
                    <div class=" form-group">
                        <label for="foto">Pilih File</label>
                        <p><b><i>Format File Excel harus sesuai dengan templates, silahkan klik disini</i></b></p>
                        <input type="file" class="form-control" id="foto" name="foto" placeholder="Masukan foto">
                    </div>
                        
                    <!-- modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-danger">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Akhir tambah data masal Modal -->

<!-- modal untuk tambah data -->
<div class="modal fade" id="tambahPenilaianKinerja" tabindex="-1" aria-labelledby="tambahPenilaianKinerjaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahPenilaianKinerjaLabel">Tambah Penilaian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('performances/penilaiankinerja/tambah') ?>" method="POST">
            <div class="modal-body">
                        <div class=" form-group">
                           
                            <label>NIK & Nama Karyawan</label>
                            <select class="form-control" name="nik_nama" id="nik_nama">
                                <option >-- Pilih Karyawan --</option>
                                <?php foreach ($datakaryawan as $dk) : ?>
                                    <option value="<?= $dk['nik']; ?>"><?= $dk['nik']; ?> - <?= $dk['nama_karyawan']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    <div class="form-group">
                        <label>Posisi</label>
                        <input type="text" readonly id="id_posisi" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="total_kerja">Total kerja</label>
                        <input type="text" class="form-control" id="total_kerja" name="total_kerja" >
                    </div>
                    <div class="form-group">
                        <label for="done_kerja">Done Kerja</label>
                        <input type="text" class="form-control" id="done_kerja" name="done_kerja">
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
<!-- Akhir tambah Modal -->

<!-- Modal edit data -->
<?php foreach ($penilaiankinerja as $pk) : ?>
    <div class="modal fade" id="ubahPenilaianKinerja<?= $pk['id_penilaian_kinerja']; ?>" tabindex="-1" aria-labelledby="ubahPenilaianKinerjaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahPenilaianKinerjaLabel">Ubah Data Karyawan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('performances/penilaiankinerja/ubah') ?>" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="id_penilaian_kinerja" value="<?= $pk['id_penilaian_kinerja']; ?>">
                        <div class=" form-group">
                            <label>NIK & Nama Karyawan</label>
                            <select class="form-control" name="nik_nama" id="nik_nama">
                                <option >-- Pilih Karyawan --</option>
                                <?php foreach ($datakaryawan as $dk) : ?>
                                    <option value="<?= $dk['nik']; ?>"><?= $dk['nik']; ?> - <?= $dk['nama_karyawan']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                             <label>Posisi</label>
                             <input type="text" readonly id="id_posisi" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= $pk['tanggal']; ?>">
                        </div>
                      
                        
                        <div class="form-group">
                            <label for="total_kerja">Total Kerja</label>
                            <input type="text" class="form-control" id="total_kerja" name="total_kerja" value="<?= $pk['total_kerja']; ?>">
                        </div>
                    
                        <div class="form-group">
                            <label for="done_kerja">Done Kerja</label>
                            <input type="text" class="form-control" id="done_kerja" name="done_kerja" value="<?= $pk['done_kerja']; ?>">
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
<?php endforeach; ?>


<!-- Modal Hapus -->
<?php foreach ($penilaiankinerja as $pk) : ?>
    <div class="modal fade" id="modal-sm<?= $pk['id_penilaian_kinerja']; ?>" tabindek="-1" role+dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin untuk menghapus data ?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn" data-dismiss="modal" style="background-color: #d4d4d4;">Tidak</button>
                    <a href="<?= base_url() ?>performances/penilaiankinerja/hapus/<?= $pk['id_penilaian_kinerja']  ?>" type="submit" class="btn" style="background-color: #ff0000; color: white;">Ya</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach; ?>
<!-- ak.hir modal hapus -->
<script>
    const nik_nama = document.getElementById("nik_nama");
    const id_posisi = document.getElementById("id_posisi");
    nik_nama.onchange = function(e) {
        const nik = e.target.value;
        fetch(`/teamhris/performances/penilaiankinerja/ajax_category?nik=${nik}`,{
            method: "GET",
            headers: {
                "Content-Type": "application/json",
            },
        })
        .then(response => response.json())
        .then(response => {
            id_posisi.value = response?.nama_posisi || ""
        })
    }
</script>
