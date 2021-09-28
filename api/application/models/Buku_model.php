<?php defined('BASEPATH') or exit('No direct script access allowed');

class Buku_model extends CI_Model
{
    private $table = "tb_buku";

    public function getAll()
    {
        return $this->db->get($this->table)->result();
    }

    public function getById($idbuku)
    {
        $this->db->select('*');
        return $this->db->get_where($this->table, ["idbuku" => $idbuku])->row();
    }

    public function update($data, $idbuku)
    {
        $this->db->where('idbuku', $idbuku);
        $this->db->update("tb_buku", $data);
    }

    public function delete($idbuku)
    {
        $data = array(
            'deleted' => TRUE,
        );
        $this->db->where('idbuku', $idbuku);
        $this->db->update($this->table, $data);
    }

        public function hapus_buku($idbuku)
	{
		$this->db->where('idbuku', $idbuku);
		$this->db->delete($this->table);
	}

    public function add($data)
    {
        $this->db->insert($this->table, $data);
    }
}
