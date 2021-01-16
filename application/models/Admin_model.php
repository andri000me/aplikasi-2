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

	public function getOneMhs($nim){

		$query = "SELECT * FROM esurat_mhs WHERE nim LIKE '$nim' ";
		return $this->db->query($query)->row();

	}


}