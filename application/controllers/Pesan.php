<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesan extends MY_Controller {
	public function __construct(){
		/*PENJELASAN
			load library dan model yang diperlukan 	
		*/
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('MPesan');
		$this->load->model('MDosen');
		$this->load->model('MMahasiswa');
		$this->load->model('MPengguna');
	}

	public function index(){
		/*PENJELASAN
			fungsi yang dijalankan ketika pertama kali page di load	
		*/
		$data['menu3'] = true;
		$data['submenu2'] = true;
		$this->sessionOut(); //check session
		$data['notif'] = $this->pullMsgNotification();
		$data["row"] = $this->MMahasiswa->getMhs('pengguna',null,null,null);
		$data["rowDsn"] = $this->MDosen->getWali('pengguna',null,null,null);
		$idUser = $this->session->userdata('idpetta');
		$data['query'] = $this->MPesan->read(array('id_penerima'=>$idUser, 'hapus'=>0), 'id_pesan', 'DESC');
		//config
		$data['date'] = $this->monthConverter();

		$this->load->view('layouts/header');
		if($this->session->userdata('levelpetta')==1){//admin
				$this->load->view('pesan_page', $data);
			}else if($this->session->userdata('levelpetta')==3){//mahasiswa
				$row = $this->MMahasiswa->getMhs('pengguna',null,null,null);
				foreach($row->result() as $result){
					if(($result->email==null) || ($result->telepon==null)){
						$this->load->view('verifikasi_page', $data);
					}else if ((!$result->email==null) && (!$result->telepon==null)){
						$this->load->view('pesan_page', $data);
					}
				}
			}else if ($this->session->userdata('levelpetta')==2){//dosen
				$rowDsn = $this->MDosen->getWali('pengguna',null,null,null);
				foreach($rowDsn->result() as $result){
					if(($result->email==null) || ($result->telepon==null)){
						$this->load->view('verifikasi_page', $data);
					}else if ((!$result->email==null) && (!$result->telepon==null)){
						$this->load->view('pesan_page', $data);
					}
				}
			}	
		$this->load->view('layouts/footer');
	}

	public function pesan_keluar(){
		/*PENJELASAN
			fungsi untuk cek pesan yang telah di kirim
		*/
		$data['menu3'] = true;
		$data['submenu3'] = true;
		$this->sessionOut(); //check session
		$data['notif'] = $this->pullMsgNotification();

		$idUser = $this->session->userdata('idpetta');
		$data['query'] = $this->MPesan->read(array('id_pengirim'=>$idUser, 'hapus2'=>0), 'id_pesan', 'DESC');
		//config
		$data['date'] = $this->monthConverter();

		$this->load->view('layouts/header');
		$this->load->view('pesan_page', $data);
		$this->load->view('layouts/footer');
	}

	public function pesan_baru(){
		/*PENJELASAN
			fungsi untuk membuat pesan	
		*/
		$data['menu3'] = true;
		$this->sessionOut(); //check session
		$data['notif'] = $this->pullMsgNotification();

		$level = $this->session->userdata('levelpetta');
		if($level==3){
			$data['for'] = 1;
			$data['receiverQuery'] = $this->MDosen->read('dosen',null, 'nama_dosen', 'ASC');
		}else{
			$data['for'] = 2;
			$data['receiverQuery'] = $this->MMahasiswa->read('mahasiswa',null, 'nama_mahasiswa', 'ASC');
		}

		$this->load->view('layouts/header');
		$this->load->view('pesan_baru_page', $data);
		$this->load->view('layouts/footer');
	}

	public function detil($id = null){
		/*PENJELASAN
			fungsi untuk melihat detail pesan	
		*/
		$data['menu3'] = true;
		$this->sessionOut(); //check session

		$idUser = $this->session->userdata('idpetta');
		$level = $this->session->userdata('levelpetta');
		$data['query'] = $this->MPesan->readMessageDetil($id, $idUser, $level);
		//config
		$data['date'] = $this->monthConverter();

		//remove notification
		$queryAll = $this->MPesan->read(array('id_pengirim'=>$id, 'id_penerima'=>$idUser, 'baca'=>0), null, null);
		foreach($queryAll->result() as $result){
			$this->addNotification($idUser, 'del');
		}
		//read
		$read = $this->MPesan->update(array('id_pengirim'=>$id, 'id_penerima'=>$idUser), array('baca'=>'1'));

		$this->load->view('layouts/header');
		$this->load->view('pesan_detil_page', $data);
		$this->load->view('layouts/footer');
	}

	public function hapus($id){
		/*PENJELASAN
			fungsi hapus pesan
		*/ 
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
		//cek valid pesan
		$queryPesan = $this->MPesan->read(array('id_penerima'=>$this->session->userdata('idpetta'), 'baca'=>0), null, null);
		if($queryPesan->num_rows() > 0){
			$this->addNotification($this->session->userdata('idpetta'), 'del');
			$this->MPesan->update(array('id_pesan'=>$id), array('baca'=>'1'));
		}
		echo $response;
	}

	public function kirim($segment = null){
		/*PENJELASAN
			fungsi untuk mengirim pesan 	
		*/
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
			$notify = $this->addNotification($receiver, 'add');
			if($notify){
				if($segment==null){
					redirect(site_url('pesan/detil/'.$receiver.''));
				}else{
					redirect(site_url('pesan/detil/'.$segment.''));
				}
			}else{
				redirect(site_url('pesan/pesan_baru?balasan=2'));
			}	
		}else{
			redirect(site_url('pesan/pesan_baru?balasan=2'));
		}
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
			fungsi untuk memberikan notifikasi	
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