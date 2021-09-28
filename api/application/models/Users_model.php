<?php defined('BASEPATH') or exit('No direct script access allowed');

class Users_model extends CI_Model
{
    private $table = "tb_user";

    public function getAll()
    {
        $this->db->where('deleted', 0);
        return $this->db->get($this->table)->result();
    }

    public function getById($id)
    {
        $this->db->select('id');
        $this->db->select('nama');
        $this->db->select('email');
        return $this->db->get_where($this->table, ["id" => $id])->row();
    }

    public function update($data, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function delete($id)
    {
        $data = array(
            'deleted' => TRUE,
        );
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
    }

    public function add($email, $password, $nama)
    {
        $data_user = array(
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'nama' => $nama
        );
        $this->db->insert('tb_user', $data_user);
    }
}
