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
				$data['list'][$i]['tpa'] = count($this->Allcrud->getdata('mr_try_out_soal',array('id_parent'=>1,'id_type'=>1,'id_paket'=>$data['list'][$i]['id']))->result_array());
				$data['list'][$i]['tbi'] = count($this->Allcrud->getdata('mr_try_out_soal',array('id_parent'=>1,'id_type'=>2,'id_paket'=>$data['list'][$i]['id']))->result_array());
				$data['list'][$i]['twk'] = count($this->Allcrud->getdata('mr_try_out_soal',array('id_parent'=>2,'id_type'=>3,'id_paket'=>$data['list'][$i]['id']))->result_array());
				$data['list'][$i]['tiu'] = count($this->Allcrud->getdata('mr_try_out_soal',array('id_parent'=>2,'id_type'=>4,'id_paket'=>$data['list'][$i]['id']))->result_array());
				$data['list'][$i]['tkk'] = count($this->Allcrud->getdata('mr_try_out_soal',array('id_parent'=>2,'id_type'=>5,'id_paket'=>$data['list'][$i]['id']))->result_array());
			}
		}
		$data['type'] = $this->Allcrud->getData('mr_try_out_paket',array('id_parent'=>$id))->result_array();		
		echo json_encode($data);
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
			$data_store['id_parent'] = $data_sender['oid_parent'];
			$data_store['name']      = $data_sender['f_name'];
			            $res_data    = $this->Allcrud->addData('mr_try_out_list',$data_store);
			            $text_status = $this->Globalrules->check_status_res($res_data,'Paket Try Out telah berhasil ditambahkan.');
		} elseif ($data_sender['crud'] == 'update') {
			# code...
			$data_store['id_parent'] = $data_sender['oid_parent'];
			$data_store['name']      = $data_sender['f_name'];
			            $res_data    = $this->Allcrud->editData('mr_try_out_list',$data_store,array('id'=>$data_sender['oid']));
			            $text_status = $this->Globalrules->check_status_res($res_data,'Paket Try Out telah berhasil diubah.');
		} elseif ($data_sender['crud'] == 'delete') {
			# code...
			$res_data          = $this->Allcrud->delData('mr_try_out_list',array('id'=>$data_sender['oid']));
			$text_status       = $this->Globalrules->check_status_res($res_data,'Paket Try Out telah berhasil dihapus.');			
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
			            $res_data          = $this->Allcrud->editData('mr_soal',$data_store,array('id'=>$data_sender['oid']));
			            $text_status       = $this->Globalrules->check_status_res($res_data,'Data Paket Try out telah berhasil diubah.');			
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

	public function soal($id_parent,$type,$id)
	{
		# code...
		$this->Globalrules->session_rule();								
		$arg       = $this->Allcrud->getData('mr_try_out_paket',array('id'=>$type))->result_array()[0]['text'];
		$data['title']   = 'Soal Try Out '.$arg;
		$data['content'] = 'management/try_out/soal';
		$data['list']    = $this->Allcrud->getdata('mr_try_out_soal',array('id_parent'=>$id_parent,'id_type'=>$type,'id_paket'=>$id));
		$data['parent']  = $id_parent;
		$data['type']    = $type;
		$data['paket']   = $id;
		$this->load->view('templateAdmin',$data);		
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
		$data['type']      = $id_parent;
		$this->load->view('templateAdmin',$data);
	}	

	public function store_soal_detail(Type $var = null)
	{
		# code...
		$res_data    = 0;
		$text_status = '';
		$data_sender = $this->input->post('data_sender');		

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

		$res = array
					(
						'status' => $res_data,
						'text'   => $text_status
					);
		echo json_encode($res);		
	}
}