<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MPesan extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function create($data){
		$query = $this->db->insert('pesan', $data);
		return $query;
	}

	function read($cond, $ordField, $ordType){
		if($cond!=null){
			$this->db->where($cond);
		}
		if($ordField!=null){
			$this->db->order_by($ordField, $ordType);
		}
		$query = $this->db->get('pesan');
		return $query;
	}

	function readMessageDetil($user, $self, $level){
		$query = $this->db->query("SELECT * FROM pesan WHERE (id_penerima=".$user." OR id_pengirim=".$user.") AND (id_penerima=".$self." OR id_pengirim=".$self.") AND (hapus=0 OR level=".$level.") ORDER BY id_pesan ASC");
		return $query;
		//SELECT * FROM pesan WHERE (id_penerima=$user OR id_pengirim=$user) AND (id_penerima = $self OR id_pengirim=$self) AND(hapus = 0 OR level = $level) ORDER BY id_pesan ASC
	}

	function update($cond, $data){
		$this->db->where($cond);
		$query = $this->db->update('pesan', $data);
		return $query;
	}

	function delete($cond){
		$this->db->where($cond);
		$query = $this->db->delete('pesan');
		return $query;
	}
}