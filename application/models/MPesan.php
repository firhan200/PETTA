<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MPesan extends CI_Model{
	function __construct(){
		/*PENJELASAN
			load database dan library yang di perlukan
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
		$query = $this->db->insert('pesan', $data);
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
		$query = $this->db->get('pesan');
		return $query;
	}

	function readMessageDetil($user, $self, $level){
		/*PENJELASAN
			fungsi untuk membaca detail pesan dengan 3 parameter
			parameter 1 untuk menunjukkan identitas pengirim dan penerima
			parameter 2 untuk menunjukkan identitas diri
			parameter 3 untuk menunjukkan apakaj dosen mahasiswa atau admin yang menerima
		*/
		$query = $this->db->query("SELECT * FROM pesan WHERE (id_penerima=".$user." OR id_pengirim=".$user.") AND (id_penerima=".$self." OR id_pengirim=".$self.") AND (hapus=0 OR level=".$level.") ORDER BY id_pesan ASC");
		return $query;
		//SELECT * FROM pesan WHERE (id_penerima=$user OR id_pengirim=$user) AND (id_penerima = $self OR id_pengirim=$self) AND(hapus = 0 OR level = $level) ORDER BY id_pesan ASC
	}

	function update($cond, $data){
		/*PENJELASAN
			Fungsi untuk meng-update data yang ada di dalam table dosen
			dengan 2 parameter, $cond untuk WHERE klausa dan $data untuk data
		*/
		$this->db->where($cond);
		$query = $this->db->update('pesan', $data);
		return $query;
	}

	function delete($cond){
		/*PENJELASAN
			fungis untuk mendelete record pada table dosen
		*/
		$this->db->where($cond);
		$query = $this->db->delete('pesan');
		return $query;
	}
}