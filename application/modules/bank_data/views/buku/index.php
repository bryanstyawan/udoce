<section id="viewdata">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title"></h3>
				<div class="box-tools pull-right"><button class="btn btn-block btn-primary" id="addData"><i class="fa fa-plus-square"></i> Tambah Data</button></div>
			</div><!-- /.box-header -->
			<div class="box-body" id="table_fill">
				<table class="table table-bordered table-striped table-view">
					<thead>
				<tr>
					<th>No</th>
					<th>Buku</th>
					<th>Nama File</th>					
					<th>Deskripsi</th>
					<th>action</th>
				</tr>
				</thead>
				<tbody>
				<?php $x=1;
					foreach($list->result() as $row){?>
						<tr>
							<td><?php echo $x;?></td>
							<td><?php echo $row->name;?></td>
							<td><?php echo $row->image;?></td>							
							<td><?php echo $row->desc;?></td>							
							<td>
								<button class="btn btn-primary btn-xs" onclick="edit('<?php echo $row->id;?>')"><i class="fa fa-edit"></i> Ubah</button>&nbsp;&nbsp;
								<button class="btn btn-danger btn-xs" onclick="del('<?php echo $row->id;?>')"><i class="fa fa-trash"></i> Hapus</button>
							</td>
						</tr>
					<?php $x++; }
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
					<div class="col-md-6">
						<div class="form-group">
							<label>Judul Buku</label>
							<input type="text" class="form-control" id="f_name" placeholder="Judul Buku">
						</div>
					</div>

					<div class="col-md-6">						
						<div class="form-group">
							<label>Sampul Buku</label>
							<input type="file" class="form-control" placeholder="File Gambar" id="f_file">
						</div>						
					</div>					

					<div class="col-md-6">						
						<div class="form-group">
							<label>Deskripsi</label>
							<textarea class="form-control" id="f_desc" rows="3" placeholder="Deskripsi"></textarea>
						</div>						
					</div>

					<div class="col-md-12" id="section_file" style="display:none;">
						<img src="" style="height: 360px;">
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
		$("#formdata > div > div > div.box-header > h3").html("Tambah Data Soal");		
		$("#crud").val('insert');
		$("#section_file").css({"display": "none"})				
	})

	$("#closeData").click(function(){
		$("#formdata").css({"display": "none"})
		$("#viewdata").css({"display": ""})		
	})	

	$("#btn-trigger-controll").click(function(){
		var res_status   = 0;
		var flag_allowed = 0;
		var oid          = $("#oid").val();
		var crud         = $("#crud").val();
		var f_name       = $("#f_name").val();
		var f_desc       = $("#f_desc").val();		
		var f_file       = $("#f_file").prop('files')[0];

		var data_sender = {
			'oid'   : oid,
			'crud'  : crud,
			'f_name': f_name,
			'f_desc': f_desc
		}

		if (crud == 'insert') {
			if (f_file == undefined) {
				flag_allowed = 0;
				Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
				{
					title: 'Peringatan',					
					msg: "Data Sampul Buku tidak ditemukan, mohon lengkapi data tersebut"
				});												
			}
			else
			{
				flag_allowed = 1;				
			}
		}
		else
		{
			flag_allowed = 1;
		}

		if (f_name.length <= 0 || f_file == undefined) {
			if (f_name.length <= 0) {
				Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
				{
					title: 'Peringatan',					
					msg: "Data Judul Buku belum terisi, mohon lengkapi data tersebut"
				});				
			}
		}
		else
		{
			if (f_file == undefined) {
				var data_sender = {
								'oid'   : oid,
								'crud'  : 'update',
								'f_name': f_name
							}				
				$.ajax({
					url :"<?php echo site_url();?>bank_data/buku/store",
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
			else
			{
				var form_data = new FormData();
				form_data.append('file', f_file);
				$.ajax({
					url :"<?php echo site_url();?>bank_data/buku/upload_data/"+crud+"/"+oid, // point to server-side PHP script
					// dataType: 'json',  // what to expect back from the PHP script, if anything
					cache: false,
					contentType: false,
					processData: false,
					data: form_data,
					type: 'post',
					beforeSend:function(){
						$("#editData").modal('hide');
						$("#loadprosess").modal('show');                                                
					},
					success: function(msg1){
						var obj1 = jQuery.parseJSON (msg1);             	
						if (obj1.status == 1)
						{
							var data_sender = {
								'oid'   : obj1.id,
								'crud'  : 'update',
								'f_name': f_name,
								'f_desc': f_desc
							}

							$.ajax({
								url :"<?php echo site_url();?>bank_data/buku/store",
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
						else
						{
							Lobibox.notify('warning', {msg: obj1.text});
							setTimeout(function(){
								$("#loadprosess").modal('hide');
							}, 500);
						}
					},
					error:function(jqXHR,exception)
					{
						ajax_catch(jqXHR,exception);					
					}
				}); 
			}
		}
	})
})

function edit(id){
	$.ajax({
		url :"<?php echo site_url();?>bank_data/soal/get_data/"+id+"/ajax/mr_buku",
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
				$("#section_file").css({"display": ""})										
				$("#viewdata").css({"display": "none"})
				$("#formdata > div > div > div.box-header > h3").html("Ubah Data Soal");		
				$("#crud").val('update');
				$("#oid").val(obj.data[0]['id']);
				$("#f_name").val(obj.data[0]['name']);				
				$("#f_desc").val(obj.data[0]['desc']);
				$("#section_file > img").attr("src",'<?=base_url();?>public/buku/'+obj.data[0]['image']);												
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
					url :"<?php echo site_url();?>bank_data/buku/store/"+'delete/'+id,
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
	window.location.href = "<?php echo site_url();?>bank_data/soal/detail/"+id
}
</script>