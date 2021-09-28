<?php

class homepage extends CI_Controller
{
    public function index()
    {
        $this->load->model('Home_model');
        $tb_buku['buku'] = $this->Home_model->getAllData();
        $this->load->view('template/home', $tb_buku);
    }
}
