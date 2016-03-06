<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->driver('session');
		$this->load->helper('url');
	}
	
	public function sessionIn(){
		if($this->session->userdata('idpetta')!=null){
			if($this->session->userdata('levelaks')==1){
				redirect('admin/dashbor', 'refresh');
			}else{
				redirect('tema', 'refresh');
			}
		}
	}
	
	public function sessionOut(){
		if($this->session->userdata('idpetta')==null){
			redirect('', 'refresh');
		}
	}
}
?>