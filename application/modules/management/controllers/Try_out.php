<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Try_out extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model ('Mmaster', '', TRUE);
	}
	
	public function index()
	{
		$this->Globalrules->session_rule();						
		$data['title']   = 'Management Try Out';
		$data['content'] = 'management/try_out/index';
		$data['tipe']    = $this->Allcrud->listData('lt_paket_try_out')->result_array();		
		$this->load->view('templateAdmin',$data);
	}

	public function get_data_paket_try_out($id=NULL)
	{
		# code...
		$data['list'] = $this->Allcrud->getData('mr_try_out_list',array('id_parent'=>$id))->result_array();
		if ($data['list'] != 0) {
			# code...
			for ($i=0; $i < count($data['list']); $i++) { 
				# code...
				$get_analisis                                          = $this->Allcrud->getData('tr_track_time_try_out',array('id_user'=>$this->session->userdata('session_user'),'id_paket'=>$data['list'][$i]['id'],'id_parent'=>$data['list'][$i]['id_parent']))->result_array();
				$get_rangking                                          = $this->Allcrud->getData('tr_analisis_rangking',array('id_user'=>$this->session->userdata('session_user'),'id_paket'=>$data['list'][$i]['id'],'id_parent'=>$data['list'][$i]['id_parent']))->result_array();
				$data['list'][$i]['tpa']                               = count($this->Allcrud->getdata('mr_try_out_soal',array('id_parent'=>1,'id_type'=>1,'id_paket'=>$data['list'][$i]['id']))->result_array());
				$data['list'][$i]['tbi']                               = count($this->Allcrud->getdata('mr_try_out_soal',array('id_parent'=>1,'id_type'=>2,'id_paket'=>$data['list'][$i]['id']))->result_array());
				$data['list'][$i]['twk']                               = count($this->Allcrud->getdata('mr_try_out_soal',array('id_parent'=>2,'id_type'=>3,'id_paket'=>$data['list'][$i]['id']))->result_array());
				$data['list'][$i]['tiu']                               = count($this->Allcrud->getdata('mr_try_out_soal',array('id_parent'=>2,'id_type'=>4,'id_paket'=>$data['list'][$i]['id']))->result_array());
				$data['list'][$i]['tkk']                               = count($this->Allcrud->getdata('mr_try_out_soal',array('id_parent'=>2,'id_type'=>5,'id_paket'=>$data['list'][$i]['id']))->result_array());
				$data['list'][$i]['mini_tryout']                       = count($this->Allcrud->getdata('mr_try_out_soal',array('id_parent'=>3,'id_paket'=>$data['list'][$i]['id']))->result_array());				
				$data['list'][$i]['verified']                          = count($this->Allcrud->getdata('mr_try_out_soal',array('id_parent'=>$data['list'][$i]['id_parent'],'id_paket'=>$data['list'][$i]['id'],'audit_verified'=>1))->result_array());
				$data['list'][$i]['show_analisis']                     = ($get_analisis != array()) ? (($get_analisis[0]['status'] != '') ? $get_analisis[0]['status'] : 0 ) : 0 ;
				$data['list'][$i]['show_rangking']                     = ($get_rangking != array()) ? (($get_rangking[0]['status'] != '') ? $get_rangking[0]['status'] : 0 ) : 0 ;
				if ($data['list'][$i]['id_parent'] == 1) {
					# code...
					$data['list'][$i]['total_soal'] = $data['list'][$i]['tpa'] + $data['list'][$i]['tbi'];
				} 
				elseif ($data['list'][$i]['id_parent'] == 2) {
					# code...
					$data['list'][$i]['total_soal'] = $data['list'][$i]['twk'] + $data['list'][$i]['tiu'] + $data['list'][$i]['tkk'];					
				}
				elseif ($data['list'][$i]['id_parent'] == 3) {
					# code...
					$data['list'][$i]['total_soal'] = $data['list'][$i]['mini_tryout'];					
				}				

				if ($data['list'][$i]['total_soal'] != 0) {
					# code...
					if ($data['list'][$i]['total_soal'] == $data['list'][$i]['verified']) {
						# code...
						$this->Allcrud->editData('mr_try_out_list',array('publish' => 1),array('id'=>$data['list'][$i]['id']));
					}					
				}
				
			}
		}		
		$data['type'] = $this->Allcrud->getData('mr_try_out_paket',array('id_parent'=>$id))->result_array();		
		echo json_encode($data);
	}

	public function store($arg=NULL,$oid=NULL,$status=NULL)
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
			if ($data_sender['oid_parent'] == 3) {
				# code...
				$data_store['mini_try_out_flag'] = 1;
				$data_store['remark']            = $data_sender['f_remark'];
				$data_store['durasi']            = $data_sender['f_durasi'];				
				$data_store['time_publish']      = $data_sender['f_time_publish'];
				$data_store['time_expired']      = $data_sender['f_time_expired'];												
				// $data_store['time_publish']      = date('Y-m-d' , strtotime($data_sender['f_time_publish']));
			}
			$data_store['id_parent'] = $data_sender['oid_parent'];
			$data_store['name']      = $data_sender['f_name'];
			            $res_data    = $this->Allcrud->addData('mr_try_out_list',$data_store);
			            $text_status = $this->Globalrules->check_status_res($res_data,'Paket Try Out telah berhasil ditambahkan.');
		} elseif ($data_sender['crud'] == 'update') {
			# code...
			if ($data_sender['oid_parent'] == 3) {
				# code...
				$data_store['remark']            = $data_sender['f_remark'];
				$data_store['durasi']            = $data_sender['f_durasi'];				
				$data_store['time_publish']      = $data_sender['f_time_publish'];
				$data_store['time_expired']      = $data_sender['f_time_expired'];								
				// $data_store['time_publish']      = date('Y-m-d' , strtotime($data_sender['f_time_publish']));
			}			
			$data_store['id_parent'] = $data_sender['oid_parent'];
			$data_store['name']      = $data_sender['f_name'];
			            $res_data    = $this->Allcrud->editData('mr_try_out_list',$data_store,array('id'=>$data_sender['oid']));
			            $text_status = $this->Globalrules->check_status_res($res_data,'Paket Try Out telah berhasil diubah.');
		} elseif ($data_sender['crud'] == 'delete') {
			# code...
			$soal    = $this->Allcrud->getdata('mr_try_out_soal',array('id'=>$data_sender['oid']))->result_array();			
			if ($soal != array()) {
				# code...
				for ($i=0; $i < count($soal); $i++) { 
					# code...
					$res_data          = $this->Allcrud->delData('mr_try_out_soal_detail',array('id_soal'=>$soal[$i]['id']));					
				}
			}
			$res_data          = $this->Allcrud->delData('mr_try_out_soal',array('id'=>$data_sender['oid']));			
			$text_status       = $this->Globalrules->check_status_res($res_data,'Paket Try Out telah berhasil dihapus.');			
		} elseif ($data_sender['crud'] == 'verify') {
			# code...
			if ($status == 0) {
				# code...
				$data_store1['audit_verified'] = $status;				
				$res_data                      = $this->Allcrud->editData('mr_try_out_soal',$data_store1,array('id_paket'=>$data_sender['oid']));							
			}
			$data_store['publish'] = $status;			
			$res_data              = $this->Allcrud->editData('mr_try_out_list',$data_store,array('id'=>$data_sender['oid']));
			$text_status           = $this->Globalrules->check_status_res($res_data,'Paket Try Out telah berhasil diubah.');			
		}

		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);		
	}	

	public function store_detail($arg=NULL,$oid=NULL)
	{
		# code...
		$res_data    = 0;
		$text_status = '';
		$data_sender = array();
		if ($arg == NULL) {
			# code...
			$data_sender = $this->input->post('data_sender');
			$data_detail = $this->input->post('data_detail');
		}
		else {
			# code...
			$data_sender['crud'] = $arg;
			$data_sender['oid']  = $oid;
		}

		if ($data_sender['crud'] == 'insert') {
			# code...
			for ($i=0; $i < count($data_detail); $i++) { 
				# code...
				$data_store  = $this->Globalrules->trigger_insert_update($data_detail[$i]['crud']);
				$data_store['id_parent']       = $data_detail[$i]['oid_parent'];
				$data_store['id_type']         = $data_detail[$i]['oid_type'];
				$data_store['id_paket']        = $data_detail[$i]['oid_paket'];
				$data_store['name']            = $data_detail[$i]['f_name'];
				$data_store['desc_pembahasan'] = $data_detail[$i]['f_pembahasan'];
				$data_store['tema']            = $data_detail[$i]['f_tema'];
							$res_data    = $this->Allcrud->addData('mr_try_out_soal',$data_store);
							$text_status = $this->Globalrules->check_status_res($res_data,'Data Paket Try out telah berhasil ditambahkan.');
			}
		} elseif ($data_sender['crud'] == 'update') {
			# code...
			$data_store  = $this->Globalrules->trigger_insert_update($data_sender['crud']);			
			$data_store['name']            = $data_sender['f_name'];
			$data_store['desc_pembahasan'] = $data_sender['f_desc_pembahasan'];
			            $res_data          = $this->Allcrud->editData('mr_try_out_soal',$data_store,array('id'=>$data_sender['oid']));
			            $text_status       = $this->Globalrules->check_status_res($res_data,'Data Soal Try out telah berhasil diubah.');			
		} elseif ($data_sender['crud'] == 'delete') {
			# code...
			$res_data          = $this->Allcrud->delData('mr_soal',array('id'=>$data_sender['oid']));
			$text_status       = $this->Globalrules->check_status_res($res_data,'Data Paket Try out telah berhasil dihapus.');			
		}

		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);		
	}

	public function soal($id_parent=NULL,$type=NULL,$id=NULL)
	{
		# code...
		$this->Globalrules->session_rule();								
		$arg = "";
		if ($id_parent != 3) {
			# code...
			if ($type != NULL) {
				# code...
				$arg       = 'Try Out '.$this->Allcrud->getData('mr_try_out_paket',array('id'=>$type))->result_array()[0]['text'];			
			}			
		}
		else
		{
			$arg = "Mini Try Out - ".$this->Allcrud->getData('mr_try_out_list',array('id'=>$id))->result_array()[0]['name'];
		}
		$data['title']   = 'Soal '.$arg;
		$data['content'] = 'management/try_out/soal';
		if ($id_parent != 3) {
			# code...
			if ($type != NULL) {
				# code...
				if ($id != NULL) {
					# code...
					$data['list']    = $this->Allcrud->getdata('mr_try_out_soal',array('id_parent'=>$id_parent,'id_type'=>$type,'id_paket'=>$id));					
				}
				else
				{
					$data['list'] = array();
				}
			}
			else
			{
				$data['list'] = array();				
			}			
		}
		else
		{
			$data['list']    = $this->Allcrud->getdata('mr_try_out_soal',array('id_parent'=>$id_parent,'id_paket'=>$id));			
		}
		$data['parent']  = $id_parent;
		$data['type']    = $type;
		$data['paket']   = $id;
		$this->load->view('templateAdmin',$data);		
	}

	public function get_data_paket($id=NULL)
	{
		# code...
		$res_status = "";
		$res_text   = "";
		$res_data   = "";
		$data       = $this->Allcrud->getData('mr_try_out_list',array('id'=>$id));				
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
				if ($res_data[0]['jawaban'] == true) {
					# code...
					$res_data[0]['jawaban'] = 1;
				}
				else {
					# code...
					$res_data[0]['jawaban'] = 0;
				}
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

	public function detail_soal($id=NULL,$id_parent=NULL,$id_type=NULL,$id_paket)
	{
		# code...
		$this->Globalrules->session_rule();						
		$data['title']     = 'Detail Soal';
		$data['content']   = 'management/try_out/detail';
		$data['list']      = $this->get_data($id,'result_array','mr_try_out_soal');
		$data['list_soal'] = $this->Allcrud->getdata('mr_try_out_soal',array('id_parent'=>$id_parent,'id_type'=>$id_type,'id_paket'=>$id_paket))->result_array();
		$data['detail']    = $this->Allcrud->getData('mr_try_out_soal_detail',array('id_soal'=>$id));
		$data['id']        = $id;
		$data['parent']    = $id_parent;
		$data['type']      = $id_type;
		$this->load->view('templateAdmin',$data);
	}	

	public function store_verified($id,$value)
	{
		# code...
		$data_store['audit_verified'] = $value;
		$res_data  = $this->Allcrud->editData('mr_try_out_soal',$data_store,array('id'=>$id));		
		$text_status = $this->Globalrules->check_status_res($res_data,'Data Soal dan Jawaban telah terverifikasi.');					
		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);			
	}

	public function store_soal_detail($param=NULL,$iod=NULL)
	{
		# code...
		$res_data    = 0;
		$text_status = '';
		$data_sender = $this->input->post('data_sender');		

		if ($param == 'insert') {
			# code...
			for ($i=0; $i < count($data_sender); $i++) { 
				# code...
				$data_store = $this->Globalrules->trigger_insert_update($data_sender[$i]['crud']);
				$count_data = $this->Allcrud->getData('mr_try_out_soal_detail',array('id_soal'=>$data_sender[$i]['oid_header']));
				$data_alp   = $this->Globalrules->data_alphabet(count($count_data->result_array()));			

				if ($data_sender[$i]['f_jawaban'] == 'true') {
					# code...
					$data_store1['jawaban'] = $data_alp;
					$data_store ['jawaban'] = 'false';
					$res_data  = $this->Allcrud->editData('mr_try_out_soal',$data_store1,array('id'=>$data_sender[$i]['oid_header']));
					// $res_data  = $this->Allcrud->editData('mr_soal_detail',$data_store,array('id_soal'=>$data_sender[$i]['oid_header']));
				}
				$data_store['choice']  = $data_alp;
				$data_store['id_soal'] = $data_sender[$i]['oid_header'];
				$data_store['name']    = $data_sender[$i]['f_name'];
				$data_store['jawaban'] = $data_sender[$i]['f_jawaban'];
				$data_store['bobot']   = $data_sender[$i]['f_bobot'];
				$res_data    = $this->Allcrud->addData('mr_try_out_soal_detail',$data_store);
				$text_status = $this->Globalrules->check_status_res($res_data,'Data Jawaban telah berhasil ditambahkan.');			
			}			
		}
		elseif ($param == 'update') {
			# code...
			if ($data_sender['f_jawaban'] == 'true') {
				# code...
				$data_store1['jawaban'] = $data_sender['f_key'];
				$data_store ['jawaban'] = 'false';
				$res_data  = $this->Allcrud->editData('mr_try_out_soal',$data_store1,array('id'=>$data_sender['oid_header']));
				$res_data  = $this->Allcrud->editData('mr_try_out_soal_detail',$data_store,array('id_soal'=>$data_sender['oid_header']));
			}			
			$data_store['name']      = $data_sender['f_name'];
			$data_store['jawaban']   = $data_sender['f_jawaban'];
			$res_data    = $this->Allcrud->editData('mr_try_out_soal_detail',$data_store,array('id'=>$data_sender['oid']));
			$text_status = $this->Globalrules->check_status_res($res_data,'Data Jawaban telah berhasil diubah.');			
		}
		elseif($param == 'delete')
		{
			$res_data          = $this->Allcrud->delData('mr_try_out_soal_detail',array('id'=>$iod));
			$text_status       = $this->Globalrules->check_status_res($res_data,'Data Jawaban telah berhasil dihapus.');			
		}

		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);		
	}

	public function upload_data_soal($arg,$oid=NULL)
	{
		# code...
		$config['upload_path']   = FCPATH.'/public/soal/';
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['max_size']      = '5000';
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
			// if ( ! $this->upload->do_upload('file')){
			// 	$res_data = 0;
			// 	$msg      = $this->upload->display_errors();
			// 	$f_file   = "";
			// }
			// else
			// {
			// 	$dataupload = $this->upload->data();
			// 	$res_data   = 1;				
			// 	$msg        = $dataupload['file_name']." berhasil diupload";
			// 	$f_file     = $this->upload->data('file_name');
			// }

			// if ($res_data == 1) {
			// 	if ($f_file != '')$data_store['image'] = $f_file;
	
			// 	$data_store['image']      = $f_file;
			// 	            $process     = $this->Allcrud->addData_with_return_id('mr_buku',$data_store);
			// 	            $res_data    = $process['status'];
			// 	            $res_data_id = $process['id'];
			// 	            $text_status = $this->Globalrules->check_status_res($res_data,$msg);
			// }
			// else {
			// 	# code...
			// 	$text_status = $msg;								
			// }
		}
		elseif ($arg == 'update') {
			# code...
			$get_data     = $this->get_data($oid,'result_array','mr_try_out_soal');
			$path_to_file = $config['upload_path'].$get_data[0]['image'];
			if ($get_data[0]['image'] != '' || $get_data[0]['image'] != NULL) {
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
				if ($f_file != '')$data_store['image'] = $f_file;
	
				$data_store['image']      = $f_file;
								$process     = $this->Allcrud->editData('mr_try_out_soal',$data_store,array('id'=>$oid));
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
	
	public function upload_data_pembahasan($arg,$oid=NULL)
	{
		# code...
		$config['upload_path']   = FCPATH.'/public/pembahasan/';
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['max_size']      = '5000';
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
			// if ( ! $this->upload->do_upload('file')){
			// 	$res_data = 0;
			// 	$msg      = $this->upload->display_errors();
			// 	$f_file   = "";
			// }
			// else
			// {
			// 	$dataupload = $this->upload->data();
			// 	$res_data   = 1;				
			// 	$msg        = $dataupload['file_name']." berhasil diupload";
			// 	$f_file     = $this->upload->data('file_name');
			// }

			// if ($res_data == 1) {
			// 	if ($f_file != '')$data_store['image'] = $f_file;
	
			// 	$data_store['image']      = $f_file;
			// 	            $process     = $this->Allcrud->addData_with_return_id('mr_buku',$data_store);
			// 	            $res_data    = $process['status'];
			// 	            $res_data_id = $process['id'];
			// 	            $text_status = $this->Globalrules->check_status_res($res_data,$msg);
			// }
			// else {
			// 	# code...
			// 	$text_status = $msg;								
			// }
		}
		elseif ($arg == 'update') {
			# code...
			$get_data     = $this->get_data($oid,'result_array','mr_try_out_soal');
			$path_to_file = $config['upload_path'].$get_data[0]['image_desc'];
			if ($get_data[0]['image_desc'] != '' || $get_data[0]['image_desc'] != NULL) {
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
				if ($f_file != '')$data_store1['image_desc'] = $f_file;
	
				$data_store1['image_desc']      = $f_file;
								$process     = $this->Allcrud->editData('mr_try_out_soal',$data_store1,array('id'=>$oid));
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

	public function upload_data_soal_jawaban($arg,$oid=NULL)
	{
		# code...
		$config['upload_path']   = FCPATH.'/public/soal/';
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['max_size']      = '5000';
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
		}
		elseif ($arg == 'update') {
			# code...
			$get_data     = $this->get_data($oid,'result_array','mr_try_out_soal_detail');
			$path_to_file = $config['upload_path'].$get_data[0]['image'];
			if ($get_data[0]['image'] != '' || $get_data[0]['image'] != NULL) {
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
				if ($f_file != '')$data_store['image'] = $f_file;
	
				$data_store['image']     = $f_file;
				$process     = $this->Allcrud->editData('mr_try_out_soal_detail',$data_store,array('id'=>$oid));
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

	public function true_answer($id,$parent)
	{
		# code...
		$get_key                = $this->Allcrud->getData('mr_try_out_soal_detail',array('id'=>$id))->result_array()[0]['choice'];
		$data_store['jawaban']  = $get_key;		
		$data_store1['jawaban'] = 'false';
		$data_store2['jawaban'] = 'true';		
		$res_data  = $this->Allcrud->editData('mr_try_out_soal',$data_store,array('id'=>$parent));
		$res_data  = $this->Allcrud->editData('mr_try_out_soal_detail',$data_store1,array('id_soal'=>$parent));
		$res_data  = $this->Allcrud->editData('mr_try_out_soal_detail',$data_store2,array('id'=>$id));		

		$text_status = $this->Globalrules->check_status_res($res_data,'Data Jawaban telah berhasil diubah.');					

		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);			
	}
}