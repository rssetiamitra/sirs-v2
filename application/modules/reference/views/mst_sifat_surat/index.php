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

    <div class="clearfix" style="margin-bottom:-20px">
      <?php echo $this->authuser->show_button('master_data/mst_sifat_surat','C','',1)?>
      <?php echo $this->authuser->show_button('master_data/mst_sifat_surat','D','',5)?>
      <div class="pull-right tableTools-container"></div>
    </div>
    <hr class="separator">
    <!-- div.table-responsive -->

    <!-- div.dataTables_borderWrap -->
    <div style="margin-top:-20px">
      <table id="dynamic-table" class="table table-striped table-bordered table-hover">
       <thead>
        <tr>  
          <th width="30px" class="center"></th>
          <th width="70px">ID</th>
          <th>Sifat Surat</th>
          <th width="100px">Status</th>
          <th width="180px">Last Update</th>
          <th width="150px">Action</th>
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
<script src="<?php echo base_url().'assets/js/custom/mst_sifat_surat.js'?>"></script>



