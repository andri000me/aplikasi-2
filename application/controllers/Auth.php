<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct(){

		parent::__construct();

		/*-- untuk mengatasi error confirm form resubmission  --*/
		header('Cache-Control: no-cache, must-revalidate, max-age=0');
		header('Cache-Control: post-check=0, pre-check=0',false);
		header('Pragma: no-cache');
		$this->load->model('admin_model');
		$this->load->model('auth_model');

	}


	public function index(){

		// if($this->session->userdata('username')){

		// 	redirect('admin');

		// }elseif($this->session->userdata('nim')){

		// 	redirect('mahasiswa');

		// }

		$data['title'] = "E-Surat | Fastikom";
		$data['parent'] = "E-Surat";
		$data['page'] = "E-Surat";
		$this->template->load('auth/layout/authTemplate','auth/modulLogin/authLogin',$data);

	}

	public function mahasiswa() {

		if (!$this->input->is_ajax_request()) {

			echo 'No direct script is allowed';
			die;
			
		}

		$nim = strip_tags($this->input->post('nimMhs'));
		$pass = strip_tags($this->input->post('passMhs'));

		$data = array('success' => false,'messages' => array());
		$this->form_validation->set_rules('nimMhs','NIM','trim|required|is_natural',[
			'is_natural' => 'NIM Hanya Berisi Angka']);
		$this->form_validation->set_rules('passMhs','Password','trim|required');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

		if($this->form_validation->run()){

			$mhs = $this->db->get_where('esurat_mhs', ['nim' => $this->db->escape_str($nim)])->row();

			if($mhs){

				if(password_verify($this->db->escape_str($pass), $mhs->pass)){

					$data_login = [

						'nim' => $mhs->nim,
						'role' => '2',

					];

					$this->session->set_userdata($data_login);
					$data['title'] = 'Selamat Datang';
					$data['nama'] = $mhs->nmmhs;
					$data['type'] = 'success';
					$data['redirect'] = base_url('mahasiswa');
					$data['url'] = true;

				}else{

					$data['title'] = 'Wrong Password';
					$data['type'] = 'warning';
					$data['url'] = false;

				}

			}else{

				$data['title'] = 'NIM Not Found';
				$data['type'] = 'error';
				$data['url'] = false;

			}

			$data['success'] = true;

		}else{

			foreach ($_POST as $key => $value) {

				$data['messages'][$key] = form_error($key);

			}

		}

		echo json_encode($data);

	}

	public function admin() {

		$user = strip_tags($this->input->post('usrAdmin'));
		$password = strip_tags($this->input->post('passAdmin'));

		$data = array('success' => false,'messages' => array());
		$this->form_validation->set_rules('usrAdmin','Username','trim|required');
		$this->form_validation->set_rules('passAdmin','Password','trim|required');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if($this->form_validation->run()){

			$admin = $this->db->get_where('esurat_admin', ['username' => $this->db->escape_str($user)])->row();

			if($admin){

				if($admin->is_active == '1'){


					if(password_verify($this->db->escape_str($password), $admin->password)){

						$data_login = [

							'username' => $admin->username,
							'role' => '1',

						];

						$this->session->set_userdata($data_login);
						$data['title'] = 'Selamat Datang';
						$data['nama'] = $admin->username;
						$data['type'] = 'success';
						$data['redirect'] = base_url('admin');
						$data['url'] = true;

					}else{

						$data['title'] = 'Wrong Password';
						$data['type'] = 'warning';
						$data['url'] = false;

					}

				}else{

					$data['title'] = 'User Belum Active Silahkan Hubungi Administrator';
					$data['type'] = 'warning';
					$data['url'] = false;

				}

			}else{

				$data['title'] = 'Username Not Found';
				$data['type'] = 'error';
				$data['url'] = false;

			}

			$data['success'] = true;

		}else{

			foreach ($_POST as $key => $value) {

				$data['messages'][$key] = form_error($key);

			}

		}

		echo json_encode($data);

	}

	public function logout(){

		$this->session->unset_userdata('username');
		$this->session->unset_userdata('nim');
		$this->session->unset_userdata('role');
		$this->session->set_flashdata('message','You have been logged out!');
		// $this->toastr->success('You have been logged out!');
		redirect('auth');	

	}

	public function Surat($enkripsi = null){

		if (count($this->uri->segment_array()) > 3) {
			$this->session->set_flashdata('message','URL Yang Anda Masukkan Salah');
			redirect('auth');
		}
		
		$query = "SELECT * FROM esurat_konfirmasi WHERE enkripsi = '".$enkripsi."'";
		if($this->db->query($query)->num_rows() <= 0 ){
			$this->session->set_flashdata('message','Surat Yang Anda Inginkan Tidak Ada');
			redirect('auth');
		}

		if (!isset($enkripsi)) {
			$this->session->set_flashdata('message','Surat Yang Anda Inginkan Tidak Ada');
			redirect('auth');
		}

		/*-- Load One Data Permintaan Pada Input --*/
		$data['oneSurat'] = $this->auth_model->getOneSurat($enkripsi);

		switch ($surat->kd_surat) {

			case 'SP-KP':

			$surat = $this->auth_model->getOneSurat($enkripsi);

			/*-- Load One Data Dosen Pada Input --*/
			$data['onedos'] = $this->admin_model->getOneDosen($surat->dosen);
			/*-- Load One Data Mahasiswa Pada Input --*/
			$data['onemhs'] = $this->admin_model->getOneMhs($surat->permintaan_by);
			/*-- Load One Data Prodi Pada Input --*/
			$data['onepro'] = $this->admin_model->getOneProdi($surat->permintaan_kdpro);

			/*-- Load One Data Mahasiswa Pada Hasil Surat --*/
			$mahasiswa = $this->admin_model->getOneMhs($surat->permintaan_by);
			/*-- Load One Data Dosen Pada Hasil Surat --*/
			$dosen = $this->admin_model->getOneDosen($surat->dosen);
			/*-- Load One Data Prodi Pada Hasil Surat --*/
			$prodi = $this->admin_model->getOneProdi($surat->permintaan_kdpro);

			/*-- Load Semua Data Dosen Pada Input --*/
			$data['dosenall'] = $this->admin_model->getDosen();

			$komponenSurat = [

				'bulan' => bulan_romawi(date('Y-m-d')),
				'tahun' => date('Y'),
				'kepada' => $surat->kepada,
				'nama_mhs' => $mahasiswa->nmmhs,
				'nim_mhs' => $mahasiswa->nim,
				'angkatan_mhs' => semester($mahasiswa->thaka),
				'prodi_mhs' => $prodi->prodi,
				'dosen' => $dosen->nama,
				'dosen_jabatan' => $dosen->jabatan,
				'no_surat' => $surat->no_surat,
				'disetujui_tgl' => date_indo($surat->disetujui_tgl),
				'jabatan' => $dosen->jabatan,
				'ttd' => $dosen->nama,
				'nip' => $dosen->nip

			];

			$data['isi'] = $surat->isi_surat;
			$data['komponen'] = $komponenSurat;

			$data['title'] = "Detail Surat";
			$this->template->load('surat/layout/surat_template','surat/SP-KP',$data);
			break;
			
			default:
		# code...
			break;
		}

	}

}