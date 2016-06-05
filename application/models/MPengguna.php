<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MPengguna extends CI_Model{
	function __construct(){
		/*PENJELASAN
			load library dan databse
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
		$query = $this->db->insert('pengguna', $data);
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
		$query = $this->db->get('pengguna');
		return $query;
	}

	function getNotification($id){
		/*PENJELASAN
			fungsi untuk mendapatkan notifikasi
			dengan parameter yang berguna agar notifikasi mengarah
			kepada pengguna yang tepat
		*/
		$this->db->where('id_pengguna', $id);
		$query = $this->db->get('pengguna');
		foreach($query->result() as $result){
			$notification = $result->notifikasi;
		}
		return $notification;
		//SELECT * FROM pengguna WHERE id_pengguna=$id
	}

	function update($cond, $data){
		/*PENJELASAN
			Fungsi untuk meng-update data yang ada di dalam table dosen
			dengan 2 parameter, $cond untuk WHERE klausa dan $data untuk data
		*/
		$this->db->where($cond);
		$query = $this->db->update('pengguna', $data);
		return $query;
	}

	function delete($cond){
		/*PENJELASAN
			fungsi untuk men-delete data pada table dosen dengan 1 parameter
			untuk WHERE klausa
		*/ 
		$this->db->where($cond);
		$query = $this->db->delete('pengguna');
		return $query;
	}
}