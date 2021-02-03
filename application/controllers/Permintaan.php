<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Permintaan extends CI_Controller {

	public function __construct(){

		parent::__construct();


		/*-- untuk mengatasi error confirm form resubmission  --*/
		header('Cache-Control: no-cache, must-revalidate, max-age=0');
		header('Cache-Control: post-check=0, pre-check=0',false);
		header('Pragma: no-cache');
		$this->load->model('admin_model');
		$this->load->model('mahasiswa_model');
		$this->load->model('permintaan_model');

	}

	public function permintaanDetail($kd_surat = null, $id = null , $name = null){

		/*-- Search KodeSurat di table esurat_surat & id_permintaan di table esurat_permintaan --*/
		$searchKode = $this->db->get_where('esurat_surat',['kd_surat' => $this->encrypt->decode($kd_surat)]);

		if($this->session->userdata('username') == TRUE){

			/*----------------------- Encrypt kd_surat,id,$name -----------------------*/
			if (count($this->uri->segment_array()) > 5 ) {
				$this->toastr->error('Url Yang Anda Masukkan Salah');
				redirect('Admin/sPermintaanSurat');
			}
			if (!isset($kd_surat) || !isset($id) || !isset($name)) {
				$this->toastr->error('Url Yang Anda Masukkan Salah');
				redirect('Admin/sPermintaanSurat');
			}
			if (is_numeric($kd_surat) || is_numeric($id) || is_numeric($name)) {
				$this->toastr->error('Url Hanya Bisa Diakses Setelah Dienkripsi');
				redirect('Admin/sPermintaanSurat');
			}
			if($searchKode->num_rows() == NULL){
				$this->toastr->error('Kode Surat Not Found!');
				redirect('admin/sPermintaanSurat');
			}
			if(!is_numeric($this->encrypt->decode($id))){
				$this->toastr->error('Url Yang Anda Masukkan Tidak Memmpunyai ID');
				redirect('admin/sPermintaanSurat');
			}

			if(!in_array($this->encrypt->decode($name), ['permohonan','permintaan','pengajuan'], true ) ) {
				$this->toastr->error('Url Yang Anda Masukkan Salah');
				redirect('admin/sPermintaanSurat');
			}
			/*----------------------- /. Encrypt kd_surat,id,$name -----------------------*/

			$data['user'] = $this->db->get_where('esurat_admin',['username' => $this->session->userdata('username')])->row();

		}else{

			/*----------------------- Encrypt kd_surat,id,$name -----------------------*/
			if (count($this->uri->segment_array()) > 5) {
				$this->toastr->error('Url Yang Anda Masukkan Salah');
				redirect('mahasiswa/pengajuanSurat');
			}
			if (!isset($kd_surat) || !isset($id) || !isset($name)) {
				$this->toastr->error('Url Yang Anda Masukkan Salah');
				redirect('mahasiswa/pengajuanSurat');
			}
			if (is_numeric($kd_surat)||is_numeric($id) || is_numeric($name)) {
				$this->toastr->error('Url Hanya Bisa Diakses Setelah Dienkripsi');
				redirect('mahasiswa/pengajuanSurat');
			}
			if($searchKode->num_rows() == NULL){
				$this->toastr->error('Kode Surat Not Found!');
				redirect('mahasiswa/pengajuanSurat');
			}
			if(!is_numeric($this->encrypt->decode($id))){
				$this->toastr->error('Url Yang Anda Masukkan Tidak Memmpunyai ID');
				redirect('mahasiswa/pengajuanSurat');
			}
			
			if(!in_array($this->encrypt->decode($name), ['permohonan','permintaan','pengajuan'], true ) ) {
				$this->toastr->error('Url Yang Anda Masukkan Salah');
				redirect('mahasiswa/pengajuanSurat');
			}
			/*----------------------- /. Encrypt kd_surat,id,$name -----------------------*/


			$data['user'] = $this->db->get_where('esurat_mhs',['nim' => $this->session->userdata('nim')])->row();

			$pengajuan = "SELECT COUNT(permintaan_by) as permintaan FROM esurat_permintaan WHERE permintaan_by = '".$this->session->userdata('nim')."'";
			$status = "SELECT * FROM esurat_mhs WHERE nim = '".$this->session->userdata('nim')."' ";
			$resultp = $this->db->query($pengajuan)->row()->permintaan;
			$results = $this->db->query($status)->row();

			/*------ Jika Status Mahasiswa Sudah Keluar Maka tidak bisa mengajukan surat lagi ------*/
			if($results->status == 'Keluar' || $results->status == 'Non Aktif'){
				$this->toastr->error('Status Kemahasiswaan Anda Telah '.$results->status.'');
				redirect('mahasiswa/pengajuanSurat');
			}

			/*------ Jika Mahasiswa Sudah Mengajukan 2 Surat yang belum dikonfirmasi maka tidak bisa mengajukan lagi ------*/
			if($resultp == '2'){
				$this->toastr->error('Anda Telah Masih memiliki 2 surat yang masih menunggu persetujuan silahkan hubungi admin terlebih untuk dikonfirmasi');
				redirect('mahasiswa/pengajuanSurat');
			}

		}

		/*-- Mendecode $id_selesai & $kd_surat --*/	
		$id = $this->encrypt->decode($id);
		$kd_surat = $this->encrypt->decode($kd_surat);
		$name = $this->encrypt->decode($name);

		/*------ Data-Data Komponen Surat ------*/
		if($name == 'permohonan'){	/*-- Ketika Admin Membuat Surat Secara langsung --*/

			$query = "SELECT * FROM esurat_surat WHERE id_surat = '".$id."'";

		}elseif($name == 'pengajuan'){	/*-- Ketika Mahasiswa Mengajukan Surat --*/

			$query = "SELECT * FROM esurat_surat WHERE id_surat = '".$id."'";

		}elseif($name == 'permintaan'){	/*-- Ketika Admin Mengkonfirmasi Surat Yang Di Ajukan Oleh Mahasiswa --*/

			$query = "SELECT * FROM esurat_permintaan WHERE id_permintaan = '".$id."'";

		}


		$result = $this->db->query($query)->row();

		/*-- Load One Data Surat untuk View --*/
		$data['onesur'] = $result;
		/*------ /. Data-Data Komponen Surat ------*/


		if($name == 'permohonan'){

			/*------------------------------------------------------------------------*/
			/*-- Code Di bawah Untuk Permintaan Surat Yang Di Ajukan Admin Langsung --*/
			/*------------------------------------------------------------------------*/

			if( $result->kd_surat == $kd_surat && $result->id_surat == $id){

				switch ($searchKode->row()->kd_surat) {

					case 'SP-KP':

					/*-- Load Semua Data Dosen Pada Input --*/
					$data['dosenall'] = $this->admin_model->getDosen();
					$data['mahasiswaall'] = $this->db->query("SELECT * FROM esurat_mhs")->result();
					/*-- Load Semua Data Dosen Pada Input --*/

					$this->form_validation->set_rules('no_surat', 'No Surat','trim|required|is_unique[esurat_konfirmasi.no_surat]',[
						'is_unique' => 'Nomer Surat Tersebut Telah Dipakai Silahkan Tekan Tombol Generate lagi Untuk Meregerate No Surat Baru']);
					$this->form_validation->set_rules('dosen', 'Dosen Pengampu','required');
					$this->form_validation->set_rules('ttd', 'Tanda Tangan','required');
					$this->form_validation->set_rules('cosnim', 'Data Mahasiswa','required');
					$this->form_validation->set_rules('kepadaYth', 'Kepada Surat di Tujukan','required');
					$this->form_validation->set_rules('keperluan', 'Keperluan Surat ini di Ajukan','required');

					if($this->form_validation->run() == false){

						$data['name'] = $name;
						$data['title'] = " Admin | Data Surat";
						$data['parent'] = "Permohonan Surat";
						$data['page'] = $searchKode->row()->nm_surat;
						$this->template->load('admin/layout/adminTemplate','surat/permintaan/permintaan_SP-KP',$data);

					}else{

						$jsonSPKP = '{"permintaan_by":"'.$this->db->escape_str($this->input->post('cosnim'),true).'","kepadaYth":"'.$this->db->escape_str($this->input->post('kepadaYth'),true).'","kepadaAlamat":"'.$this->db->escape_str($this->input->post('kepadaAlamat'),true).'","permintaan_prodi":"'.$this->db->escape_str($this->admin_model->getOneMhs($this->input->post('cosnim'))->kdpro,true).'","dosen":"'.$this->db->escape_str($this->input->post('dosen'),true).'"}';

						$jsonSPKPEnkripsi = '{"p":"'.$this->db->escape_str($this->input->post('p'),true).'","q":"'.$this->db->escape_str($this->input->post('q'),true).'","n":"'.$this->db->escape_str($this->input->post('n'),true).'","e":"'.$this->db->escape_str($this->input->post('e'),true).'","d":"'.$this->db->escape_str($this->input->post('d'),true).'","enkripsi":"'.$this->db->escape_str($this->input->post('enkripsi'),true).'"}';

						$data = [

							'no_surat' => $this->db->escape_str($this->input->post('no_surat'),true),
							'kd_surat' => $this->db->escape_str($this->input->post('kodeSurat'),true),
							'nm_surat' => $this->db->escape_str($this->input->post('namaSurat'),true),
							'isi_surat' => $this->input->post('semua'),
							'permintaan_by' => $this->db->escape_str($this->input->post('cosnim'),true),
							'data_permintaan' => $jsonSPKP,
							'permintaan_tgl' => $this->db->escape_str(date('Y-m-d H:i:s'),true),
							'status_surat' => $this->db->escape_str('CONFIRM',true),
							'keperluan' => $this->db->escape_str($this->input->post('keperluan'),true),
							'penyetuju_by' => $this->db->escape_str($this->session->userdata('username'),true),
							'ttd' => $this->db->escape_str($this->input->post('ttd'),true),
							'disetujui_tgl' => $this->db->escape_str(date('Y-m-d'),true),
							'enkripsi' => $jsonSPKPEnkripsi

						];

						$this->db->insert('esurat_konfirmasi',$data);
						$this->toastr->success('Surat '.$searchKode->row()->nm_surat.' Berhasil diajukan');
						redirect('admin/sPermintaanSurat');
					}

					break;
					
					default:
						# code...
					break;
				}



			}else{

				if($this->session->userdata('username') == TRUE){
					$this->toastr->error('Url Yang Anda Masukkan SalahAAAA');
					redirect('admin/sPermintaanSurat');

				}else{
					$this->toastr->error('Url Yang Anda Masukkan Salah');
					redirect('mahasiswa/pengajuanSurat');

				}
			}

		}elseif($name == 'pengajuan'){

			/*-------------------------------------------------------------------*/
			/*-- Code Di bawah Untuk Permintaan Surat Yang Di Ajukan Mahasiswa --*/
			/*-------------------------------------------------------------------*/

			if($result->kd_surat == $kd_surat && $result->id_surat == $id){

				switch ($searchKode->row()->kd_surat) {

					case 'SP-KP':

					/*-- Load Semua Data Dosen Pada Input --*/
					$mhs =  $this->db->get_where('esurat_mhs',['nim' => $this->session->userdata('nim')])->row();
					$data['onepro'] = $this->admin_model->getOneProdi($mhs->kdpro);
					$data['dosenall'] = $this->admin_model->getDosen();

					$this->form_validation->set_rules('kepadaYth', 'Kepada Surat Ini Ditujukan','required');
					$this->form_validation->set_rules('kepadaAlamat', 'Alamat Surat Ini Ditujukan','required');
					$this->form_validation->set_rules('keperluan', 'Keperluan Surat Ini Dibuat','required');
					$this->form_validation->set_rules('dosen', 'Dosen Pengampu','required');

					if($this->form_validation->run() == false){

						$data['name'] = $name;
						$data['title'] =  "Mahasiswa| Pengajuan Surat";
						$data['parent'] = "Pengajuan Surat";
						$data['page'] = $searchKode->row()->nm_surat;
						$this->template->load('mahasiswa/layout/mahasiswaTemplate','surat/permintaan/permintaan_SP-KP',$data);

					}else{

						$jsonSPKP = '{"permintaan_by":"'.$this->db->escape_str($this->input->post('cosnim'),true).'","kepadaYth":"'.$this->db->escape_str($this->input->post('kepadaYth'),true).'","kepadaAlamat":"'.$this->db->escape_str($this->input->post('kepadaAlamat'),true).'","permintaan_prodi":"'.$this->db->escape_str($this->input->post('kdpro'),true).'","dosen":"'.$this->db->escape_str($this->input->post('dosen'),true).'"}';

						$data = [

							'kd_surat' => $this->db->escape_str($this->input->post('kodeSurat'),true),
							'nm_surat' => $this->db->escape_str($this->input->post('namaSurat'),true),
							'isi_surat' => $this->input->post('semua'),
							'permintaan_by' => $this->db->escape_str($this->input->post('nim'),true),
							'data_permintaan' => $jsonSPKP,
							'permintaan_tgl' => $this->db->escape_str(date('Y-m-d H:i:s'),true),
							'status_surat' => $this->db->escape_str('PENDING',true),
							'keperluan' => $this->input->post('keperluan')

						];

						$this->db->insert('esurat_permintaan',$data);
						$this->toastr->success('Surat '.$searchKode->row()->nm_surat.' Berhasil diajukan');
						redirect('mahasiswa/pengajuanSurat');

					}
					break;

					default:
						# code...
					break;
				}

			}else{

				if($this->session->userdata('username') == TRUE){
					$this->toastr->error('Url Yang Anda Masukkan Salah');
					redirect('admin/sPermintaanSurat');

				}else{
					$this->toastr->error('Url Yang Anda Masukkan Salah');
					redirect('mahasiswa/pengajuanSurat');

				}
			}

		}elseif($name == 'permintaan'){

			/*------------------------------------------------------------------------------------*/
			/*-- Code Di bawah Untuk Konfirmasi Permintaan Surat Yang telah di Ajukan Mahasiswa --*/
			/*------------------------------------------------------------------------------------*/

			if( $result->kd_surat == $kd_surat && $result->id_permintaan == $id){

				switch ($searchKode->row()->kd_surat) {

					case 'SP-KP':

					/*-- Load One Data Permintaan Pada Input --*/
					$data['onepmr'] = $this->db->query("SELECT *, data_permintaan->>'$.kepadaYth' as kepadaYth, data_permintaan->>'$.kepadaAlamat' as kepadaAlamat, enkripsi->>'$.enkripsi' as enkripsi FROM esurat_permintaan WHERE id_permintaan = '$id'")->row();
					/*-- Load One Data Dosen Pada Input --*/
					$data['onedos'] = $this->admin_model->getOneDosen($this->db->query("SELECT data_permintaan->>'$.dosen' as dosen FROM esurat_permintaan WHERE id_permintaan = '$id'")->row()->dosen);
					/*-- Load One Data Mahasiswa Pada Input --*/
					$data['onemhs'] = $this->admin_model->getOneMhs($this->admin_model->getOnePmr($id)->permintaan_by);
					/*-- Load One Data Prodi Pada Input --*/
					$data['onepro'] = $this->admin_model->getOneProdi($this->db->query("SELECT data_permintaan->>'$.permintaan_prodi' as permintaan_prodi FROM esurat_permintaan WHERE id_permintaan = '$id'")->row()->permintaan_prodi);

					/*-- Load One Data Permintaan Pada Hasil Surat --*/
					$permintaan = $this->db->query("SELECT *, data_permintaan->>'$.kepadaYth' as kepadaYth, data_permintaan->>'$.kepadaAlamat' as kepadaAlamat, enkripsi->>'$.enkripsi' as enkripsi FROM esurat_permintaan WHERE id_permintaan = '$id'")->row();
					/*-- Load One Data Mahasiswa Pada Hasil Surat --*/
					$mahasiswa = $this->admin_model->getOneMhs($this->admin_model->getOnePmr($id)->permintaan_by);
					/*-- Load One Data Dosen Pada Hasil Surat --*/
					$dosen = $this->admin_model->getOneDosen($this->db->query("SELECT data_permintaan->>'$.dosen' as dosen FROM esurat_permintaan WHERE id_permintaan = '$id'")->row()->dosen);
					/*-- Load One Data Prodi Pada Hasil Surat --*/
					$prodi = $this->admin_model->getOneProdi($this->db->query("SELECT data_permintaan->>'$.permintaan_prodi' as permintaan_prodi FROM esurat_permintaan WHERE id_permintaan = '$id'")->row()->permintaan_prodi);

					/*-- Load Semua Data Dosen Pada Input --*/
					$data['dosenall'] = $this->admin_model->getDosen();

					$this->form_validation->set_rules('no_surat', 'No Surat','trim|required|is_unique[esurat_konfirmasi.no_surat]',[
						'is_unique' =>'Nomer Surat Tersebut Telah Dipakai Silahkan Tekan Tombol Generate lagi Untuk Meregerate No Surat Baru']);
					$this->form_validation->set_rules('ttd', 'Tanda Tangan','required');

					if($this->form_validation->run() == false){

						$komponenSurat = [

							'bulan' => bulan_romawi(date('Y-m-d')),
							'tahun' => date('Y'),
							'kepadaYth' => $permintaan->kepadaYth,
							'kepadaAlamat' => $permintaan->kepadaAlamat,
							'nama_mhs' => $mahasiswa->nmmhs,
							'nim_mhs' => $mahasiswa->nim,
							'angkatan_mhs' => semester($mahasiswa->thaka),
							'prodi_mhs' => $prodi->prodi,
							'dosen' => $dosen->nama,
							'dosen_jabatan' => $dosen->jabatan

						];

						$data['isi'] = $this->admin_model->getOnePmr($id)->isi_surat;
						$data['komponen'] = $komponenSurat;

						$data['name'] = $name;
						$data['title'] = " Admin | Data Surat";
						$data['parent'] = "Permintaan Surat";
						$data['page'] = $searchKode->row()->kd_surat;
						$this->template->load('admin/layout/adminTemplate','surat/permintaan/permintaan_SP-KP',$data);

					}else{

						$data = [

							'penyetuju_by' => $this->db->escape_str($this->session->userdata('username'),true),
							'no_surat' => $this->db->escape_str($this->input->post('no_surat'),true),
							'status_surat' => $this->db->escape_str('CONFIRM',true),
							'ttd' => $this->db->escape_str($this->input->post('ttd'),true),
							'disetujui_tgl' => $this->db->escape_str(date('Y-m-d'),true)

						];

						$this->db->where('id_permintaan', $result->id_permintaan);
						$this->db->update('esurat_permintaan',$data);

						$nomor = $this->input->post('no_surat');

						$this->db->query("

							INSERT INTO esurat_konfirmasi (
							no_surat, 
							kd_surat, 
							nm_surat, 
							isi_surat,
							permintaan_tgl, 
							keperluan, 
							permintaan_by,
							data_permintaan,
							status_surat,
							penyetuju_by,
							ttd,
							disetujui_tgl,
							enkripsi)  
							SELECT 						
							no_surat, 
							kd_surat, 
							nm_surat, 
							isi_surat,
							permintaan_tgl, 
							keperluan, 
							permintaan_by,
							data_permintaan,
							status_surat,
							penyetuju_by,
							ttd,
							disetujui_tgl,
							enkripsi from esurat_permintaan where no_surat = '$nomor'

							");

						$this->db->query("DELETE FROM esurat_permintaan where no_surat = '$nomor'");

						$notif = [

							'comment_subject' => 'Surat Di Konfirmasi',
							'comment_text' => 'Surat Yang Anda Ajukan Pada tanggal '.$result->permintaan_tgl.' Telah Disetujui',
							'comment_surat' => 'Y',
							'comment_to' => $result->permintaan_by,
							'comment_date' => $this->db->escape_str(date('Y-m-d'),true),
							'comment_status' => 0

						];

						$this->db->insert('esurat_comments',$notif);

						$this->toastr->success(' Surat Yang diajukan oleh '.$mahasiswa->nmmhs.' Telah di Konfirmasi!');
						redirect('admin/sPermintaanSurat');

					}

					break;

					default:
					# code...
					break;
				}

			}else{

				if($this->session->userdata('username') == TRUE){
					$this->toastr->error('Url Yang Anda Masukkan Salah');
					redirect('admin/sPermintaanSurat');

				}else{
					$this->toastr->error('Url Yang Anda Masukkan Salah');
					redirect('mahasiswa/pengajuanSurat');

				}
			}

		}else{

			if($this->session->userdata('username') == TRUE){
				$this->toastr->error('Url Yang Anda Masukkan SalahBBBB');
				redirect('admin/sPermintaanSurat');

			}else{
				$this->toastr->error('Url Yang Anda Masukkan Salah');
				redirect('mahasiswa/pengajuanSurat');

			}
		}
	}

	public function permintaanTolak(){

		$id=$this->input->post("idalasan");
		$alasan=$this->input->post("alasan");

		$data = array('success' => false,'messages' => array());
		$this->form_validation->set_rules('alasan','Alasan Penolakan','required');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

		$query = $this->db->get_where('esurat_permintaan',['id_permintaan' => $id])->row();

		if($this->form_validation->run()){


			$notif = [

				'comment_subject' => 'Surat Di Tolak',
				'comment_text' => 'Surat Yang Anda Ajukan Pada tanggal '.$query->permintaan_tgl.' Telah Disetujui',
				'comment_detail' => $alasan,
				'comment_surat' => 'N',
				'comment_to' => $query->permintaan_by,
				'comment_date' => $this->db->escape_str(date('Y-m-d'),true),
				'comment_status' => 0

			];

			$this->db->insert('esurat_comments',$notif);
			$this->db->delete('esurat_permintaan',['id_permintaan' => $id]);
			$data['toastr'] = $this->toastr->success('Surat Telah Ditolak');
			$data['redirect'] = base_url('admin/sPermintaanSurat');
			$data['url'] = true;



			$data['success'] = true;

		}else{

			foreach ($_POST as $key => $value) {
				$data['messages'][$key] = form_error($key);
			}
		}
		echo json_encode($data);

	}

	public function fetchNIMWithNama(){

		$nim = $this->input->post('nimCos');
		$data['nama']=  $this->permintaan_model->fetchNIMWithNama($nim)->nmmhs;
		$data['prodi'] = $this->admin_model->getOneProdi($this->permintaan_model->fetchNIMWithNama($nim)->kdpro)->prodi;
		$data['semester'] = semester($this->permintaan_model->fetchNIMWithNama($nim)->thaka);

		echo json_encode($data);
	}

	public function getNoSuratPmr() {

		$id = $this->input->post('id');
		$no_surat = $this->permintaan_model->getNoSuratPmr($id);

		echo $no_surat;
	}

	public function getEnkripsiPmr(){

		/* 
		-- keterangan Masing Masing Fungsi yang dipake dari Library gmp --

		gmp_div_qr = Bagi;
		gmp_add    = Tambah;
		gmp_mul    = Kali;
		gmp_sub    = Kurang;
		gmp_gcd    = Menghitung Nilai phi;
		gmp_strval = Convert Nomer ke String;

		*/
	    //untuk membuat kunci yang lebih panjang coba gmp_random
	    //$rand1 = gmp_random(1); // mengeluarkan random number dari 0 sampai 1 x limb
	    //$rand2 = gmp_random(1); // mengeluarkan random number dari 0 sampai 1 x limb

        //mencari bilangan random
		$rand1=rand(1000,2000);
		$rand2=rand(1000,2000);

	    // mencari bilangan prima selanjutnya dari $rand1 &rand2
		$p = gmp_nextprime($rand1); 
		$q = gmp_nextprime($rand2);


        //menghitung&menampilkan n=p*q
		$n=gmp_mul($p,$q);

        //menghitung&menampilkan totient/phi=(p-1)(q-1)
		$totient=gmp_mul(gmp_sub($p,1),gmp_sub($q,1));

	    //mencari e, dimana e merupakan coprime dari totient
	    //e dikatakan coprime dari totient jika gcd/fpb dari e dan totient/phi = 1
		for($e=5;$e<1000;$e++){

	      //mencoba perulangan max 1000 kali, 
			$gcd = gmp_gcd($e, $totient);
			if(gmp_strval($gcd)=='1')
				break;

		}

		//menghitung&menampilkan d
		$i=1;
		do{

			$res = gmp_div_qr(gmp_add(gmp_mul($totient,$i),1), $e);
			$i++;
            if($i==10000) //maksimal percobaan 10000
            break;

        }while(gmp_strval($res[1])!='0');
        $d=$res[0];

        $no_surat = $this->input->post('no_surat');
        $id = $this->input->post('id');
        $hasilenkripsi = enkripsi($no_surat, $n, $e);

        $jsonSPKPEnkripsi = '{"p":"'.gmp_strval($p).'","q":"'.gmp_strval($q).'","n":"'.gmp_strval($n).'","e":"'.gmp_strval($e).'","d":"'.gmp_strval($d).'","enkripsi":"'.$hasilenkripsi.'"}';

        $enkripsi = [

        	'no_surat' => $no_surat,
        	'enkripsi' => $jsonSPKPEnkripsi

        ];



        $this->db->where('id_permintaan', $id);
        $this->db->update('esurat_permintaan', $enkripsi);

        $data['enkripsi'] = $hasilenkripsi;

        echo json_encode($data);

    }

    public function getconvertPmr(){

    	$domain = $this->input->post('domain');
    	$nameController = "Auth/Surat/";
    	$enkripsi = $this->input->post('enkripsi');
    	$no_surat = $this->input->post('no_surat');
    	$penggabungan = $domain.$nameController.$enkripsi;
    	$filename = str_replace("/", "_", $no_surat);

    	$params = [

    		'data' => $penggabungan,
    		'savename' => FCPATH."assets/esurat/img/QRCode/".$filename.".png"

    	];

    	$this->ciqrcode->generate($params);

    	echo $filename;

    }

    public function getNoSuratCos() {

    	$kd_suratCos = $this->input->post('kd_suratCos');
    	$no_suratCos = $this->permintaan_model->getNoSuratCos($kd_suratCos);

    	echo $no_suratCos;
    }

    public function getEnkripsiCos(){

		/* 
		-- keterangan Masing Masing Fungsi yang dipake dari Library gmp --

		gmp_div_qr = Bagi;
		gmp_add    = Tambah;
		gmp_mul    = Kali;
		gmp_sub    = Kurang;
		gmp_gcd    = Menghitung Nilai phi;
		gmp_strval = Convert Nomer ke String;

		*/
	    //untuk membuat kunci yang lebih panjang coba gmp_random
	    //$rand1 = gmp_random(1); // mengeluarkan random number dari 0 sampai 1 x limb
	    //$rand2 = gmp_random(1); // mengeluarkan random number dari 0 sampai 1 x limb

        //mencari bilangan random
		$rand1=rand(1000,2000);
		$rand2=rand(1000,2000);

	    // mencari bilangan prima selanjutnya dari $rand1 &rand2
		$p = gmp_nextprime($rand1); 
		$q = gmp_nextprime($rand2);


        //menghitung&menampilkan n=p*q
		$n=gmp_mul($p,$q);

        //menghitung&menampilkan totient/phi=(p-1)(q-1)
		$totient=gmp_mul(gmp_sub($p,1),gmp_sub($q,1));

	    //mencari e, dimana e merupakan coprime dari totient
	    //e dikatakan coprime dari totient jika gcd/fpb dari e dan totient/phi = 1
		for($e=5;$e<1000;$e++){

	      //mencoba perulangan max 1000 kali, 
			$gcd = gmp_gcd($e, $totient);
			if(gmp_strval($gcd)=='1')
				break;

		}

		//menghitung&menampilkan d
		$i=1;
		do{

			$res = gmp_div_qr(gmp_add(gmp_mul($totient,$i),1), $e);
			$i++;
            if($i==10000) //maksimal percobaan 10000
            break;

        }while(gmp_strval($res[1])!='0');
        $d=$res[0];

        $no_suratCos = $this->input->post('no_suratCos');
        $hasilenkripsiCos = enkripsi($no_suratCos, $n, $e);

        $data['pCos'] = gmp_strval($p);
        $data['qCos'] = gmp_strval($q);
        $data['nCos'] = gmp_strval($n);
        $data['eCos'] = gmp_strval($e);
        $data['dCos'] = gmp_strval($d);
        $data['enkripsiCos'] = $hasilenkripsiCos;

        echo json_encode($data);

    }

    public function getconvertCos(){

    	$domainCos = $this->input->post('domainCos');
    	$nameControllerCos = "Auth/Surat/";
    	$enkripsiCos = $this->input->post('enkripsiCos');
    	$no_suratCos = $this->input->post('no_suratCos');
    	$penggabunganCos = $domainCos.$nameControllerCos.$enkripsiCos;
    	$filename = str_replace("/", "_", $no_suratCos);

    	$params = [

    		'data' => $penggabunganCos,
    		'savename' => FCPATH."assets/esurat/img/QRCode/".$filename.".png"

    	];

    	$this->ciqrcode->generate($params);

    	echo $filename;

    }

}