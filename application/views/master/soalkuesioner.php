<br>
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><?= $title ?></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModal">
            Tambah Pertanyaan
        </button>
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pertanyaann</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1 ?>
                <?php foreach ($soalkuesioner as $s) : ?>
                    <tr>
                        <th><?= $no++; ?></th>
                        <td><?= $s['kuesioner']; ?></td>
                        <td>
                            <a href="" class="badge bg-warning">detail</a>
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Pertanyaan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group"><label>Pertanyaan</label><input type="text" name="kuesioner" class="form-control"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>