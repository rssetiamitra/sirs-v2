<script src="<?php echo base_url()?>assets/js/date-time/bootstrap-datepicker.js"></script>
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/datepicker.css" />
<script>
jQuery(function($) {

  $('select[name="uk_id"]').change(function() {
      if ($(this).val()) {
          $.getJSON("<?php echo site_url('templates/references/get_jabatan_by_uk_id') ?>/" + $(this).val(), '', function(data) {
              $('#jbtn_id option').remove()
              $('<option value="">(Pilih Jabatan)</option>').appendTo($('#jbtn_id'));
              $.each(data, function(i, o) {
                  $('<option value="'+o.jbtn_id+'">'+o.jbtn_name+'</option>').appendTo($('#jbtn_id'));
              });

          });
      } else {
          $('#jbtn_id option').remove()
          $('<option value="">(Pilih Jabatan)</option>').appendTo($('#jbtn_id'));
      }
  });

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
  
    $('#form_tr_pegawai').ajaxForm({
      beforeSend: function() {
        achtungShowLoader();  
      },
      uploadProgress: function(event, position, total, percentComplete) {
      },
      complete: function(xhr) {     
        var data=xhr.responseText;
        var jsonResponse = JSON.parse(data);

        if(jsonResponse.status === 200){
          $.achtung({message: jsonResponse.message, timeout:5});
          $('#page-area-content').load('kepegawaian/tr_pegawai?_=' + (new Date()).getTime());
        }else{
          $.achtung({message: jsonResponse.message, timeout:5});
        }
        achtungHideLoader();
      }
    }); 
})

</script>

<div class="page-header">
  <h1>
    <?php echo $title?>
    <small>
      <i class="ace-icon fa fa-angle-double-right"></i>
      <?php echo $breadcrumbs?>
    </small>
  </h1>
</div><!-- /.page-header -->

<div class="row">
  <div class="col-xs-12">
    <!-- PAGE CONTENT BEGINS -->
          <div class="widget-body">
            <div class="widget-main no-padding">
              <form class="form-horizontal" method="post" id="form_tr_pegawai" action="<?php echo site_url('kepegawaian/tr_pegawai/process')?>" enctype="multipart/form-data">
                <br>
                <h3 class="header smaller lighter blue">
                    Identitas
                    <small>Data pegawai berdasarkan KTP</small>
                  </h3>
                <div class="form-group">
                  <label class="control-label col-md-2">ID</label>
                  <div class="col-md-1">
                    <input name="id" id="id" value="<?php echo isset($value)?$value->pg_id:0?>" placeholder="Auto" class="form-control" type="text" readonly>
                  </div>
                  
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Nama Lengkap</label>
                  <div class="col-md-4">
                    <input name="fullname" id="fullname" value="<?php echo isset($value)?$value->fullname:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Nama Lengkap</label>
                  <div class="col-md-4">
                    <input name="fullname" id="fullname" value="<?php echo isset($value)?$value->fullname:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">NIP</label>
                  <div class="col-md-4">
                    <input name="nip" id="nip" value="<?php echo isset($value)?$value->nip:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Email</label>
                  <div class="col-md-2">
                    <input name="email" id="email" value="<?php echo isset($value)?$value->email:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
                  </div>
                  <label class="control-label col-md-1">No Telp/Hp</label>
                  <div class="col-md-2">
                    <input name="no_telp" id="no_telp" value="<?php echo isset($value)?$value->no_telp:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-2">Foto Profil</label>
                  <div class="col-md-3">
                    <input name="file" id="file" value="<?php echo isset($value)?$value->photo:''?>" placeholder="" class="form-control" type="file" <?php echo ($flag=='read')?'readonly':''?>>
                  </div>

                </div>

                <div class="form-group">
                  <label class="control-label col-md-2">Tanggal Aktif</label>
                  <div class="col-md-2">
                    <div class="input-group">
                      <input class="form-control date-picker" name="active_date" id="active_date" type="text" data-date-format="yyyy-mm-dd" <?php echo ($flag=='read')?'readonly':''?> value="<?php echo isset($value)?$value->active_date:''?>"/>
                      <span class="input-group-addon">
                        <i class="fa fa-calendar bigger-110"></i>
                      </span>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-2">Unit Kerja</label>
                  <div class="col-md-4">
                    <?php echo $this->master->custom_selection(array('table'=>'mst_unit_kerja', 'where'=>array('is_active'=>'Y'), 'id'=>'uk_id', 'name' => 'uk_name'),isset($value)?$value->uk_id:'','uk_id','uk_id','chosen-slect form-control',($flag=='read')?'readonly':'','');?>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-2">Jabatan</label>
                  <div class="col-md-4">
                    <select name="jbtn_id" id="jbtn_id" class="form-control">
                      <option value="">-Silahkan Pilih-</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-2">Is active? ?</label>
                  <div class="col-md-2">
                    <div class="radio">
                          <label>
                            <input name="is_active" type="radio" class="ace" value="Y" <?php echo isset($value) ? ($value->is_active == 'Y') ? 'checked="checked"' : '' : 'checked="checked"'; ?> <?php echo ($flag=='read')?'readonly':''?> />
                            <span class="lbl"> Ya</span>
                          </label>
                          <label>
                            <input name="is_active" type="radio" class="ace" value="N" <?php echo isset($value) ? ($value->is_active == 'N') ? 'checked="checked"' : '' : ''; ?> <?php echo ($flag=='read')?'readonly':''?>/>
                            <span class="lbl">Tidak</span>
                          </label>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-2">Last update</label>
                  <div class="col-md-4" style="padding-top:8px">
                    <b>
                      <i class="fa fa-calendar"></i> <?php echo isset($value->updated_date)?$this->tanggal->formatDateTime($value->updated_date):isset($value)?$this->tanggal->formatDateTime($value->created_date):date('d-M-Y H:i:s')?> - 
                      by : <i class="fa fa-user"></i> <?php echo isset($value->updated_by)?$value->updated_by:isset($value->created_by)?$value->created_by:$this->session->userdata('user')->fullname?>
                    </b>
                  </div>
                </div>


                <div class="form-actions center">

                  <!--hidden field-->
                  <!-- <input type="text" name="id" value="<?php echo isset($value)?$value->pg_id:0?>"> -->

                  <a onclick="getMenu('kepegawaian/tr_pegawai')" href="#" class="btn btn-sm btn-success">
                    <i class="ace-icon fa fa-arrow-left icon-on-right bigger-110"></i>
                    Kembali ke daftar
                  </a>
                  <?php if($flag != 'read'):?>
                  <button type="reset" id="btnReset" class="btn btn-sm btn-danger">
                    <i class="ace-icon fa fa-close icon-on-right bigger-110"></i>
                    Reset
                  </button>
                  <button type="submit" id="btnSave" name="submit" class="btn btn-sm btn-info">
                    <i class="ace-icon fa fa-check-square-o icon-on-right bigger-110"></i>
                    Submit
                  </button>
                <?php endif; ?>
                </div>
              </form>
            </div>
          </div>
    
    <!-- PAGE CONTENT ENDS -->
  </div><!-- /.col -->
</div><!-- /.row -->


