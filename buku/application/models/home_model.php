<?php

class home_model extends CI_Model{
    public function index()
	{
 		 $query = $this->db->get('tb_buku');
  		 return $query->result();
	}

	public function detail($idbuku)
	{
 		 $this->db->where('idbuku', $idbuku);
 		 $query = $this->db->get('tb_buku');
  		return $query->result();
	}

}