<li class="dropdown user user-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="margin-top: 0px;
                                                                    margin-bottom: 0px;
                                                                    padding-bottom: 1px;
                                                                    padding-top: 1px;
                                                                    padding-right: 5px;
                                                                    padding-left: 5px;">
    <img class="icn_user" src="http://mandarinpalace.fi/wp-content/uploads/2015/11/businessman.jpg">                                                                    

    </a>
    <ul class="dropdown-menu" style="left: auto;">
        <li class="user-footer">
            <div class="pull-left">
            <?php echo anchor('auth/change_password','Ubah Password',array('class'=>'btn btn-default btn-flat'));?>
            </div>
            <div class="pull-right">
            <?php echo anchor('auth/signout','Keluar',array('class'=>'btn btn-default btn-flat'));?>
            </div>
        </li>
    </ul>
</li>