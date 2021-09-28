<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Buku extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
        $this->auth_model->cek_login();
        $this->load->model('Buku_model');
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
        $data = $this->Buku_model->getAll();

        $konten = '<thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Cover</th>
            <th scope="col">Judul</th>
            <th scope="col">Link</th>
            <th scope="col">Penerbit</th>
            <th scope="col">Tahun Terbit</th>
            <th scope="col">Penulis</th>
            <th scope="col"></th>
        </tr>
    </thead>';

        foreach ($data as $key => $val) {
            $konten .= '<tr>
            <th scope="row">' . ($key + 1) . '</th>
            <td><img src="http://localhost/api/foto/'. $val->idbuku.'/'. $val->cover.'" width="40" height="40"></td>
            <td>' . $val->judul . '</td>
            <td><a href="' . $val->link . '" class="btn btn-info">View</a></td>
            <td>' . $val->penerbit . '</td>
            <td>' . $val->tahun . '</td>
            <td>' . $val->penulis . '</td>
            <td align="right">
                <a href="#' . $val->idbuku . '" class="btn btn-warning linkEdit">Edit</a>
                <a href="#' . $val->idbuku . '" class="btn btn-danger linkHapus">Hapus</a>
            </td>
        </tr>';
        }

        echo json_encode($konten);
    }

    public function delete_buku()
    {
        $this->db->trans_start();

        $bukuId = $this->input->get('idbuku');

        $this->Buku_model->hapus_buku($bukuId);

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
        $id = $this->input->get('idbuku');
        $data_detail = $this->Buku_model->getById($id);

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
        $this->form_validation->set_rules('link', 'Link PDF', 'trim');
        $this->form_validation->set_rules('penerbit', 'Penerbit', 'trim|required|min_length[1]|max_length[255]');
        $this->form_validation->set_rules('penulis', 'Penulis', 'trim|required|min_length[1]|max_length[255]');

        if ($this->form_validation->run()) {

            // $this->db->trans_start();

            $arr = array(
                'judul' => $this->input->post('judul'),
                'link' => $this->input->post('link'),
                'sinopsis' => $this->input->post('sinopsis'),
                'penerbit' => $this->input->post('penerbit'),
                'tahun' => $this->input->post('tahun'),
                'penulis' => $this->input->post('penulis'),
            );
            $idbuku = $this->input->post('idbuku');
            
            $this->Buku_model->update($arr, $idbuku);

            

            if ($_FILES != null) {
                $this->upload_foto($idbuku, $_FILES);
            }

            $data_json = array('success' => 'TRUE', 'message' => 'Berhasil');
        } else {
            $data_json = array('success' => 'FALSE', 'message' => validation_errors());
        }

        echo json_encode($data_json);
    }

    public function add_buku()
    {
        $this->form_validation->set_rules('judul', 'Judul', 'trim|required|min_length[1]|max_length[255]');
        $this->form_validation->set_rules('link', 'Link PDF', 'trim');
        $this->form_validation->set_rules('penerbit', 'Penerbit', 'trim|required|min_length[1]|max_length[255]');
        $this->form_validation->set_rules('penulis', 'Penulis', 'trim|required|min_length[1]|max_length[255]');

        if ($this->form_validation->run()) {

            // $this->db->trans_start();

            $arr = array(
                'judul' => $this->input->post('judul'),
                'link' => $this->input->post('link'),
                'sinopsis' => $this->input->post('sinopsis'),
                'penerbit' => $this->input->post('penerbit'),
                'tahun' => $this->input->post('tahun'),
                'penulis' => $this->input->post('penulis'),
            );

            $this->Buku_model->add($arr);

            $idbuku = $this->db->insert_id();
            

            if ($_FILES != null) {
                $this->upload_foto($idbuku, $_FILES);
            }

            $data_json = array('success' => 'TRUE', 'message' => 'Berhasil');
        } else {
            $data_json = array('success' => 'FALSE', 'message' => validation_errors());
        }

        echo json_encode($data_json);
    }

    private function upload_foto($idbuku, $files){
		$gallerPath = realpath(APPPATH . '../foto');
		$path = $gallerPath.'/'.$idbuku;
		if (!is_dir($path)) {
		mkdir($path, 0777, TRUE);
		}
		$konfigurasi = array(
			'allowed_types' => 'jpg|png|jpeg',
			'upload_path' => $path,
			'overwrite' => true
		);
		$this->load->library('upload', $konfigurasi);

		$_FILES['file']['name'] = $files['file']['name'];
		$_FILES['file']['type'] = $files['file']['type'];
		$_FILES['file']['tmp_name'] = $files['file']['tmp_name'];
		$_FILES['file']['error'] = $files['file']['error'];
		$_FILES['file']['size'] = $files['file']['size'];
		if ($this->upload->do_upload('file')) {
			$data = array(
				'cover' => $this->upload->data('file_name')
			);
			$this->Buku_model->update($data, $idbuku);
			return 'Success Upload';
		} else {
			return 'Error Upload';
		}
	}
}
