<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tema extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
	}

	public function index(){
		$this->sessionOut();
		$data['menu1'] = true;
		//$this->sessionIn(); //check session
		$this->load->view('layouts/header');
		$this->load->view('home_page', $data);
		$this->load->view('layouts/footer');
	}
}