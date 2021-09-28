<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Buku extends CI_Controller
{
    public function index()
    {
        if ($this->session->userdata('is_login') && $this->session->userdata('role')) {
            $konten = $this->load->view('admin/buku/data-buku', null, true);

            $data_json = array(
                'konten' => $konten,
                'title' => 'List Data User',
            );

            echo json_encode($data_json);
        }
    }

    public function form_edit($idbuku)
    {
        if ($this->session->userdata('is_login') && $this->session->userdata('role')) {
            
            $konten = $this->load->view('admin/buku/edit-buku', array('idbuku' => $idbuku), true);

            $data_json = array(
                'konten' => $konten,
                'title' => 'Form Edit Buku',
                'id' => $idbuku,
            );

            echo json_encode($data_json);
        }
    }

    public function form_add()
    {
        if ($this->session->userdata('is_login') && $this->session->userdata('role')) {
            
            $konten = $this->load->view('admin/buku/add-buku',null, true);

            $data_json = array(
                'konten' => $konten,
                'title' => 'Form Tambah Buku',
            );

            echo json_encode($data_json);
        }
    }
}
