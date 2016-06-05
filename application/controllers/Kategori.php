<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends MY_Controller {
	public function __construct(){
		/*PENJELASAN
			load library dan model yang diperlukan	
		*/
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('MKategori');
	}

	public function data(){
		/*PENJELASAN
			load hal yang yang diperlukan ketika page di load	
		*/
		$data['menu04'] = true;
		$this->sessionOut(); //check session

		$data['query'] = $this->MKategori->read('kategori',null, 'nama_kategori', 'ASC');

		$this->load->view('layouts/header');
		$this->load->view('admin/kategori_list_page', $data);
		$this->load->view('layouts/footer');
	}

	public function tambah(){
		/*PENJELASAN
			fungsi untuk mengarahkan ke page kategori_tambah_page
		*/
		$data['menu04'] = true;
		$this->sessionOut(); //check session

		$this->load->view('layouts/header');
		$this->load->view('admin/kategori_tambah_page', $data);
		$this->load->view('layouts/footer');
	}

	public function insertKategori(){
		/*PENJELASAN
			fungsi menambahkan kategori baru	
		*/
		$namaKategori = $this->input->post('kategori');
		$data = array(
				'nama_kategori'=>$namaKategori
			);
		$insert = $this->MKategori->create($data);
		redirect(site_url('kategori/data?balasan=2'));
	}

	public function delete($id){
		/*PENJELASAN
			fungsi delete 	
		*/
		$delete = $this->MKategori->delete(array('id_kategori'=>$id));
			redirect(site_url('kategori/data?balasan=1'));	
	}
	public function cekData($table, $field, $data){
		/*PENJELASAN
			fungsi untuk cek data apakah sudah ada di database atau belum	
		*/
		$match = $this->MKategori->read($table, array($field=>$data), null, null);
		if($match->num_rows() > 0){
			$report = 2;
		}else{
			$report = 1;
		}
		echo $report;
	}
	public function getData($id){
		/*PENJELASAN
			mendapatkan nama dari kategori untuk di tampilkan
		*/
			$query = $this->MKategori->read('kategori', array('id_kategori'=>$id), null, null);
			foreach($query->result() as $result){
				$data = array(
					'nama_kategori'=>$result->nama_kategori
				);
			}
		header('Content-Type: application/json');
		echo json_encode($data);
	}

	public function update($id){
		/*PENJELASAN
			fungsi meng-update data kategori
		*/
		$kategori = $this->input->post('EditKategori');
		$data = array(
				'nama_kategori'=>$kategori
				);
		$update = $this->MKategori->update(array('id_kategori'=>$id),  $data);
		redirect(site_url('mahasiswa/data?balasan=1'));
	}
}