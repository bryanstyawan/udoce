<div class="container">

<?php
    if ($list_soal != array()) {
        # code...
        $try_out_true           = 0;
        $try_out_false          = 0;
        $try_out_value          = 0;        
        for ($i=0; $i < count($list_soal); $i++) { 
            # code...
?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="box">
                        <div class="box-body">
                            <div class="row">
                                <h2 class="col-lg-1 text-center"><?=$i+1;?>.</h2>                            
                                <h2 class="col-lg-11 text-center"><?=$list_soal[$i]['name'];?></h2>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                <?php
                                    $get_data_detail = $this->Allcrud->getData('mr_try_out_soal_detail',array('id_soal'=>$list_soal[$i]['id']))->result_array();
                                    if ($get_data_detail != array()) {
                                        # code...
                                        $check_data   = $this->Allcrud->getData('tr_jawaban_try_out',array('id_user'=>$this->session->userdata('session_user'),'id_parent'=>$list_soal[$i]['id_parent'],'id_paket'=>$list_soal[$i]['id_paket'],'id_soal'=>$list_soal[$i]['id']))->result_array();
                                        $check_choice = $this->Allcrud->getData('mr_try_out_soal_detail',array('id_soal'=>$list_soal[$i]['id'],'jawaban'=>'true'))->result_array();
                                        for ($ii=0; $ii < count($get_data_detail); $ii++) { 
                                            # code...
                                            $style_background       = "";
                                            $style_background_false = "";
                                            
                                            if ($check_data != array()) {
                                                # code...
                                                if ($check_data[0]['id_jawaban'] == $get_data_detail[$ii]['id']) {
                                                    # code...
                                                    $style_background = "background-color:#4CAF50;"; 												
                                                }
                                            }

                                            if ($check_choice != array()) {
                                                # code...
                                                if ($check_data != array()) {
                                                    # code...
                                                    if ($get_data_detail[$ii]['id'] == $check_choice[0]['id']) {
                                                        # code...
                                                        if ($check_choice[0]['id'] == $check_data[0]['id_jawaban']) {
                                                            # code...
                                                            $style_background = "background-color:#4CAF50;";
                                                            $try_out_true += 1;											
                                                        }
                                                        else {
                                                            # code...
                                                            $style_background_false = "background-color:red;";											
                                                            $try_out_false += 1;
                                                        }
                                                    }																						
                                                }
                                                else {
                                                    # code...
                                                    if ($get_data_detail[$ii]['id'] == $check_choice[0]['id']) {
                                                        # code...
                                                        $style_background_false = "background-color:red;";											
                                                        $try_out_false += 1;
                                                    }																												
                                                }
                                            }								                                            
                                ?>
                                            <div class="row row_choice" id="row_<?=$get_data_detail[$ii]['id'];?>" style="padding:10px;<?=$style_background.$style_background_false;?>">
                                                <div class="col-lg-2 col-xs-3 text-center"><?=$get_data_detail[$ii]['choice'];?></div>
                                                <div class="col-lg-10" style="padding-left: 0px;"><?=$get_data_detail[$ii]['name'];?></div>                                        
                                            </div>
                                <?php
                                        }
                                    }
                                ?>
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
<?php            
        }
    }
?>
</div>