<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Ajax extends CI_Controller {

	public function __construct(){

		parent::__construct();


		/*-- untuk mengatasi error confirm form resubmission  --*/
		header('Cache-Control: no-cache, must-revalidate, max-age=0');
		header('Cache-Control: post-check=0, pre-check=0',false);
		header('Pragma: no-cache');
		$this->load->model('ajax_model');
		$this->load->model('admin_model');
	}


	/*-- Server-side Data Mahasiswa --*/
	public function get_data_mhs(){

		$prodi = $this->admin_model->getProdi(); 	/*-- Load Semua Data Prodi --*/
		$list = $this->ajax_model->get_mhs();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->nim;
			$row[] = $field->nmmhs;
			foreach ($prodi as $pro ) {

				if ($pro->kdpro == $field->kdpro) {

					$row[] =  $pro->prodi;

				}
			};

			$row[] = '
			<a style="margin-right:10px" href="../Admin/dMahasiswaDetail/'.$this->encrypt->encode($field->nim).'" title="Detail"><i class="fas fa-info-circle text-info"></i></a>
			<a style="margin-right:10px" href="../Admin/dMahasiswaEdit/'.$this->encrypt->encode($field->nim).'" title="Edit"><i class="fas fa-edit text-warning"></i></a>
			<a style="margin-right:10px" href="#" id="'.$field->nim.'" onclick="deletemhs('.$field->nim.')" title="Delete"><i class="fas fa-trash text-danger"></i></a>
			';


			$data[] = $row;

		}

		$output = array(

			"draw" => $_POST['draw'],
			"recordsTotal" => $this->ajax_model->count_all_mhs(),
			"recordsFiltered" => $this->ajax_model->count_filtered_mhs(),
			"data" => $data,

		);

		/*-- Output Dalam Format JSON --*/
		echo json_encode($output);

	}


	public function dMahasiswaDelete(){

		$nim = $this->input->post("nim");
		$this->db->delete('esurat_mhs',['nim' => $nim]);
		$data['nim'] = $this->input->post("nim");
		echo json_encode($data);

	}

	/*-- Server-side Data Permintaan Surat --*/
	public function get_data_pmr(){


		$list = $this->ajax_model->get_pmr();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->kd_surat;
			$row[] = $field->no_surat;
			$row[] = $field->nm_surat;
			$row[] = $field->permintaan_by;
			$row[] = date('d F Y', strtotime($field->permintaan_tgl));
			$row[] = '
			<a class="btn btn-danger btn-sm text-white"><i class="loading-icon fa fa-spinner fa-spin"></i>&ensp;'.$field->status_surat.'</a>
			';

			$access = $this->db->query("SELECT * FROM esurat_surat WHERE kd_surat = '".$field->kd_surat."'")->row();

			$row[] = '
			<a style="margin-right:10px" href="../Permintaan/permintaanDetail/'
			.$this->encrypt->encode($field->kd_surat).'/' /*-- Kode Surat --*/
			.$this->encrypt->encode($field->id_permintaan).'/' /*-- Id Permintaan --*/
			.$this->encrypt->encode('permintaan'). /*-- Permintaan --*/
			'"><i class="fas fa-info-circle text-info"></i></a>
			';

			$data[] = $row;

		}

		$output = array(

			"draw" => $_POST['draw'],
			"recordsTotal" => $this->ajax_model->count_all_pmr(),
			"recordsFiltered" => $this->ajax_model->count_filtered_pmr(),
			"data" => $data,

		);

		/*-- Output Dalam Format JSON --*/
		echo json_encode($output);

	}

	// public function pengajuanDelete(){

	// 	$id_permintaan = $this->input->post("id_permintaan");
	// 	$query = $this->admin_model->getOneMhs($this->admin_model->getOnePmr($id_permintaan)->permintaan_by);
	// 	$notif = [

	// 		'comment_subject' => 'Surat Di Tolak',
	// 		'comment_text' => 'Surat Yang Anda Ajukan Pada tanggal '.$this->admin_model->getOnePmr($id_permintaan)->permintaan_tgl.' Di Tolak',
	// 		'comment_surat' => 'N',
	// 		'comment_to' => $this->admin_model->getOnePmr($id_permintaan)->permintaan_by,
	// 		'comment_date' => $this->db->escape_str(date('Y-m-d'),true),
	// 		'comment_status' => 0

	// 	];

	// 	$this->db->insert('esurat_comments',$notif);
	// 	$data['id_permintaan'] =  "Yang Diajuakan Oleh $query->nmmhs";
	// 	$this->db->delete('esurat_permintaan',['id_permintaan' => $id_permintaan]);

	// 	echo json_encode($data);
		
	// }

}