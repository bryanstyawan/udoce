<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model ('Mmaster', '', TRUE);
	}

	public function index()
	{
		$this->home();
	}

	public function home()
	{
		# code...
		$this->Globalrules->session_rule();
		$data['title']              = '';
		$data['content']            = 'dashboard/index';
		$this->load->view('templateAdmin',$data);
	}

	public function services()
	{
		# code...
		$this->Globalrules->session_rule();
		$data['title']              = '';
		$data['content']            = 'services/index';
		$this->load->view('templateAdmin',$data);		
	}	

	public function try_out()
	{
		# code...
		$this->Globalrules->session_rule();
		$data['title']              = '';
		$data['content']            = 'dashboard/index';
		$this->load->view('templateAdmin',$data);		
	}

	public function store()
	{
		# code...
		$data_sender = $this->input->post('data_sender');

		$data_store  = $this->Globalrules->trigger_insert_update($data_sender['crud']);
		if ($data_sender['crud'] == 'insert') {
			# code...
			$data_store['name']         = $data_sender['name'];
			$data_store['username']     = $data_sender['username'];
			$data_store['alamat']       = $data_sender['alamat'];
			$data_store['asal_sekolah'] = $data_sender['asal_sekolah'];
			$data_store['no_hp']        = $data_sender['no_hp'];
			$data_store['no_wa']        = $data_sender['no_wa'];
			$data_store['id_line']      = $data_sender['id_line'];
			$data_store['password']     = md5($data_sender['password']);
			$data_store['id_role']      = 3;
			$data_store['status']       = 1;
			            $res_data       = $this->Allcrud->addData('mr_user',$data_store);
			            $text_status    = $this->Globalrules->check_status_res($res_data,'Anda telah berhasil mendaftar.');
		}

		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);		
	}

	public function bimbingan_belajar()
	{
		# code...
		$this->Globalrules->session_rule();
		$data['title']              = '';
		$data['content']            = 'user/bimbingan_belajar/root/index';
		$this->load->view('templateAdmin',$data);		
	}
}
