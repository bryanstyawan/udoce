<section id="viewdata">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title"></h3>
				<div class="box-tools pull-right">
					<button class="btn btn-warning btn-block" onclick="generate('<?php echo $oid;?>')"><i class="fa fa-cogs"></i> Generate Token</button>&nbsp;&nbsp;
				</div>
			</div><!-- /.box-header -->		
			<div class="box-body" id="table_fill">
				<table class="table table-bordered table-striped table-view">
					<thead>
				<tr>
					<th>No</th>
					<th>Nama</th>
					<th>Status</th>
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
							<td>
								<?php echo $text;?>
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
</script>