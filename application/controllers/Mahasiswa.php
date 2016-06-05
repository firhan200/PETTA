<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends MY_Controller {
	public function __construct(){
		/*PENJELASAN
			load library yang diperlukan	
		*/
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('MMahasiswa');
	}

	public function minat_tema(){
		/*PENJELASAN
			fungsi untuk meminati tema	
		*/
		$this->sessionOut(); //check session
	}

	public function data(){
		/*PENJELASAN
			fungsi untuk me load data mahasiswa
		*/
		$data['menu03'] = true;
		$this->sessionOut(); //check session

		$data['query'] = $this->MMahasiswa->read('mahasiswa',null, 'nama_mahasiswa', 'ASC');

		$this->load->view('layouts/header');
		$this->load->view('admin/mahasiswa_list_page', $data);
		$this->load->view('layouts/footer');
	}

	public function tambah(){
		/*PENJELASAN
			fungsi untuk mengarahkan apda halaman mahasiswa_tambah_page	
		*/
		$data['menu03'] = true;
		$this->sessionOut(); //check session

		$this->load->view('layouts/header');
		$this->load->view('admin/mahasiswa_tambah_page', $data);
		$this->load->view('layouts/footer');
	}
	public function insertMahasiswa(){
		/*PENJELASAN
			fungsi tambah mahasiswa	
		*/
		$username = $this->input->post('username');
		$password = sha1($this->input->post('password'));
		$data1 = array(
				'username'=>$username,
				'password'=>$password,
				'level'=>3,
			);
		/*$insert = $this->MMahasiswa->create('pengguna',$data1);*/
		$id_pengguna = $this->MMahasiswa->create('pengguna',$data1);
		$nim = $this->input->post('nim');
		$nama = $this->input->post('nama');
		$email = $this->input->post('email');
		$telepon = $this->input->post('telepon');
		$data = array(
				'nim'=>$nim,
				'nama_mahasiswa'=>$nama,
				'email'=>$email,
				'telepon'=>$telepon,
				'id_pengguna'=>$id_pengguna,
			);
		
		$insert1 = $this->MMahasiswa->create('mahasiswa',$data);
		redirect(site_url('mahasiswa/data?balasan=1'));
	}

	/*public function verifikasi($id){
		$query = $this->MMahasiswa->read('mahasiswa',array('id_pengguna'=>$id), null, null); 
		echo "<pre>"; print_r($query->result_array()); die;

		$emailMhs = $this->input->post('VerifEmail');
		$teleponMhs = $this->input->post('VerifTelepon');
		$data = array(
				'email'=>$emailMhs,
				'telepon'=>$teleponMhs
				);
		$insert = $this->MMahasiswa->update(array('id'=>$id),  $data);
		redirect(site_url('profil'));
	}*/

	public function delete($id){
		/*PENJELASAN
			fungsi delete mahasiswa	
		*/
		$this->db->delete('mahasiswa',array('id_pengguna'=>$id));
		$this->db->delete('pengguna',array('id_pengguna'=>$id));
		redirect(site_url('mahasiswa/data?balasan=2'));	
	}
	public function getData($id){
		/*PENJELASAN
			fungsi untuk mendapatkan data diri dari mahasiswa yang bersangkutan	
		*/
			$query = $this->MMahasiswa->read('mahasiswa', array('id'=>$id), null, null);
			foreach($query->result() as $result){
				$data = array(
					'nim'=>$result->nim,
					'nama_mahasiswa'=>$result->nama_mahasiswa,
					'email'=>$result->email,
					'telepon'=>$result->telepon
				);
			}
		header('Content-Type: application/json');
		echo json_encode($data);
	}

	public function update($id){
		/*PENJELASAN
			fungsi update	
		*/
		$nimMhs = $this->input->post('EditNim');
		$namaMhs = $this->input->post('EditNama');
		$emailMhs = $this->input->post('EditEmail');
		$teleponMhs = $this->input->post('EditTelepon');
		$data = array(
				'nim'=>$nimMhs,
				'nama_mahasiswa'=>$namaMhs,
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

	public function updateVerif($id){
		/*PENJELASAN
			fungsi ketika ada data yang kosong agar melengkapi data yang kosong	
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


	public function cekData($table, $field){
		/*PENJELASAN
			cek apakah data sudah ada di tabel	
		*/
		$data = $this->input->get('value');
		$match = $this->MMahasiswa->read($table, array($field=>$data), null, null);
		if($match->num_rows() > 0){
			$report = 2;
		}else{
			$report = 1;
		}
		echo $report;
	}
	public function cekDataEdit($table, $field, $data, $dataOld){
		/*PENJELASAN
			cek apakah data pertama di form sama dengan yang di database yang digunakan pada input pertama kali	
		*/
		$data = $this->input->get('value');	
		if($data!=$dataOld){
			$match = $this->MMahasiswa->read($table, array($field=>$data), null, null);
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