<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	/*---------------------------------*/
	/*--  Server Side Data Mahasiswa --*/
	/*---------------------------------*/

	/*-- nama tabel dari database  --*/
	var $table = 'esurat_mhs';
	/*-- field yang ada di table user yang akan ditampilkan --*/
	var $column_order = array(null, 'nmmhs','kdpro');
	/*-- field yang diizin untuk pencarian --*/
	var $column_search = array('nim','nmmhs');
	/*-- Default Order --*/
	var $order = array('nim' => 'desc');

	private function _get_mhs_query(){

		$this->db->from($this->table);

		$i = 0;
		/*-- looping awal  --*/
		foreach ($this->column_search as $item){

			/*-- jika datatable mengirimkan pencarian dengan metode POST   --*/
			if($_POST['search']['value']) {

				/*-- looping awal  --*/
				if($i===0){

					$this->db->group_start(); 
					$this->db->like($item, $_POST['search']['value']);

				}else{

					$this->db->or_like($item, $_POST['search']['value']);

				}

				if(count($this->column_search) - 1 == $i) 
					$this->db->group_end(); 
			}

			$i++;
		}

		if(isset($_POST['order'])){

			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);

		}else if(isset($this->order)){

			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);

		}
	}

	function get_mhs(){

		$this->_get_mhs_query();
		if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();

	}


	function count_filtered_mhs(){

		$this->_get_mhs_query();
		$query = $this->db->get();
		return $query->num_rows();

	}


	function count_all_mhs(){

		$this->db->from($this->table);
		return $this->db->count_all_results();

	}

}