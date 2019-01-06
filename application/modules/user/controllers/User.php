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

	public function bimbingan_belajar($arg=NULL,$type=NULL,$materi=NULL)
	{
		# code...
		if ($arg == NULL) {
			# code...
			$this->Globalrules->session_rule();
			$data['title']            = 'Bimbingan Belajar';
			$data['verify_user_paid'] = $this->Allcrud->getData('tr_layanan',array('id_user'=>$this->session->userdata('session_user'),'type'=>'bimbel'));
			$data['list']             = $this->Allcrud->getData('mr_materi',array('id_parent'=>NULL))->result_array();
			$data['content']          = 'user/bimbingan_belajar/root/index';
			$this->load->view('templateAdmin',$data);		
		}
		else
		{
			redirect('user/zbimbingan_belajar/'.$arg.'/'.$type.'/'.$materi);			
		}		

	}

	public function verify_token()
	{
		# code...
		$text_status = "";
		$data_sender = $this->input->post('data_sender');
		$check_token = $this->Allcrud->getData('mr_token',array('name'=>$data_sender['token'],'id_layanan'=>$data_sender['oid']));
		if ($check_token->result_array() == array()) {
			# code...
			$res_data    = 0 ;
			$text_status = "Token Tidak Ditemukan.";
		}
		else {
			# code...
			$check_token = $this->Allcrud->getData('mr_token',array('name'=>$data_sender['token'],'id_layanan'=>$data_sender['oid'],'status'=>1));
			if ($check_token->result_array() == array()) {
				# code...
				$res_data = 0;
				$text_status = "Token Telah terpakai.";				
			}
			else {
				# code...
				$data_store  = $this->Globalrules->trigger_insert_update('insert');
				$data_store1 = $this->Globalrules->trigger_insert_update('update');
				$data_store  ['id_user']    = $this->session->userdata('session_user');
				$data_store  ['id_layanan'] = $data_sender['oid'];
				$data_store  ['type']       = $data_sender['type'];
				$data_store  ['token']      = $data_sender['token'];
				$data_store  ['status']     = 1;
				$data_store1['status']      = 0;
				$res_data    = $this->Allcrud->editData('mr_token',$data_store1,array('name'=>$data_sender['token']));				
				$res_data    = $this->Allcrud->addData('tr_layanan',$data_store);
				$text_status = $this->Globalrules->check_status_res($res_data,'Pembelian Telah berhasil.');
			}
		}
		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);		
	}

	public function video_materi()
	{
		# code...
		$this->Globalrules->session_rule();
		$data['title']   = 'Video Materi';
		$data['list']    = $this->Allcrud->getData('mr_materi',array('id_parent'=>NULL))->result_array();		
		$data['content'] = 'user/video_materi/index';
		$this->load->view('templateAdmin',$data);		
	}
}
