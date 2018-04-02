<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title><?php echo $app->name?></title>

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
    <link rel="shortcut icon" href="<?php echo base_url()?>assets/img/<?php echo $app->logo?>">

  </head>

  <body class="no-skin">
    <!-- #section:basics/navbar.layout -->
    <div id="navbar" class="navbar navbar-default navbar-collapse h-navbar" style="background: url('assets/images/<?php echo $app->color_style?>.png');">
      <script type="text/javascript">
        try{ace.settings.check('navbar' , 'fixed')}catch(e){}
      </script>

      <div class="navbar-container" id="navbar-container">
        <div class="navbar-header pull-left">
          <!-- #section:basics/navbar.layout.brand -->
          <a href="#" class="navbar-brand">
            <small>
              <?php if($this->session->userdata('user')->apps_id == 13) : ?>
              <img src="<?php echo base_url().'assets/images/'.$app->logo.''?>" style="max-height:30px;margin-top:-7px; margin-bottom:-5px">
            <?php else:?>
              <?php echo $app->name?>
            <?php endif;?>
            </small>
          </a>

          <!-- /section:basics/navbar.layout.brand -->

          <!-- #section:basics/navbar.toggle -->
          <button class="pull-right navbar-toggle navbar-toggle-img collapsed" type="button" data-toggle="collapse" data-target=".navbar-buttons,.navbar-menu">
            <span class="sr-only">Toggle user menu</span>

            <img src="<?php echo base_url()?>assets/avatars/avatar5.png" alt="<?php echo $this->session->userdata('user')->fullname?>" />
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
                <img class="nav-user-photo" src="<?php echo base_url()?>assets/avatars/avatar5.png" alt="<?php echo $this->session->userdata('user')->first_name?>'s Photo" />
                <span class="user-info">
                  <small>Welcome,</small>
                  <i><?php echo $this->session->userdata('user')->first_name?></i>
                </span>

                <i class="ace-icon fa fa-caret-down"></i>
              </a>

              <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
              
                <!-- <li>
                  <a href="#">
                    <i class="ace-icon fa fa-cog"></i>
                    Settings
                  </a>
                </li> -->

                <li>
                  <a href="#" onclick="getMenu('setting/profile')">
                    <i class="ace-icon fa fa-user"></i>
                    Profile
                  </a>
                </li>
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
            <?php 
              foreach ($menu as $key => $vmt) {
                if($vmt['not_allowed'] == 'Y'){
            ?>
            

            <li>
              <a href="#" <?php echo ($vmt['link']!='#')?'onclick="getMenu('."'".$vmt['link']."'".')"':''?> <?php echo ($vmt['link']!='#')?'':'class="dropdown-toggle" data-toggle="dropdown"'?>>
                <i class="<?php echo $vmt['icon']?>"></i> <?php echo $vmt['name']?>
        &nbsp;
                <?php echo ($vmt['link']!='#')?'':'<i class="ace-icon fa fa-angle-down bigger-110"></i>'?> 
              </a>

              <?php if( count($vmt['submenu']) != 0 ){?>
              <ul class="dropdown-menu dropdown-light-blue dropdown-caret">
                  <?php 
                    foreach($vmt['submenu'] as $rsm){ 
                      if($rsm['is_submodule'] != 'Y'):
                  ?>
                  <li>
                      <a href="#" onclick="getMenu('<?php echo $rsm['link']?>')">
                          <i class="fa fa-circle-o"></i>
                          <?php echo $rsm['name']?>
                      </a>
                  </li>
                  <?php endif; }?>
              </ul>
              <?php }?>
            </li>

            <?php } }?>

            <!-- <li>
              <a href="#" onclick="getMenu('message')" id="message_notification">
                <i class="ace-icon fa fa-envelope icon-animated-bell"></i>
                Pesan Masuk
                <?php echo ($notification['total_unread'] > 0)?'<span class="badge badge-warning">'.$notification['total_unread'].'</span>':''; ?>
                
              </a>
            </li> -->

            <li>
              <a href="#">
                <i class="ace-icon fa fa-user"></i>
                <?php echo $this->session->userdata('user')->fullname; ?> | <?php echo $this->session->userdata('user')->role_name; ?> 
              </a>
            </li>

            <li>
              <a href="#">
                <i class="ace-icon fa fa-calendar"></i>
                <?php echo date('l, d F Y'); ?> 
              </a>
            </li>


          </ul>

          <!-- /section:basics/navbar.nav -->

          <!-- #section:basics/navbar.form -->
          <!-- <form class="navbar-form navbar-left form-search" role="search">
            <div class="form-group">
              <input type="text" placeholder="search" />
            </div>

            <button type="button" class="btn btn-mini btn-info2">
              <i class="ace-icon fa fa-search icon-only bigger-110"></i>
            </button>
          </form> -->

          <!-- /section:basics/navbar.form -->
        </nav>
      </div><!-- /.navbar-container -->
    </div>

    <!-- /section:basics/navbar.layout -->
    <div class="main-container" id="main-container">
      <script type="text/javascript">
        try{ace.settings.check('main-container' , 'fixed')}catch(e){}
      </script>

      <!-- #section:basics/sidebar.horizontal -->
      <div id="sidebar" class="sidebar      h-sidebar                navbar-collapse collapse">
        <script type="text/javascript">
          try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
        </script>

        <!-- main menu -->

        <div class="sidebar-shortcuts" id="sidebar-shortcuts">

          <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
              
              <?php
              $menu_shortcut = $this->lib_menus->get_menus_shortcut(); //echo'<pre>';print_r($menu_shortcut);die;
                  if(count($menu_shortcut) > 0){
                  $no = 1; 
                  foreach ($menu_shortcut as $key2 => $value2) {
                      if($no == 1) { $btn_color = 'danger'; }elseif ($no == 2) { $btn_color = 'info'; }elseif ($no == 3) { $btn_color = 'warning'; }else{ $btn_color = 'success';}
                      if($value2['link'] != '#') { $js_func = 'getMenu'; $val_js = $value2['link']; }else{ $js_func = 'getMainMenu'; $val_js = $value2['menu_id']; }
              ?>

              <a class="btn btn-<?php echo $btn_color?>" onclick="<?php echo $js_func?>('<?php echo $val_js; ?>')">
                  <i class="<?php echo ($value2['icon'] != '#') ? $value2['icon'] : 'menu-icon fa fa-info' ; ?>"></i>
              </a>

              <?php $no++; } } ?>

              <!-- /section:basics/sidebar.layout.shortcuts -->
          </div>

          <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
              <span class="btn btn-success"></span>

              <span class="btn btn-info"></span>

              <span class="btn btn-warning"></span>

              <span class="btn btn-danger"></span>
          </div>
      </div><!-- /.sidebar-shortcuts -->

      <ul class="nav nav-list">

          <li class="hover">
              <a href="<?php echo base_url().'dashboard'?>">
                  <i class="menu-icon fa fa-dashboard"></i>
                  <span class="menu-text"> Dashboard </span>
              </a>

              <b class="arrow"></b>
          </li>

          <?php
              if(count($menu) > 0){
              foreach ($menu as $key => $value) {
                  $string_link = ''.$value['link'].'';
                  if($value['not_allowed'] != 'Y'):
          ?>


          <li class="hover">
              <a href="#" <?php echo ( $value['link'] == '#' ) ? 'class="dropdown-toggle"' : '' ;?>  <?php if( $value['link'] != '#' ){?> onclick="getMenu('<?php echo $value['link']?>')" <?php }?>>
                  <i class="menu-icon <?php echo $value['icon']?>"></i>
                  <span class="menu-text"> <?php echo $value['name']?> </span>
                  <?php echo ( $value['link'] == '#' ) ? '<b class="arrow fa fa-angle-down"></b>' : '' ;?>
              </a>

              <b class="arrow"></b>
              <?php if( count($value['submenu']) != 0 ){?>
              <ul class="submenu">
                  <?php foreach($value['submenu'] as $row_sub_menu){ ?>
                  <li class="">
                      <a href="#" onclick="getMenu('<?php echo $row_sub_menu['link']?>')">
                          <i class="menu-icon fa fa-caret-right"></i>
                          <?php echo $row_sub_menu['name']?>
                      </a>

                      <b class="arrow"></b>
                  </li>
                  <?php }?>
              </ul>
              <?php }?>

          </li>

          <?php endif; } }?>

          <li>
              <a href="<?php echo base_url().'login/logout'?>">
                  <i class="menu-icon fa fa-power-off"></i>
                  <span class="menu-text"> Logout </span>
              </a>
              <b class="arrow"></b>
          </li>

        </ul><!-- /.nav-list -->
        <!-- end main menu -->


        <!-- /section:basics/sidebar.layout.minimize -->
        <script type="text/javascript">
          try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
        </script>
      </div>

      <!-- /section:basics/sidebar.horizontal -->
      <div class="main-content">
        <div class="main-content-inner">
          <div class="page-content">
            <!-- #section:settings.box -->
            <div class="ace-settings-container" id="ace-settings-container">
              <div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
                <i class="ace-icon fa fa-cog bigger-130"></i>
              </div>

              <div class="ace-settings-box clearfix" id="ace-settings-box">
                <div class="pull-left width-50">
                  <!-- #section:settings.skins -->
                  <div class="ace-settings-item">
                    <div class="pull-left">
                      <select id="skin-colorpicker" class="hide">
                        <option data-skin="no-skin" value="#438EB9">#438EB9</option>
                        <option data-skin="skin-1" value="#222A2D">#222A2D</option>
                        <option data-skin="skin-2" value="#C6487E">#C6487E</option>
                        <option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
                      </select>
                    </div>
                    <span>&nbsp; Choose Skin</span>
                  </div>

                  <!-- /section:settings.skins -->

                  <!-- #section:settings.navbar -->
                  <div class="ace-settings-item">
                    <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-navbar" />
                    <label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
                  </div>

                  <!-- /section:settings.navbar -->

                  <!-- #section:settings.sidebar -->
                  <div class="ace-settings-item">
                    <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-sidebar" />
                    <label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
                  </div>

                  <!-- /section:settings.sidebar -->

                  <!-- #section:settings.breadcrumbs -->
                  <div class="ace-settings-item">
                    <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-breadcrumbs" />
                    <label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
                  </div>

                  <!-- /section:settings.breadcrumbs -->

                  <!-- #section:settings.container -->
                  

                  <!-- /section:settings.container -->
                </div><!-- /.pull-left -->

                <div class="pull-left width-50">
                  <!-- #section:basics/sidebar.options -->
                  <div class="ace-settings-item">
                    <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-add-container" />
                    <label class="lbl" for="ace-settings-add-container">
                      Inside
                      <b>.container</b>
                    </label>
                  </div>
                  <div class="ace-settings-item">
                    <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-highlight" />
                    <label class="lbl" for="ace-settings-highlight"> Alt. Active Item</label>
                  </div>


                  <!-- /section:basics/sidebar.options -->
                </div><!-- /.pull-left -->
              </div><!-- /.ace-settings-box -->
            </div><!-- /.ace-settings-container -->

            <!-- /section:settings.box -->
            <div class="row">
              <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->

                <div id="page-area-content">
                    <div class="page-header">
                        <h1>
                            Dashboard
                            <small>
                                <i class="ace-icon fa fa-angle-double-right"></i>
                                <?php echo $app->name?>
                            </small>
                        </h1>
                    </div><!-- /.page-header -->
                    
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- PAGE CONTENT BEGINS -->
                            
                            <?php if(in_array($this->session->userdata('user')->apps_id, array(1,2,3,9,10,11))) : ?>
                            <div class="row">
                              <div class="col-lg-3 col-xs-6">

                                <!-- small box -->
                                <div class="small-box bg-aqua">
                                  <div class="inner">
                                    <h3><?php echo $dashboard['total_surat_masuk']?></h3>
                                    <p>SURAT MASUK</p>
                                  </div>
                                  <div class="icon" style="margin-top:-10px">
                                    <i class="fa fa-envelope"></i>
                                  </div>
                                  <a href="#" class="small-box-footer" onclick="getMenu('surat/surat_masuk')">Selengkapnya  <i class="fa fa-arrow-circle-right"></i></a>
                                </div>

                              </div>
                              <!-- ./col -->
                              <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-green">
                                  <div class="inner">
                                    <h3><?php echo $dashboard['total_surat_keluar']?></h3>
                                    <p>SURAT KELUAR</p>
                                  </div>
                                  <div class="icon" style="margin-top:-10px">
                                    <i class="fa fa-folder-open-o"></i>
                                  </div>
                                  <a href="#" onclick="getMenu('surat/surat_keluar')" class="small-box-footer">Selengkapnya  <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                              </div>
                              <!-- ./col -->
                              <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-yellow">
                                  <div class="inner">
                                    <h3><?php echo $dashboard['total_disposisi_masuk']?></h3>
                                    <p>DISPOSISI MASUK</p>
                                  </div>
                                  <div class="icon" style="margin-top:-10px">
                                    <i class="fa fa-download"></i>
                                  </div>
                                  <a href="#" onclick="getMenu('surat/disposisi')" class="small-box-footer">Selengkapnya  <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                              </div>
                              <!-- ./col -->
                              <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box bg-red">
                                  <div class="inner">
                                    <h3><?php echo $dashboard['total_disposisi_keluar']?></h3>
                                    <p>DISPOSISI KELUAR</p>
                                  </div>
                                  <div class="icon" style="margin-top:-10px">
                                    <i class="fa fa-paper-plane-o"></i>
                                  </div>
                                  <a href="#" onclick="getMenu('surat/disposisi?out=true')" class="small-box-footer">Selengkapnya  <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                              </div>
                              <!-- ./col -->
                            </div>
                            <?php endif;?>

                            <?php if(in_array($this->session->userdata('user')->apps_id, array(1,2,3))) : ?>
                            <div class="col-sm-6">
                              <div class="widget-box transparent">
                                <div class="widget-header">
                                  <h4 class="widget-title lighter smaller">
                                    <i class="ace-icon fa fa-list orange"></i>Rekapitulasi Persuratan Digital SIPEPP - DKPP Tahun 2017
                                  </h4>
                                </div>

                                <div class="widget-body">
                                  <div class="widget-main no-padding">
                                    <div id="piechart"></div>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="col-sm-6">
                              <div class="widget-box transparent">
                                <div class="widget-header">
                                  <h4 class="widget-title lighter smaller">
                                    <i class="ace-icon fa fa-bell orange"></i>Riwayat Pemberitahuan
                                  </h4>
                                </div>

                                <div class="widget-body">
                                  <div class="widget-main no-padding">
                                    <!-- #section:pages/dashboard.conversations -->
                                    <div class="dialogs">
                                      <?php foreach($notification['history']->result() as $row_notif){?>
                                      <div class="itemdiv dialogdiv">

                                        <div class="body">
                                          <div class="time">
                                            <i class="ace-icon fa fa-clock-o"></i>
                                            <span class="green"><?php echo $this->tanggal->formatDateTime($row_notif->created_date)?></span>
                                          </div>

                                          <div class="name">
                                            <a href="#" onclick="getMenu(<?php echo "'".$row_notif->link."'"?>)">From : <i class="fa fa-user"></i> <?php echo ucwords(strtolower($row_notif->fullname))?></a>
                                          </div>
                                          <div class="text">
                                            <?php echo $row_notif->message?>.<br><?php echo ($row_notif->is_read=='N')?'<span style="color:red">( unread )</span>':'<span style="color:green"><i class="fa fa-check green"></i> read</span>'?>
                                          </div>

                                          <div class="tools">
                                            <a href="#" onclick="getMenu(<?php echo "'".$row_notif->link."'"?>)" class="btn btn-minier btn-info">
                                              <i class="icon-only ace-icon fa fa-share"></i>
                                            </a>
                                          </div>
                                        </div>
                                      </div>
                                      <?php }?>
                                    </div>
                                    <form>
                                      <div class="form-actions">
                                        <i class="red">Last update <?php echo date('l, d F Y')?></i>
                                      </div>
                                    </form>
                                  </div>
                                </div><!-- /.widget-body -->
                              </div><!-- /.widget-box -->
                            </div>

                            <?php endif; ?>

                            <?php if(in_array($this->session->userdata('user')->apps_id, array(1,2,9))) : ?>
                            <div class="col-sm-12">
                              <div class="widget-box transparent">
                                <div class="widget-body">
                                  <div class="widget-main no-padding">
                                    <!-- #section:pages/dashboard.conversations -->
                                    <div id="pengaduan_grafik"></div>

                                  </div>
                                </div><!-- /.widget-body -->
                              </div><!-- /.widget-box -->
                            </div>

                            <!-- <div class="col-sm-12">
                              <div class="widget-box transparent">
                                <div class="widget-header">
                                  <h4 class="widget-title lighter smaller">
                                    <i class="ace-icon fa fa-bell orange"></i>Rekapitulasi Pengaduan Berdasarkan Status Verifikasi
                                  </h4>
                                </div>

                                <div class="widget-body">
                                  <div class="widget-main no-padding">
                                    <div id="pengaduan_by_status"></div>

                                  </div>
                                </div>
                              </div>
                            </div> -->

                            <?php endif; ?>

                            <?php if(in_array($this->session->userdata('user')->apps_id, array(13))) : ?>
                            <div class="col-sm-12">
                              <div class="widget-box transparent">
                                <div class="widget-body">
                                  <div class="widget-main no-padding">
                                    <!-- #section:pages/dashboard.conversations -->
                                    <div id="pengaduan_grafik_sidasimadu"></div>

                                  </div>
                                </div><!-- /.widget-body -->
                              </div><!-- /.widget-box -->
                            </div>
                            
                            <?php endif; ?>

                            <!-- /.col -->
                            
                            <!-- PAGE CONTENT ENDS -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                    
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
              <?php echo $app->text_footer?>
            </span>
          </div>

          <!-- /section:basics/footer -->
        </div>
      </div>

      <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
        <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
      </a>
    </div><!-- /.main-container -->

    <!-- modal pengaduan detail -->
    <div id="ModalPengaduanDetail" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Title</h4>
          </div>
          <div class="modal-body">
            <div id="modalContent"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>

    <div id="ModalError" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Peringatan</h4>
          </div>
          <div class="modal-body">
            <p>Error</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>

    <!-- basic scripts -->

    <!--[if !IE]> -->
    <script type="text/javascript">
      window.jQuery || document.write("<script src='<?php echo base_url()?>assets/js/jquery.js'>"+"<"+"/script>");
    </script>

    <script type="text/javascript">
      if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url()?>assets/js/jquery.mobile.custom.js'>"+"<"+"/script>");
    </script>
    <script src="<?php echo base_url()?>assets/js/bootstrap.js"></script>

    <!-- page specific plugin scripts -->
    <script src="<?php echo base_url()?>assets/js/select2.js"></script>

    <!-- page specific plugin scripts -->
    <!-- ace scripts -->
    <script src="<?php echo base_url()?>assets/js/ace/elements.scroller.js"></script>
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
    <script src="<?php echo base_url()?>assets/js/ace/ace.searchbox-autocomplete.js"></script>

    <!-- achtung loader -->
    <link href="<?php echo base_url()?>assets/achtung/ui.achtung-mins.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?php echo base_url()?>assets/achtung/ui.achtung-min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/achtung/achtung.js"></script> 
    
    <script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.form.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery-validation/dist/jquery.validate.js"></script>

    <script type="text/javascript">
      jQuery(function($) {
        $('.dialogs,.comments').ace_scroll({
          size: 300
          });
      })

      function showModal(pgdId)
      {
         $.ajax({
            url : '<?php echo base_url().'Templates/References/getPengaduanDetail/' ?>'+pgdId,
            type: "POST",
            dataType: "JSON",
            processData: false,
            success: function(data, textStatus, jqXHR, responseText)
            {
                $("#ModalPengaduanDetail .modal-title").html('<i class="fa fa-bullhorn"></i> NO REGISTRASI PENGADUAN : ' + pgdId);
                $("#ModalPengaduanDetail").modal();
                $("#modalContent").html(data.result);
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                $("#ModalError").modal("show");
            }
        });

         
      }

    </script>


    <!-- js custom -->
    <script src="<?php echo base_url()?>assets/js/custom/menu_load_page.js"></script>
    

    <script src="<?php echo base_url()?>assets/chart/highcharts.js"></script>
    <script src="<?php echo base_url()?>assets/chart/modules/exporting.js"></script>

    <script type="text/javascript">

    $(function () {
        $('#piechart').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'Rekapitulasi Persuratan'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        }
                    }
                }
            },
            series: [{
                type: 'pie',
                name: 'Total Surat',
                data: [
                    ['Surat Masuk', <?php echo $dashboard['total_surat_masuk']?>],
                    ['Surat Keluar', <?php echo $dashboard['total_surat_keluar']?>],
                    ['Disposisi Masuk', <?php echo $dashboard['total_disposisi_masuk']?>],
                    ['Disposisi Keluar', <?php echo $dashboard['total_disposisi_keluar']?>]
                ]
            }]
        });

        $('#pengaduan_grafik').highcharts({
                    title: {
                        text: 'Rekapitulasi Pengaduan Masuk Tahun <?php echo date('Y')?>',
                        x: -20 //center
                    },
                    subtitle: {
                        text: '(Source data : SIPEPP Data Registrasi Pengaduan dari tanggal <?php echo $this->tanggal->formatDate($graph_pengaduan_masuk_by_existing_year['result_global']->min_date).' s.d '.$this->tanggal->formatDate($graph_pengaduan_masuk_by_existing_year['result_global']->max_date)?>) <br> Total <?php echo $graph_pengaduan_masuk_by_existing_year['result_global']->total?> Pengaduan Masuk',
                        x: -20 //center
                    },
                    xAxis: {
                        categories: [
                                      <?php foreach ($graph_pengaduan_masuk_by_existing_year['result_month'] as $k => $v) {
                                        echo "'".$this->tanggal->getBulan($v->bln)."',";
                                      }?>
                                    ]
                    },
                    yAxis: {
                        title: {
                            text: 'Total Pengaduan'
                        },
                        plotLines: [{
                            value: 0,
                            width: 1,
                            color: '#808080'
                        }]
                    },
                    tooltip: {
                        valueSuffix: ''
                    },
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom',
                        borderWidth: 0
                    },
                    series: [{
                        name: 'Pengaduan',
                        data: [
                                <?php foreach ($graph_pengaduan_masuk_by_existing_year['result_month'] as $k2 => $v2) {
                                  echo $v2->total.',';
                                }?>
                              ]
                    }
                    ]
        });

        $('#pengaduan_grafik_sidasimadu').highcharts({
                    title: {
                        text: 'Rekapitulasi Verifikasi Materil Pengaduan Tahun <?php echo date('Y')?>',
                        x: -20 //center
                    },
                    subtitle: {
                        text: '(Source data : SIDASIMADU dari tanggal <?php echo $this->tanggal->formatDate($dashboard_sidasimadu_by_existing_year['result_global']->min_date).' s.d '.$this->tanggal->formatDate($dashboard_sidasimadu_by_existing_year['result_global']->max_date)?>) <br> Total <?php echo $dashboard_sidasimadu_by_existing_year['result_global']->total?> Pengaduan Masuk',
                        x: -20 //center
                    },
                    xAxis: {
                        categories: [
                                      <?php foreach ($dashboard_sidasimadu_by_existing_year['result_month'] as $k => $v) {
                                        echo "'".$this->tanggal->getBulan($v->bln)."',";
                                      }?>
                                    ]
                    },
                    yAxis: {
                        title: {
                            text: 'Total Pengaduan'
                        },
                        plotLines: [{
                            value: 0,
                            width: 1,
                            color: '#808080'
                        }]
                    },
                    tooltip: {
                        valueSuffix: ''
                    },
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom',
                        borderWidth: 0
                    },
                    series: [{
                        name: 'Pengaduan',
                        data: [
                                <?php foreach ($dashboard_sidasimadu_by_existing_year['result_month'] as $k2 => $v2) {
                                  echo $v2->total.',';
                                }?>
                              ]
                    }
                    ]
        });


        $('#pengaduan_by_status').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Pengaduan Berdasarkan Status Verifikasi'
        },
        xAxis: {
            categories: [
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'May',
                'Jun',
                'Jul',
                'Aug',
                'Sep',
                'Oct',
                'Nov',
                'Dec'
            ]
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total Pengaduan'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Sidang',
            data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]

        }, {
            name: 'BMS',
            data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]

        }, {
            name: 'Dismiss',
            data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]

        }, {
            name: 'Tertunda',
            data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]

        }]
    });

        
    });
    </script>

  </body>
</html>
