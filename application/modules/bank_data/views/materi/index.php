<section id="viewdata">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<!-- <h3 class="box-title"><button class="btn btn-block btn-primary" id="ruleData"><i class="fa cogs"></i> Aturan Bimbingan Belajar</button></h3> -->
				<div class="box-tools pull-right"><button class="btn btn-block btn-primary" id="addData"><i class="fa fa-plus-square"></i> Tambah Data</button></div>
			</div><!-- /.box-header -->
			<div class="box-body" id="table_fill">
				<table class="table table-bordered table-striped table-view">
					<thead>
				<tr>
					<th>No</th>
					<th>Materi</th>
					<th>Sub Materi</th>					
					<th>Pre Test</th>
					<th>Video Materi</th>					
					<th>Quiz</th>
					<th>action</th>
				</tr>
				</thead>
				<tbody>
				<?php 
					$x  = 1;
					foreach($list->result() as $row){
						$child = $this->Allcrud->getData('mr_materi',array('id_parent'=>$row->id));						
				?>
						<tr>
							<td><?php echo $x;?></td>
							<td><?php echo $row->name;?></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>																					
							<td>
								<button class="btn btn-primary btn-xs" onclick="edit('<?php echo $row->id;?>')"><i class="fa fa-edit"></i> Ubah</button>&nbsp;&nbsp;
								<button class="btn btn-success btn-xs" onclick="detail('<?php echo $row->id;?>')"><i class="fa fa-edit"></i> Sub Materi</button>&nbsp;&nbsp;							
				<?php
								if (count($child->result_array()) == 0) {
									# code...
				?>
									<button class="btn btn-danger btn-xs" onclick="del('<?php echo $row->id;?>')"><i class="fa fa-trash"></i> Hapus</button>				
				<?php
								}
				?>
							</td>
						</tr>
				<?php 
							foreach ($child->result() as $key) {
								# code...
								$pre_test = $this->Allcrud->getdata('mr_soal',array('id_materi'=>$key->id,'id_parent'=>$row->id,'id_tipe_soal'=>1))->result_array();
								$video    = $this->Allcrud->getdata('mr_video',array('id_materi'=>$key->id,'id_parent'=>$row->id))->result_array();
								$quiz     = $this->Allcrud->getdata('mr_soal',array('id_materi'=>$key->id,'id_parent'=>$row->id,'id_tipe_soal'=>3))->result_array();
				?>
								<tr>
									<td></td>
									<td></td>									
									<td><?php echo $key->name;?></td>
									<?php 
										$x  = 1;
										foreach($tipe->result() as $row_td){
											if ($row_td->id != 4) {
												# code...
									?>
												<td>
													<span class="pull-left">
														<?php
															if ($row_td->id == 1) {
																# code...
																echo (count($pre_test)!=0?count($pre_test).' Soal':'');
															}
															elseif ($row_td->id == 2) {
																# code...
																echo (count($video)!=0?count($video).' Video':'');
															}
															elseif ($row_td->id == 3) {
																# code...
																echo (count($quiz)!=0?count($quiz).' Soal':'');
															}
														?>
													</span>
													<button class="btn btn-primary btn-xs pull-right" onclick="go('<?php echo $row_td->name;?>','<?php echo $row_td->id;?>','<?php echo $key->id;?>',<?php echo $row->id;?>)"><i class="fa fa-edit"></i> <?php echo $row_td->text;?></button>&nbsp;&nbsp;
												</td>
									<?php 							
											}
										}
									?>																											
									<td>
										<button class="btn btn-primary btn-xs" onclick="edit('<?php echo $key->id;?>')"><i class="fa fa-edit"></i> Ubah</button>&nbsp;&nbsp;
										<?php
											if (count($pre_test) == 0 && count($video) == 0 && count($quiz) == 0) {
												# code...
										?>
												<button class="btn btn-danger btn-xs" onclick="del('<?php echo $key->id;?>')"><i class="fa fa-trash"></i> Hapus</button>										
										<?php
											}
										?>
									</td>
								</tr>
				<?php								
							}
						$x++; 
					}
				?>
				</tbody>
				</table>
				
			</div><!-- /.box-body -->
			</div><!-- /.box -->
	</div>
</section>

<section id="formdata" style="display:none">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title"></h3>
				<div class="box-tools pull-right"><button class="btn btn-block btn-danger" id="closeData"><i class="fa fa-close"></i></button></div>				
			</div>
			<div class="box-body">
				<div class="row">
					<input class="form-control" type="hidden" id="oid">
					<input class="form-control" type="hidden" id="crud">					
					<input class="form-control" type="hidden" id="parent">
					<div class="col-md-6">
						<div class="form-group">
							<label>Deskripsi</label>
							<input type="text" class="form-control" id="f_name" placeholder="Deskripsi materi">
						</div>
					</div>
				</div>

			</div><!-- /.box-body -->
			<div class="box-footer">
				<a class="btn btn-success pull-right" id="btn-trigger-controll"><i class="fa fa-save"></i>&nbsp; Simpan</a>
			</div>
		</div><!-- /.box -->
	</div>
</section>
<script>
$(document).ready(function(){
	$("#addData").click(function()
	{
		$(".form-control").val('');
		$("#formdata").css({"display": ""})
		$("#viewdata").css({"display": "none"})
		$("#formdata > div > div > div.box-header > h3").html("Tambah Data materi");		
		$("#crud").val('insert');
	})

	$("#closeData").click(function(){
		$("#formdata").css({"display": "none"})
		$("#viewdata").css({"display": ""})		
	})	

	$("#btn-trigger-controll").click(function(){
		var res_status        = 0;
		var oid               = $("#oid").val();
		var crud              = $("#crud").val();
		var f_name            = $("#f_name").val();
		var parent            = $("#parent").val();		

		var data_sender = {
			'oid'     : oid,
			'crud'    : crud,
			'f_name'  : f_name,
			'f_parent': parent
		}

		if (f_name.length <= 0) {
			if (f_name.length <= 0) {
				Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
				{
					title: 'Peringatan',					
					msg: "Data Deskripsi materi belum terisi, mohon lengkapi data tersebut"
				});				
			}
		}
		else
		{
			$.ajax({
				url :"<?php echo site_url();?>bank_data/soal/store_materi",
				type:"post",
				data:{data_sender : data_sender},
				beforeSend:function(){
					$("#editData").modal('hide');
					$("#loadprosess").modal('show');
				},
				success:function(msg){
					var obj = jQuery.parseJSON (msg);
					ajax_status(obj);
				},
				error:function(jqXHR,exception)
				{
					ajax_catch(jqXHR,exception);					
				}
			})
		}
	})
})

function edit(id){
	$.ajax({
		url :"<?php echo site_url();?>bank_data/soal/get_data/"+id+"/ajax/mr_materi",
		type:"post",
		beforeSend:function(){
			$("#loadprosess").modal('show');
		},
		success:function(msg){
			var obj = jQuery.parseJSON (msg);
			if (obj.status == 1)
			{
				$(".form-control").val('');
				$("#formdata").css({"display": ""})
				$("#viewdata").css({"display": "none"})
				$("#formdata > div > div > div.box-header > h3").html("Ubah Data materi");		
				$("#crud").val('update');
				$("#oid").val(obj.data[0]['id']);
				$("#f_name").val(obj.data[0]['name']);
				$("#parent").val(obj.data[0]['id_parent']);								
				$("#loadprosess").modal('hide');				
			}
			else
			{
				Lobibox.notify('warning',{msg: obj.text});
				setTimeout(function(){
					$("#loadprosess").modal('hide');
				}, 500);
			}						
		},
		error:function(jqXHR,exception)
		{
			ajax_catch(jqXHR,exception);					
		}
	})
}

function del(id)
{					
	Lobibox.confirm({
		title   : "Konfirmasi",
		msg     : "Anda yakin akan menghapus data ini ?",
		callback: function ($this, type) {
			if (type === 'yes'){			
				$.ajax({
					url :"<?php echo site_url();?>bank_data/soal/store_materi/"+'delete/'+id,
					type:"post",
					beforeSend:function(){
						$("#editData").modal('hide');
						$("#loadprosess").modal('show');
					},
					success:function(msg){
						var obj = jQuery.parseJSON (msg);
						ajax_status(obj);
					},
					error:function(jqXHR,exception)
					{
						ajax_catch(jqXHR,exception);					
					}
				})
			}
		}
	})		
}

function detail(id) {
	$(".form-control").val('');
	$("#formdata").css({"display": ""})
	$("#viewdata").css({"display": "none"})
	$("#formdata > div > div > div.box-header > h3").html("Tambah data sub materi");		
	$("#crud").val('insert');
	$("#oid").val();
	$("#parent").val(id);				
	$("#loadprosess").modal('hide');
}

function detail_soal(id,parent) {
	window.location.href = "<?php echo site_url();?>bank_data/soal/pre_test_and_quiz/"+id+"/"+parent	
}

function go(arg,param,id,parent) {
	if (param != 2) {
		window.open("<?php echo site_url();?>bank_data/soal/index/"+arg+"/"+id+"/"+parent+"/"+param,'_blank');		
	}
	else
	{
		window.open("<?php echo site_url();?>bank_data/video/video_materi/"+id+"/"+parent+"/"+param,'_blank');		
	}
}

</script>