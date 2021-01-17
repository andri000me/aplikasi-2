<?php 
// // Require composer autoload
require_once APPPATH. '../vendors/autoload.php';
// // Create an instance of the class:
$mpdf = new \Mpdf\Mpdf([
	'mode' => 'utf-8',
	'format' => 'A4',
	'orientation' => 'P'
]);
$mpdf->SetTitle('Sample '.$onesur->nm_surat);
$mpdf->SetDisplayMode('real', 'default');

$kop = $onesur->kop_surat;
$header = $onesur->header_surat;
$isi = $onesur->isi_surat;
$footer = $onesur->footer_surat;

$mpdf->SetWatermarkImage(
	FCPATH.'assets/esurat/img/logo.png',
	0.2,
	50,
	'F'
);
$mpdf->showWatermarkImage = true;
// $mpdf->WriteHTML($teks, true, false,true,false);
// $mpdf->Image(FCPATH.'assets/esurat/img/logo.png',  0, 0, 210, 297, 'jpg', '', true, false);
$mpdf->SetHTMLHeader(
	'<img style="margin-bottom: 10px; width: 100%; height: 100px;" src="'.base_url('assets/esurat/img/kop.png').'">'
);
$mpdf->WriteHTML($header, \Mpdf\HTMLParserMode::DEFAULT_MODE, true, false);
$mpdf->WriteHTML($isi, \Mpdf\HTMLParserMode::DEFAULT_MODE, true, false);
$mpdf->WriteHTML($footer, \Mpdf\HTMLParserMode::DEFAULT_MODE, true, false);
// $mpdf->Image(FCPATH.'assets/esurat/img/kop.png', 0, 0, 210, 50, 'jpg', '', true, false);

$namafile = strtolower('Sample '.$onesur->nm_surat);
$namafile = str_replace(" ", "_", $namafile);
$mpdf->Output($namafile.'.pdf','I');
;?>