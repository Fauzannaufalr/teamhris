<br>
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><?= $title ?></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>id_hasilpretest</th>
                    <th>id_pretest</th>
                    <th>nik</th>
                    <th>nilai</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1 ?>
                <?php foreach ($hasilpretest as $k) : ?>
                <tr>
                    <th><?= $no++; ?></th>
                    <td><?= $k['id_hasilpretest']; ?></td>
                    <td><?= $k['id_pretest']; ?></td>
                    <td><?= $k['nik']; ?></td>
                    <td><?= $k['nilai']; ?></td>
                    <td>
                        <a href="" class="badge bg-success">edit</a>
                        <a href="" class="badge bg-danger">delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>