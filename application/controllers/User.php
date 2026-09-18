<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\IOFactory;


class User extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata("logged") <> 1) {
			redirect(site_url('login'));
		}

		//load model user
		$this->load->model('ModelUser', 'mu');
		$this->load->library('upload');
		$this->load->model('ModelLokasi', 'ml');
	}

	//menampilkan data user
	public function users()
	{
		$data = array(
			'title' => 'Data User',
			'active_menu_master' => 'menu-open',
			'active_menu_mst' => 'active',
			'active_menu_user' => 'active',
			'user' => $this->mu->getDataUser()
		);
		$this->load->view('layouts/header', $data);
		$this->load->view('master/v_user', $data);
		$this->load->view('layouts/footer');
	}

	public function tambahUser()
	{
		$this->form_validation->set_rules(
			'username',
			'Username',
			'required|min_length[5]',
			array(
				'required' => "<p>Username tidak boleh kosong</p>",
				'min_length' => "<p>Username minimal 5 Karakter</p>"
			)
		);
		$this->form_validation->set_rules(
			'password',
			'Password',
			'required|min_length[5]',
			array(
				'required' => "<p>Password tidak boleh kosong</p>",
				'min_length' => "<p>Password minimal 5 Karakter</p>"
			)
		);

		if ($this->form_validation->run() != false) {

			$username = $this->input->post('username');
			$cek = $this->mu->cekUsername($username);
			if ($cek == 1) {
				$this->session->set_flashdata('gagal_store', 'Username sudah digunakan..');
				redirect('users');
			} else {
				$password = $this->input->post('password');
				$password_confirm = $this->input->post('password_confirm');
				if ($password == $password_confirm) {
					$data = array(
						'nama_user' => $this->input->post('nama_user'),
						'username' => $this->input->post('username'),
						'password' => md5($this->input->post('password')),
						'jabatan' => $this->input->post('jabatan'),
						'role' => $this->input->post('role')
					);
					$res = $this->mu->store_user($data);
					if ($res >= 1) {
						$this->session->set_flashdata('sukses', 'Disimpan');
						redirect('users');
					} else {
						$this->session->set_flashdata('gagal', 'Disimpan');
						redirect('users');
					}
				} else {
					$this->session->set_flashdata('gagal_store', 'Password yang anda masukan tidak sama..');
					redirect('users');
				}
			}
		} else {
			$data = array(
				'title' => 'Data User',
				'active_menu_master' => 'menu-open',
				'active_menu_mst' => 'active',
				'active_menu_user' => 'active',
				'user' => $this->mu->getDataUser()
			);
			$this->load->view('layouts/header', $data);
			$this->load->view('master/v_user', $data);
			$this->load->view('layouts/footer');
		}
	}

	public function hapusUser($id_user)
	{
		$id_user = $this->uri->segment(3);
		$where = array('id_user' => $id_user);
		$res = $this->mu->delete_user($where);
		if ($res >= 1) {
			$this->session->set_flashdata('sukses', 'Dihapus');
			redirect('users');
		} else {
			$this->session->set_flashdata('gagal', 'Dihapus');
			redirect('users');
		}
	}

	public function pengaturan()
	{
		$data = array(
			'title' => 'Data User',
			'active_menu_png' => 'active',
		);
		$this->load->view('layouts/header', $data);
		$this->load->view('master/v_pengaturan', $data);
		$this->load->view('layouts/footer');
	}

	public function updateUser()
	{
		$id_user = $this->session->userdata('id_user');
		if ($_FILES['foto']['name']) {

			$config['upload_path'] = 'src/img/profile/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['encrypt_name'] = TRUE;

			$this->upload->initialize($config);
			if (! $this->upload->do_upload('foto')) {
				$this->session->set_flashdata('gagal', 'Diupload');
				redirect('pengaturan');
			} else {
				$ambildata = $this->mu->getDetailUser($id_user);
				foreach ($ambildata as $foto) {
					unlink('src/img/profile/' . $foto['foto']);
				}

				$gbr = $this->upload->data();
				//Compress Image
				$config['image_library'] = 'gd2';
				$config['source_image'] = 'src/img/profile/' . $gbr['file_name'];
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = FALSE;
				$config['quality'] = '60%';
				$config['width'] = 300;
				$config['height'] = 300;
				$config['new_image'] = 'src/img/profile/' . $gbr['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();

				$data_user = array(
					'nama_user' => $this->input->post('nama_user'),
					'username' => $this->input->post('username'),
					'jabatan' => $this->input->post('jabatan'),
					'foto' => $gbr['file_name']
				);

				unset($data_user['id_user']);
				$this->mu->update_user($id_user, $data_user);

				$this->session->set_userdata($data_user);
				$this->session->set_flashdata('sukses', 'Diubah');
				redirect('pengaturan');
			}
		} else {
			$data_user = array(
				'nama_user' => $this->input->post('nama_user'),
				'username' => $this->input->post('username'),
				'jabatan' => $this->input->post('jabatan'),
			);

			$id_user = $this->session->userdata('id_user');
			$query = $this->mu->update_user($id_user, $data_user);
			if ($query) {
				$this->session->set_userdata($data_user);
				$this->session->set_flashdata('sukses', 'Diubah');
				redirect('pengaturan');
			} else {
				$this->session->set_flashdata('gagal', 'Diubah');
				redirect('pengaturan');
			}
		}
	}

	public function updatePassword()
	{
		$this->form_validation->set_rules(
			'password',
			'Password Baru',
			'required|min_length[5]',
			array(
				'required' => "<p>Password tidak boleh kosong</p>",
				'min_length' => "<p>Password minimal 5 Karakter</p>"
			)
		);

		if ($this->form_validation->run() != false) {

			$password = $this->input->post('password');
			$password_dua = $this->input->post('password_dua');
			if ($password == $password_dua) {

				$data_user = array(
					'password' => password_hash($this->input->post('password'), PASSWORD_ARGON2ID)
				);

				$id_user = $this->session->userdata('id_user');
				$query = $this->mu->update_user($id_user, $data_user);
				if ($query) {
					$this->session->sess_destroy();
					redirect('/');
				} else {
					$this->session->set_flashdata('gagal', 'Diubah');
					redirect('pengaturan');
				}
			} else {
				$this->session->set_flashdata('gagal_store', 'Password yang anda masukan tidak sama..');
				redirect('pengaturan');
			}
		} else {
			$data = array(
				'title' => 'Data User'
			);
			$this->load->view('layouts/header', $data);
			$this->load->view('master/v_pengaturan', $data);
			$this->load->view('layouts/footer');
		}
	}

	public function editUsers($id_user)
	{
		$data = array(
			'title' => 'Edit User',
			'users' => $this->mu->getUserById($id_user),
			'lokasi' => $this->ml->getLokasi()
		);

		$this->load->view('layouts/header', $data);
		$this->load->view('master/u_user', $data);
		$this->load->view('layouts/footer');
	}

	public function updateUsers()
	{
		$id_user = $this->input->post('id_user');
		$role    = $this->input->post('role', true);

		// Administrator tidak perlu memiliki lokasi
		if ($role == '1') {
			$id_lokasi = NULL;
		} else {
			$id_lokasi = $this->input->post('id_lokasi', true);

			// Manager/Staf wajib memilih lokasi
			if (empty($id_lokasi)) {
				$this->session->set_flashdata(
					'gagal',
					'Lokasi aset wajib dipilih untuk Manager/Staf.'
				);

				redirect('users/editUsers/' . $id_user);
				return;
			}
		}

		$data = [
			'nama_user' => $this->input->post('nama_user', true),
			'username'  => $this->input->post('username', true),
			'jabatan'   => $this->input->post('jabatan', true),
			'role'      => $role,
			'id_lokasi' => $id_lokasi
		];

		// Password hanya diubah jika diisi
		if ($this->input->post('password') != '') {
			$data['password'] = password_hash(
				$this->input->post('password'),
				PASSWORD_DEFAULT
			);
		}

		$this->db->where('id_user', $id_user);
		$this->db->update('users', $data);

		if ($this->db->affected_rows() >= 1) {

			$this->session->set_flashdata('sukses', 'Diubah');
			redirect('users');
		} else {

			$this->session->set_flashdata('gagal', 'Diubah');
			redirect('users/editUsers/' . $id_user);
		}
	}

	public function resetPassword($id_user)
	{
		$password_baru = password_hash('123456', PASSWORD_DEFAULT);

		$data = [
			'password' => $password_baru
		];

		$this->db->where('id_user', $id_user);
		$this->db->update('users', $data);

		if ($this->db->affected_rows() >= 1) {

			$this->session->set_flashdata('sukses', 'Password Direset');
			redirect('users');
		} else {

			$this->session->set_flashdata('gagal', 'Password Direset');
			redirect('users');
		}
	}

	public function importUsers()
	{
		if (!empty($_FILES['file_excel']['tmp_name'])) {

			$file = $_FILES['file_excel']['tmp_name'];

			$spreadsheet = IOFactory::load($file);
			$sheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

			$data = [];

			// password default
			$defaultPassword = password_hash('123456', PASSWORD_DEFAULT);

			foreach ($sheet as $key => $row) {

				// skip header
				if ($key == 1) {
					continue;
				}

				// skip jika username kosong
				if (empty($row['B'])) {
					continue;
				}

				$data[] = [
					'nama_user' => $row['A'],
					'username' => $row['B'],
					'password' => $defaultPassword,
					'jabatan' => $row['C'],
					'role' => $row['D']
				];
			}

			if (!empty($data)) {
				$this->db->insert_batch('users', $data, 500);
			}

			$this->session->set_flashdata('sukses', 'Import users berhasil');
			redirect('users');
		} else {

			$this->session->set_flashdata('error', 'File tidak ditemukan');
			redirect('users');
		}
	}
}

/* End of file User.php */
/* Location: ./application/controllers/User.php */