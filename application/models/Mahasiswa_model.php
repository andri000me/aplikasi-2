<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa_model extends CI_Model {
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
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

}