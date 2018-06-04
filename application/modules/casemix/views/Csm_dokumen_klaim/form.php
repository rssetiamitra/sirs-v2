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
  
    $('#form_Hdesk_contact').ajaxForm({
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
          $('#page-area-content').load('help_desk/Hdesk_contact/form?_=' + (new Date()).getTime());
          $('#form_Hdesk_contact').reset();
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
              <form class="form-horizontal" method="post" id="form_Hdesk_contact" action="<?php echo site_url('help_desk/Hdesk_contact/process')?>" enctype="multipart/form-data">
                <br>
                <div class="form-group">
                  <label class="control-label col-md-2">ID</label>
                  <div class="col-md-1">
                    <input name="id" id="id" value="<?php echo isset($value)?$value->hpdesk_contact_id:0?>" placeholder="Auto" class="form-control" type="text" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Nama</label>
                  <div class="col-md-2">
                    <input name="hpdesk_contact_name" id="hpdesk_contact_name" value="<?php echo isset($value)?$value->hpdesk_contact_name:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Alamat</label>
                  <div class="col-md-4">
                    <input name="hpdesk_contact_address" id="hpdesk_contact_address" value="<?php echo isset($value)?$value->hpdesk_contact_address:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">No Telp Rumah</label>
                  <div class="col-md-2">
                    <input name="hpdesk_contact_home" id="hpdesk_contact_home" value="<?php echo isset($value)?$value->hpdesk_contact_home:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">No HP 1</label>
                  <div class="col-md-2">
                    <input name="hpdesk_contact_hp_1" id="hpdesk_contact_hp_1" value="<?php echo isset($value)?$value->hpdesk_contact_hp_1:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">No HP 2</label>
                  <div class="col-md-2">
                    <input name="hpdesk_contact_hp_2" id="hpdesk_contact_hp_2" value="<?php echo isset($value)?$value->hpdesk_contact_hp_2:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">No HP 3</label>
                  <div class="col-md-2">
                    <input name="hpdesk_contact_hp_3" id="hpdesk_contact_hp_3" value="<?php echo isset($value)?$value->hpdesk_contact_hp_3:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Keterangan</label>
                  <div class="col-md-4">
                  <textarea name="hpdesk_contact_note" class="form-control" <?php echo ($flag=='read')?'readonly':''?> style="height:70px !important"><?php echo isset($value)?$value->hpdesk_contact_note:''?></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Flag</label>
                  <div class="col-md-2">
                  <select name="flag" class="form-control">
                    <option value="">-Silahkan Pilih-</option>
                    <option value="dr">Kontak Dokter</option>
                    <option value="comp">Kontak Perusahaan</option>
                    <option value="etc">Lainnya</option>
                  </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Is active?</label>
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
                      by : <i class="fa fa-user"></i> <?php echo isset($value->updated_by)?$value->updated_by:isset($value->created_by)?$value->created_by:$this->session->userdata('user')->username?>
                    </b>
                  </div>
                </div>


                <div class="form-actions center">

                  <!-- <a onclick="getMenu('help_desk/Hdesk_contact')" href="#" class="btn btn-sm btn-success">
                    <i class="ace-icon fa fa-arrow-left icon-on-right bigger-110"></i>
                    Kembali ke daftar
                  </a> -->
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


