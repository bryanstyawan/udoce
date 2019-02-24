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
/* .container {
  margin: 0 auto;
  width: 750px;
  background: #444753;
  border-radius: 5px;
} */
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
    width: 445px;
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
<div class="container">

<?php
function secondsToTime($seconds) {
    $dtF = new \DateTime('@0');
    $dtT = new \DateTime("@$seconds");
    return $dtF->diff($dtT)->format('%a Hari, %h Jam, %i Menit dan %s Detik');
}

$end_mini = 0;
if ($list != array()) {
    # code...

    for ($i=0; $i < count($list); $i++) { 
        # code...
        $show_time    = "";
        $time_publish = $list[$i]['time_publish'];
        $time_server  = date('Y-m-d H:i:s');
        $timeout      = strtotime($time_publish) - strtotime($time_server);        

        $time_minute     = $list[$i]['durasi'] * 60;
        $time_expire     = date('Y-m-d H:i:s',strtotime('+'.$list[$i]['durasi'].' minutes',strtotime($list[$i]['time_publish'])));
        $timeout_expired = strtotime($time_expire) - strtotime($time_server);        
        $style           = "";
        $go              = "";

        if ($timeout < 0) {
            # code...
            $go = "push";
            $show_time = 'Mini Try Out akan selesai pada '.secondsToTime($timeout_expired).' ('.$time_expire.')';
        }
        else
        {
            $go = "hold";            
            $show_time = 'Mini Try Out akan dimulai pada '.secondsToTime($timeout).' ('.$time_publish.')';
        }

        if ($timeout_expired < 0) {
            # code...
            $timeout   = 0;
            $show_time = 'Mini Try Out telah selesai.';
            $style     = "style='display:none'";				            
            $end_mini  += 1;
            // $this->Allcrud->editData('mr_try_out_list',array('publish'=>0),array('id'=>$list[$i]['id']));            
        }
?>
    <a href="#" onclick="go('<?=$go;?>','<?=$list[$i]['id'];?>')">
        <div class="col-md-12" <?=$style;?>>
            <div class="box">
                <div class="box-header with-border text-center">
                    <h3 class="box-title"><?=$list[$i]['name'];?></h3>
                </div>        
                <div class="box-body">
                    <p class="card-text" style="color:#000;"><?=$list[$i]['remark'];?></p>
                    <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted pull-right"><?=$show_time;?></small>
                    </div>
                </div>
            </div>
        </div>    
    </a>

    
<?php
    }
}

if ($end_mini == count($list)) {
    # code...
?>
    <div class="col-lg-12 text-center">
        <h3>Mini Try Out Selanjutnya akan dipublikasikan oleh Admin</h3>
    </div>
<?php
}
?>
</div>


<script>
function go(arg,id) {
    if (arg == 'push') 
    {
		window.location.href = "<?php echo site_url();?>user/mini_try_out_start/"+id;        
    } 
    else if(arg == 'hold') 
    {
        Lobibox.alert("info", //AVAILABLE TYPES: "error", "info", "success", "warning"
        {
            title: 'Informasi',					
            msg: "Mini Try Out belum dimulai"
        });				        
    }
}

$(document).ready(function(){

});
</script>