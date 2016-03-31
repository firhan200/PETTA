<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('MDosen');
		$this->load->model('MMahasiswa');
		$this->load->model('MTema');
		$this->load->model('MPeminatan');

	}

	public function index(){
		$data['menu4'] = true;
		//$this->sessionIn(); //check session
		$data["row"] = $this->MMahasiswa->getMhs('pengguna',null,null,null);
		$data['query'] = $this->MDosen->getWali('pengguna',null,null,null);
		
		if($this->session->userdata('levelpetta')==2){
			$data['query1'] = $this->MPeminatan->readRiwayat(array('tema.id_pengguna'=>($this->session->userdata('idpetta'))));
		}else if($this->session->userdata('levelpetta')==3){
			$data['query1'] = $this->MPeminatan->readRiwayat(array('peminatan.id_pengguna'=>($this->session->userdata('idpetta'))));	
		} 
		$this->load->view('layouts/header');
		$this->load->view('profil_page', $data);
		$this->load->view('layouts/footer');
	}

	public function getDataMhs($id){
		$query = $this->MMahasiswa->read( array('id'=>$id), null, null);
		foreach($query->result() as $result){
			$data = array(
					'emailMhs'=>$result->email,
					'teleponMhs'=>$result->telepon);
		}
		header('Content-Type: application/json');
		echo json_encode($data);
	}

	public function getData($id){
		if ($this->session->userdata("levelpetta")==2){
			$query = $this->MDosen->read( array('id'=>$id), null, null);
			foreach($query->result() as $result){
				$data = array(
					'email'=>$result->email,
					'telepon'=>$result->telepon,
				);
			}
		}else if ($this->session->userdata("levelpetta")==3){
			$query = $this->MMahasiswa->read( array('id'=>$id), null, null);
			foreach($query->result() as $result){
				$data = array(
					'email'=>$result->email,
					'telepon'=>$result->telepon
				);
			}
		}
		
		header('Content-Type: application/json');
		echo json_encode($data);
	}

	public function update($id){
		if($this->session->userdata('levelpetta')==2){//DOSEN
			$emailDsn = $this->input->post('EditEmail');
			$teleponDsn = $this->input->post('EditTelepon');
			$data = array(
					'email'=>$emailDsn,
					'telepon'=>$teleponDsn
					);
			$update = $this->MDosen->update(array('id'=>$id),  $data);
			if($update){
				echo 1;
			}else{
				echo 2;
			}
		} else if ($this->session->userdata('levelpetta')==3){//MAHASISWA
			$emailMhs = $this->input->post('EditEmail');
			$teleponMhs = $this->input->post('EditTelepon');
			$data = array(
					'email'=>$emailMhs,
					'telepon'=>$teleponMhs
					);
			$update = $this->MMahasiswa->update(array('id'=>$id),  $data);
			if($update){
				echo 1;
			}else{
				echo 2;
			}
		}
	}

	public function Upload($id){
		$upload = $this->input->post('fotoDsn');
		//Foto Set
		$photoName = gmdate("d-m-y-H-i-s", time()+3600*7).".jpg";
		$config['upload_path'] = './assets/img/dosen/';
		$config['allowed_types'] = 'gif||jpg||png';
		$config['max_size'] = '2048000';
		$config['file_name'] = $photoName;
		$this->load->library('upload',$config);
		if($this->upload->do_upload('userfile')){			
			$upload = 1;
		}
		else{
			$upload = 2;
		}
		if($upload==1){
			$data   = array(
					'foto_dosen'=>$photoName);
			$insert = $this->MDosen->update(array('id'=>$id),  $data);
			if($insert){
				echo 1;
			}else{
				echo 2;
			}
		}//else kalo gagal
	}
}