<section id="headerdata" >
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title"></h3>
			</div>
			<div class="box-body">
				<div class="row">
				<input type="hidden" id="id" value="<?=$materi->result_array()[0]['id'];?>">
				<input type="hidden" id="id_parent" value="<?=$materi->result_array()[0]['id_parent'];?>">								
					<div class="col-md-6">
						<div class="form-group">
							<label>Materi</label>
							<input type="text" class="form-control" id="f_name_soal" placeholder="Deskripsi Soal" disabled="disabled" value="<?=$parent->result_array()[0]['name'];?>">
						</div>
					</div>

					<div class="col-md-6">						
						<div class="form-group">
							<label>Deskripsi Pembahasan</label>
							<input type="text" class="form-control" id="f_desc_pembahasan_soal" rows="3" placeholder="Deskripsi Pembahasan" disabled="disabled" value="<?=$materi->result_array()[0]['name'];?>">
						</div>						
					</div>
				</div>

			</div><!-- /.box-body -->
		</div><!-- /.box -->
	</div>
</section>

<section id="viewdata">
	<input type="hidden" id="id_table" value="<?=$materi->result_array()[0]['id'];?>">
	<input type="hidden" id="id_parent" value="<?=$materi->result_array()[0]['id_parent'];?>">
	<input type="hidden" id="id_tipe" value="<?=$param;?>">												
	<!-- <div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title"></h3>
			</div>
			<div class="box-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Materi</label>
							<input type="text" class="form-control" disabled="disabled" value="<?=$parent->result_array()[0]['name'];?>">
						</div>
					</div>

					<div class="col-md-6">						
						<div class="form-group">
							<label>Deskripsi Pembahasan</label>
							<input type="text" class="form-control" disabled="disabled" value="<?=$materi->result_array()[0]['name'];?>">
						</div>						
					</div>
				</div>

			</div>
		</div>
	</div> -->

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
					<th>Soal</th>
					<th>Jumlah Pilihan Ganda</th>
					<th>Aksi</th>
				</tr>
				</thead>
				<tbody>
				<?php $x=1;
					foreach($list->result() as $row){?>
						<tr>
							<td><?php echo $x;?></td>
							<td><?php echo $row->name;?></td>
							<td><?=count($this->Allcrud->getdata('mr_soal_detail',array('id_soal'=>$row->id))->result_array());?></td>
							<td>
								<button class="btn btn-primary btn-xs" onclick="edit('<?php echo $row->id;?>')"><i class="fa fa-edit"></i> Ubah</button>&nbsp;&nbsp;
								<button class="btn btn-success btn-xs" onclick="detail('<?php echo $row->id;?>','<?php echo $row->id_materi;?>','<?php echo $row->id_parent;?>','<?php echo $row->id_tipe_soal;?>')"><i class="fa fa-edit"></i> Pilihan Ganda</button>&nbsp;&nbsp;							
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
							<label>Deskripsi Soal</label>
							<textarea class="form-control" id="f_name" rows="3" placeholder="Deskripsi Soal"></textarea>
						</div>
					</div>

					<div class="col-md-6">						
						<div class="form-group">
							<label>Deskripsi Pembahasan</label>
							<textarea class="form-control" id="f_desc_pembahasan" rows="3" placeholder="Deskripsi Pembahasan"></textarea>
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
		$("#formdata > div > div > div.box-header > h3").html("Tambah Data Soal");		
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
		var f_desc_pembahasan = $("#f_desc_pembahasan").val();
		var id_table          = $("#id_table").val();
		var id_parent         = $("#id_parent").val();
		var id_tipe           = $("#id_tipe").val();

		var data_sender = {
			'oid'              : oid,
			'crud'             : crud,
			'f_name'           : f_name,
			'f_desc_pembahasan': f_desc_pembahasan,
			'id_table'         : id_table,
			'id_parent'        : id_parent,
			'id_tipe'          : id_tipe
		}

		if (f_name.length <= 0 || f_desc_pembahasan.length <= 0) {
			if (f_name.length <= 0) {
				Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
				{
					title: 'Peringatan',					
					msg: "Data Deskripsi Soal belum terisi, mohon lengkapi data tersebut"
				});				
			} else if(f_desc_pembahasan.length <= 0) {
				Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
				{
					title: 'Peringatan',					
					msg: "Data Deskripsi Pembahasan belum terisi, mohon lengkapi data tersebut"
				});								
			}
		}
		else
		{
			$.ajax({
				url :"<?php echo site_url();?>bank_data/soal/store",
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

function detail(id,materi,parent,tipe) {
	window.location.href = "<?php echo site_url();?>bank_data/soal/detail/"+id+'/'+materi+'/'+parent+'/'+tipe
}
</script>