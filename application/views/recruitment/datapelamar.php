<br>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?= $title ?></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example2" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pekerjaan</th>
                        <th>Nama Lengkap</th>
                        <th>Pendidikan</th>
                        <th>Alamat Lengkap</th>
                        <th>CV</th>
                        <th>Aksi</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($datapelamar as $k) : ?>
                        <tr>
                            <th><?= $no++; ?></th>
                            <td><?= $k['nama_pekerjaan']; ?></td>
                            <td><?= $k['nama_lengkap']; ?></td>
                            <td><?= $k['pendidikan']; ?></td>
                            <td><?= $k['alamat']; ?></td>
                            <td><?= $k['cv']; ?></td>
                            <td>
                                <a href="" class="badge bg-warning">detail</a>
                                <a href="" class="badge bg-success">edit</a>
                                <a href="<?= base_url() ?>recruitment/kelola/hapus/<?= $k['id_pelamar']  ?>" class="badge bg-danger">delete</a>
                            </td>


                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>

        </div>
        <!-- /.card-body -->
    </div>

</div>