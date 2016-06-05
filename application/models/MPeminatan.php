<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MPeminatan extends CI_Model{
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
		$query = $this->db->insert('peminatan', $data);
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
		$query = $this->db->get('peminatan');
		return $query;
	}

	function readRiwayat($cond){
		/*PENJELASAN
			fungsi untuk membaca mahasiswa mana yang meminati tema mana
			1 parameter untuk WHERE klausa
		*/
		$this->db->select('*');
		$this->db->select('mahasiswa.id_pengguna as id_mahasiswa');
		$this->db->from('peminatan');
		$this->db->join('mahasiswa','peminatan.id_pengguna = mahasiswa.id_pengguna');
		$this->db->join('tema','peminatan.id_tema = tema.id_tema');
		if($cond!=null){
			$this->db->like($cond);
		}
		$this->db->order_by('peminatan.id', 'DESC');
		$query = $this->db->get();
		return $query;
		//SELECT * FROM peminatan JOIN mahasiswa ON peminatan.id_pengguna = mahasiswa.id_pengguna
		//JOIN tema on peminatan.id_tema = tema.id_tema WHERE tema.id_pengguna=$iduser ORDER BY peminatan.id DESC
	}

	function update($cond, $data){
		/*PENJELASAN
			Fungsi untuk meng-update data yang ada di dalam table dosen
			dengan 2 parameter, $cond untuk WHERE klausa dan $data untuk data
		*/
		$this->db->where($cond);
		$query = $this->db->update('peminatan', $data);
		return $query;
	}

	function delete($cond){
		/*PENJELASAN
			fungis untuk mendelete record pada table dosen
		*/
		$this->db->where($cond);
		$query = $this->db->delete('peminatan');
		return $query;
	}
}