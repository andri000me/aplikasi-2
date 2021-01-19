<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Permintaan extends CI_Controller {

	public function __construct(){

		parent::__construct();


		/*-- untuk mengatasi error confirm form resubmission  --*/
		header('Cache-Control: no-cache, must-revalidate, max-age=0');
		header('Cache-Control: post-check=0, pre-check=0',false);
		header('Pragma: no-cache');
		$this->load->model('admin_model');
		$this->load->model('mahasiswa_model');
		$this->load->model('permintaan_model');

	}

	public function permintaanDetail($kd_surat = null, $id = null , $name = null){

		/*-- Search KodeSurat di table esurat_surat & id_permintaan di table esurat_permintaan --*/
		$searchKode = $this->db->get_where('esurat_surat',['kd_surat' => $this->encrypt->decode($kd_surat)]);

		if($this->session->userdata('username') == TRUE){

			/*----------------------- Encrypt kd_surat,id,$name -----------------------*/
			if (count($this->uri->segment_array()) > 5 ) {
				$this->toastr->error('Url Yang Anda Masukkan Salah');
				redirect('Admin/sPermintaanSurat');
			}
			if (!isset($kd_surat) || !isset($id) || !isset($name)) {
				$this->toastr->error('Url Yang Anda Masukkan Salah');
				redirect('Admin/sPermintaanSurat');
			}
			if (is_numeric($kd_surat) || is_numeric($id) || is_numeric($name)) {
				$this->toastr->error('Url Hanya Bisa Diakses Setelah Dienkripsi');
				redirect('Admin/sPermintaanSurat');
			}
			if($searchKode->num_rows() == NULL){
				$this->toastr->error('Kode Surat Not Found!');
				redirect('admin/sPermintaanSurat');
			}
			if(!in_array($this->encrypt->decode($name), ['permohonan','permintaan','pengajuan'], true ) ) {
				$this->toastr->error('Url Yang Anda Masukkan Salah');
				redirect('admin/sPermintaanSurat');
			}
			/*----------------------- /. Encrypt kd_surat,id,$name -----------------------*/

			$data['user'] = $this->db->get_where('esurat_admin',['username' => $this->session->userdata('username')])->row();

		}else{

			/*----------------------- Encrypt kd_surat,id,$name -----------------------*/
			if (count($this->uri->segment_array()) > 5) {
				$this->toastr->error('Url Yang Anda Masukkan Salah');
				redirect('mahasiswa/pengajuanSurat');
			}
			if (!isset($kd_surat) || !isset($id) || !isset($name)) {
				$this->toastr->error('Url Yang Anda Masukkan Salah');
				redirect('mahasiswa/pengajuanSurat');
			}
			if (is_numeric($kd_surat)||is_numeric($id) || is_numeric($name)) {
				$this->toastr->error('Url Hanya Bisa Diakses Setelah Dienkripsi');
				redirect('mahasiswa/pengajuanSurat');
			}
			if($searchKode->num_rows() == NULL){
				$this->toastr->error('Kode Surat Not Found!');
				redirect('admin/sPermintaanSurat');
			}			
			if(!in_array($this->encrypt->decode($name), ['permohonan','permintaan','pengajuan'], true ) ) {
				$this->toastr->error('Url Yang Anda Masukkan Salah');
				redirect('mahasiswa/pengajuanSurat');
			}
			/*----------------------- /. Encrypt kd_surat,id,$name -----------------------*/


			$data['user'] = $this->db->get_where('esurat_mhs',['nim' => $this->session->userdata('nim')])->row();

			$pengajuan = "SELECT COUNT(permintaan_by) as permintaan FROM esurat_permintaan WHERE permintaan_by = '".$this->session->userdata('nim')."'";
			$status = "SELECT * FROM esurat_mhs WHERE nim = '".$this->session->userdata('nim')."' ";
			$resultp = $this->db->query($pengajuan)->row()->permintaan;
			$results = $this->db->query($status)->row();

			/*------ Jika Status Mahasiswa Sudah Keluar Maka tidak bisa mengajukan surat lagi ------*/
			if($results->status == 'Keluar' || $results->status == 'Non Aktif'){
				$this->toastr->error('Status Kemahasiswaan Anda Telah '.$results->status.'');
				redirect('mahasiswa/pengajuanSurat');
			}

			/*------ Jika Mahasiswa Sudah Mengajukan 2 Surat yang belum dikonfirmasi maka tidak bisa mengajukan lagi ------*/
			if($resultp == '2'){
				$this->toastr->error('Anda Telah Masih memiliki 2 surat yang masih menunggu persetujuan silahkan hubungi admin terlebih untuk dikonfirmasi');
				redirect('mahasiswa/pengajuanSurat');
			}

		}

		/*-- Mendecode $id_selesai & $kd_surat --*/	
		$id = $this->encrypt->decode($id);
		$kd_surat = $this->encrypt->decode($kd_surat);
		$name = $this->encrypt->decode($name);

		/*------ Data-Data Komponen Surat ------*/
		if($name == 'permohonan'){	/*-- Ketika Admin Membuat Surat Secara langsung --*/

			$query = "SELECT * FROM esurat_surat WHERE id_surat = '".$id."'";

			/*-- Load Semua Data Dosen Pada Input --*/
			$data['dosenall'] = $this->admin_model->getDosen();
			$data['mahasiswaall'] = $this->db->query("SELECT * FROM esurat_mhs")->result();

		}elseif($name == 'pengajuan'){	/*-- Ketika Mahasiswa Mengajukan Surat --*/

			$query = "SELECT * FROM esurat_surat WHERE id_surat = '".$id."'";

			$mhs =  $this->db->get_where('esurat_mhs',['nim' => $this->session->userdata('nim')])->row();
			$data['onepro'] = $this->admin_model->getOneProdi($mhs->kdpro);

		}elseif($name == 'permintaan'){	/*-- Ketika Admin Mengkonfirmasi Surat Yang Di Ajukan Oleh Mahasiswa --*/

			$query = "SELECT * FROM esurat_permintaan WHERE id_permintaan = '".$id."'";

			/*-- Load One Data Permintaan Pada Input --*/
			$data['onepmr'] = $this->admin_model->getOnePmr($id);
			/*-- Load One Data Dosen Pada Input --*/
			$data['onedos'] = $this->admin_model->getOneDosen($this->admin_model->getOnePmr($id)->dosen);
			/*-- Load One Data Mahasiswa Pada Input --*/
			$data['onemhs'] = $this->admin_model->getOneMhs($this->admin_model->getOnePmr($id)->permintaan_by);
			/*-- Load One Data Prodi Pada Input --*/
			$data['onepro'] = $this->admin_model->getOneProdi($this->admin_model->getOnePmr($id)->permintaan_kdpro);

			/*-- Load One Data Mahasiswa Pada Hasil Surat --*/
			$mahasiswa = $this->admin_model->getOneMhs($this->admin_model->getOnePmr($id)->permintaan_by);
			/*-- Load One Data Dosen Pada Hasil Surat --*/
			$dosen = $this->admin_model->getOneDosen($this->admin_model->getOnePmr($id)->dosen);
			/*-- Load One Data Prodi Pada Hasil Surat --*/
			$prodi = $this->admin_model->getOneProdi($this->admin_model->getOnePmr($id)->permintaan_kdpro);

			/*-- Load Semua Data Dosen Pada Input --*/
			$data['dosenall'] = $this->admin_model->getDosen();
		}


		$result = $this->db->query($query)->row();

		/*-- Load One Data Surat untuk View --*/
		$data['onesur'] = $result;
		/*------ /. Data-Data Komponen Surat ------*/



		if($name == 'permohonan'){

			/*------------------------------------------------------------------------*/
			/*-- Code Di bawah Untuk Permintaan Surat Yang Di Ajukan Admin Langsung --*/
			/*------------------------------------------------------------------------*/

			if( $result->kd_surat == $kd_surat && $result->id_surat == $id){

				$data['title'] = "Admin | Dashboard";
				$data['parent'] = "Dashboard";
				$data['page'] = "Dashboard";
				$this->template->load('admin/layout/adminTemplate','admin/modulDashboard/adminDashboard',$data);

			}else{

				if($this->session->userdata('username') == TRUE){
					$this->toastr->error('Url Yang Anda Masukkan SalahAAAA');
					redirect('admin/sPermintaanSurat');

				}else{
					$this->toastr->error('Url Yang Anda Masukkan Salah');
					redirect('mahasiswa/pengajuanSurat');

				}
			}

		}elseif($name == 'pengajuan'){

			/*-------------------------------------------------------------------*/
			/*-- Code Di bawah Untuk Permintaan Surat Yang Di Ajukan Mahasiswa --*/
			/*-------------------------------------------------------------------*/

			if($result->kd_surat == $kd_surat && $result->id_surat == $id){

			}else{

				if($this->session->userdata('username') == TRUE){
					$this->toastr->error('Url Yang Anda Masukkan Salah');
					redirect('admin/sPermintaanSurat');

				}else{
					$this->toastr->error('Url Yang Anda Masukkan Salah');
					redirect('mahasiswa/pengajuanSurat');

				}
			}

		}elseif($name == 'permintaan'){

			/*------------------------------------------------------------------------------------*/
			/*-- Code Di bawah Untuk Konfirmasi Permintaan Surat Yang telah di Ajukan Mahasiswa --*/
			/*------------------------------------------------------------------------------------*/

			if( $result->kd_surat == $kd_surat && $result->id_permintaan == $id){

			}else{

				if($this->session->userdata('username') == TRUE){
					$this->toastr->error('Url Yang Anda Masukkan Salah');
					redirect('admin/sPermintaanSurat');

				}else{
					$this->toastr->error('Url Yang Anda Masukkan Salah');
					redirect('mahasiswa/pengajuanSurat');

				}
			}

		}else{

			if($this->session->userdata('username') == TRUE){
				$this->toastr->error('Url Yang Anda Masukkan SalahBBBB');
				redirect('admin/sPermintaanSurat');

			}else{
				$this->toastr->error('Url Yang Anda Masukkan Salah');
				redirect('mahasiswa/pengajuanSurat');

			}
		}
	}

}