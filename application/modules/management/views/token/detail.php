<section id="viewdata">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title"></h3>
				<div class="box-tools pull-right">
					<!-- <button class="btn btn-warning btn-block" onclick="generate('<?php echo $oid;?>')"><i class="fa fa-cogs"></i> Generate Token</button>&nbsp;&nbsp; -->
				</div>
			</div><!-- /.box-header -->		
			<div class="box-body" id="table_fill">
				<table class="table table-bordered table-striped table-view">
					<thead>
				<tr>
					<th>No</th>
					<th><?=($oid == 5 || $oid == 6) ? 'Password' : 'Nama Token' ;?></th>
					<?=($oid == 5 || $oid == 6) ? '<th>Aksi</th>' : '<th>Status</th>' ;?>
				</tr>
				</thead>
				<tbody>
				<?php $x=1;
					foreach($list->result() as $row){
						$text = "";
						$style = "";
						if ($row->status == 1) {
							# code...
							$text = "Belum Terpakai";
						}
						else {
							# code...
							$style = "style='background-color: #8BC34A;'";
							$text = "Telah Terpakai";
						}						
				?>
						<tr <?=$style;?>>
							<td><?php echo $x;?></td>
							<td><?php echo $row->name;?></td>
							<?=($oid == 5 || $oid == 6) ? '<td><a onclick="edit('.$row->id.')" class="btn btn-primary">Ubah</a></td>' : '<td>'.$text.'</td>' ;?>							
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
							<label>Password</label>
							<input type="text" class="form-control" id="f_name" placeholder="Judul Buku">
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
	$("#btn-trigger-controll").click(function(){
		var res_status = 0;
		var oid        = $("#oid").val();
		var crud       = $("#crud").val();
		var f_name     = $("#f_name").val();

		var data_sender = {
			'oid'       : oid,
			'crud'      : crud,
			'f_name'    : f_name,
		}

		if (crud == 'insert') {
			if (f_name.length <= 0) {
				res_status = 0;
				if(f_name.length <= 0) {
					Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
					{
						title: 'Peringatan',					
						msg: "Data Nama belum terisi, mohon lengkapi data tersebut"
					});								
				}
			}
			else
			{
				res_status = 1;
			}			
		}
		else if(crud == 'update')
		{
			if (f_name.length <= 0) {
				res_status = 0;
				if(f_name.length <= 0) {
					Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
					{
						title: 'Peringatan',					
						msg: "Data Nama belum terisi, mohon lengkapi data tersebut"
					});								
				}
			}
			else
			{
				res_status = 1;
			}			
		}

		if(res_status == 1)
		{
			$.ajax({
				url :"<?php echo site_url();?>management/token/store/",
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
function generate(id)
{					
	Lobibox.confirm({
		title   : "Konfirmasi",
		msg     : "Ingin generate token layanan ini ?",
		callback: function ($this, type) {
			if (type === 'yes'){			
				$.ajax({
					url :"<?php echo site_url();?>management/token/store/"+'insert/'+id,
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

function edit(id){
	$.ajax({
		url :"<?php echo site_url();?>management/token/get_data/"+id+"/ajax",
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
				$("#formdata > div > div > div.box-header > h3").html("Ubah Data Soal");		
				$("#crud").val('update');
				$("#oid").val(obj.data[0]['id']);
				$("#f_name").val(obj.data[0]['name']);				
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