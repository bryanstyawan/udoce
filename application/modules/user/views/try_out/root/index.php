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
								if ($tipe[$i]['id'] != 3) {
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

			var newrec_header  = '<tr>'+
									'<td>No</td>'+
									'<td>Nama Paket</td>'+
									'<td></td>'+									
								'</tr>';
			$('#view_data_paket thead').append(newrec_header);                    

			for (index = 0; index < obj.list.length; index++) {
				var newrec_body  = '<tr>'+
										'<td>'+(index+1)+'</td>'+
										'<td>'+obj.list[index].name+'</td>'+
										'<td>'+
										'<a onclick="go('+_id+','+obj.list[index].id+',1)" class="btn btn-primary pull-left" style="margin-right: 10px;">Mulai</a>'+
										'<a onclick="go('+_id+','+obj.list[index].id+',2)" class="btn btn-primary pull-left" style="margin-right: 10px;">Analisis</a>'+
										'<a onclick="go('+_id+','+obj.list[index].id+',3)" class="btn btn-primary pull-left" style="margin-right: 10px;">Rangking</a>'+																				
										'</td>'+									
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

function go(id_parent,id,type) {
	if (type == 1) {
		type = "mulai"; 
	}
	else if(type == 2)
	{
		type = "analisis";
	}
	else if(type == 3)
	{
		type = "rangking";		
	}

	window.open("<?php echo site_url();?>user/try_out/"+type+"/"+id_parent+"/"+id,'_blank');		
}
</script>