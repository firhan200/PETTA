<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('MPeminatan');
	}

	public function minat_tema(){
		$this->sessionOut(); //check session
		
	}
}