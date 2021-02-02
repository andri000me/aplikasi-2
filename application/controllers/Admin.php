<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Admin extends CI_Controller {

	public function __construct(){

		parent::__construct();
		/*-- Check Session  --*/
		is_admin();

		/*-- untuk mengatasi error confirm form resubmission  --*/
		header('Cache-Control: no-cache, must-revalidate, max-age=0');
		header('Cache-Control: post-check=0, pre-check=0',false);
		header('Pragma: no-cache');
		$this->load->model('admin_model');
	}


	public function index(){

		$data['user'] = $this->db->get_where('esurat_admin',['username' => $this->session->userdata('username')])->row();
		$data['mhs'] = $this->admin_model->getCountMhs();
		$data['surat'] = $this->admin_model->getCountlist();
		$data['permintaan'] = $this->admin_model->getCountPmr();
		$data['selesai'] = $this->admin_model->getCountKfm();
		$data['pmrlimit'] = $this->admin_model->getPmrLimit();
		$data['kfmlimit'] = $this->admin_model->getKfmLimit();

		$data['title'] = "Admin | Dashboard";
		$data['parent'] = "Dashboard";
		$data['page'] = "Dashboard";
		$this->template->load('admin/layout/adminTemplate','admin/modulDashboard/adminDashboard',$data);

	}

	public function dMahasiswa(){

		if (count($this->uri->segment_array()) > 2) {
			$this->toastr->error('Url Yang Anda Masukkan Salah');
			redirect('admin/dMahasiswa');
		}

		$data['user'] = $this->db->get_where('esurat_admin',['username' => $this->session->userdata('username')])->row();

		$data['title'] = "Admin | Data Mahasiswa";
		$data['parent'] = "Data Mahasiswa";
		$data['page'] = "Data Mahasiswa";
		$this->template->load('admin/layout/adminTemplate','admin/modulMahasiswa/adminMahasiswa',$data);

	}

	public function dMahasiswaDetail($nim = null){

		/*-- Encrypt URL NIM --*/
		if (count($this->uri->segment_array()) > 3) {
			$this->toastr->error('Url Yang Anda Masukkan Salah');
			redirect('admin/dMahasiswa');
		}
		if (!isset($nim)) {
			$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai ID');
			redirect('admin/dMahasiswa');
		}
		if (is_numeric($nim)) {
			$this->toastr->error('Url Hanya Bisa Diakses Setelah Dienkripsi');
			redirect('admin/dMahasiswa');
		} 
		$oneMhs = $this->db->get_where('esurat_mhs',['nim' => $this->encrypt->decode($nim)]);
		if($oneMhs->num_rows() == null){
			$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai NIM');
			redirect('admin/dMahasiswa');
		}
		/*-- /. Encrypt URL NIM --*/

		$data['user'] = $this->db->get_where('esurat_admin',['username' => $this->session->userdata('username')])->row();

		$data['onemhs'] = $this->admin_model->getOneMhs($this->encrypt->decode($nim)); /*-- Load One Data Mhs --*/

		$data['title'] = "Admin | Data Mahasiswa";
		$data['parent'] = "Data Mahasiswa";
		$data['page'] = "Detail Mahasiswa";
		$this->template->load('admin/layout/adminTemplate','admin/modulMahasiswa/adminMahasiswaDetail',$data);

	}

	public function dMahasiswaEdit($nim = null){

		/*-- Encrypt URL NIM --*/
		if (count($this->uri->segment_array()) > 3) {
			$this->toastr->error('Url Yang Anda Masukkan Salah');
			redirect('admin/dMahasiswa');
		}
		if (!isset($nim)) {
			$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai NIM');
			redirect('admin/dMahasiswa');
		}
		if (is_numeric($nim)) {
			$this->toastr->error('Url Hanya Bisa Diakses Setelah Terenkripsi');
			redirect('admin/dMahasiswa');
		} 
		$oneMhs = $this->db->get_where('esurat_mhs',['nim' => $this->encrypt->decode($nim)]);
		if($oneMhs->num_rows() == null){
			$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai NIMaaa');
			redirect('admin/dMahasiswa');
		}
		/*-- /. Encrypt URL NIM --*/

		$data['user'] = $this->db->get_where('esurat_admin',['username' => $this->session->userdata('username')])->row();

		$data['onemhs'] = $this->admin_model->getOneMhs($this->encrypt->decode($nim)); /*-- Load One Data Mhs --*/
		$data['prodi'] = $this->admin_model->getProdi(); /*-- Load Semua Data Prodi --*/

		$this->form_validation->set_rules('nim', 'NIM','trim|required|is_natural',[
			'is_natural' => 'NIM Hanya Berisi Angka']);
		$this->form_validation->set_rules('nama', 'Nama Mahasiswa','required|alpha_numeric_spaces',[
			'alpha_numeric_spaces' => 'Hanya Berisi Huruf'
		]);
		$this->form_validation->set_rules('prodi', 'Prodi','required');
		$this->form_validation->set_rules('angkatan', 'Tahun Angkatan','trim|required');
		$this->form_validation->set_rules('kelamin', 'Jenis Kelamin','required');
		$this->form_validation->set_rules('status', 'Status','required');
		$this->form_validation->set_rules('tempat', 'Tempat lahir','trim|required|alpha',[
			'alpha' => 'nama Hanya Berisi Huruf Alfabet']);
		$this->form_validation->set_rules('tanggal', 'Tanggal Lahir','required');
		$this->form_validation->set_rules('alamat', 'Alamat','required');
		$this->form_validation->set_rules('ortu', 'Nama Orang Tua','required');
		$this->form_validation->set_rules('email', 'Email','required');
		$this->form_validation->set_rules('password', 'password','trim|min_length[5]',[
			'min_length' => 'Password Minimal 5 Character'
		]);
		$this->form_validation->set_rules('tlp', 'No Telepon','trim|required');
		$this->form_validation->set_rules('kelas', 'Kelas','required');

		if($this->form_validation->run() == false){

			$data['title'] = "Admin | Data Mahasiswa";
			$data['parent'] = "Data Mahasiswa";
			$data['page'] = "Edit Mahasiswa";
			$this->template->load('admin/layout/adminTemplate','admin/modulMahasiswa/adminMahasiswaEdit',$data);

		}else{

			if(password_verify($this->input->post('password'),$oneMhs->row()->pass)) {

				$this->toastr->error('Password yang anda masukkan sama dengan password yang anda gunakan saat ini!');
				$data['title'] = "Admin | Data Mahasiswa";
				$data['parent'] = "Data Mahasiswa";
				$data['page'] = "Edit Mahasiswa";
				$this->template->load('admin/layout/adminTemplate','admin/modulMahasiswa/adminMahasiswaEdit',$data);

			}else{

				$data = [

					'nmmhs' => $this->db->escape_str(ucwords($this->input->post('nama')),true),
					'kdpro' => $this->db->escape_str($this->input->post('prodi'),true),
					'thaka' => $this->db->escape_str($this->input->post('angkatan'),true),
					'kel' => $this->db->escape_str(str_replace("_/","",$this->input->post('kelamin')),true),
					'status' => $this->db->escape_str($this->input->post('status'),true),
					'alasan_status' => $this->db->escape_str($this->input->post('als_status'),true),
					'tptlhr' => $this->db->escape_str($this->input->post('tempat'),true),
					'tgllhr' => $this->db->escape_str(date('Y-m-d',strtotime($this->input->post('tanggal'))),true),
					'alamat' => $this->db->escape_str($this->input->post('alamat'),true),
					'nmortu' => $this->db->escape_str($this->input->post('ortu'),true),
					'email' => $this->db->escape_str($this->input->post('email'),true),
					'telp' => $this->db->escape_str(str_replace("-","",$this->input->post('tlp')),true),
					'kelas' => $this->db->escape_str($this->input->post('kelas'),true)

				];

				if(!empty($this->input->post('password'))) {

					$data['pass'] = $this->db->escape_str(password_hash($this->input->post('password'), PASSWORD_DEFAULT),true);

				}else{

                    // We don't save an empty password
					unset($data['pass']);
				}

				$this->db->where('nim', $oneMhs->row()->nim);
				$this->db->update('esurat_mhs',$data);
				$this->toastr->success('Data Mahasiswa '.$this->input->post('nama').' Berhasil diupdate!');
				redirect('admin/dMahasiswa');

			}

		}
	}

	public function dAdministrator(){

		if (count($this->uri->segment_array()) > 2) {
			$this->toastr->error('Url Yang Anda Masukkan Salah');
			redirect('admin/dAdministrator');
		}

		$data['user'] = $this->db->get_where('esurat_admin',['username' => $this->session->userdata('username')])->row();

		$data['adminis'] = $this->admin_model->getAdministrator(); /*-- Load Semua Data Administrator --*/

		$data['title'] = "Admin | Data Administrator";
		$data['parent'] = "Data Administrator";
		$data['page'] = "Data Administrator";
		$this->template->load('admin/layout/adminTemplate','admin/modulAdministrator/adminAdministrator',$data);

	}

	public function dAdministratorAdd(){

		if (count($this->uri->segment_array()) > 2) {
			$this->toastr->error('Url Yang Anda Masukkan Salah');
			redirect('admin/dAdministrator');
		}

		$data['user'] = $this->db->get_where('esurat_admin',['username' => $this->session->userdata('username')])->row();

		$this->form_validation->set_rules('username','Username','required|trim|is_unique[esurat_admin.username]', [
			'is_unique' => 'This Username has alredy taken!'
		]);
		$this->form_validation->set_rules('password','Password','required|trim|min_length[5]|matches[repeatpassword]', [
			'matches' => 'Password dont macth!',
			'min_length' => 'Password to short, Min 5 Character!'
		]);
		$this->form_validation->set_rules('repeatpassword','Repeat Password','required|trim|matches[password]');

		if($this->form_validation->run() == false){

			$data['title'] = "Admin | Data Administrator";
			$data['parent'] = "Data Administrator";
			$data['page'] = "Add Administrator";
			$this->template->load('admin/layout/adminTemplate','admin/modulAdministrator/adminAdministratorAdd',$data);

		}else{

			$data = [

				'username' => $this->db->escape_str(htmlspecialchars($this->input->post('username')),true),
				'image' => $this->db->escape_str('default.jpg',true),
				'password' => $this->db->escape_str(password_hash($this->input->post('password'), PASSWORD_DEFAULT),true),
				'is_active' => $this->db->escape_str(0,true),
				'date_created' => $this->db->escape_str(time(),true)

			];

			$this->db->insert('esurat_admin', $data);
			$this->toastr->success('Data Administrator '.$this->input->post('username').' Telah Ditambahkan!');
			redirect('admin/dAdministrator');

		}
	}

	public function dAdministratorDetail($id = null){

		/*-- Encrypt URL Id --*/
		if (count($this->uri->segment_array()) > 3) {
			$this->toastr->error('Url Yang Anda Masukkan Salah');
			redirect('admin/dAdministrator');
		}
		if (!isset($id)) {
			$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai ID');
			redirect('admin/dAdministrator');
		}
		if (is_numeric($id)) {
			$this->toastr->error('Url Hanya Bisa Diakses Setelah Dienkripsi');
			redirect('admin/dAdministrator');
		} 

		$oneAdm = $this->db->get_where('esurat_admin', ['id' => $this->encrypt->decode($id)]);
		if($oneAdm->num_rows() == null ){
			$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai ID');
			redirect('admin/dAdministrator');
		}
		/*-- /. Encrypt URL Id --*/

		$data['user'] = $this->db->get_where('esurat_admin',['username' => $this->session->userdata('username')])->row();

		$data['oneadm'] = $this->admin_model->getOneAdministrator($this->encrypt->decode($id)); /*-- Load One Data Administrator --*/

		$data['title'] = "Admin | Data Administrator";
		$data['parent'] = "Data Administrator";
		$data['page'] = "Detail Administrator";
		$this->template->load('admin/layout/adminTemplate','admin/modulAdministrator/adminAdministratorDetail',$data);

	}

	public function dAdministratorEdit($id= null){

		/*-- Encrypt URL Id --*/
		if (count($this->uri->segment_array()) > 3) {
			$this->toastr->error('Url Yang Anda Masukkan Salah');
			redirect('admin/dAdministrator');
		}
		if (!isset($id)) {
			$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai ID');
			redirect('admin/dAdministrator');
		}
		if (is_numeric($id)) {
			$this->toastr->error('Url Hanya Bisa Diakses Setelah Dienkripsi');
			redirect('admin/dAdministrator');
		}

		$oneAdm = $this->db->get_where('esurat_admin', ['id' => $this->encrypt->decode($id)]);
		if($oneAdm->num_rows() == null ){
			$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai ID');
			redirect('admin/dAdministrator');
		}
		/*-- /. Encrypt URL Id --*/

		$data['user'] = $this->db->get_where('esurat_admin',['username' => $this->session->userdata('username')])->row();

		$data['oneadm'] = $this->admin_model->getOneAdministrator($this->encrypt->decode($id));

		$this->form_validation->set_rules('fullname', 'Fullname','required|alpha_numeric_spaces',[
			'alpha_numeric_spaces' => 'Hanya Berisi Huruf'
		]);
		$this->form_validation->set_rules('username','Username','required|trim');
		$this->form_validation->set_rules('password','Password','trim|min_length[5]',[
			'min_length' => 'Password to short, min 5 Character!'
		]);
		$this->form_validation->set_rules('email','Email','trim|required|valid_email');

		if($this->form_validation->run() == false){

			$data['title'] = "Admin | Data Administrator";
			$data['parent'] = "Data Administrator";
			$data['page'] = "Edit Administrator";
			$this->template->load('admin/layout/adminTemplate','admin/modulAdministrator/adminAdministratorEdit',$data);

		}else{

			if(password_verify($this->input->post('password'),$oneAdm->row()->password)) {

				$this->toastr->error('Password yang anda masukkan sama dengan password yang anda gunakan saat ini!');
				$data['title'] = "Admin | Data Administrator";
				$data['parent'] = "Data Administrator";
				$data['page'] = "Edit Administrator";
				$this->template->load('admin/layout/adminTemplate','admin/modulAdministrator/adminAdministratorEdit',$data);
				
			}else{



				/*-- check jika ada gambar yang akan diupload, "picure" itu nama inputnya --*/
				$upload_image = $_FILES['picture']['name'];

				if($upload_image){

					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size']     = '5120'; /*-- dalam hitungan kilobyte(kb), aslinya 1mb itu 1024kb --*/
					$config['upload_path'] = './assets/esurat/img/profile/';

					$this->load->library('upload', $config);

					if($this->upload->do_upload('picture')){

						$old_image = $data['esurat_admin']['image'];

						if($old_image != 'default.jpg'){

							unlink(FCPATH . './assets/esurat/img/profile/' . $old_image);

						}

						$new_image = $this->upload->data('file_name');
						$this->db->set('image', $new_image);

					}else{

						$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
						redirect('admin/dAdministratorEdit/'.$this->encrypt->encode($id).'');

					}
				}

				$data = [

					'username' => $this->db->escape_str($this->input->post('username'),true),
					'fullname' => $this->db->escape_str(ucwords($this->input->post('fullname')),true),
					'email' => $this->db->escape_str($this->input->post('email'),true),
					'phone' => $this->db->escape_str(str_replace("-","",$this->input->post('phone')),true),
					'address' => $this->db->escape_str($this->input->post('address'),true),
					'is_active' => $this->db->escape_str($this->input->post('status'),true)

				];

				if(!empty($this->input->post('password'))) {

					$data['password'] = $this->db->escape_str(password_hash($this->input->post('password'), PASSWORD_DEFAULT),true);

				}else{

                    // We don't save an empty password
					unset($data['password']);
				}

				$this->db->where('id', $oneAdm->row()->id);
				$this->db->update('esurat_admin',$data);
				$this->toastr->success('Data Administrator '.$this->input->post('username').' Berhasil Di Update!');
				redirect('admin/dAdministrator');

			}

		}
	}

	public function dAdministratorDelete($id){

		$this->db->delete('esurat_admin',['id' => $this->encrypt->decode($id)]);
		$this->toastr->success('Data Administrator Telah Di Hapus!');
		redirect('admin/dAdministrator');

	}

	public function dDosen(){

		if (count($this->uri->segment_array()) > 2) {
			$this->toastr->error('Url Yang Anda Masukkan Salah');
			redirect('admin/dDosen');
		}

		$data['user'] = $this->db->get_where('esurat_admin',['username' => $this->session->userdata('username')])->row();

		$data['dosen'] = $this->admin_model->getDosen(); /*-- Load Semua Data Dosen --*/

		$data['title'] = "Admin | Data Dosen";
		$data['parent'] = "Data Dosen";
		$data['page'] = "Data Dosen";
		$this->template->load('admin/layout/adminTemplate','admin/modulDosen/adminDosen',$data);

	}

	public function dDosenAdd(){

		if (count($this->uri->segment_array()) > 2) {
			$this->toastr->error('Url Yang Anda Masukkan Salah');
			redirect('admin/dDosen');
		}

		$data['user'] = $this->db->get_where('esurat_admin',['username' => $this->session->userdata('username')])->row();

		$this->form_validation->set_rules('nama','Nama Dosen','required');
		$this->form_validation->set_rules('nip','NIP/NPU','trim|required|is_unique[esurat_dosen.nip]', [
			'is_unique' => 'This NIP/NPU Sudah Ada!'
		]);
		$this->form_validation->set_rules('jabatan','Jabatan','required');

		if($this->form_validation->run() == false){

			$data['title'] = "Admin | Data Dosen";
			$data['parent'] = "Data Dosen";
			$data['page'] = "Add Dosen";
			$this->template->load('admin/layout/adminTemplate','admin/modulDosen/adminDosenAdd',$data);

		}else{

			$data = [

				'nama' => $this->db->escape_str(ucwords($this->input->post('nama')),true),
				'nip' => $this->db->escape_str($this->input->post('nip'),true),
				'jabatan' => $this->db->escape_str($this->input->post('jabatan'),true)

			];

			$this->db->insert('esurat_dosen', $data);
			$this->toastr->success('Data Dosen '.$this->input->post('nama').' Telah Ditambahkan!');
			redirect('admin/dDosen');

		}
	}

	public function dDosenDetail($id = null){

		/*-- Encrypt URL Id --*/
		if (count($this->uri->segment_array()) > 3) {
			$this->toastr->error('Url Yang Anda Masukkan Salah');
			redirect('admin/dDosen');
		}
		if (!isset($id)) {
			$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai ID');
			redirect('admin/dDosen');
		}
		if (is_numeric($id)) {
			$this->toastr->error('Url Hanya Bisa Diakses Setelah Dienkripsi');
			redirect('admin/dDosen');
		}
		$oneDos = $this->db->get_where('esurat_dosen',['id' => $this->encrypt->decode($id)]);
		if($oneDos->num_rows() == null){
			$this->toastr->error('Url Yang Anda Masukkan Salah');
			redirect('admin/dDosen');
		} 
		/*-- /. Encrypt URL Id --*/

		$data['user'] = $this->db->get_where('esurat_admin',['username' => $this->session->userdata('username')])->row();

		$data['onedos'] = $this->admin_model->getOneDosen($this->encrypt->decode($id)); /*-- Load One Data Dosen --*/

		$data['title'] = "Admin | Data Dosen";
		$data['parent'] = "Data Dosen";
		$data['page'] = "Detail Dosen";
		$this->template->load('admin/layout/adminTemplate','admin/modulDosen/adminDosenDetail',$data);

	}


	public function dDosenEdit($id = null){

		/*-- Encrypt URL Id --*/
		if (count($this->uri->segment_array()) > 3) {
			$this->toastr->error('Url Yang Anda Masukkan Salah');
			redirect('admin/dDosen');
		}
		if (!isset($id)) {
			$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai ID');
			redirect('admin/dDosen');
		}
		if (is_numeric($id)) {
			$this->toastr->error('Url Hanya Bisa Diakses Setelah Dienkripsi');
			redirect('admin/dDosen');
		}
		$oneDos = $this->db->get_where('esurat_dosen',['id' => $this->encrypt->decode($id)]);
		if($oneDos->num_rows() == null){
			$this->toastr->error('Url Yang Anda Masukkan Salah');
			redirect('admin/dDosen');
		} 
		/*-- /. Encrypt URL Id --*/

		$data['user'] = $this->db->get_where('esurat_admin',['username' => $this->session->userdata('username')])->row();

		$data['onedos'] = $this->admin_model->getOneDosen($this->encrypt->decode($id)); /*-- Load One Data Dosen --*/
		$this->form_validation->set_rules('nama','Nama Dosen','required');
		$this->form_validation->set_rules('nip','NIP','trim|required|is_natural',[
			'is_natural' => 'NIP Hanya Berisi Angka!']);
		$this->form_validation->set_rules('jabatan','Jabatan','required');

		if($this->form_validation->run() == false){

			$data['title'] = "Admin | Data Dosen";
			$data['parent'] = "Data Dosen";
			$data['page'] = "Edit Dosen";
			$this->template->load('admin/layout/adminTemplate','admin/modulDosen/adminDosenEdit',$data);

		}else{

			$data = [

				'nama' => $this->db->escape_str(ucwords($this->input->post('nama')),true),
				'nip' => $this->db->escape_str($this->input->post('nip'),true),
				'jabatan' => $this->db->escape_str($this->input->post('jabatan'),true)

			];

			$this->db->where('id', $oneDos->row()->id);
			$this->db->update('esurat_dosen',$data);
			$this->toastr->success('Data Dosen '.$this->input->post('nama').' Berhasil Diudate!');
			redirect('admin/dDosen');

		}
	}


	public function dDosenDelete($id){

		$this->db->delete('esurat_dosen',['id' => $this->encrypt->decode($id)]);
		$this->toastr->success('Data Dosen Telah Di Hapus!');
		redirect('admin/dDosen');

	}


	public function dProdi(){

		if (count($this->uri->segment_array()) > 2) {
			$this->toastr->error('Url Yang Anda Masukkan Salah');
			redirect('admin/dProdi');
		}

		$data['user'] = $this->db->get_where('esurat_admin',['username' => $this->session->userdata('username')])->row();

		$data['prodi'] = $this->admin_model->getProdi(); /*-- Load Semua Data Prodi --*/

		$data['title'] = "Admin | Data Prodi";
		$data['parent'] = "Data Prodi";
		$data['page'] = "Data Prodi";
		$this->template->load('admin/layout/adminTemplate','admin/modulProdi/adminProdi',$data);

	}


	public function dProdiAdd(){

		if (count($this->uri->segment_array()) > 2) {
			$this->toastr->error('Url Yang Anda Masukkan Salah');
			redirect('admin/dProdi');
		}

		$data['user'] = $this->db->get_where('esurat_admin',['username' => $this->session->userdata('username')])->row();

		$this->form_validation->set_rules('kdpro','Kode Prodi','trim|required|is_unique[esurat_prodi.kdpro]',[
			'is_unique' => 'Kode Prodi Sudah Ada!'
		]);
		$this->form_validation->set_rules('nmpro','Nama Prodi','required|is_unique[esurat_prodi.prodi]',[
			'is_unique' => 'Nama Prodi Sudah Ada!'
		]);
		$this->form_validation->set_rules('jenpro','Jenjang Prodi','required');
		$this->form_validation->set_rules('kapro','Nama Kaprodi','required');
		$this->form_validation->set_rules('kdmkpro','Kode MK Prodi','trim|required|is_unique[esurat_prodi.kdmk]',[
			'is_unique' => 'Kode MK Prodi Sudah Ada!'
		]);

		if($this->form_validation->run() == false){

			$data['title'] = "Admin | Data Prodi";
			$data['parent'] = "Data Prodi";
			$data['page'] = "Add Prodi";
			$this->template->load('admin/layout/adminTemplate','admin/modulProdi/adminProdiAdd',$data);

		}else{

			$data = [

				'kdpro' => $this->db->escape_str(strtoupper($this->input->post('kdpro')),true),
				'prodi' => $this->db->escape_str(ucwords($this->input->post('nmpro')),true),
				'jen' => $this->db->escape_str(strtoupper($this->input->post('jenpro')),true),
				'kaprodi' => $this->db->escape_str(ucwords($this->input->post('kapro')),true),
				'kdmk' => $this->db->escape_str(strtoupper($this->input->post('kdmkpro')),true)

			];

			$this->db->insert('esurat_prodi',$data);
			$this->toastr->success('Data Prodi '.$this->input->post('nmpro').' Telah Ditambahkan!');
			redirect('admin/dProdi');
		}

	}

	public function dProdiDetail($kdpro = null){

		/*-- Encrypt URL Kdpro --*/
		if (count($this->uri->segment_array()) > 3) {
			$this->toastr->error('Url Yang Anda Masukkan Salah');
			redirect('admin/dProdi');
		}
		if (!isset($kdpro)) {
			$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai ID');
			redirect('admin/dProdi');
		}
		if (is_numeric($kdpro)) {
			$this->toastr->error('Url Hanya Bisa Diakses Setelah Dienkripsi');
			redirect('admin/dProdi');
		}
		$onePro = $this->db->get_where('esurat_prodi',['kdpro' => $this->encrypt->decode($kdpro)]);
		if($onePro->num_rows() == null){
			$this->toastr->error('Url Yang Anda Masukkan Salah');
			redirect('admin/dProdi');
		}
		/*-- /. Encrypt URL Kdpro --*/

		$data['user'] = $this->db->get_where('esurat_admin',['username' => $this->session->userdata('username')])->row();

		$data['onepro'] = $this->admin_model->getOneProdi($this->encrypt->decode($kdpro)); /*-- Load Semua Data Dosen --*/

		$data['title'] = "Admin | Data Prodi";
		$data['parent'] = "Data Prodi";
		$data['page'] = "Detail Prodi";
		$this->template->load('admin/layout/adminTemplate','admin/modulProdi/adminProdiDetail',$data);

	}

	public function dProdiEdit($kdpro){

		/*-- Encrypt URL Kdpro --*/
		if (count($this->uri->segment_array()) > 3) {
			$this->toastr->error('Url Yang Anda Masukkan Salah');
			redirect('admin/dProdi');
		}
		if (!isset($kdpro)) {
			$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai ID');
			redirect('admin/dProdi');
		}
		if (is_numeric($kdpro)) {
			$this->toastr->error('Url Hanya Bisa Diakses Setelah Dienkripsi');
			redirect('admin/dProdi');
		}
		$onePro = $this->db->get_where('esurat_prodi',['kdpro' => $this->encrypt->decode($kdpro)]);
		if($onePro->num_rows() == null){
			$this->toastr->error('Url Yang Anda Masukkan Salah');
			redirect('admin/dProdi');
		}
		/*-- /. Encrypt URL Kdpro --*/

		$data['user'] = $this->db->get_where('esurat_admin',['username' => $this->session->userdata('username')])->row();

		$data['onepro'] = $this->admin_model->getOneProdi($this->encrypt->decode($kdpro)); /*-- Load Semua Data Dosen --*/

		$this->form_validation->set_rules('kdpro','Kode Prodi','trim|required');
		$this->form_validation->set_rules('nmpro','Nama Prodi','required');
		$this->form_validation->set_rules('jenpro','Jenjang Prodi','required');
		$this->form_validation->set_rules('kapro','Nama Kaprodi','required');
		$this->form_validation->set_rules('kdmkpro','Kode MK Prodi','trim|required');

		if($this->form_validation->run() == false){

			$data['title'] = "Admin | Data Prodi";
			$data['parent'] = "Data Prodi";
			$data['page'] = "Edit Prodi";
			$this->template->load('admin/layout/adminTemplate','admin/modulProdi/adminProdiEdit',$data);

		}else{

			$data = [

				'kdpro' => $this->db->escape_str(strtoupper($this->input->post('kdpro')),true),
				'prodi' => $this->db->escape_str(ucwords($this->input->post('nmpro')),true),
				'jen' => $this->db->escape_str(strtoupper($this->input->post('jenpro')),true),
				'kaprodi' => $this->db->escape_str(ucwords($this->input->post('kapro')),true),
				'kdmk' => $this->db->escape_str(strtoupper($this->input->post('kdmkpro')),true)

			];

			$this->db->where('kdpro', $onePro->row()->kdpro);
			$this->db->update('esurat_prodi',$data);
			$this->toastr->success('Data Prodi '.$this->input->post('nmpro').' Berhasil Diudate!');
			redirect('admin/dProdi');

		}
	}


	public function dProdiDelete($kdpro){

		$this->db->delete('esurat_prodi',['kdpro' => $this->encrypt->decode($kdpro)]);
		$this->toastr->success('Data Prodi Telah Di Hapus!');
		redirect('admin/dProdi');

	}


	public function sListSurat(){

		if (count($this->uri->segment_array()) > 2) {
			$this->toastr->error('Url Yang Anda Masukkan Salah');
			redirect('admin/sListSurat');
		}

		$data['user'] = $this->db->get_where('esurat_admin',['username' => $this->session->userdata('username')])->row();

		$data['surat'] = $this->admin_model->getListSurat(); /*-- Load Semua Data List Surat --*/

		$data['title'] = "Admin | List Surat";
		$data['parent'] = "List Surat";
		$data['page'] = "List Surat";
		$this->template->load('admin/layout/adminTemplate','admin/modulListSurat/adminListSurat',$data);
	}

	public function sListSuratAdd(){

		if (count($this->uri->segment_array()) > 2) {
			$this->toastr->error('Url Yang Anda Masukkan Salah');
			redirect('admin/sListSurat');
		}

		$data['user'] = $this->db->get_where('esurat_admin',['username' => $this->session->userdata('username')])->row();

		$this->form_validation->set_rules('kodeSurat','Kode Surat','required|is_unique[esurat_surat.kd_surat]',[
			'is_unique' => 'Kode Surat yang Anda Masukkan Sudah di Gunakan'
		]);
		$this->form_validation->set_rules('namaSurat','Nama Surat','required');
		$this->form_validation->set_rules('kopSurat','Kops Kaprodi','required');
		$this->form_validation->set_rules('headerSurat','Header Surat','required');
		$this->form_validation->set_rules('isiSurat','Isi Surat','required');
		$this->form_validation->set_rules('footerSurat','Footer Surat','required');

		if($this->form_validation->run() == false){

			$data['title'] = "Admin | List Surat";
			$data['parent'] = "List Surat";
			$data['page'] = "Add Surat";
			$this->template->load('admin/layout/adminTemplate','admin/modulListSurat/adminListSuratAdd',$data);

		}else{

			$data = [

				'kd_surat' =>  $this->db->escape_str(strtoupper($this->input->post('kodeSurat')),true),
				'nm_surat' =>  $this->db->escape_str(ucwords($this->input->post('namaSurat')),true),
				'kop_surat' => $this->input->post('kopSurat'),
				'header_surat' => $this->input->post('headerSurat'),
				'isi_surat' => $this->input->post('isiSurat'),
				'footer_surat' => $this->input->post('footerSurat'),
				'access' => $this->db->escape_str($this->input->post('access'),true),

			];

			$this->db->insert('esurat_Surat',$data);
			$this->toastr->success('List Surat '.$this->input->post('namaSurat').' Telah Ditambahkan!');
			$id_surat = $this->db->insert_id();
			redirect('admin/sListSuratDetail/'.$this->encrypt->encode($id_surat).'');
		}
	}

	public function sListSuratDetail($id_surat = null){

		/*-- Encrypt URL Id_Surat --*/
		if (count($this->uri->segment_array()) > 3) {
			$this->toastr->error('Url Yang Anda Masukkan Salah');
			redirect('admin/sListSurat');
		}
		if (!isset($id_surat)) {
			$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai ID');
			redirect('admin/sListSurat');
		}
		if (is_numeric($id_surat)) {
			$this->toastr->error('Url Hanya Bisa Diakses Setelah Dienkripsi');
			redirect('admin/sListSurat');
		}
		$oneSur = $this->db->get_where('esurat_surat',['id_surat' => $this->encrypt->decode($id_surat)]);
		if($oneSur->num_rows() == null){
			$this->toastr->error('Url Yang Anda Masukkan Salah');
			redirect('admin/sListSurat');
		}
		/*-- /. Encrypt URL Id_Surat --*/

		$data['user'] = $this->db->get_where('esurat_admin',['username' => $this->session->userdata('username')])->row();

		/*-- Load One Data Surat --*/
		$data['onesur'] = $this->admin_model->getOneListSurat($this->encrypt->decode($id_surat)); 

		$data['title'] = "Admin | List Surat";
		$data['parent'] = "List Surat";
		$data['page'] = "Detail Surat";
		$this->template->load('admin/layout/adminTemplate','admin/modulListSurat/adminListSuratDetail',$data);

	}

	public function sListSuratEdit($id_surat = null){

		/*-- Encrypt URL Id_Surat --*/
		if (count($this->uri->segment_array()) > 3) {
			$this->toastr->error('Url Yang Anda Masukkan Salah');
			redirect('admin/sListSurat');
		}
		if (!isset($id_surat)) {
			$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai ID');
			redirect('admin/sListSurat');
		}
		if (is_numeric($id_surat)) {
			$this->toastr->error('Url Hanya Bisa Diakses Setelah Dienkripsi');
			redirect('admin/sListSurat');
		}
		$oneSur = $this->db->get_where('esurat_surat',['id_surat' => $this->encrypt->decode($id_surat)]);
		if($oneSur->num_rows() == null){
			$this->toastr->error('Url Yang Anda Masukkan Salah');
			redirect('admin/sListSurat');
		}
		/*-- /. Encrypt URL Id_Surat --*/

		$data['user'] = $this->db->get_where('esurat_admin',['username' => $this->session->userdata('username')])->row();

		/*-- Load One Data Surat --*/
		$data['onesur'] = $this->admin_model->getOneListSurat($this->encrypt->decode($id_surat)); 


		$this->form_validation->set_rules('kodeSurat','Kode Surat','required');
		$this->form_validation->set_rules('namaSurat','Nama Surat','required');
		$this->form_validation->set_rules('kopSurat','Kops Kaprodi','required');
		$this->form_validation->set_rules('headerSurat','Header Surat','required');
		$this->form_validation->set_rules('isiSurat','Isi Surat','required');
		$this->form_validation->set_rules('footerSurat','Footer Surat','required');

		if($this->form_validation->run() == false){

			$data['title'] = "Admin | List Surat";
			$data['parent'] = "List Surat";
			$data['page'] = "Edit Surat";
			$this->template->load('admin/layout/adminTemplate','admin/modulListSurat/adminListSuratEdit',$data);

		}else{

			$data = [

				'kd_surat' => $this->db->escape_str($this->input->post('kodeSurat'),true),
				'nm_surat' => $this->db->escape_str($this->input->post('namaSurat'),true),
				'kop_surat' => $this->input->post('kopSurat'),
				'header_surat' => $this->input->post('headerSurat'),
				'isi_surat' => $this->input->post('isiSurat'),
				'footer_surat' => $this->input->post('footerSurat'),
				'access' => $this->db->escape_str($this->input->post('access'),true)

			];

			$this->db->where('id_surat', $oneSur->row()->id_surat);
			$this->db->update('esurat_surat',$data);
			$this->toastr->success('Data Prodi '.$this->input->post('namaSurat').' Berhasil Diudate!');
			redirect('admin/sListSurat');
		}
	}

	public function sListSuratDelete($id_surat){

		$this->db->delete('esurat_surat',['id_surat' => $this->encrypt->decode($id_surat)]);
		$this->toastr->success('Data Surat Telah Di Hapus!');
		redirect('admin/sListSurat');

	}

	public function sListSuratPrint($id_surat = null){

		/*-- Encrypt URL Id_Surat --*/
		if (count($this->uri->segment_array()) > 3) {
			$this->toastr->error('Url Yang Anda Masukkan Salah');
			redirect('admin/sListSurat');
		}
		if (!isset($id_surat)) {
			$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai ID');
			redirect('admin/sListSurat');
		}
		if (is_numeric($id_surat)) {
			$this->toastr->error('Url Hanya Bisa Diakses Setelah Dienkripsi');
			redirect('admin/sListSurat');
		}
		$oneSur = $this->db->get_where('esurat_surat',['id_surat' => $this->encrypt->decode($id_surat)]);
		if($oneSur->num_rows() == null){
			$this->toastr->error('Url Yang Anda Masukkan Salah');
			redirect('admin/sListSurat');
		}
		/*-- /. Encrypt URL Id_Surat --*/

		$data['onesur'] = $this->admin_model->getOneListSurat($this->encrypt->decode($id_surat));

		$this->load->view('admin/modulListSurat/adminListSuratPrint', $data);
		
	}

	public function sPermintaanSurat(){

		if (count($this->uri->segment_array()) > 2) {
			$this->toastr->error('Url Yang Anda Masukkan Salah');
			redirect('admin/sPermintaanSurat');
		}

		$data['user'] = $this->db->get_where('esurat_admin',['username' => $this->session->userdata('username')])->row();

		$data['surat'] = $this->admin_model->getListSurat(); /*-- Load Semua Data List Surat --*/

		$data['title'] = "Admin | Data Permintaan Surat";
		$data['parent'] = "Data Permintaan Surat";
		$data['page'] = "Data Permintaan Surat";
		$this->template->load('admin/layout/adminTemplate','admin/modulPermintaanSurat/adminPermintaanSurat',$data);

	}

	public function sSuratSelesai(){

		if (count($this->uri->segment_array()) > 2) {
			$this->toastr->error('Url Yang Anda Masukkan Salah');
			redirect('admin/sSuratSelesai');
		}

		$data['user'] = $this->db->get_where('esurat_admin',['username' => $this->session->userdata('username')])->row();

		$data['title'] = "Admin | Data Surat Selesai";
		$data['parent'] = "Data Surat Selesai";
		$data['page'] = "Data Surat Selesai";
		$this->template->load('admin/layout/adminTemplate','admin/modulSuratSelesai/adminSuratSelesai',$data);

	}


	public function sValidasiSurat(){

		if (count($this->uri->segment_array()) > 2) {
			$this->toastr->error('Url Yang Anda Masukkan Salah');
			redirect('admin/sValidasiSurat');
		}

		$data['user'] = $this->db->get_where('esurat_admin',['username' => $this->session->userdata('username')])->row();

		$data['title'] = "Admin | Validasi Surat";
		$data['parent'] = "Validasi Surat";
		$data['page'] = "Validasi Surat";
		$this->template->load('admin/layout/adminTemplate','admin/modulValidasiSurat/adminValidasiSurat',$data);
	}


	public function laporan(){
		if (count($this->uri->segment_array()) > 2) {
			$this->toastr->error('Url Yang Anda Masukkan Salah');
			redirect('admin/laporan');
		}

		$data['user'] = $this->db->get_where('esurat_admin',['username' => $this->session->userdata('username')])->row();
		$data['nimlaporan'] = $this->admin_model->getMhs(); 
		$this->form_validation->set_rules('status', 'Pilih Status Surat','required');
		$this->form_validation->set_rules('permintaan_by', 'Pilih Status Surat','trim');
		$this->form_validation->set_rules('awalPeriode', 'Awal Periode','required');
		$this->form_validation->set_rules('akhirPeriode', 'Akhir Periode','required');

		if($this->form_validation->run() == false){
			$data['title'] = "Admin | Laporan Surat";
			$data['parent'] = "Laporan Data Surat";			
			$data['page'] = "Laporan Data Surat";
			$this->output->set_header('HTTP/1.0 200 OK');
			$this->output->set_header('HTTP/1.1 200 OK');
			$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
			$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
			$this->output->set_header('Cache-Control: post-check=0, pre-check=0');
			$this->output->set_header('Pragma: no-cache');
			$this->template->load('admin/layout/adminTemplate','admin/modulLaporan/adminLaporan',$data);

		}else{

			$status = $this->input->post('status');
			$nim = $this->input->post('permintaan_by');
			$awal = $this->input->post('awalPeriode');
			// $awal = '2020-08-01 02:10:28';
			// $akhir = '2020-12-01 02:10:28';
			$akhir = $this->input->post('akhirPeriode');

			if($status == 'PENDING'){
				$tabel = 'esurat_permintaan';
				$nametab = 'Permintaan Surat';
				$orderby = 'id_permintaan';
			}else{
				$tabel = 'esurat_konfirmasi';
				$nametab = 'Permintaan Surat';
				$orderby = 'id_konfirmasi';
			};

			if($nim == NULL){
				$query = "SELECT * FROM $tabel WHERE permintaan_tgl BETWEEN CAST('$awal' AS DATETIME) AND CAST('$akhir' AS DATETIME) ORDER BY $orderby DESC";
			}else{
				$query = "SELECT * FROM $tabel WHERE permintaan_tgl BETWEEN CAST('$awal' AS DATETIME) AND CAST('$akhir' AS DATETIME) AND permintaan_by = $nim ORDER BY $orderby DESC";
			}

			$data['hasil'] = $this->db->query($query)->result();
			$data['title'] = "Admin | Laporan Surat";
			$data['parent'] = "Laporan Data Surat";		
			$data['page'] = "Laporan Data Surat";
			$this->template->load('admin/layout/adminTemplate','admin/modulLaporan/adminLaporan',$data);

		}
	}

	public function nMenu(){

		if (count($this->uri->segment_array()) > 2) {
			$this->toastr->error('Url Yang Anda Masukkan Salah');
			redirect('admin/nMenu');
		}

		$data['user'] = $this->db->get_where('esurat_admin',['username' => $this->session->userdata('username')])->row();
		$data['allrole'] = $this->admin_model->getAllRole();
		$data['allmenu'] = $this->admin_model->getAllMenu();

		$data['title'] = "Admin | Menu";
		$data['parent'] = "Navigation";
		$data['page'] = "Menu ";
		$this->template->load('admin/layout/adminTemplate','admin/modulMenu/adminMenu',$data);


	}

	public function nMenuAdd(){

		$data['user'] = $this->db->get_where('esurat_admin',['username' => $this->session->userdata('username')])->row();
		$data['allrole'] = $this->admin_model->getAllRole();

		$this->form_validation->set_rules('menuTitleAdd','Nama Menu','required');
		$this->form_validation->set_rules('menuForAdd','Menu Untuk','required');
		$this->form_validation->set_rules('menuUrlAdd','Url Menu','required');
		$this->form_validation->set_rules('menuIconAdd','Icon Menu','required');

		if($this->form_validation->run() == false){

			$data['title'] = "Admin | Menu";
			$data['parent'] = "Menu";
			$data['page'] = "Menu Add";
			$this->template->load('admin/layout/adminTemplate','admin/modulMenu/adminMenuAdd',$data);

		}else{

			$data = [

				'role_id' => $this->db->escape_str($this->input->post('menuForAdd'),true),
				'title' => $this->db->escape_str($this->input->post('menuTitleAdd'),true),
				'url' => $this->db->escape_str($this->input->post('menuUrlAdd'),true),
				'icon' => $this->db->escape_str($this->input->post('menuIconAdd'),true),
				'is_main_menu' => $this->db->escape_str($this->input->post('menuTreeAdd'),true),
				'is_active' => $this->db->escape_str($this->input->post('menuActiveAdd'),true)

			];

			$this->db->insert('esurat_menu',$data);
			$this->toastr->success('Menu '.$this->input->post('menuTitleAdd').' Telah Ditambahkan!');
			redirect('admin/nMenu');

		}

	}


	public function nMenuDetail($id_menu = null){

		/*-- Encrypt URL Id_Surat --*/
		if (count($this->uri->segment_array()) > 3) {
			$this->toastr->error('Url Yang Anda Masukkan Salah');
			redirect('admin/nMenu');
		}
		if (!isset($id_menu)) {
			$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai ID');
			redirect('admin/nMenu');
		}
		if (is_numeric($id_menu)) {
			$this->toastr->error('Url Hanya Bisa Diakses Setelah Dienkripsi');
			redirect('admin/nMenu');
		}
		$oneMenu = $this->db->get_where('esurat_menu',['id_menu' => $this->encrypt->decode($id_menu)]);
		if($oneMenu->num_rows() == null){
			$this->toastr->error('Url Yang Anda Masukkan Salah');
			redirect('admin/nMenu');
		}
		/*-- /. Encrypt URL Id_Surat --*/

		$data['user'] = $this->db->get_where('esurat_admin',['username' => $this->session->userdata('username')])->row();

		$data['onemenu'] = $this->admin_model->getOneMenu($this->encrypt->decode($id_menu));
		$data['allrole'] = $this->admin_model->getAllRole();
		$data['allmenu'] = $this->admin_model->getAllMenu();

		$data['title'] = "Admin | Menu";
		$data['parent'] = "Menu";
		$data['page'] = "Menu Detail";
		$this->template->load('admin/layout/adminTemplate','admin/modulMenu/adminMenuDetail',$data);

	}

	public function nMenuEdit($id_menu = null){

		/*-- Encrypt URL Id_Surat --*/
		if (count($this->uri->segment_array()) > 3) {
			$this->toastr->error('Url Yang Anda Masukkan Salah');
			redirect('admin/nMenu');
		}
		if (!isset($id_menu)) {
			$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai ID');
			redirect('admin/nMenu');
		}
		if (is_numeric($id_menu)) {
			$this->toastr->error('Url Hanya Bisa Diakses Setelah Dienkripsi');
			redirect('admin/nMenu');
		}
		$oneMenu = $this->db->get_where('esurat_menu',['id_menu' => $this->encrypt->decode($id_menu)]);
		if($oneMenu->num_rows() == null){
			$this->toastr->error('Url Yang Anda Masukkan Salah');
			redirect('admin/nMenu');
		}
		/*-- /. Encrypt URL Id_Surat --*/

		$data['user'] = $this->db->get_where('esurat_admin',['username' => $this->session->userdata('username')])->row();

		/*-- Load One Data Surat --*/
		$data['onemenu'] = $this->admin_model->getOneMenu($this->encrypt->decode($id_menu));
		$data['allrole'] = $this->admin_model->getAllRole();
		$data['allmenu'] = $this->admin_model->getAllMenu();

		$this->form_validation->set_rules('menuTitleEdit','Nama Menu','required');
		$this->form_validation->set_rules('menuForEdit','Menu Untuk','required');
		$this->form_validation->set_rules('menuUrlEdit','Url Menu','required');
		$this->form_validation->set_rules('menuIconEdit','Icon Menu','required');

		if($this->form_validation->run() == false){

			$data['title'] = "Admin | Menu";
			$data['parent'] = "Menu";
			$data['page'] = "Menu Edit";
			$this->template->load('admin/layout/adminTemplate','admin/modulMenu/adminMenuEdit',$data);

		}else{

			$data = [

				'role_id' => $this->db->escape_str($this->input->post('menuForEdit'),true),
				'title' => $this->db->escape_str($this->input->post('menuTitleEdit'),true),
				'url' => $this->db->escape_str($this->input->post('menuUrlEdit'),true),
				'icon' => $this->db->escape_str($this->input->post('menuIconEdit'),true),
				'is_main_menu' => $this->db->escape_str($this->input->post('menuTreeEdit'),true),
				'is_active' => $this->db->escape_str($this->input->post('menuActiveEdit'),true)

			];

			$this->db->where('id_menu', $oneMenu->row()->id_menu);
			$this->db->update('esurat_menu',$data);
			$this->toastr->success('Menu '.$this->input->post('menuTitleAdd').' Berhasil Diudate!');
			redirect('admin/nMenu');
		}
	}

	public function nMenuDelete($id_menu){

		$this->db->delete('esurat_menu',['id_menu' => $this->encrypt->decode($id_menu)]);
		$this->toastr->success(' Menu Deleted!');
		redirect('admin/nMenu');
	}


	public function nRole(){

		$data['user'] = $this->db->get_where('esurat_admin',['username' => $this->session->userdata('username')])->row();
		$data['allrole'] = $this->admin_model->getAllRole();


		$data['title'] = "Admin | Role";
		$data['parent'] = "Navigation";
		$data['page'] = "Role ";
		$this->template->load('admin/layout/adminTemplate','admin/modulRole/adminRole',$data);


	}

}