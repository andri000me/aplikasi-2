<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Prints extends CI_Controller {

	public function __construct(){
		parent::__construct();

		//untuk mengatasi error confirm form resubmission
		header('Cache-Control: no-cache, must-revalidate, max-age=0');
		header('Cache-Control: post-check=0, pre-check=0',false);
		header('Pragma: no-cache');
		$this->load->model('admin_model');
		$this->load->model('mahasiswa_model');
		$this->load->model('permintaan_model');
	}


	public function printSurat($id_konfirmasi = null, $kd_surat = null){

		/*-- Search KodeSurat di table esurat_surat & id_permintaan di table esurat_permintaan --*/
		$searchKode = $this->db->get_where('esurat_surat',['kd_surat' => $this->encrypt->decode($kd_surat)]);

		if($this->session->userdata('username') == TRUE){

			$data['user'] = $this->db->get_where('esurat_admin',['username' => $this->session->userdata('username')])->row();

			/*-- Encrypt URL Kdpro --*/
			if (count($this->uri->segment_array()) > 4) {
				$this->toastr->error('Url Yang Anda Masukkan Salah');
				redirect('Admin/sSuratSelesai');
			}
			if (!isset($id_konfirmasi) || !isset($kd_surat)) {
				$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai ID');
				redirect('Admin/sSuratSelesai');
			}
			if (is_numeric($id_konfirmasi) || is_numeric($kd_surat)) {
				$this->toastr->error('Url Hanya Bisa Diakses Setelah Dienkripsi');
				redirect('Admin/sSuratSelesai');
			}
			if($searchKode->num_rows() == NULL){
				$this->toastr->error('Kode Surat Not Found!');
				redirect('admin/sPermintaanSurat');
			}
			if(!is_numeric($this->encrypt->decode($id_konfirmasi))){
				$this->toastr->error('Url Yang Anda Masukkan Salah');
				redirect('Admin/sPermintaanSurat');
			}

		}else{

			$data['user'] = $this->db->get_where('esurat_mhs',['nim' => $this->session->userdata('nim')])->row();

			/*-- Encrypt URL Kdpro --*/
			if (count($this->uri->segment_array()) > 4) {
				$this->toastr->error('Url Yang Anda Masukkan Salah');
				redirect('mahasiswa/statusSurat');
			}
			if (!isset($id_konfirmasi) || !isset($kd_surat)) {
				$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai ID');
				redirect('mahasiswa/statusSurat');
			}
			if (is_numeric($id_konfirmasi) || is_numeric($kd_surat)) {
				$this->toastr->error('Url Hanya Bisa Diakses Setelah Dienkripsi');
				redirect('mahasiswa/statusSurat');
			}
			if($searchKode->num_rows() == NULL){
				$this->toastr->error('Kode Surat Not Found!');
				redirect('admin/sPermintaanSurat');
			}
			if(!is_numeric($this->encrypt->decode($id_konfirmasi))){
				$this->toastr->error('Url Yang Anda Masukkan Salah');
				redirect('mahasiswa/statusSurat');
			}

		}

		/*-- Mendecode $id_konfirmasi & $kd_surat --*/	
		$id_konfirmasi = $this->encrypt->decode($id_konfirmasi);
		$kd_surat = $this->encrypt->decode($kd_surat);

		/*-- Menentukan Id_selesai & Kode Surat --*/
		$print = $this->db->get_where('esurat_konfirmasi',['id_konfirmasi' => $id_konfirmasi])->row();



		if($print->id_konfirmasi == $id_konfirmasi && $print->kd_surat == $kd_surat){

			/*-- Load One Data Permintaan Pada Hasil Surat --*/
			$printData = $this->db->query("SELECT *, JSON_UNQUOTE(JSON_EXTRACT(data_permintaan, '$.kepadaYth')) as kepadaYth, JSON_UNQUOTE(JSON_EXTRACT(data_permintaan, '$.kepadaAlamat')) as kepadaAlamat, JSON_UNQUOTE(JSON_EXTRACT(enkripsi, '$.enkripsi')) as enkripsi FROM esurat_konfirmasi WHERE id_konfirmasi = '$id_konfirmasi'")->row();

			/*-- Load One Data Mahasiswa Pada Hasil Surat --*/
			$mahasiswa = $this->admin_model->getOneMhs($this->admin_model->getOneKfm($id_konfirmasi)->permintaan_by);
			/*-- Load One Data Dosen Pada Hasil Surat --*/
			$dosen = $this->admin_model->getOneDosen($this->db->query("SELECT JSON_UNQUOTE(JSON_EXTRACT(data_permintaan, '$.penanggungJawab')) as penanggungJawab FROM esurat_konfirmasi WHERE id_konfirmasi = '$id_konfirmasi'")->row()->penanggungJawab);
			/*-- Load One Data Prodi Pada Hasil Surat --*/
			$prodi = $this->admin_model->getOneProdi($this->db->query("SELECT JSON_UNQUOTE(JSON_EXTRACT(data_permintaan, '$.permintaan_prodi')) as permintaan_prodi FROM esurat_konfirmasi WHERE id_konfirmasi = '$id_konfirmasi'")->row()->permintaan_prodi);

			switch ($print->kd_surat) {
				case 'SP-I-KP':

				$komponenSurat = [
					'no_surat' => $printData->no_surat,
					'bulan' => bulan_romawi(date('Y-m-d')),
					'tahun' => date('Y'),
					'kepadaYth' => $printData->kepadaYth,
					'kepadaAlamat' => $printData->kepadaAlamat,
					'penanggungJawab' => $dosen->nama,
					'penanggungJawab_jabatan' => $dosen->jabatan,
					'nama' => $mahasiswa->nmmhs,
					'nim' => $mahasiswa->nim,
					'semester' => semesterromawi(semester($mahasiswa->thaka)),
					'prodi' => $prodi->prodi,
					'tgl_disetujui' => date_indo($printData->disetujui_tgl),
					'ttd_jabatan' => $this->admin_model->getOneDosen($printData->ttd)->jabatan,
					'ttd_nama' => $this->admin_model->getOneDosen($printData->ttd)->nama,
					'ttd_nip' => $this->admin_model->getOneDosen($printData->ttd)->nip,
					'qrcode' => '<img src="'. base_url('assets/esurat/img/QRCode/'.str_replace("/", "_", $printData->no_surat)).'.png" style=" width: 125px; height: 125px;">',
					'ttd_img' => '<img src="'. base_url('assets/esurat/img/ttd/'.str_replace("/", "_", $dosen->nama)).'.png" style=" width: 125px; height: 125px;">'


				];

				$data['isi'] = $this->admin_model->getOneKfm($id_konfirmasi)->isi_surat;
				$data['ttd'] = $this->admin_model->getOneDosen($printData->ttd)->nama;
				$data['komponen'] = $komponenSurat;
				$data['jenis'] = $print->nm_surat;
				$data['no_surat'] = $print->no_surat;
				$this->load->view('surat/prints/prints_SP-I-KP', $data);

				break;

				default:

    				# code...

				break;
			}

		}else{

			if($this->session->userdata('username') == TRUE){

				$this->toastr->error('Url Yang Anda Masukkan Salah');
				redirect('admin/sSuratSelesai');

			}else{

				$this->toastr->error('Url Yang Anda Masukkan Salah');
				redirect('mahasiswa/pengajuanSurat');

			}

		}

		
	}

}