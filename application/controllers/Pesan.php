<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesan extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('MPesan');
		$this->load->model('MDosen');
		$this->load->model('MMahasiswa');
	}

	public function index(){
		$data['menu3'] = true;
		$data['submenu2'] = true;
		$this->sessionOut(); //check session

		$idUser = $this->session->userdata('idpetta');
		$data['query'] = $this->MPesan->read(array('id_penerima'=>$idUser, 'hapus'=>0), 'id_pesan', 'DESC');
		//config
		$data['date'] = $this->monthConverter();

		$this->load->view('layouts/header');
		$this->load->view('pesan_page', $data);
		$this->load->view('layouts/footer');
	}

	public function pesan_keluar(){
		$data['menu3'] = true;
		$data['submenu3'] = true;
		$this->sessionOut(); //check session

		$idUser = $this->session->userdata('idpetta');
		$data['query'] = $this->MPesan->read(array('id_pengirim'=>$idUser, 'hapus2'=>0), 'id_pesan', 'DESC');
		//config
		$data['date'] = $this->monthConverter();

		$this->load->view('layouts/header');
		$this->load->view('pesan_page', $data);
		$this->load->view('layouts/footer');
	}

	public function pesan_baru(){
		$data['menu3'] = true;
		$this->sessionOut(); //check session

		$level = $this->session->userdata('levelpetta');
		if($level==3){
			$data['for'] = 1;
			$data['receiverQuery'] = $this->MDosen->read(null, 'nama_dosen', 'ASC');
		}else{
			$data['for'] = 2;
			$data['receiverQuery'] = $this->MMahasiswa->read(null, 'nama_mahasiswa', 'ASC');
		}

		$this->load->view('layouts/header');
		$this->load->view('pesan_baru_page', $data);
		$this->load->view('layouts/footer');
	}

	public function detil($id = null){
		$data['menu3'] = true;
		$this->sessionOut(); //check session

		$idUser = $this->session->userdata('idpetta');
		$level = $this->session->userdata('levelpetta');
		$data['query'] = $this->MPesan->readMessageDetil($id, $idUser, $level);
		//config
		$data['date'] = $this->monthConverter();

		$this->load->view('layouts/header');
		$this->load->view('pesan_detil_page', $data);
		$this->load->view('layouts/footer');
	}

	public function hapus($id){
		$cek = $this->MPesan->read(array('id_pesan'=>$id), null, null);
		if($cek->num_rows() > 0){
			//cek sender
			foreach($cek->result() as $result){
				$sender = $result->id_pengirim;
			}
			if($this->session->userdata('idpetta')==$sender){
				$hide = $this->MPesan->update(array('id_pesan'=>$id), array('hapus2'=>1));
				if($hide){
					$response = 1;
				}else{
					$response = 2;
				}
			}else{
				$hide = $this->MPesan->update(array('id_pesan'=>$id), array('hapus'=>1));
				if($hide){
					$response = 1;
				}else{
					$response = 2;
				}
			}
		}else{
			$response = 2;
		}
		echo $response;
	}

	public function kirim($segment = null){
		$sender = $this->session->userdata('idpetta');
		if($segment==null){
			$receiver = $this->input->post('penerima');
		}else{
			$receiver = $segment;
		}
		$message = $this->input->post('pesan');
		$date = gmdate("Y-m-d, H:i:s", time()+3600*7);
		$level = $this->session->userdata('levelpetta');
		$data = array('id_pengirim'=>$sender, 'id_penerima'=>$receiver, 'pesan'=>$message, 'tanggal'=>$date, 'level'=>$level);
		$insert = $this->MPesan->create($data);
		if($insert){
			if($segment==null){
				redirect(site_url('pesan/detil/'.$receiver.''));
			}else{
				redirect(site_url('pesan/detil/'.$segment.''));
			}
		}else{
			redirect(site_url('pesan/pesan_baru?balasan=2'));
		}
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