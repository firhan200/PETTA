<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('MPengguna');
		$this->load->model('MMahasiswa');
		$this->load->model('MDosen');
		$this->load->model('MAdmin');
	}

	public function masuk(){
		$this->sessionIn(); //cek session
		if($this->input->get('balasan')!=null){
			$data['report'] = 1;
		}else{
			$data['report'] = 0;
		}
		$this->load->view('layouts/header');
		$this->load->view('login_page', $data);
	}

	public function loginProcess(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$match = $this->MPengguna->read(array('username'=>$username, 'password'=>sha1($password)), null, null);
		if($match->num_rows() > 0){
			foreach($match->result() as $result){
				$idUser = $result->id_pengguna;
				$level = $result->level;
			}
			if($level==1){
				$query = $this->MAdmin->read(array('id_pengguna'=>$idUser));
				foreach($query->result() as $result){
					$nama = $result->nama_admin;
				}
			}else if($level==2){
				$query = $this->MDosen->read('dosen',array('id_pengguna'=>$idUser));
				foreach($query->result() as $result){
					$nama = $result->nama_dosen;
				}
			}else if($level==3){
				$query = $this->MMahasiswa->read('mahasiswa',array('id_pengguna'=>$idUser));
				foreach($query->result() as $result){
					$idpengguna = $result->id_pengguna;
					$nama = $result->nama_mahasiswa;
				}
			}else{
				show_404();
			}

			//set session
			$this->session->set_userdata('idpetta', $idUser);
			$this->session->set_userdata('idpengguna', $idpengguna);
			$this->session->set_userdata('levelpetta', $level);
			$this->session->set_userdata('namapetta', $nama);
			if($level==1){
				redirect(site_url('dashbor'));
			}else{
				redirect(site_url('tema'));
			}
		}else{
			redirect(site_url('?balasan=2'));
		}
	}

	public function logoutProcess(){
		$this->session->unset_userdata('idpetta');
		$this->session->unset_userdata('levelpetta');
		redirect(site_url(''));
	}

	public function getNotification(){
		$notif = $this->pullNotification();
		echo $notif;
	}
}