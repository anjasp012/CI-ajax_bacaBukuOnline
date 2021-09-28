<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    private $table = "tb_user";

    function register($email, $password, $nama)
    {
        $data_user = array(
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'nama' => $nama
        );
        $this->db->insert('tb_user', $data_user);
    }

    function login_user($nama, $password)
    {
        $query = $this->db->get_where($this->table, array('nama' => $nama, 'deleted' => FALSE));
        if ($query->num_rows() > 0) {
            $data_user = $query->row();
            $data = array(
                'nama'  => $data_user->nama,
                'email'     => $data_user->email,
                'role'     => $data_user->role,
                'id'     => $data_user->id,
            );

            if (password_verify($password, $data_user->password)) {
                $this->session->set_userdata('data', $data);
                $this->setActive($data_user->id);
                $this->session->set_userdata('is_login', TRUE);
                $this->session->set_userdata('role', $data_user->role);
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    function setActive($id)
    {
        $data = array(
            'active' => TRUE,
        );
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
    }

    function setNoActive($id)
    {
        $data = array(
            'active' => FALSE,
        );
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
    }

    function cek_login()
    {
        if (empty($this->session->userdata('is_login'))) {
            redirect('http://localhost/buku/login', 'refresh');
        }
    }
}
