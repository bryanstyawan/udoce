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
	<div class="col-xs-6">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title"></h3>
				<div class="box-tools pull-right"></div>
			</div><!-- /.box-header -->
			<div class="box-body" id="table_fill">
				<table class="table table-bordered table-striped table-view">
					<thead>
				<tr>
					<th>No</th>
					<th>Aksi</th>
				</tr>
				</thead>
				<tbody>
				<?php 
					$x  = 1;
					foreach($tipe->result() as $row){
						if ($row->id != 4) {
							# code...
				?>
						<tr>
							<td><?php echo $x;?></td>
							<td>
								<button class="btn btn-primary btn-xs" onclick="go('<?php echo $row->name;?>','<?php echo $row->id;?>')"><i class="fa fa-edit"></i> <?php echo $row->text;?></button>&nbsp;&nbsp;
							</td>
						</tr>
				<?php 							
						}
						$x++; 
					}
				?>
				</tbody>
				</table>
				
			</div><!-- /.box-body -->
			</div><!-- /.box -->
	</div>
</section>

<script>
function go(arg,param) {
	var id     = $("#id").val();
	var parent = $("#id_parent").val();
	if (param != 2) {
		window.open("<?php echo site_url();?>bank_data/soal/index/"+arg+"/"+id+"/"+parent+"/"+param,'_blank');		
	}
	else
	{
		window.open("<?php echo site_url();?>bank_data/video/video_materi/"+id+"/"+parent+"/"+param,'_blank');		
	}
}
</script>