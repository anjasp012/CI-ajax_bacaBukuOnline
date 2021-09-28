<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
        $this->auth_model->cek_login();
        $this->load->model("users_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->session->userdata('role') == 0) {
            echo 'mw ap lo?';
        }
    }

    public function list_user()
    {
        $data = $this->users_model->getAll();

        $konten = '<thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">Status</th>
                <th scope="col"></th>
            </tr>
        </thead>';

        foreach ($data as $key => $val) {
            $cek = $val->active ? 'Sedang Aktif' : 'Tidak Aktif';
            $konten .= '<tr>
            <th scope="row">' . ($key + 1) . '</th>
            <td>' . $val->nama . '</td>
            <td>' . $val->email . '</td>
            <td>' . $cek . '</td>
            <td align="right">
                <a href="#' . $val->id . '" class="btn btn-warning linkEdit">Edit</a>
                <a href="#' . $val->id . '" class="btn btn-danger linkHapus">Hapus</a>
            </td>
        </tr>';
        }

        echo json_encode($konten);
    }

    public function delete_user()
    {
        $this->db->trans_start();

        $userId = $this->input->get('id');

        $this->users_model->delete($userId);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $data_output = array('message' => 'Gagal!');
        } else {
            $this->db->trans_commit();
            $data_output = array('message' => 'Berhasil!');
        }

        echo json_encode($data_output);
    }

    public function detail_user()
    {
        $id = $this->input->get('id');
        $data_detail = $this->users_model->getById($id);

        if ($data_detail != null) {
            $data_output = array('success' => TRUE, 'detail' => $data_detail);
        } else {
            $data_output = array('success' => FALSE);
        }

        echo json_encode($data_output);
    }

    public function update_user()
    {
        $this->db->trans_start();

        $id = $this->input->post('id');

        $arr_input = array(
            'nama' => $this->input->post('nama'),
            'email' => $this->input->post('email'),
        );

        $this->users_model->update($arr_input, $id);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $data_output = array('success' => FALSE);
        } else {
            $this->db->trans_commit();
            $data_output = array('success' => TRUE);
        }

        echo json_encode($data_output);
    }

    public function add_user()
    {
        $this->form_validation->set_rules('nama', 'Nama','trim|required|min_length[1]|max_length[255]');
        $this->form_validation->set_rules('email', 'Email','trim|required|min_length[1]|max_length[255]|is_unique[tb_user.email]');
		$this->form_validation->set_rules('password', 'Password','trim|required|min_length[1]|max_length[255]');

		if ($this->form_validation->run())
	   	{
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$nama = $this->input->post('nama');
            
			$this->users_model->add($email, $password, $nama);
            $data_json = array('success' => 'TRUE', 'message' => 'Berhasil');
		}
		else
		{
            $data_json = array('success' => 'FALSE', 'message' => validation_errors());
		}

        echo json_encode($data_json);
    }
}
