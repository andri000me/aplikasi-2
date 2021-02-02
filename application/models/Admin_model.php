<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function getCountMhs(){
		$query = "SELECT COUNT(nmmhs) as nmmhs FROM esurat_mhs";
		return $this->db->query($query)->row()->nmmhs;
	}

	public function getCountlist(){
		$query = "SELECT COUNT(id_surat) as surat FROM esurat_surat";
		return $this->db->query($query)->row()->surat;
	}

	public function getCountPmr(){
		$query = "SELECT COUNT(id_permintaan) as permintaan FROM esurat_permintaan";
		return $this->db->query($query)->row()->permintaan;
	}

	public function getCountKfm(){
		$query = "SELECT COUNT(id_konfirmasi) as selesai FROM esurat_konfirmasi";
		return $this->db->query($query)->row()->selesai;
	}

	public function getPmrLimit(){
		$query = "SELECT * FROM esurat_permintaan JOIN esurat_mhs ON esurat_permintaan.permintaan_by = esurat_mhs.nim ORDER BY id_permintaan ASC  LIMIT 5";
		return $this->db->query($query)->result();
	}

	public function getKfmLimit(){
		$query = "SELECT * FROM esurat_konfirmasi JOIN esurat_mhs ON esurat_konfirmasi.permintaan_by = esurat_mhs.nim ORDER BY id_konfirmasi DESC  LIMIT 5";
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

	public function getOnePmr($id_permintaan){
		$query = "SELECT * FROM esurat_permintaan WHERE id_permintaan LIKE '$id_permintaan' ";
		return $this->db->query($query)->row();
	}
	public function getOneKfm($id_konfirmasi){
		$query = "SELECT * FROM esurat_konfirmasi WHERE id_konfirmasi LIKE '$id_konfirmasi' ";
		return $this->db->query($query)->row();
	}

	public function getAllMenu(){
		$query = "SELECT * FROM esurat_menu";
		return $this->db->query($query)->result();
	}

	public function getOneMenu($id_menu){
		$query = "SELECT * FROM esurat_menu WHERE id_menu LIKE '$id_menu' ";
		return $this->db->query($query)->row();
	}

	public function getAllRole(){
		$query = "SELECT * FROM esurat_role";
		return $this->db->query($query)->result();
	}

	public function getOneRole($id){
		$query = "SELECT * FROM esurat_role WHERE id LIKE '$id' ";
		return $this->db->query($query)->row();
	}

}