<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model ('mdashboard', '', TRUE);
		date_default_timezone_set('Asia/Jakarta');
	}

	public function home()
	{
		$this->Globalrules->session_rule();
		$data['title']              = '';
		$data['content']            = 'vdashboard';
		$this->load->view('templateAdmin',$data);
	}

	public function delete_common_notify($param=NULL)
	{
		# code...
		$data_notify = $this->mdashboard->get_data_notify_user($param,$this->session->userdata('sesUser'));
		if (count($data_notify) != 0) {
			# code...
			for ($i=0; $i < count($data_notify); $i++) {
				# code...
				$data_change = array(
					'status_read' => 1
				);
				$flag        = array('id'=>$data_notify[$i]->id);
				$res_data    = $this->Allcrud->editData('log_notifikasi',$data_change,$flag);
			}
		}
	}


	public function view_notification(Type $var = null)
	{
		# code...
		$this->Globalrules->session_rule();
		$this->Allcrud->notif_message();
		$data['title']   = 'Lihat Semua Pemberitahuan';
		$data['list']    = $this->Allcrud->getData('log_notifikasi',array('receiver'=>$this->session->userdata('sesUser')));
		$data['content'] = 'dashboard/notification/view_all';
		$this->load->view('templateAdmin',$data);
	}
}
