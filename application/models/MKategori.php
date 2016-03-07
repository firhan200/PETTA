<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MKategori extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function create($data){
		$query = $this->db->insert('kategori', $data);
		return $query;
	}

	function createTag($data){
		$query = $this->db->insert('tag', $data);
		return $query;
	}

	function read($cond, $ordField, $ordType){
		if($cond!=null){
			$this->db->where($cond);
		}
		if($ordField!=null){
			$this->db->order_by($ordField, $ordType);
		}
		$query = $this->db->get('kategori');
		return $query;
	}

	function update($cond, $data){
		$this->db->where($cond);
		$query = $this->db->update('kategori', $data);
		return $query;
	}

	function delete($cond){
		$this->db->where($cond);
		$query = $this->db->delete('kategori');
		return $query;
	}
}