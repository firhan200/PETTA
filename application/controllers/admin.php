<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends MY_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('MAdmin');
	}

	public function index(){
		$data['tab3'] = true;
		$data['row'] = $this->Crud->read('kategori', null,null,null);
		$data['query'] = $this->Crud->readBarang('barang', null, 'idbarang', 'DESC');
		$this->load->view('admin/barang_halaman', $data);
	}

	//check the data whether already inserted or not
	public function cekData($table, $field, $data){
		$match = $this->Crud->read($table, array($field=>$data), null, null);
		if($match->num_rows() > 0){
			$report = 2;
		}else{
			$report = 1;
		}
		echo $report;
	}

	public function cekDataEdit($table, $field, $data, $dataOld){
		if($data!=$dataOld){
			$match = $this->Crud->read($table, array($field=>$data), null, null);
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

	//getData from databases
	public function getData($id){
		$query = $this->Crud->read('barang', array('idbarang'=>$id), null, null);
		foreach($query->result() as $result){
			$data = array('nama'=>$result->nama,
				'idkategori'=>$result->idkategori,
				'harga'=>$result->harga, 
				'stock'=>$result->stock,
				 'deskripsi'=>$result->deskripsi,
				  'foto'=>$result->foto);

			$data['foto'] = '<img src="'.base_url('assets/img/barang/'.$result->foto.'').'" class="img-responsive img-thumbnail" style="max-width:200px;max-height:200px">';
			
			$data['fotoNameOnly'] = $result->foto;
		}
		header('Content-Type: application/json');
		echo json_encode($data);
	}
	public function getPetugas($id){
		$query = $this->Crud->read('petugas', array('idpetugas'=>$id), null, null);
		foreach($query->result() as $result){
			$data = $result->nama;
		}
		echo $data;
	}

	public function create(){
		$this->sessionOut();
		if($this->session->userdata('levelpetta')!=2){ redirect($_SERVER['HTTP_REFERER']); }
		if(!empty($_SESSION['tag'])){
			$idUser = $this->session->userdata('idpetta');
			$judul = $this->input->post('judul');
			$keterangan = $this->input->post('keterangan');
			$date = gmdate("Y-m-d, H:i:s", time()+3600*7);
			$data = array('id_pengguna'=>$idUser, 'judul'=>$judul, 'keterangan'=>$keterangan, 'tanggal_post'=>$date, 'status_tema'=>0);
			$insert = $this->MTema->create($data);
			foreach($_SESSION['tag'] as $result){
				$dataTag = array('id_tema'=>$insert['id'], 'id_kategori'=>$result);
				$insertTag = $this->MTag->create($dataTag);
			}

			if($insert){
				unset($_SESSION['tag']);
				redirect(site_url('tema/detil/'.$insert['id']));
			}else{
				redirect(site_url('tema/tambah?balasan=2'));
			}
		}else{
			redirect(site_url('tema/tambah?balasan=3'));
		}
	}

	public function insertKategori(){
		$namaKategori = $this->input->post('kategori');
		$data = array(
				'kategori'=>$namaKategori
			);
		$insert = $this->MAdmin->create('kategori', $data);
		redirect(($_SERVER['HTTP_REFERER']), 'refresh');
	}
                                      
	//insert data into database
	public function insert(){
		$nama   = $this->input->post('nama');
		$harga  = $this->input->post('harga');
		$stock  = $this->input->post('stock');	
		$idkategori = $this->input->post('kategori');
		$deskripsi  = $this->input->post('deskripsi');
		//photo
		$photoName = gmdate("d-m-y-H-i-s", time()+3600*7).".jpg";
		$config['upload_path'] = './assets/img/barang';
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
			$data   = array('nama'=>$nama, 'harga'=>$harga, 'stock'=>$stock, 'idkategori'=>$idkategori,'foto'=>$photoName, 'deskripsi'=>$deskripsi, 'idpetugas'=>$this->session->userdata('iduser'));
			$insert = $this->Crud->create('barang', $data);
			if($insert){
				echo 1;
			}else{
				echo 2;
			}
		}//else kalo gagal
	}

	//update the database
	public function update($id){
		$nama   = $this->input->post('ubahnama');
		$stock  = $this->input->post('ubahstock');
		$harga  = $this->input->post('ubahharga');
		$idkategori = $this->input->post('ubahkategori');
		$deskripsi  = $this->input->post('ubahdeskripsi');

		if($_FILES['ubahfoto']['name']==""){
				$data = array('nama'=>$nama, 'stock'=>$stock, 'harga'=>$harga, 'idkategori'=>$idkategori, 'deskripsi'=>$deskripsi, 'idpetugas'=>$this->session->userdata('iduser'));
		}else{
			$photoName = gmdate("d-m-y-H-i-s", time()+3600*7).".jpg";
			$config['upload_path'] = './assets/img/barang';
			$config['allowed_types'] = 'gif||jpg||png';
			$config['max_size'] = '2048000';
			$config['file_name'] = $photoName;
			$this->load->library('upload',$config);
			if($this->upload->do_upload('ubahfoto')){			
				$upload = 1;
				$data = array('nama'=>$nama, 'stock'=>$stock, 'harga'=>$harga,'foto'=>$photoName, 'idkategori'=>$idkategori, 'deskripsi'=>$deskripsi, 'idpetugas'=>$this->session->userdata('iduser'));
			}
			else{
				$upload = 2;
			}
				$query = $this->Crud->read('barang', array('idbarang'=>$id), null, null);
				foreach($query->result() as $result){
				unlink('assets/img/barang/'.$result->foto.'');
			}
		}
		$update = $this->Crud->update(array('idbarang'=>$id), 'barang', $data);
		if($update){
			echo 1;
		}else{
			echo 2;
		}
	}
	//delete 
	public function delete($id){
		$query = $this->Crud->read('barang', array('idbarang'=>$id), null, null);
		foreach($query->result() as $result){
			unlink('assets/img/barang/'.$result->foto.'');
		}
		$delete = $this->Crud->delete(array('idbarang'=>$id), 'barang');
		redirect(($_SERVER['HTTP_REFERER']), 'refresh');
	}
	
}