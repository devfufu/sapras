<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	private $username;
	private $password;

	public function __construct()
	{
		parent::__construct();

		$this->load->model('ModelLogin', 'ml');
	}

	public function index()
	{
		$this->load->view('auth/v_login');
	}

	public function proses_login()
	{
		$this->form_validation->set_rules(
			'username',
			'Username',
			'required|min_length[5]'
		);

		$this->form_validation->set_rules(
			'password',
			'Password',
			'required|min_length[5]'
		);

		if ($this->form_validation->run() != false) {

			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$user = $this->ml->getUserByUsername($username);

			if ($user) {

				$valid = false;

				// cek hash modern
				if (password_verify($password, $user->password)) {
					$valid = true;
				}

				// cek md5 lama
				elseif ($user->password == md5($password)) {
					$valid = true;

					// upgrade password ke hash baru
					$newHash = password_hash($password, PASSWORD_DEFAULT);

					$this->db->where('id_user', $user->id_user);
					$this->db->update('users', ['password' => $newHash]);
				}

				if ($valid) {

					$data = array(
						'logged' => TRUE,
						'id_user' => $user->id_user,
						'username' => $user->username,
						'nama_user' => $user->nama_user,
						'jabatan' => $user->jabatan,
						'role' => $user->role,
						'foto' => $user->foto
					);

					$this->session->set_userdata($data);

					redirect('home');
				} else {

					$this->session->set_flashdata('gagal_login', 'Username dan Password Salah');
					redirect('login');
				}
			} else {

				$this->session->set_flashdata('gagal_login', 'Username dan Password Salah');
				redirect('login');
			}
		} else {

			$this->load->view('auth/v_login');
		}
	}

	public function proses_logout()
	{
		$this->session->sess_destroy();
		redirect('/');
	}
}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */