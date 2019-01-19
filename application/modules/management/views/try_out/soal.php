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
							<td>
								<?=count($this->Allcrud->getdata('mr_try_out_soal_detail',array('id_soal'=>$row->id))->result_array());?>
								<a target="_blank" href="<?=base_url();?>management/try_out/detail_soal/<?=$row->id;?>/<?=$row->id_parent;?>/<?=$row->id_type;?>/<?=$row->id_paket;?>" class="btn btn-primary pull-right">Pilihan Ganda</a>
							</td>
							<td>
								<!-- <button class="btn btn-primary btn-xs" onclick="edit('<?php echo $row->id;?>')"><i class="fa fa-edit"></i> Ubah</button>&nbsp;&nbsp;
								<button class="btn btn-success btn-xs" onclick="detail('<?php echo $row->id;?>')"><i class="fa fa-edit"></i> Pilihan Ganda</button>&nbsp;&nbsp;							
								<button class="btn btn-danger btn-xs" onclick="del('<?php echo $row->id;?>')"><i class="fa fa-trash"></i> Hapus</button> -->
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
				$("#form_multipartdata").css({"display": ""})
                $("#processdata").css({"display": "none"})
                $(".box-footer").css({"display": ""})                                        
            }
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

        }


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
		url :"<?php echo site_url();?>bank_data/soal/get_data/"+id+"/ajax/mr_soal",
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