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
			<a style="margin-right:10px" href="#" title="Edit"><i class="fas fa-edit text-warning"></i></a>
			<a style="margin-right:10px" href="#" title="Delete"><i class="fas fa-trash text-danger"></i></a>
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
}