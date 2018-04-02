<script>

  $(document).ready(function(){

    // TAB PARA PIHAK //
    $('#tab_para_pihak').click(function () {
      $("html, body").animate({ scrollTop: "270px" }, "slow");
      var pgd_id = $(this).attr('rel');
      $('#content_tab_custom').html(loading);
      $('#content_tab_custom').load('sipepp_pengaduan/Adm_pengaduan/Tr_pp?pgd_id='+pgd_id);
    });

    // TAB PERISTIWA ADUAN //
    $('#tab_peristiwa_aduan').click(function () {
      $("html, body").animate({ scrollTop: "270px" }, "slow");
      var pgd_id = $(this).attr('rel');
      $('#content_tab_custom').html(loading);
      $('#content_tab_custom').load('sipepp_pengaduan/Adm_pengaduan/Tr_peristiwa?pgd_id='+pgd_id);
    });

    // TAB ALAT & BARANG BUKTI //
    $('#tab_alat_brg_bukti').click(function () {
      $("html, body").animate({ scrollTop: "270px" }, "slow");
      var pgd_id = $(this).attr('rel');
      $('#content_tab_custom').html(loading);
      $('#content_tab_custom').load('sipepp_pengaduan/Adm_pengaduan/Tr_bukti?pgd_id='+pgd_id);
    });

    // TAB URAIAN SINGKAT KEJADIAN //
    $('#tab_uraian_kejadian').click(function () {
      $("html, body").animate({ scrollTop: "270px" }, "slow");
      var pgd_id = $(this).attr('rel');
      $('#content_tab_custom').html(loading);
      $('#content_tab_custom').load('sipepp_pengaduan/Adm_pengaduan/Tr_uraian?pgd_id='+pgd_id);
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

              <form class="form-horizontal" method="post" id="form_role" action="<?php echo site_url('sipepp_pengaduan/Adm_pengaduan/Registrasi_adm/process')?>" enctype="multipart/form-data">
                <br>
                <!-- form hidden -->
                <input name="id" id="id" value="<?php echo isset($value)?$value->pgd_id:0?>" placeholder="Auto" class="form-control" type="hidden" readonly>

                <table class="table table-striped">
                  <tr>
                    <td colspan="4"><b><i class="fa fa-bullhorn"></i> DATA REGISTRASI PENGADUAN</b></td>
                  </tr>
                  <tr>
                    <td width="200px">REG ID</td>
                    <td>
                      <?php echo isset($value)?$value->pgd_id:0?>              
                    </td>
                    <td>Tanggal Pengaduan</td><td><?php echo isset($value)?$this->tanggal->formatDate($value->pgd_tanggal):date('Y-m-d')?></td>
                  </tr>
                  <tr>
                    <td>Kategori Pengaduan</td><td width="400px"><?php echo isset($value)?$value->tp_name:''?></td>
                    <td width="200px">Tipe Pengaduan</td><td><?php echo isset($value)?$value->kp_name:''?></td>
                  </tr>
                  <tr>
                    <td>Lokasi</td><td><?php echo isset($value->subdistrict_name)?ucwords(strtolower($value->subdistrict_name)).', ':''?>
                        <?php echo isset($value->district_name)?ucwords(strtolower($value->district_name)).', ':''?>
                        <?php echo isset($value->city_name)?ucwords(strtolower($value->city_name)).', ':''?>
                        <?php echo isset($value->province_name)?ucwords(strtolower($value->province_name)):''?></td>
                        <td>Keterangan</td><td><?php echo isset($value)?$value->pgd_tempat:''?></td>
                  </tr>
                  <tr>
                    <td>Status</td>
                    <td colspan="3">
                      <?php echo isset($value)?$value->pgd_status:''?>&nbsp;&nbsp;&nbsp;
                      <?php echo isset($value)?'('.$value->ap_name.')':''?>
                    </td>
                  </tr>

                </table>

              </form>
              <br>
              <div class="row">
                <div class="col-sm-12">
                  <!-- #section:elements.tab -->
                  <div class="tabbable">
                    <ul class="nav nav-tabs" id="myTab">
                      <li>
                        <a id="tab_para_pihak" rel="<?php echo $value->pgd_id?>" data-toggle="tab" href="#para_pihak">
                          <i class="green ace-icon fa fa-users bigger-120"></i>
                          Para Pihak (Pengadu, Teradu, Kuasa, Dll)
                        </a>
                      </li>

                      <li>
                        <a id="tab_peristiwa_aduan" rel="<?php echo $value->pgd_id?>" data-toggle="tab" href="#peristiwa_aduan">
                          <i class="red ace-icon fa fa-history bigger-120"></i>
                          Peristiwa Aduan
                        </a>
                      </li>

                      <li>
                        <a id="tab_alat_brg_bukti" rel="<?php echo $value->pgd_id?>" data-toggle="tab" href="#alat_barang_bukti">
                          <i class="pink ace-icon fa fa-file bigger-120"></i>
                          Alat dan Barang Bukti
                        </a>
                      </li>

                      <li>
                        <a id="tab_uraian_kejadian" rel="<?php echo $value->pgd_id?>" data-toggle="tab" href="#uraian">
                          <i class="ace-icon fa fa-circle-o bigger-120"></i>
                          Uraian Singkat Kejadian
                        </a>
                      </li>

                      
                    </ul>

                    <div class="tab-content">
                      <div id="para_pihak" class="tab-pane fade in active">
                        <div id="content_tab_custom" style="padding-right:-20px">
                          <div class="alert alert-warning center">
                          <h4><i class="fa fa-file-o"></i> FORMULIR PENGADUAN<br>
                          REG.ID <?php echo isset($value)?$value->pgd_id:0?></h4>
                          Silahkan lengkapi formulir pengaduan pada tab diatas.</div>
                        </div>
                      </div>
                    </div>

                  </div>

                </div><!-- /.col -->
              </div>

            </div>
          </div>
    
    <!-- PAGE CONTENT ENDS -->
  </div><!-- /.col -->
</div><!-- /.row -->



