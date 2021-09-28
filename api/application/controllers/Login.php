<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
    }

    public function proses()
    {
        $this->form_validation->set_rules('nama', 'nama','trim|required|min_length[1]|max_length[255]');
		$this->form_validation->set_rules('password', 'Password','trim|required|min_length[1]|max_length[255]');

        $nama = $this->input->post('nama');
        $password = $this->input->post('password');

        if ($this->auth_model->login_user($nama, $password)) {
            $data_json = array('success' => TRUE, 'user' => $this->session->userdata('data'));
        } else {
            $data_json = array('success' => FALSE, 'user' => null);
        }

        echo json_encode($data_json);
    }

    public function logout()
    {
        $idUser = $this->input->post('idUser');
        $this->auth_model->setNoActive($idUser);
        $this->session->sess_destroy();
    }

    public function index()
    {
        echo 'ah ah ah';
    }
}
