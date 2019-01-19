<div class="col-md-3">
    <!-- USERS LIST -->
    <div class="box box-danger">
        <div class="box-header with-border">Kotak Pesan</div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
            <ul class="users-list clearfix">
                <?php
                    if ($user_chat[0]->name != '') {
                        # code...
                        for ($i=0; $i < count($user_chat); $i++) { 
                            # code...
                            if ($user_chat[$i]->counter != 0) {
                                # code...
                    ?>
                <li>
                    <a style="cursor: pointer;" onclick="open_chat('<?=$user_chat[$i]->name;?>','<?=$user_chat[$i]->id_user_sender;?>','<?=$user_chat[$i]->id_materi;?>')">
                        <img src="https://adminlte.io/themes/AdminLTE/dist/img/user1-128x128.jpg" alt="User Image">
                        <span class="users-list-name" href="#"><?=$user_chat[$i]->name;?><span id="counter_message_<?=$user_chat[$i]->id_user_sender;?>" class="badge bg-yellow"><?=($user_chat[$i]->counter!=0?$user_chat[$i]->counter:'');?></span></span>
                        <span class="users-list-date">
                            <span class="badge bg-yellow col-lg-12" style="overflow-x: hidden;"><?=$user_chat[$i]->materi;?></span>
                        </span>                                            
                    </a>
                </li>                    
                    <?php                                
                            }
                        }
                    }
                ?>
            </ul>
        <!-- /.users-list -->
        </div>
        <!-- <div class="box-footer text-center">
            <a href="javascript:void(0)" class="uppercase">View All Users</a>
        </div> -->
    </div>
    <!--/.box -->
</div>

<div class="row boxboard" id="chat_board" style="display:none;">
    <div class="col-md-4" style="padding-right: 0px;">
        <div class="box box-warning direct-chat direct-chat-warning">
            <div class="box-header with-border">
                <h3 class="box-title" id="video_board_user_sender"></h3>
            </div>
            <div class="box-body">
                <video id="f_video" width="480" height="320" controls>
                    <source id="f_source" src="" type="video/mp4">
                </video>        
            </div>        
        </div>
    </div>
    <div class="col-md-3" style="padding-left: 0px;">
        <!-- DIRECT CHAT -->    
        <div class="box box-warning direct-chat direct-chat-warning">
        <div class="box-header with-border">
            <h3 class="box-title" id="chat_board_user_sender"></h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool closeBox"><i class="fa fa-times"></i></button>
            </div>        
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <!-- Conversations are loaded here -->
            <div class="direct-chat-messages" id="direct-chat-messages">

                <!-- <div class="direct-chat-msg">
                    <div class="direct-chat-info clearfix">
                        <span class="direct-chat-name pull-left">Alexander Pierce</span>
                        <span class="direct-chat-timestamp pull-right">23 Jan 5:37 pm</span>
                    </div>
                    <img class="direct-chat-img" src="https://adminlte.io/themes/AdminLTE/dist/img/user1-128x128.jpg" alt="message user image">
                    <div class="direct-chat-text">
                        Working with AdminLTE on a great new app! Wanna join?
                    </div>
                </div>

                <div class="direct-chat-msg right">
                    <div class="direct-chat-info clearfix">
                        <span class="direct-chat-name pull-right">Sarah Bullock</span>
                        <span class="direct-chat-timestamp pull-left">23 Jan 6:10 pm</span>
                    </div>
                    <img class="direct-chat-img" src="https://adminlte.io/themes/AdminLTE/dist/img/user3-128x128.jpg" alt="message user image">
                    <div class="direct-chat-text">
                        I would love to.
                    </div>
                </div> -->

            </div>

        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <form action="#" method="post">
            <div class="input-group">
                <input type="hidden" id="hdn_oid_user">
                <input type="hidden" id="hdn_oid_materi">                
                <input type="text" name="message" id="message-to-send" placeholder="Tulis Pesan" class="form-control">
                <span class="input-group-btn">
                    <button type="button" class="btn btn-warning btn-flat" id="btn-trigger-controll">Kirim</button>
                </span>
            </div>
            </form>
        </div>
        <!-- /.box-footer-->
        </div>
        <!--/.direct-chat -->
    </div>
</div>


<script>
function open_chat(name,id,materi) {
    var data_sender = {
        'oid_user'  : id,
        'oid_materi': materi
    }
    $.ajax({
        url :"<?php echo site_url();?>user/zchat/get_chat_user",
        type:"post",
        data:{data_sender : data_sender},
        beforeSend:function(){
            $("#loadprosess").modal('show');
            $("#chat_board_user_sender").html('');
            $("#video_board_user_sender").html('');
            $('#direct-chat-messages').html('');                                
            $("#hdn_oid_user").val('');            
        },			
        success:function(msg){
			var obj = jQuery.parseJSON (msg);            
            // console.table(obj.video[0]);
            // console.log(obj.video[0].file);            
            for (index = 0; index < obj.chat.length; index++) {
                if (obj.chat[index].id_admin_sender == 0) {
					var newrec  = '<div class="direct-chat-msg">'+
                                    '<div class="direct-chat-info clearfix">'+
                                        '<span class="direct-chat-name pull-left">'+name+'</span>'+
                                        '<span class="direct-chat-timestamp pull-right">23 Jan 5:37 pm</span>'+
                                    '</div>'+
                                    '<img class="direct-chat-img" src="https://adminlte.io/themes/AdminLTE/dist/img/user1-128x128.jpg" alt="message user image">'+
                                    '<div class="direct-chat-text">'+obj.chat[index].name+'</div>'+
                                '</div>';
					$('#direct-chat-messages').append(newrec);                    
                }
                else
                {
					var newrec  = '<div class="direct-chat-msg right">'+
                                        '<div class="direct-chat-info clearfix">'+
                                            '<span class="direct-chat-name pull-right">Sarah Bullock</span>'+
                                            '<span class="direct-chat-timestamp pull-left">23 Jan 6:10 pm</span>'+
                                        '</div>'+
                                        '<img class="direct-chat-img" src="https://adminlte.io/themes/AdminLTE/dist/img/user3-128x128.jpg" alt="message user image">'+
                                        '<div class="direct-chat-text">'+obj.chat[index].name+'</div>'+
                                    '</div>';
					$('#direct-chat-messages').append(newrec);                    
                }
                // console.log(obj[index].name);
            }
            var source = '<?=base_url();?>public/video/'+obj.video[0]['file'];
            var f_video = document.getElementById('f_video');
            var f_source = document.getElementById('f_source');
            f_source.src = source;
            f_video.load();
                        
            $("#chat_board").css({'display':''});            
            $("#loadprosess").modal('hide');            
            $("#chat_board_user_sender").html(name);
            $("#video_board_user_sender").html(obj.materi[0]['name']);            
            $("#hdn_oid_user").val(id);
            $("#hdn_oid_materi").val(materi);            
        }
    })    
}

$(document).ready(function(){
	$("#btn-trigger-controll").click(function(){
		var f_name     = $("#message-to-send").val();
		var oid        = $("#hdn_oid_user").val();
		var oid_materi = $("#hdn_oid_materi").val();

		var data_sender = {
			'f_name'    : f_name,
			'oid'       : oid,
			'oid_materi': oid_materi, 
			'crud'      : 'insert'
		}

		if (f_name.length <= 0) {
			// $("#formdata").css({"display": "none"})
		}
		else
		{
			$.ajax({
				url :"<?php echo site_url();?>user/zchat/send_message_f_admin",
				type:"post",
				data:{data_sender : data_sender},
				beforeSend:function(){
					$("#loadprosess").modal('show');
				},
				success:function(msg){
					var newrec  = '<div class="direct-chat-msg right">'+
                                        '<div class="direct-chat-info clearfix">'+
                                            '<span class="direct-chat-name pull-right">Sarah Bullock</span>'+
                                            '<span class="direct-chat-timestamp pull-left">23 Jan 6:10 pm</span>'+
                                        '</div>'+
                                        '<img class="direct-chat-img" src="https://adminlte.io/themes/AdminLTE/dist/img/user3-128x128.jpg" alt="message user image">'+
                                        '<div class="direct-chat-text">'+f_name+'</div>'+
                                    '</div>';
					$('#direct-chat-messages').append(newrec);
					$("#message-to-send").val('');	
					$("#loadprosess").modal('hide');	
                    $("#counter_message_"+oid_materi).html('');                    													
				},
				error:function(jqXHR,exception)
				{
					ajax_catch(jqXHR,exception);					
				}
			})
		}
	})  

	$(".closeBox").click(function(){
		$(".boxboard").css({"display": "none"})
	})      
});
</script>