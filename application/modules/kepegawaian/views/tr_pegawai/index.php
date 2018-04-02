<div class="row">
  <div class="col-xs-12">

    <div class="page-header">
      <h1>
        <?php echo $title?>
        <small>
          <i class="ace-icon fa fa-angle-double-right"></i>
          <?php echo isset($breadcrumbs)?$breadcrumbs:''?>
        </small>
      </h1>
    </div><!-- /.page-header -->

    <div class="clearfix" style="margin-bottom:-5px">
      <?php echo $this->authuser->show_button('kepegawaian/tr_pegawai','C','',1)?>
      <?php echo $this->authuser->show_button('kepegawaian/tr_pegawai','D','',5)?>
      
    </div>
    <hr class="separator">
    <!-- div.table-responsive -->

    <!-- div.dataTables_borderWrap -->
    <div style="margin-top:-27px">
      <table id="dynamic-table" class="table table-striped table-bordered table-hover">
       <thead>
        <tr>  
          <th class="center" style="max-width:30px"></th>
          <th class="hidden-md hidden-xs">ID</th>
          <th class="hidden-md hidden-xs">Foto Profil</th>
          <th>Nama Lengkap</th>
          <th class="hidden-md hidden-xs">Jabatan</th>
          <th class="hidden-md hidden-xs">Email</th>
          <th class="hidden-md hidden-xs">No.Telp/HP</th>
          <th class="hidden-md hidden-xs">Tanggal Aktif</th>
          <th class="hidden-md hidden-xs">Status</th>
          <th style="min-width:110px">Action</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
    </div>
  </div><!-- /.col -->
</div><!-- /.row -->


<script src="<?php echo base_url()?>/assets/js/dataTables/jquery.dataTables.js"></script>
<script src="<?php echo base_url()?>/assets/js/dataTables/jquery.dataTables.bootstrap.js"></script>
<script src="<?php echo base_url()?>/assets/js/dataTables/extensions/TableTools/js/dataTables.tableTools.js"></script>
<script src="<?php echo base_url()?>/assets/js/dataTables/extensions/ColVis/js/dataTables.colVis.js"></script>
<script src="<?php echo base_url().'assets/js/custom/tr_pegawai.js'?>"></script>



