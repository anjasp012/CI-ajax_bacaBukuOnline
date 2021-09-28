<?php

if (!defined('BASEPATH'))
    exit('No direct scr acss allowed');

class Home_model extends CI_Model
{
    public function get_buku($idbuku='')
    {
        $this->db->select('*');
        $this->db->from('tb_buku');

        if ($idbuku != '') {
            $this->db->where('tb_buku.idbuku', $idbuku);
        }
        return $this->db->get();
    }
}