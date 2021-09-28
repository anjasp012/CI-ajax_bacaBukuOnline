<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Favorit_model extends CI_Model {

	function get_subscribe(){
        $hasil=$this->db->get('tb_buku');
        return $hasil->result();
    }

    function get_favorite($id){
    	$query = $this->db->query("Select f.id_bukufavorit,k.cover,k.judul FROM favorit as f INNER JOIN tb_buku as k ON f.id_bukufavorit = k.idbuku WHERE f.id = ".$id);
		return $query->result();
    }

    function addFavorite($id,$idbuku)
    {
    	$object =  array(
				'id' => $id,
				'id_bukufavorit' => $idbuku
			);
			$this->db->insert('favorit', $object);
    }

    function deleteFavorite($id,$idbuku)
    {
    	$this->db->where('id', $id);
    	$this->db->where('id_bukufavorit', $idbuku);
        $this->db->delete('favorit');
    }

    function get_idfavorite($id){
        $query = $this->db->query("Select id_bukufavorit FROM favorit WHERE id = ".$id);
        return $query->result();
    }

}

/* End of file subscribe_model.php */
/* Location: ./application/models/subscribe_model.php */