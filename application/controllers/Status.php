<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Status extends CI_Controller {

	public function __construct(){

		parent::__construct();

		/*-- untuk mengatasi error confirm form resubmission  --*/
		header('Cache-Control: no-cache, must-revalidate, max-age=0');
		header('Cache-Control: post-check=0, pre-check=0',false);
		header('Pragma: no-cache');
		$this->load->model('admin_model');

	}

	public function statusDetail($status = null, $id = null, $kd_surat = null){

		/*-- Search KodeSurat di table esurat_surat & id_permintaan di table esurat_permintaan --*/
		$searchKode = $this->db->get_where('esurat_surat',['kd_surat' => $this->encrypt->decode($kd_surat)]);

		if (count($this->uri->segment_array()) > 5) {
			$this->toastr->error('Url Yang Anda Masukkan Salah');
			redirect('mahasiswa/statusSurat');
		}

		if (!isset($status) || !isset($id) || !isset($kd_surat)) {
			$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai ID');
			redirect('mahasiswa/statusSurat');
		}

		if (is_numeric($status)||is_numeric($id) || is_numeric($kd_surat)) {
			$this->toastr->error('Url Hanya Bisa Diakses Setelah Dienkripsi');
			redirect('mahasiswa/statusSurat');
		}

		if($searchKode->num_rows() == NULL){
			$this->toastr->error('Kode Surat Not Found!');
			redirect('mahasiswa/statusSurat');
		}

		if(!is_numeric($this->encrypt->decode($id))){
			$this->toastr->error('Url Yang Anda Masukkan Tidak Memmpunyai ID');
			redirect('mahasiswa/statusSurat');
		}

		if ( !in_array($this->encrypt->decode($status), ['PENDING','CONFIRM'], true ) ) {
			$this->toastr->error('Status Surat Error');
			redirect('mahasiswa/statusSurat');
		}


		$data['user'] = $this->db->get_where('esurat_mhs',['nim' => $this->session->userdata('nim')])->row();

		$status = $this->encrypt->decode($status);
		$id = $this->encrypt->decode($id);
		$kd_surat = $this->encrypt->decode($kd_surat);

		$mhs = $this->db->get_where('esurat_mhs',['nim' => $this->session->userdata('nim')])->row();


		if($status == 'PENDING'){
			$query = "SELECT *, JSON_UNQUOTE(JSON_EXTRACT(data_permintaan, '$.kepadaYth')) as kepadaYth, JSON_UNQUOTE(JSON_EXTRACT(data_permintaan, '$.kepadaAlamat')) as kepadaAlamat FROM esurat_permintaan WHERE id_permintaan = '$id'";

			$data['onedosen'] = $this->admin_model->getOneDosen($this->db->query("SELECT JSON_UNQUOTE(JSON_EXTRACT(data_permintaan, '$.penanggungJawab')) as penanggungJawab FROM esurat_permintaan WHERE id_permintaan = '$id'")->row()->penanggungJawab);
			$data['onepro'] = $this->admin_model->getOneProdi($this->db->query("SELECT JSON_UNQUOTE(JSON_EXTRACT(data_permintaan, '$.permintaan_prodi')) as permintaan_prodi FROM esurat_permintaan WHERE id_permintaan = '$id'")->row()->permintaan_prodi);
			$data['onemhs'] = $this->admin_model->getOneMhs($this->admin_model->getOnePmr($id)->permintaan_by);;


		}elseif($status == 'CONFIRM'){

			$query = "SELECT *, JSON_UNQUOTE(JSON_EXTRACT(data_permintaan, '$.kepadaYth')) as kepadaYth, JSON_UNQUOTE(JSON_EXTRACT(data_permintaan, '$.kepadaAlamat')) as kepadaAlamat FROM esurat_konfirmasi WHERE id_konfirmasi = '$id'";

			$data['onedosen'] = $this->admin_model->getOneDosen($this->db->query("SELECT JSON_UNQUOTE(JSON_EXTRACT(data_permintaan, '$.penanggungJawab')) as penanggungJawab FROM esurat_konfirmasi WHERE id_konfirmasi = '$id'")->row()->penanggungJawab);
			$data['onepro'] = $this->admin_model->getOneProdi($this->db->query("SELECT JSON_UNQUOTE(JSON_EXTRACT(data_permintaan, '$.permintaan_prodi')) as permintaan_prodi FROM esurat_konfirmasi WHERE id_konfirmasi = '$id'")->row()->permintaan_prodi);
			$data['onemhs'] = $this->admin_model->getOneMhs($this->admin_model->getOneKfm($id)->permintaan_by);

		}

		$result = $this->db->query($query)->row();

		/*-- Load One Data Surat untuk View --*/
		$data['onestatus'] = $result;


		if($status == 'PENDING'){

			if($id == $result->id_permintaan && $kd_surat == $result->kd_surat){

				switch ($searchKode->row()->kd_surat) {
					case 'SP-I-KP':

					$data['status'] = $status;
					$data['title'] = " mahasiswa | Status Surat";
					$data['parent'] = "Status Surat";
					$data['page'] = $searchKode->row()->kd_surat;
					$this->template->load('mahasiswa/layout/mahasiswaTemplate','surat/status/status_SP-I-KP',$data);
					break;

					case 'SP-D-TA':

					$data['status'] = $status;
					$data['title'] = " mahasiswa | Status Surat";
					$data['parent'] = "Status Surat";
					$data['page'] = $searchKode->row()->kd_surat;
					$this->template->load('mahasiswa/layout/mahasiswaTemplate','surat/status/status_SP-D-TA',$data);
					break;

					case 'SP-KP':

					$data['status'] = $status;
					$data['title'] = " mahasiswa | Status Surat";
					$data['parent'] = "Status Surat";
					$data['page'] = $searchKode->row()->kd_surat;
					$this->template->load('mahasiswa/layout/mahasiswaTemplate','surat/status/status_SP-KP',$data);
					break;

					case 'SP-P-TA':

					$data['status'] = $status;
					$data['title'] = " mahasiswa | Status Surat";
					$data['parent'] = "Status Surat";
					$data['page'] = $searchKode->row()->kd_surat;
					$this->template->load('mahasiswa/layout/mahasiswaTemplate','surat/status/status_SP-P-TA',$data);
					break;

					default:
					$this->toastr->error('Url Yang Anda Inginkan Tidak Ada');
					redirect('mahasiswa/statusSurat');
					break;
				}

			}else{

				$this->toastr->error('Url Yang Anda Inginkan Tidak Ada');
				redirect('mahasiswa/statusSurat');

			}

		}elseif($status == 'CONFIRM'){

			if($id == $result->id_konfirmasi && $kd_surat == $result->kd_surat){

				switch ($searchKode->row()->kd_surat) {
					case 'SP-I-KP':

					$data['status'] = $status;
					$data['title'] = " mahasiswa | Status Surat";
					$data['parent'] = "Status Surat";
					$data['page'] = $searchKode->row()->kd_surat;
					$this->template->load('mahasiswa/layout/mahasiswaTemplate','surat/status/status_SP-I-KP',$data);
					break;

					case 'SP-D-TA':

					$data['status'] = $status;
					$data['title'] = " mahasiswa | Status Surat";
					$data['parent'] = "Status Surat";
					$data['page'] = $searchKode->row()->kd_surat;
					$this->template->load('mahasiswa/layout/mahasiswaTemplate','surat/status/status_SP-D-TA',$data);
					break;

					case 'SP-KP':

					$data['status'] = $status;
					$data['title'] = " mahasiswa | Status Surat";
					$data['parent'] = "Status Surat";
					$data['page'] = $searchKode->row()->kd_surat;
					$this->template->load('mahasiswa/layout/mahasiswaTemplate','surat/status/status_SP-KP',$data);
					break;

					case 'SP-P-TA':

					$data['status'] = $status;
					$data['title'] = " mahasiswa | Status Surat";
					$data['parent'] = "Status Surat";
					$data['page'] = $searchKode->row()->kd_surat;
					$this->template->load('mahasiswa/layout/mahasiswaTemplate','surat/status/status_SP-P-TA',$data);
					break;

					default:
					$this->toastr->error('Url Yang Anda Inginkan Tidak Ada');
					redirect('mahasiswa/statusSurat');
					break;
				}

				
			}else{

				$this->toastr->error('Url Yang Anda Inginkan Tidak Ada aaa');
				redirect('mahasiswa/statusSurat');

			}

		}else{

			$this->toastr->error('Surat Yang Anda Inginkan Tidak Ada');
			redirect('mahasiswa/statusSurat');
		}

	}


}