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

		$data['query'] = $this->MDosen->read(null, 'nama_dosen', 'ASC');

		$this->load->view('layouts/header');
		$this->load->view('dosen_page', $data);
		$this->load->view('layouts/footer');
	}
}