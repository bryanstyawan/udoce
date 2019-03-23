<section id="tipeData" class="col-lg-4">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Paket Try Out</h3>
			</div><!-- /.box-header -->
			<div class="box-body" id="table_fill">
				<table class="table table-bordered table-striped">
					<thead>
				<tr>
					<th>No</th>
					<th>Nama</th>
					<th>Aksi</th>
				</tr>
				</thead>
				<tbody>
					<?php
						if ($tipe != array()) {
							# code...
							for ($i=0; $i < count($tipe); $i++) { 
								# code...
					?>
								<tr>
									<td><?=$i+1;?></td>
									<td><?=$tipe[$i]['name'];?></td>								
									<td>
										<button class="btn btn-primary btn-xs" onclick="choose_paket_try_out('<?php echo $tipe[$i]['id'];?>','<?=$tipe[$i]['name'];?>')"><i class="fa fa-edit"></i> Pilih</button>&nbsp;&nbsp;								
									</td>								
								</tr>
					<?php
							}
						}
					?>
				</tbody>
				</table>
				
			</div><!-- /.box-body -->
			</div><!-- /.box -->
	</div>
</section>

<section id="viewdata" style="display:none;">
	<div class="col-xs-8">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title" id="header_paket"></h3>
				<div class="box-tools pull-right"><button class="btn btn-block btn-primary" id="addData"><i class="fa fa-plus-square"></i> Tambah Data</button></div>
			</div><!-- /.box-header -->
			<div class="box-body" id="table_fill">
				<input type="hidden" id="oid_parent">
				<input type="hidden" id="name_parent">				
				<table class="table table-bordered table-striped" id="view_data_paket">
					<thead>

					</thead>
					<tbody>
					
					</tbody>
				</table>
				
			</div><!-- /.box-body -->
			</div><!-- /.box -->
	</div>
</section>

<section id="formdata" style="display:none">
	<div class="col-xs-8">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title"></h3>
				<div class="box-tools pull-right"><button class="btn btn-block btn-danger" id="closeData"><i class="fa fa-close"></i></button></div>				
			</div>
			<div class="box-body">
				<div class="row">
					<input class="form-control" type="hidden" id="oid">
					<input class="form-control" type="hidden" id="crud">					
					<div class="col-md-6">
						<div class="form-group">
							<label>Nama Paket</label>
							<input type="text" class="form-control" id="f_name" rows="3" placeholder="Nama Paket">
						</div>
					</div>

					<div id="formdata_mini_tryout" style="display:none;">

						<div class="col-md-6">
							<div class="form-group">
								<label>Tanggal Publish</label>
								<input type="text" class="form-control timerangewithtime" id="f_time_publish" placeholder="Tanggal Publish">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label>Tanggal Berakhir</label>
								<input type="text" class="form-control timerangewithtime" id="f_time_expired" placeholder="Tanggal Berakhir">
							</div>
						</div>											

						<div class="col-md-6">
							<div class="form-group">
								<label>Durasi (menit)</label>
								<input type="number" class="form-control" id="f_durasi" placeholder="Tanggal Publish">
							</div>
						</div>					

						<div class="col-md-6">
							<div class="form-group">
								<label>Keterangan</label>
								<textarea class="form-control" id="f_remark" rows="3" placeholder="Keterangan"></textarea>
							</div>
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
		$("#formdata > div > div > div.box-header > h3").html("Tambah Paket Try Out "+$("#name_parent").val());		
		$("#crud").val('insert');
		var _parent_ = $("#oid_parent").val();
		if (_parent_ == 3) {
			$("#formdata_mini_tryout").css({"display": ""})
		}
		else
		{
			$("#formdata_mini_tryout").css({"display": "none"})			
		}
	})

	$("#closeData").click(function(){
		$("#formdata").css({"display": "none"})
		$("#viewdata").css({"display": ""})		
	})	

	$("#btn-trigger-controll").click(function(){
		var res_status     = 0;
		var oid            = $("#oid").val();
		var oid_parent     = $("#oid_parent").val();
		var crud           = $("#crud").val();
		var f_name         = $("#f_name").val();
		var f_time_publish = $("#f_time_publish").val();
		var f_time_expired = $("#f_time_expired").val();
		var f_remark       = $("#f_remark").val();
		var f_durasi       = $("#f_durasi").val();		

		var data_sender = {
			'oid'              : oid,
			'crud'             : crud,
			'oid_parent'       : oid_parent,
			'f_name'           : f_name,
			'f_time_publish'   : f_time_publish,
			'f_time_expired'   : f_time_expired,			
			'f_durasi'   	   : f_durasi,			
			'f_remark'		   : f_remark
		}

		if (f_name.length <= 0) {
			if (f_name.length <= 0) {
				Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
				{
					title: 'Peringatan',					
					msg: "Nama Paket belum terisi, mohon lengkapi data tersebut"
				});				
			}
		}
		else
		{
			$.ajax({
				url :"<?php echo site_url();?>management/try_out/store",
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

function choose_paket_try_out(_id,_name) {
	$.ajax({
		url :"<?php echo site_url();?>management/try_out/get_data_paket_try_out/"+_id+"",
		type:"post",
		beforeSend:function(){
			$("#formdata").css({"display": "none"})			
			$("#loadprosess").modal('show');
			$('#view_data_paket thead').html('');			
			$('#view_data_paket tbody').html('');						
		},
		success:function(msg){
			var obj = jQuery.parseJSON (msg);
			console.table(obj);
			$("#oid_parent").val(_id);
			$("#name_parent").val(_name);
			$("#header_paket").html(_name);

			child = "";
			if (_id != 3) {
				for (index = 0; index < obj.type.length; index++) {
					child = child+'<td>'+obj.type[index].name+'</td>';
				}				
			}
			else
			{
				child = "<td>Keterangan</td><td>Tanggal Publish</td><td>Tanggal Berakhir</td><td>Durasi</td><td>Soal</td>";
			}

			var newrec_header  = '<tr>'+
									'<td>No</td>'+
									'<td>Nama Paket</td>'+child+
									'<td>Status</td>'+
									'<td>Aksi</td>'+																		
								'</tr>';
			$('#view_data_paket thead').append(newrec_header);                    

			for (index = 0; index < obj.list.length; index++) {
				child_result        = "";
				counter_child       = "";
				style_child         = "";
				status_child        = "";
				total_counter_child = "";
				type_try_out        = "";
				style_tr            = "";	

				if (_id != 3) {
					for (index1 = 0; index1 < obj.type.length; index1++) 
					{
						if (obj.type[index1].name == 'TPA') {
							counter_child = obj.list[index].tpa;
							type_try_out  = "spmb";
						}
						else if (obj.type[index1].name == 'TBI'){
							counter_child = obj.list[index].tbi;						
							if (obj.list[index].tpa < 60) {
								style_child = "style='display:none;'";
							}
							total_counter_child = obj.list[index].tpa + obj.list[index].tbi;
							type_try_out        = "spmb";
						}
						else if (obj.type[index1].name == 'TWK'){
							counter_child = obj.list[index].twk;
							type_try_out  = "skd";
						}					
						else if (obj.type[index1].name == 'TIU'){
							counter_child = obj.list[index].tiu;
							type_try_out  = "skd";
							if (obj.list[index].twk < 35) {
								style_child = "style='display:none;'";
							}						
						}					
						else if (obj.type[index1].name == 'TKK'){
							counter_child = obj.list[index].tkk;						
							if (obj.list[index].tiu < 30) {
								style_child = "style='display:none;'";
							}					
							type_try_out        = "skd";
							total_counter_child = obj.list[index].twk + obj.list[index].tiu + obj.list[index].tkk;
						}					

						
						if (total_counter_child > obj.list[index].verified) {
							style_tr = "background-color: #E91E63;color: #fff;";
						}
						else
						{
							if (obj.list[index].verified != 0) {
								style_tr = "background-color: #8BC34A;color: #fff;";							
							}
							else
							{
								style_tr = "background-color: #E91E63;color: #fff;";							
							}
						}


						if (type_try_out == 'spmb') {
							if (total_counter_child == 90) {
								total_counter_child = 'Soal try out telah siap';
							}
							else
							{
								total_counter_child = total_counter_child+' Soal';
							}						
						}
						else if(type_try_out == 'skd')
						{
							if (total_counter_child == 100) {
								total_counter_child = 'Soal try out telah siap';
							}
							else
							{
								total_counter_child = total_counter_child+' Soal';
							}
						}

						child_result = child_result+'<td>'+
														'<span class="pull-left">'+counter_child+'</span>'+
														'<a onclick="go('+_id+','+obj.type[index1].id+','+obj.list[index].id+')" class="btn btn-primary pull-right" '+style_child+'>'+obj.type[index1].name+'</a>'+
													'</td>';
					}					
				}
				else
				{
					counter_child = obj.list[index].mini_tryout;					
					total_counter_child = obj.list[index].mini_tryout;
					if (total_counter_child > obj.list[index].verified) {
						style_tr = "background-color: #E91E63;color: #fff;";
						total_counter_child = total_counter_child+' Soal';						
					}
					else
					{
						if (obj.list[index].verified != 0) {
							style_tr = "background-color: #8BC34A;color: #fff;";							
							total_counter_child = 'Soal try out telah siap';							
						}
						else
						{
							style_tr = "background-color: #E91E63;color: #fff;";							
							total_counter_child = total_counter_child+' Soal';							
						}

					}										
					child_result =  '<td>'+obj.list[index].remark+'</td>'+
									'<td>'+obj.list[index].time_publish+'</td>'+
									'<td>'+obj.list[index].time_expired+'</td>'+									
									'<td>'+obj.list[index].durasi+' Menit</td>'+																			
									'<td>'+
										'<span class="pull-left">'+counter_child+'</span>'+
										'<a onclick="go('+_id+','+3+','+obj.list[index].id+')" class="btn btn-primary pull-right" '+style_child+'>Soal</a>'+
									'</td>';					
				}			


				verified = '';
				if (obj.list[index].verified != 0) {
					verified = ' - '+obj.list[index].verified+' Terverifikasi';
				}
				
				text_verified     = "";
				verified_status   = "";				
				btn_verified      = "";
				if (obj.list[index].publish != 0) {
					verified          = ' - '+((obj.list[index].verified != 0)?obj.list[index].verified:"")+' Terverifikasi';
					text_verified     = "Batalkan Publikasi";					
					verified_status   = 0;					
					btn_verified      = "btn-warning";
					fa_icon           = "fa-close";
					style_tr          = "background-color: #8BC34A;color: #fff;";					
				}
				else
				{
					verified          = '';
					text_verified     = "Publikasikan";										
					verified_status   = 1;			
					btn_verified      = "btn-success";
					fa_icon           = "fa-check";												
					style_tr          = "background-color: #E91E63;color: #fff;";										
				}


				var newrec_body  = '<tr style="'+style_tr+'">'+
										'<td>'+(index+1)+'</td>'+
										'<td>'+obj.list[index].name+'</td>'+child_result+
										'<td>'+total_counter_child+' '+verified+'</td>'+
										'<td>'+
											'<a class="btn '+btn_verified+' col-lg-12" onclick="verification('+obj.list[index].id+','+verified_status+')" style="margin-bottom: 19px;"><i class="fa '+fa_icon+'"></i>&nbsp;'+text_verified+'</a>'+										
											'<a class="btn btn-warning col-lg-12" onclick="edit('+obj.list[index].id+')" style="margin-bottom: 19px;"><i class="fa fa-edit"></i>&nbsp;Ubah</a>'+
											'<a class="btn btn-danger col-lg-12" onclick="del('+obj.list[index].id+')"><i class="fa fa-trash"></i>&nbsp;Hapus</a></td>'+																			
									'</tr>';
				$('#view_data_paket tbody').append(newrec_body);                    				
			}


			$("#viewdata").css({"display": ""})		
			$("#loadprosess").modal('hide');			
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
					url :"<?php echo site_url();?>management/try_out/store/"+'delete/'+id,
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

function verification(id,status)
{					
	Lobibox.confirm({
		title   : "Konfirmasi",
		msg     : "Verifikasi Paket Soal ini ?",
		callback: function ($this, type) {
			if (type === 'yes'){			
				$.ajax({
					url :"<?php echo site_url();?>management/try_out/store/"+'verify/'+id+'/'+status,
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

function go(id_parent,type,id) {
	window.open("<?php echo site_url();?>management/try_out/soal/"+id_parent+"/"+type+"/"+id,'_blank');		
}

function edit(id) {
	$.ajax({
		url :"<?php echo site_url();?>management/try_out/get_data_paket/"+id+"",
		type:"post",
		beforeSend:function(){
			$("#loadprosess").modal('show');
		},
		success:function(msg){
			var obj = jQuery.parseJSON (msg);
			if (obj.status == 1)
			{
				$(".form-control-detail").val('');
				$("#formdata").css({"display": ""})
				$("#viewdata").css({"display": "none"})
				$("#formdata > div > div > div.box-header > h3").html("Ubah Data Paket");		
				$("#crud").val('update');
				var _parent_ = $("#oid_parent").val();
				if (_parent_ == 3) {
					$("#formdata_mini_tryout").css({"display": ""})
					$("#f_time_publish").val(obj.data[0]['time_publish']);
					$("#f_time_expired").val(obj.data[0]['time_expired']);					
					$("#f_remark").val(obj.data[0]['remark']);					
				}
				else
				{
					$("#formdata_mini_tryout").css({"display": "none"})			
				}				
				$("#oid").val(obj.data[0]['id']);
				$("#f_name").val(obj.data[0]['name']);				
				// $("#f_desc_pembahasan").val(obj.data[0]['desc_pembahasan']);								
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
</script>