<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MMahasiswa extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function create($data){
		$query = $this->db->insert('mahasiswa', $data);
		return $query;
	}

	function read($cond, $ordField, $ordType){
		if($cond!=null){
			$this->db->where($cond);
		}
		if($ordField!=null){
			$this->db->order_by($ordField, $ordType);
		}
		$query = $this->db->get('mahasiswa');
		return $query;
	}

	function update($cond, $data){
		$this->db->where($cond);
		$query = $this->db->update('mahasiswa', $data);
		return $query;
	}

	function delete($cond){
		$this->db->where($cond);
		$query = $this->db->delete('mahasiswa');
		return $query;
	}
	function getMhs($table, $cond, $ordField, $ordType){
		$this->db->select('*');
		$this->db->from($table);
		$this->db->join('mahasiswa', $table.'.id_pengguna = mahasiswa.id_pengguna');
		$this->db->where('pengguna.id_pengguna ='.$this->session->userdata("idpetta"));
		$query = $this->db->get();
		return $query;
	}
}