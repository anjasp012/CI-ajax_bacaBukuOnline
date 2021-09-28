<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Buku extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
        $this->auth_model->cek_login();
        $this->load->model('buku_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->session->userdata('role') == 0) {
            echo 'mw ap lo?';
        }
    }

    public function list_buku()
    {
        $data = $this->buku_model->getAll();

        $konten = '<thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Judul</th>
            <th scope="col">Kategori</th>
            <th scope="col">Link</th>
            <th scope="col">Sinopsis</th>
            <th scope="col">Penerbit</th>
            <th scope="col">Tahun Terbit</th>
            <th scope="col">Penulis</th>
            <th scope="col"></th>
        </tr>
    </thead>';

        foreach ($data as $key => $val) {
            $konten .= '<tr>
            <th scope="row">' . ($key + 1) . '</th>
            <td>' . $val->judul . '</td>
            <td>' . $val->kategori . '</td>
            <td><a href="' . $val->link . '" class="btn btn-info">View</a></td>
            <td>' . $val->sinopsis . '</td>
            <td>' . $val->penerbit . '</td>
            <td>' . $val->tahun . '</td>
            <td>' . $val->penulis . '</td>
            <td align="right">
                <a href="#' . $val->id . '" class="btn btn-warning linkEdit">Edit</a>
                <a href="#' . $val->id . '" class="btn btn-danger linkHapus">Hapus</a>
            </td>
        </tr>';
        }

        echo json_encode($konten);
    }

    public function delete_buku()
    {
        $this->db->trans_start();

        $bukuId = $this->input->get('id');

        $this->buku_model->delete($bukuId);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $data_output = array('message' => 'Gagal!');
        } else {
            $this->db->trans_commit();
            $data_output = array('message' => 'Berhasil!');
        }

        echo json_encode($data_output);
    }

    public function detail_buku()
    {
        $id = $this->input->get('id');
        $data_detail = $this->buku_model->getById($id);

        if ($data_detail != null) {
            $data_output = array('success' => TRUE, 'detail' => $data_detail);
        } else {
            $data_output = array('success' => FALSE);
        }

        echo json_encode($data_output);
    }

    public function update_buku()
    {
        $this->form_validation->set_rules('judul', 'Judul', 'trim|required|min_length[1]|max_length[255]');
        $this->form_validation->set_rules('link', 'Link Pdf', 'trim');
        $this->form_validation->set_rules('sinopsis', 'Sinopsis', 'trim|required|min_length[1]|max_length[255]');
        $this->form_validation->set_rules('penerbit', 'Penerbit', 'trim|required|min_length[1]|max_length[255]');
        $this->form_validation->set_rules('kategori', 'Kategori', 'trim|required|min_length[1]|max_length[255]');
        $this->form_validation->set_rules('tahun', 'Tahun', 'trim|required');
        $this->form_validation->set_rules('penulis', 'Penulis', 'trim|required|min_length[1]|max_length[255]');
        $this->form_validation->set_rules('img', 'Image Url', 'trim');
        
        $this->db->trans_start();

        $id = $this->input->post('id');

        $arr_input = array(
            'judul' => $this->input->post('judul'),
            'link' => $this->input->post('link'),
            'sinopsis' => $this->input->post('sinopsis'),
            'penerbit' => $this->input->post('penerbit'),
            'kategori' => $this->input->post('kategori'),
            'tahun' => $this->input->post('tahun'),
            'penulis' => $this->input->post('penulis'),
            'img' => $this->input->post('img'),
        );

        $this->buku_model->update($arr_input, $id);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $data_output = array('success' => FALSE);
        } else {
            $this->db->trans_commit();
            $data_output = array('success' => TRUE);
        }

        echo json_encode($data_output);
    }

    public function add_buku()
    {
        $this->form_validation->set_rules('judul', 'Judul', 'trim|required|min_length[1]|max_length[255]');
        $this->form_validation->set_rules('link', 'Link Pdf', 'trim');
        $this->form_validation->set_rules('sinopsis', 'Sinopsis', 'trim|required|min_length[1]|max_length[255]');
        $this->form_validation->set_rules('penerbit', 'Penerbit', 'trim|required|min_length[1]|max_length[255]');
        $this->form_validation->set_rules('kategori', 'Kategori', 'trim|required|min_length[1]|max_length[255]');
        $this->form_validation->set_rules('tahun', 'Tahun', 'trim|required');
        $this->form_validation->set_rules('penulis', 'Penulis', 'trim|required|min_length[1]|max_length[255]');
        $this->form_validation->set_rules('img', 'Image Url', 'trim');

        if ($this->form_validation->run()) {
            $data = array(
                'judul' => $this->input->post('judul'),
                'link' => $this->input->post('link'),
                'sinopsis' => $this->input->post('sinopsis'),
                'penerbit' => $this->input->post('penerbit'),
                'kategori' => $this->input->post('kategori'),
                'tahun' => $this->input->post('tahun'),
                'penulis' => $this->input->post('penulis'),
                'img' => $this->input->post('img'),
            );

            $this->buku_model->add($data);
            $data_json = array('success' => 'TRUE', 'message' => 'Berhasil');
        } else {
            $data_json = array('success' => 'FALSE', 'message' => validation_errors());
        }

        echo json_encode($data_json);
    }
}
