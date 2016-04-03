<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MPengguna extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function create($data){
		$query = $this->db->insert('pengguna', $data);
		return $query;
	}

	function read($cond, $ordField, $ordType){
		if($cond!=null){
			$this->db->where($cond);
		}
		if($ordField!=null){
			$this->db->order_by($ordField, $ordType);
		}
		$query = $this->db->get('pengguna');
		return $query;
	}

	function getNotification($id){
		$this->db->where('id_pengguna', $id);
		$query = $this->db->get('pengguna');
		foreach($query->result() as $result){
			$notification = $result->notifikasi;
		}
		return $notification;
		//SELECT * FROM pengguna WHERE id_pengguna=$id
	}

	function update($cond, $data){
		$this->db->where($cond);
		$query = $this->db->update('pengguna', $data);
		return $query;
	}

	function delete($cond){
		$this->db->where($cond);
		$query = $this->db->delete('pengguna');
		return $query;
	}
}