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
      <?php echo $this->authuser->show_button('casemix/Csm_billing_pasien','C','',1)?>
        <?php echo $this->authuser->show_button('casemix/Csm_billing_pasien','D','',5)?>

    </div>
    <hr class="separator">
    <!-- div.table-responsive -->

    <!-- div.dataTables_borderWrap -->
    <div style="margin-top:-27px">
      <table id="dynamic-table" class="table table-bordered table-hover">
       <thead>
        <tr>  
          <th width="30px" class="center"></th>
          <th width="50px">&nbsp;</th>
          <th width="50px">No. SEP</th>
          <th>No. MR</th>
          <th>No. SEP</th>
          <th>Nama Pasien</th>
          <th>Tanggal Masuk</th>
          <th>Tanggal Keluar</th>
          <th>Jaminan</th>
          <th>Tipe</th>
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
<script src="<?php echo base_url().'assets/js/custom/casemix/Csm_billing_pasien.js'?>"></script>



