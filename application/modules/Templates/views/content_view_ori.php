<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title><?php echo $apps->name?></title>

    <meta name="description" content="top menu &amp; navigation" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- css default for blank page -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/bootstrap.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/font-awesome.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/ace-fonts.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/ace.css" class="ace-main-stylesheet" id="main-ace-style" />
    <script src="<?php echo base_url()?>assets/js/ace-extra.js"></script>
    <!-- css default for blank page -->
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo base_url()?>assets/img/logo_kab_sintang.png">
    
  </head>

  <body class="no-skin">
    <!-- #section:basics/navbar.layout -->
    <div id="navbar" class="navbar navbar-default    navbar-collapse       h-navbar">
      <script type="text/javascript">
        try{ace.settings.check('navbar' , 'fixed')}catch(e){}
      </script>

      <div class="navbar-container" id="navbar-container">
        <div class="navbar-header pull-left">
          <!-- #section:basics/navbar.layout.brand -->
          <a href="#" class="navbar-brand">
            <small>
              <i class="fa fa-leaf"></i>
              <?php echo $apps->name?>
            </small>
          </a>

          <!-- /section:basics/navbar.layout.brand -->

          <!-- #section:basics/navbar.toggle -->
          <button class="pull-right navbar-toggle navbar-toggle-img collapsed" type="button" data-toggle="collapse" data-target=".navbar-buttons,.navbar-menu">
            <span class="sr-only">Toggle user menu</span>

            <img src="<?php echo base_url()?>assets/avatars/user.jpg" alt="<?php echo $this->session->userdata('user')->fullname?>" />
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
            <li class="transparent">
              <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <i class="ace-icon fa fa-bell icon-animated-bell"></i>
              </a>

              <div class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                <div class="tabbable">
                  <ul class="nav nav-tabs">
                    <li class="active">
                      <a data-toggle="tab" href="#navbar-tasks">
                        Tasks
                        <span class="badge badge-danger">4</span>
                      </a>
                    </li>

                    <li>
                      <a data-toggle="tab" href="#navbar-messages">
                        Messages
                        <span class="badge badge-danger">5</span>
                      </a>
                    </li>
                  </ul><!-- .nav-tabs -->

                  <div class="tab-content">
                    <div id="navbar-tasks" class="tab-pane in active">
                      <ul class="dropdown-menu-right dropdown-navbar dropdown-menu">
                        <li class="dropdown-content">
                          <ul class="dropdown-menu dropdown-navbar">
                            <li>
                              <a href="#">
                                <div class="clearfix">
                                  <span class="pull-left">Software Update</span>
                                  <span class="pull-right">65%</span>
                                </div>

                                <div class="progress progress-mini">
                                  <div style="width:65%" class="progress-bar"></div>
                                </div>
                              </a>
                            </li>

                            <li>
                              <a href="#">
                                <div class="clearfix">
                                  <span class="pull-left">Hardware Upgrade</span>
                                  <span class="pull-right">35%</span>
                                </div>

                                <div class="progress progress-mini">
                                  <div style="width:35%" class="progress-bar progress-bar-danger"></div>
                                </div>
                              </a>
                            </li>

                            <li>
                              <a href="#">
                                <div class="clearfix">
                                  <span class="pull-left">Unit Testing</span>
                                  <span class="pull-right">15%</span>
                                </div>

                                <div class="progress progress-mini">
                                  <div style="width:15%" class="progress-bar progress-bar-warning"></div>
                                </div>
                              </a>
                            </li>

                            <li>
                              <a href="#">
                                <div class="clearfix">
                                  <span class="pull-left">Bug Fixes</span>
                                  <span class="pull-right">90%</span>
                                </div>

                                <div class="progress progress-mini progress-striped active">
                                  <div style="width:90%" class="progress-bar progress-bar-success"></div>
                                </div>
                              </a>
                            </li>
                          </ul>
                        </li>

                        <li class="dropdown-footer">
                          <a href="#">
                            See tasks with details
                            <i class="ace-icon fa fa-arrow-right"></i>
                          </a>
                        </li>
                      </ul>
                    </div><!-- /.tab-pane -->

                    <div id="navbar-messages" class="tab-pane">
                      <ul class="dropdown-menu-right dropdown-navbar dropdown-menu">
                        <li class="dropdown-content">
                          <ul class="dropdown-menu dropdown-navbar">
                            <li>
                              <a href="#">
                                <img src="<?php echo base_url()?>assets/avatars/avatar.png" class="msg-photo" alt="Alex's Avatar" />
                                <span class="msg-body">
                                  <span class="msg-title">
                                    <span class="blue">Alex:</span>
                                    Ciao sociis natoque penatibus et auctor ...
                                  </span>

                                  <span class="msg-time">
                                    <i class="ace-icon fa fa-clock-o"></i>
                                    <span>a moment ago</span>
                                  </span>
                                </span>
                              </a>
                            </li>

                            <li>
                              <a href="#">
                                <img src="<?php echo base_url()?>assets/avatars/avatar3.png" class="msg-photo" alt="Susan's Avatar" />
                                <span class="msg-body">
                                  <span class="msg-title">
                                    <span class="blue">Susan:</span>
                                    Vestibulum id ligula porta felis euismod ...
                                  </span>

                                  <span class="msg-time">
                                    <i class="ace-icon fa fa-clock-o"></i>
                                    <span>20 minutes ago</span>
                                  </span>
                                </span>
                              </a>
                            </li>

                            <li>
                              <a href="#">
                                <img src="<?php echo base_url()?>assets/avatars/avatar4.png" class="msg-photo" alt="Bob's Avatar" />
                                <span class="msg-body">
                                  <span class="msg-title">
                                    <span class="blue">Bob:</span>
                                    Nullam quis risus eget urna mollis ornare ...
                                  </span>

                                  <span class="msg-time">
                                    <i class="ace-icon fa fa-clock-o"></i>
                                    <span>3:15 pm</span>
                                  </span>
                                </span>
                              </a>
                            </li>

                            <li>
                              <a href="#">
                                <img src="<?php echo base_url()?>assets/avatars/avatar2.png" class="msg-photo" alt="Kate's Avatar" />
                                <span class="msg-body">
                                  <span class="msg-title">
                                    <span class="blue">Kate:</span>
                                    Ciao sociis natoque eget urna mollis ornare ...
                                  </span>

                                  <span class="msg-time">
                                    <i class="ace-icon fa fa-clock-o"></i>
                                    <span>1:33 pm</span>
                                  </span>
                                </span>
                              </a>
                            </li>

                            <li>
                              <a href="#">
                                <img src="<?php echo base_url()?>assets/avatars/avatar5.png" class="msg-photo" alt="Fred's Avatar" />
                                <span class="msg-body">
                                  <span class="msg-title">
                                    <span class="blue">Fred:</span>
                                    Vestibulum id penatibus et auctor  ...
                                  </span>

                                  <span class="msg-time">
                                    <i class="ace-icon fa fa-clock-o"></i>
                                    <span>10:09 am</span>
                                  </span>
                                </span>
                              </a>
                            </li>
                          </ul>
                        </li>

                        <li class="dropdown-footer">
                          <a href="inbox.html">
                            See all messages
                            <i class="ace-icon fa fa-arrow-right"></i>
                          </a>
                        </li>
                      </ul>
                    </div><!-- /.tab-pane -->
                  </div><!-- /.tab-content -->
                </div><!-- /.tabbable -->
              </div><!-- /.dropdown-menu -->
            </li>

            <!-- #section:basics/navbar.user_menu -->
            <li class="light-blue user-min">
              <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                <img class="nav-user-photo" src="<?php echo base_url()?>assets/avatars/user.jpg" alt="Jason's Photo" />
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

                <!-- <li>
                  <a href="profile.html">
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
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                Overview
        &nbsp;
                <i class="ace-icon fa fa-angle-down bigger-110"></i>
              </a>

              <ul class="dropdown-menu dropdown-light-blue dropdown-caret">
                <li>
                  <a href="#">
                    <i class="ace-icon fa fa-eye bigger-110 blue"></i>
                    Monthly Visitors
                  </a>
                </li>

                <li>
                  <a href="#">
                    <i class="ace-icon fa fa-user bigger-110 blue"></i>
                    Active Users
                  </a>
                </li>

                <li>
                  <a href="#">
                    <i class="ace-icon fa fa-cog bigger-110 blue"></i>
                    Settings
                  </a>
                </li>
              </ul>
            </li>

            <li>
              <a href="#">
                <i class="ace-icon fa fa-envelope"></i>
                Pesan Masuk
                <span class="badge badge-warning">5</span>
              </a>
            </li>

            <li>
              <a href="#">
                <i class="ace-icon fa fa-user"></i>
                <?php echo $this->session->userdata('user')->fullname; ?> | <?php echo $this->session->userdata('user')->role_name; ?> 
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
                  <i class="menu-icon fa fa-question"></i>
                  <span class="menu-text"> Faq </span>
              </a>

              <b class="arrow"></b>
          </li>

          <?php
              if(count($menu) > 0){
              foreach ($menu as $key => $value) {
                  $string_link = ''.$value['link'].'';
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

          <?php } }?>

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
                            FAQ
                            <small>
                                <i class="ace-icon fa fa-angle-double-right"></i>
                                frequently asked questions
                            </small>
                        </h1>
                    </div><!-- /.page-header -->
                    
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- PAGE CONTENT BEGINS -->
                            
                            <div class="tabbable">
                                <!-- #section:pages/faq -->
                                <ul class="nav nav-tabs padding-18 tab-size-bigger" id="myTab">
                                    <li class="active">
                                        <a data-toggle="tab" href="#faq-tab-1">
                                            <i class="blue ace-icon fa fa-question-circle bigger-120"></i>
                                            General
                                        </a>
                                    </li>

                                    <li>
                                        <a data-toggle="tab" href="#faq-tab-2">
                                            <i class="green ace-icon fa fa-user bigger-120"></i>
                                            Tutorial
                                        </a>
                                    </li>

                                    <li>
                                        <a data-toggle="tab" href="#faq-tab-3">
                                            <i class="orange ace-icon fa fa-credit-card bigger-120"></i>
                                            Lainnya
                                        </a>
                                    </li>

                                </ul>

                                <!-- /section:pages/faq -->
                                <div class="tab-content no-border padding-24">
                                    <div id="faq-tab-1" class="tab-pane fade in active">
                                        <h4 class="blue">
                                            <i class="ace-icon fa fa-check bigger-110"></i>
                                            General Questions
                                        </h4>


                                        <div class="space-8"></div>

                                        <div id="faq-list-1" class="panel-group accordion-style1 accordion-style2">
                                            <?php
                                                $general = $this->master->get_custom_data(array('table'=>'m_faq', 'where'=>array('active'=>'Y', 'faq_flag'=>'general')));
                                                foreach ($general as $row_general) {
                                            ?>
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <a href="#<?php echo $row_general['faq_id']?>" data-parent="#faq-list-1" data-toggle="collapse" class="accordion-toggle collapsed">
                                                        <i class="ace-icon fa fa-chevron-left pull-right" data-icon-hide="ace-icon fa fa-chevron-down" data-icon-show="ace-icon fa fa-chevron-left"></i>

                                                        <i class="ace-icon fa fa-circle-o bigger-130"></i> &nbsp; 
                                                        <?php echo $row_general['faq_title']?>
                                                    </a>
                                                </div>

                                                <div class="panel-collapse collapse" id="<?php echo $row_general['faq_id']?>">
                                                    <div class="panel-body">
                                                        <?php echo $row_general['faq_description']?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php }?>

                                        </div>
                                    </div>

                                    <div id="faq-tab-2" class="tab-pane fade">
                                        <h4 class="blue">
                                            <i class="green ace-icon fa fa-user bigger-110"></i>
                                            Tutorial Usage
                                        </h4>

                                        <div class="space-8"></div>

                                        <div id="faq-list-2" class="panel-group accordion-style1 accordion-style2">

                                            <?php
                                                $tutorial = $this->master->get_custom_data(array('table'=>'m_faq', 'where'=>array('active'=>'Y', 'faq_flag'=>'tutorial')));
                                                foreach ($tutorial as $row_tutorial) {
                                            ?>
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <a href="#<?php echo $row_tutorial['faq_id']?>" data-parent="#faq-list-2" data-toggle="collapse" class="accordion-toggle collapsed">
                                                        <i class="ace-icon fa fa-chevron-right smaller-80" data-icon-hide="ace-icon fa fa-chevron-down align-top" data-icon-show="ace-icon fa fa-chevron-right"></i>&nbsp;<?php echo $row_tutorial['faq_title']?>
                                                    </a>
                                                </div>

                                                <div class="panel-collapse collapse" id="<?php echo $row_tutorial['faq_id']?>">
                                                    <div class="panel-body">
                                                        <?php echo $row_tutorial['faq_description']?>
                                                    </div>
                                                </div>
                                            </div>

                                            <?php }?>

                                        </div>
                                    </div>

                                    <div id="faq-tab-3" class="tab-pane fade">
                                        <h4 class="blue">
                                            <i class="orange ace-icon fa fa-credit-card bigger-110"></i>
                                            Other Querstion
                                        </h4>

                                        <div class="space-8"></div>

                                        <div id="faq-list-3" class="panel-group accordion-style1 accordion-style2">

                                        <?php
                                            $other = $this->master->get_custom_data(array('table'=>'m_faq', 'where'=>array('active'=>'Y', 'faq_flag'=>'lainnya')));
                                            foreach ($other as $row_other) {
                                        ?>

                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <a href="#<?php echo $row_other['faq_id']?>" data-parent="#faq-list-3" data-toggle="collapse" class="accordion-toggle collapsed">
                                                    <i class="ace-icon fa fa-plus smaller-80" data-icon-hide="ace-icon fa fa-minus" data-icon-show="ace-icon fa fa-plus"></i>&nbsp;
                                                        <?php echo $row_other['faq_title']?>
                                                </a>
                                            </div>

                                            <div class="panel-collapse collapse" id="<?php echo $row_other['faq_id']?>">
                                                <div class="panel-body">
                                                    <?php echo $row_other['faq_description']?>
                                                </div>
                                            </div>
                                        </div>

                                        <?php }?>

                                            
                                        </div>
                                    </div>

                                    
                                </div>
                            </div>


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
              <?php echo $apps->text_footer?>
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

    <script type="text/javascript">
      if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url()?>assets/js/jquery.mobile.custom.js'>"+"<"+"/script>");
    </script>
    <script src="<?php echo base_url()?>assets/js/bootstrap.js"></script>

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


    <!-- js custom -->
    <script src="<?php echo base_url()?>assets/js/custom/menu_load_page.js"></script>
    
  </body>
</html>
