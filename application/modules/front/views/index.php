<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>RSSM - Rumah Sakit Setia Mitra</title>
        <link rel="stylesheet" href="<?php echo base_url()?>assets/front/css/style.css">
        <link rel="stylesheet" href="<?php echo base_url()?>assets/front/css/style-responsive.css">
        <link rel="stylesheet" href="<?php echo base_url()?>assets/front/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url()?>assets/front/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url()?>assets/front/css/open-sans.css">
        <link rel="stylesheet" href="<?php echo base_url()?>assets/front/css/dialog.css">
        <link rel="stylesheet" href="<?php echo base_url()?>assets/front/css/dialog-sally.css">
        <link rel="icon" href="<?php //echo base_url()?>assets/front/images/icon.png">
        <!-- CHART -->
        <link rel="stylesheet" href="<?php echo base_url()?>assets/front/css/chartist.min.css">
        <script type="text/javascript" src="<?php echo base_url()?>assets/front/js/jquery-1.11.2.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>assets/front/js/modernizr.custom.js"></script>

        <link rel="stylesheet" href="<?php echo base_url()?>assets/css/bootstrap.css" />
        <link rel="stylesheet" href="<?php echo base_url()?>assets/css/font-awesome.css" />
        <link rel="stylesheet" href="<?php echo base_url()?>assets/css/ace-fonts.css" />

    </head>
    <body>
        <!-- HEADER -->
        <section id="header">
            <div class="logo"><img src="<?php echo base_url()?>assets/front/images/logo_garuda.png" alt="Sistem Informasi Peradilan Etika Penyelenggara Pemilu"></div>
            <div class="header-title-2">DEWAN KEHORMATAN PENYELENGGARA PEMILU </div>
            <hr class="header-garis" />
            <div class="header-title-2">SIPEPP</div>
            <p class="header-text-gold">Sistem Informasi Peradilan Etika Penyelenggara Pemilu</p>
            <div class="header-menu">
                <button class="button-merah" onclick="return goToWeb();"> <i class="fa fa-globe"></i> Website DKPP RI</button> 
                <span class="header-text-margin">atau</span> 
                <button class="button-biru trigger"  onclick="return goToLogin()"> <i class="fa fa-key"></i> Login</button>
            </div>
        </section>
        <!-- END HEADER -->

        <!-- MENU -->
        <section id="menu">
            <div class="container">
                <div class="row">
                    <div class="col-md-15">
                        <i class="fa fa-bullhorn"></i>
                        <h4>e-Pengaduan</h4>
                        <div class="menu-line"></div>
                        <div class="menu-button">
                            <a href="#e-pengaduan" class="button-merah">Selengkapnya</a>
                        </div>
                        <p>Sistem Informasi Dugaan Pelanggaran Kode Etik Penyelenggara Pemilu.</p>

                    </div>
                    <div class="col-md-15">
                        <i class="fa fa-gavel"></i>
                        <h4>e-Persidangan</h4>
                        <div class="menu-line"></div>
                        <div class="menu-button">
                            <a href="#e-persidangan" class="button-merah">Selengkapnya</a>
                        </div>
                        <p>Sistem Informasi Persidangan Pelanggaran Kode Etik Penyelenggara Pemilu.</p>

                    </div>
                    <div class="col-md-15">
                        <i class="fa fa-envelope-o"></i>
                        <h4>e-Persuratan</h4>
                        <div class="menu-line"></div>
                        <div class="menu-button">
                            <a href="#e-persuratan" class="button-merah">Selengkapnya</a>
                        </div>
                        <p>Sistem Informasi Persuratan Pelanggaran Kode Etik Penyelenggara Pemilu.</p>

                    </div>
                    <div class="col-md-15">
                        <i class="fa fa-paste"></i>
                        <h4>e-Kearsipan</h4>
                        <div class="menu-line"></div>
                        <div class="menu-button">
                            <a href="#e-kearsipan" class="button-merah">Selengkapnya</a>
                        </div>
                        <p>Sistem Informasi Kearsipan Pelanggaran Kode Etik Penyelenggara Pemilu.</p>

                    </div>
                    <div class="col-md-15">
                        <i class="fa fa-users"></i>
                        <h4>Sistem Eksekutif</h4>
                        <div class="menu-line"></div>
                        <div class="menu-button">
                            <a href="#sistem-eksekutif" class="button-merah">Selengkapnya</a>
                        </div>
                        <p>Sistem Informasi Eksekutif Pelanggaran Kode Etik Penyelenggara Pemilu.</p>

                    </div>
                </div>
            </div>
        </section>
        <!-- END MENU --> 

        <!-- e-Pengaduan -->
        <section id="e-pengaduan" class="table-and-graph">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <h1 class="color-red">e-Pengaduan</h1>
                        <p>Jumlah Pengaduan Pelanggaran Kode Etik Penyelenggara Pemilu <br> Diterima Sekertariat Biro DKPP Tahun 2012 s.d. 2014 </p>
                        <div class="garis-title"></div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-right">
                            <button class="button-go-app" onclick="return goToEPengaduan();">Masuk Apllikasi&nbsp;&nbsp;&nbsp;<i class="fa fa-long-arrow-right"></i></button>
                        </div>
                    </div>
                </div>

                <!-- rekap berdasarkan registrasi adm -->
                <div class="row">
                  <!-- pengaduan berdasarkan asal pengaduan -->
                  <div class="row">
                    <center><h4>Rekapitulasi Pengaduan Berdasarkan Asal Pengaduan<br> <small>Tanggal <?php echo $this->tanggal->formatDate($graph['registrasi']->min_date).' s/d '. $this->tanggal->formatDate($graph['registrasi']->max_date);?><br> diurutkan berdasarkan jumlah pengaduan terbesar</small></h4></center>
                    <div class="col-sm-6">
                      <table class="table-data">
                       <thead>
                        <tr>  
                          <th width="30px" align="center">No</th>
                          <th>Asal Pengaduan / Provinsi</th>
                          <th align="center" width="100px">Jumlah Pengaduan</th>
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
                          <td align="center"><?php echo $noa; ?></td>
                          <td>TIDAK DIKETAHUI</td>
                          <td align="center"><?php echo isset($other_ap)?array_sum($other_ap):0?></td>
                        </tr>

                        <tr>  
                          <td colspan="2" align="center">TOTAL</td>
                          <td align="center"><?php echo isset($total_all_ap)?array_sum($total_all_ap):0?></td>
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
                      <table class="table-data">
                       <thead>
                        <tr>  
                          <th width="30px" align="center">No</th>
                          <th>Tipe Pengaduan</th>
                          <th align="center" width="100px">Jumlah Pengaduan</th>
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
                          <td align="center"><?php echo $nob; ?></td>
                          <td>Lainnya</td>
                          <td align="center"><?php echo isset($other_tp)?array_sum($other_tp):0?></td>
                        </tr>

                        <tr>  
                          <td colspan="2" align="center">TOTAL</td>
                          <td align="center"><?php echo isset($total_all_tp)?array_sum($total_all_tp):0?></td>
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
                      <table class="table-data">
                       <thead>
                        <tr>  
                          <th width="30px" align="center">No</th>
                          <th>Kategori Pemilu</th>
                          <th align="center" width="100px">Jumlah Pengaduan</th>
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
                          <td align="center"><?php echo isset($total_all_kp)?array_sum($total_all_kp):0?></td>
                        </tr>

                      </tbody>
                    </table>
                    </div>
                    <div class="col-sm-6">
                      <div id="graph_pgd_by_kategori_pemilu" style=" height: 300px; margin: 0 auto"></div>
                    </div>
                  </div>

                </div>

                <!-- rekap berdasarkan hasil penelitian adm -->
                <div class="row">
                  <div class="col-sm-6">
                    <center><h4>Rekapitulasi Pengaduan <br> Berdasarkan Hasil Penelitian Administrasi<br> <small>Tanggal <?php echo $this->tanggal->formatDate($graph_hasil_verifikasi_adm['hasil_penelitian']->min_date).' s/d '. $this->tanggal->formatDate($graph_hasil_verifikasi_adm['hasil_penelitian']->max_date);?></small></h4></center>
                    <table class="table-data">
                     <thead>
                      <tr>  
                        <th width="30px" align="center">No</th>
                        <th>Hasil Penelitian / Keterangan</th>
                        <th align="center" width="100px">Jumlah Pengaduan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>  
                        <td align="center">1</td>
                        <td>Memenuhi Syarat</td>
                        <td align="center"><?php echo $graph_hasil_verifikasi_adm['hasil_penelitian']->memenuhi?></td>
                      </tr>
                      <tr>  
                        <td align="center">2</td>
                        <td>Tidak Memenuhi Syarat</td>
                        <td align="center"><?php echo $graph_hasil_verifikasi_adm['hasil_penelitian']->tidak_memenuhi?></td>
                      </tr>
                      <tr>  
                        <td align="center">3</td>
                        <td>Total Pengaduan Diterima</td>
                        <td align="center"><?php echo $graph_hasil_verifikasi_adm['hasil_penelitian']->total_pengaduan?></td>
                      </tr>
                      <tr>  
                        <td align="center">4</td>
                        <td>Total Pengaduan yang sudah dilakukan penelitian administrasi</td>
                        <td align="center"><?php echo $graph_hasil_verifikasi_adm['hasil_penelitian']->total_penelitian?></td>
                      </tr>
                      <tr>  
                        <td align="center">5</td>
                        <td>Total Pengaduan yang masih dalam proses</td>
                        <td align="center"><?php echo $graph_hasil_verifikasi_adm['hasil_penelitian']->total_pengaduan - $graph_hasil_verifikasi_adm['hasil_penelitian']->total_penelitian; ?></td>
                      </tr>

                    </tbody>
                  </table>
                  <div id="graph_pgdhpa"></div>
                  </div>

                  <div class="col-sm-6">
                    <center><h4>Rekapitulasi Pengaduan <br> Berdasarkan Verifikator Pengaduan <br> <small>Tanggal <?php echo $this->tanggal->formatDate($graph_hasil_verifikasi_adm['hasil_penelitian']->min_date).' s/d '. $this->tanggal->formatDate($graph_hasil_verifikasi_adm['hasil_penelitian']->max_date);?></small></h4></center>
                    <table class="table-data">
                     <thead>
                      <tr>  
                        <th width="30px" align="center">No</th>
                        <th>Verifikator</th>
                        <th align="center" width="100px">Jumlah Pengaduan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $no =1;
                        foreach ($graph_hasil_verifikasi_adm['verifikator'] as $k => $v) {
                          $total[] = $v->total;
                          echo '<tr>  
                                  <td align="center">'.$no.'</td>
                                  <td>'.$v->fullname.'</td>
                                  <td align="center">'.$v->total.'</td>
                                </tr>';
                          $no++;
                        }?>
                        <tr>  
                          <td align="right" colspan="2">TOTAL</td>
                          <td align="center"><?php echo isset($total)?array_sum($total):0?></td>
                        </tr>
                    </tbody>
                  </table>
                  <div id="graph_pgdhpa_verifikator"></div>
                  </div>

                </div>

                <!-- rekap berdasarkan hasil pengkajian -->
                <div class="row">
                  <div class="col-sm-6">
                    <center><h4>Rekapitulasi Pengaduan <br> Berdasarkan Hasil Rekomendasi Pengkaji<br> <small>Tanggal <?php echo $this->tanggal->formatDate($graph_hasil_pengkajian['hasil_pengkajian']->min_date).' s/d '. $this->tanggal->formatDate($graph_hasil_pengkajian['hasil_pengkajian']->max_date);?></small></h4></center>
                    <table class="table-data">
                     <thead>
                      <tr>  
                        <th width="30px" align="center">No</th>
                        <th>Verifikator</th>
                        <th align="center" width="100px">Jumlah Pengaduan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $no =1;
                        foreach ($graph_hasil_pengkajian['rekomendasi_pengkaji'] as $k => $v) {
                          $total_rek_pengkaji[] = $v->total;
                          echo '<tr>  
                                  <td align="center">'.$no.'</td>
                                  <td>'.$v->sv_name.'</td>
                                  <td align="center">'.$v->total.'</td>
                                </tr>';
                          $no++;
                        }?>
                        <tr>  
                          <td align="right" colspan="2">TOTAL</td>
                          <td align="center"><?php echo array_sum($total_rek_pengkaji)?></td>
                        </tr>
                    </tbody>
                  </table>
                  <div id="graph_pgdpkj"></div>
                  </div>

                  <div class="col-sm-6">
                    <center><h4>Rekapitulasi Pengaduan <br> Berdasarkan Pengkaji Berkas Pengaduan<br> <small>Tanggal <?php echo $this->tanggal->formatDate($graph_hasil_pengkajian['hasil_pengkajian']->min_date).' s/d '. $this->tanggal->formatDate($graph_hasil_pengkajian['hasil_pengkajian']->max_date);?></small></h4></center>
                    <table class="table-data">
                     <thead>
                      <tr>  
                        <th width="30px" align="center">No</th>
                        <th>Hasil Penelitian / Keterangan</th>
                        <th align="center" width="100px">Jumlah Pengaduan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $no =1;
                        foreach ($graph_hasil_pengkajian['pengkaji'] as $yk => $vl) {
                          $total_vl[] = $vl->total;
                          echo '<tr>  
                                  <td align="center">'.$no.'</td>
                                  <td>'.$vl->fullname.'</td>
                                  <td align="center">'.$vl->total.'</td>
                                </tr>';
                          $no++;
                        }?>
                        <tr>  
                          <td align="right" colspan="2">TOTAL</td>
                          <td align="center"><?php echo array_sum($total_vl)?></td>
                        </tr>
                    </tbody>
                  </table>

                    
                  <div id="graph_pgdpkj_verifikator"></div>
                  </div>

                </div>

                <!-- rekap hasil vermat -->
                <div class="row">
                  <div class="col-sm-6">
                    <center><h4>Rekapitulasi Pengaduan <br> Berdasarkan Hasil Verifikasi Materil<br> <small>Tanggal <?php echo $this->tanggal->formatDate($graph_hasil_vermat['vermat']->min_date).' s/d '. $this->tanggal->formatDate($graph_hasil_vermat['vermat']->max_date);?></small></h4></center>
                    <table class="table-data">
                     <thead>
                      <tr>  
                        <th width="30px" align="center">No</th>
                        <th>Verifikator</th>
                        <th align="center" width="100px">Jumlah Pengaduan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $no =1;
                        foreach ($graph_hasil_vermat['hasil_vermat'] as $k => $v) {
                          $total_hasil_vermat[] = $v->total;
                          echo '<tr>  
                                  <td align="center">'.$no.'</td>
                                  <td>'.$v->sv_name.'</td>
                                  <td align="center">'.$v->total.'</td>
                                </tr>';
                          $no++;
                        }?>
                        <tr>  
                          <td align="right" colspan="2">TOTAL</td>
                          <td align="center"><?php echo array_sum($total_hasil_vermat)?></td>
                        </tr>
                    </tbody>
                  </table>
                  <div id="graph_phv"></div>
                  </div>

                  <div class="col-sm-6">
                    <center><h4>Rekapitulasi Pengaduan <br> Berdasarkan Asas/Modus Pelanggaran  <br> <small>Tanggal <?php echo $this->tanggal->formatDate($graph_hasil_vermat['vermat']->min_date).' s/d '. $this->tanggal->formatDate($graph_hasil_vermat['vermat']->max_date);?></small></h4></center>
                    <table class="table-data">
                     <thead>
                      <tr>  
                        <th width="30px" align="center">No</th>
                        <th>Hasil Penelitian / Keterangan</th>
                        <th align="center" width="100px">Jumlah Pengaduan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $no =1;
                        foreach ($graph_hasil_vermat['vermat_by_modus'] as $yk => $vl) {
                          $total_asas[] = $vl->total;
                          echo '<tr>  
                                  <td align="center">'.$no.'</td>
                                  <td>'.$vl->jp_name.'</td>
                                  <td align="center">'.$vl->total.'</td>
                                </tr>';
                          $no++;
                        }?>
                        <tr>  
                          <td align="right" colspan="2">TOTAL</td>
                          <td align="center"><?php echo array_sum($total_asas)?></td>
                        </tr>
                    </tbody>
                  </table>

                  </div>

                </div>

            </div>
        </section>
        <!-- End e-Pengaduan -->

        <!-- e-Persidangan -->
        <!-- <section id="e-persidangan" class="table-and-graph">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <h1 class="color-red">e-Persidangan</h1>
                        <p>Sistem e-Persidangan DKPP</p>
                        <div class="garis-title"></div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-right">
                            <button class="button-go-app" onclick="return goToEPersidangan();">Masuk Apllikasi&nbsp;&nbsp;&nbsp;<i class="fa fa-long-arrow-right"></i></button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <table class="table-data">
                            <thead>
                                <tr>
                                    <th width="5%">No.</th>
                                    <th>Laporan</th>
                                    <th>Tanggal</th>
                                    <th class="text-center">Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Epih  Ibkar Irmansyah, Ir</td>
                                    <td>2014-05-22</td>
                                    <td class="text-center"><a href="#popupLaporan"><i class="fa fa-share-square-o"></i></a></td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Cornell Adyas</td>
                                    <td>2014-06-02</td>
                                    <td class="text-center"><a href="#popupLaporan"><i class="fa fa-share-square-o"></i></a></td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Mohammad Luthfie, SE</td>
                                    <td>2014-07-12</td>
                                    <td class="text-center"><a href="#popupLaporan"><i class="fa fa-share-square-o"></i></a></td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Giat Ruchiat Jonie</td>
                                    <td>2014-08-01</td>
                                    <td class="text-center"><a href="#popupLaporan"><i class="fa fa-share-square-o"></i></a></td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Mimin Karmini</td>
                                    <td>2014-09-06</td>
                                    <td class="text-center"><a href="#popupLaporan"><i class="fa fa-share-square-o"></i></a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <div class="ct-chart chart-persidangan" style="height: 350px"></div>
                    </div>
                </div>
            </div>
        </section> -->
        <!-- End e-Persidangan -->

        <!-- e-Persuratan -->
        <!-- <section id="e-persuratan" class="table-and-graph">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <h1 class="color-red">e-Persuratan</h1>
                        <p>Sistem e-Persuratan DKPP</p>
                        <div class="garis-title"></div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-right">
                            <button class="button-go-app" onclick="return goToEPersuratan();">Masuk Apllikasi&nbsp;&nbsp;&nbsp;<i class="fa fa-long-arrow-right"></i></button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <table class="table-data">
                            <thead>
                                <tr>
                                    <th width="5%">No.</th>
                                    <th>Laporan</th>
                                    <th>Tanggal</th>
                                    <th class="text-center">Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Epih  Ibkar Irmansyah, Ir</td>
                                    <td>2014-05-22</td>
                                    <td class="text-center"><a href="#popupLaporan"><i class="fa fa-share-square-o"></i></a></td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Cornell Adyas</td>
                                    <td>2014-06-02</td>
                                    <td class="text-center"><a href="#popupLaporan"><i class="fa fa-share-square-o"></i></a></td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Mohammad Luthfie, SE</td>
                                    <td>2014-07-12</td>
                                    <td class="text-center"><a href="#popupLaporan"><i class="fa fa-share-square-o"></i></a></td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Giat Ruchiat Jonie</td>
                                    <td>2014-08-01</td>
                                    <td class="text-center"><a href="#popupLaporan"><i class="fa fa-share-square-o"></i></a></td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Mimin Karmini</td>
                                    <td>2014-09-06</td>
                                    <td class="text-center"><a href="#popupLaporan"><i class="fa fa-share-square-o"></i></a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <div class="ct-chart chart-persuratan" style="height: 350px"></div>
                    </div>
                </div>
            </div>
        </section> -->
        <!-- End e-Persuratan -->

        <!-- e-Kearsipan -->
        <!-- <section id="e-kearsipan" class="table-and-graph">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <h1 class="color-red">e-Kearsipan</h1>
                        <p>Sistem e-Kearsipan DKPP</p>
                        <div class="garis-title"></div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-right">
                            <button class="button-go-app" onclick="return goToEKearsipan();">Masuk Apllikasi&nbsp;&nbsp;&nbsp;<i class="fa fa-long-arrow-right"></i></button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <table class="table-data">
                            <thead>
                                <tr>
                                    <th width="5%">No.</th>
                                    <th>Laporan</th>
                                    <th>Tanggal</th>
                                    <th class="text-center">Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Epih  Ibkar Irmansyah, Ir</td>
                                    <td>2014-05-22</td>
                                    <td class="text-center"><a href="#popupLaporan"><i class="fa fa-share-square-o"></i></a></td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Cornell Adyas</td>
                                    <td>2014-06-02</td>
                                    <td class="text-center"><a href="#popupLaporan"><i class="fa fa-share-square-o"></i></a></td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Mohammad Luthfie, SE</td>
                                    <td>2014-07-12</td>
                                    <td class="text-center"><a href="#popupLaporan"><i class="fa fa-share-square-o"></i></a></td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Giat Ruchiat Jonie</td>
                                    <td>2014-08-01</td>
                                    <td class="text-center"><a href="#popupLaporan"><i class="fa fa-share-square-o"></i></a></td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Mimin Karmini</td>
                                    <td>2014-09-06</td>
                                    <td class="text-center"><a href="#popupLaporan"><i class="fa fa-share-square-o"></i></a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <div class="ct-chart chart-kearsipan" style="height: 350px"></div>
                    </div>
                </div>
            </div>
        </section> -->
        <!-- End e-Kearsipan -->

        <!-- Sistem Eksekutif -->
        <!-- <section id="sistem-eksekutif" class="table-and-graph">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <h1 class="color-red">Sistem Eksekutif</h1>
                        <p>Sistem Eksekutif DKPP</p>
                        <div class="garis-title"></div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-right">
                            <button class="button-go-app" onclick="return goToSistemEksekutif();">Masuk Apllikasi&nbsp;&nbsp;&nbsp;<i class="fa fa-long-arrow-right"></i></button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <table class="table-data">
                            <thead>
                                <tr>
                                    <th width="5%">No.</th>
                                    <th>Laporan</th>
                                    <th>Tanggal</th>
                                    <th class="text-center">Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Epih  Ibkar Irmansyah, Ir</td>
                                    <td>2014-05-22</td>
                                    <td class="text-center"><a href="#popupLaporan"><i class="fa fa-share-square-o"></i></a></td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Cornell Adyas</td>
                                    <td>2014-06-02</td>
                                    <td class="text-center"><a href="#popupLaporan"><i class="fa fa-share-square-o"></i></a></td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Mohammad Luthfie, SE</td>
                                    <td>2014-07-12</td>
                                    <td class="text-center"><a href="#popupLaporan"><i class="fa fa-share-square-o"></i></a></td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Giat Ruchiat Jonie</td>
                                    <td>2014-08-01</td>
                                    <td class="text-center"><a href="#popupLaporan"><i class="fa fa-share-square-o"></i></a></td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Mimin Karmini</td>
                                    <td>2014-09-06</td>
                                    <td class="text-center"><a href="#popupLaporan"><i class="fa fa-share-square-o"></i></a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <div class="ct-chart chart-sistem-eksekutif" style="height: 350px"></div>
                    </div>
                </div>
            </div>
        </section> -->
        <!-- End Sistem Eksekutif -->

        <footer>
            SIPEPP &copy;copyright <?php echo date('Y')?> | Dewan Kehormatan Penyelengara Pemilu Republik Indonesia
        </footer>

        <div id="login" class="dialog">
            <div class="dialog__overlay"></div>
            <div class="dialog__content">
                <div class="text-right">
                    <button class="action btn-close text-right" data-dialog-close><i class="fa fa-close"></i></button>
                </div>
                <h2><strong class="color-red">Login</strong>, SIPEPP</h2>
                <hr>
                <div class="form-login">
                    <form  action="<?php echo LOGIN_CHECK ?>" method="post">
                        <input type="text" class="input-text-login" name="username" placeholder="Username">
                        <input type="password" class="input-text-login" name="password" placeholder="Password">
                        <input type="hidden" class="input-text-login" name="flag" value="admin">
                        <button class="btn-login" type="submit">Login</button>
                    </form>
                </div>
            </div>
        </div>

<script type="text/javascript" src="<?php echo base_url()?>assets/front/js/classie.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/front/js/dialogFx.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/front/js/chartist.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/front/js/DKPP.js"></script>


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

  $('#graph_pgdhpa').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'Pengaduan Berdasarkan Hasil Penelitian Administrasi'
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
                    ['Memenuhi Syarat', <?php echo $graph_hasil_verifikasi_adm['hasil_penelitian']->memenuhi?>],
                    ['Tidak Memenuhi Syarat', <?php echo $graph_hasil_verifikasi_adm['hasil_penelitian']->tidak_memenuhi?>]
                ]
            }]
        });

        $('#graph_pgdhpa_verifikator').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Total Pengaduan Berdasarkan Verifikator'
        },
        subtitle: {
            text: 'Source: <a href="http://en.wikipedia.org/wiki/List_of_cities_proper_by_population">Wikipedia</a>'
        },
        exporting: {
                     enabled: false
            },
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Pengaduan'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: 'Total : <b>{point.y:.1f} Pengaduan</b>'
        },
        series: [{
            name: 'Total Pengaduan',
            data: [
              <?php 
                foreach( $graph_hasil_verifikasi_adm['verifikator'] as $vvr) :
                  echo '['."'".$vvr->fullname."'".', '.$vvr->total.'],';
                endforeach;
              ?>
            ],
            dataLabels: {
                enabled: true,
                rotation: -90,
                color: '#FFFFFF',
                align: 'right',
                format: '{point.y:.1f}', // one decimal
                y: 10, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });


    $('#graph_pgdpkj').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'Pengaduan Berdasarkan Hasil Rekomendasi Pengkaji'
        },
        subtitle: {
            text: 'Data dari tanggal <?php echo $this->tanggal->formatDate($graph_hasil_pengkajian['hasil_pengkajian']->min_date).' s/d '. $this->tanggal->formatDate($graph_hasil_pengkajian['hasil_pengkajian']->max_date);?>'
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
                <?php 
                  foreach( $graph_hasil_pengkajian['rekomendasi_pengkaji'] as $vvrp) :
                    echo '['."'".$vvrp->sv_name."'".', '.$vvrp->total.'],';
                  endforeach;
                ?>
            ]
        }]
    });

    /*$('#graph_pgdpkj_verifikator').highcharts({
    chart: {
        type: 'column'
    },
    title: {
        text: 'Total Pengaduan Berdasarkan Pengkaji Berkas Pengaduan'
    },
    subtitle: {
        text: 'Data dari tanggal <?php echo $this->tanggal->formatDate($graph_hasil_pengkajian['hasil_pengkajian']->min_date).' s/d '. $this->tanggal->formatDate($graph_hasil_pengkajian['hasil_pengkajian']->max_date);?>'
    },
    exporting: {
                 enabled: false
        },
    xAxis: {
        type: 'category',
        labels: {
            rotation: -45,
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Total Pengaduan'
        }
    },
    legend: {
        enabled: false
    },
    tooltip: {
        pointFormat: 'Population in 2008: <b>{point.y:.1f} millions</b>'
    },
    series: [{
        name: 'Population',
        data: [
          <?php 
            foreach( $graph_hasil_pengkajian['pengkaji'] as $vvr) :
              echo '['."'".$vvr->fullname."'".', '.$vvr->total.'],';
            endforeach;
          ?>
        ],
        dataLabels: {
            enabled: true,
            rotation: -90,
            color: '#FFFFFF',
            align: 'right',
            format: '{point.y:.1f}', // one decimal
            y: 10, // 10 pixels down from the top
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    }]
});
*/
$('#graph_phv').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'Pengaduan Berdasarkan Hasil Verifikasi Materil'
        },
        subtitle: {
            text: 'Data dari tanggal <?php echo $this->tanggal->formatDate($graph_hasil_vermat['vermat']->min_date).' s/d '. $this->tanggal->formatDate($graph_hasil_vermat['vermat']->max_date);?>'
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
                <?php 
                  foreach( $graph_hasil_vermat['hasil_vermat'] as $vvrp) :
                    echo '['."'".$vvrp->sv_name."'".', '.$vvrp->total.'],';
                  endforeach;
                ?>
            ]
        }]
    });


});  
</script>


    </body>
</html>