<form method="post" action="<?php echo base_url('menilaidirisendiri/save'); ?>">
  <label for="question1">Pertanyaan 1: Apakah Anda suka kucing?</label>
  <select name="question1" id="question1">
    <option value="yes">Ya</option>
    <option value="no">Tidak</option>
  </select>

  <label for="question2">Pertanyaan 2: Apakah Anda suka anjing?</label>
  <select name="question2" id="question2">
    <option value="yes">Ya</option>
    <option value="no">Tidak</option>
  </select>

  <input type="submit" value="Simpan" />
</form>
