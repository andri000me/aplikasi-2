<?php 
// // Require composer autoload
require_once APPPATH. '../vendors/autoload.php';
// // Create an instance of the class:
$mpdf = new \Mpdf\Mpdf([
	'mode' => 'utf-8',
	'format' => 'A4',
	'orientation' => 'P'
]);


$mpdf->SetTitle($jenis.' | '.$komponen['nama']);
$mpdf->SetDisplayMode('real', 'default');


$teks = $this->parser->parse_string($isi, $komponen,  TRUE);
$mpdf->SetWatermarkImage(
	FCPATH.'assets/esurat/img/logo.png',
	0.2,
	50,
	'F'
);
$mpdf->showWatermarkImage = true;


$mpdf->WriteHTML($teks, \Mpdf\HTMLParserMode::DEFAULT_MODE, true, false);


$namafile = strtolower($jenis.'_'.$komponen['nim'].'_'.$komponen['nama']);
$namafile = str_replace(" ", "_", $namafile);

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