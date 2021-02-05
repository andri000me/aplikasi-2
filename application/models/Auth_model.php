<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function getOneSurat($enkripsi){

		$query = "SELECT * FROM esurat_selesai WHERE enkripsi = '$enkripsi' ";
		return $this->db->query($query)->row();

	}


}