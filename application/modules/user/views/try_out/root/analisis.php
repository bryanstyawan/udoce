<div class="container">

<?php
    $try_out_true_tbi      = 0;
    $try_out_false_tbi     = 0;
    $try_out_empty_tbi     = 0;
    $try_out_value_tbi     = 0;
    $try_out_parameter_tbi = 0;

    $try_out_true_tpa      = 0;
    $try_out_false_tpa     = 0;
    $try_out_empty_tpa     = 0;
    $try_out_value_tpa     = 0;
    $try_out_parameter_tpa = 0;

    $try_out_true_twk      = 0;
    $try_out_false_twk     = 0;
    $try_out_empty_twk     = 0;
    $try_out_value_twk     = 0;
    $try_out_parameter_twk = 0;

    $try_out_true_tiu      = 0;
    $try_out_false_tiu     = 0;
    $try_out_empty_tiu     = 0;
    $try_out_value_tiu     = 0;
    $try_out_parameter_tiu = 0;
    
    $try_out_empty_tkk     = 0;
    $try_out_value_tkk     = 0;
    $try_out_parameter_tkk = 0;
    if ($list_soal != array()) {
        # code...
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
                                                    if ($list_soal[$i]['id_type'] == 5) {
                                                        # code...
                                                        $try_out_value_tkk += $get_data_detail[$ii]['bobot']; 
                                                    }
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
                                                            if ($list_soal[$i]['id_type'] == 1) {
                                                                # code...
                                                                $try_out_true_tpa += 1;                                                                
                                                                $try_out_value_tpa += 4;
                                                            }
                                                            elseif ($list_soal[$i]['id_type'] == 2) {
                                                                # code...
                                                                $try_out_true_tbi += 1; 
                                                                $try_out_value_tbi +=4;                                                               
                                                            }
                                                            elseif ($list_soal[$i]['id_type'] == 3) {
                                                                # code...
                                                                $try_out_true_twk += 1;
                                                                $try_out_value_twk += 5;                                                                
                                                            }
                                                            elseif ($list_soal[$i]['id_type'] == 4) {
                                                                # code...
                                                                $try_out_true_tiu += 1; 
                                                                $try_out_value_tiu += 5;                                                               
                                                            }
                                                        }
                                                        else {
                                                            # code...
                                                            $style_background_false = "background-color:red;";											
                                                            if ($list_soal[$i]['id_type'] == 1) {
                                                                # code...
                                                                $try_out_false_tpa += 1;                                                                
                                                                $try_out_value_tpa -= 1;
                                                            }
                                                            elseif ($list_soal[$i]['id_type'] == 2) {
                                                                # code...
                                                                $try_out_false_tbi += 1;
                                                                $try_out_value_tbi -= 1;
                                                            }
                                                            elseif ($list_soal[$i]['id_type'] == 3) {
                                                                # code...
                                                                $try_out_false_twk += 1;
                                                                $try_out_value_twk += 0;                                                                
                                                            }
                                                            elseif ($list_soal[$i]['id_type'] == 4) {
                                                                # code...
                                                                $try_out_false_tiu += 1; 
                                                                $try_out_value_tiu += 0;                                                               
                                                            }
                                                        }
                                                    }																						
                                                }
                                                else {
                                                    # code...
                                                    if ($get_data_detail[$ii]['id'] == $check_choice[0]['id']) {
                                                        # code...
                                                        //tidak dijawab
                                                        $style_background_false = "background-color:red;";											
                                                        if ($list_soal[$i]['id_type'] == 1) {
                                                            # code...
                                                            $try_out_empty_tpa += 1;                                                                
                                                            $try_out_value_tpa += 0;
                                                        }
                                                        elseif ($list_soal[$i]['id_type'] == 2) {
                                                            # code...
                                                            $try_out_empty_tbi += 1;
                                                            $try_out_value_tbi += 0;
                                                        }
                                                        elseif ($list_soal[$i]['id_type'] == 3) {
                                                            # code...
                                                            $try_out_empty_twk += 1;
                                                            $try_out_value_twk += 0;                                                                
                                                        }
                                                        elseif ($list_soal[$i]['id_type'] == 4) {
                                                            # code...
                                                            $try_out_empty_tiu += 1; 
                                                            $try_out_value_tiu += 0;                                                               
                                                        }
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

    if ($try_out_value_tbi < 67) {
        # code...
        $try_out_parameter_tbi = "Tidak Lulus";
    }
    else
    {
        $try_out_parameter_tbi = "Lulus";
    }

    if ($try_out_value_tpa < 30) {
        # code...
        $try_out_parameter_tpa = "Tidak Lulus";
    }
    else
    {
        $try_out_parameter_tpa = "Lulus";
    }    

    if ($try_out_value_twk < 70) {
        # code...
        $try_out_parameter_twk = "Tidak Lulus";
    }
    else
    {
        $try_out_parameter_twk = "Lulus";
    }   
    
    if ($try_out_value_tiu < 85) {
        # code...
        $try_out_parameter_tiu = "Tidak Lulus";
    }
    else
    {
        $try_out_parameter_tiu = "Lulus";
    }       

    if ($try_out_value_tkk < 143) {
        # code...
        $try_out_parameter_tkk = "Tidak Lulus";
    }
    else
    {
        $try_out_parameter_tkk = "Lulus";
    }       


?>
</div>

<div class="container">
    <div class="row">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title col-lg-12 text-center">SELEKSI KEMAMPUAN DASAR</h3>            
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row text-center">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-2">Benar</div>
                            <div class="col-lg-2">Salah</div>
                            <div class="col-lg-2">Kosong</div>                            
                            <div class="col-lg-2">Nilai</div>                            
                            <div class="col-lg-2"></div>                            
                        </div>                    
                        <div class="row text-center">
                            <div class="col-lg-2">TEST KEWARGANEGARAAN</div>
                            <div class="col-lg-2"><?=$try_out_true_twk;?></div>
                            <div class="col-lg-2"><?=$try_out_false_twk;?></div>
                            <div class="col-lg-2"><?=$try_out_empty_twk;?></div>                            
                            <div class="col-lg-2"><?=$try_out_value_twk;?></div>                            
                            <div class="col-lg-2"><?=$try_out_parameter_twk;?></div>                            
                        </div>
                        <div class="row text-center">
                            <div class="col-lg-2">TEST INTELEGENSI UMUM</div>
                            <div class="col-lg-2"><?=$try_out_true_tiu;?></div>
                            <div class="col-lg-2"><?=$try_out_false_tiu;?></div>
                            <div class="col-lg-2"><?=$try_out_empty_tiu;?></div>                            
                            <div class="col-lg-2"><?=$try_out_value_tiu;?></div>                            
                            <div class="col-lg-2"><?=$try_out_parameter_tiu;?></div>
                        </div>
                        <div class="row text-center">
                            <div class="col-lg-2">TEST KEMAMPUAN PRIBADI</div>
                            <div class="col-lg-2">-</div>
                            <div class="col-lg-2">-</div>
                            <div class="col-lg-2">-</div>                            
                            <div class="col-lg-2"><?=$try_out_value_tkk;?></div>                            
                            <div class="col-lg-2"><?=$try_out_parameter_tkk;?></div>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

	// console.table(data_sender);
</script>