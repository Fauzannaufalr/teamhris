<div class="container-fluid">

    <div class="card">
        <div class="card-header" style="color: white; background-color: #ff0000;">
            <h4> Filter Data Penilaian Kinerja</h4>
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

            <table id="example2" class="table table-bordered table-striped" style="text-align: center;">
                <thead style="background-color: #ff0000;">
                    <tr style="color: #ffffff;">
                        <th>No</th>
                        <th>Karyawan</th>
                        <th>Bulan</th>
                        <th>Kinerja</th>
                        <th>Kuesioner</th>
                        <th>Total</th>
                        <th>Kriteria</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>

                    <tr>
                        <th>
                            <?= $no++; ?>
                        </th>
                    </tr>
                </tbody>
            </table>
            </table>
            <!-- /.card-body -->
        </div>
    </div>
    <!-- /.card-body -->
</div>
</div>