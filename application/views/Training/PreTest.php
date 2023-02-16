<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Input Soal Pilihan Ganda</h3>
  </div>
  <form role="form" action="proses-input-soal.php" method="POST">
    <div class="box-body">
      <div class="form-group">
        <label for="pertanyaan">Pertanyaan:</label>
        <textarea class="form-control" id="pertanyaan" name="pertanyaan" placeholder="Masukkan pertanyaan"></textarea>
      </div>
      <div class="form-group">
        <label for="pilihan_a">Pilihan A:</label>
        <input type="text" class="form-control" id="pilihan_a" name="pilihan_a" placeholder="Masukkan pilihan A">
      </div>
      <div class="form-group">
        <label for="pilihan_b">Pilihan B:</label>
        <input type="text" class="form-control" id="pilihan_b" name="pilihan_b" placeholder="Masukkan pilihan B">
      </div>
      <div class="form-group">
        <label for="pilihan_c">Pilihan C:</label>
        <input type="text" class="form-control" id="pilihan_c" name="pilihan_c" placeholder="Masukkan pilihan C">
      </div>
      <div class="form-group">
        <label for="pilihan_d">Pilihan D:</label>
        <input type="text" class="form-control" id="pilihan_d" name="pilihan_d" placeholder="Masukkan pilihan D">
      </div>
      <div class="form-group">
        <label for="jawaban">Jawaban:</label>
        <select class="form-control" id="jawaban" name="jawaban">
          <option value="a">A</option>
          <option value="b">B</option>
          <option value="c">C</option>
          <option value="d">D</option>
        </select>
      </div>
    </div>
    <div class="box-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
      <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
  </form>
</div>
