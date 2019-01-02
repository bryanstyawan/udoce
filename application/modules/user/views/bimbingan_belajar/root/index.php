<?php
if($verify_user_paid->result_array() == array())
{
?>
<style>
@import url(https://fonts.googleapis.com/css?family=Lato:400,700);

body {
  background: #F2F2F2;
  padding: 0;
  maring: 0;
}

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

.btn {
  padding: 3em 0;
  text-align: center;
}

.btn a {
  background: #323232;
  padding: 10px 30px;
  color: #fff;
  text-transform: uppercase;
  font-weight: 700;
  text-decoration: none
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
<div id="price">
    <!--price tab-->
	<input type="hidden" id="oid">
	<div class="plan">
		<div class="plan-inner">
			<div class="entry-title">
				<h3>Free</h3>
				<div class="price">Free<span></span>
				</div>
			</div>
			<div class="entry-content">
				<ul>
				<li><strong>Bimbingan Belajar</strong> - 3 Materi</li>
				<li><strong>-</strong></li>
				<li><strong>Try Out</strong> - Trial</li>
				</ul>
			</div>
			<div class="btn">
				<a href="#">Coba Sekarang</a>
			</div>
		</div>
	</div>
    <!-- end of price tab-->
    <!--price tab-->
    <div class="plan basic">
        <div class="plan-inner">
            <div class="entry-title">
                <h3>Paket A</h3>
                <div class="price">A<span></span>
                </div>
            </div>
            <div class="entry-content">
                <ul>
                    <li><strong>Bimbingan Belajar</strong></li>
                    <li><strong>Raport</strong></li>
                    <li><strong>Try Out</strong> -  Trial</li>
                </ul>
            </div>
            <div class="btn">
                <a href="#" onclick="bimbel_package('1')">Beli Sekarang</a>
            </div>
        </div>
    </div>

    <div class="plan ultimite">
        <div class="plan-inner">
            <div class="hot">Hot</div>        
            <div class="entry-title">
                <h3>Paket B</h3>
                <div class="price">B<span></span>
                </div>
            </div>
            <div class="entry-content">
                <ul>
                    <li><strong>Bimbingan Belajar</strong></li>
                    <li><strong>Raport</strong></li>
                    <li><strong>Try Out</strong></li>
                </ul>
            </div>
            <div class="btn">
                <a href="#" onclick="bimbel_package('2')">Beli Sekarang</a>
            </div>
        </div>
    </div>    

</div>

<div class="example-modal">
	<div class="modal modal-success fade" id="newData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="box-content">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header" style="background-color:#00a7d0!important;border-color:#00a7d0!important;">
						<h4 class="modal-title">Masukan Token</h4>
						<button type="button" class="close hot" data-dismiss="modal" aria-label="Close" style="color: #795548;font-size: 39px;top: 0px;margin-top: 0px;">
							<span aria-hidden="true">&times;</span>
						</button>						
					</div>
					<div class="modal-body" style="background-color: #fff!important;">
						<label style="color: #000;font-weight: 400;font-size: 19px;">Token</label>
						<div class="form-group">
							<div class="input-group col-lg-12">
								<input type="text" id="token" name="token" class="form-control" placeholder="Token" maxlength="6">
							</div>
							<div class="input-group col-lg-12">
								<div class="btn">
									<a href="#" id="btn-verify">Verifikasi Token</a>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
}
else {
	# code...
?>
<section id="viewdata">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-body" id="table_fill">
				<table class="table table-bordered table-striped table-view">
					<thead>
				<tr>
					<th>No</th>
					<th>Materi</th>
					<th>Sub Materi</th>					
					<th>Pre Test</th>
					<th>Video Materi</th>					
					<th>Quiz</th>
				</tr>
				</thead>
				<tbody>
				<?php 
					$x  = 1;
					foreach($list->result() as $row){
							$child = $this->Allcrud->getData('mr_materi',array('id_parent'=>$row->id));
							foreach ($child->result() as $key) {
								# code...
				?>
								<tr>
									<td><?=$x;?></td>
									<td><?php echo $row->name;?></td>									
									<td><?php echo $key->name;?></td>
									<td><a class="btn btn-primary" href="<?=base_url();?>user/bimbingan_belajar/pre_test/1/<?php echo $key->id;?>" target="_blank"><i class="fa fa-hourglass-start"></i> Mulai</a></td>
									<td><a class="btn btn-primary" href="<?=base_url();?>user/bimbingan_belajar/video_materi/3/<?php echo $key->id;?>" target="_blank"><i class="fa fa-search-plus"></i> Lihat</a></td>
									<td><a class="btn btn-primary" href="<?=base_url();?>user/bimbingan_belajar/quiz/2/<?php echo $key->id;?>" target="_blank"><i class="fa fa-hourglass-start"></i> Mulai</a></td>
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
<?php
}
?>

<script>
function bimbel_package(arg) {
	$("#newData").modal('show');  
	if (arg == 1) {
		$(".modal-title").html("Masukan Token Paket A");
	}
	else if(arg == 2)
	{
		$(".modal-title").html("Masukan Token Paket B");		
	}
	$("#oid").val(arg);
}

$(document).ready(function(){
	$("#btn-verify").click(function() {
		var oid   = $("#oid").val();
		var token = $("#token").val();
		data_sender = {
			'oid'  : oid,
			'token': token,
			'type' : 'bimbel'
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
});
</script>