<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller 
{

	public function __construct () 
	{
		parent::__construct();
		$this->load->model ('Madmin', '', TRUE);
		$this->load->model ('mlogin', '', TRUE);		
		date_default_timezone_set('Asia/Jakarta');				
	}
	
	public function index()
	{
		if($this->session->userdata('session_login')){
			if ($this->session->userdata('session_role') != 3) {
				# code...
				redirect('dashboard/home');							
			}
			else {
				# code...
				redirect('user/home');														
			}
		}
		else {
			# code...
			$this->load->view('login_gate');			
		}
				
	}

	public function process()
	{
		# code...
		error_reporting(E_ALL ^ E_WARNING);		
		$username = htmlspecialchars($this->input->post('username'), ENT_QUOTES| ENT_COMPAT, 'UTF-8');
		$pass     = htmlspecialchars($this->input->post('password'), ENT_QUOTES| ENT_COMPAT, 'UTF-8');
		$cekuser  = $this->mlogin->cekuser($username,$pass);
		if ($cekuser != 0) 
		{
			# code...
			$data = array
						(
							'session_user'  => $cekuser[0]->id,
							'session_name'  => $cekuser[0]->name,
							'session_role'  => $cekuser[0]->id_role,
							'session_login' => TRUE
						);
			$this->session->set_userdata($data);
			$res = array
			(
				'status' => 1,
				'text'   => 'Verifikasi berhasil'
			);
			echo json_encode($res);
		}
		else
		{
			$res = array
			(
				'status' => 0,
				'text'   => 'Verifikasi user gagal, nip atau password tidak sesuai'
			);
			echo json_encode($res);
		}		
	}

	public function signout()
	{
		$this->session->sess_destroy();
		redirect('auth');
	}		

	public function change_password()
	{
		# code...
		if(!$this->session->userdata('session_login')){
			redirect('auth');
		}
		$this->Globalrules->notif_message();		
		$data['title']      = 'Ubah Password';		
		$data['subtitle']   = '';
		$data['content']    = 'admin/user/change_password';
		$this->load->view('templateAdmin',$data);		
	}

	public function do_change_password()
	{
		# code...
		$res_data     = "";
		$text_status  = "";
		$pass_lama    = $this->input->post('pass_lama');
		$pass_baru    = $this->input->post('pass_baru');
		$re_pass_baru =	$this->input->post('re_pass_baru');
		$nip          = $this->session->userdata('sesNip');
		$id           = $this->session->userdata('sesUser');
		
		$cekUser      = $this->mlogin->cekUser($nip,$pass_lama);
		if ($cekUser != 0) 
		{		
			$data_change = array
							(
								'password'            => md5($re_pass_baru) 
							);		
			$flag        = array('id'=>$id);
			$res_data    = $this->Allcrud->editData('mr_pegawai',$data_change,$flag);					
			$text_status = "Password telah diubah";
			if ($res_data != 1) {
				# code...
				$text_status = "Telah terjadi kesalahan sistem";
			}
		}
		else
		{
			$res_data    = 0;
			$text_status = "Password Lama tidak sesuai";

		}


		$res = array
					(
						'status' => $res_data, 
						'text'   => $text_status
					);

		echo json_encode($res);										

	}

	public function redirect_notifikasi($id)
	{
		# code...
		$res = $this->Globalrules->get_log_notify_id($id);
		if ($res != 0) {
			# code...
			$data_notify  = array
							(
								'id_table'   => $res[0]->id_table,
								'table_name' => $res[0]->table_name
							);			
			$this->Globalrules->push_notifikasi($data_notify,'read_data');			
			redirect($res[0]->url);
		}
	}
}