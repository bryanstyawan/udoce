<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Management extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model ('Mmaster', '', TRUE);
	}

	public function index()
	{
		if(!$this->session->userdata('session_login')){
			redirect('admin/Admin');
		}
		$this->load->view('templateAdmin');
	}

	public function try_out()
	{
		# code...
		redirect('management/try_out');
	}

	public function token()
	{
		# code...
		redirect('management/token');		
	}

}
