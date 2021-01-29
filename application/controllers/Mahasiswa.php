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

		$data['user'] = $this->db->get_where('esurat_mhs',['nim' => $this->session->userdata('nim')])->row();

		$data['title'] = "Mahasiswa | Home";
		$data['parent'] = "Home";
		$data['page'] = "Home";
		$this->template->load('mahasiswa/layout/mahasiswaTemplate','mahasiswa/modulHome/mahasiswaHome',$data);

	}

	public function profile(){

		$data['user'] = $this->db->get_where('esurat_mhs',['nim' => $this->session->userdata('nim')])->row();
		$data['prodi'] = $this->mahasiswa_model->getProdi(); /*-- Load Semua Data Prodi --*/
		$data['title'] = "Mahasiswa | Profile";
		$data['parent'] = "Profile";	
		$data['page'] = "Profile";
		$this->template->load('mahasiswa/layout/mahasiswaTemplate','mahasiswa/modulProfile/mahasiswaProfile',$data);

	}

	public function profileEdit($nim){

		$this->form_validation->set_rules('nim', 'NIM','trim|required|is_natural',[
			'is_natural' => 'NIM Hanya Berisi Angka']);
		$this->form_validation->set_rules('nama', 'Nama Mahasiswa','required');
		$this->form_validation->set_rules('prodi', 'Prodi','required');
		$this->form_validation->set_rules('angkatan', 'Tahun Angkatan','trim|required');
		$this->form_validation->set_rules('kelamin', 'Jenis Kelamin','required');
		$this->form_validation->set_rules('status', 'Status','required');
		// $this->form_validation->set_rules('als_status', 'Alasan Status','required');
		$this->form_validation->set_rules('tempat', 'Tempat lahir','trim|required|alpha',[
			'alpha' => 'nama Hanya Berisi Huruf Alfabet']);
		$this->form_validation->set_rules('tanggal', 'Tanggal Lahir','required');
		$this->form_validation->set_rules('alamat', 'Alamat','required');
		$this->form_validation->set_rules('ortu', 'Nama Orang Tua','required');
		$this->form_validation->set_rules('email', 'Email','required');
		$this->form_validation->set_rules('tlp', 'No Telepon','trim|required');
		$this->form_validation->set_rules('kelas', 'Kelas','required');

		if($this->form_validation->run() == false){

			$data['title'] = "Mahasiswa | Profile";
			$data['page'] = "Profile";
			$data['page'] = "Edit Mahasiswa";
			$this->template->load('mahasiswa/layout/mahasiswaTemplate','mahasiswa/modulProfile/mahasiswaProfile',$data);

		}else{

			$data = [

				'nim' => $this->input->post('nim'),
				'nmmhs' => $this->input->post('nama'),
				'kdpro' => $this->input->post('prodi'),
				'thaka' => $this->input->post('angkatan'),
				'kel' => str_replace("_/","",$this->input->post('kelamin')),
				'status' => $this->input->post('status'),
				'alasan_status' => $this->input->post('als_status'),
				'tptlhr' => $this->input->post('tempat'),
				'tgllhr' => date('Y-m-d',strtotime($this->input->post('tanggal'))),
				'alamat' => $this->input->post('alamat'),
				'nmortu' => $this->input->post('ortu'),
				'email' => $this->input->post('email'),
				'telp' => str_replace("-","",$this->input->post('tlp')),
				'kelas' => $this->input->post('kelas')

			];

			$this->db->where('nim', $this->input->post('zz'));
			$this->db->update('esurat_mhs',$data);
			$this->toastr->success('Data Mahasiswa '.$this->input->post('nama').' Berhasil diupdate!');
			redirect('mahasiswa/profile');
		}
	}


	public function pengajuanSurat(){

		$data['user'] = $this->db->get_where('esurat_mhs',['nim' => $this->session->userdata('nim')])->row();
		$data['surat'] = $this->mahasiswa_model->getListSurat(); //Load List Surat

		$data['title'] = "Mahasiswa | Pengajuan";
		$data['parent'] = "Pengajuan Surat";
		$data['page'] = "Pengajuan Surat";
		$this->template->load('mahasiswa/layout/mahasiswaTemplate','mahasiswa/modulPengajuanSurat/mahasiswaPengajuanSurat',$data);

	}

}