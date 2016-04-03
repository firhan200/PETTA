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
		//INSERT INTO mahasiswa VALUE $data
		//cari di controller yang make fungsi create dari model MMahasiswa samakan parameter
		//kalau tidak ada abaikan 
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
		//SELECT * FROM mahasiswa WHERE=null ORDER BY nama_mahasiswa ASC
	}

	function update($cond, $data){
		$this->db->where($cond);
		$query = $this->db->update('mahasiswa', $data);
		return $query;
		//UPDATE mahasiswa SET $data
	}

	function delete($cond){
		$this->db->where($cond);
		$query = $this->db->delete('mahasiswa');
		return $query;
		//DELETE FROM mahasiswa WHERE id=$id
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