<table cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
        <td align="center" bgcolor="#ffffff">
            <table cellpadding="0" cellspacing="0" border="0" width="600" style="border-collapse: collapse;">
                <tr>
                    <td>
                        <h4>Tes Soal Recruitment</h4>
                        <p>Kepada Yth...</p>
                        <br>
                        <p>Kami dari PT. SAHAWARE TEKNOLOGI INDONESIA mengerjakan soal recruitment </p>
                        <h4>Posisi</h4>
                        <?php foreach ($dataposisi as $dp) : ?>
                            <?php if ($dp['id_posisi'] == $id_posisi) : ?>
                                <p><?= $dp['nama_posisi']; ?></p>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <h4>Link Soal PG</h4>
                        <p><?php echo $pg; ?></p>
                        <h4>Link Soal Essay</h4>
                        <p><?php echo $essay; ?></p>
                        <h4>Link Upload Hasil</h4>
                        <p><?php echo $upload; ?></p>
                    </td>

                </tr>
            </table>
        </td>
    </tr>
</table>