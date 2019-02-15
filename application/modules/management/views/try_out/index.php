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
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Konfigurasi</h3>
			</div><!-- /.box-header -->
			<div class="box-body" id="table_fill">
				<table class="table table-bordered table-striped">
					<thead>
				<tr>
					<th>No</th>
					<th>Konfigrasi</th>
					<th>Nilai</th>
					<th>Aksi</th>
				</tr>
				</thead>
				<tbody>
					<tr>
						<td>1</td>
						<td>Durasi</td>
						<td></td>
						<td></td>						
					</tr>
					<tr>
						<td>2</td>
						<td>Jumlah Soal</td>
						<td></td>
						<td></td>						
					</tr>					
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
	})

	$("#closeData").click(function(){
		$("#formdata").css({"display": "none"})
		$("#viewdata").css({"display": ""})		
	})	

	$("#btn-trigger-controll").click(function(){
		var res_status = 0;
		var oid        = $("#oid").val();
		var oid_parent = $("#oid_parent").val();
		var crud       = $("#crud").val();
		var f_name     = $("#f_name").val();


		var data_sender = {
			'oid'              : oid,
			'crud'             : crud,
			'oid_parent'       : oid_parent,
			'f_name'           : f_name
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
			for (index = 0; index < obj.type.length; index++) {
				child = child+'<td>'+obj.type[index].name+'</td>';
			}

			var newrec_header  = '<tr>'+
									'<td>No</td>'+
									'<td>Nama Paket</td>'+child+
									'<td>Status</td>'+									
								'</tr>';
			$('#view_data_paket thead').append(newrec_header);                    

			for (index = 0; index < obj.list.length; index++) {
				child_result        = "";
				counter_child       = "";
				style_child         = "";
				status_child        = "";
				total_counter_child = "";
				type_try_out        = "";
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

					
					style_tr = "";
					if (total_counter_child > obj.list[index].verified) {
						style_tr = "background-color: #E91E63;color: #fff;";
					}
					else
					{
						style_tr = "background-color: #8BC34A;color: #fff;";
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

				verified = '';
				if (obj.list[index].verified != 0) {
					verified = ' - '+obj.list[index].verified+' Terverifikasi';
				}

				var newrec_body  = '<tr style="'+style_tr+'">'+
										'<td>'+(index+1)+'</td>'+
										'<td>'+obj.list[index].name+'</td>'+child_result+
										'<td>'+total_counter_child+' '+verified+'</td>'+									
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

function edit(id){
	$.ajax({
		url :"<?php echo site_url();?>bank_data/soal/get_data/"+id+"/ajax/mr_soal",
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
				$("#formdata > div > div > div.box-header > h3").html("Ubah Data Soal");		
				$("#crud").val('update');
				$("#oid").val(obj.data[0]['id']);
				$("#f_name").val(obj.data[0]['name']);				
				$("#f_desc_pembahasan").val(obj.data[0]['desc_pembahasan']);								
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
					url :"<?php echo site_url();?>bank_data/soal/store/"+'delete/'+id,
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
</script>