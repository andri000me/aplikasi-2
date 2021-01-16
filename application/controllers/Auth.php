<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct(){

		parent::__construct();

		/*-- untuk mengatasi error confirm form resubmission  --*/
		header('Cache-Control: no-cache, must-revalidate, max-age=0');
		header('Cache-Control: post-check=0, pre-check=0',false);
		header('Pragma: no-cache');


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
		$this->toastr->success('You have been logged out!');
		redirect('auth');	

	}

}