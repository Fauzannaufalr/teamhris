<div class="container-fluid">

    <div class="card">
        <div class="card-header" style="color: white; background-color: #cc0000;">
            <h4> Filter Data Akumulasi Penilaian</h4>
        </div>

        <form class="form-horizontal">
            <div class="card-body">
                <div class="form-group row">
                    <label for="bulan" class="col-form-label">Bulan: </label>
                    <div class="col-md-2">
                        <select class="form-control select2" name="bulan">
                            <option value="">-- Pilih Bulan--</option>
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>
                    <label for="tahun" class="col-form-label">Tahun: </label>
                    <div class="col-md-2">
                        <select class="form-control" name="tahun">
                            <option value="">--Pilih Tahun--</option>
                            <option value="">2017</option>
                            <option value="">2018</option>
                            <option value="">2019</option>
                            <option value="">2020</option>
                            <option value="">2021</option>
                            <option value="">2022</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-info mb-2 ml-3"><i class="fas fa-eye"> Tampilkan
                            Data
                        </i>
                    </button>
                </div>

            </div>
        </form>
    </div>
    <div class="card">
        <div class="card-body">

            <!-- validation crud -->
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


            <table id="example1" class="table table-bordered table-striped">
                <thead style="background-color: #cc0000; text-align: center ;">
                    <tr style="color: #ffffff;">
                        <th>No</th>
                        <th>Nama Karyawan</th>
                        <th>Nilai Kinerja</th>
                        <th>Nilai Kuesioner</th>
                        <th>Total</th>
                        <th>Kategorisasi</th>
                    </tr>
                </thead>

            </table>
        </div>
    </div>
    <!-- /.card-body -->

</div>