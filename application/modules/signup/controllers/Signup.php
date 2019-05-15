<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model ('Mmaster', '', TRUE);
	}

	public function index()
	{
		$this->load->view('signup/signup/index',NULL);			
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
			$data_store['email']        = $data_sender['email'];			
			$data_store['id_line']      = $data_sender['id_line'];
			$data_store['password']     = md5($data_sender['password']);
			$data_store['id_role']      = 3;
			$data_store['status']       = 1;

			$check_username = $this->Allcrud->getdata('mr_user',array('username'=>$data_sender['username']))->result_array();
			if ($check_username != array()) {
				# code...
				$res_data = 0;
				$text_status = "Username telah terdaftar";
			}
			else
			{
				$res_data       = $this->Allcrud->addData('mr_user',$data_store);
				$text_status    = $this->Globalrules->check_status_res($res_data,'Anda telah berhasil mendaftar.');
			}
		}
		

		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);		
	}
}
