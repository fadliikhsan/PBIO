<div id="isi-tengah">
<div id="title-polling">Hasil Polling Sementara</div>
Terimakasih atas partisipasi Anda untuk mengikuti polling kami bulan ini<br /><br />
<?php
foreach($soal_polling->result_array() as $tmpl_soal){
echo "<h2>".$tmpl_soal['soal']."</h2>";
}
$jum = 0;
foreach($jawaban_polling->result_array() as $tmpl_jwb){
$jum += $tmpl_jwb['counter'];
}
echo '<table style="border: 1pt ridge #DDDDDD;" bgcolor="#EEFAFF" width="500" class="widget">';
foreach($jawaban_polling->result_array() as $tmpl_jwb){
$pr = sprintf("%2.1f",(($tmpl_jwb['counter']/$jum)*100));
$gbr = $pr * 1;
echo "<tr><td width='100'>&#8226; <b>".$tmpl_jwb['jawaban']."</b></td><td width='300'><img src='".base_url()."application/views/web/images/vote.jpg' width='".$gbr."' height='20'></td><td width='70'>".$pr." %<br></td></tr>";
}
echo '</table>';
echo "Hasil berdasarkan dari ".$jum." orang responden.";
?>
</div>