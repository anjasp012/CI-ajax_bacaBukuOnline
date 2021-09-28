<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
    }

    public function index()
    {
        echo 'ah';
    }

    public function proses()
    {
		$this->form_validation->set_rules('nama', 'Nama','trim|required|min_length[1]|max_length[255]');
        $this->form_validation->set_rules('email', 'Email','trim|required|min_length[1]|max_length[255]|is_unique[tb_user.email]');
		$this->form_validation->set_rules('password', 'Password','trim|required|min_length[1]|max_length[255]');

		if ($this->form_validation->run())
	   	{
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$nama = $this->input->post('nama');
			$this->auth_model->register($email, $password, $nama);
            $data_json = array('success' => 'TRUE', 'message' => 'Berhasil');
		}
		else
		{
            $data_json = array('success' => 'FALSE', 'message' => validation_errors());
		}

        echo json_encode($data_json);
        
    }
}