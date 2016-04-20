<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('MDosen');
	}

	public function index(){
		$data['menu2'] = true;
		$this->sessionOut(); //check session

		$data['query'] = $this->MDosen->read('dosen',null, 'nama_dosen', 'ASC');
		//START ACTIVE QUERY
		//SELECT * FROM dosen WHERE=null ORDER BY nama_dosen ASC
		//END ACTIVE QUERY

		$this->load->view('layouts/header');
		$this->load->view('dosen_page', $data);
		$this->load->view('layouts/footer');
	}

	public function data(){
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
		$data['menu02'] = true;
		$this->sessionOut(); //check session

		$this->load->view('layouts/header');
		$this->load->view('admin/dosen_tambah_page', $data);
		$this->load->view('layouts/footer');
	}

	public function insertDosen(){
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
		$this->db->delete('dosen',array('id_pengguna'=>$id));
		$this->db->delete('pengguna',array('id_pengguna'=>$id));
		redirect(site_url('dosen/data?balasan=2'));	
	}
	public function getData($id){
			$query = $this->MDosen->read('dosen', array('id'=>$id), null, null);
			foreach($query->result() as $result){
				$data = array(
					'nip'=>$result->nip,
					'nama_dosen'=>$result->nama_dosen,
					'email'=>$result->email,
					'telepon'=>$result->telepon
				);
			}
		header('Content-Type: application/json');
		echo json_encode($data);
	}

	public function update($id){
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
	public function cekData($table,$field, $data){
		$match = $this->MDosen->read($table,array($field=>$data), null, null);
		if($match->num_rows() > 0){
			$report = 2;
		}else{
			$report = 1;
		}
		echo $report;
	}
}