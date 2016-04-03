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
		//INSERT INTO kategori column1=value1,column2=value2
		//lihat controlelr yang pake fungsi ini lihat arraynya itu yang di masukin liat dosen untuk lebih jelas bagian update
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
		//SELECT * FROM kategori WHERE=null ORDER BY nama_kategori ASC
		//cari di controller yang menggunakan fungsi read lihat parameter dan samakan
		//ini ada di controller tema
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