<section id="headerdata" class="col-xs-12">
		<input type="hidden" id="oid_header" value="">				
		<?php
		if ($list != array()) {
			# code...
			for ($i=0; $i < count($list); $i++) { 
				# code...
		?>
		<div class="box">
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
							<label class="col-lg-1"><?=$i+1;?>.</label>
							<label class="col-lg-11"><?=$list[$i]['name'];?></label>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
					<table class="table table-bordered table-striped">
					<body>
						<?php
							$detail = $this->Allcrud->getData('mr_soal_detail',array('id_soal'=>$list[$i]['id']))->result_array();
							if ($detail != array()) {
								# code...
								for ($ii=0; $ii < count($detail); $ii++) { 
									# code...
						?>
									<tr>
										<td style="width: 5%;"><?=$detail[$ii]['choice'];?>.</td>
										<td style="width: 100%;"><?=$detail[$ii]['name'];?>.</td>
										<td><a class="btn btn-primary">Pilih</a></td>
									</tr>
						<?php
								}
							}
						?>
					</body>
					</table>
					</div>
				</div>

			</div><!-- /.box-body -->
		</div><!-- /.box -->		
		<?php
			}			
		}
		?>
</section>

<section class="col-lg-12">
<div class="box">
	<div class="box-header">
			<h3 class="box-title"></h3>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-lg-12 text-center">
					<a class="btn btn-success">Selesai dan Lanjutkan</a>
				</div>
			</div>

		</div><!-- /.box-body -->		
	</div>
</section>

<script>
$(document).ready(function(){
	$("#addData").click(function()
	{
		$(".form-control-detail").val('');
		$("#formdata").css({"display": ""})
		$("#viewdata").css({"display": "none"})
		$("#formdata > div > div > div.box-header > h3").html("Tambah Data Deskripsi Pilihan");		
		$("#crud").val('insert');
	})

	$("#closeData").click(function(){
		$("#formdata").css({"display": "none"})
		$("#viewdata").css({"display": ""})		
	})	

	$("#btn-trigger-controll").click(function(){
		var res_status = 0;
		var oid_header = $("#oid_header").val();
		var oid        = $("#oid").val();
		var crud       = $("#crud").val();
		var f_name     = $("#f_name").val();
		var f_jawaban  = $("#f_jawaban").is(":checked");
		var f_key      = $("#f_key").val();

		var data_sender = {
			'oid'       : oid,
			'crud'      : crud,
			'oid_header': oid_header,
			'f_name'    : f_name,
			'f_jawaban' : f_jawaban,
			'f_key'     : f_key 
		}

		if (f_name.length <= 0) {
			if (f_name.length <= 0) {
				Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
				{
					title: 'Peringatan',					
					msg: "Data Deskripsi Pilihan belum terisi, mohon lengkapi data tersebut"
				});				
			}
		}
		else
		{
			$.ajax({
				url :"<?php echo site_url();?>bank_data/soal/store_detail",
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
		url :"<?php echo site_url();?>bank_data/soal/get_data/"+id+"/ajax/mr_soal_detail",
		type:"post",
		beforeSend:function(){
			$("#loadprosess").modal('show');
		},
		success:function(msg){
			var obj = jQuery.parseJSON (msg);
			if (obj.status == 1)
			{
				// $(".form-control").val('');
				$("#formdata").css({"display": ""})
				$("#viewdata").css({"display": "none"})
				$("#formdata > div > div > div.box-header > h3").html("Ubah Data Soal");		
				$("#crud").val('update');
				$("#oid").val(obj.data[0]['id']);
				$("#f_name").val(obj.data[0]['name']);
				$("#f_jawaban").val(obj.data[0]['name']);
				$("#f_key").val(obj.data[0]['choice']);																
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
					url :"<?php echo site_url();?>bank_data/soal/store_detail/"+'delete/'+id,
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