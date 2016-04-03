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
		//START ACTIVE QUERY
		//ISNERT INTO dosen Value $data
		//END ACTIVE QUERY
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
		//START ACTIVE QUERY
		//SELECT * FROM dosen WHERE=null ORDER BY nama_dosen ASC
		//END ACTIVE QUERY
	}

	function update($cond, $data){
		$this->db->where($cond);
		$query = $this->db->update('dosen', $data);
		return $query;
		//START ACTIVE QUERY
		//UPDATE dosen SET column1=value1, column2=value2 dst WHERE id=$id
		//END ACTIVE QUERY

		//Lihat di Controller Profil.php lengkapnya
		//UPDATE dosen SET email=$emailDSN, telepon=$teleponDSN WHERE id=$id
	}
	

	function delete($cond){
		$this->db->where($cond);
		$query = $this->db->delete('dosen');
		return $query;
		//DELETE FROM dosen WHERE id=$id
	}

	function getWali($table, $cond, $ordField, $ordType){
		$this->db->select('*');
		$this->db->from($table);
		$this->db->join('dosen', $table.'.id_pengguna = dosen.id_pengguna');
		$this->db->where('pengguna.id_pengguna ='.$this->session->userdata("idpetta"));
		$query = $this->db->get();
		return $query;
		//SELECT * FROM pengguna JOIN dosen ON pengguna.id_pengguna = dosen.id_pengguna WHERE pengguna.id_pengguna = dosen.id_pengguna
	}

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
}