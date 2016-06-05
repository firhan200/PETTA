<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends MY_Controller {
	public function __construct(){
		/*PENJELASAN
			load lobrary dan model yang diperlukan
		*/
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('MDosen');
		$this->load->model('MMahasiswa');
	}

	public function index(){
		/*PENJELASAN
			membaca data dan melakukan redirect jika ada data yang belum di isi
			fungsi berjalan untuk ketika halaman terload
		*/
		$data['menu2'] = true;
		$this->sessionOut(); //check session
		$data["row"] = $this->MMahasiswa->getMhs('pengguna',null,null,null);
		$data["rowDsn"] = $this->MDosen->getWali('pengguna',null,null,null);
		$data['query'] = $this->MDosen->read('dosen',null, 'nama_dosen', 'ASC');
		//START ACTIVE QUERY
		//SELECT * FROM dosen WHERE=null ORDER BY nama_dosen ASC
		//END ACTIVE QUERY

		$this->load->view('layouts/header');
			if($this->session->userdata('levelpetta')==1){//admin
				$this->load->view('dosen_page', $data);
			}else if($this->session->userdata('levelpetta')==3){//mahasiswa
				$row = $this->MMahasiswa->getMhs('pengguna',null,null,null);
				foreach($row->result() as $result){
					if(($result->email==null) || ($result->telepon==null)){
						$this->load->view('verifikasi_page', $data);
					}else if ((!$result->email==null) && (!$result->telepon==null)){
						$this->load->view('dosen_page', $data);
					}
				}
			}else if ($this->session->userdata('levelpetta')==2){//dosen
				$rowDsn = $this->MDosen->getWali('pengguna',null,null,null);
				foreach($rowDsn->result() as $result){
					if(($result->email==null) || ($result->telepon==null)){
						$this->load->view('verifikasi_page', $data);
					}else if ((!$result->email==null) && (!$result->telepon==null)){
						$this->load->view('dosen_page', $data);
					}
				}
			}	
		$this->load->view('layouts/footer');
	}

	public function data(){
		/*PENJELASAN
			fungsi untuk menampilkan data dosen pada halaman dosen_list_page
		*/
		$data['menu02'] = true;
		$this->sessionOut(); //check session

		$data['query'] = $this->MDosen->read('dosen',null, 'nama_dosen', 'ASC');
		//START ACTIVE QUERY
		//SELECT * FROM dosen WHERE=null ORDER BY nama_dosen ASC
		//END ACTIVE QUERY

		$this->load->view('layouts/header');
		$this->load->view('admin/dosen_list_page', $data);
		$this->load->view('layouts/footer');
	}

	public function tambah(){
		/*PENJELASAN
			fungsi untuk mengarahkan pada halaman dosen_tambah_page
		*/
		$data['menu02'] = true;
		$this->sessionOut(); //check session

		$this->load->view('layouts/header');
		$this->load->view('admin/dosen_tambah_page', $data);
		$this->load->view('layouts/footer');
	}

	public function insertDosen(){
		/*PENJELASAN
			fungsi untuk menambahkan data dosen yang akan di gunakan apda form
		*/
		$username = $this->input->post('username');
		$password = sha1($this->input->post('password'));
		$data1 = array(
				'username'=>$username,
				'password'=>$password,
				'level'=>2,
			);
		/*$insert = $this->MMahasiswa->create('pengguna',$data1);*/
		$id_pengguna = $this->MDosen->create('pengguna',$data1);
		$nip = $this->input->post('nip');
		$nama = $this->input->post('nama');
		$email = $this->input->post('email');
		$telepon = $this->input->post('telepon');
		$data = array(
				'nip'=>$nip,
				'nama_dosen'=>$nama,
				'email'=>$email,
				'telepon'=>$telepon,
				'id_pengguna'=>$id_pengguna,
			);
		
		$insert1 = $this->MDosen->create('dosen',$data);
		redirect(site_url('dosen/data?balasan=1'));
	}
	public function delete($id){
		/*PENJELASAN
			fungsi delete dosen berdasarkan id dan men-delete foto dari databse sekaligus folder	
		*/
		$query = $this->MDosen->read('dosen',array('id_pengguna'=>$id), null, null); 
		foreach ($query->result_array() as $result) { 
		unlink('assets/img/dosen/'.$result['foto_dosen']); 
		}
		$this->db->delete('dosen',array('id_pengguna'=>$id));
		$this->db->delete('pengguna',array('id_pengguna'=>$id));
		redirect(site_url('dosen/data?balasan=2'));	
	}
	
	public function getData($id){
		/*PENJELASAN
			fungsi untuk mendapatkan data dari dosen yang bersangkutan
		*/
			$query = $this->MDosen->read('dosen', array('id'=>$id), null, null);
			foreach($query->result() as $result){
				$data = array(
					'nip'=>$result->nip,
					'nama_dosen'=>$result->nama_dosen,
					'email'=>$result->email,
					'telepon'=>$result->telepon,
					'foto_dosen'=>$result->foto_dosen
				);
				if($result->foto_dosen){
					$data['foto_dosen'] = '<img src="'.base_url('assets/img/dosen/'.$result->foto_dosen).'" class="circle responsive-image " style="max-width:300px;max-height:400px">';
					$data['fotoNameOnly'] = $result->foto_dosen;
				}else if(!$result->foto_dosen){
					$data['foto_dosen'] = '<img src="'.base_url('assets/img/dosen/noava.png').'" class="circle responsive-image " style="max-width:300px;max-height:400px">';
					$data['fotoNameOnly'] = $result->foto_dosen;
				}
				
			}
		header('Content-Type: application/json');
		echo json_encode($data);
	}

	public function update($id){
		/*PENJELASAN
			fungsi untuk mengupdate data dosen
		*/
		$nipDsn = $this->input->post('EditNip');
		$namaDsn = $this->input->post('EditNama');
		$emailDsn = $this->input->post('EditEmail');
		$teleponDsn = $this->input->post('EditTelepon');
		$data = array(
				'nip'=>$nipDsn,
				'nama_dosen'=>$namaDsn,
				'email'=>$emailDsn,
				'telepon'=>$teleponDsn
				);
		$update = $this->MDosen->update(array('id'=>$id),  $data);
		redirect(site_url('dosen/data?balasan=1'));
	}
	public function updateVerif($id){
		/*PENJELASAN
			fungsi untuk meng-update data diri yang sebelumnya kosong jika memang kosong
		*/
		$emailMhs = $this->input->post('EditEmail');
		$teleponMhs = $this->input->post('EditTelepon');
		$data = array(
				'email'=>$emailMhs,
				'telepon'=>$teleponMhs
				);
		$update = $this->MMahasiswa->update(array('id'=>$id),  $data);
		if($this->session->userdata('levelpetta')==1){
			redirect(site_url('mahasiswa/data?balasan=1'));
		}else if($this->session->userdata('levelpetta')==3){
			redirect(site_url('profil'));
		}
	}

	public function cekData($table,$field){
		/*PENJELASAN
			fungsi untuk men cek apakah data sudak ada pada tabel	
		*/
		$data = $this->input->get('value');
		$match = $this->MDosen->read($table,array($field=>$data), null, null);
		if($match->num_rows() > 0){
			$report = 2;
		}else{
			$report = 1;
		}
		echo $report;
	}

	public function cekDataEdit($table, $field, $data, $dataOld){
		/*PENJELASAN
			fungsi cek data jika sama pada data awal pada form maka tetap bisa di submit
		*/
		$data = $this->input->get('value');	
		if($data!=$dataOld){
			$match = $this->MDosen->read($table, array($field=>$data), null, null);
			if($match->num_rows() > 0){
				$report = 2;
			}else{
				$report = 1;
			}
		}else{
			$report = 1;
		}
		echo $report;
	}
}