<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MDosen extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function create($data){
		$query = $this->db->insert('dosen', $data);
		return $query;
	}

	function read($cond, $ordField, $ordType){
		if($cond!=null){
			$this->db->where($cond);
		}
		if($ordField!=null){
			$this->db->order_by($ordField, $ordType);
		}
		$query = $this->db->get('dosen');
		return $query;
	}

	function update($cond, $data){
		$this->db->where($cond);
		$query = $this->db->update('dosen', $data);
		return $query;
	}

	function delete($cond){
		$this->db->where($cond);
		$query = $this->db->delete('dosen');
		return $query;
	}
}