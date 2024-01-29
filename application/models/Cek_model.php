<?php

class Cek_model extends Ci_model
{
	public function ambilData($where="")
	{
		return $this->db->query('SELECT id_produk, nama_produk, Hpokok, stok  FROM tb_produk'.$where)->row_array();
	}


	function cari_produk($key){
		$this->db->like('nama_produk', $key);
        $this->db->or_like('id_produk', $key );
		$this->db->or_like('barcode', $key);
        $this->db->order_by('nama_produk', 'ASC');
        $this->db->limit(5);
        return $this->db->get('tb_produk');
    }

}