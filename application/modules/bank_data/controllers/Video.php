<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Video extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model ('Mbank_data', '', TRUE);
	}
	
	public function index()
	{
		redirect(base_url());
	}

	public function upload_data($arg,$oid=NULL)
	{
		# code...
		$config['upload_path']   = FCPATH.'/public/video/';
		$config['allowed_types'] = 'mp4|mkv|flv';
		$config['max_size']      = '500000';
		$this->load->library('upload', $config);
		$id_pekerjaan = "";
		$f_file       = "";
		$res_data     = 0;
		$res_data_id  = "";
		$text_status  = "";
		$data         = "";
		$msg          = "";

		$data_store  = $this->Globalrules->trigger_insert_update($arg);
		
		if ($arg == 'insert') {
			# code...
			if ( ! $this->upload->do_upload('file')){
				$res_data = 0;
				$msg      = $this->upload->display_errors();
				$f_file   = "";
			}
			else
			{
				$dataupload = $this->upload->data();
				$res_data   = 1;				
				$msg        = $dataupload['file_name']." berhasil diupload";
				$f_file     = $this->upload->data('file_name');
			}

			if ($res_data == 1) {
				if ($f_file != '')$data_store['file'] = $f_file;
	
				$data_store['file']      = $f_file;
				            $process     = $this->Allcrud->addData_with_return_id('mr_video',$data_store);
				            $res_data    = $process['status'];
				            $res_data_id = $process['id'];
				            $text_status = $this->Globalrules->check_status_res($res_data,$msg);
			}
			else {
				# code...
				$text_status = $msg;								
			}
		}
		elseif ($arg == 'update') {
			# code...
			$get_data = $this->get_data($oid,'result_array','mr_video');
			$path_to_file = $config['upload_path'].$get_data[0]['file'];
			if ($get_data[0]['file'] != '' || $get_data[0]['file'] != NULL) {
				# code...
				$param_file_exists = 0;
				if (file_exists($path_to_file)) {
					# code...
					$param_file_exists = 1;
					if(unlink($path_to_file)) {
						// echo 'deleted successfully';
					}
					else {
						echo 'errors occured';
					}							
				}
				else {
					# code...
					$param_file_exists = 0;				
				}				
			}

			if ( ! $this->upload->do_upload('file')){
				$res_data = 0;
				$msg      = $this->upload->display_errors();
				$f_file   = "";
			}
			else
			{
				$dataupload = $this->upload->data();
				$res_data   = 1;				
				$msg        = $dataupload['file_name']." berhasil diupload";
				$f_file     = $this->upload->data('file_name');
			}
			if ($res_data == 1) {
				# code...
				if ($f_file != '')$data_store['file'] = $f_file;
	
				$data_store['file']      = $f_file;
								$process     = $this->Allcrud->editData('mr_video',$data_store,array('id'=>$oid));
								$res_data    = $process;
								$res_data_id = $oid;
								$text_status = $this->Globalrules->check_status_res($res_data,$msg);
			}
			elseif($res_data == 0) {
				# code...
				$text_status = $msg;				
			}
		}

		$res = array
		(
			'status' => $res_data,
			'text'   => $text_status,
			'id'     => $res_data_id
		);
		echo json_encode($res);						
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
		if ($data_sender['crud'] == 'insert') {
			# code...
		} elseif ($data_sender['crud'] == 'update') {
			# code...
			$data_store['name']      = $data_sender['f_name'];
			$data_store['id_materi'] = $data_sender['id_materi'];
			$data_store['id_parent'] = $data_sender['id_parent'];
			            $res_data    = $this->Allcrud->editData('mr_video',$data_store,array('id'=>$data_sender['oid']));
			            $text_status = $this->Globalrules->check_status_res($res_data,'Data video berhasil diupdate.');
		} elseif ($data_sender['crud'] == 'delete') {
			# code...
			$config['upload_path'] = FCPATH.'/public/video/';
			        $get_data      = $this->get_data($data_sender['oid'],'result_array','mr_video');
			        $path_to_file  = $config['upload_path'].$get_data[0]['file'];
			if ($get_data[0]['file'] != '' || $get_data[0]['file'] != NULL) {
				# code...
				$param_file_exists = 0;
				if (file_exists($path_to_file)) {
					# code...
					$param_file_exists = 1;
					if(unlink($path_to_file)) {
						// echo 'deleted successfully';
					}
					else {
						// echo 'errors occured';
					}							
				}
				else {
					# code...
					$param_file_exists = 0;				
				}				
			}			
			$res_data          = $this->Allcrud->delData('mr_video',array('id'=>$data_sender['oid']));
			$text_status       = $this->Globalrules->check_status_res($res_data,'Data Video telah berhasil dihapus.');			
		}

		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);		
	}

	public function get_data($id,$arg=NULL,$table)
	{
		# code...
		$data       = $this->Allcrud->getData($table,array('id'=>$id));		
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

	public function video_materi($id=NULL,$parent=NULL,$param=NULL)
	{
		# code...
		$this->Globalrules->session_rule();						

		$arg       = $this->Allcrud->getData('lt_tipe_bimbingan_belajar',array('id'=>$param))->result_array()[0]['text'];
		$data['list']    = $this->Allcrud->getdata('mr_video',array('id_materi'=>$id,'id_parent'=>$parent));
		$data['materi']  = $this->Allcrud->getData('mr_materi',array('id'=>$id));
		$data['parent']  = $this->Allcrud->getData('mr_materi',array('id'=>$parent));
		$data['param']   = $param;
		$data['title']   = 'Data '.$arg;
		$data['content'] = 'bank_data/video/index';
		$this->load->view('templateAdmin',$data);		
	}	
}