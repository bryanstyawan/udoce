<?php
if ($list != array()) {
    # code...
?>
<div class="col-md-3">
    <div class="box box-solid" id="isi_kontak" style="">

        <div class="box-header with-border">
            <h3 class="box-title">Materi</h3>
        </div>
        <div class="box-body no-padding" style="display: block;">
            <ul class="nav nav-pills nav-stacked contact-id">
                <?php
                $i = "";
                for ($i=0; $i < count($list); $i++) {
                    // code...
                    ?>
                        <li style="cursor: pointer;" class="teamwork" onclick="detail_skp('<?=$list[$i]['id'];?>')">
                            <a class="contact-name">
                                <i class="fa fa-circle-o text-red contact-name-list"></i><?=$list[$i]['name'];?>
                            </a>
                        </li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
</div>
<?php
}
?>

<section class="col-md-9">
	<div class="box">
		<div class="box-body">
			<div class="row">
				<div class="col-md-12">
                    <label class="col-lg-11" id=""></label>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Judul Video</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
						<body>
                            
						</body>
					</table>
				</div>
			</div>

		</div><!-- /.box-body -->
	</div><!-- /.box -->		    
</section>