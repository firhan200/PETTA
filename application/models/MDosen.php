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

	function getWali($table, $cond, $ordField, $ordType){
		$this->db->select('*');
		$this->db->from($table);
		$this->db->join('dosen', $table.'.id_pengguna = dosen.id_pengguna');
		$this->db->where('pengguna.id_pengguna ='.$this->session->userdata("idpetta"));
		$query = $this->db->get();
		return $query;
	}
	/*$this->session->userdata("levelpetta")==2*/

	function readAll($cond, $ordField, $ordType){
		$this->db->select('*');
		$this->db->from('pengguna');
		$this->db->join('dosen','pengguna.id_pengguna = dosen.id_pengguna');
		if($cond!=null){
			$this->db->where($cond);
		}
		if($ordField!=null){
			$this->db->order_by($ordField, $ordType);
		}
		$query = $this->db->get();
		return $query;
	}
	/*function getWali($table, $cond, $ordField, $ordType){
		$this->db->select('*');
		$this->db->from($table);
		$this->db->join('dosen', $table.'.kode_wali = dosen.kode_wali');
		$this->db->where('mahasiswa.kode_wali = dosen.kode_wali');
		$query = $this->db->get();
		return $query;
	}*/
}