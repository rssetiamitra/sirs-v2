<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title><?php echo $app->app_name?></title>

    <meta name="description" content="top menu &amp; navigation" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- css default for blank page -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/bootstrap.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/font-awesome.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/ace-fonts.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/ace.css" class="ace-main-stylesheet" id="main-ace-style" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/AdminLTE.css" class="ace-main-stylesheet" id="main-ace-style" />
    <script src="<?php echo base_url()?>assets/js/ace-extra.js"></script>
    <!-- css default for blank page -->
    <!-- Favicon -->

    <!-- page specific plugin styles -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/jquery-ui.custom.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/jquery.gritter.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/select2.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/datepicker.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/bootstrap-editable.css" />

    <link rel="shortcut icon" href="<?php echo base_url()?>assets/img/<?php echo $app->app_logo?>">

    

  </head>

  <body class="no-skin">
    <!-- #section:basics/navbar.layout -->
    <div id="navbar" class="navbar navbar-default navbar-collapse h-navbar" style="background: url('assets/images/<?php echo $app->style_header_color?>.png');">
      <script type="text/javascript">
        try{ace.settings.check('navbar' , 'fixed')}catch(e){}
      </script>

      <div class="navbar-container" id="navbar-container">
        <div class="navbar-header pull-left">
          <!-- #section:basics/navbar.layout.brand -->
          <a href="#" class="navbar-brand">
            <small>
              <?php echo $app->app_name?>
            </small>
          </a>

          <!-- /section:basics/navbar.layout.brand -->

          <!-- #section:basics/navbar.toggle -->
          <button class="pull-right navbar-toggle navbar-toggle-img collapsed" type="button" data-toggle="collapse" data-target=".navbar-buttons,.navbar-menu">
            <span class="sr-only">Toggle user menu</span>

            <img src="<?php echo base_url()?>assets/avatars/avatar5.png" alt="<?php echo $this->session->userdata('user')->username?>" />
          </button>

          <button class="pull-right navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#sidebar">
            <span class="sr-only">Toggle sidebar</span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>
          </button>

          <!-- /section:basics/navbar.toggle -->
        </div>

        <!-- #section:basics/navbar.dropdown -->
        <div class="navbar-buttons navbar-header pull-right  collapse navbar-collapse" role="navigation">
          <ul class="nav ace-nav">
            <!-- #section:basics/navbar.user_menu -->
            <li class="light-blue user-min">
              <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                <img class="nav-user-photo" src="<?php echo base_url()?>assets/avatars/avatar5.png" alt="<?php echo $this->session->userdata('user')->username?>'s Photo" />
                <span class="user-info">
                  <small>Welcome,</small>
                  <i><?php echo $this->session->userdata('user')->username?></i>
                </span>

                <i class="ace-icon fa fa-caret-down"></i>
              </a>

              <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
              
                <!-- <li>
                  <a href="#" onclick="getMenu('setting/Tmp_user/account_setting')">
                    <i class="ace-icon fa fa-key"></i>
                    Account
                  </a>
                </li>

                <li>
                  <a href="#" onclick="getMenu('setting/Tmp_user/form_update_profile')">
                    <i class="ace-icon fa fa-user"></i>
                    Profile
                  </a>
                </li> -->

                <li>
                  <a href="<?php echo base_url().'login/logout'?>">
                    <i class="ace-icon fa fa-power-off"></i>
                    Logout
                  </a>
                </li>
              </ul>
            </li>

            <!-- /section:basics/navbar.user_menu -->
          </ul>
        </div>

        <!-- /section:basics/navbar.dropdown -->
        <nav role="navigation" class="navbar-menu pull-left collapse navbar-collapse">
          <!-- #section:basics/navbar.nav -->
          <ul class="nav navbar-nav">


            <li>
              <a href="#">
                <i class="ace-icon fa fa-user"></i>
                <?php echo $this->session->userdata('user')->username; ?>
              </a>
            </li>

            <li>
              <a href="#">
                <i class="ace-icon fa fa-calendar"></i>
                <?php echo date('l, d F Y'); ?> 
              </a>
            </li>


          </ul>

        </nav>
      </div><!-- /.navbar-container -->
    </div>

    <!-- /section:basics/navbar.layout -->
    <div class="main-container" id="main-container">
      <script type="text/javascript">
        try{ace.settings.check('main-container' , 'fixed')}catch(e){}
      </script>


      <!-- /section:basics/sidebar.horizontal -->
      <div class="main-content">
        <div class="main-content-inner">
          <!-- #section:basics/content.breadcrumbs -->
          <?php
            $arr_color_breadcrumbs = array('#f39c12','#524e8f','#008d4d','#bc4031','#00acd7','#bab9b9');
            shuffle($arr_color_breadcrumbs);
          ?>
          <div class="breadcrumbs" id="breadcrumbs" style="background-color:<?php echo array_shift($arr_color_breadcrumbs)?>">
            <script type="text/javascript">
              try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
            </script>

            <ul class="breadcrumb">
              <li style="color:white">
                <i class="ace-icon fa fa-home home-icon"></i>
                 <marquee style="float:left;margin-top:-20px;"><?php echo $app->running_text?></marquee>
              </li>

            </ul><!-- /.breadcrumb -->

            <!-- /section:basics/content.searchbox -->
          </div>
          <div class="page-content">
            
            <div class="row">
              <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                <br>

                <!-- MODULE MENU -->
                <div class="row center">
                  <?php 
                    $arr_color = array('bg-aqua', 'bg-green', 'bg-yellow', 'bg-red', 'bg-purple','bg-orange','bg-blue'); shuffle($arr_color);
                    foreach($modul as $row_modul) :?>
                  <div class="col-lg-2 col-xs-6" style="margin-top:-10px">
                    <!-- small box -->
                    <div class="small-box <?php echo array_shift($arr_color)?>">
                      <div class="inner">
                        <h3 style="font-size:16px"><?php echo strtoupper($row_modul->name)?></h3>
                        <p style="font-size:12px"><?php echo $row_modul->description?></p>
                      </div>
                      <div class="icon" style="margin-top:-10px">
                        <i class="<?php echo $row_modul->icon?>"></i>
                      </div>
                      <a href="<?php echo base_url().'dashboard?mod='.$row_modul->modul_id.''?>" class="small-box-footer">Selengkapnya  <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <?php endforeach; ?>
                </div>
                <!-- END MODULE MENU -->

                <div id="page-area-content">
                  <div id="message_success" style="display:none" class="alert alert-block alert-success">
                      <button type="button" class="close" data-dismiss="alert">
                        <i class="ace-icon fa fa-times"></i>
                      </button>
                      <p><strong><i class="ace-icon fa fa-check"></i>Sukses !</strong>
                          Proses yang anda lakukan telah berhasil
                      </p>
                  </div>

                  <div class="col-sm-12">
                    <div id="user-profile-2" class="user-profile">
                      <div class="tabbable">
                        <ul class="nav nav-tabs padding-18">
                          <li class="active">
                            <a data-toggle="tab" href="#profile_pengguna">
                              <i class="green ace-icon fa fa-user bigger-120"></i>
                              Profil Pengguna
                            </a>
                          </li>

                          <li>
                            <a data-toggle="tab" href="#form_ubah_profile">
                              <i class="blue ace-icon fa fa-edit bigger-120"></i>
                              Ubah Profil
                            </a>
                          </li>

                          <li>
                            <a data-toggle="tab" href="#akun_saya">
                              <i class="pink ace-icon fa fa-lock bigger-120"></i>
                              Akun Saya
                            </a>
                          </li>
                        </ul>

                        <div class="tab-content no-border padding-24">

                          <div id="profile_pengguna" class="tab-pane in active">
                            <div class="row">
                              <div class="col-xs-12 col-sm-2 center">
                                <span class="profile-picture">
                                  <img style="max-width:150px" class="editable img-responsive" alt="<?php echo $this->session->userdata('user')->fullname?>" id="avatar2" src="<?php echo base_url().PATH_IMG_RESIZED.$profile_user->path_foto?>" />
                                </span>

                                <div class="space space-4"></div>

                              </div><!-- /.col -->

                              <div class="col-xs-12 col-sm-10">
                                <h4 class="blue">
                                  <span class="middle"><?php echo $this->session->userdata('user')->fullname?></span>

                                  <span class="label label-success arrowed-in-right">
                                    <i class="ace-icon fa fa-circle smaller-80 align-middle"></i>
                                    User Aktif
                                  </span>
                                </h4>

                                <div class="profile-user-info">
                                  <div class="profile-info-row">
                                    <div class="profile-info-name"> Nama Pengguna </div>

                                    <div class="profile-info-value">
                                      <span><?php echo ($this->session->userdata('user_profile'))?$this->session->userdata('user_profile')->fullname:''?></span>
                                    </div>
                                  </div>

                                  <div class="profile-info-row">
                                    <div class="profile-info-name"> TTL </div>

                                    <div class="profile-info-value">
                                      <i class="fa fa-calendar light-orange bigger-110"></i>
                                      <span><?php echo ($this->session->userdata('user_profile'))?$this->session->userdata('user_profile')->pob:''?>
                                        
                                        <?php echo ($this->session->userdata('user_profile'))?$this->tanggal->formatDate($this->session->userdata('user_profile')->dob):''?>
                                      </span>
                                    </div>
                                  </div>

                                  <div class="profile-info-row">
                                    <div class="profile-info-name"> Alamat </div>

                                    <div class="profile-info-value">
                                      <i class="fa fa-map-marker light-orange bigger-110"></i>
                                      <span><?php echo ($this->session->userdata('user_profile'))?$this->session->userdata('user_profile')->address:''?></span>
                                    </div>
                                  </div>

                                  <div class="profile-info-row">
                                    <div class="profile-info-name"> JK </div>
                                    <div class="profile-info-value">
                                      <span><?php echo ($this->session->userdata('user_profile'))?$this->session->userdata('user_profile')->gender:''?></span>
                                    </div>
                                  </div>

                                  <div class="profile-info-row">
                                    <div class="profile-info-name"> No Telp/Hp </div>

                                    <div class="profile-info-value">
                                      <span><?php echo ($this->session->userdata('user_profile'))?$this->session->userdata('user_profile')->no_hp:''?></span>
                                    </div>
                                  </div>

                                  <div class="profile-info-row">
                                    <div class="profile-info-name"> Quote </div>

                                    <div class="profile-info-value">
                                      <span><?php echo ($this->session->userdata('user_profile'))?$this->session->userdata('user_profile')->about_me:''?></span>
                                    </div>
                                  </div>

                                </div>

                                <div class="hr hr-8 dotted"></div>

                                <div class="profile-user-info">
                                  <div class="profile-info-row">
                                    <div class="profile-info-name">
                                      <i class="middle ace-icon fa fa-facebook-square bigger-150 blue"></i>
                                    </div>

                                    <div class="profile-info-value">
                                      <a href="#">Find me on Facebook</a>
                                    </div>
                                  </div>

                                  <div class="profile-info-row">
                                    <div class="profile-info-name">
                                      <i class="middle ace-icon fa fa-twitter-square bigger-150 light-blue"></i>
                                    </div>
                                    <div class="profile-info-value">
                                      <a href="#">Follow me on Twitter</a>
                                    </div>
                                  </div>

                                  <div class="profile-info-row">
                                    <div class="profile-info-name">
                                      <i class="middle ace-icon fa fa-instagram bigger-150 light-blue"></i>
                                    </div>
                                    <div class="profile-info-value">
                                      <a href="#">Follow me on Instagram</a>
                                    </div>
                                  </div>

                                </div>
                              </div><!-- /.col -->
                            </div><!-- /.row -->
                            <div class="space-20"></div>
                          </div><!-- /#home -->

                          <div id="form_ubah_profile" class="tab-pane">
                            <div class="col-xs-12 col-sm-10 col-sm-offset-1">

                              <div class="widget-body">
                                <div class="widget-main no-padding">
                                  <form class="form-horizontal" method="post" id="form_update_profile" action="<?php echo site_url('setting/Tmp_user/process_profile_user')?>" enctype="multipart/form-data">
                                    <br>

                                    <div class="form-group">
                                      <label class="control-label col-md-2">Profile ID</label>
                                      <div class="col-md-1">
                                        <input name="profile_id" id="profile_id" value="<?php echo isset($profile_user)?$profile_user->up_id:0?>" placeholder="Auto" class="form-control" type="text" readonly>
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label class="control-label col-md-2">Nama Lengkap</label>
                                      <div class="col-md-4">
                                        <input name="fullname_user" id="fullname_user" value="<?php echo isset($profile_user)?$profile_user->fullname:''?>" placeholder="" class="form-control" type="text"  >
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label class="control-label col-md-2">Tempat Lahir</label>
                                      <div class="col-md-3">
                                        <input name="pob" id="pob" value="<?php echo isset($profile_user)?$profile_user->pob:''?>" placeholder="" class="form-control" type="text"  >
                                      </div>
                                      <label class="control-label col-md-2">Tanggal Lahir</label>
                                      <div class="col-md-2">
                                        <div class="input-group">
                                          <input class="form-control date-picker" name="dob" id="dob" type="text" data-date-format="yyyy-mm-dd"  value="<?php echo isset($profile_user)?$profile_user->dob:date('Y-m-d')?>"/>
                                          <span class="input-group-addon">
                                            <i class="fa fa-calendar bigger-110"></i>
                                          </span>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label class="control-label col-md-2">Alamat</label>
                                      <div class="col-md-6">
                                        <input name="address" id="address" value="<?php echo isset($profile_user)?$profile_user->address:''?>" placeholder="" class="form-control" type="text"  >
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label class="control-label col-md-2">No Telp/Hp</label>
                                      <div class="col-md-3">
                                        <input name="no_telp" id="no_telp" value="<?php echo isset($profile_user)?$profile_user->no_telp:''?>" placeholder="" class="form-control" type="text" >
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label class="control-label col-md-2">Gender?</label>
                                      <div class="col-md-4">
                                        <div class="radio">
                                              <label>
                                                <input name="gender" type="radio" class="ace" value="L" <?php echo isset($profile_user) ? ($profile_user->gender == 'L') ? 'checked="checked"' : '' : 'checked="checked"'; ?>  />
                                                <span class="lbl"> Laki-laki</span>
                                              </label>
                                              <label>
                                                <input name="gender" type="radio" class="ace" value="P" <?php echo isset($profile_user) ? ($profile_user->gender == 'P') ? 'checked="checked"' : '' : ''; ?> />
                                                <span class="lbl"> Perempuan</span>
                                              </label>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label class="control-label col-md-2">Foto Profil</label>
                                      <div class="col-md-4">
                                        <input type="file" name="images" class="form-control" id="images">
                                      </div>
                                    </div>
                                    <?php if(isset($profile_user->path_foto)) :?>

                                       <div class="form-group">
                                          <label class="control-label col-md-2">&nbsp;</label>
                                          <div class="col-md-4">
                                            <img style="max-width:150px" class="editable img-responsive" alt="<?php echo $this->session->userdata('user')->fullname?>" id="avatar2" src="<?php echo base_url().PATH_IMG_DEFAULT.$profile_user->path_foto?>" />
                                          </div>
                                        </div>

                                    <?php endif;?>

                                    <div class="form-group">
                                      <label class="control-label col-md-2">Facebook</label>
                                      <div class="col-md-3">
                                        <input name="facebook" id="facebook" value="<?php echo isset($profile_user)?$profile_user->facebook:''?>" placeholder="" class="form-control" type="text" >
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label class="control-label col-md-2">Twitter</label>
                                      <div class="col-md-3">
                                        <input name="twitter" id="twitter" value="<?php echo isset($profile_user)?$profile_user->twitter:''?>" placeholder="" class="form-control" type="text" >
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label class="control-label col-md-2">Instagram</label>
                                      <div class="col-md-3">
                                        <input name="instagram" id="instagram" value="<?php echo isset($profile_user)?$profile_user->instagram:''?>" placeholder="" class="form-control" type="text" >
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label class="control-label col-md-2">Quotes</label>
                                      <div class="col-md-6">
                                        <textarea class="form-control" name="about_me" style="height:100px !important"><?php echo isset($profile_user)?$profile_user->about_me:''?></textarea>
                                      </div>
                                    </div>

                                    <div class="form-actions center">

                                      <!--hidden field-->
                                      <input name="user_id" id="user_id" value="<?php echo isset($profile_user)?$profile_user->user_id:0?>" placeholder="Auto" class="form-control" type="hidden" >
                                      <a href="#" id="btnSaveUpdateProfile" name="submit" onclick="exc_update_profile()" class="btn btn-sm btn-info">
                                        <i class="ace-icon fa fa-save icon-on-right bigger-110"></i>
                                        Simpan
                                      </a>
                                    </div>
                                  </form>
                                </div>
                              </div>

                            </div>
                          </div><!-- /#friends -->

                          <div id="akun_saya" class="tab-pane">
                            <div class="col-xs-12 col-sm-10 col-sm-offset-1">
                              <div class="widget-body">
                                <div class="widget-main no-padding">
                                  <form class="form-horizontal" method="post" id="form_tmp_user" action="<?php echo site_url('setting/Tmp_user/process')?>" enctype="multipart/form-data">
                                    <br>

                                    <div class="form-group">
                                      <label class="control-label col-md-2">ID</label>
                                      <div class="col-md-1">
                                        <input name="id" id="id" value="<?php echo isset($user)?$user->user_id:0?>" placeholder="Auto" class="form-control" type="text" readonly>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-md-2">Fullname</label>
                                      <div class="col-md-2">
                                        <input name="fullname" id="fullname" value="<?php echo isset($user)?$user->fullname:''?>" placeholder="" class="form-control" type="text" >
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-md-2">Email</label>
                                      <div class="col-md-2">
                                        <input name="email" id="email" value="<?php echo isset($user)?$user->email:''?>" placeholder="" class="form-control" type="text" >
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-md-2">Username</label>
                                      <div class="col-md-2">
                                        <input name="username" id="username" value="<?php echo isset($user)?$user->username:''?>" placeholder="" class="form-control" type="text" >
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-md-2">Password</label>
                                      <div class="col-md-2">
                                        <input name="password" id="password" value="<?php echo isset($user)?$user->password:''?>" placeholder="" class="form-control" type="password" >
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-md-2">Password Confirmation</label>
                                      <div class="col-md-2">
                                        <input name="confirm" id="confirm" value="" placeholder="" class="form-control" type="password" >
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-md-2">Is active?</label>
                                      <div class="col-md-2">
                                        <div class="radio">
                                              <label>
                                                <input name="is_active" type="radio" class="ace" value="Y" <?php echo isset($user) ? ($user->is_active == 'Y') ? 'checked="checked"' : '' : 'checked="checked"'; ?> />
                                                <span class="lbl"> Ya</span>
                                              </label>
                                              <label>
                                                <input name="is_active" type="radio" class="ace" value="N" <?php echo isset($user) ? ($user->is_active == 'N') ? 'checked="checked"' : '' : ''; ?>/>
                                                <span class="lbl">Tidak</span>
                                              </label>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="form-actions center">

                                      <a href="#" id="btnSaveMyAccount" onclick="exc_my_account()" name="submit" class="btn btn-sm btn-info">
                                        <i class="ace-icon fa fa-check-square-o icon-on-right bigger-110"></i>
                                        Simpan
                                      </a>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div><!-- /#pictures -->

                        </div>
                      </div>
                    </div>
                  </div>
                  
                </div>


                <!-- PAGE CONTENT ENDS -->
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.page-content -->
        </div>
      </div><!-- /.main-content -->

      <div class="footer">
        <div class="footer-inner">
          <!-- #section:basics/footer -->
          <div class="footer-content">
            <span class="bigger-120">
              <?php echo $app->footer?>
            </span>
          </div>

          <!-- /section:basics/footer -->
        </div>
      </div>

      <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
        <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
      </a>
    </div><!-- /.main-container -->

    <!-- basic scripts -->

    <!--[if !IE]> -->
    <script type="text/javascript">
      window.jQuery || document.write("<script src='<?php echo base_url()?>assets/js/jquery.js'>"+"<"+"/script>");
    </script>

    <!-- <![endif]-->

    <!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='../assets/js/jquery1x.js'>"+"<"+"/script>");
</script>
<![endif]-->
    <script type="text/javascript">
      if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url()?>assets/js/jquery.mobile.custom.js'>"+"<"+"/script>");
    </script>
    <script src="<?php echo base_url()?>assets/js/bootstrap.js"></script>

    <!-- page specific plugin scripts -->

    <!--[if lte IE 8]>
      <script src="<?php echo base_url()?>assets/js/excanvas.js"></script>
    <![endif]-->
    <script src="<?php echo base_url()?>assets/js/jquery-ui.custom.js"></script>
    <script src="<?php echo base_url()?>assets/js/jquery.ui.touch-punch.js"></script>
    <script src="<?php echo base_url()?>assets/js/jquery.gritter.js"></script>
    <!-- <script src="<?php echo base_url()?>assets/js/bootbox.js"></script>
    <script src="<?php echo base_url()?>assets/js/jquery.easypiechart.js"></script>
    <script src="<?php echo base_url()?>assets/js/date-time/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url()?>assets/js/jquery.hotkeys.js"></script>
    <script src="<?php echo base_url()?>assets/js/bootstrap-wysiwyg.js"></script>
    <script src="<?php echo base_url()?>assets/js/select2.js"></script>
    <script src="<?php echo base_url()?>assets/js/fuelux/fuelux.spinner.js"></script>
    <script src="<?php echo base_url()?>assets/js/x-editable/bootstrap-editable.js"></script>
    <script src="<?php echo base_url()?>assets/js/x-editable/ace-editable.js"></script>
    <script src="<?php echo base_url()?>assets/js/jquery.maskedinput.js"></script> -->

    <!-- ace scripts -->
    <!-- <script src="<?php echo base_url()?>assets/js/ace/elements.scroller.js"></script>
    <script src="<?php echo base_url()?>assets/js/ace/elements.colorpicker.js"></script>
    <script src="<?php echo base_url()?>assets/js/ace/elements.fileinput.js"></script>
    <script src="<?php echo base_url()?>assets/js/ace/elements.typeahead.js"></script>
    <script src="<?php echo base_url()?>assets/js/ace/elements.wysiwyg.js"></script>
    <script src="<?php echo base_url()?>assets/js/ace/elements.spinner.js"></script>
    <script src="<?php echo base_url()?>assets/js/ace/elements.treeview.js"></script>
    <script src="<?php echo base_url()?>assets/js/ace/elements.wizard.js"></script>
    <script src="<?php echo base_url()?>assets/js/ace/elements.aside.js"></script>
    <script src="<?php echo base_url()?>assets/js/ace/ace.js"></script>
    <script src="<?php echo base_url()?>assets/js/ace/ace.ajax-content.js"></script>
    <script src="<?php echo base_url()?>assets/js/ace/ace.touch-drag.js"></script>
    <script src="<?php echo base_url()?>assets/js/ace/ace.sidebar.js"></script>
    <script src="<?php echo base_url()?>assets/js/ace/ace.sidebar-scroll-1.js"></script>
    <script src="<?php echo base_url()?>assets/js/ace/ace.submenu-hover.js"></script>
    <script src="<?php echo base_url()?>assets/js/ace/ace.widget-box.js"></script>
    <script src="<?php echo base_url()?>assets/js/ace/ace.settings.js"></script>
    <script src="<?php echo base_url()?>assets/js/ace/ace.settings-rtl.js"></script>
    <script src="<?php echo base_url()?>assets/js/ace/ace.settings-skin.js"></script>
    <script src="<?php echo base_url()?>assets/js/ace/ace.widget-on-reload.js"></script>
    <script src="<?php echo base_url()?>assets/js/ace/ace.searchbox-autocomplete.js"></script> -->

    <!-- achtung loader -->
    <link href="<?php echo base_url()?>assets/achtung/ui.achtung-mins.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?php echo base_url()?>assets/achtung/ui.achtung-min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/achtung/achtung.js"></script> 

    <script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.form.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery-validation/dist/jquery.validate.js"></script>

    <!-- the following scripts are used in demo only for onpage help and you don't need them -->
    <!-- <link rel="stylesheet" href="<?php echo base_url()?>assets/css/ace.onpage-help.css" />

    <script type="text/javascript"> ace.vars['base'] = '..'; </script>
    <script src="<?php echo base_url()?>assets/js/ace/elements.onpage-help.js"></script>
    <script src="<?php echo base_url()?>assets/js/ace/ace.onpage-help.js"></script> -->
    <script src="<?php echo base_url()?>assets/js/custom/menu_load_page.js"></script>
    <script src="<?php echo base_url()?>assets/js/date-time/bootstrap-datepicker.js"></script>
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/datepicker.css" />
    <script>
      jQuery(function($) {

        $('.date-picker').datepicker({
          autoclose: true,
          todayHighlight: true
        })
        //show datepicker when clicking on the icon
        .next().on(ace.click_event, function(){
          $(this).prev().focus();
        });

      });

      $(document).ready(function(){
  
        $('#form_tmp_user').ajaxForm({
          beforeSend: function() {
            achtungShowLoader();  
          },
          uploadProgress: function(event, position, total, percentComplete) {
          },
          complete: function(xhr) {     
            var data=xhr.responseText;
            var jsonResponse = JSON.parse(data);

            if(jsonResponse.status === 200){
              $.achtung({message: jsonResponse.message, timeout:3});
              $('#message_success').show({
                  speed: 'slow',
                  timeout: 5000,
              });
            }else{
              $.achtung({message: jsonResponse.message, timeout:5});
            }
            achtungHideLoader();
          }
        });

        $('#form_update_profile').ajaxForm({
          beforeSend: function() {
            achtungShowLoader();  
          },
          uploadProgress: function(event, position, total, percentComplete) {
          },
          complete: function(xhr) {     
            var data=xhr.responseText;
            var jsonResponse = JSON.parse(data);

            if(jsonResponse.status === 200){
              $.achtung({message: jsonResponse.message, timeout:3});
              $('#message_success').show({
                  speed: 'slow',
                  timeout: 1000,
              });
            }else{
              $.achtung({message: jsonResponse.message, timeout:5});
            }
            achtungHideLoader();
          }
        });


      })

      function exc_my_account() {
        $('#form_tmp_user').submit();
        return false;
      }

      function exc_update_profile() {
        $('#form_update_profile').submit();
        return false;
      }

      
    </script>

    
  </body>
</html>
