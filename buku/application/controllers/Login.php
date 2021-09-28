<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function index()
    {
        if ($this->session->userdata('is_login')) {
            if ($this->session->userdata('role')) {
                redirect('dashboard');
            } else {
                redirect('Welcome');
            }
        } else {
            $this->load->view('auth/login');
        }
    }

    public function setFlashMessage()
    {
        $this->session->set_flashdata('error', 'Email & Password salah');
    }

    public function setSession()
    {
        $data = $this->input->post('data');

        if ($data == null) {
            $this->session->set_flashdata('error', 'Email & Password salah');
            $data_json = array('success' => 'FALSE');
        } else {
            $this->session->set_userdata('is_login', TRUE);
            $this->session->set_userdata('role', $data['role']);
            $this->session->set_userdata('nama', $data['nama']);
            $this->session->set_userdata('id', $data['id']);
            $data_json = array('success' => 'TRUE');
        }

        echo json_encode($data_json);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('welcome');
    }
}
