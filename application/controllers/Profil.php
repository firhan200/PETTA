<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
	}

	public function index(){
		$data['menu4'] = true;
		//$this->sessionIn(); //check session
		$this->load->view('layouts/header');
		$this->load->view('profil_page', $data);
		$this->load->view('layouts/footer');
	}
}