<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permintaan_model extends CI_Model {


	public function getNoSuratPmr($id){

		$query = "SELECT kd_surat FROM esurat_permintaan WHERE id_permintaan = '$id'";
		$kode = $this->db->query($query)->row()->kd_surat;

		$query1 = "SELECT no_surat FROM esurat_konfirmasi WHERE kd_surat = '$kode' order by no_surat desc";
		$newnomor = '';

		if($this->db->query($query1)->num_rows() <= 0) {

			$newnomor = '0001';

		}else{

			$nomor = $this->db->query($query1)->row()->no_surat;
			$nomor = explode("/", $nomor);
			$urut = $nomor[0]+1;
			$newnomor = str_pad($urut, 4, "0", STR_PAD_LEFT);

		}

		return $newnomor.'/'.$kode;

	}

	public function getNoSuratCos($kd_suratCos){

		$kode = $kd_suratCos;

		$query1 = "SELECT no_surat FROM esurat_konfirmasi WHERE kd_surat = '$kode' order by no_surat desc";
		$newnomor = '';

		if($this->db->query($query1)->num_rows() <= 0) {

			$newnomor = '0001';

		}else{

			$nomor = $this->db->query($query1)->row()->no_surat;
			$nomor = explode("/", $nomor);
			$urut = $nomor[0]+1;
			$newnomor = str_pad($urut, 4, "0", STR_PAD_LEFT);

		}

		return $newnomor.'/'.$kode;

	}


	public function fetchDosenWithTTD($dosen_id){

		$query = "SELECT * FROM esurat_dosen WHERE id = '$dosen_id' ";
		return $this->db->query($query)->row();

	}

	public function fetchNIMWithNama($nim){

		$query = "SELECT * FROM esurat_mhs WHERE nim = '$nim' ";
		return $this->db->query($query)->row();
		
	}

}