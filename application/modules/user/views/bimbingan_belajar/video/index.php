<style>
@import url(https://fonts.googleapis.com/css?family=Lato:400,700);
*, *:before, *:after {
	list-style: none;	
	box-sizing: border-box;
}
/* body {
  background: #c5ddeb;
  font: 14px/20px "Lato", Arial, sans-serif;
  padding: 40px 0;
  color: white;
} */
.container {
  margin: 0 auto;
  width: 750px;
  background: #444753;
  border-radius: 5px;
}
.people-list {
  width: 260px;
  float: left;
}
.people-list .search {
  padding: 20px;
}
.people-list input {
  border-radius: 3px;
  border: none;
  padding: 14px;
  color: white;
  background: #6a6c75;
  width: 90%;
  font-size: 14px;
}
.people-list .fa-search {
  position: relative;
  left: -25px;
}
.people-list ul {
  padding: 20px;
  height: 770px;
}
.people-list ul li {
  padding-bottom: 20px;
}
.people-list img {
  float: left;
}
.people-list .about {
  float: left;
  margin-top: 8px;
}
.people-list .about {
  padding-left: 8px;
}
.people-list .status {
  color: #92959e;
}
.chat {
  width: 490px;
  float: left;
  background: #f2f5f8;
  border-top-right-radius: 5px;
  border-bottom-right-radius: 5px;
  color: #434651;
}
.chat .chat-header {
  padding: 20px;
  border-bottom: 2px solid white;
}
.chat .chat-header img {
  float: left;
}
.chat .chat-header .chat-about {
  float: left;
  padding-left: 10px;
  margin-top: 6px;
}
.chat .chat-header .chat-with {
  font-weight: bold;
  font-size: 16px;
}
.chat .chat-header .chat-num-messages {
  color: #92959e;
}
.chat .chat-header .fa-star {
  float: right;
  color: #d8dadf;
  font-size: 20px;
  margin-top: 12px;
}
.chat .chat-history {
  padding: 30px 30px 20px;
  border-bottom: 2px solid white;
  overflow-y: scroll;
  height: 300px;
}
.chat .chat-history .message-data {
  margin-bottom: 15px;
}
.chat .chat-history .message-data-time {
  color: #a8aab1;
  padding-left: 6px;
}
.chat .chat-history .message {
  color: white;
  padding: 18px 20px;
  line-height: 26px;
  font-size: 16px;
  border-radius: 7px;
  margin-bottom: 30px;
  width: 90%;
  position: relative;
}
.chat .chat-history .message:after {
  bottom: 100%;
  left: 7%;
  border: solid transparent;
  content: " ";
  height: 0;
  width: 0;
  position: absolute;
  pointer-events: none;
  border-bottom-color: #86bb71;
  border-width: 10px;
  margin-left: -10px;
}
.chat .chat-history .my-message {
  background: #86bb71;
}
.chat .chat-history .other-message {
  background: #94c2ed;
}
.chat .chat-history .other-message:after {
  border-bottom-color: #94c2ed;
  left: 93%;
}
.chat .chat-message {
  padding: 30px;
}
.chat .chat-message textarea {
  width: 100%;
  border: none;
  padding: 10px 20px;
  font: 14px/22px "Lato", Arial, sans-serif;
  margin-bottom: 10px;
  border-radius: 5px;
  resize: none;
}
.chat .chat-message .fa-file-o, .chat .chat-message .fa-file-image-o {
  font-size: 16px;
  color: gray;
  cursor: pointer;
}
.chat .chat-message button {
  float: right;
  color: #fff;
  font-size: 16px;
  text-transform: uppercase;
  border: none;
  cursor: pointer;
  font-weight: bold;
  background: #4CAF50;
}
.chat .chat-message button:hover {
  color: #75b1e8;
}
.online, .offline, .me {
  margin-right: 3px;
  font-size: 10px;
}
.online {
  color: #86bb71;
}
.offline {
  color: #e38968;
}
.me {
  color: #94c2ed;
}
.align-left {
  text-align: left;
}
.align-right {
  text-align: right;
}
.float-right {
  float: right;
}
.clearfix:after {
  visibility: hidden;
  display: block;
  font-size: 0;
  content: " ";
  clear: both;
  height: 0;
}

</style>

<section id="headerdata" class="col-lg-7 col-xs-12">
	<input type="hidden" id="oid_header" value="">				
	<div class="col-md-12" id="section_video">
		<video id="f_video" width="854" height="480" controls controlsList="nodownload">
			<source id="f_source" src="" type="video/mp4">
		</video>

		<div class="col-lg-12 text-center">
			<a class="btn btn-success" onclick="finish(<?=$materi;?>,<?=$type;?>)">Selesai dan Lanjutkan</a>
		</div>
	</div>
</section>

<section id="headerdata" class="col-xs-5">
	<div class="clearfix">		
		<div class="chat">
		<div class="chat-header clearfix">
			<img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_01_green.jpg" alt="avatar" />
			
			<div class="chat-about">
			<div class="chat-with">Chat Dengan Admin</div>
			<!-- <div class="chat-num-messages">already 1 902 messages</div> -->
			</div>
			<!-- <i class="fa fa-star"></i> -->
		</div> <!-- end chat-header -->
		
		<div class="chat-history">
			<ul>				
				<li>
					<div class="message-data">
					<span class="message-data-name"><i class="fa fa-circle online"></i> Vincent</span>
					<span class="message-data-time">10:12 AM, Hari ini</span>
					</div>
					<div class="message my-message">
					Are we meeting today? Project has been already finished and I have results to show you.
					</div>
				</li>
				
				<li class="clearfix">
					<div class="message-data align-right">
					<span class="message-data-time" >10:14 AM, Hari ini</span> &nbsp; &nbsp;
					<span class="message-data-name" >Olia</span> <i class="fa fa-circle me"></i>
					
					</div>
					<div class="message other-message float-right">
					Well I am not sure. The rest of the team is not here yet. Maybe in an hour or so? Have you faced any problems at the last phase of the project?
					</div>
				</li>
			</ul>
			
		</div> <!-- end chat-history -->
		
		<div class="chat-message clearfix">
			<textarea name="message-to-send" id="message-to-send" placeholder ="Tulis pesan" rows="3"></textarea>
								
			<button class="btn btn-primary">Kirim</button>

		</div> <!-- end chat-message -->
		
		</div> <!-- end chat -->
		
	</div> <!-- end container -->

	<script id="message-template" type="text/x-handlebars-template">
	<li class="clearfix">
		<div class="message-data align-right">
		<span class="message-data-time" >{{time}}, Hari ini</span> &nbsp; &nbsp;
		<span class="message-data-name" >Olia</span> <i class="fa fa-circle me"></i>
		</div>
		<div class="message other-message float-right">
		{{messageOutput}}
		</div>
	</li>
	</script>

	<script id="message-response-template" type="text/x-handlebars-template">
	<li>
		<div class="message-data">
		<span class="message-data-name"><i class="fa fa-circle online"></i> Vincent</span>
		<span class="message-data-time">{{time}}, Hari ini</span>
		</div>
		<div class="message my-message">
		{{response}}
		</div>
	</li>
	</script>

</section>

<script>
$(document).ready(function(){
	// _force();
	var source = '<?=base_url();?>public/video/<?=$list[0]['file'];?>';
	var f_video = document.getElementById('f_video');
	var f_source = document.getElementById('f_source');
	f_source.src = source;
	f_video.load();	

	$("#addData").click(function()
	{
		$(".form-control-detail").val('');
		$("#formdata").css({"display": ""})
		$("#viewdata").css({"display": "none"})
		$("#formdata > div > div > div.box-header > h3").html("Tambah Data Deskripsi Pilihan");		
		$("#crud").val('insert');
	})

	$("#closeData").click(function(){
		$("#formdata").css({"display": "none"})
		$("#viewdata").css({"display": ""})		
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

function finish(_materi,_type)
{	
	data_sender = {
		'materi': _materi,
		'type'  : _type
	}					
	Lobibox.confirm({
		title   : "Konfirmasi",
		msg     : "Anda yakin ingin menyelesaikan video belajar ini ?",
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