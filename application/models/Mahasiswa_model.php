<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa_model extends CI_Model {
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function getListSuratHome(){
		$query = "SELECT * FROM esurat_surat  WHERE access = 2 LIMIT 3";
		return $this->db->query($query)->result();
	}
	public function getStatusSuratHome($nim){
		$query = "
		SELECT * FROM esurat_mhs JOIN esurat_konfirmasi ON esurat_mhs.nim = esurat_konfirmasi.permintaan_by WHERE esurat_mhs.nim = '$nim'
		UNION SELECT * FROM esurat_mhs JOIN esurat_permintaan ON esurat_mhs.nim = esurat_permintaan.permintaan_by WHERE esurat_mhs.nim = '$nim'
		ORDER BY status_surat ASC LIMIT 10";
		return $this->db->query($query)->result();
	}


	public function getProdi(){
		$query = "SELECT * FROM esurat_prodi";
		return $this->db->query($query)->result();
	}

	public function getOneProdi($kdpro){
		$query = "SELECT * FROM esurat_prodi WHERE kdpro = '$kdpro'";
		return $this->db->query($query)->row();
	}

	public function getListSurat(){
		$query = "SELECT * FROM esurat_surat WHERE access = 2 ";
		return $this->db->query($query)->result();
	}


	public function getOneListSurat($id_surat){
		$query = "SELECT * FROM esurat_surat WHERE id_surat = '$id_surat' AND access = 2 ";
		return $this->db->query($query)->row();
	}

	public function getStatusSurat($nim){
		$query = "
		SELECT * FROM esurat_mhs JOIN esurat_konfirmasi ON esurat_mhs.nim = esurat_konfirmasi.permintaan_by WHERE esurat_mhs.nim = '$nim'
		UNION SELECT * FROM esurat_mhs JOIN esurat_permintaan ON esurat_mhs.nim = esurat_permintaan.permintaan_by WHERE esurat_mhs.nim = '$nim'
		ORDER BY permintaan_tgl DESC
		";
		return $this->db->query($query)->result();
	}

	public function getNotif($nim){

		// $updateQuery= "UPDATE esurat_comment SET comment_status=1 WHERE comment_status=0";


		$query = "SELECT * FROM esurat_comments WHERE comment_to = '$nim' ORDER BY comment_id DESC LIMIT 5";

		$output = '';

		if($this->db->query($query)->num_rows() > 0){

			foreach ($this->db->query($query)->result() as $row) {
				$output .= '
				<a href="#" class="dropdown-item">
				<div class="media">
				<div class="media-body">';

				if($row->comment_surat == 'Y'){

					$output .= '<h3 class="dropdown-item-title text-success">
					'.$row->comment_subject.'
					</h3>';

				}else{

					$output .= '<h3 class="dropdown-item-title text-danger">
					'.$row->comment_subject.'
					</h3>';

				}

				$output .= '
				<p class="text-sm">'.$row->comment_text.'</p>
				<p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>'.$row->comment_date.'</p>
				</div>
				</div>
				</a>
				<div class="dropdown-divider"></div>
				';
			}
			$output .= '
			<div class="dropdown-divider"></div>
			<a href="'.base_url('mahasiswa/notif').'" class="dropdown-item dropdown-footer">See All Notifications</a>
			';

		}else{

			$output .= '
			<span class="dropdown-item dropdown-header">No Notification Found</span>
			<div class="dropdown-divider"></div>
			<a href="'.base_url('mahasiswa/notif').'" class="dropdown-item dropdown-footer">See All Notifications</a>
			';

		}



		$query1 = "SELECT * FROM esurat_comments WHERE comment_to = '$nim' AND comment_status=0";
		$count = $this->db->query($query1)->num_rows();

		$data = array(
			'notification' => $output,
			'unseen_notification' => $count
		);



		return $data;
	}
	
	public function getAllNotif($nim){

		$query = "SELECT * FROM esurat_comments WHERE comment_to = '$nim' ORDER BY comment_id DESC";
		return $this->db->query($query)->result();

	}
}