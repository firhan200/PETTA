<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashbor extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
	}

	public function index(){
		$data['menu3'] = true;
		$data['submenu2'] = true;
		$this->sessionOut(); //check session

		$this->load->view('layouts/header');
		$this->load->view('admin/dashbor_page', $data);
		$this->load->view('layouts/footer');
	}
}