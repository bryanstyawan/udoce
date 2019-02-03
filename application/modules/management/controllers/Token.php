<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Token extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model ('Mmaster', '', TRUE);
	}
	
	public function index()
	{
		$this->Globalrules->session_rule();						
		$data['title']   = 'Token';
		$data['content'] = 'management/token/index';
		$data['list']    = $this->Allcrud->listData('mr_layanan');
		$this->load->view('templateAdmin',$data);
	}

	public function store($arg=NULL,$oid=NULL)
	{
		# code...
		$res_data    = 0;
		$text_status = '';
		$data_sender = array();
		if ($arg == NULL) {
			# code...
			$data_sender = $this->input->post('data_sender');
		}
		else {
			# code...
			$data_sender['crud'] = $arg;
			$data_sender['oid']  = $oid;
		}

		$data_store  = $this->Globalrules->trigger_insert_update($data_sender['crud']);
		if ($data_sender['crud'] == 'insert') 
		{
			# code...
			$counter = 500;
			if ($data_sender['oid'] == 5 || $data_sender['oid'] == 6) {
				# code...
				$counter = 1;
			}
			for ($i=0; $i < $counter; $i++) { 
				# code...
				$token     = $this->get_token()['token'];
				$res_token = $this->get_token()['res'];
				if ($res_token == 1) {
					# code...
					$data_store['name']       = $token;
					$data_store['id_layanan'] = $data_sender['oid'];
					$data_store['status']     = 1;
								$res_data     = $this->Allcrud->addData('mr_token',$data_store);
								$text_status  = $this->Globalrules->check_status_res($res_data,'Token telah berhasil ditambahkan.');
				}
				
			}

		} elseif ($data_sender['crud'] == 'update') {
			# code...
			$data_store['name']            = $data_sender['f_name'];
			            $res_data          = $this->Allcrud->editData('mr_token',$data_store,array('id'=>$data_sender['oid']));
			            $text_status       = $this->Globalrules->check_status_res($res_data,'Data berhasil diupdate.');			
		} elseif ($data_sender['crud'] == 'delete') {
			# code...
			// $res_data          = $this->Allcrud->delData('mr_buku',array('id'=>$data_sender['oid']));
			// $text_status       = $this->Globalrules->check_status_res($res_data,'Data Buku telah berhasil dihapus.');			
		}

		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);		
	}

	public function get_token()
	{
		# code...
		$token       = $this->Globalrules->randomCode(6);
		$check_token = $this->Allcrud->getData('mr_token',array('name'=>$token));
		if ($check_token->result_array() == array()) {
			# code...
			return array('token' => $token, 'res' => 1 );
		}
		else {
			# code...
			$this->get_token_again();
		}						
	}

	public function get_data($id,$arg=NULL,$table=NULL)
	{
		# code...
		$data       = $this->Allcrud->getData('mr_token',array('id'=>$id));		
		if ($arg == 'ajax') {
			# code...
			$res_status = "";
			$res_text   = "";
			$res_data   = "";
			if ($data->result_array() != array()) {
				# code...
				$res_data   = $data->result_array();	
				$res_status = 1;
				$res_text   = '';
			}
			else {
				# code...
				$res_data   = $data->result_array();
				$res_status = $res_data;
				$res_text   = 'Data tidak ditemukan';
			}

			$res = array
						(
							'status' => $res_status,
							'data'   => $res_data,
							'text'   => $res_text
						);
			echo json_encode($res);					
		}
		elseif($arg == 'result_array') {
			# code...
			return $data->result_array();
		}
		else {
			# code...
			return $data;			
		}
	}	

	public function detail($oid)
	{
		$this->Globalrules->session_rule();						
		$title = $this->Allcrud->getData('mr_layanan',array('id'=>$oid));
		if ($title->result_array() != array()) {
			# code...
			$title = $title->result_array()[0]['name'];
		}		
		else {
			# code...
			$title = '';
		}

		$_text = "Token";
		if ($oid == 5 || $oid == 6) {
			# code...
			$_text = "Password";
		}

		$data['title']   = $_text.' '.$title;
		$data['content'] = 'management/token/detail';
		$data['list']    = $this->Allcrud->getData('mr_token',array('id_layanan'=>$oid));
		$data['oid']     = $oid;
		$this->load->view('templateAdmin',$data);
	}	
}