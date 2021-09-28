<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function index()
    {
        if ($this->session->userdata('is_login') && $this->session->userdata('role')) {
            $konten = $this->load->view('admin/user/data-user', null, true);

            $data_json = array(
                'konten' => $konten,
                'title' => 'List Data User',
            );

            echo json_encode($data_json);
        }
    }

    public function form_edit($id)
    {
        if ($this->session->userdata('is_login') && $this->session->userdata('role')) {
            
            $konten = $this->load->view('admin/user/edit-user', array('id' => $id), true);

            $data_json = array(
                'konten' => $konten,
                'title' => 'Form Edit User',
                'id' => $id,
            );

            echo json_encode($data_json);
        }
    }

    public function form_add()
    {
        if ($this->session->userdata('is_login') && $this->session->userdata('role')) {
            
            $konten = $this->load->view('admin/user/add-user',null, true);

            $data_json = array(
                'konten' => $konten,
                'title' => 'Form Tambah User',
            );

            echo json_encode($data_json);
        }
    }
}
