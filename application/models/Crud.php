<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function create($table, $data){
		$query = $this->db->insert($table, $data);
		return $query;
	}

	function read($table, $cond, $ordField, $ordType){
		if($cond!=null){
			$this->db->where($cond);
		}
		if($ordField!=null){
			$this->db->order_by($ordField, $ordType);
		}
		$query = $this->db->get($table);
		return $query;
	}

	function readHari($table, $cond, $ordField, $ordType, $fieldLike, $like){
		if($cond!=null){
			$this->db->where($cond);
		}
		if($ordField!=null){
			$this->db->order_by($ordField, $ordType);
		}
		$this->db->like($fieldLike, $like);
		$query = $this->db->get($table);
		return $query;
	}

	function readBarang($table, $cond, $ordField, $ordType){
		$this->db->select('kategori.nama AS namak, barang.nama AS namab, petugas.nama AS namap, barang.idkategori, barang.harga, barang.stock, barang.last_update, barang.idbarang');
		$this->db->from($table);
		$this->db->join('petugas', $table.'.idpetugas = petugas.idpetugas');
		$this->db->join('kategori', $table.'.idkategori = kategori.idkategori');
		$query = $this->db->get();

		return $query;
	}

	function readDetailTransaksi($table, $cond, $ordField, $ordType){
		$this->db->select('barang.nama, detail_transaksi.jumlah, detail_transaksi.harga AS hargat, detail_transaksi.idbarang AS idbarang');
		$this->db->from($table);
		$this->db->join('barang', $table.".idbarang = barang.idbarang");
		if($cond!=null){
			$this->db->where($cond);
		}
		if($ordField!=null){
			$this->db->order_by($ordField, $ordType);
		}
		$query = $this->db->get();
		return $query;
	}

	function readTransaksi($table, $cond, $ordField, $ordType){
		$this->db->select('*');
		$this->db->from($table);
		$this->db->join('petugas', $table.".idpetugas = petugas.idpetugas");
		if($cond!=null){
			$this->db->where($cond);
		}
		if($ordField!=null){
			$this->db->order_by($ordField, $ordType);
		}
		$query = $this->db->get();
		return $query;
	}

	function getAllGroups(){
		$this->db->where('kategori',2);
	    $each = $this->db->get('petugas');  
		return $each->result();
	}
	
	function readPaging($table, $cond, $ordField, $ordType, $limit, $start){
		if($cond!=null){
			$this->db->where($cond);
		}
		if($ordField!=null){
			$this->db->order_by($ordField, $ordType);
		}
		$query = $this->db->get($table, $limit, $start);
		return $query;
	}

	function totalData($table){
		$query = $this->db->get($table);
		return $query->num_rows();
	}

	function update($cond, $table, $data){
		$this->db->where($cond);
		$query = $this->db->update($table, $data);
		return $query;
	}

	function delete($cond, $table){
		$this->db->where($cond);
		$query = $this->db->delete($table);
		return $query;
	}

	function email_exists($email)
	{
		$this->db->where('email', $email);
		$query = $this->db->get('petugas');
		if( $query->num_rows() > 0 ){ return TRUE; } else { return FALSE; }
	}
}