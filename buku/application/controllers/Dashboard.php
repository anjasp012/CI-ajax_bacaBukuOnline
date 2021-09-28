<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function index()
    {
        if ($this->session->userdata('is_login') && $this->session->userdata('role')) {
            $this->load->view('template/dashboard');
        } else {
            redirect('login');
        }
    }
}
