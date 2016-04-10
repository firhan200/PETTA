<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('MMahasiswa');
	}

	public function minat_tema(){
		$this->sessionOut(); //check session
		
	}

	public function data(){
		$data['menu03'] = true;
		$this->sessionOut(); //check session

		$data['query'] = $this->MMahasiswa->read(null, 'nama_mahasiswa', 'ASC');

		$this->load->view('layouts/header');
		$this->load->view('admin/mahasiswa_list_page', $data);
		$this->load->view('layouts/footer');
	}

	public function tambah(){
		$data['menu03'] = true;
		$this->sessionOut(); //check session

		$this->load->view('layouts/header');
		$this->load->view('admin/mahasiswa_tambah_page', $data);
		$this->load->view('layouts/footer');
	}
}