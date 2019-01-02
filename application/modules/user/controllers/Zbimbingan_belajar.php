<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Zbimbingan_belajar extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model ('Mmaster', '', TRUE);
	}

	public function pre_test($type=NULL,$materi=NULL)
	{
		# code...
		$this->Globalrules->session_rule();
		$data['title']   = 'Bimbingan Belajar - Pre Test';
		$data['type']    = $type;
		$data['materi']  = $materi;
		$data['list']    = $this->Allcrud->getData('mr_soal',array('id_materi'=>$materi,'id_tipe_soal'=>$type))->result_array();
		$data['content'] = 'user/bimbingan_belajar/pre_test/index';
		$this->load->view('templateAdmin',$data);		
	}	

	public function video_materi($type=NULL,$materi=NULL)
	{
		# code...
		$this->Globalrules->session_rule();
		$data['title']   = 'Bimbingan Belajar - Video Belajar';
		$data['type']    = $type;
		$data['materi']  = $materi;
		$data['list']    = $this->Allcrud->getData('mr_video',array('id_materi'=>$materi))->result_array();
		$data['content'] = 'user/bimbingan_belajar/video/index';
		$this->load->view('templateAdmin',$data);				
	}

	public function quiz($type=NULL,$materi=NULL)
	{
		# code...
		$this->Globalrules->session_rule();
		$data['title']   = 'Bimbingan Belajar - Quiz';
		$data['type']    = $type;
		$data['materi']  = $materi;
		$data['list']    = $this->Allcrud->getData('mr_soal',array('id_materi'=>$materi,'id_tipe_soal'=>$type))->result_array();
		$data['content'] = 'user/bimbingan_belajar/pre_test/index';
		$this->load->view('templateAdmin',$data);				
	}

}
