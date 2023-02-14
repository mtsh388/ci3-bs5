<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		// $this->load->library('form_validation');

		$this->load->model([
			'UsersModel' => 'M_user'
		]);
	}
	public function index()
	{
		if ($this->session->userdata('id_user') == NULL) {
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			if ($this->form_validation->run() == false) {
				$data = [
					'title' => 'Shop',
				];
				$this->load->view('welcome_message', $data);
			} else {
				$this->_login();
			}
		} else {
			redirect(base_url('admin/dashboard'));
		}
	}
	private function _login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$user = $this->db->get_where('tbl_user', ['username' => $username])->row_array();
		if ($user) {
			if (password_verify($password, $user['pass'])) {
				$data = [
					'iduser' => $user['id'],
					'idlevel' => $user['idlevel']
				];
				$this->session->set_userdata($data);
				redirect(base_url('dashboard'));
			} else {
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger" id="pesan">Password Salah!</div>');
				redirect(base_url());
			}
		} else {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" id="pesan">Username Salah!</div>');
			redirect(base_url());
		}
	}
	public function logout()
	{
		$this->session->unset_userdata('iduser');
		$this->session->unset_userdata('idlevel');
		// $result['msg'] = "OK";
		// echo json_encode($result);
		redirect(base_url());
	}
}
