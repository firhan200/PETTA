<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends MY_Controller {
	public function __construct(){
		parent::__construct();
		/*PENJELASAN
			load library dan model yang diperlukan	
		*/
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->helper('date');
		$this->load->model('MDosen');
		$this->load->model('MMahasiswa');
		$this->load->model('MTema');
		$this->load->model('MPeminatan');
		$this->load->model('MPengguna');
	}

	public function index($id = null){
		/*PENJELASAN
			fungsi yand dijalankan ketika halaman terload pertama kali, membaca data yang diperlukan			
		*/
		$data['menu4'] = true;

		if($id==null){
			$data['self'] = 1;
			$data['level'] = $this->session->userdata('levelpetta');

			//query informasi
			$data["row"] = $this->MMahasiswa->getMhs('pengguna',null,null,null);
			$data["rowDsn"] = $this->MDosen->getWali('pengguna',null,null,null);
			$data['query'] = $this->MDosen->getWali('pengguna',null,null,null);

			//query riwayat
			if($this->session->userdata('levelpetta')==2){
				$data['query1'] = $this->MPeminatan->readRiwayat(array('tema.id_pengguna'=>($this->session->userdata('idpetta'))));
			}else if($this->session->userdata('levelpetta')==3){
				$data['query1'] = $this->MPeminatan->readRiwayat(array('peminatan.id_pengguna'=>($this->session->userdata('idpetta'))));	
			} 
		}else{
			//cek self profile
			if($id==$this->session->userdata('idpetta')){
				redirect(site_url('profil'));
			}else{
				$data['self'] = 0;
			}

			//get level pengguna
			$queryLevel = $this->MPengguna->read(array('id_pengguna'=>$id), null, null);
			foreach($queryLevel->result() as $result){
				$data['level'] = $result->level;
			}

			//query informasi
			$data["row"] = $this->MMahasiswa->read('mahasiswa', array('id_pengguna'=>$id),null,null);
			$data['query'] = $this->MDosen->read('dosen', array('id_pengguna'=>$id),null,null);

			//query riwayat
			if($data['level']==2){
				$data['query1'] = $this->MPeminatan->readRiwayat(array('tema.id_pengguna'=>$id));
			}else if($data['level']==3){
				$data['query1'] = $this->MPeminatan->readRiwayat(array('peminatan.id_pengguna'=>$id));	
			} 
		}

		$this->load->view('layouts/header');
		if($this->session->userdata('levelpetta')==1){//admin
				$this->load->view('profil_page', $data);
			}else if($this->session->userdata('levelpetta')==3){//mahasiswa
				$row = $this->MMahasiswa->getMhs('pengguna',null,null,null);
				foreach($row->result() as $result){
					if(($result->email==null) || ($result->telepon==null)){
						$this->load->view('verifikasi_page', $data);
					}else if ((!$result->email==null) && (!$result->telepon==null)){
						$this->load->view('profil_page', $data);
					}
				}
			}else if ($this->session->userdata('levelpetta')==2){//dosen
				$rowDsn = $this->MDosen->getWali('pengguna',null,null,null);
				foreach($rowDsn->result() as $result){
					if(($result->email==null) || ($result->telepon==null)){
						$this->load->view('verifikasi_page', $data);
					}else if ((!$result->email==null) && (!$result->telepon==null)){
						$this->load->view('profil_page', $data);
					}
				}
			}	
		$this->load->view('layouts/footer');
	}

	public function getDataMhs($id){
		/*PENJELASAN
			mendapatkan data mahasiswa yang login untuk di profil	
		*/
		$query = $this->MMahasiswa->read('mahasiswa', array('id'=>$id), null, null);
		foreach($query->result() as $result){
			$data = array(
					'emailMhs'=>$result->email,
					'teleponMhs'=>$result->telepon);
		}
		header('Content-Type: application/json');
		echo json_encode($data);
	}

	public function getData($id){
		/*PENJELASAN
			fungsi untuk mendapatkan data dosen yang login untuk profil	
		*/
		if ($this->session->userdata("levelpetta")==2){
			$query = $this->MDosen->read('dosen', array('id'=>$id), null, null);
			foreach($query->result() as $result){
				$data = array(
					'email'=>$result->email,
					'telepon'=>$result->telepon,
				);
			}
		}else if ($this->session->userdata("levelpetta")==3){
			$query = $this->MMahasiswa->read('mahasiswa', array('id'=>$id), null, null);
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
	public function insertKategori(){
		/*PENJELASAN
			fungsi insert kategori	
		*/
		$namaKategori = $this->input->post('kategori');
		$data = array(
				'kategori'=>$namaKategori
			);
		$insert = $this->MAdmin->create('kategori', $data);
		redirect(site_url('kategori/data'));
	}
	public function update($id){
		/*PENJELASAN
			fungsi update dosen atau mahasiswa tergantung levelpetta	
		*/
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
		/*PENJELASAN
			fungsi untuk upload foto pada dosen	
		*/
		$upload = $this->input->post('fotoDsn');
		//Foto Set
		$photoName = gmdate("d-m-y-H-i-s", time()+3600*7).".jpg";
		$config['upload_path'] = './assets/img/dosen/';
		$config['allowed_types'] = 'gif||jpg||png||jpeg';
		$config['max_size'] = '1000';
		$config['file_name'] = $photoName;
		$this->load->library('upload',$config);
		if($this->upload->do_upload('userfile')){			
			$upload = 1;
		}else if (!$this->upload->do_upload('userfile')){
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
		}else if($upload==2){
			/*$error = $this->upload->display_errors();
		    $this->session->set_flashdata('error', '$error');
		       redirect($_SERVER['HTTP_REFERER']);*/
			alert('error');
			echo "failed";
			$errors = $this->upload->display_errors('<p>','failed try again','</p');
			flashMsg($errors);
		}//else kalo gagal
	}
	public function cekData($field){
		/*PENJELASAN
			fungsi cek data	
		*/
		$data = $this->input->get('value');
		if($this->session->userdata('levelpetta')==2){
			$match = $this->MDosen->read('dosen', array($field=>$data), null, null);
			if($match->num_rows() > 0){
				$report = 2;
			}else{
				$report = 1;
			}
			echo $report;
		}else if($this->session->userdata('levelpetta')==3){
			$match = $this->MMahasiswa->read('mahasiswa', array($field=>$data), null, null);
			if($match->num_rows() > 0){
				$report = 2;
			}else{
				$report = 1;
			}
			echo $report;
			}	
	}
}