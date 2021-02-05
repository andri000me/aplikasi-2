<?php 
// // Require composer autoload
require_once APPPATH. '../vendors/autoload.php';
// // Create an instance of the class:
$mpdf = new \Mpdf\Mpdf([
	'mode' => 'utf-8',
	'format' => 'A4',
	'orientation' => 'P'
]);


$mpdf->SetTitle($jenis.' | '.$komponen['nama_mhs']);
$mpdf->SetDisplayMode('real', 'default');

$teks = $this->parser->parse_string($isi, $komponen, TRUE);
$mpdf->SetWatermarkImage(
	FCPATH.'assets/esurat/img/logo.png',
	0.2,
	50,
	'F'
);
$mpdf->showWatermarkImage = true;

$mpdf->WriteHTML($teks, \Mpdf\HTMLParserMode::DEFAULT_MODE, true, false);
$mpdf->Image(FCPATH.'assets/esurat/img/QRCode/'.str_replace("/", "_", $no_surat).'.png', 30, 210, 25, 25, 'jpg', '', true, false);
// $mpdf->SetHTMLFooter(
// 	'<img style="margin-bottom: 10px; width: 100%; height: 100px;" src="'.base_url('assets/esurat/img/kop.png').'">'
// );

$namafile = strtolower($jenis.'_'.$komponen['nim_mhs'].'_'.$komponen['nama_mhs']);
$namafile = str_replace(" ", "_", $namafile);
// $mpdf->Output($namafile.'.pdf','I');
;?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body onload="window.print()">
	<?php

	$mpdf->Output($namafile.'.pdf','I');
	?>
</body>
</html>