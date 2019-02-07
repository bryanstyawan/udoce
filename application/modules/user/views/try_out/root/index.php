<div class="example-modal">
	<div class="modal modal-success fade" id="newData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="box-content">
			<div class="modal-dialog">
				<div class="modal-content">
					<input type="hidden" id="oid_token">
					<div class="modal-header" style="background-color:#00a7d0!important;border-color:#00a7d0!important;">
						<h4 class="modal-title">Masukan Token</h4>
						<button type="button" class="close hot" data-dismiss="modal" aria-label="Close" style="color: #795548;font-size: 39px;top: 0px;margin-top: 0px;">
							<span aria-hidden="true">&times;</span>
						</button>						
					</div>
					<div class="modal-body" style="background-color: #fff!important;">
						<label id="lbl_token" style="color: #000;font-weight: 400;font-size: 19px;">Token</label>
						<div class="form-group">
							<div class="input-group col-lg-12">
								<input type="text" id="f_token" name="f_token" class="form-control" placeholder="Token" maxlength="18">
							</div>
							<div class="input-group col-lg-12">
								<div class="btn" style="margin-top: 30px;">
									<a href="#" id="btn-verify" style="background: #323232;padding: 10px 30px;color: #fff;text-transform: uppercase;font-weight: 700;text-decoration: none;">Verifikasi Token</a>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<style>
	@import url(https://fonts.googleapis.com/css?family=Lato:400,700);

	#price {
	text-align: center;
	}

	.plan {
	display: inline-block;
	margin: 10px 1%;
	font-family: 'Lato', Arial, sans-serif;
	}

	.plan-inner {
	background: #fff;
	margin: 0 auto;
	min-width: 280px;
	max-width: 100%;
	position:relative;
	}

	.entry-title {
	background: #53CFE9;
	height: 140px;
	position: relative;
	text-align: center;
	color: #fff;
	margin-bottom: 30px;
	}

	.entry-title>h3 {
	background: #20BADA;
	font-size: 20px;
	padding: 5px 0;
	text-transform: uppercase;
	font-weight: 700;
	margin: 0;
	}

	.entry-title .price {
	position: absolute;
	bottom: -25px;
	background: #20BADA;
	height: 95px;
	width: 95px;
	margin: 0 auto;
	left: 0;
	right: 0;
	overflow: hidden;
	border-radius: 50px;
	border: 5px solid #fff;
	line-height: 80px;
	font-size: 28px;
	font-weight: 700;
	}

	.price span {
	position: absolute;
	font-size: 9px;
	bottom: -10px;
	left: 30px;
	font-weight: 400;
	}

	.entry-content {
	color: #323232;
	}

	.entry-content ul {
	margin: 0;
	padding: 0;
	list-style: none;
	text-align: center;
	}

	.entry-content li {
	border-bottom: 1px solid #E5E5E5;
	padding: 10px 0;
	}

	.entry-content li:last-child {
	border: none;
	}

	.hot {
		position: absolute;
		top: -7px;
		background: #F80;
		color: #fff;
		text-transform: uppercase;
		z-index: 2;
		padding: 2px 5px;
		font-size: 9px;
		border-radius: 2px;
		right: 10px;
		font-weight: 700;
	}
	.basic .entry-title {
	background: #75DDD9;
	}

	.basic .entry-title > h3 {
	background: #44CBC6;
	}

	.basic .price {
	background: #44CBC6;
	}

	.standard .entry-title {
	background: #4484c1;
	}

	.standard .entry-title > h3 {
	background: #3772aa;
	}

	.standard .price {
	background: #3772aa;
	}

	.ultimite .entry-title > h3 {
	background: #DD4B5E;
	}

	.ultimite .entry-title {
	background: #F75C70;
	}

	.ultimite .price {
	background: #DD4B5E;
	}
</style>
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
				<input type="hidden" id="bimbel_choice" value="<?=($verify_user_paid_bimbel != array()) ? $verify_user_paid_bimbel[0]['id_layanan'] : 0 ;?>">
				<input type="hidden" id="tryout_choice" value="<?=$verify_user_paid_try_out;?>">												
				<input type="hidden" id="tryout_count" value="<?=$verify_user_paid_try_out_count;?>">
				<input type="hidden" id="tryout_gratis" value="<?=$verify_user_paid_try_out_gratis;?>">								
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

<section id="offeringdata" style="display:none;">
	<div class="col-xs-8" id="bodyoffering">

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

	$("#btn-verify").click(function() {
		var oid_token = $("#oid_token").val();
		var token     = $("#f_token").val();

		data_sender = {
			'oid'  : oid_token,
			'token': token,
			'type' : 'tryout'
		}		

		$.ajax({
			url :"<?php echo site_url();?>user/verify_token",
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
	var bimbel_choice = $("#bimbel_choice").val();
	var tryout_choice = $("#tryout_choice").val();
	var tryout_count  = $("#tryout_count").val();
	var tryout_gratis = $("#tryout_gratis").val();
	$.ajax({
		url :"<?php echo site_url();?>management/try_out/get_data_paket_try_out/"+_id+"",
		type:"post",
		beforeSend:function(){
			$("#loadprosess").modal('show');
			$('#view_data_paket thead').html('');			
			$('#view_data_paket tbody').html('');						
			$("#offeringdata").css({"display": "none"})			
			$('#bodyoffering').html('');			
		},
		success:function(msg){
			var obj = jQuery.parseJSON (msg);
			$("#oid_parent").val(_id);
			$("#name_parent").val(_name);
			$("#header_paket").html(_name);

			var newrec_header  = '<tr>'+
									'<td>No</td>'+
									'<td>Nama Paket</td>'+
									'<td></td>'+									
								'</tr>';
			$('#view_data_paket thead').append(newrec_header);                    

			for (index = 0; index < obj.list.length; index++) 
			{
				paket_choice = "";
				lock_choice  = "Mulai";
				if (bimbel_choice == 1) 
				{
					if (tryout_count != 2) 
					{
						if (_id == tryout_choice) {
							paket_choice = 1;							
						}
						else
						{
							if (index == 0) {
								paket_choice = 1;						
							}
							else
							{
								paket_choice = 10;
								lock_choice = "<i class='fa fa-lock'></i>";						
							}						
						}
					}
					else
					{
						paket_choice = 1;
					}
				}
				else if(bimbel_choice == 2)
				{
					paket_choice = 1;
				}			
				else
				{
					if (tryout_count != 2) 
					{
						if (_id == tryout_choice) {
							paket_choice = 1;							
						}
						else
						{
							if (index == 0) {
								paket_choice = 1;						
							}
							else
							{
								paket_choice = 10;
								lock_choice = "<i class='fa fa-lock'></i>";						
							}						
						}
					}
					else
					{
						paket_choice = 1;
					}
				}

				if (index == 1) {
					if (tryout_gratis != 0) {
						if (tryout_gratis == 5) {
							if (_id == 1) {
								paket_choice = 1;
								lock_choice  = "Mulai";
							}
						}
						else if(tryout_gratis == 6)
						{
							if (_id == 2) {
								paket_choice = 1;
								lock_choice  = "Mulai";
							}
						}
					}
				}

				analisis_view = "";
				if (obj.list[index].show_analisis != 0) {
					analisis_view = '<a onclick="go('+_id+','+obj.list[index].id+',2)" class="btn btn-primary pull-left" style="margin-right: 10px;">Analisis</a>';
				}

				rangking_view = "";
				if (obj.list[index].show_analisis != 0) {
					rangking_view = '<a onclick="go('+_id+','+obj.list[index].id+',3)" class="btn btn-primary pull-left" style="margin-right: 10px;">Rangking</a>';
				}				

				var newrec_body  = '<tr>'+
										'<td>'+(index+1)+'</td>'+
										'<td>'+obj.list[index].name+'</td>'+
										'<td>'+
										'<a onclick="go('+_id+','+obj.list[index].id+','+paket_choice+')" class="btn btn-primary pull-left" style="margin-right: 10px;">'+lock_choice+'</a>'+analisis_view+rangking_view+																				
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

function tryout_package(arg) {
	$("#newData").modal('show');  
	if (arg == 3) {
		$(".modal-title").html("Masukan Token Paket SPMB");
		$("#lbl_token").html("Token");
	}
	else if(arg == 4)
	{
		$(".modal-title").html("Masukan Token Paket SKD");		
		$("#lbl_token").html("Token");		
	}
	else if(arg == 5)
	{
		$(".modal-title").html("Masukan Password untuk Paket SPMB");				
		$("#lbl_token").html("Password");
		$("#f_token").attr("placeholder", "Password");		
	}
	else if(arg == 6)
	{
		$(".modal-title").html("Masukan Password untuk Paket SKD");				
		$("#lbl_token").html("Password");		
		$("#f_token").attr("placeholder", "Password");		
	}	
	$("#oid_token").val(arg);
}

function go(id_parent,id,type) {
	var bimbel_choice = $("#bimbel_choice").val();
	var tryout_choice = $("#tryout_choice").val();
	var tryout_count  = $("#tryout_count").val();	
	$('#bodyoffering').html('');				
	if (type == 1) {
		type = "mulai"; 
		window.open("<?php echo site_url();?>user/try_out/"+type+"/"+id_parent+"/"+id,'_blank');		
	}
	else if(type == 2)
	{
		type = "analisis";
		window.open("<?php echo site_url();?>user/try_out/"+type+"/"+id_parent+"/"+id,'_blank');		
	}
	else if(type == 3)
	{
		type = "rangking";		
		window.open("<?php echo site_url();?>user/try_out/"+type+"/"+id_parent+"/"+id,'_blank');		
	}
	else if(type == 10)
	{
		// alert($("#tryout_choice").val());
		$("#viewdata").css({"display": "none"})
		$("#offeringdata").css({"display": ""})
		if ($("#tryout_choice").val() == 1) {
			var view_choice = '<div class="plan basic">'+
									'<div class="plan-inner">'+
										'<div class="entry-title">'+
											'<h3 style="padding:10px;">Paket Try Out SKD</h3>'+
											'<div class="price">SKD<span></span>'+
											'</div>'+
										'</div>'+
										'<div class="entry-content">'+
											'<ul>'+
												'<li><strong></strong></li>'+
												'<li><strong></strong></li>'+
												'<li><strong></strong></li>'+
											'</ul>'+
										'</div>'+
										'<div class="row text-center">'+
											'<a class="btn btn-danger"  href="#" onclick="tryout_package('+4+')" style="margin-bottom: 25px;">Beli Sekarang</a>'+
										'</div>'+
										'<div class="row text-center">'+
											'<a class="btn btn-primary"  href="#" onclick="cara_beli()" style="margin-bottom: 25px;">Cara Beli</a>'+
										'</div>'+										
									'</div>'+
								'</div>'+
								'<div class="plan basic">'+
									'<div class="plan-inner">'+
										'<div class="entry-title">'+
											'<h3 style="padding:10px;">Gratis </h3>'+
											'<div class="price">SKD<span></span>'+
											'</div>'+
										'</div>'+
										'<div class="entry-content">'+
											'<ul>'+
												'<li><strong></strong></li>'+
												'<li><strong></strong></li>'+
												'<li><strong></strong></li>'+
											'</ul>'+
										'</div>'+
										'<div class="row text-center">'+
											'<a class="btn btn-danger"  href="#" onclick="tryout_package('+6+')" style="margin-bottom: 25px;">Klik Disini</a>'+
										'</div>'+
									'</div>'+
								'</div>';
			$('#bodyoffering').append(view_choice);   			
		}
		else if ($("#tryout_choice").val() == 2) {
			var view_choice = '<div class="plan basic">'+
									'<div class="plan-inner">'+
										'<div class="entry-title">'+
											'<h3 style="padding:10px;">Paket Try Out SPMB PKN STAN</h3>'+
											'<div class="price">SPMB<span></span>'+
											'</div>'+
										'</div>'+
										'<div class="entry-content">'+
											'<ul>'+
												'<li><strong></strong></li>'+
												'<li><strong></strong></li>'+
												'<li><strong></strong></li>'+
											'</ul>'+
										'</div>'+
										'<div class="row text-center">'+
											'<a class="btn btn-danger"  href="#" onclick="tryout_package('+3+')" style="margin-bottom: 25px;">Beli Sekarang</a>'+
										'</div>'+
										'<div class="row text-center">'+
											'<a class="btn btn-primary"  href="#" onclick="cara_beli()" style="margin-bottom: 25px;">Cara Beli</a>'+
										'</div>'+										
									'</div>'+
								'</div>'+
								'<div class="plan basic">'+
									'<div class="plan-inner">'+
										'<div class="entry-title">'+
											'<h3 style="padding:10px;">Gratis </h3>'+
											'<div class="price">SPMB<span></span>'+
											'</div>'+
										'</div>'+
										'<div class="entry-content">'+
											'<ul>'+
												'<li><strong></strong></li>'+
												'<li><strong></strong></li>'+
												'<li><strong></strong></li>'+
											'</ul>'+
										'</div>'+
										'<div class="row text-center">'+
											'<a class="btn btn-danger"  href="#" onclick="tryout_package('+5+')" style="margin-bottom: 25px;">Klik Disini</a>'+
										'</div>'+
									'</div>'+
								'</div>';
			$('#bodyoffering').append(view_choice);   			
		}
		else
		{
			_text = "";
			_id   = 0;
			if (id_parent == 1) {
				_text = "SPMB";
				_id   = 5;
			} else if(id_parent == 2) {
				_text = "SKD";
				_id   = 6;
			}

			var view_choice = '<div class="plan basic">'+
									'<div class="plan-inner">'+
										'<div class="entry-title">'+
											'<h3 style="padding:10px;">Paket Try Out SPMB PKN STAN</h3>'+
											'<div class="price">SPMB<span></span>'+
											'</div>'+
										'</div>'+
										'<div class="entry-content">'+
											'<ul>'+
												'<li><strong></strong></li>'+
												'<li><strong></strong></li>'+
												'<li><strong></strong></li>'+
											'</ul>'+
										'</div>'+
										'<div class="row text-center">'+
											'<a class="btn btn-danger"  href="#" onclick="tryout_package('+3+')" style="margin-bottom: 25px;">Beli Sekarang</a>'+
										'</div>'+
										'<div class="row text-center">'+
											'<a class="btn btn-primary"  href="#" onclick="cara_beli()" style="margin-bottom: 25px;">Cara Beli</a>'+
										'</div>'+										
									'</div>'+
								'</div>'+
								'<div class="plan basic">'+
									'<div class="plan-inner">'+
										'<div class="entry-title">'+
											'<h3 style="padding:10px;">Paket Try Out SKD CPNS/PKN STAN</h3>'+
											'<div class="price">SKD<span></span>'+
											'</div>'+
										'</div>'+
										'<div class="entry-content">'+
											'<ul>'+
												'<li><strong></strong></li>'+
												'<li><strong></strong></li>'+
												'<li><strong></strong></li>'+
											'</ul>'+
										'</div>'+
										'<div class="row text-center">'+
											'<a class="btn btn-danger"  href="#" onclick="tryout_package('+4+')" style="margin-bottom: 25px;">Beli Sekarang</a>'+
										'</div>'+
										'<div class="row text-center">'+
											'<a class="btn btn-primary"  href="#" onclick="cara_beli()" style="margin-bottom: 25px;">Cara Beli</a>'+
										'</div>'+										
									'</div>'+
								'</div>'+
								'<div class="plan basic">'+
									'<div class="plan-inner">'+
										'<div class="entry-title">'+
											'<h3 style="padding:10px;">Gratis </h3>'+
											'<div class="price">'+_text+'<span></span>'+
											'</div>'+
										'</div>'+
										'<div class="entry-content">'+
											'<ul>'+
												'<li><strong></strong></li>'+
												'<li><strong></strong></li>'+
												'<li><strong></strong></li>'+
											'</ul>'+
										'</div>'+
										'<div class="row text-center">'+
											'<a class="btn btn-danger"  href="#" onclick="tryout_package('+_id+')" style="margin-bottom: 25px;">Klik Disini</a>'+
										'</div>'+
									'</div>'+
								'</div>';
			$('#bodyoffering').append(view_choice);                    								
		}
	}		
}
</script>