<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tema extends MY_Controller {
	public function __construct(){
		/*PENJELASAN
			load library dan model yang diperlukan	
		*/
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('MKategori');
		$this->load->model('MTema');
		$this->load->model('MTag');
		$this->load->model('MDosen');
		$this->load->model('MMahasiswa');
		$this->load->model('MPeminatan');
		$this->load->model('MPengguna');
		$this->load->model('MPesan');
	}

	public function index(){
		/*PENJELASAN
			fungsi yang pertama kali di jalankan ketika page terload
			yaitu membaca data pada beberapa tabel dan memfilter data berdasarkan
			filter yang dipilih	
		*/
		$this->sessionOut();
		$data['menu1'] = true;
		
		$data["row"] = $this->MMahasiswa->getMhs('pengguna',null,null,null);
		$data["rowDsn"] = $this->MDosen->getWali('pengguna',null,null,null);
		$data['query'] = $this->MTema->readAll(array('status_tema'=>0), 'id_tema', 'DESC');
		$data['queryKategori'] = $this->MKategori->read('kategori',null, 'nama_kategori', 'ASC');
		$data['queryDosen'] = $this->MDosen->read('dosen',null, 'nama_dosen', 'ASC');

		//filter kategori
		if($this->input->get('kategori')!=null){
			$data['query'] = $this->MTema->readByKategori(array('id_kategori'=>$this->input->get('kategori'), 'status_tema'=>0));
			$data['filterKategori'] = $this->input->get('kategori');
		}
		//filter dosen
		if($this->input->get('dosen')!=null){
			$data['query'] = $this->MTema->readAll(array('tema.id_pengguna'=>$this->input->get('dosen'), 'status_tema'=>0), 'id_tema', 'DESC');
			$data['filterDosen'] = $this->input->get('dosen');
		}
		//filter dosen
		if($this->input->get('cari')!=null){
			$data['query'] = $this->MTema->readSearch(array('tema.judul'=>$this->input->get('cari'), 'status_tema'=>0), 'id_tema', 'DESC');
			$data['filterCari'] = $this->input->get('cari');
		}
		//filter tema
		if($this->input->get('tema')!=null){
			if($this->input->get('tema')=='tutup'){
				$data['query'] = $this->MTema->readAll(array('status_tema'=>1), 'id_tema', 'DESC');			
			}else{
				$data['query'] = $this->MTema->readAll(array('status_tema'=>0), 'id_tema', 'DESC');
			}
			$data['filterTema'] = $this->input->get('tema');
		}

		//config
		$data['date'] = $this->monthConverter();

		$this->load->view('layouts/header');
			if($this->session->userdata('levelpetta')==1){//admin
				$this->load->view('home_page', $data);
			}else if($this->session->userdata('levelpetta')==3){//mahasiswa
				$row = $this->MMahasiswa->getMhs('pengguna',null,null,null);
				foreach($row->result() as $result){
					if(($result->email==null) || ($result->telepon==null)){
						$this->load->view('verifikasi_page', $data);
					}else if ((!$result->email==null) && (!$result->telepon==null)){
						$this->load->view('home_page', $data);
					}
				}
			}else if ($this->session->userdata('levelpetta')==2){//dosen
				$rowDsn = $this->MDosen->getWali('pengguna',null,null,null);
				foreach($rowDsn->result() as $result){
					if(($result->email==null) || ($result->telepon==null)){
						$this->load->view('verifikasi_page', $data);
					}else if ((!$result->email==null) && (!$result->telepon==null)){
						$this->load->view('home_page', $data);
					}
				}
			}	
		$this->load->view('layouts/footer');
	}

	public function riwayat(){
		/*PENJELASAN
			fungsi untuk menunjukkan riwayat tema yang dipilih	
		*/
		$this->sessionOut();
		if($this->session->userdata('levelpetta')!=2){ redirect($_SERVER['HTTP_REFERER']); }
		$data['menu32'] = true;

		$data["rowDsn"] = $this->MDosen->getWali('pengguna',null,null,null);
		$data['query'] = $this->MPeminatan->readRiwayat(array('tema.id_pengguna'=>($this->session->userdata('idpetta'))));
		//config
		$data['date'] = $this->monthConverter();
		
		$this->load->view('layouts/header');
		$rowDsn = $this->MDosen->getWali('pengguna',null,null,null);
		foreach($rowDsn->result() as $result){
			if(($result->email==null) || ($result->telepon==null)){
				$this->load->view('verifikasi_page', $data);
			}else if ((!$result->email==null) && (!$result->telepon==null)){
				$this->load->view('tema_riwayat_page', $data);
			}
		}

		$this->load->view('layouts/footer');
	}

	public function data(){
		/*PENJELASAN
			fungsi untuk membaca tema yang ada dan menampilkan	
		*/
		$this->sessionOut();
		if($this->session->userdata('levelpetta')!=2){ redirect($_SERVER['HTTP_REFERER']); }
		$data['menu32'] = true;

		$idUser = $this->session->userdata('idpetta');
		$data['query'] = $this->MTema->readTemaPersonal($idUser);
		//config
		$data['date'] = $this->monthConverter();
		
		$this->load->view('layouts/header');
		$this->load->view('tema_list_page', $data);
		$this->load->view('layouts/footer');
	}

	public function tambah(){
		/*PENJELASAN
			fungsi untk tambah tema	
		*/
		$this->sessionOut();
		if($this->session->userdata('levelpetta')!=2){ redirect($_SERVER['HTTP_REFERER']); }
		unset($_SESSION['tag']);
		$data['menu32'] = true;

		$data['kategoriQuery'] = $this->MKategori->read('kategori',null, 'nama_kategori', 'ASC');

		$this->load->view('layouts/header');
		$this->load->view('tema_tambah_page', $data);
		$this->load->view('layouts/footer');
	}

	public function detil($id = null){
		/*PENJELASAN
			fungsi untuk melihat detail tema	
		*/
		$this->sessionOut();
		$data['query'] = $this->MTema->readDetil($id);
		if($data['query']->num_rows() > 0){
			foreach($data['query']->result() as $result){
				$dosen = $result->id_pengguna;
			}
			if($this->session->userdata('levelpetta')==2){
				if($dosen==$this->session->userdata('idpetta')){
					$data['self'] = 1;
				}else{
					$data['self'] = 2;
				}
			}else{
				$this->load->model('MPeminatan');
				$check = $this->MPeminatan->read(array('id_pengguna'=>$this->session->userdata('idpetta'), 'id_tema'=>$id), null, null);
				if($check->num_rows() > 0){
					$data['self'] = 4;
				}else{
					$data['self'] = 3;
				}
			}
			//config
			$data['date'] = $this->monthConverter();
			$data['link'] = strtok($_SERVER["HTTP_REFERER"],'?');

			$this->load->view('layouts/header');
			$this->load->view('tema_detil_page', $data);
			$this->load->view('layouts/footer');
		}else{
			show_404();
		}
	}

	public function ubah($id = null){
		/*PENJELASAN
			fungsi untuk mengubah tema pada bagian tag	
		*/
		$this->sessionOut();
		if($this->session->userdata('levelpetta')!=2){ redirect($_SERVER['HTTP_REFERER']); }
		$data['menu32'] = true;

		$data['query'] = $this->MTema->read(array('id_tema'=>$id), null, null);
		$data['kategoriQuery'] = $this->MKategori->read('kategori',null, 'nama_kategori', 'ASC');
		//get tag
		unset($_SESSION['tag']);
		$queryTag = $this->MTag->read(array('id_tema'=>$id), null, null);
		foreach($queryTag->result() as $result){
			$_SESSION['tag'][] = $result->id_kategori;
		}

		$this->load->view('layouts/header');
		$this->load->view('tema_ubah_page', $data);
		$this->load->view('layouts/footer');
	}

	public function create(){
		/*PENJELASAN
			fungsi untuk membuat tema baru	
		*/
		$this->sessionOut();
		if($this->session->userdata('levelpetta')!=2){ redirect($_SERVER['HTTP_REFERER']); }
		if(!empty($_SESSION['tag'])){
			$idUser = $this->session->userdata('idpetta');
			$judul = $this->input->post('judul');
			$keterangan = $this->input->post('keterangan');
			$date = gmdate("Y-m-d, H:i:s", time()+3600*7);
			$data = array('id_pengguna'=>$idUser, 'judul'=>$judul, 'keterangan'=>$keterangan, 'tanggal_post'=>$date, 'status_tema'=>0);
			$insert = $this->MTema->create($data);
			foreach($_SESSION['tag'] as $result){
				$dataTag = array('id_tema'=>$insert['id'], 'id_kategori'=>$result);
				$insertTag = $this->MTag->create($dataTag);
			}

			if($insert){
				unset($_SESSION['tag']);
				redirect(site_url('tema/detil/'.$insert['id']));
			}else{
				redirect(site_url('tema/tambah?balasan=2'));
			}
		}else{
			redirect(site_url('tema/tambah?balasan=3'));
		}
	}

	public function update($id = null){
		/*PENJELASAN
			fungsi update tema	
		*/
		$this->sessionOut();
		if($this->session->userdata('levelpetta')!=2){ redirect($_SERVER['HTTP_REFERER']); }
		if(!empty($_SESSION['tag'])){
			$judul = $this->input->post('judul');
			$keterangan = $this->input->post('keterangan');
			$data = array('judul'=>$judul, 'keterangan'=>$keterangan);
			$insert = $this->MTema->update(array('id_tema'=>$id), $data);
			//tagging
			$deleteOldTag = $this->MTag->delete(array('id_tema'=>$id));
			foreach($_SESSION['tag'] as $result){
				$dataTag = array('id_tema'=>$id, 'id_kategori'=>$result);
				$insertTag = $this->MTag->create($dataTag);
			}

			if($insert){
				unset($_SESSION['tag']);
				redirect(site_url('tema/detil/'.$id.'?balasan=1'));
			}else{
				redirect(site_url('tema/ubah/'.$id.'?balasan=2'));
			}
		}else{
			redirect(site_url('tema/ubah/'.$id.'?balasan=3'));
		}
	}

	public function hapus($id = null){
		/*PENJELASAN
			fungsi untuk menghapus tema	
		*/
		$this->sessionOut();
		if($this->session->userdata('levelpetta')!=2){ redirect($_SERVER['HTTP_REFERER']); }
		$query = $this->MTema->read(array('id_tema'=>$id), null, null);
		if($query->num_rows() > 0){
			//$last = strtok($_SERVER["HTTP_REFERER"],'?');
			$delete = $this->MTema->delete(array('id_tema'=>$id));
			$deleteTag = $this->MTag->delete(array('id_tema'=>$id));
			if($delete AND $deleteTag){
				redirect(site_url('tema/data?balasan=1'));
			}else{
				redirect(site_url('tema/data?balasan=2'));
			}
		}else{
			show_404();
		}
	}

	public function ubah_status($id, $status){
		/*PENJELASAN
			fungsi ubah status tema	
		*/
		$data = array('status_tema'=>$status);
		$update = $this->MTema->update(array('id_tema'=>$id), $data);
		redirect(site_url('tema/detil/'.$id.'?balasan=1'));
	}

	public function minat($id = null){
		/*PENJELASAN
			fungsi untuk meminati tema	
		*/
		$this->sessionOut();
		if($this->session->userdata('levelpetta')!=3){ redirect($_SERVER['HTTP_REFERER']); }
		$this->load->model('MPeminatan');
		$data = array('id_pengguna'=>$this->session->userdata('idpetta'), 'id_tema'=>$id);
		$insert = $this->MPeminatan->create($data);
		if($insert){
			redirect(site_url('tema/detil/'.$id.'?balasan=3'));
		}else{
			redirect(site_url('tema/detil/'.$id.'?balasan=4'));
		}
	}

	public function batal_minat($id = null){
		/*PENJELASAN
			fungsi untuk membatalkan tema	
		*/
		$this->sessionOut();
		if($this->session->userdata('levelpetta')!=3){ redirect($_SERVER['HTTP_REFERER']); }
		$this->load->model('MPeminatan');
		$query = $this->MPeminatan->read(array('id_pengguna'=>$this->session->userdata('idpetta'), 'id_tema'=>$id), null, null);
		if($query->num_rows() > 0){
			$delete = $this->MPeminatan->delete(array('id_pengguna'=>$this->session->userdata('idpetta'), 'id_tema'=>$id));
			if($delete){
				redirect(site_url('tema/detil/'.$id.''));
			}else{
				redirect(site_url('tema/detil/'.$id.'?balasan=4'));
			}
		}else{
			show_404();
		}
	}

	//tambahan

	public function setujui_peminat($idTema = null, $idPengguna = null){
		/*PENJELASAN
			fungsi untuk menyutujui peminatan tema	
		*/
		//update status
		$data_baru = array('status_peminatan'=>1);
		$update_peminatan = $this->MPeminatan->update(array('id_pengguna'=>$idPengguna, 'id_tema'=>$idTema), $data_baru);

		//get judul tema
		$query = $this->MTema->read(array('id_tema'=>$idTema), null, null);
		foreach($query->result() as $result){
			$judul_tema = $result->judul;
		}

		//kirim pesan
		$message = "Peminatan anda pada tema: '".$judul_tema."' Telah di setujui";
		$date = gmdate("Y-m-d, H:i:s", time()+3600*7);
		$level = $this->session->userdata('levelpetta');
		$data = array('id_pengirim'=>$this->session->userdata('idpetta'), 'id_penerima'=>$idPengguna, 'pesan'=>$message, 'tanggal'=>$date, 'level'=>$level);
		$insert = $this->MPesan->create($data);
		if($insert){
			$notify = $this->addNotification($idPengguna, 'add');
			if($notify){
				redirect(site_url('tema/detil/'.$idTema));
			}else{
				redirect(site_url('tema/detil/'.$idTema));
			}	
		}else{
			redirect(site_url('tema/detil/'.$idTema));
		}
	}

	public function batalkan_peminat($idTema = null, $idPengguna = null){
		/*PENJELASAN
			fungsi untuk mebatalakna pemintan tema	
		*/
		//update status
		$data_baru = array('status_peminatan'=>null);
		$update_peminatan = $this->MPeminatan->update(array('id_pengguna'=>$idPengguna, 'id_tema'=>$idTema), $data_baru);

		redirect(site_url('tema/detil/'.$idTema));
	}

	//tambahan
	
	public function checkTitle($judul){
		/*PENJELASAN
			fungsi untuk cek judul apakah sudah ada atau belum	
		*/
		$match = $this->MTema->read(array('judul'=>$judul), null, null);
		if($match->num_rows() > 0){
			$response = 2;
		}else{
			$response = 1;
		}
		echo $response;
	}

	public function checkEditTitle($judul, $old){
		/*PENJELASAN
			fungsi cek judul lagi	
		*/
		if($judul!=$old){
			$match = $this->MTema->read(array('judul'=>$judul), null, null);
			if($match->num_rows() > 0){
				$response = 2;
			}else{
				$response = 1;
			}
		}else{
			$response = 1;
		}
		echo $response;
	}

	public function getTags(){
		/*PENJELASAN
			fungsi untuk mendapatkan tema	
		*/
		$this->load->view('get_tags');
	}

	public function appendTags($id){
		/*PENJELASAN
			fungsi untuk meng-append tema	
		*/
		//session_destroy();
		if($id!=""){
			if(in_array($id, $_SESSION['tag'])==false){
				$_SESSION['tag'][] = $id;
			}
		}
	}

	public function removeTags($id){
		/*PENJELASAN
			fungsi untuk menghilangkan tema dari session yang sudah ada	
		*/
		$index = array_search($id, $_SESSION['tag']);
		unset($_SESSION['tag'][$index]);
	}

	public function monthConverter(){
		/*PENJELASAN
			fungsi untuk mengubah bulan	
		*/
		$month = array(
			'00'=>'asd', '01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei',
			'06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober',
			'11'=>'November','12'=>'Desember',
		);
		return $month;
	}

	public function addNotification($idReceiver, $order){
		/*PENJELASAN
			fungsi untuk memberikan notifikasi pada peminatan tema	
		*/
		$query = $this->MPengguna->read(array('id_pengguna'=>$idReceiver), null, null);
		foreach($query->result() as $result){
			$lastNumber = $result->notifikasi;
		}
		if($order=='add'){
			$newNumber = $lastNumber + 1;
		}else if($order=='del'){
			$newNumber = $lastNumber - 1;
		}
		$data = array('notifikasi'=>$newNumber);
		$update = $this->MPengguna->update(array('id_pengguna'=>$idReceiver), $data);
		if($update){
			return true;
		}else{
			return false;
		}
	}
}