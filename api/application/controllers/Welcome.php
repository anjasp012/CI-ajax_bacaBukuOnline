<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
    {
		parent::__construct();
        $this->load->database();
        $this->load->model('Home_model');
	}
    public function index()
    {
        $list_buku = $this->Home_model->get_buku();

        $arr_view = array(
            'list_buku' => $list_buku
        );

        $html_view = $this->load->view('buku', $arr_view, true);

        $data_json = array(
            'jumlah_buku' => $list_buku->num_rows(),
            'konten' => $html_view,
            'titel' => 'Homepage',
        );

        echo json_encode($data_json);
    }

    public function detail_buku()
    {
        $idbuku = $this->input->get('idbuku');
        $list_buku = $this->Home_model->get_buku($idbuku);
        $singel_buku = $list_buku->row();

        $arr_view = array(
            'list_buku' => $singel_buku
        );

        $html_view = $this->load->view('detailbuku', $arr_view, true);

        $data_json = array(
            'jumlah_buku' => $list_buku->num_rows(),
            'konten' => $html_view,
            'titel' => $singel_buku->judul,
        );

        echo json_encode($data_json);
    }
}