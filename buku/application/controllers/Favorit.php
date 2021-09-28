<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Favorit extends CI_Controller {

	function __construct()
	{
		parent::__construct();
        $this->load->model('favorit_model');
	}
	public function index()
	{
		$this->load->view('template/favorit');	
	}
	
	public function getIdUser($id){
		$data['favorit']=$this->favorit_model->get_favorite($id);
		$this->load->view('template/favorit',$data);
	}

	public function insert($idbuku,$id)
	{
		$data = $this->favorit_model->get_idfavorite($id);
		var_dump($data);
		if(empty($data))
		{
			$this->favorit_model->addFavorite($id,$idbuku);
			redirect('welcome','refresh');
		}
		else
		{
			foreach ($data as $key) 
		{
			$idbukuanyar = $key->id_bukufavorit;
			if($idbukuanyar==$idbuku)
			{
				echo "<script>alert('Komik sudah tersubscribe !');
							window.location.href='".site_url()."welcome';</script>";
			}
			else
			{
				$this->favorit_model->addFavorite($id,$idbuku);
				redirect('welcome','refresh');
			}
		}
		}
	}

	public function delete($idbuku,$id)
	{
        $this->favorit_model->deleteFavorite($id,$idbuku);
        redirect("Favorit/getIduser/$id");
	}
}

/* End of file Subscribe.php */
/* Location: ./application/controllers/Subscribe.php */