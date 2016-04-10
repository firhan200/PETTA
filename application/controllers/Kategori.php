<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('MKategori');
	}

	public function data(){
		$data['menu04'] = true;
		$this->sessionOut(); //check session

		$data['query'] = $this->MKategori->read(null, 'nama_kategori', 'ASC');

		$this->load->view('layouts/header');
		$this->load->view('admin/kategori_list_page', $data);
		$this->load->view('layouts/footer');
	}

	public function tambah(){
		$data['menu04'] = true;
		$this->sessionOut(); //check session

		$this->load->view('layouts/header');
		$this->load->view('admin/kategori_tambah_page', $data);
		$this->load->view('layouts/footer');
	}
}