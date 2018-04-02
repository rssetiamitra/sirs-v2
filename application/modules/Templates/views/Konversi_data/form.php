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

    $('select[name="provinceId"]').change(function () {
            if ($(this).val()) {
                $.getJSON("<?php echo site_url('Templates/References/getRegencyByProvince') ?>/" + $(this).val(), '', function (data) {
                    $('#regencyId option').remove();
                    $('<option value="">-Silahkan Pilih-</option>').appendTo($('#regencyId'));
                    $.each(data, function (i, o) {
                        $('<option value="' + o.id + '">' + o.name + '</option>').appendTo($('#regencyId'));
                    });

                });
            } else {
                $('#regencyId option').remove()
            }
        });

        $('select[name="regencyId"]').change(function () {
            if ($(this).val()) {
                $.getJSON("<?php echo site_url('Templates/References/getDistrictByRegency') ?>/" + $(this).val(), '', function (data) {
                    $('#districtId option').remove();
                    $('<option value="">-Silahkan Pilih-</option>').appendTo($('#districtId'));
                    $.each(data, function (i, o) {
                        $('<option value="' + o.id + '">' + o.name + '</option>').appendTo($('#districtId'));
                    });

                });
            } else {
                $('#districtId option').remove()
            }
        });

        $('select[name="districtId"]').change(function () {
            if ($(this).val()) {
                $.getJSON("<?php echo site_url('Templates/References/getVillagesByDistrict') ?>/" + $(this).val(), '', function (data) {
                    $('#villageId option').remove();
                    $('<option value="">-Silahkan Pilih-</option>').appendTo($('#villageId'));
                    $.each(data, function (i, o) {
                        $('<option value="' + o.id + '">' + o.name + '</option>').appendTo($('#villageId'));
                    });

                });
            } else {
                $('#villageId option').remove()
            }
        });

})

function hapus_file(a, b)

{

  if(b != 0){
    $.getJSON("<?php echo base_url('posting/delete_file') ?>/" + b, '', function(data) {
        document.getElementById("file"+a).innerHTML = "";
        greatComplate(data);
    });
  }else{
    y = a ;
    document.getElementById("file"+a).innerHTML = "";
  }

}

counterfile = <?php $j=1;echo $j.";";?>

function tambah_file()

{

counternextfile = counterfile + 1;

counterIdfile = counterfile + 1;

document.getElementById("input_file"+counterfile).innerHTML = "<div id=\"file"+counternextfile+"\"><div class='form-group'><label class='control-label col-md-2'>&nbsp;</label><div class='col-md-2'><input type='text' name='pf_file_name[]' id='pf_file_name' class='form-control'></div><label class='control-label col-md-1'>File</label><div class='col-md-3'><input type='file' id='pf_file' name='pf_file[]' class='upload_file form-control' /></div><div class='col-md-1'><input type='button' onclick='hapus_file("+counternextfile+",0)' value='x' class='btn btn-sm btn-danger'/></div></div></div><div id=\"input_file"+counternextfile+"\"></div>";

counterfile++;

}

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
              <form class="form-horizontal" method="post" id="form_konversi_data" action="<?php echo site_url('Templates/konversi_data/process')?>" enctype="multipart/form-data">
                <br>

                <div class="form-group">
                  <label class="control-label col-md-2">ID</label>
                  <div class="col-md-1">
                    <input name="id" id="id" value="<?php echo isset($value)?$value->pgd_id:0?>" placeholder="Auto" class="form-control" type="text" readonly>
                  </div>
                  <label class="control-label col-md-2">Tanggal Pengaduan</label>
                    <div class="col-md-2">
                      <div class="input-group">
                        <input class="form-control date-picker" name="pgd_tanggal" id="pgd_tanggal" type="text" data-date-format="yyyy-mm-dd" value="<?php echo isset($value)?$value->pgd_tanggal:date('Y-m-d')?>"/>
                        <span class="input-group-addon">
                          <i class="fa fa-calendar bigger-110"></i>
                        </span>
                      </div>
                    </div>

                </div>

                <div class="form-group">
                  <label class="control-label col-md-2">Kategori Pemilu</label>
                  <div class="col-md-4">
                    <?php echo $this->master->custom_selection(array('table'=>'mst_kategori_pemilu', 'where'=>array('is_active'=>'Y'), 'id'=>'kp_id', 'name'=>'kp_name'), isset($value->kp_id)?$value->kp_id:'','kp_id','kp_id', 'chosen-select form-control','','inline')?>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Tipe Pengaduan</label>
                  <div class="col-md-6">
                    <?php echo $this->master->custom_selection(array('table'=>'mst_tipe_pengaduan', 'where'=>array('is_active'=>'Y'), 'id'=>'tp_id', 'name'=>'tp_name'), isset($value->tp_id)?$value->tp_id:'','tp_id','tp_id', 'chosen-select form-control','','inline')?>
                  </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="Province">*Provinsi</label>
                    <div class="col-sm-3">
                        <?php echo $this->master->custom_selection($params = array('table' => 'provinces', 'id' => 'id', 'name' => 'name', 'where' => array()), isset($value)?$value->province_id:'' , 'provinceId', 'provinceId', 'form-control', '', '') ?>
                        <?php echo form_error('Province') ?>
                    </div>
                    <label class="control-label col-sm-1" for="City">*Kota/Kab</label>
                    <div class="col-sm-3">
                        <?php echo $this->master->get_change($params = array('table' => 'regencies', 'id' => 'id', 'name' => 'name', 'where' => array()), isset($value)?$value->city_id:'' , 'regencyId', 'regencyId', 'form-control', '', '') ?>
                        <?php echo form_error('City') ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="District">*Kecamatan</label>
                    <div class="col-sm-3">
                        <?php echo $this->master->get_change($params = array('table' => 'districts', 'id' => 'id', 'name' => 'name', 'where' => array()), isset($value)?$value->district_id:'' , 'districtId', 'districtId', 'form-control', '', '') ?>
                        <?php echo form_error('District') ?>
                    </div>
                    <label class="control-label col-sm-1" for="District">*Kelurahan</label>
                    <div class="col-sm-3">
                        <?php echo $this->master->get_change($params = array('table' => 'villages', 'id' => 'id', 'name' => 'name', 'where' => array()), isset($value)?$value->subdistrict_id:'' , 'villageId', 'villageId', 'form-control', '', '') ?>
                        <?php echo form_error('District') ?>
                    </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-2">Alamat/ Tempat /Keterangan Pengaduan</label>
                  <div class="col-md-6">
                    <textarea name="pgd_tempat" id="pgd_tempat" class="form-control" rows="3"><?php echo isset($value)?$value->pgd_tempat:''?></textarea>
                  </div>
                </div>

                <h3 class="header smaller lighter blue">Para Pihak Pengaduan</h3>
                
                  <div class="form-group">
                    <label class="control-label col-md-2"> Pengadu </label>
                    <div class="col-md-10">
                      <div class="span10" id="pengadu-x">
                        <div class="row-fluid" style="margin-top:3px">
                          <input name="nik_pengadu[]" id="nik_pengadu" value="" placeholder="Masukan NIK" class="" style="width:200px" type="text">
                          <input name="pengadu[]" id="pengadu" value="" placeholder="Masukan Nama Pengadu" class="" style="width:250px" type="text">
                          <?php echo $this->master->custom_selection(
                                  array('table'=>'mst_kategori_pengadu','where'=>array('is_active'=>'Y'), 'name'=>'kpd_name', 'id'=>'kpd_id'),'','kpd_id_pengadu[]','kpd_id_pengadu','select2','style="height: 34px; width: auto;"','inline');?>
                          <a href="javascript:void(0)" onclick="addPengadu(this)" style="line-height: 19px; margin-top: -2px;" class="btn btn-xs btn-info"><i class="glyphicon glyphicon-plus"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- teradu -->

                  <div class="form-group">
                    <label class="control-label col-md-2"> Teradu </label>
                    <div class="col-md-10">
                      <div class="span10" id="teradu-x">
                        <div class="row-fluid" style="margin-top:3px">
                          <input name="nik_teradu[]" id="nik_teradu" value="" placeholder="Masukan NIK" class="" style="width:200px" type="text">
                          <input name="teradu[]" id="teradu" value="" placeholder="Masukan Nama Teradu" class="" style="width:250px" type="text">
                            <?php echo $this->master->custom_selection(
                        array('table'=>'mst_penyelenggara_pemilu','where'=>array('is_active'=>'Y'), 'name'=>'pp_name', 'id'=>'pp_id'),'','pp_id_teradu[]','pp_id_teradu','select2','style="height: 34px; width: auto;"','inline');?>
                        <?php echo $this->master->custom_selection(
                        array('table'=>'mst_jabatan_penyelenggara','where'=>array('is_active'=>'Y'), 'name'=>'jbp_name', 'id'=>'jbp_id'),'','jbp_id_teradu[]','jbp_id_teradu','select2','style="height: 34px; width: auto;"','inline');?>
                            <a href="javascript:void(0)" onclick="addTeradu(this)" style="line-height: 19px; margin-top: -2px;" class="btn btn-xs btn-info"><i class="glyphicon glyphicon-plus"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- kuasa -->
                  <div class="form-group">
                    <label class="control-label col-md-2"> Kuasa </label>
                    <div class="col-md-10">
                      <div class="span10" id="kuasa-x">
                        <div class="row-fluid" style="margin-top:3px">
                          <input name="nik_kuasa[]" id="nik_kuasa" value="" placeholder="Masukan NIK" class="" style="width:200px" type="text">
                          <input name="kuasa[]" id="kuasa" value="" placeholder="Masukan Nama Kuasa" class="" style="width:250px" type="text">
                          <!-- <?php echo $this->master->custom_selection(
                                  array('table'=>'mst_kategori_pengadu','where'=>array('is_active'=>'Y'), 'name'=>'kpd_name', 'id'=>'kpd_id'),'','kpd_id_pengadu[]','kpd_id_pengadu','select2','style="height: 34px; width: auto;"','inline');?> -->
                          <a href="javascript:void(0)" onclick="addKuasa(this)" style="line-height: 19px; margin-top: -2px;" class="btn btn-xs btn-info"><i class="glyphicon glyphicon-plus"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>

                <h3 class="row header smaller lighter blue">
                      <span class="col-xs-6"> <i class="fa fa-bolt"></i> Penelitian Administrasi</span>
                </h3>

                <div class="col-md-6">
                  <!-- hidden ID -->
                  <input name="pgdhpa_id" id="pgdhpa_id" value="<?php echo isset($value->pgdhpa_id)?$value->pgdhpa_id:0?>" placeholder="Auto" class="form-control" type="hidden" readonly>

                  <div class="form-group">
                    <label class="control-label col-md-4">Tanggal Penelitian Adm</label>
                      <div class="col-md-3">
                        <div class="input-group">
                          <input class="form-control date-picker" name="pgdhpa_tanggal_penelitian" id="pgdhpa_tanggal_penelitian" type="text" data-date-format="yyyy-mm-dd" value="<?php echo isset($value->pgdhpa_tanggal_penelitian)?$value->pgdhpa_tanggal_penelitian:date('Y-m-d')?>"/>
                          <span class="input-group-addon">
                            <i class="fa fa-calendar bigger-110"></i>
                          </span>
                        </div>
                      </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label col-md-4">Penerima Pengaduan</label>
                    <div class="col-md-4">
                      <?php echo $this->master->custom_selection(array('table'=>'v_pegawai', 'where'=>array('is_active'=>'Y'), 'id'=>'pg_id', 'name'=>'fullname'), isset($value->pgdhpa_penerima_pg_id)?$value->pgdhpa_penerima_pg_id:'','pgdhpa_penerima_pg_id','pgdhpa_penerima_pg_id', 'select2','','inline')?>
                    </div>
                  </div>
                </div>

                <div class="col-md-6 center" style="min-height: 263px;vertical-align:top">
                  <b>NOMOR PENGADUAN :</b>
                  <input name="pgd_no" id="pgd_no" value="<?php echo isset($value->pgd_no)?$value->pgd_no:''?>" placeholder="" class="form-control" style="height:100px;text-align:center;font-size:64px;margin-bottom:15px" type="text" >
                  Format Lengkap : 
                  <input name="pgd_format_no" id="pgd_format_no" value="<?php echo isset($value)?$value->pgd_format_no:''?>" style="text-align:center" placeholder="Masukan format no pengaduan" class="form-control" type="text" >
                  <br>

                </div>

                <div class="form-group">
                  <label class="control-label col-md-2">Pokok Pengaduan</label>
                  <div class="col-md-10">
                    <div id="editor_content" class="editor_html wysiwyg-editor"><?php echo isset($value->pgdhpa_pokok_pengaduan)?$value->pgdhpa_pokok_pengaduan:''?></div>
                    <textarea spellcheck="false" id="content" name="content" style="display:none"></textarea>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-2">Keterangan</label>
                  <div class="col-md-10">
                    <textarea id="pgdhpa_keterangan" name="pgdhpa_keterangan" class="form-control" rows="5"><?php echo isset($value->pgdhpa_keterangan)?$value->pgdhpa_keterangan:''?></textarea>
                  </div>
                </div>

                 <div class="form-group">
                    <label class="control-label col-md-2">Verifikator</label>
                    <div class="col-md-2">
                      <?php echo $this->master->custom_selection(array('table'=>'v_verifikator', 'where'=>array('is_active'=>'Y'), 'id'=>'verifikator_id', 'name'=>'fullname'), isset($value->pgdhpa_verifikator_pg_id)?$value->pgdhpa_verifikator_pg_id:'','verifikator_id','verifikator_id', 'select2','','inline')?>
                    </div>
                    <label class="control-label col-md-3">Kesimpulan Hasil Penelitian Administrasi</label>
                    <div class="col-md-4">
                      <?php echo $this->master->custom_selection(array('table'=>'mst_penelitian_status', 'where'=>array('is_active'=>'Y'), 'id'=>'ps_id', 'name'=>'ps_name'), isset($value->pgdhpa_kesimpulan)?$value->pgdhpa_kesimpulan:'','pgdhpa_kesimpulan','pgdhpa_kesimpulan', 'select2','','inline')?>
                    </div>
                  </div>

                <h3 class="row header smaller lighter blue">
                    <span class="col-xs-6"> <i class="fa fa-bolt"></i> Pengkajian Berkas </span>
                </h3>

                <input name="pgdpkj_id" id="pgdpkj_id" value="<?php echo isset($value->pgdpkj_id)?$value->pgdpkj_id:0?>" placeholder="Auto" class="form-control" type="hidden" readonly>

                <div class="form-group">
                    <label class="control-label col-md-2">Tanggal Pengkajian</label>
                    <div class="col-md-2">
                      <div class="input-group">
                        <input class="form-control date-picker" name="pgdpkj_tanggal" id="pgdpkj_tanggal" type="text" data-date-format="yyyy-mm-dd" value="<?php echo isset($value->pgdpkj_tanggal)?$value->pgdpkj_tanggal:date('Y-m-d')?>"/>
                        <span class="input-group-addon">
                          <i class="fa fa-calendar bigger-110"></i>
                        </span>
                      </div>
                    </div>
                </div>
                  
                <div class="form-group">
                  <label class="control-label col-md-2">Pengkaji</label>
                  <div class="col-md-3">
                    <?php echo $this->master->custom_selection(array('table'=>'v_pengkaji', 'where'=>array('is_active'=>'Y'), 'id'=>'pengkaji_id', 'name'=>'fullname'), isset($value->pengkaji_id)?$value->pengkaji_id:'','pengkaji_id','pengkaji_id', 'select2','','inline')?>
                  </div>
                  <label class="control-label col-md-1">Rekomendasi</label>
                  <div class="col-md-3">
                    <?php echo $this->master->custom_selection(array('table'=>'mst_status_verifikasi', 'where'=>array('is_active'=>'Y'), 'id'=>'sv_id', 'name'=>'sv_name'), isset($value->sv_id)?$value->sv_id:'','sv_id','sv_id', 'select2','','inline')?>
                  </div>
                </div>
                  
                <div class="form-group">
                  <label class="control-label col-md-2">Pokok Perkara</label>
                  <div class="col-md-10">
                    <div id="editor_pokok_perkara" class="editor_html wysiwyg-editor"><?php echo isset($value->pgdpkj_pokok_perkara)?$value->pgdpkj_pokok_perkara:''?></div>
                    <textarea spellcheck="false" id="pokok_perkara" name="pokok_perkara" style="display:none"></textarea>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-2">Keterangan</label>
                  <div class="col-md-10">
                    <textarea id="pgdpkj_keterangan" name="pgdpkj_keterangan" class="form-control" rows="5"><?php echo isset($value->pgdpkj_keterangan)?$value->pgdpkj_keterangan:''?></textarea>
                  </div>
                </div>

                <h3 class="row header smaller lighter blue">
                      <span class="col-xs-6"> <i class="fa fa-bolt"></i> Verifikasi Materiil </span>
                  </h3>

                  <input name="phv_id" id="phv_id" value="<?php echo isset($value->phv_id)?$value->phv_id:0?>" placeholder="Auto" class="form-control" type="hidden" readonly>

                  <div class="form-group">
                    <label class="control-label col-md-2">Dugaan Pelanggaran Asas/Modus</label>
                    <div class="col-md-6">
                      <?php echo $this->master->custom_selection(array('table'=>'mst_jenis_pelanggaran', 'where'=>array('is_active'=>'Y'), 'id'=>'jp_id', 'name'=>'jp_name'), isset($value->phv_modus)?$value->phv_modus:'','phv_modus','phv_modus', 'select2','','inline')?>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-2">Hasil Verifikasi Materil</label>
                    <div class="col-md-2">
                      <?php echo $this->master->custom_selection(array('table'=>'mst_status_verifikasi', 'where'=>array('is_active'=>'Y'), 'id'=>'sv_id', 'name'=>'sv_name'), isset($value->phv_hasil_vermat)?$value->phv_hasil_vermat:'','phv_hasil_vermat','phv_hasil_vermat', 'select2','','inline')?>
                    </div>

                    <label class="control-label col-md-1">Tanggal</label>
                      <div class="col-md-2">
                        <div class="input-group">
                          <input class="form-control date-picker" name="phv_tanggal" id="phv_tanggal" type="text" data-date-format="yyyy-mm-dd" value="<?php echo isset($value->phv_tanggal)?$value->phv_tanggal:date('Y-m-d')?>"/>
                          <span class="input-group-addon">
                            <i class="fa fa-calendar bigger-110"></i>
                          </span>
                        </div>
                      </div>

                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-2">Tindak Lanjut Vermat</label>
                      <div class="col-md-4">
                        <input name="phv_tindak_lanjut" id="phv_tindak_lanjut" value="<?php echo isset($value->phv_tindak_lanjut)?$value->phv_tindak_lanjut:''?>" class="form-control" type="text">
                      </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-2">Keterangan</label>
                      <div class="col-md-6">
                        <textarea name="phv_keterangan" id="phv_keterangan" class="form-control" rows="5"><?php echo isset($value->phv_keterangan)?$value->phv_keterangan:''?></textarea>
                      </div>
                  </div>


                <div class="form-actions center">

                  <a onclick="getMenu('Templates/konversi_data')" href="#" class="btn btn-sm btn-success">
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


<!-- page specific plugin scripts -->
<script src="<?php echo base_url()?>assets/js/jquery.colorbox.js"></script>

<script src="<?php echo base_url()?>/assets/js/jquery-ui.custom.js"></script>
<script src="<?php echo base_url()?>/assets/js/jquery.ui.touch-punch.js"></script>
<script src="<?php echo base_url()?>/assets/js/markdown/markdown.js"></script>
<script src="<?php echo base_url()?>/assets/js/markdown/bootstrap-markdown.js"></script>
<script src="<?php echo base_url()?>/assets/js/jquery.hotkeys.js"></script>
<script src="<?php echo base_url()?>/assets/js/bootstrap-wysiwyg.js"></script>
<script src="<?php echo base_url()?>/assets/js/bootbox.js"></script>

<script type="text/javascript">

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

jQuery(function($) {
  var $overflow = '';
  var colorbox_params = {
    rel: 'colorbox',
    reposition:true,
    scalePhotos:true,
    scrolling:false,
    previous:'<i class="ace-icon fa fa-arrow-left"></i>',
    next:'<i class="ace-icon fa fa-arrow-right"></i>',
    close:'&times;',
    current:'{current} of {total}',
    maxWidth:'100%',
    maxHeight:'100%',
    onOpen:function(){
      $overflow = document.body.style.overflow;
      document.body.style.overflow = 'hidden';
    },
    onClosed:function(){
      document.body.style.overflow = $overflow;
    },
    onComplete:function(){
      $.colorbox.resize();
    }
  };

  $('.ace-thumbnails [data-rel="colorbox"]').colorbox(colorbox_params);
  $("#cboxLoadingGraphic").html("<i class='ace-icon fa fa-spinner orange fa-spin'></i>");//let's add a custom loading icon
  
  
  $(document).one('ajaxloadstart.page', function(e) {
    $('#colorbox, #cboxOverlay').remove();
   });
})

jQuery(function($) {
  $('.editor_html').ace_wysiwyg({
    toolbar:
    [
      {
        name:'font',
        title:'Custom tooltip',
        values:['Some Font!','Arial','Verdana','Comic Sans MS','Custom Font!']
      },
      null,
      {
        name:'fontSize',
        title:'Custom tooltip',
        values:{1 : 'Size#1 Text' , 2 : 'Size#1 Text' , 3 : 'Size#3 Text' , 4 : 'Size#4 Text' , 5 : 'Size#5 Text'} 
      },
      null,
      {name:'bold', title:'Custom tooltip'},
      {name:'italic', title:'Custom tooltip'},
      {name:'strikethrough', title:'Custom tooltip'},
      {name:'underline', title:'Custom tooltip'},
      null,
      'insertunorderedlist',
      'insertorderedlist',
      'outdent',
      'indent',
      null,
      {name:'justifyleft'},
      {name:'justifycenter'},
      {name:'justifyright'},
      {name:'justifyfull'},
      null,
      {
        name:'createLink',
        placeholder:'Custom PlaceHolder Text',
        button_class:'btn-purple',
        button_text:'Custom TEXT'
      },
      {name:'unlink'},
      null,
      {
        name:'insertImage',
        placeholder:'Custom PlaceHolder Text',
        button_class:'btn-inverse',
        //choose_file:false,//hide choose file button
        button_text:'Set choose_file:false to hide this',
        button_insert_class:'btn-pink',
        button_insert:'Insert Image'
      },
      null,
      {
        name:'foreColor',
        title:'Custom Colors',
        values:['red','green','blue','navy','orange'],
        /**
          You change colors as well
        */
      },
      /**null,
      {
        name:'backColor'
      },*/
      null,
      {name:'undo'},
      {name:'redo'},
      null,
      'viewSource'
    ],
    //speech_button:false,//hide speech button on chrome
    
    'wysiwyg': {
      hotKeys : {} //disable hotkeys
    }
    
  }).prev().addClass('wysiwyg-style2');

  
  
  //handle form onsubmit event to send the wysiwyg's content to server
  $('#form_konversi_data').on('submit', function(){
    
    //put the editor's html content inside the hidden input to be sent to server
    
    $('#content').val($('#editor_content').html());
    $('#pokok_perkara ').val($('#editor_pokok_perkara').html());

    var formData = new FormData($('#form_konversi_data')[0]);
    /*formData.append('content', $('input[name=wysiwyg-value]' , this).val($('.editor_html').html()) ); */
    pf_file_name = new Array();
    pf_file = new Array();

     var formData = new FormData($('#form_konversi_data')[0]);
     


    url = $('#form_konversi_data').attr('action');
     var pgd_id = $('#pgd_id').val();
       // ajax adding data to database
          $.ajax({
            url : url,
            type: "POST",
            data: formData,
            dataType: "JSON",
            contentType: false,
            processData: false,
            
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
                $('#page-area-content').load('Templates/konversi_data/form');
              }else{
                $.achtung({message: jsonResponse.message, timeout:5});
              }
              achtungHideLoader();
              
            }
        });

    //but for now we will show it inside a modal box

    /*$('#modal-wysiwyg-editor').modal('show');
    $('#wysiwyg-editor-value').css({'width':'99%', 'height':'200px'}).val($('.editor_html').html());*/
    
    return false;
  });
  $('#form_konversi_data').on('reset', function() {
    $('.editor_html').empty();
  });
});

function addPengadu(t) {
    var rs = '<div class="row-fluid" style="margin-top:3px">' +
                '<?php 
                    echo '<input name="nik_pengadu[]" id="nik_pengadu" value="" placeholder="Masukan NIK" class="" style="width:200px" type="text"> ';
                    echo '<input name="pengadu[]" id="pengadu" value="" placeholder="Masukan Nama Pengadu" class="" style="width:250px" type="text"> ';
                    echo trim(preg_replace('/\r\n|\r|\n/', ' ', $this->master->custom_selection(
                        array('table'=>'mst_kategori_pengadu','where'=>array('is_active'=>'Y'), 'name'=>'kpd_name', 'id'=>'kpd_id'), '' ,'kpd_id_pengadu[]','kpd_id_pengadu','span12','style="height: 34px; margin-right:3px; width: auto;"','inline')));?>'+
                '<a href="javascript:void(0)" onclick="minBase(this)" style="line-height: 19px; margin-top: -2px;" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-remove"></i></a>'+
            '</div>';
    $('#pengadu-x').append(rs);
}

function addTeradu(t) {
    var rs = '<div class="row-fluid" style="margin-top:3px">' +
                '<?php 
                     echo '<input name="nik_teradu[]" id="nik_teradu" value="" placeholder="Masukan NIK" class="" style="width:200px" type="text"> ';
                    echo '<input name="teradu[]" id="teradu" value="" placeholder="Masukan Nama Teradu" class="" style="width:250px" type="text"> ';
                    echo trim(preg_replace('/\r\n|\r|\n/', ' ', $this->master->custom_selection(
                        array('table'=>'mst_penyelenggara_pemilu','where'=>array('is_active'=>'Y'), 'name'=>'pp_name', 'id'=>'pp_id'), '' ,'pp_id_teradu[]','pp_id_teradu','span12','style="height: 34px; margin-right:3px; width: auto;"','inline')));
                    echo trim(preg_replace('/\r\n|\r|\n/', ' ', $this->master->custom_selection(
                        array('table'=>'mst_jabatan_penyelenggara','where'=>array('is_active'=>'Y'), 'name'=>'jbp_name', 'id'=>'jbp_id'), '' ,'jbp_id_teradu[]','jbp_id_teradu','span12','style="height: 34px; margin-right:3px; width: auto;"','inline')));?>'+
                '<a href="javascript:void(0)" onclick="minBase(this)" style="line-height: 19px; margin-top: -2px;" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-remove"></i></a>'+
            '</div>';
    $('#teradu-x').append(rs);
}

function addKuasa(t) {
    var rs = '<div class="row-fluid" style="margin-top:3px">' +
                '<?php 
                    echo '<input name="nik_kuasa[]" id="nik_kuasa" value="" placeholder="Masukan NIK" class="" style="width:200px" type="text"> ';
                    echo '<input name="kuasa[]" id="kuasa" value="" placeholder="Masukan Nama Kuasa" class="" style="width:250px" type="text"> ';
                    //echo trim(preg_replace('/\r\n|\r|\n/', ' ', $this->master->custom_selection(
                        //array('table'=>'mst_kategori_kuasa','where'=>array('is_active'=>'Y'), 'name'=>'kpd_name', 'id'=>'kpd_id'), '' ,'kpd_id_pengadu[]','kpd_id_pengadu','span12','style="height: 34px; margin-right:3px; width: auto;"','inline')));?>'+
                '<a href="javascript:void(0)" onclick="minBase(this)" style="line-height: 19px; margin-top: -2px;" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-remove"></i></a>'+
            '</div>';
    $('#kuasa-x').append(rs);
}

function minBase(t) {
    $(t).parent().remove();
}

</script>



