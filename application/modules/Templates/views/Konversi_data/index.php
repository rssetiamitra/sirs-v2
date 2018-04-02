<link rel="stylesheet" href="<?php echo base_url()?>assets/css/datepicker.css" />

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

    <form class="form-horizontal" method="post" id="form_search">

    <div class="col-md-12">
      <center><h4>FORM PENCARIAN DATA REGISTRASI PENGADUAN<br><small style="font-size:12px">(Silahkan lakukan pencarian data berdasarkan parameter dibawah ini)</small></h4></center>
      <br>

      <div class="form-group">
        <label class="control-label col-md-2 ">Nomor Registrasi</label>
        <div class="col-md-2">
          <input type="text" class="form-control" name="no_registrasi" id="no_registrasi">
        </div>
        <label class="control-label col-md-1">Tahun</label>
          <div class="col-md-2">
            <?php echo $this->master->get_tahun_pengaduan(isset($value)?$value->tahun:'','year','year','form-control','required','inline');?>
          </div>
      </div>

      <div class="form-group">
        <label class="control-label col-md-2">Tanggal registrasi</label>
          <div class="col-md-2">
            <div class="input-group">
              <input class="form-control date-picker" name="from_tgl_reg" id="from_tgl_reg" type="text" data-date-format="yyyy-mm-dd" value=""/>
              <span class="input-group-addon">
                <i class="fa fa-calendar bigger-110"></i>
              </span>
            </div>
          </div>

          <label class="control-label col-md-1">s/d tanggal</label>
          <div class="col-md-2">
            <div class="input-group">
              <input class="form-control date-picker" name="to_tgl_reg" id="to_tgl_reg" type="text" data-date-format="yyyy-mm-dd" value=""/>
              <span class="input-group-addon">
                <i class="fa fa-calendar bigger-110"></i>
              </span>
            </div>
          </div>
      </div>

      <div class="form-group">
        <label class="control-label col-md-2 ">Tipe Pengaduan</label>
        <div class="col-md-6">
          <?php echo $this->master->custom_selection(array('table'=>'mst_tipe_pengaduan', 'where'=>array('is_active'=>'Y'), 'id'=>'tp_id', 'name' => 'tp_name'),'','tp_id','tp_id','chosen-slect form-control','','');?>
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
        <label class="control-label col-md-2 ">Kategori Pemilu</label>
        <div class="col-md-2">
          <?php echo $this->master->custom_selection(array('table'=>'mst_kategori_pemilu', 'where'=>array('is_active'=>'Y'), 'id'=>'kp_id', 'name' => 'kp_name'),'','kp_id','kp_id','chosen-slect form-control','','');?>
        </div>
        <label class="control-label col-md-2 ">Status Pengaduan</label>
        <div class="col-md-2">
          <?php echo $this->master->custom_selection(array('table'=>'mst_alur_pengaduan', 'where'=>array('is_active'=>'Y'), 'id'=>'ap_id', 'name' => 'ap_name'),'','ap_id','ap_id','chosen-slect form-control','','');?>
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-md-2 ">&nbsp;</label>
        <div class="col-md-10">
          <a href="#" id="btn_search_data" class="btn btn-xs btn-default">
            <i class="ace-icon fa fa-search icon-on-right bigger-110"></i>
            Search
          </a>
          <a href="#" id="btn_reset_data" class="btn btn-xs btn-warning">
            <i class="ace-icon fa fa-refresh icon-on-right bigger-110"></i>
            Reset
          </a>
          <a href="#" id="btn_export_word" class="btn btn-xs btn-primary">
            <i class="fa fa-file-word-o bigger-110"></i>
            Export Word
          </a>
          <a href="#" id="btn_export_pdf" class="btn btn-xs btn-danger">
            <i class="fa fa-file-word-o bigger-110"></i>
            Export PDF
          </a>
          <a href="#" id="btn_export_excel" class="btn btn-xs btn-success">
            <i class="fa fa-file-word-o bigger-110"></i>
            Export Excel
          </a>
        </div>
      </div>

    </div>

    <div class="clearfix" style="margin-bottom:-20px">
      
      
    </div>
    <hr class="separator">

    <!-- div.dataTables_borderWrap -->

    <div class="col-sm-12">
        <div class="tabbable">
          <ul class="nav nav-tabs" id="myTab">
            <li class="active">
              <a data-toggle="tab" href="#data-hasil">
                <i class="green ace-icon fa fa-list bigger-120"></i>
                DATA REGISTRASI PENGADUAN
              </a>
            </li>

            <li>
              <a data-toggle="tab" href="#rekapitulasi">
                <i class="green ace-icon fa fa-area-chart bigger-120"></i>
                REKAPITULASI REGISTRASI PENGADUAN
              </a>
            </li>

          </ul>

          <div class="tab-content">
            <div id="data-hasil" class="tab-pane fade in active">

              <div class="clearfix" style="margin-bottom:-20px">
              <?php echo $this->authuser->show_button('Templates/konversi_data','C','',1)?>
      <?php echo $this->authuser->show_button('Templates/konversi_data','D','',5)?>
                <div class="pull-right tableTools-container"></div>
              </div>
              <hr class="separator">
              <div style="margin-top:-20px">
                <br>
                <center><h4>DATA REGISTRASI PENGADUAN<br><small style="font-size:12px"><div id="range_date">(Source data : Tanggal <?php echo $this->tanggal->formatDate($graph['registrasi']->min_date).' s/d '. $this->tanggal->formatDate($graph['registrasi']->max_date)?> )</div></small></h4></center>
                  <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                   <thead>
                    <tr>  
                      <th width="30px" class="center"></th>
                      <th width="70px">Nomor dan Tanggal Registrasi</th>
                      <th width="150px">Pengadu / Kuasa</th>
                      <th width="150px">Teradu</th>
                      <th>Asal Pengaduan</th>
                      <th width="150px">Tipe Pengaduan</th>
                      <th>Kategori Pemilu</th>
                      <th>Status</th>
                      <th>Alamat / Tempat /<br> Keterangan Pengaduan</th>
                      <th>Formulir</th>
                      <th width="170px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
                </div>

            </div>

            <div id="rekapitulasi" class="tab-pane fade">
                <!-- pengaduan berdasarkan asal pengaduan -->
                <div class="row">
                  <center><h4>Rekapitulasi Pengaduan Berdasarkan Asal Pengaduan<br> <small>Tanggal <?php echo $this->tanggal->formatDate($graph['registrasi']->min_date).' s/d '. $this->tanggal->formatDate($graph['registrasi']->max_date);?><br> diurutkan berdasarkan jumlah pengaduan terbesar</small></h4></center>
                  <div class="col-sm-6">
                    <table class="table table-striped table-bordered table-hover">
                     <thead>
                      <tr>  
                        <th width="30px" class="center">No</th>
                        <th>Asal Pengaduan / Provinsi</th>
                        <th class="center" width="100px">Jumlah Pengaduan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $noa=1;
                        foreach ($graph['asal_pengaduan'] as $kap => $vap) {
                          if($vap->name != NULL){
                            echo '<tr>';
                            echo '<td align="center">'.$noa.'</td>';
                            echo '<td>'.$vap->name.'</td>';
                            echo '<td align="center">'.$vap->total_pengaduan.'</td>';
                            echo '</tr>';
                          $noa++;
                          }else{
                            $other_ap[] = $vap->total_pengaduan;
                          }
                          $total_all_ap[] = $vap->total_pengaduan;
                        }
                      ?>
                      <tr>  
                        <td class="center"><?php echo $noa; ?></td>
                        <td>TIDAK DIKETAHUI</td>
                        <td class="center"><?php echo isset($other_ap)?array_sum($other_ap):0?></td>
                      </tr>

                      <tr>  
                        <td colspan="2" align="center">TOTAL</td>
                        <td class="center"><?php echo isset($total_all_ap)?array_sum($total_all_ap):0?></td>
                      </tr>


                    </tbody>
                  </table>
                  </div>
                  <div class="col-sm-6">
                    <div id="graph_pgd_by_asal_pengaduan" style="height: 1250px; margin: 0 auto"></div>
                  </div>
                </div>
                <!-- pengaduan berdasarkan tipe pengaduan -->
                <div class="row">
                  <center><h4>Rekapitulasi Pengaduan Berdasarkan Tipe Pengaduan<br> <small>Tanggal <?php echo $this->tanggal->formatDate($graph['registrasi']->min_date).' s/d '. $this->tanggal->formatDate($graph['registrasi']->max_date);?><br> diurutkan berdasarkan jumlah pengaduan terbesar</small></h4></center>
                  <div class="col-sm-6">
                    <table class="table table-striped table-bordered table-hover">
                     <thead>
                      <tr>  
                        <th width="30px" class="center">No</th>
                        <th>Tipe Pengaduan</th>
                        <th class="center" width="100px">Jumlah Pengaduan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $nob=1;
                        foreach ($graph['tipe_pengaduan'] as $vtp) {
                          if($vtp->tp_name != NULL){
                            echo '<tr>';
                            echo '<td align="center">'.$nob.'</td>';
                            echo '<td>'.$vtp->tp_name.'</td>';
                            echo '<td align="center">'.$vtp->total_pengaduan.'</td>';
                            echo '</tr>';
                          $nob++;
                          }else{
                            $other_tp[] = $vtp->total_pengaduan;
                          }
                          $total_all_tp[] = $vtp->total_pengaduan;
                        }
                      ?>
                      <tr>  
                        <td class="center"><?php echo $nob; ?></td>
                        <td>Lainnya</td>
                        <td class="center"><?php echo isset($other_tp)?array_sum($other_tp):0?></td>
                      </tr>

                      <tr>  
                        <td colspan="2" align="center">TOTAL</td>
                        <td class="center"><?php echo isset($total_all_tp)?array_sum($total_all_tp):0?></td>
                      </tr>

                    </tbody>
                  </table>
                  </div>
                  <div class="col-sm-6">
                    <div id="graph_pgd_by_tipe_pengaduan" style=" height: 300px; margin: 0 auto"></div>
                  </div>
                </div>
                <!-- pengaduan berdasarkan kategori pemilu -->
                <div class="row">
                  <center><h4>Rekapitulasi Pengaduan Berdasarkan Kategori Pemilu<br> <small>Tanggal <?php echo $this->tanggal->formatDate($graph['registrasi']->min_date).' s/d '. $this->tanggal->formatDate($graph['registrasi']->max_date);?><br> diurutkan berdasarkan jumlah pengaduan terbesar</small></h4></center>
                  <div class="col-sm-6">
                    <table class="table table-striped table-bordered table-hover">
                     <thead>
                      <tr>  
                        <th width="30px" class="center">No</th>
                        <th>Kategori Pemilu</th>
                        <th class="center" width="100px">Jumlah Pengaduan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $noc=1;
                        foreach ($graph['kategori_pemilu'] as $vkp) {
                          if($vkp->kp_name != NULL){
                            echo '<tr>';
                            echo '<td align="center">'.$noc.'</td>';
                            echo '<td>'.$vkp->kp_name.'</td>';
                            echo '<td align="center">'.$vkp->total_pengaduan.'</td>';
                            echo '</tr>';
                          $noc++;
                          }else{
                            $other_kp[] = $vkp->total_pengaduan;
                          }
                          $total_all_kp[] = $vkp->total_pengaduan;
                        }
                      ?>
                      <tr>  
                        <td colspan="2" align="center">TOTAL</td>
                        <td class="center"><?php echo isset($total_all_kp)?array_sum($total_all_kp):0?></td>
                      </tr>

                    </tbody>
                  </table>
                  </div>
                  <div class="col-sm-6">
                    <div id="graph_pgd_by_kategori_pemilu" style=" height: 300px; margin: 0 auto"></div>
                  </div>
                </div>


            </div>

          </div>
        </div>
    </div>

    
  </form>
  
  </div><!-- /.col -->
</div><!-- /.row -->


<script src="<?php echo base_url()?>assets/js/date-time/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url()?>assets/chart/highcharts.js"></script>
<script src="<?php echo base_url()?>assets/chart/modules/exporting.js"></script>
<script>
jQuery(function($) {

   $('#graph_pgd_by_tipe_pengaduan').highcharts({
      chart: {
          plotBackgroundColor: null,
          plotBorderWidth: null,
          plotShadow: false
      },
      title: {
          text: ''
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
      exporting: {
               enabled: false
      },
      series: [{
          type: 'pie',
          name: 'Total Pengaduan',
          data: [
            <?php foreach ($graph['tipe_pengaduan'] as $valtp) {
              if($valtp->tp_name != NULL){
                echo '["'.$valtp->tp_name.'" , '.$valtp->total_pengaduan.'],';
              }else{
                $others[] = $valtp->total_pengaduan;
              }
            }?>
              ['Lainnya', <?php echo isset($others)?array_sum($others):0?>]

          ]
      }]
   });

   $('#graph_pgd_by_kategori_pemilu').highcharts({
      chart: {
          plotBackgroundColor: null,
          plotBorderWidth: null,
          plotShadow: false
      },
      title: {
          text: ''
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
      exporting: {
               enabled: false
      },
      series: [{
          type: 'pie',
          name: 'Total Pengaduan',
          data: [
            <?php foreach ($graph['kategori_pemilu'] as $valkp) {
              if($valkp->kp_name != NULL){
                echo '["'.$valkp->kp_name.'" , '.$valkp->total_pengaduan.'],';
              }else{
                $others_kp[] = $valkp->total_pengaduan;
              }
            }?>

          ]
      }]
   });

   $('#graph_pgd_by_tipe_pengaduan').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: ''
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            exporting: {
                     enabled: false
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                type: 'pie',
                name: 'Total Pengaduan',
                data: [
                    <?php foreach ($graph['tipe_pengaduan'] as $valtp) {
                      if($valtp->tp_name != NULL){
                        echo '["'.$valtp->tp_name.'" , '.$valtp->total_pengaduan.'],';
                      }else{
                        $others[] = $valtp->total_pengaduan;
                      }
                    }?>
                    ['Lainnya', <?php echo isset($others)?array_sum($others):0?>]

                ]
            }]
        });




  $('#graph_pgd_by_asal_pengaduan').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: ''
        },
        xAxis: {
            categories: [
                <?php foreach ($graph['asal_pengaduan'] as $row_prov) {
                    if($row_prov->name != NULL){
                      echo "'".$row_prov->name."',"; 
                    }
                }?>
                ],

            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total Pengaduan',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ' Pengaduan'
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            layout: 'horizontal',
            align: 'right',
            verticalAlign: 'top',
            x: -20,
            y: 230,
            floating: true,
            borderWidth: 1,
            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
            shadow: true
        },
        credits: {
            enabled: false
        },
        exporting: {
                     enabled: false
            },
        series: [{
            name: 'Tahun <?php echo date('Y', strtotime($graph['registrasi']->min_date)).' - '.date('Y', strtotime($graph['registrasi']->max_date))?>',
            data: [
                <?php foreach ($graph['asal_pengaduan'] as $row_prov) {
                  if($row_prov->name != NULL){
                    $total = $row_prov->total_pengaduan; 
                    echo $total.",";
                  }
                }?>
                ]
        }]
    });

  $('.date-picker').datepicker({
    autoclose: true,
    todayHighlight: true
  })
  //show datepicker when clicking on the icon
  .next().on(ace.click_event, function(){
    $(this).prev().focus();
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

});  
</script>

<script src="<?php echo base_url()?>/assets/js/dataTables/jquery.dataTables.js"></script>
<script src="<?php echo base_url()?>/assets/js/dataTables/jquery.dataTables.bootstrap.js"></script>
<script src="<?php echo base_url()?>/assets/js/dataTables/extensions/TableTools/js/dataTables.tableTools.js"></script>
<script src="<?php echo base_url()?>/assets/js/dataTables/extensions/ColVis/js/dataTables.colVis.js"></script>
<script src="<?php echo base_url().'assets/js/custom/sipepp_pengaduan/konversi_data.js'?>"></script>



