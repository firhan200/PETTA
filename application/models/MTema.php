<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MTema extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function create($data){
		$data['query'] = $this->db->insert('tema', $data);
		$data['id'] = $this->db->insert_id();
		return $data;
	}

	function read($cond, $ordField, $ordType){
		if($cond!=null){
			$this->db->where($cond);
		}
		if($ordField!=null){
			$this->db->order_by($ordField, $ordType);
		}
		$query = $this->db->get('tema');
		return $query;
	}

	function readAll($cond, $ordField, $ordType){
		$this->db->select('*');
		$this->db->from('tema');
		$this->db->join('dosen','tema.id_pengguna = dosen.id_pengguna');
		if($cond!=null){
			$this->db->where($cond);
		}
		if($ordField!=null){
			$this->db->order_by($ordField, $ordType);
		}
		$query = $this->db->get();
		return $query;
	}

	function readTemaPersonal($id){
		$query = $this->db->query("SELECT * FROM tema T, dosen D WHERE T.id_pengguna=D.id_pengguna AND T.id_pengguna=".$id." ORDER BY T.id_tema DESC");
		return $query;
	}

	function readDetil($id){
		$query = $this->db->query("SELECT * FROM tema T, dosen D WHERE T.id_pengguna=D.id_pengguna AND T.id_tema=".$id."");
		return $query;
	}

	function update($cond, $data){
		$this->db->where($cond);
		$query = $this->db->update('tema', $data);
		return $query;
	}

	function delete($cond){
		$this->db->where($cond);
		$query = $this->db->delete('tema');
		return $query;
	}
}