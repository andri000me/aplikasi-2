<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Mahasiswa extends CI_Controller {

	public function __construct(){

		parent::__construct();
		/*-- Check Session  --*/
		// is_admin();

		/*-- untuk mengatasi error confirm form resubmission  --*/
		header('Cache-Control: no-cache, must-revalidate, max-age=0');
		header('Cache-Control: post-check=0, pre-check=0',false);
		header('Pragma: no-cache');
		// $this->load->model('admin_model');

	}


	public function index(){

		// $data['user'] = $this->db->get_where('esurat_admin',['username' => $this->session->userdata('username')])->row();
		// $data['mhs'] = $this->admin_model->getCountMhs();
		// $data['surat'] = $this->admin_model->getCountlist();
		// $data['permintaan'] = $this->admin_model->getCountPmr();
		// $data['selesai'] = $this->admin_model->getCountSls();
		// $data['pmrlimit'] = $this->admin_model->getPmrLimit();
		// $data['slslimit'] = $this->admin_model->getSlsLimit();

		$data['title'] = "Mahasiswa | Home";
		$data['parent'] = "Home";
		$data['page'] = "Home";
		$this->template->load('mahasiswa/layout/viewTemplate','mahasiswa/modulHome/viewHome',$data);

	}

}