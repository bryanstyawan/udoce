<div class="container">
    <div class="col-lg-12">
        <div class="row">
            <div class="box box-solid">
                <div class="box-body">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class=""></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                        </ol>
                        <div class="carousel-inner">
                        <div class="item active left">
                            <img src="http://placehold.it/1500x500/39CCCC/ffffff&amp;text=Try+Out" alt="Try Out">

                            <div class="carousel-caption">
                            Try Out
                            </div>
                        </div>
                        <div class="item next left">
                            <img src="http://placehold.it/1500x500/3c8dbc/ffffff&amp;text=Bimbingan+Belajar" alt="Bimbingan Belajar">

                            <div class="carousel-caption">
                            Bimbingan Belajar
                            </div>
                        </div>
                        <div class="item">
                            <img src="http://placehold.it/1500x500/f39c12/ffffff&amp;text=Video+Materi" alt="Video Materi">

                            <div class="carousel-caption">
                            Video Materi
                            </div>
                        </div>
                        </div>
                        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                        <span class="fa fa-angle-left"></span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                        <span class="fa fa-angle-right"></span>
                        </a>
                    </div>
                </div>
            </div>        
        </div>
        <div class="row">

            <div class="row" style='padding-bottom: 20px;'>
                <a href="<?=base_url();?>user/try_out">
                    <div class="col-md-6">
                        <div class="box mb-4 shadow-sm" style='background: none;border-top: none;box-shadow: none;'>
                            <h3 class="main_text_menu col-lg-12 text-center">Try Out</h3>
                            <img style='height: 255px;' class='col-lg-12' src="<?php echo base_url() . 'assets/images/web_menu_try_put.jpg'; ?>" alt="Try Out">
                        </div>
                    </div>                
                </a>

                <a href="<?=base_url();?>user/bimbingan_belajar">
                    <div class="col-md-6">
                        <div class="box mb-4 shadow-sm" style='background: none;border-top: none;box-shadow: none;'>
                            <h3 class="main_text_menu col-lg-12 text-center">Bimbingan Belajar</h3>                        
                            <img style='height: 255px;' class='col-lg-12' src="<?php echo base_url() . 'assets/images/web_menu_bimbel.jpg'; ?>" alt="Bimbingan Belajar">
                        </div>
                    </div>                
                </a>
            </div>
            <div class="row">

                <a href="<?=base_url();?>user/video_materi">            
                    <div class="col-md-6">
                        <div class="box mb-4 shadow-sm" style='background: none;border-top: none;box-shadow: none;'>
                            <h3 class="main_text_menu col-lg-12 text-center">Video Materi</h3>
                            <img style='height: 255px;' class='col-lg-12' src="<?php echo base_url() . 'assets/images/web_menu_video_materi.jpg'; ?>" alt="Video Materi">
                        </div>
                    </div>
                </a>

                <a href="<?=base_url();?>user/mini_try_out">
                    <div class="col-md-6">
                        <div class="box mb-4 shadow-sm" style='background: none;border-top: none;box-shadow: none;'>
                            <h3 class="main_text_menu col-lg-12 text-center">Mini Try Out</h3>
                            <img style='height: 255px;' class='col-lg-12' src="<?php echo base_url() . 'assets/images/web_menu_mini_try_out.jpg'; ?>" alt="Mini Try Out">                            
                        </div>
                    </div>        
                </a>
            </div>            

        </div>
    </div>
</div>