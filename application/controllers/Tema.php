<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tema extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('MKategori');
		$this->load->model('MTema');
		$this->load->model('MTag');
	}

	public function index(){
		$this->sessionOut();
		$data['menu1'] = true;
		
		$data['query'] = $this->MTema->readAll(null, 'id_tema', 'DESC');
		//config
		$data['date'] = $this->monthConverter();

		$this->load->view('layouts/header');
		$this->load->view('home_page', $data);
		$this->load->view('layouts/footer');
	}

	public function riwayat(){
		$this->sessionOut();
		if($this->session->userdata('levelpetta')!=2){ redirect($_SERVER['HTTP_REFERER']); }
		$data['menu32'] = true;

		$this->load->view('layouts/header');
		$this->load->view('tema_riwayat_page', $data);
		$this->load->view('layouts/footer');
	}

	public function data(){
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
		$this->sessionOut();
		if($this->session->userdata('levelpetta')!=2){ redirect($_SERVER['HTTP_REFERER']); }
		unset($_SESSION['tag']);
		$data['menu32'] = true;

		$data['kategoriQuery'] = $this->MKategori->read(null, 'nama_kategori', 'ASC');

		$this->load->view('layouts/header');
		$this->load->view('tema_tambah_page', $data);
		$this->load->view('layouts/footer');
	}

	public function detil($id = null){
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
		$this->sessionOut();
		if($this->session->userdata('levelpetta')!=2){ redirect($_SERVER['HTTP_REFERER']); }
		$data['menu32'] = true;

		$data['query'] = $this->MTema->read(array('id_tema'=>$id), null, null);
		$data['kategoriQuery'] = $this->MKategori->read(null, 'nama_kategori', 'ASC');
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

	public function minat($id = null){
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
	
	public function checkTitle($judul){
		$match = $this->MTema->read(array('judul'=>$judul), null, null);
		if($match->num_rows() > 0){
			$response = 2;
		}else{
			$response = 1;
		}
		echo $response;
	}

	public function checkEditTitle($judul, $old){
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
		$this->load->view('get_tags');
	}

	public function appendTags($id){
		//session_destroy();
		if($id!=""){
			if(in_array($id, $_SESSION['tag'])==false){
				$_SESSION['tag'][] = $id;
			}
		}
	}

	public function removeTags($id){
		$index = array_search($id, $_SESSION['tag']);
		unset($_SESSION['tag'][$index]);
	}

	public function monthConverter(){
		$month = array(
			'00'=>'asd', '01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei',
			'06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober',
			'11'=>'November','12'=>'Desember',
		);
		return $month;
	}
}