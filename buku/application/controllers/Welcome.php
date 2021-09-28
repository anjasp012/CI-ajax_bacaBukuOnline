<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
    public function index()
	{
		$this->load->model('home_model');
		$data["tb_buku"] = $this->home_model->index();
		$this->load->view('template/home',$data);
	}

	public function detail($id)
	{
		$this->load->model('home_model');
		$data["tb_buku"] = $this->home_model->detail($id);
		$this->load->view('template/detail',$data);
	}
}
