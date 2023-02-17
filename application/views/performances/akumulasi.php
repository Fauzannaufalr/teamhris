<br>
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><?= $title ?></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead style="background-color: #ff0000" >
                <tr>
                    <th>No</th>
                    <th>NIK</th>
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
                        <td><?= $pk['tanggal']; ?></td>
                        <td><?= $pk['total_kerja']; ?></td>
                        <td><?= $pk['done_kerja']; ?></td>
                        <td><?= $pk['nilai']; ?></td>
                        <td>
                            <a href="" class="badge bg-warning">detail</a>
                            <a href="" class="badge bg-success">edit</a>
                            <a href="<?= base_url() ?>performences/penilaiankinerja/hapus/<?= $pk['id_penilaian_kinerja']  ?>" class="badge bg-danger">delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
