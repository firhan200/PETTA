<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tema extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('MKategori');
		$this->load->model('MTema');
	}

	public function index(){
		$this->sessionOut();
		$data['menu1'] = true;
		//$this->sessionIn(); //check session
		$this->load->view('layouts/header');
		$this->load->view('home_page', $data);
		$this->load->view('layouts/footer');
	}

	public function riwayat(){
		$this->sessionOut();
		$data['menu32'] = true;

		$this->load->view('layouts/header');
		$this->load->view('tema_riwayat_page', $data);
		$this->load->view('layouts/footer');
	}

	public function data(){
		$this->sessionOut();
		$data['menu32'] = true;

		$idUser = $this->session->userdata('idpetta');
		$data['query'] = $this->MTema->readTemaPersonal($idUser);

		$this->load->view('layouts/header');
		$this->load->view('tema_list_page', $data);
		$this->load->view('layouts/footer');
	}

	public function tambah(){
		$this->sessionOut();
		$data['menu32'] = true;

		$data['kategoriQuery'] = $this->MKategori->read(null, 'nama_kategori', 'ASC');

		$this->load->view('layouts/header');
		$this->load->view('tema_tambah_page', $data);
		$this->load->view('layouts/footer');
	}

	public function create(){
		if(!empty($_SESSION['tag'])){
			$idUser = $this->session->userdata('idpetta');
			$judul = $this->input->post('judul');
			$keterangan = $this->input->post('keterangan');
			$date = gmdate("Y-m-d, H:i:s", time()+3600*7);
			$data = array('id_pengguna'=>$idUser, 'judul'=>$judul, 'keterangan'=>$keterangan, 'tanggal_post'=>$date, 'status_tema'=>0);
			$insert = $this->MTema->create($data);
			foreach($_SESSION['tag'] as $result){
				$dataTag = array('id_tema'=>$insert['id'], 'id_kategori'=>$result);
				$insertTag = $this->MKategori->createTag($dataTag);
			}

			if($insert){
				unset($_SESSION['tag']);
				redirect(site_url('tema/data?balasan=1'));
			}else{
				redirect(site_url('tema/tambah?balasan=2'));
			}
		}else{
			redirect(site_url('tema/tambah?balasan=3'));
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
}