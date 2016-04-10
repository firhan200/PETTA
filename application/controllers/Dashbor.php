<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashbor extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('MDosen');
		$this->load->model('MMahasiswa');
		$this->load->model('MTema');
		$this->load->model('MPeminatan');
	}

	public function index(){
		$data['menu01'] = true;
		$this->sessionOut(); //check session

		//information
		$data['totalDosen'] = $this->MDosen->read(null, null, null);
		$data['totalDosen'] = $data['totalDosen']->num_rows();
		$data['totalMahasiswa'] = $this->MMahasiswa->read(null, null, null);
		$data['totalMahasiswa'] = $data['totalMahasiswa']->num_rows();
		$data['totalTema'] = $this->MTema->read(null, null, null);
		$data['totalTema'] = $data['totalTema']->num_rows();
		$data['totalTemaBuka'] = $this->MTema->read(array('status_tema'=>0), null, null);
		$data['totalTemaBuka'] = $data['totalTemaBuka']->num_rows();
		$data['totalPeminatan'] = $this->MPeminatan->read(null, null, null);
		$data['totalPeminatan'] = $data['totalPeminatan']->num_rows();

		$this->load->view('layouts/header');
		$this->load->view('admin/dashbor_page', $data);
		$this->load->view('layouts/footer');
	}

	public function getDataPeminatan(){
		$query = $this->MTema->read(array('status_tema'=>0), 'id_tema', 'DESC');
		foreach($query->result() as $result){
			if(strlen($result->judul) > 25){ 
				$data['judul'][] = substr($result->judul, 0, 25);
			}else{ 
				$data['judul'][] = $result->judul;
			}
			$data['peminat'][] = $this->getTotalPeminat($result->id_tema);
		}
		header("Content-Type: application/json");
		echo json_encode($data);
	}

	public function getTotalPeminat($id){
		$query = $this->MPeminatan->read(array('id_tema'=>$id), null, null);
		return $query->num_rows();
	}
}