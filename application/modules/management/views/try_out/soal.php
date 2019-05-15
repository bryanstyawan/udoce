<section id="headerdata" style="display:none;">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title"></h3>
			</div>
			<div class="box-body">
				<div class="row">
                    <input type="hidden" id="id_parent" value="<?=$parent;?>">
                    <input type="hidden" id="id_type" value="<?=$type;?>">
                    <input type="hidden" id="id_paket" value="<?=$paket;?>">                								
					<!-- <div class="col-md-6">
						<div class="form-group">
                            <label>Materi</label>
						</div>
					</div>

					<div class="col-md-6">						
						<div class="form-group">
							<label>Deskripsi Pembahasan</label>
						</div>						
					</div> -->
				</div>

			</div><!-- /.box-body -->
		</div><!-- /.box -->
	</div>
</section>

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
					<th>Soal</th>
					<th>Pembahasan</th>					
					<th>Jumlah Pilihan Ganda</th>
					<th>Aksi</th>
				</tr>
				</thead>
				<tbody>
				<?php $x=1;
					if ($list != array()) {
						# code...
						foreach($list->result() as $row)
						{
					?>
							<tr>
								<td><?php echo $x;?></td>
								<td><?php echo ($row->image != NULL || $row->image != '') ? '<img src="'.base_url().'public/soal/'.$row->image.'">' : $row->name ;?></td>
								<td><?php echo ($row->image_desc != NULL || $row->image_desc != '') ? '<img src="'.base_url().'public/soal/'.$row->image_desc.'">' : $row->desc_pembahasan ;?></td>
								<td>
									<a target="_blank" href="<?=base_url();?>management/try_out/detail_soal/<?=$row->id;?>/<?=$row->id_parent;?>/<?=$row->id_type;?>/<?=$row->id_paket;?>" class="btn btn-primary pull-right"><?=count($this->Allcrud->getdata('mr_try_out_soal_detail',array('id_soal'=>$row->id))->result_array());?></a>
								</td>
								<td>
									<button class="btn btn-primary btn-xs" onclick="edit('<?php echo $row->id;?>')" style="margin: 1px;"><i class="fa fa-edit"></i> Ubah</button>&nbsp;&nbsp;
									<button class="btn btn-danger btn-xs" onclick="del('<?php echo $row->id;?>')"><i class="fa fa-trash"></i> Hapus</button>								
									<!--<button class="btn btn-success btn-xs" onclick="detail('<?php echo $row->id;?>')"><i class="fa fa-edit"></i> Pilihan Ganda</button>&nbsp;&nbsp;							
									-->
								</td>
							</tr>
					<?php 
							$x++; 
						}						
					}
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
			<div class="box-body" id="processdata">
				<div class="row">	
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Jumlah Data</label>
                            <input class="form-control form-control-detail" id="f_inputs" rows="3" placeholder="Jumlah data">
                        </div>
                        <a class="btn btn-primary" id="btn-process">Proses</a>
                    </div>                    
				</div>

			</div>

			<div class="box-body" id="editdata" style="display:none;">
				<div class="row">	
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Soal</label>
                            <input class="form-control form-control-detail" id="f_name" rows="3" placeholder="Soal">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Pembahasan</label>
                            <textarea class="form-control form-control-detail" id="f_desc_pembahasan" rows="3" placeholder="Jumlah data"></textarea>
                        </div>
                    </div>										
				

					<hr>
					<hr>					


                    <div class="col-md-6">
                        <div class="form-group">
                            <label>File Soal</label>
							<input type="file" class="form-control" placeholder="File Gambar" id="f_file">
							<a class="btn btn-primary btn-md" id="btn_upload_soal"><i class="fa fa-upload"></i>&nbsp;Upload</a>							
                        </div>
                    </div>				

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>File Pembahasan</label>
							<input type="file" class="form-control" placeholder="File Gambar" id="f_file_1">
							<a class="btn btn-primary btn-md" id="btn_upload_pembahasan"><i class="fa fa-upload"></i>&nbsp;Upload</a>							
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

			</div>			

			<div class="box-body" id="form_multipartdata" style="display:none;">
				<div class="row">
					<input class="form-control" type="hidden" id="oid">
					<input class="form-control" type="hidden" id="crud">					
                    <div id="multipartdata">
            
                    </div>  
				</div>

			</div>    


			<div class="box-footer" style="display:none;">
				<a class="btn btn-success pull-right" id="btn-trigger-controll"><i class="fa fa-save"></i>&nbsp; Simpan</a>
			</div>
		</div><!-- /.box -->
	</div>
</section>
<script>
$(document).ready(function(){
	$("#addData").click(function()
	{
        $(".form-control-detail").val('');
		$("#multipartdata").html('');        
        $("#formdata").css({"display": ""})
        $("#processdata").css({"display": ""})        
        $("#viewdata").css({"display": "none"})
        $("#editdata").css({"display": "none"})		
        $(".box-footer").css({"display": "none"})        
		$("#formdata > div > div > div.box-header > h3").html("Tambah Data Soal");		
		$("#crud").val('insert');
	})

	$("#closeData").click(function(){
		$("#formdata").css({"display": "none"})
        $("#viewdata").css({"display": ""})		
        $(".box-footer").css({"display": "none"})        
    })	
    
    $("#btn-process").click(function(){
        var process = $("#f_inputs").val();
        var type    = $("#id_type").val();
        if (process.length <= 0) {
            Lobibox.alert("warning", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                title: 'Peringatan',					
                msg: "Tidak bisa memproses operasi ini"
            });				            
        }
        else
        {
            for (index = 1; index <= process; index++) {
                _class   = "";
                _class1   = "";                
                _htmladd = "";
                if (type == 5) {
                    _class = "col-md-4";
                    _class1 = "col-md-4";                    
                    _htmladd =  '<div class="col-md-3">'+
                                    '<div class="form-group">'+
                                        '<label>Tema</label>'+
                                        '<textarea class="form-control form-control-detail" name="inputs" id="f_tema_'+index+'" rows="3" placeholder="Pembahasan"></textarea>'+
                                    '</div>'+
                                '</div>';
                }
                else
                {
                    _class = "col-md-6";
                    _class1 = "col-md-5";
                    _htmladd =  '<input type="hidden" id="f_tema_'+index+'" value="-">';                    
                }

                var newrec  = '<div class="col-md-1">'+
                                    '<div class="form-group">'+
                                        '<label>'+index+'</label>'+
                                    '</div>'+
                                '</div>'+_htmladd+
                                '<div class="'+_class+'">'+
                                    '<div class="form-group">'+
                                        '<label>Deskripsi Soal</label>'+
                                        '<textarea class="form-control form-control-detail" name="inputs" id="f_name_'+index+'" rows="3" placeholder="Deskripsi Soal"></textarea>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="'+_class1+'">'+
                                    '<div class="form-group">'+
                                        '<label>Pembahasan</label>'+
                                        '<textarea class="form-control form-control-detail" name="inputs" id="f_pembahasan_'+index+'" rows="3" placeholder="Pembahasan"></textarea>'+
                                    '</div>'+
                                '</div>';
                $('#multipartdata').append(newrec);
				$("#multipartdata").css({"display": ""})				
				$("#form_multipartdata").css({"display": ""})
                $("#processdata").css({"display": "none"})
                $(".box-footer").css({"display": ""})                                        
            }
        }
    })

	$("#btn_upload_pembahasan").click(function(){
		var oid         = $("#oid").val();
		var crud        = $("#crud").val();
		var oid_parent  = $("#id_parent").val();
		var oid_type    = $("#id_type").val();
		var oid_paket   = $("#id_paket").val();
		var processdata = $("#f_inputs").val();
		var data_sender = '';
		var data_detail = [];

		var f_file_1      = $("#f_file_1").prop('files')[0];
		if (f_file_1 == undefined) {
		}
		else
		{
			var form_data = new FormData();
			form_data.append('file', f_file_1);
			$.ajax({
				url :"<?php echo site_url();?>management/try_out/upload_data_pembahasan/"+crud+"/"+oid,						
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

	$("#btn_upload_soal").click(function(){
		var oid         = $("#oid").val();
		var crud        = $("#crud").val();
		var oid_parent  = $("#id_parent").val();
		var oid_type    = $("#id_type").val();
		var oid_paket   = $("#id_paket").val();
		var processdata = $("#f_inputs").val();
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
				url :"<?php echo site_url();?>management/try_out/upload_data_soal/"+crud+"/"+oid,						
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
		var res_status  = 0;

		var oid         = $("#oid").val();
		var crud        = $("#crud").val();
		var oid_parent  = $("#id_parent").val();
		var oid_type    = $("#id_type").val();
		var oid_paket   = $("#id_paket").val();
		var processdata = $("#f_inputs").val();
		var data_sender = '';
		var data_detail = [];

        if (crud == 'insert') {
            var data_sender = {
                'oid'       : oid,
                'crud'      : crud
            }            
            for (index = 1; index <= processdata; index++) {
                data_detail[index-1] = {
                    'crud'        : crud,
                    'f_name'      : $("#f_name_"+index).val(),
                    'f_pembahasan': $("#f_pembahasan_"+index).val(),
                    'f_tema'      : $("#f_tema_"+index).val(),
                    'oid_parent'  : oid_parent,
                    'oid_type'    : oid_type,
                    'oid_paket'   : oid_paket
                }			

                if ($("#f_name_"+index).val() == '') {
                    res_status = 0;
                }
                else 
                {
                    res_status = 1;
                }
            }   
        }
        else if(crud == 'update')
        {
            var data_sender = {
                'oid'              : oid,
                'f_name'           : $("#f_name").val(),
                'f_desc_pembahasan': $("#f_desc_pembahasan").val(),
                'crud'             : crud
            }            			
			
			res_status = 1;
        }

		// console.table(data_sender);		
        if (res_status == 1) {
			$.ajax({
				url :"<?php echo site_url();?>management/try_out/store_detail",
				type:"post",
				data:{data_sender : data_sender, data_detail : data_detail},
				beforeSend:function()
				{
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
                msg: "Data Deskripsi Soal belum terisi, mohon lengkapi data tersebut"
            });				            
        }
	})
})

function edit(id){
	$.ajax({
		url :"<?php echo site_url();?>bank_data/soal/get_data/"+id+"/ajax/mr_try_out_soal",
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
				$("#editdata").css({"display": ""})		
				$(".box-footer").css({"display": ""})										
				$("#processdata").css({"display": "none"})
				$("#multipartdata").css({"display": "none"})        				
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

function detail(id,materi,parent,tipe) {
	window.location.href = "<?php echo site_url();?>bank_data/soal/detail/"+id+'/'+materi+'/'+parent+'/'+tipe
}
</script>