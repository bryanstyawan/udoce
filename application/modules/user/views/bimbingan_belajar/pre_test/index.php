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
					<table class="table table-bordered table-striped" id="table_<?=$list[$i]['id'];?>">
					<body>
						<?php
							$detail = $this->Allcrud->getData('mr_soal_detail',array('id_soal'=>$list[$i]['id']))->result_array();
							if ($detail != array()) {
								# code...
								$check_data  = $this->Allcrud->getData('tr_jawaban_bimbingan_belajar',array('id_user'=>$this->session->userdata('session_user'),'id_type'=>$type,'id_materi'=>$materi,'id_soal'=>$list[$i]['id']))->result_array();
								for ($ii=0; $ii < count($detail); $ii++) { 
									# code...
									$mark = '';
									if ($detail[$ii]['id'] == $check_data[0]['id_jawaban']) {
										# code...
										$mark = "style='background-color:#4CAF50;'";
									}
						?>
									<tr class="tr_choice" id="tr_<?=$detail[$ii]['id'];?>" <?=$mark;?>>
										<td style="width: 5%;"><?=$detail[$ii]['choice'];?>.</td>
										<td style="width: 100%;"><?=$detail[$ii]['name'];?>.</td>
										<td><a class="btn btn-primary" onclick="choice(<?=$detail[$ii]['id'];?>,<?=$detail[$ii]['id_soal'];?>,<?=$materi;?>,<?=$type;?>)">Pilih</a></td>
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
					<a class="btn btn-success" onclick="finish(<?=$materi;?>,<?=$type;?>)">Selesai dan Lanjutkan</a>
				</div>
			</div>

		</div><!-- /.box-body -->		
	</div>
</section>

<script>
$(document).ready(function(){

})

function choice(_choice,_soal,_materi,_type) {
	data_sender = {
		'choice': _choice,
		'soal'  : _soal,
		'materi': _materi,
		'type'  : _type
	}

	$.ajax({
		url :"<?php echo site_url();?>user/zbimbingan_belajar/store_choice",
		type:"post",
		data:{data_sender : data_sender},
		beforeSend:function(){
			$("#table_"+_soal+" .tr_choice").css({"background-color": ""})				
			$("#table_"+_soal+" #tr_"+_choice).css({"background-color": "#4CAF50"})				
		},
		success:function(msg){
			var obj = jQuery.parseJSON (msg);
			if (obj.status == 1)
			{
				Lobibox.notify('success', {msg: obj.text});
			}
			else
			{
				$("#table_"+_soal+" #tr_"+_choice).css({"background-color": ""})					
				Lobibox.notify('warning', {msg: obj.text+' ,silahkan pilih kembali pilihan anda'});
			}
		},
		error:function(jqXHR,exception)
		{
			$("#table_"+_soal+" #tr_"+_choice).css({"background-color": ""})								
			ajax_catch(jqXHR,exception);					
		}
	})
}

function finish(_materi,_type)
{	
	data_sender = {
		'materi': _materi,
		'type'  : _type
	}					
	Lobibox.confirm({
		title   : "Konfirmasi",
		msg     : "Anda yakin ingin menyelesaikan pre test ini ?",
		callback: function ($this, type) {
			if (type === 'yes'){			
				$.ajax({
					url :"<?php echo site_url();?>user/zbimbingan_belajar/finish_step",
					type:"post",
					data:{data_sender : data_sender},
					beforeSend:function(){
						$("#loadprosess").modal('show');
					},
					success:function(msg){
						var obj = jQuery.parseJSON (msg);
						if (obj.status == 1)
						{
							Lobibox.notify('success', {msg: obj.text});
							window.location.href = "<?php echo site_url();?>user/bimbingan_belajar";							
						}
						else
						{
							Lobibox.notify('warning', {msg: obj.text+' ,silahkan ulangi kembali'});
						}						
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
</script>