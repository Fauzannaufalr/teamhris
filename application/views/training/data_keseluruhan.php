<div class="container-fluid">

    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4">
                    <?php if (validation_errors()) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= validation_errors(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <?= $this->session->flashdata('message'); ?>
                </div>
            </div>
            <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#tambahdatakeseluruhan"><i class="fas fa-plus"></i>
                Tambah Data
            </button>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Ulasan</th>
                        <th>dokumen</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($datakeseluruhan as $dk) : ?>
                        <tr>
                            <th><?= $no++; ?></th>
                            <td><?= $dk['nama']; ?></td>
                            <td><?= $dk['kategori']; ?></td>
                            <td><?= $dk['ulasan']; ?></td>
                            <td><a href="<?php echo base_url('training/datakeseluruhan/download_file/' . $dk['file']); ?>"><span class="glyphicon glyphicon-download-alt">Download Dokumen</a></td>
                            <td>
                                <button type="button" class="btn btn-default" style="font-size: 14px; color: black; background-color: #fbff39;" data-toggle="modal" data-target="#ubahdatakeseluruhan<?= $dk['id_keseluruhan']; ?>">edit</button>
                                <button type="button" class="btn btn-danger" style="font-size: 12px; color: white; background-color:  #ff0000;" data-toggle="modal" data-target="#modal-sm<?= $dk['id_keseluruhan'] ?>">hapus</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>

<!-- modal untuk tambah data -->
<div class="modal fade" id="tambahdatakeseluruhan" tabindex="-1" aria-labelledby="tambahdatakeseluruhanLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahdatakeseluruhanLabel">Tambah Data Karyawan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('training/datakeseluruhan/tambah') ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Nama">
                    </div>
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <input type="text" class="form-control" id="kategori" name="kategori" placeholder="Masukan Kategori">
                    </div>
                    <div class="form-group">
                        <label for="ulasan">Ulasan</label>
                        <textarea type="text" class="form-control" id="ulasan" name="ulasan" placeholder="Masukan Ulasan"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="dokumen">Dokumen</label>
                        <input type="file" class="form-control" name="dokumen" placeholder="Masukan Dokumen">
                    </div>
                </div>
                <!-- modal footer  -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-danger">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Akhir tambah Modal -->

<!-- Modal edit data -->
<?php foreach ($datakeseluruhan as $dk) : ?>
    <div class="modal fade" id="ubahdatakeseluruhan<?= $dk['id_keseluruhan']; ?>" tabindex="-1" aria-labelledby="ubahdatakeseluruhanLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahdatakeseluruhanLabel">Ubah Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('training/datakeseluruhan/ubah') ?>" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="id_keseluruhan" value="<?= $dk['id_keseluruhan']; ?>">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?= $dk['nama']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <input type="text" class="form-control" id="kategori" name="kategori" value="<?= $dk['kategori']; ?>">
                        </div>
                        <div class=" form-group">
                            <label for="nama">Ulasan</label>
                            <textarea class="form-control" name="ulasan"><?= $dk['ulasan']; ?></textarea>
                            <div class=" form-group">
                                <label for="nama">Dokumen</label>
                                <input type="file" class="form-control" id="nama" name="dokumen" value="<?= $dk['file']; ?>">
                            </div>
                        </div>

                        <!-- modal footer  -->
                        <div class=" modal-footer">
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
<?php foreach ($datakeseluruhan as $dk) : ?>
    <div class="modal fade" id="modal-sm<?= $dk['id_keseluruhan']; ?>" tabindek="-1" role+dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    x
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin untuk menghapus data ?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn" data-dismiss="modal" style="background-color: #d4d4d4;">Tidak</button>
                    <a href="<?= base_url() ?>training/datakeseluruhan/hapus/<?= $dk['id_keseluruhan'] ?>" type="submit" class="btn" style="background-color: #ff0000; color: white;">Ya</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach; ?>
<!-- akhir modal hapus -->