<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Mahasiswa extends CI_Controller {

	public function __construct(){

		parent::__construct();
		/*-- Check Session  --*/
		is_mhs();

		/*-- untuk mengatasi error confirm form resubmission  --*/
		header('Cache-Control: no-cache, must-revalidate, max-age=0');
		header('Cache-Control: post-check=0, pre-check=0',false);
		header('Pragma: no-cache');
		// $this->load->model('admin_model');

	}


	public function index(){

		if (count($this->uri->segment_array()) > 1) {
			$this->toastr->error('Url Yang Anda Masukkan Salah');
			redirect('mahasiswa');
		}

		$data['user'] = $this->db->get_where('esurat_mhs',['nim' => $this->session->userdata('nim')])->row();

		$data['title'] = "Mahasiswa | Home";
		$data['parent'] = "Home";
		$data['page'] = "Home";
		$this->template->load('mahasiswa/layout/mahasiswaTemplate','mahasiswa/modulHome/mahasiswaHome',$data);

	}

	public function profile(){

		if (count($this->uri->segment_array()) > 2) {
			$this->toastr->error('Url Yang Anda Masukkan Salah');
			redirect('mahasiswa/profile');
		}

		$data['user'] = $this->db->get_where('esurat_mhs',['nim' => $this->session->userdata('nim')])->row();
		$data['prodi'] = $this->mahasiswa_model->getProdi(); /*-- Load Semua Data Prodi --*/
		$data['title'] = "Mahasiswa | Profile";
		$data['parent'] = "Profile";	
		$data['page'] = "Profile";
		$this->template->load('mahasiswa/layout/mahasiswaTemplate','mahasiswa/modulProfile/mahasiswaProfile',$data);

	}

	public function profileEdit($nim = null){

		/*-- Encrypt URL NIM --*/
		if (count($this->uri->segment_array()) > 3) {
			$this->toastr->error('Url Yang Anda Masukkan Salah');
			redirect('mahasiswa/profile');
		}
		if (!isset($nim)) {
			$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai NIM');
			redirect('mahasiswa/profile');
		}
		if (is_numeric($nim)) {
			$this->toastr->error('Url Hanya Bisa Diakses Setelah Terenkripsi');
			redirect('mahasiswa/profile');
		} 
		$oneMhs = $this->db->get_where('esurat_mhs',['nim' => $this->encrypt->decode($nim)]);
		if($oneMhs->num_rows() == null){
			$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai NIMaaa');
			redirect('mahasiswa/profile');
		}
		/*-- /. Encrypt URL NIM --*/

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
				'nmmhs' =>  $this->db->escape_str(	ucwords($this->input->post('nama')),true),
				'kdpro' =>  $this->db->escape_str($this->input->post('prodi'),true),
				'thaka' =>  $this->db->escape_str($this->input->post('angkatan'),true),
				'kel' =>  $this->db->escape_str(str_replace("_/","",$this->input->post('kelamin')),true),
				'status' =>  $this->db->escape_str($this->input->post('status'),true),
				'alasan_status' =>  $this->db->escape_str($this->input->post('als_status'),true),
				'tptlhr' =>  $this->db->escape_str($this->input->post('tempat'),true),
				'tgllhr' =>  $this->db->escape_str(date('Y-m-d',strtotime($this->input->post('tanggal'))),true),
				'alamat' =>  $this->db->escape_str($this->input->post('alamat'),true),
				'nmortu' =>  $this->db->escape_str($this->input->post('ortu'),true),
				'email' =>  $this->db->escape_str($this->input->post('email'),true),
				'telp' =>  $this->db->escape_str(str_replace("-","",$this->input->post('tlp')),true),
				'kelas' =>  $this->db->escape_str($this->input->post('kelas'),true)

			];

			$this->db->where('nim',$oneMhs->row()->nim);
			$this->db->update('esurat_mhs',$data);
			$this->toastr->success('Data Mahasiswa '.$this->input->post('nama').' Berhasil diupdate!');
			redirect('mahasiswa/profile');
		}
	}


	public function pengajuanSurat(){

		if (count($this->uri->segment_array()) > 2) {
			$this->toastr->error('Url Yang Anda Masukkan Salah');
			redirect('mahasiswa/pengajuanSurat');
		}

		$data['user'] = $this->db->get_where('esurat_mhs',['nim' => $this->session->userdata('nim')])->row();
		$data['surat'] = $this->mahasiswa_model->getListSurat(); //Load List Surat

		$data['title'] = "Mahasiswa | Pengajuan";
		$data['parent'] = "Pengajuan Surat";
		$data['page'] = "Pengajuan Surat";
		$this->template->load('mahasiswa/layout/mahasiswaTemplate','mahasiswa/modulPengajuanSurat/mahasiswaPengajuanSurat',$data);

	}

	public function statusSurat(){

		if (count($this->uri->segment_array()) > 2) {
			$this->toastr->error('Url Yang Anda Masukkan Salah');
			redirect('mahasiswa/statusSurat');
		}
		
		$data['user'] = $this->db->get_where('esurat_mhs',['nim' => $this->session->userdata('nim')])->row();

		$data['allstatus'] = $this->mahasiswa_model->getStatusSurat($this->session->userdata('nim')); 

		$data['title'] = "Mahasiswa | Status Surat";
		$data['page'] = "Status Surat";
		$this->template->load('mahasiswa/layout/mahasiswaTemplate','mahasiswa/modulStatusSurat/mahasiswaStatusSurat',$data);

	}


	public function notif(){

		if (count($this->uri->segment_array()) > 2) {
			$this->toastr->error('Url Yang Anda Masukkan Salah');
			redirect('mahasiswa/notif');
		}

		$data['user'] = $this->db->get_where('esurat_mhs',['nim' => $this->session->userdata('nim')])->row();
		$data['allnotif'] = $this->mahasiswa_model->getAllNotif($this->session->userdata('nim'));
		$data['title'] = "Mahasiswa | Notification";
		$data['page'] = "Notification";
		$this->template->load('mahasiswa/layout/mahasiswaTemplate','mahasiswa/modulNotif/mahasiswaNotif',$data);


	}

	public function getNotif(){
		
		$view = $this->input->post('view');
		$nim = $this->db->get_where('esurat_mhs',['nim' => $this->session->userdata('nim')])->row();
		$data = $this->mahasiswa_model->getNotif($nim->nim);

		echo json_encode($data);


	}


	public function updateNotif(){

		$nim = $this->input->post('nim');

		$updateComments = [ 

			'comment_status' => 1
		];

		$this->db->where('comment_to', $nim);
		$data = $this->db->update('esurat_comments',$updateComments);
		echo json_encode($data);
	}


}