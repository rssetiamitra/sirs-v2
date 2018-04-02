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
              <div class="col-sm-12">
                <!-- #section:elements.tab.option -->
                <div class="tabbable">
                  <ul class="nav nav-tabs padding-12 tab-color-blue background-blue" id="myTab4">
                    <li class="active">
                      <a data-toggle="tab" href="#identitas_diri">Identitas Diri</a>
                    </li>

                    <li>
                      <a data-toggle="tab" href="#kepegawaian">Data Kepegawaian</a>
                    </li>

                    <li>
                      <a data-toggle="tab" href="#pendidikan">Riwayat Pendidikan</a>
                    </li>

                    <li>
                      <a data-toggle="tab" href="#sertifikasi">Sertifikasi/Keahlian</a>
                    </li>

                    <li>
                      <a data-toggle="tab" href="#pengalaman_kerja">Pengalaman Kerja</a>
                    </li>

                    <li>
                      <a data-toggle="tab" href="#pengalaman_org">Pengalaman Organisasi</a>
                    </li>

                    <li>
                      <a data-toggle="tab" href="#data_keluarga">Data Keluarga</a>
                    </li>

                  </ul>

                  <div class="tab-content">

                    <div id="identitas_diri" class="tab-pane in active">
                      <p>
                        <form class="form-horizontal" method="post" id="form_tr_pegawai" action="<?php echo site_url('kepegawaian/tr_pegawai/process')?>" enctype="multipart/form-data">
                          <br>

                              <div class="col-md-9">

                                <div class="form-group">
                                  <label class="control-label col-md-3">ID KTP</label>
                                  <div class="col-md-2">
                                    <input name="ktp_id" id="ktp_id" value="<?php echo isset($value)?$value->ktp_id:0?>" placeholder="Auto" class="form-control" type="text" readonly>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-md-3">Foto Profil</label>
                                  <div class="col-md-3">
                                    <input name="file" id="file" value="<?php echo isset($value)?$value->photo:''?>" placeholder="" class="form-control" type="file" <?php echo ($flag=='read')?'readonly':''?>>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-md-3">Nama Lengkap</label>
                                  <div class="col-md-6">
                                    <input name="ktp_nama_lengkap" id="ktp_nama_lengkap" value="<?php echo isset($value)?$value->ktp_nama_lengkap:''?>" placeholder="" class="form-control" type="text">
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-md-3">No.KTP</label>
                                  <div class="col-md-3">
                                    <input name="ktp_nik" id="ktp_nik" value="<?php echo isset($value)?$value->ktp_nik:''?>" placeholder="" class="form-control" type="text">
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-md-3">Tempat Lahir</label>
                                  <div class="col-md-2">
                                    <input name="ktp_tempat_lahir" id="ktp_tempat_lahir" value="<?php echo isset($value)?$value->ktp_tempat_lahir:''?>" placeholder="" class="form-control" type="text">
                                  </div>
                                  <label class="control-label col-md-2">Tanggal Lahir</label>
                                    <div class="col-md-3">
                                      <div class="input-group">
                                        <input class="form-control date-picker" name="ktp_tanggal_lahir" id="ktp_tanggal_lahir" type="text" data-date-format="yyyy-mm-dd" value="<?php echo isset($value->ktp_tanggal_lahir)?$value->ktp_tanggal_lahir:date('Y-m-d')?>"/>
                                        <span class="input-group-addon">
                                          <i class="fa fa-calendar bigger-110"></i>
                                        </span>
                                      </div>

                                      <!-- <input type="text" name="tgl_lulus" id="tgl_lulus" class="form-control"> -->
                                    </div>
                                </div>

                              </div>

                              <div class="col-md-3">
                                <div>
                                    <!-- #section:pages/profile.picture -->
                                    <span class="profile-picture">
                                        <img id="profil" class="editable img-responsive" alt="<?php echo isset($value)?$value->ktp_nama_lengkap:'Profil Photo'?>" src="<?php echo isset($value) ? ($value->profil_path) ? base_url().$value->profil_path : base_url().'assets/avatars/profile-pic.jpg' : base_url().'assets/avatars/profile-pic.jpg' ?>" />
                                    </span>
                                </div>

                              </div>
                              
                              <div class="col-md-12">
                                
                                <div class="form-group">
                                  <label class="control-label col-md-2">Jenis Kelamin</label>
                                  <div class="col-md-9">
                                    <div class="radio">
                                          <label>
                                            <input name="ktp_jk" type="radio" class="ace" value="L" <?php echo isset($value) ? ($value->ktp_jk == 'L') ? 'checked="checked"' : '' : 'checked="checked"'; ?>  />
                                            <span class="lbl"> Laki-laki</span>
                                          </label>
                                          <label>
                                            <input name="ktp_jk" type="radio" class="ace" value="P" <?php echo isset($value) ? ($value->ktp_jk == 'P') ? 'checked="checked"' : '' : ''; ?>/>
                                            <span class="lbl">Perempuan</span>
                                          </label>
                                    </div>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-md-2">Alamat</label>
                                  <div class="col-md-6">
                                    <input name="ktp_alamat" id="ktp_alamat" value="<?php echo isset($value)?strip_tags($value->ktp_alamat):''?>" placeholder="" class="form-control" type="text">
                                  </div>
                                </div>
                                
                                <div class="form-group">
                                  <label class="control-label col-md-2">RT</label>
                                  <div class="col-md-1">
                                    <input name="ktp_rt" id="ktp_rt" value="<?php echo isset($value)?$value->ktp_rt:''?>" placeholder="" class="form-control" type="text">
                                  </div>
                                  <label class="control-label col-md-1">RW</label>
                                  <div class="col-md-1">
                                    <input name="ktp_rw" id="ktp_rw" value="<?php echo isset($value)?$value->ktp_rw:''?>" placeholder="" class="form-control" type="text">
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
                                      <?php echo $this->master->get_change($params = array('table' => 'villages', 'id' => 'id', 'name' => 'name', 'where' => array()), isset($value)?$value->sub_district_id:'' , 'villageId', 'villageId', 'form-control', '', '') ?>
                                      <?php echo form_error('District') ?>
                                  </div>
                              </div>
                                
                                <div class="form-group">
                                  <label class="control-label col-md-2">Status Marital</label>
                                  <div class="col-md-2">
                                    <?php echo $this->master->custom_selection(array('table'=>'mst_marital_status', 'where'=>array('is_active'=>'Y'), 'id'=>'ms_id', 'name'=>'ms_name'), isset($value->ms_id)?$value->ms_id:'','ms_id','ms_id', 'form-control','','inline')?>
                                  </div>
                                  <label class="control-label col-md-1">Agama</label>
                                  <div class="col-md-2">
                                    <?php echo $this->master->custom_selection(array('table'=>'mst_religion', 'where'=>array('is_active'=>'Y'), 'id'=>'religion_id', 'name'=>'religion_name'), isset($value->religion_id)?$value->religion_id:'','religion_id','religion_id', 'form-control','','inline')?>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-md-2">Pekerjaan</label>
                                  <div class="col-md-2">
                                    <?php echo $this->master->custom_selection(array('table'=>'mst_job', 'where'=>array('is_active'=>'Y'), 'id'=>'job_id', 'name'=>'job_name'), isset($value->job_id)?$value->job_id:'','job_id','job_id', 'form-control','','inline')?>
                                  </div>
                                  <label class="control-label col-md-1">Gol.Darah</label>
                                  <div class="col-md-2">
                                    <?php echo $this->master->custom_selection(array('table'=>'mst_type_blood', 'where'=>array('is_active'=>'Y'), 'id'=>'tb_id', 'name'=>'tb_name'), isset($value->tb_id)?$value->tb_id:'','tb_id','tb_id', 'form-control','','inline')?>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-md-2">Kewarganegaraan</label>
                                  <div class="col-md-9">
                                    <div class="radio">
                                          <label>
                                            <input name="ktp_kewarganegaraan" type="radio" class="ace" value="WNI" <?php echo isset($value) ? ($value->ktp_kewarganegaraan == 'WNI') ? 'checked="checked"' : '' : 'checked="checked"'; ?>  />
                                            <span class="lbl"> WNI</span>
                                          </label>
                                          <label>
                                            <input name="ktp_kewarganegaraan" type="radio" class="ace" value="WNA" <?php echo isset($value) ? ($value->ktp_kewarganegaraan == 'WNA') ? 'checked="checked"' : '' : ''; ?>/>
                                            <span class="lbl">WNA</span>
                                          </label>
                                    </div>
                                  </div>
                                </div>

                              </div>
                              &nbsp;
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
                      </p>
                    </div>

                    <div id="kepegawaian" class="tab-pane">
                      <p>
                        <form class="form-horizontal" method="post" id="form_tr_pegawai" action="<?php echo site_url('kepegawaian/tr_pegawai/process')?>" enctype="multipart/form-data">
                          <br>
                              <div class="form-group">
                                <label class="control-label col-md-2">NIP</label>
                                <div class="col-md-1">
                                  <input name="id" id="id" value="<?php echo isset($value)?$value->pg_id:0?>" placeholder="Auto" class="form-control" type="hidden" readonly>
                                  <input name="nip" id="nip" value="<?php echo isset($value)?$value->nip:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
                                </div>
                              </div>

                              <!-- <div class="form-group">
                                <label class="control-label col-md-2">Nama Lengkap</label>
                                <div class="col-md-4">
                                  <input name="fullname" id="fullname" value="<?php echo isset($value)?$value->fullname:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
                                </div>
                              </div> -->
                          
                              <div class="form-group">
                                <label class="control-label col-md-2">Email</label>
                                <div class="col-md-2">
                                  <input name="email" id="email" value="<?php echo isset($value)?$value->email:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="control-label col-md-2">No Telp/Hp</label>
                                <div class="col-md-2">
                                  <input name="no_telp" id="no_telp" value="<?php echo isset($value)?$value->no_telp:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
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
                            <label class="control-label col-md-2">Pegawai Aktif?</label>
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
                      </p>
                    </div>

                    <div id="pendidikan" class="tab-pane">
                      <p>
                        <form class="form-horizontal" method="post" id="form_tr_pegawai" action="<?php echo site_url('kepegawaian/tr_pegawai/process')?>" enctype="multipart/form-data">
                          <br>
                            <div class="form-group">
                              <label class="control-label col-md-2">Jenjang Pendidikan</label>
                              <div class="col-md-2">
                                <?php echo $this->master->custom_selection(array('table'=>'mst_education', 'where'=>array('is_active'=>'Y'), 'id'=>'education_id', 'name' => 'education_name'),isset($value)?$value->education_id:'','education_id','education_id','chosen-slect form-control',($flag=='read')?'readonly':'','');?>
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="control-label col-md-2">Tempat Pendidikan</label>
                              <div class="col-md-2">
                                <input name="email" id="email" value="<?php echo isset($value)?$value->email:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
                              </div>
                              <label class="control-label col-md-2">Tahun Masuk</label>
                              <div class="col-md-1">
                                <input name="no_telp" id="no_telp" value="<?php echo isset($value)?$value->no_telp:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
                              </div>
                              <label class="control-label col-md-1">Lulus</label>
                              <div class="col-md-1">
                                <input name="no_telp" id="no_telp" value="<?php echo isset($value)?$value->no_telp:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
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
                            <label class="control-label col-md-2">Fakultas/Jurusan</label>
                              <div class="col-md-5">
                                <input name="email" id="email" value="<?php echo isset($value)?$value->email:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-2">Status Kelulusan</label>
                              <div class="col-md-2">
                                <select name="status_lulus" class="form-control">
                                  <option>-Silahkan Pilih-</option>
                                  <option>Lulus</option>
                                  <option>Tidak Lulus</option>
                                  <option>Sedang Berlangsung</option>
                                </select>
                              </div>
                              <label class="control-label col-md-1">Nilai Akhir</label>
                              <div class="col-md-1">
                                <input name="email" id="email" value="<?php echo isset($value)?$value->email:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
                              </div>
                              <label class="control-label col-md-1">Grade</label>
                              <div class="col-md-1">
                                <input name="email" id="email" value="<?php echo isset($value)?$value->email:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-2">Ijazah</label>
                              <div class="col-md-2">
                                <input name="email" id="email" value="<?php echo isset($value)?$value->email:''?>" placeholder="" class="form-control" type="file" <?php echo ($flag=='read')?'readonly':''?> >
                              </div>
                              <label class="control-label col-md-1">Transkrip</label>
                              <div class="col-md-2">
                                <input name="email" id="email" value="<?php echo isset($value)?$value->email:''?>" placeholder="" class="form-control" type="file" <?php echo ($flag=='read')?'readonly':''?> >
                              </div>
                              <div class="col-md-1">
                                  <button type="submit" id="btnSave" name="submit" class="btn btn-minier btn-primary">
                                  <i class="ace-icon fa fa-plus icon-on-right bigger-110"></i>
                                  Tambahkan
                                </button>
                              </div>
                            </div>
                        </form>
                        <br>
                        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                           <thead>
                            <tr>  
                              <th class="center" style="max-width:30px;background-color:#428bca;color:white"></th>
                              <th style="background-color:#428bca;color:white">ID</th>
                              <th style="background-color:#428bca;color:white">Jenjang Pendidikan</th>
                              <th style="background-color:#428bca;color:white">Nama Sekolah/ Universitas/ Perguruan Tinggi</th>
                              <th style="background-color:#428bca;color:white">Tahun</th>
                              <th style="background-color:#428bca;color:white">Provinsi / Kab/Kota</th>
                              <th style="background-color:#428bca;color:white">Status</th>
                              <th style="min-width:110px;background-color:#428bca;color:white">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>

                      </p>
                    </div>

                    <div id="sertifikasi" class="tab-pane">
                      <p>
                        <form class="form-horizontal" method="post" id="form_tr_pegawai" action="<?php echo site_url('kepegawaian/tr_pegawai/process')?>" enctype="multipart/form-data">
                          <br>
                            <div class="form-group">
                              <label class="control-label col-md-2">Nama Sertifikasi</label>
                              <div class="col-md-2">
                                <input name="email" id="email" value="<?php echo isset($value)?$value->email:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
                              </div>
                              <label class="control-label col-md-1">Tahun</label>
                              <div class="col-md-1">
                                <input name="no_telp" id="no_telp" value="<?php echo isset($value)?$value->no_telp:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
                              </div>
                              <label class="control-label col-md-1">s.d</label>
                              <div class="col-md-1">
                                <input name="no_telp" id="no_telp" value="<?php echo isset($value)?$value->no_telp:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-2">Penyelenggara</label>
                              <div class="col-md-2">
                                <input name="email" id="email" value="<?php echo isset($value)?$value->email:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
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
                              <label class="control-label col-md-2">Upload Sertifikat</label>
                              <div class="col-md-2">
                                <input name="email" id="email" value="<?php echo isset($value)?$value->email:''?>" placeholder="" class="form-control" type="file" <?php echo ($flag=='read')?'readonly':''?> >
                              </div>
                              <div class="col-md-1">
                                  <button type="submit" id="btnSave" name="submit" class="btn btn-minier btn-primary">
                                  <i class="ace-icon fa fa-plus icon-on-right bigger-110"></i>
                                  Tambahkan
                                </button>
                              </div>
                            </div>
                        </form>
                        <br>
                        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                           <thead>
                            <tr>  
                              <th class="center" style="max-width:30px;background-color:#428bca;color:white"></th>
                              <th style="background-color:#428bca;color:white">ID</th>
                              <th style="background-color:#428bca;color:white">Jenjang Pendidikan</th>
                              <th style="background-color:#428bca;color:white">Nama Sekolah/ Universitas/ Perguruan Tinggi</th>
                              <th style="background-color:#428bca;color:white">Tahun</th>
                              <th style="background-color:#428bca;color:white">Provinsi / Kab/Kota</th>
                              <th style="background-color:#428bca;color:white">Status</th>
                              <th style="min-width:110px;background-color:#428bca;color:white">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>

                      </p>
                    </div>

                    <div id="pengalaman_kerja" class="tab-pane">
                      <p>
                        <form class="form-horizontal" method="post" id="form_tr_pegawai" action="<?php echo site_url('kepegawaian/tr_pegawai/process')?>" enctype="multipart/form-data">
                          <br>
                            <div class="form-group">
                              <label class="control-label col-md-2">Nama Perusahaan</label>
                              <div class="col-md-2">
                                <input name="email" id="email" value="<?php echo isset($value)?$value->email:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
                              </div>
                              <label class="control-label col-md-1">Tahun</label>
                              <div class="col-md-1">
                                <input name="no_telp" id="no_telp" value="<?php echo isset($value)?$value->no_telp:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
                              </div>
                              <label class="control-label col-md-1">s.d</label>
                              <div class="col-md-1">
                                <input name="no_telp" id="no_telp" value="<?php echo isset($value)?$value->no_telp:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
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
                              <label class="control-label col-md-2">Posisi</label>
                              <div class="col-md-2">
                                <input name="email" id="email" value="<?php echo isset($value)?$value->email:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-2">Deskripsi singkat pekerjaan</label>
                              <div class="col-md-4">
                                <textarea name="" class="form-control" style="height:70px !important"></textarea>
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="control-label col-md-2">&nbsp;</label>
                              <div class="col-md-4">
                                <button type="submit" id="btnSave" name="submit" class="btn btn-minier btn-primary">
                                  <i class="ace-icon fa fa-plus icon-on-right bigger-110"></i>
                                  Tambahkan
                                </button>
                              </div>
                            </div>
                            
                        </form>
                        <br>
                        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                           <thead>
                            <tr>  
                              <th class="center" style="max-width:30px;background-color:#428bca;color:white"></th>
                              <th style="background-color:#428bca;color:white">ID</th>
                              <th style="background-color:#428bca;color:white">Jenjang Pendidikan</th>
                              <th style="background-color:#428bca;color:white">Nama Sekolah/ Universitas/ Perguruan Tinggi</th>
                              <th style="background-color:#428bca;color:white">Tahun</th>
                              <th style="background-color:#428bca;color:white">Provinsi / Kab/Kota</th>
                              <th style="background-color:#428bca;color:white">Status</th>
                              <th style="min-width:110px;background-color:#428bca;color:white">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>

                      </p>
                    </div>

                    <div id="pengalaman_org" class="tab-pane">
                      <p>
                        <form class="form-horizontal" method="post" id="form_tr_pegawai" action="<?php echo site_url('kepegawaian/tr_pegawai/process')?>" enctype="multipart/form-data">
                          <br>
                            
                            <div class="form-group">
                              <label class="control-label col-md-2">Nama Organisasi</label>
                              <div class="col-md-2">
                                <input name="email" id="email" value="<?php echo isset($value)?$value->email:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
                              </div>
                              <label class="control-label col-md-2">Tahun</label>
                              <div class="col-md-1">
                                <input name="no_telp" id="no_telp" value="<?php echo isset($value)?$value->no_telp:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
                              </div>
                              <label class="control-label col-md-1">s.d</label>
                              <div class="col-md-1">
                                <input name="no_telp" id="no_telp" value="<?php echo isset($value)?$value->no_telp:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
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
                              <label class="control-label col-md-2">Posisi/Jabatan</label>
                              <div class="col-md-2">
                                <input name="email" id="email" value="<?php echo isset($value)?$value->email:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
                              </div>
                              <div class="col-md-1">
                                  <button type="submit" id="btnSave" name="submit" class="btn btn-minier btn-primary">
                                  <i class="ace-icon fa fa-plus icon-on-right bigger-110"></i>
                                  Tambahkan
                                </button>
                              </div>
                            </div>
                        </form>
                        <br>
                        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                           <thead>
                            <tr>  
                              <th class="center" style="max-width:30px;background-color:#428bca;color:white"></th>
                              <th style="background-color:#428bca;color:white">ID</th>
                              <th style="background-color:#428bca;color:white">Jenjang Pendidikan</th>
                              <th style="background-color:#428bca;color:white">Nama Sekolah/ Universitas/ Perguruan Tinggi</th>
                              <th style="background-color:#428bca;color:white">Tahun</th>
                              <th style="background-color:#428bca;color:white">Provinsi / Kab/Kota</th>
                              <th style="background-color:#428bca;color:white">Status</th>
                              <th style="min-width:110px;background-color:#428bca;color:white">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>

                      </p>
                    </div>

                    <div id="data_keluarga" class="tab-pane">
                      <p>
                        <form class="form-horizontal" method="post" id="form_tr_pegawai" action="<?php echo site_url('kepegawaian/tr_pegawai/process')?>" enctype="multipart/form-data">
                          <br>
                            
                            <div class="form-group">
                              <label class="control-label col-md-2">Nama Ayah</label>
                              <div class="col-md-2">
                                <input name="email" id="email" value="<?php echo isset($value)?$value->email:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
                              </div>
                              <label class="control-label col-md-1">Pekerjaan</label>
                              <div class="col-md-2">
                                <input name="no_telp" id="no_telp" value="<?php echo isset($value)?$value->no_telp:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="control-label col-md-2">Nama Ibu</label>
                              <div class="col-md-2">
                                <input name="email" id="email" value="<?php echo isset($value)?$value->email:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
                              </div>
                              <label class="control-label col-md-1">Pekerjaan</label>
                              <div class="col-md-2">
                                <input name="no_telp" id="no_telp" value="<?php echo isset($value)?$value->no_telp:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
                              </div>
                            </div>
                            
                            <div class="form-group">
                              <label class="control-label col-md-2">&nbsp;</label>
                              <div class="col-md-1">
                                  <button type="submit" id="btnSave" name="submit" class="btn btn-minier btn-primary">
                                  <i class="ace-icon fa fa-plus icon-on-right bigger-110"></i>
                                  Tambahkan
                                </button>
                              </div>
                            </div>
                        </form>
                        <br>
                        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                           <thead>
                            <tr>  
                              <th class="center" style="max-width:30px;background-color:#428bca;color:white"></th>
                              <th style="background-color:#428bca;color:white">ID</th>
                              <th style="background-color:#428bca;color:white">Jenjang Pendidikan</th>
                              <th style="background-color:#428bca;color:white">Nama Sekolah/ Universitas/ Perguruan Tinggi</th>
                              <th style="background-color:#428bca;color:white">Tahun</th>
                              <th style="background-color:#428bca;color:white">Provinsi / Kab/Kota</th>
                              <th style="background-color:#428bca;color:white">Status</th>
                              <th style="min-width:110px;background-color:#428bca;color:white">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>

                      </p>
                    </div>

                  </div>
                </div>

                <!-- /section:elements.tab.option -->
              </div>




              
            </div>
          </div>
    
    <!-- PAGE CONTENT ENDS -->
  </div><!-- /.col -->
</div><!-- /.row -->


