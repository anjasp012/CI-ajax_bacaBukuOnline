<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{
    public function index()
    {
        if ($this->session->userdata('is_login')) {
            if ($this->session->userdata('role')) {
                redirect('dashboard');
            } else {
                redirect('home');
            }
        } else {
            $this->load->view('auth/register');
        }
    }

    public function setSession()
    {
        $success = $this->input->post('success');
        $message = $this->input->post('message');

        if ($success == 'TRUE') {
            $this->session->set_flashdata('success', $message);
        } else {
            $this->session->set_flashdata('error', $message);
        }

        echo $success;
    }
}
