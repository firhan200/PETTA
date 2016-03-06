<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesan extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
	}

	public function index(){
		$data['menu3'] = true;
		//$this->sessionIn(); //check session
		$this->load->view('layouts/header');
		$this->load->view('pesan_page', $data);
		$this->load->view('layouts/footer');
	}

	public function pesan_baru(){
		$data['menu3'] = true;
		//$this->sessionIn(); //check session
		$this->load->view('layouts/header');
		$this->load->view('pesan_baru_page', $data);
		$this->load->view('layouts/footer');
	}
}