<?php
if ($list_soal != array()) {
    # code...
?>
<section id="headerdata" class="container">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title"><div id="time_counter"></div></h3>
			</div>
			<div class="box-body">
				<div class="row">
					<input type="hidden" id="oid_soal" value="<?=$list_soal[$counter_soal]['id'];?>">
					<input type="hidden" id="oid_parent" value="<?=$list_soal[$counter_soal]['id_parent'];?>">									
					<input type="hidden" id="oid_paket" value="<?=$list_soal[$counter_soal]['id_paket'];?>">					
                    <div class="col-lg-8 col-xs-12">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <p><?=$counter_soal+1;?>. <?=$list_soal[$counter_soal]['name'];?></p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <?php
								$get_data_detail = $this->Allcrud->getData('mr_try_out_soal_detail',array('id_soal'=>$list_soal[$counter_soal]['id']))->result_array();
								$check_data      = $this->Allcrud->getData('tr_jawaban_try_out',array('id_user'=>$this->session->userdata('session_user'),'id_parent'=>$list_soal[$counter_soal]['id_parent'],'id_paket'=>$list_soal[$counter_soal]['id_paket'],'id_soal'=>$list_soal[$counter_soal]['id']))->result_array();
								// print_r($check_data[0]);die();
								if ($get_data_detail != array()) {
                                    # code...
                                    for ($i=0; $i < count($get_data_detail); $i++) { 
										# code...
										$style_background = "";
										if ($check_data != array()) {
											# code...
											if ($check_data[0]['id_jawaban'] == $get_data_detail[$i]['id']) {
												# code...
												$style_background = "background-color:#4CAF50;"; 												
											}
										}
                            ?>
                                        <div class="row row_choice" id="row_<?=$get_data_detail[$i]['id'];?>" style="padding:10px;<?=$style_background;?>">
                                            <div class="col-lg-2 col-xs-3"><a onclick="choice(<?=$get_data_detail[$i]['id'];?>,<?=$get_data_detail[$i]['id_soal'];?>,<?=$list_soal[$counter_soal]['id_parent'];?>,<?=$list_soal[$counter_soal]['id_paket'];?>)" class="btn btn-warning btn-xs"><?=$get_data_detail[$i]['choice'];?></a></div>
                                            <div class="col-lg-10" style="padding-left: 0px;"><?=$get_data_detail[$i]['name'];?></div>                                        
                                        </div>
                            <?php
                                    }
                                }
                            ?>
                        </div>                    
                    </div>

                    <div class="col-lg-4" id="counter">
                        <div class="col-lg-12">
                            <?php
                                if ($list_soal != array()) {
                                    # code...
                                    for ($i=0; $i < count($list_soal); $i++) { 
                                        # code...
                                        $background_color = '';
                                        $color            = "";
										$check_data       = $this->Allcrud->getData('tr_jawaban_try_out',array('id_user'=>$this->session->userdata('session_user'),'id_parent'=>$list_soal[$i]['id_parent'],'id_paket'=>$list_soal[$i]['id_paket'],'id_soal'=>$list_soal[$i]['id']))->result_array();
										if ($check_data != array()) {
											# code...
											$color            = "color:#fff;";
											$background_color = "background-color:#4CAF50;";
										}										
                                        // $data_soal        = $this->Allcrud->getdata('mr_try_out_soal',array('id'=>$list_soal[$i]['id']))->result_array();

                            ?>
                                        <a onclick="go(<?=$list_soal[$counter_soal]['id_parent'];?>,<?=$list_soal[$counter_soal]['id_paket'];?>,<?=$i;?>)" class="btn btn-default" style="<?=$background_color;?><?=$color;?>"><?=$i+1;?></a>
                            <?php
                                    }								
                                }
                            ?>
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
	var time_server = "<?=$timeout;?>";
	var upgradeTime = time_server;
	// var upgradeTime = 10;	
	var seconds     = upgradeTime;
	function timer() {
		console.log(seconds);
		var days        = Math.floor(seconds/24/60/60);
		var hoursLeft   = Math.floor((seconds) - (days*86400));
		var hours       = Math.floor(hoursLeft/3600);
		var minutesLeft = Math.floor((hoursLeft) - (hours*3600));
		var minutes     = Math.floor(minutesLeft/60);
		var remainingSeconds = seconds % 60;
		function pad(n) {
			return (n < 10 ? "0" + n : n);
		}
		document.getElementById('time_counter').innerHTML = pad(hours) + ":" + pad(minutes) + ":" + pad(remainingSeconds);
		if (seconds == 0) {
			clearInterval(countdownTimer);
			document.getElementById('time_counter').innerHTML = "Jam ujian telah telah selesai";
			// window.location.href = "<?php echo site_url();?>user/try_out/selesai/"+$("#oid_parent").val()+"/"+$("#oid_paket").val();					
			window.location.href = "<?php echo site_url();?>user/try_out/";								
		} else {
			seconds--;
		}
	}
	var countdownTimer = setInterval('timer()', 1000);

	function choice(_choice,_soal,_parent,_type) {
		data_sender = {
			'choice': _choice,
			'soal'  : _soal,
			'parent': _parent,
			'paket' : _type
		}

		$.ajax({
			url :"<?php echo site_url();?>user/ztry_out/store_choice",
			type:"post",
			data:{data_sender : data_sender},
			beforeSend:function(){
				$(".row_choice").css({"background-color": ""})				
				$("#row_"+_choice).css({"background-color": "#4CAF50"})
				$("#counter_choice_"+_soal).css({"background-color": "#4CAF50"})							
			},
			success:function(msg){
				var obj = jQuery.parseJSON (msg);
				if (obj.status == 1)
				{
					// Lobibox.notify('success', {msg: obj.text});
				}
				else
				{
					$("#row_"+_choice).css({"background-color": ""})					
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

	function go(parent,paket,counter) {
		window.location.href = "<?php echo site_url();?>user/try_out/mulai/"+parent+"/"+paket+"/"+counter;		
	}
</script>