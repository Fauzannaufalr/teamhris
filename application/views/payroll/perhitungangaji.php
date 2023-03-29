<div class="container-fluid">
    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">

            <button type="button" class="btn btn-outline-success mb-2" data-toggle="modal" data-target="#tambahPerhitungan"><i class="fas fa-plus"></i>
                Tambah Perhitungan Gaji
            </button>
            <table id="data" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK - Nama Karyawan</th>
                        <th>Tj. Kinerja</th>
                        <th>Tj. Fungsional</th>
                        <th>Tj. Jabatan</th>
                        <th>Potongan</th>
                        <th>Bonus</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>

<!-- Modal tambah -->
<div class="modal fade" id="tambahPerhitungan" tabindex="-1" aria-labelledby="tambahPerhitunganLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahPerhitunganLabel">Tambah Perhitungan Gaji Karyawan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('payroll/perhitungan/tambah'); ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nik_nama">NIK & Nama Karyawan</label>
                        <select name="nik_nama" id="nik_nama" class="form-control">
                            <option value="">-- Pilih NIK & Nama --</option>
                            <?php foreach ($datakaryawan as $dk) : ?>
                                <option value="<?= $dk['id_karyawan']; ?>"><?= $dk['nik']; ?> - <?= $dk['nama_karyawan'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="t_kinerja">Tunjangan Kinerja</label>
                        <input type="text" class="form-control" id="t_kinerja" name="t_kinerja" placeholder="Masukan tunjangan kinerja">
                    </div>
                    <div class="form-group">
                        <label for="t_fungsional">Tunjangan Fungsional</label>
                        <input type="text" class="form-control" id="t_fungsional" name="t_fungsional" placeholder="Masukan tunjangan fungsional">
                    </div>
                    <div class="form-group">
                        <label for="t_jabatan">Tunjangan Jabatan</label>
                        <input type="text" class="form-control" id="t_jabatan" name="t_jabatan" placeholder="Masukan tunjangan jabatan">
                    </div>
                    <div class="form-group">
                        <label for="potongan">Potongan</label>
                        <input type="text" class="form-control" id="potongan" name="potongan" placeholder="Masukan potongan">
                    </div>
                    <div class="form-group">
                        <label for="bonus">Bonus</label>
                        <input type="text" class="form-control" id="bonus" name="bonus" placeholder="Masukan bonus">
                    </div>
                </div>
                <div class=" modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-danger">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal ubah -->
<?php foreach ($perhitungan as $pg) : ?>
    <div class="modal fade" id="ubahPerhitungan<?= $pg['id_perhitungan']; ?>" tabindex="-1" aria-labelledby="ubahPerhitunganLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahPerhitunganLabel">Ubah Perhitungan Gaji Karyawan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('payroll/perhitungan/ubah'); ?>" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="id" value="<?= $pg['id_perhitungan']; ?>">
                        <div class="form-group">
                            <label for="nik_nama">NIK & Nama Karyawan</label>
                            <select name="nik_nama" id="nik_nama" class="form-control">
                                <option value="">-- Pilih NIK & Nama --</option>
                                <?php foreach ($datakaryawan as $dk) : ?>
                                    <?php if ($dk['id_karyawan'] == $pg['id_datakaryawan']) : ?>
                                        <option value="<?= $dk['id_karyawan']; ?>" selected><?= $dk['nik']; ?> - <?= $dk['nama_karyawan'] ?></option>
                                    <?php else : ?>
                                        <option value="<?= $dk['id_karyawan']; ?>"><?= $dk['nik']; ?> - <?= $dk['nama_karyawan'] ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="t_kinerja">Tunjangan Kinerja</label>
                            <input type="text" class="form-control" id="t_kinerja_ubah<?= $pg['id_perhitungan']; ?>" name="t_kinerja" value="Rp <?= number_format($pg['t_kinerja'], 0, ',', '.'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="t_fungsional">Tunjangan Fungsional</label>
                            <input type="text" class="form-control" id="t_fungsional_ubah<?= $pg['id_perhitungan']; ?>" name="t_fungsional" value="Rp <?= number_format($pg['t_fungsional'], 0, ',', '.'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="t_jabatan">Tunjangan Jabatan</label>
                            <input type="text" class="form-control" id="t_jabatan_ubah<?= $pg['id_perhitungan']; ?>" name="t_jabatan" value="Rp <?= number_format($pg['t_jabatan'], 0, ',', '.'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="potongan">Potongan</label>
                            <input type="text" class="form-control" id="potongan_ubah<?= $pg['id_perhitungan']; ?>" name="potongan" value="Rp <?= number_format($pg['potongan'], 0, ',', '.'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="bonus">Bonus</label>
                            <input type="text" class="form-control" id="bonus_ubah<?= $pg['id_perhitungan']; ?>" name="bonus" value="Rp <?= number_format($pg['bonus'], 0, ',', '.'); ?>">
                        </div>
                    </div>
                    <div class=" modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-danger">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        var t_kinerja_ubah<?= $pg['id_perhitungan']; ?> = document.getElementById('t_kinerja_ubah<?= $pg['id_perhitungan']; ?>');
        t_kinerja_ubah<?= $pg['id_perhitungan']; ?>.addEventListener('keyup', function(e) {
            t_kinerja_ubah<?= $pg['id_perhitungan']; ?>.value = formatRupiah(this.value, 'Rp ');
        });

        var t_fungsional_ubah<?= $pg['id_perhitungan']; ?> = document.getElementById('t_fungsional_ubah<?= $pg['id_perhitungan']; ?>');
        t_fungsional_ubah<?= $pg['id_perhitungan']; ?>.addEventListener('keyup', function(e) {
            t_fungsional_ubah<?= $pg['id_perhitungan']; ?>.value = formatRupiah(this.value, 'Rp ');
        });

        var t_jabatan_ubah<?= $pg['id_perhitungan']; ?> = document.getElementById('t_jabatan_ubah<?= $pg['id_perhitungan']; ?>');
        t_jabatan_ubah<?= $pg['id_perhitungan']; ?>.addEventListener('keyup', function(e) {
            t_jabatan_ubah<?= $pg['id_perhitungan']; ?>.value = formatRupiah(this.value, 'Rp ');
        });

        var potongan_ubah<?= $pg['id_perhitungan']; ?> = document.getElementById('potongan_ubah<?= $pg['id_perhitungan']; ?>');
        potongan_ubah<?= $pg['id_perhitungan']; ?>.addEventListener('keyup', function(e) {
            potongan_ubah<?= $pg['id_perhitungan']; ?>.value = formatRupiah(this.value, 'Rp ');
        });

        var bonus_ubah<?= $pg['id_perhitungan']; ?> = document.getElementById('bonus_ubah<?= $pg['id_perhitungan']; ?>');
        bonus_ubah<?= $pg['id_perhitungan']; ?>.addEventListener('keyup', function(e) {
            bonus_ubah<?= $pg['id_perhitungan']; ?>.value = formatRupiah(this.value, 'Rp ');
        });
    </script>
<?php endforeach; ?>

<!-- Modal hapus -->
<?php foreach ($perhitungan as $pg) : ?>
    <div class="modal fade" id="modal-sm<?= $pg['id_perhitungan']; ?>">
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
                    <button type="button" class="btn" data-dismiss="modal" style="background-color: #fbff39;">Tidak</button>
                    <a href="<?= base_url() ?>payroll/perhitungan/hapus/<?= $pg['id_perhitungan']  ?>" type="submit" class="btn btn-primary">Ya</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach; ?>

<script>
    $(function() {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        <?php if ($this->session->flashdata('message')) : ?>
            const flashData = <?= json_encode($this->session->flashdata('message')) ?>;
            Toast.fire({
                icon: 'success',
                title: flashData
            })
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')) : ?>
            const flashData = <?= json_encode($this->session->flashdata('error')) ?>;
            Toast.fire({
                icon: 'error',
                title: flashData
            })
        <?php endif; ?>
        <?php if (validation_errors()) : ?>
            const flashData = <?= json_encode(validation_errors()) ?>;
            Toast.fire({
                icon: 'error',
                title: flashData
            })
        <?php endif; ?>
    });
</script>

<script>
    var t_kinerja = document.getElementById('t_kinerja');
    t_kinerja.addEventListener('keyup', function(e) {
        t_kinerja.value = formatRupiah(this.value, 'Rp ');
    });

    var t_fungsional = document.getElementById('t_fungsional');
    t_fungsional.addEventListener('keyup', function(e) {
        t_fungsional.value = formatRupiah(this.value, 'Rp ');
    });

    var t_jabatan = document.getElementById('t_jabatan');
    t_jabatan.addEventListener('keyup', function(e) {
        t_jabatan.value = formatRupiah(this.value, 'Rp ');
    });

    var potongan = document.getElementById('potongan');
    potongan.addEventListener('keyup', function(e) {
        potongan.value = formatRupiah(this.value, 'Rp ');
    });

    var bonus = document.getElementById('bonus');
    bonus.addEventListener('keyup', function(e) {
        bonus.value = formatRupiah(this.value, 'Rp ');
    });

    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '');
    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        var userDataTable = $('#data').DataTable({
            'responsive': true,
            'orderable': true,
            'ordering': true,
            'processing': true,
            'serverSide': true,
            "autoWidth": false,
            'serverMethod': 'post',
            'searching': true, // Remove default Search Control
            'ajax': {
                'url': '<?= base_url() ?>payroll/perhitungan/tabel'
            },
            'columns': [{
                    data: 'no'
                },
                {
                    data: 'nik_nama'
                },
                {
                    data: 'kinerja'
                },
                {
                    data: 'fungsional'
                },
                {
                    data: 'jabatan'
                },
                {
                    data: 'potongan'
                },
                {
                    data: 'bonus'
                },
                {
                    data: 'aksi'
                },
            ]
        });
    });
</script>