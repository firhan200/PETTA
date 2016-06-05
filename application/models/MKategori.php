<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MKategori extends CI_Model{
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
		$query = $this->db->insert('kategori', $data);
		return $query;
		//INSERT INTO kategori column1=value1,column2=value2
		//lihat controlelr yang pake fungsi ini lihat arraynya itu yang di masukin liat dosen untuk lebih jelas bagian update
	}

	function read($table,$cond, $ordField, $ordType){
		/*PENJELASAN
			fungsi untuk membaca data pada table dengan 4 parameter
			parameter 1 untuk menentukan table apa yang ingin di baca
			parameter 2 untuk WHERE klausa
			parameter 3 untuk mengurutkan data berdasarkan field apa
			parameter 4 untuk mengurutkan data berdasarkan Tipe ASC or DESC
		*/
		if($cond!=null){
			$this->db->where($cond);
		}
		if($ordField!=null){
			$this->db->order_by($ordField, $ordType);
		}
		$query = $this->db->get($table);
		return $query;
		//SELECT * FROM kategori WHERE=null ORDER BY nama_kategori ASC
		//cari di controller yang menggunakan fungsi read lihat parameter dan samakan
		//ini ada di controller tema
	}

	function update($cond, $data){
		/*PENJELASAN
			fungsi untuk update data pada table
			parameter 1 WHERE klausa
			parameter 2 untuk data yang ingin di update
			hasil akan mengupdate pada table dosen
		*/
		$this->db->where($cond);
		$query = $this->db->update('kategori', $data);
		return $query;
	}

	function delete($cond){
		/*PENJELASAN
			fungsi untuk men-delete data pada table dosen dengan 1 parameter
			untuk WHERE klausa
		*/
		$this->db->where($cond);
		$query = $this->db->delete('kategori');
		return $query;
	}
}