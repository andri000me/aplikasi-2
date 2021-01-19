<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

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

	public function getMhs(){
		$query = "SELECT * FROM esurat_mhs ";
		return $this->db->query($query)->result();
	}

	public function getOneMhs($nim){
		$query = "SELECT * FROM esurat_mhs WHERE nim LIKE '$nim' ";
		return $this->db->query($query)->row();
	}

	public function getAdministrator(){
		$query = "SELECT * FROM esurat_admin ORDER BY id DESC";
		return $this->db->query($query)->result();
	}

	public function getOneAdministrator($id){
		$query = "SELECT * FROM esurat_admin WHERE id = '$id' ";
		return $this->db->query($query)->row();
	}
	public function getDosen(){
		$query = "SELECT * FROM esurat_dosen ORDER BY id DESC";
		return $this->db->query($query)->result();
	}

	public function getOneDosen($id){
		$query = "SELECT * FROM esurat_dosen WHERE id = '$id' ";
		return $this->db->query($query)->row();
	}

	public function getListSurat(){
		$query = "SELECT * FROM esurat_surat";
		return $this->db->query($query)->result();
	}

	public function getOneListSurat($id_surat){
		$query = "SELECT * FROM esurat_surat WHERE id_surat = '$id_surat' ";
		return $this->db->query($query)->row();
	}

}