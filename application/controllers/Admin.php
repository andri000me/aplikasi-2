<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Admin extends CI_Controller {

	public function __construct(){

		parent::__construct();
		/*-- Check Session  --*/
		is_admin();

		/*-- untuk mengatasi error confirm form resubmission  --*/
		header('Cache-Control: no-cache, must-revalidate, max-age=0');
		header('Cache-Control: post-check=0, pre-check=0',false);
		header('Pragma: no-cache');
		$this->load->model('admin_model');
	}


	public function index(){

		$data['user'] = $this->db->get_where('esurat_admin',['username' => $this->session->userdata('username')])->row();
		// $data['mhs'] = $this->admin_model->getCountMhs();
		// $data['surat'] = $this->admin_model->getCountlist();
		// $data['permintaan'] = $this->admin_model->getCountPmr();
		// $data['selesai'] = $this->admin_model->getCountSls();
		// $data['pmrlimit'] = $this->admin_model->getPmrLimit();
		// $data['slslimit'] = $this->admin_model->getSlsLimit();

		$data['title'] = "Admin | Dashboard";
		$data['parent'] = "Dashboard";
		$data['page'] = "Dashboard";
		$this->template->load('admin/layout/adminTemplate','admin/modulDashboard/adminDashboard',$data);

	}

	public function dMahasiswa(){

		$data['user'] = $this->db->get_where('esurat_admin',['username' => $this->session->userdata('username')])->row();

		$data['title'] = "Admin | Data Mahasiswa";
		$data['parent'] = "Data Mahasiswa";
		$data['page'] = "Data Mahasiswa";
		$this->template->load('admin/layout/adminTemplate','admin/modulMahasiswa/adminMahasiswa',$data);

	}

	public function dMahasiswaDetail($nim){

		/*-- Encrypt URL NIM --*/
		if (count($this->uri->segment_array()) > 3) {
			$this->toastr->error('Url Yang Anda Masukkan Salah');
			redirect('admin/dMahasiswa');
		}
		if (!isset($nim)) {
			$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai ID');
			redirect('admin/dMahasiswa');
		}
		if (is_numeric($nim)) {
			$this->toastr->error('Url Hanya Bisa Diakses Setelah Dienkripsi');
			redirect('admin/dMahasiswa');
		} 

		$data['user'] = $this->db->get_where('esurat_admin',['username' => $this->session->userdata('username')])->row();

		$data['onemhs'] = $this->admin_model->getOneMhs($this->encrypt->decode($nim)); /*-- Load One Data Mhs --*/

		$data['title'] = "Admin | Data Mahasiswa";
		$data['parent'] = "Data Mahasiswa";
		$data['page'] = "Detail Mahasiswa";
		$this->template->load('admin/layout/adminTemplate','admin/modulMahasiswa/adminMahasiswaDetail',$data);

	}

	public function dMahasiswaEdit($nim){

		/*-- Encrypt URL NIM --*/
		if (count($this->uri->segment_array()) > 3) {
			$this->toastr->error('Url Yang Anda Masukkan Salah');
			redirect('admin/dMahasiswa');
		}
		if (!isset($nim)) {
			$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai NIM');
			redirect('admin/dMahasiswa');
		}
		if (is_numeric($nim)) {
			$this->toastr->error('Url Hanya Bisa Diakses Setelah Terenkripsi');
			redirect('admin/dMahasiswa');
		} 

		$data['user'] = $this->db->get_where('esurat_admin',['username' => $this->session->userdata('username')])->row();

		$data['onemhs'] = $this->admin_model->getOneMhs($this->encrypt->decode($nim)); /*-- Load One Data Mhs --*/
		$data['prodi'] = $this->admin_model->getProdi(); /*-- Load Semua Data Prodi --*/

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

			$data['title'] = "Admin | Data Mahasiswa";
			$data['parent'] = "Data Mahasiswa";
			$data['page'] = "Edit Mahasiswa";
			$this->template->load('admin/layout/admin_template','admin/modul_mhs/admin_mhsEdit',$data);

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
			redirect('admin/dMahasiswa');

		}
	}

}