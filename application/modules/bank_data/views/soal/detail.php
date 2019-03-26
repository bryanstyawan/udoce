<?php
	if ($list != array()) {
		# code...
?>

<section id="headerdata" >
	<div class="col-xs-8">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title"></h3>
			</div>
			<div class="box-body">
				<div class="row">
					<input type="hidden" id="oid_header" value="<?=$list[0]['id'];?>">				
					<div class="col-md-6">
						<div class="form-group">
							<label>Deskripsi Soal</label>
							<textarea class="form-control" id="f_name_soal" rows="3" placeholder="Deskripsi Soal" disabled="disabled"><?=$list[0]['name'];?></textarea>
						</div>
					</div>

					<div class="col-md-6">						
						<div class="form-group">
							<label>Deskripsi Pembahasan</label>
							<textarea class="form-control" id="f_desc_pembahasan_soal" rows="3" placeholder="Deskripsi Pembahasan" disabled="disabled"><?=$list[0]['desc_pembahasan'];?></textarea>
						</div>						
					</div>
				</div>

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
									$data_soal        = $this->Allcrud->getdata('mr_soal',array('id'=>$list_soal[$i]['id']))->result_array();
									$counter          = count($this->Allcrud->getdata('mr_soal_detail',array('id_soal'=>$list_soal[$i]['id']))->result_array());
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

									if ($id == $list_soal[$i]['id']) {
										# code...
										$color            = "color:#fff";										
										$background_color = 'background-color: #2196F3;';																				
									}
						?>
									<a href="<?=base_url();?>bank_data/soal/detail/<?=$list_soal[$i]['id'];?>/<?=$list_soal[$i]['id_materi'];?>/<?=$list_soal[$i]['id_parent'];?>/<?=$list_soal[$i]['id_tipe_soal'];?>" class="btn btn-default" style="<?=$background_color;?><?=$color;?>"><?=$i+1;?></a>
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

<section id="viewdata">
	<div class="col-xs-12">
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
					<th>No</th>
					<th></th>
					<th>Deskripsi Pilihan</th>
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
							<td><?php echo $x;?></td>
							<td><?php echo $row->choice;?></td>							
							<td><?php echo ($row->image == '') ? $row->name : '<img src="'.base_url().'public/jawaban/'.$row->image.'">';?></td>
							<td>
								<button class="btn btn-primary btn-xs" onclick="edit('<?php echo $row->id;?>')"><i class="fa fa-edit"></i> Ubah</button>&nbsp;&nbsp;
								<?php
									if ($row->jawaban == 'false') {
										# code...
								?>
								<!-- <button class="btn btn-success btn-xs" onclick="true_answer('<?php echo $row->id;?>')"><i class="fa "></i> Jawaban Yang Benar</button>								 -->
								<?php
									}
								?>
								<!-- <button class="btn btn-danger btn-xs" onclick="del('<?php echo $row->id;?>')"><i class="fa fa-trash"></i> Hapus</button> -->
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

					<div class="col-md-7" id="edit-only">
						<div class="form-group">
							<label>File Jawaban</label>
							<input type="file" class="form-control" placeholder="File Gambar" id="f_file">
							<a class="btn btn-primary btn-md" id="btn_upload_soal"><i class="fa fa-upload"></i>&nbsp;Upload</a>							
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

<section id="formdatamulti" style="display:none">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title"></h3>
				<div class="box-tools pull-right"><button class="btn btn-block btn-danger" id="closeDatamulti"><i class="fa fa-close"></i></button></div>				
			</div>
			<div class="box-body">
				<?php
					$counter = "";
					if ($parent == 1) {
						# code...
						$counter = 4;
					}
					elseif($parent == 2)
					{
						$counter = 5;
					}
					for ($i=0; $i < $counter; $i++) { 
						# code...
				?>
				<div class="row">
					<input class="form-control" name="oidmulti" type="hidden" id="oid_multi_<?=$i;?>">
					<input class="form-control" type="hidden" id="crud_multi_<?=$i;?>" value="insert">
					<input class="form-control" type="hidden" id="f_key_multi_<?=$i;?>">										
					<div class="col-md-6">
						<div class="form-group">
							<label>Deskripsi Pilihan</label>
							<textarea class="form-control form-control-detail" id="f_name_multi_<?=$i;?>" rows="3" placeholder="Deskripsi Pilihan"></textarea>
						</div>
					</div>

					<div class="col-md-6">						
						<div class="form-group">
							<label>Jawaban yang benar</label>
							<br>
							<input class="minimal" id="f_jawaban_multi_<?=$i;?>" type="checkbox" style="display: block;position: absolute;width: 4%;height: 100%;">
						</div>						
					</div>
				</div>				
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

	$("#btn-trigger-controll-multi").click(function() {
        var data_sender = [];
        var inputs      = document.getElementsByName("oidmulti");
		var flag = 0;
		for (index = 0; index < inputs.length; index++) {
			data_sender[index] = {
				'oid'       : $("#oid_multi_"+index).val(),
				'crud'      : $("#crud_multi_"+index).val(),
				'oid_header': $("#oid_header").val(),
				'f_name'    : $("#f_name_multi_"+index).val(),
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

		if (flag == 1) {
			$.ajax({
				url :"<?php echo site_url();?>bank_data/soal/store_detail_multi",
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

	$("#btn_upload_soal").click(function(){
		var oid         = $("#oid").val();
		var crud        = $("#crud").val();
		var oid_parent  = $("#id_parent").val();
		var data_sender = '';
		var data_detail = [];

		var f_file      = $("#f_file").prop('files')[0];
		if (f_file == undefined) {
		}
		else
		{
			var form_data = new FormData();
			form_data.append('file', f_file);
			$.ajax({
				url :"<?php echo site_url();?>bank_data/soal/upload_data_jawaban/"+crud+"/"+oid,						
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
					ajax_status(obj1);	
				},
				error:function(jqXHR,exception)
				{
					ajax_catch(jqXHR,exception);					
				}
			}); 			
		}		
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