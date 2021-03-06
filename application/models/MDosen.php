<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MDosen extends CI_Model{
	function __construct(){
		/*PENJELASAN
			load library dan databse
		*/
		parent::__construct();
		$this->load->database();
	}

	function create($table,$data){
		/*PENJELASAN
			fungsi untuk memasukan data baru dengan 2 parameter
			parameter 1 untuk tujuan table, parameter 2 untuk data 
			apa yang ingin dimasukkan, kemudian peng-insertan ini akan memasukan
			id si peng-insert
		*/
		$query = $this->db->insert($table, $data);
		return $this->db->insert_id();
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
		//START ACTIVE QUERY
		//SELECT * FROM dosen WHERE=null ORDER BY nama_dosen ASC
		//END ACTIVE QUERY
	}

	function update($cond, $data){
		/*PENJELASAN
			fungsi untuk update data pada table
			parameter 1 WHERE klausa
			parameter 2 untuk data yang ingin di update
			hasil akan mengupdate pada table dosen
		*/
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
		/*PENJELASAN
			fungsi untuk men-delete data pada table dosen dengan 1 parameter
			untuk WHERE klausa
		*/
		$this->db->where($cond);
		$query = $this->db->delete('dosen');
		return $query;
		//DELETE FROM dosen WHERE id=$id
	}

	function getWali($table, $cond, $ordField, $ordType){
		/*PENJELASAN
			fungsi untuk mendapatkan data dosen diri sendiri untuk digunakan apda my profile
			parameter 1 untuk table yang di inginkan untuk di dapat datanya
			parameter 2 untuk WHERE klausa
			parameter 3 untuk urut berdasarkan data yang mana
			parameter 4 untuk urut berdasarkan tipe ASC or DESC
		*/
		$this->db->select('*');
		$this->db->from($table);
		$this->db->join('dosen', $table.'.id_pengguna = dosen.id_pengguna');
		$this->db->where('pengguna.id_pengguna ='.$this->session->userdata("idpetta"));
		$query = $this->db->get();
		return $query;
		//SELECT * FROM pengguna JOIN dosen ON pengguna.id_pengguna = dosen.id_pengguna WHERE pengguna.id_pengguna = dosen.id_pengguna
	}

	function readAll($cond, $ordField, $ordType){
		/*PENJELASAN
			fungsi untuk membaca semua data yang diperlukan
			3 parameter
			parameter 1 untuk WHERE klausa
			parameter 2 untuk urut berdasarkan data yang mana
			parameter 3 untuk urut berdasarkan tipe ASC or DESC
		*/
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