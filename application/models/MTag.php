<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MTag extends CI_Model{
	function __construct(){
		/*PENJELASAN
			meload library dan database

		*/
		parent::__construct();
		$this->load->database();
	}

	function create($data){
		/*PENJELASAN
			fungsi untuk memasukan data baru(insert)
			dengan 1 parameter yaitu data
			data kemudian akan di masukan kedalam tabel dose
		*/
		$query = $this->db->insert('tag', $data);
		return $query;
	}

	function read($cond, $ordField, $ordType){
		/*PENJELASAN
			fungsi untuk membaca data yang ada di dalam database table admin
			dengan 3 parameter yaitu $cond menyatakan WHERE klausa
			$ordfield, urutkan berdasarkan field apa dan
			$ordType, urutkan berdasarkan tipe data ASC atau DESC
		*/
		if($cond!=null){
			$this->db->where($cond);
		}
		if($ordField!=null){
			$this->db->order_by($ordField, $ordType);
		}
		$query = $this->db->get('tag');
		return $query;
	}

	function update($cond, $data){
		/*PENJELASAN
			Fungsi untuk meng-update data yang ada di dalam table dosen
			dengan 2 parameter, $cond untuk WHERE klausa dan $data untuk data
		*/
		$this->db->where($cond);
		$query = $this->db->update('tag', $data);
		return $query;
	}

	function delete($cond){
			/*PENJELASAN
			fungis untuk mendelete record pada table dosen
		*/
		$this->db->where($cond);
		$query = $this->db->delete('tag');
		return $query;
	}
}