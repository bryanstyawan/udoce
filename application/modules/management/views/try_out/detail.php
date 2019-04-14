<?php
	if ($list != array()) {
		# code...
?>

<section id="headerdata" >
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title pull-right"><a class="btn btn-primary" onclick="verified('<?=$list[0]['id'];?>','<?=($list[0]['audit_verified'] == 1) ? '0' : '1' ;?>')" class="btn  <?=($list[0]['audit_verified'] == 1) ? 'btn-danger' : 'btn-success' ;?>">Soal dan jawaban ini <?=($list[0]['audit_verified'] == 1) ? 'Ada Kesalahan' : 'telah benar.' ;?></a></h3>
			</div>
			<div class="box-body">
				<div class="row">
					<input type="hidden" id="oid_header" value="<?=$list[0]['id'];?>">				
					<?php
						if ($type == 5) {
							# code...
					?>
					<div class="col-md-6">
						<div class="form-group">
							<label>Tema</label>
							<textarea class="form-control" id="f_tema" rows="3" placeholder="Tema" disabled="disabled"><?=$list[0]['tema'];?></textarea>
						</div>
					</div>				
					<?php
						}
					?>



					<!-- <label class="col-lg-12">Deskripsi Soal</label> -->
					<?php
						if ($list['0']['image'] == NULL) {
							# code...
					?>
							<div class="col-md-12 text-center">
								<div class="form-group">
									<label class="col-lg-12" style="text-align: left;">Soal</label>								
									<p><?=$list[0]['name'];?></p>
								</div>
							</div>									
					<?php
						} else {
							# code...
					?>	
							<div class="col-md-12 text-center">
								<div class="form-group">							
									<label class="col-lg-12" style="text-align: left;">Soal</label>								
									<img src="<?=base_url();?>public/soal/<?=$list['0']['image'];?>">										
								</div>
							</div>									
					<?php
						}
					?>

					<?php
						if ($type != 5) {
							# code...
							if ($list['0']['image_desc'] == NULL) 
							{
					?>
						<div class="col-md-12 text-center">						
							<label class="col-lg-12" style="text-align: left;">Deskripsi Pembahasan</label>
							<p><?=$list[0]['desc_pembahasan'];?></p>																					
						</div>
					<?php								
							}
							else
							{
					?>	
							<div class="col-md-12 text-center">
								<div class="form-group">							
								<label class="col-lg-12" style="text-align: left;">Deskripsi Pembahasan</label>								
									<img src="<?=base_url();?>public/pembahasan/<?=$list['0']['image_desc'];?>">										
								</div>
							</div>									
					<?php
							}							
						}
					?>												

				</div>

			</div><!-- /.box-body -->
		</div><!-- /.box -->
	</div>
</section>

<section id="viewdata">
	<div class="col-xs-8">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title"></h3>
				<?php
				if (count($detail->result_array()) == 0) {
					# code...
				?>
					<div class="box-tools pull-right">
						<button class="btn btn-block btn-primary" id="addDatamulti"><i class="fa fa-plus-square"></i> Tambah Data</button>
					</div>
					<div class="box-tools pull-right" style="margin-right: 130px;display:none;">
						<button class="btn btn-block btn-primary" id="addData"><i class="fa fa-plus-square"></i> Tambah Data (single)</button>
					</div>				
				<?php
				}
				?>				
			</div><!-- /.box-header -->
			<div class="box-body" id="table_fill">
				<table class="table table-bordered table-striped table-view">
					<thead>
				<tr>
					<th></th>
					<th>Deskripsi Pilihan</th>
					<?php
					if ($type == 5) {
						# code...
					?>
						<th>Bobot</th>
					<?php
					}
					?>
					<th>Aksi</th>
				</tr>
				</thead>
				<tbody>
				<?php $x=1;
					foreach($detail->result() as $row)
					{
						$color_row = "";
						if ($row->jawaban == 'true') {
							# code...
							$color_row = "background-color:#8BC34A;";
						}
						else
						{
							$color_row = "";							
						}
				?>
						<tr style="<?=$color_row;?>">
							<td><?php echo $row->choice;?></td>							
							<td><?php echo ($row->image == '') ? $row->name : '<img src="'.base_url().'public/soal/'.$row->image.'">';?></td>							
							<?php
							if ($type == 5) {
								# code...
							?>
								<td><?php echo $row->bobot;?></td>
							<?php
							}
							?>							
							<td>
								<button class="btn btn-primary btn-xs" onclick="edit('<?php echo $row->id;?>')"><i class="fa fa-edit"></i> Ubah</button>&nbsp;&nbsp;
								<?php
									if ($row->jawaban == 'false') {
										# code...
								?>
								<button class="btn btn-success btn-xs" onclick="true_answer('<?php echo $row->id;?>')"><i class="fa "></i> Jawaban Yang Benar</button>								
								<?php
									}
								?>
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
	<div class="col-xs-4">
		<div class="box">
		<div class="box-header">
				<h3 class="box-title"></h3>
			</div>
			<div class="box-body">
				<div class="row">
					<div class="col-lg-12">
						<?php
							if ($list_soal != array()) {
								# code...
								for ($i=0; $i < count($list_soal); $i++) { 
									# code...
									$background_color = '';
									$color            = "";
									$data_soal        = $this->Allcrud->getdata('mr_try_out_soal',array('id'=>$list_soal[$i]['id']))->result_array();
									$counter          = count($this->Allcrud->getdata('mr_try_out_soal_detail',array('id_soal'=>$list_soal[$i]['id']))->result_array());
									$get_bobot        = $this->Allcrud->getdata('mr_try_out_soal_detail',array('id_soal'=>$list_soal[$i]['id'],'bobot !='=>NULL))->result_array();

									if ($counter == 0) {
										# code...
										$color            = "color:#fff";										
										$background_color = 'background-color: #F44336;';
									}
									else {
										# code...
										if($counter >= 4)
										{
											if($data_soal[0]['jawaban'] != '')
											{
												$color            = "color:#fff";										
												$background_color = 'background-color: #8BC34A;';
											}
											else
											{
												$color            = "color:#fff";										
												$background_color = 'background-color: #F44336;';												
											}

										}
										else {
											# code...
											$color            = "color:#fff";										
											$background_color = 'background-color: #F44336;';											
										}
									}

									if ($type == 5) {
										# code...
										if ($get_bobot != array()) {
											# code...
											
											if (count($get_bobot) == 5) {
												# code...
												$color            = "color:#fff";										
												$background_color = 'background-color: #8BC34A;';																						
											}
											else {
												# code...
												$color            = "color:#fff";										
												$background_color = 'background-color: #2196F3;';											
											}
										}										
									}									

									if ($id == $list_soal[$i]['id']) {
										# code...
										$color            = "color:#fff";										
										$background_color = 'background-color: #2196F3;';																				
									}

									if ($list_soal[$i]['audit_verified'] == 1) {
										# code...
										$color            = "color:#fff";										
									}
									else
									{
										$color            = "color:#dd4b39";
									}
						?>
									<a href="<?=base_url();?>management/try_out/detail_soal/<?=$list_soal[$i]['id'];?>/<?=$list_soal[$i]['id_parent'];?>/<?=$list_soal[$i]['id_type'];?>/<?=$list_soal[$i]['id_paket'];?>" class="btn btn-default" style="<?=$background_color;?><?=$color;?>"><?=$i+1;?></a>
						<?php
								}								
							}
						?>
					</div>
				</div>

			</div><!-- /.box-body -->		
		</div>
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
					<input class="form-control" type="hidden" id="oid_header" value="<?=$id;?>">				
					<input class="form-control" type="hidden" id="oid">
					<input class="form-control" type="hidden" id="crud">
					<input class="form-control" type="hidden" id="f_key">										
					<div class="col-md-6">
						<div class="form-group">
							<label>Deskripsi Pilihan</label>
							<textarea class="form-control form-control-detail" id="f_name" rows="3" placeholder="Deskripsi Pilihan"></textarea>
						</div>
					</div>

					<div class="col-md-6">						
						<div class="form-group">
							<label>Jawaban yang benar</label>
							<br>
							<input class="minimal" id="f_jawaban" type="checkbox" style="display: block;position: absolute;width: 4%;height: 100%;">
						</div>						
					</div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>File</label>
							<input type="file" class="form-control" placeholder="File Gambar" id="f_file">
                        </div>
                    </div>

					<div class="col-lg-12">
						<div class="progress" style="display:none">
							<div id="progressBar" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
								<span class="sr-only">0%</span>
							</div>
						</div>
						<div class="msg alert alert-info text-left" style="display:none"></div>					
					</div>					
				</div>

			</div><!-- /.box-body -->
			<div class="box-footer">
				<a class="btn btn-success pull-right" id="btn-trigger-controll"><i class="fa fa-save"></i>&nbsp; Simpan</a>
			</div>
		</div><!-- /.box -->
	</div>
</section>

<section id="formdatamulti" style="display:none">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title"></h3>
				<div class="box-tools pull-right"><button class="btn btn-block btn-danger" id="closeDatamulti"><i class="fa fa-close"></i></button></div>				
			</div>
			<div class="box-body">
				<?php
					$counter = 5;
					if ($parent == 1) {
						# code...
						if ($type == 2) {
							# code...
							$counter = 4;							
						}
						else
						{
							$counter = 5;
						}
					}
					elseif($parent == 2)
					{
						$counter = 5;
					}
					for ($i=0; $i < $counter; $i++) { 
						# code...
						$_class = "";
						if ($type == 5) {
							# code...
							$_class = "col-lg-4";
						}
						else {
							# code...
							$_class = "col-lg-6";
						}
				?>
				<div class="row">
					<input class="form-control" name="oidmulti" type="hidden" id="oid_multi_<?=$i;?>">
					<input class="form-control" type="hidden" id="crud_multi_<?=$i;?>" value="insert">
					<input class="form-control" type="hidden" id="f_key_multi_<?=$i;?>">												
					<div class="<?=$_class;?>">
						<div class="form-group">
							<label class="col-lg-1">&nbsp;</label>						
							<label class="col-lg-11">Deskripsi Pilihan</label>
							<div class="col-lg-1 text-center">
								<div class="form-group">
									<label><?=$this->Globalrules->data_alphabet($i);?></label>
								</div>
							</div>							
							<div class="col-lg-11">							
								<textarea class="form-control form-control-detail" id="f_name_multi_<?=$i;?>" rows="3" placeholder="Deskripsi Pilihan"></textarea>							
							</div>
						</div>						
					</div>

					<?php
						if ($type == 5) {
							# code...
					?>
					<div class="col-md-4">
						<div class="form-group">
							<label>Bobot</label>
							<input type="text" class="form-control form-control-detail" id="f_bobot_multi_<?=$i;?>" rows="3" placeholder="Bobot">
						</div>
					</div>					
					<input id="f_jawaban_multi_<?=$i;?>" type="hidden">					
					<?php
						}
						else {
							# code...
							?>
								<input type="hidden" class="form-control form-control-detail" id="f_bobot_multi_<?=$i;?>" rows="3" placeholder="Bobot">							

								<div class="<?=$_class;?>">						
									<div class="form-group">
										<label>Jawaban yang benar</label>
										<br>
										<input class="minimal" id="f_jawaban_multi_<?=$i;?>" type="checkbox" style="display: block;position: absolute;width: 4%;height: 100%;">
									</div>						
								</div>								
							<?php
						}
					?>
				</div>				
				<hr>
				<?php
					}
				?>

			</div><!-- /.box-body -->
			<div class="box-footer">
				<a class="btn btn-success pull-right" id="btn-trigger-controll-multi"><i class="fa fa-save"></i>&nbsp; Simpan</a>
			</div>
		</div><!-- /.box -->
	</div>
</section>

<?php
	}
	else {
		# code...
?>
<section id="headerdata" >
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title"></h3>
			</div>
			<div class="box-body">
				<div class="row">

					<div class="col-md-12">
						<div class="form-group">
							<h3 class="text-center">Data Tidak Ditemukan</h3>
						</div>
					</div>

				</div>

			</div><!-- /.box-body -->
		</div><!-- /.box -->
	</div>
</section>
<?php
	}
?>

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

	$("#addDatamulti").click(function()
	{
		$(".form-control-detail").val('');
		$("#formdatamulti").css({"display": ""})
		$("#viewdata").css({"display": "none"})
		$("#formdata > div > div > div.box-header > h3").html("Tambah Data Deskripsi Pilihan");		
		$("#crud").val('insert');
	})	

	$("#closeData").click(function(){
		$("#formdata").css({"display": "none"})
		$("#viewdata").css({"display": ""})		
	})

	$("#closeDatamulti").click(function(){
		$("#formdatamulti").css({"display": "none"})
		$("#viewdata").css({"display": ""})		
	})		

	$("#btn-trigger-controll").click(function(){
        var data_sender = [];
        var crud        = $("#crud").val(); 
        var inputs      = document.getElementsByName("oidmulti");
        var flag        = 0;

		if (crud == 'update') 
		{
			data_sender = {
					'oid'       : $("#oid").val(),
					'crud'      : crud,
					'oid_header': $("#oid_header").val(),
					'f_name'    : $("#f_name").val(),
					'f_bobot'   : $("#f_bobot").val(),
					'f_jawaban' : $("#f_jawaban").is(":checked"),
					'f_key'     : $("#f_key").val()
				}			
			flag = 1;	

			var f_file      = $("#f_file").prop('files')[0];
			if (f_file != undefined)
			{
				var form_data = new FormData();
				form_data.append('file', f_file);
				$.ajax({
					url :"<?php echo site_url();?>management/try_out/upload_data_soal_jawaban/"+crud+"/"+$("#oid").val(),						
					// dataType: 'json',  // what to expect back from the PHP script, if anything
					cache: false,
					contentType: false,
					processData: false,
					data: form_data,
					type: 'post',
					xhr : function() {
						var xhr = new window.XMLHttpRequest();
						xhr.upload.addEventListener('progress', function(e){
							if(e.lengthComputable){								
								var percent = Math.round((e.loaded / e.total) * 100);
								$('#progressBar').attr('aria-valuenow', percent).css('width', percent + '%').text(percent + '%');
							}
						});
						return xhr;
					},											
					beforeSend:function(){
						$("#editData").modal('hide');
						$("#loadprosess").modal('show');                                                
					},
					success: function(msg1){
						var obj1 = jQuery.parseJSON (msg1);             	
						if (obj1.status == 1)
						{
							Lobibox.notify('Sukses', {msg: obj1.text});
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

		if (flag == 1) {
			$.ajax({
				url :"<?php echo site_url();?>management/try_out/store_soal_detail/"+crud,
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
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
				{
					title: 'Peringatan',					
					msg: "Harap lengkapi data"
				});							
		}
	})

	$("#btn-trigger-controll-multi").click(function() {
        var data_sender = [];
        var crud        = $("#crud").val(); 
        var inputs      = document.getElementsByName("oidmulti");
        var flag        = 0;

		if (crud == 'insert') 
		{
			for (index = 0; index < inputs.length; index++) {
				data_sender[index] = {
					'oid'       : $("#oid_multi_"+index).val(),
					'crud'      : $("#crud_multi_"+index).val(),
					'oid_header': $("#oid_header").val(),
					'f_name'    : $("#f_name_multi_"+index).val(),
					'f_bobot'   : $("#f_bobot_multi_"+index).val(),
					'f_jawaban' : $("#f_jawaban_multi_"+index).is(":checked"),
					'f_key'     : $("#f_key_multi_"+index).val()
				}			

				if ($("#f_name_multi_"+index).val().length <= 0) {
					flag = 0;
				}
				else 
				{
					flag = 1;
				}
			}			
		}
		else
		{
			data_sender = {
					'oid'       : $("#oid").val(),
					'crud'      : crud,
					'oid_header': $("#oid_header").val(),
					'f_name'    : $("#f_name").val(),
					'f_bobot'   : $("#f_bobot").val(),
					'f_jawaban' : $("#f_jawaban").is(":checked"),
					'f_key'     : $("#f_key").val()
				}			
		}

		if (flag == 1) {
			$.ajax({
				url :"<?php echo site_url();?>management/try_out/store_soal_detail/"+crud,
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
			Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
				{
					title: 'Peringatan',					
					msg: "Harap lengkapi data"
				});							
		}
		console.table(data_sender);
	})
})

function edit(id){
	$.ajax({
		url :"<?php echo site_url();?>bank_data/soal/get_data/"+id+"/ajax/mr_try_out_soal_detail",
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
				if (obj.data[0]['jawaban'] == 'true') 
				{
					$("#f_jawaban").prop('checked',true);					
				}
				else
				{
					$("#f_jawaban").prop('checked', false);
				}

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

function true_answer(id)
{
	Lobibox.confirm({
		title   : "Konfirmasi",
		msg     : "Anda yakin, jawaban ini yang benar ?",
		callback: function ($this, type) {
			if (type === 'yes'){			
				$.ajax({
					url :"<?php echo site_url();?>management/try_out/true_answer/"+id+"/"+$("#oid_header").val(),					
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

function verified(id,value)
{
	Lobibox.confirm({
		title   : "Konfirmasi",
		msg     : "Verifikasi soal dan jawaban ini ?",
		callback: function ($this, type) {
			if (type === 'yes'){			
				$.ajax({
					url :"<?php echo site_url();?>management/try_out/store_verified/"+id+"/"+value,					
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

function del(id)
{					
	Lobibox.confirm({
		title   : "Konfirmasi",
		msg     : "Anda yakin akan menghapus data ini ?",
		callback: function ($this, type) {
			if (type === 'yes'){			
				$.ajax({
					url :"<?php echo site_url();?>management/try_out/store_soal_detail/"+'delete/'+id,
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