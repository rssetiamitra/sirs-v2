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

function hapus_file(a, b)

{

  if(b != 0){
    $.getJSON("<?php echo base_url('website/Tr_putusan/delete_file') ?>/" + b, '', function(data) {
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

document.getElementById("input_file"+counterfile).innerHTML = "<div id=\"file"+counternextfile+"\"><div class='form-group'><label class='control-label col-md-2'>Nama Lampiran</label><div class='col-md-2'><input type='text' name='pf_file_name[]' id='pf_file_name' class='form-control'></div><label class='control-label col-md-1'>File</label><div class='col-md-3'><input type='file' id='pf_file' name='pf_file[]' class='upload_file form-control' /></div><div class='col-md-1'><input type='button' onclick='hapus_file("+counternextfile+",0)' value='x' class='btn btn-sm btn-danger'/></div></div></div><div id=\"input_file"+counternextfile+"\"></div>";

counterfile++;

}
$(document).ready(function(){
  
    /*$('#form_posting').ajaxForm({

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
          $('#page-area-content').load('website/Tr_putusan?_=' + (new Date()).getTime());
        }else{
          $.achtung({message: jsonResponse.message, timeout:5});
        }
        achtungHideLoader();
      }

    }); */
})

</script>

<style type="text/css">
  .deleted_file{
    display: none;
  }
</style>
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
              <form class="form-horizontal" method="post" id="form_posting" action="<?php echo site_url('website/Tr_putusan/process')?>" enctype="multipart/form-data">
                <br>

                <div class="form-group">
                  <label class="control-label col-md-2">ID</label>
                  <div class="col-md-1">
                    <input name="id" id="id" value="<?php echo isset($value)?$value->wps_id:0?>" placeholder="Auto" class="form-control" type="text" readonly>
                  </div>
                  
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Kategori</label>
                  <div class="col-md-2">
                    <select name="wps_kategori" class="form-control">
                      <option value="">-Silahkan Pilih-</option>
                      <option value="1">Putusan</option>
                      <option value="2">Maklumat</option>
                      <option value="3">Undang-Undang</option>
                      <option value="4">Peraturan DKPP</option>
                      <option value="5">News Letter</option>
                      <option value="6">Lain-lain</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Judul</label>
                  <div class="col-md-4">
                    <input name="wps_title" id="wps_title" value="<?php echo isset($value)?$value->wps_title:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Sub Judul</label>
                  <div class="col-md-6">
                    <input name="wps_subtitle" id="wps_subtitle" value="<?php echo isset($value)?$value->wps_subtitle:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?>>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-2">Tanggal</label>
                  <div class="col-md-2">
                    <div class="input-group">
                      <input class="form-control date-picker" name="wps_tanggal" id="wps_tanggal" type="text" data-date-format="yyyy-mm-dd" <?php echo ($flag=='read')?'readonly':''?> value="<?php echo isset($value)?$value->wps_tanggal:date('Y-m-d')?>"/>
                      <span class="input-group-addon">
                        <i class="fa fa-calendar bigger-110"></i>
                      </span>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-2">Publish?</label>
                  <div class="col-md-2">
                    <div class="radio">
                          <label>
                            <input name="is_publish" type="radio" class="ace" value="Y" <?php echo isset($value) ? ($value->is_publish == 'Y') ? 'checked="checked"' : '' : 'checked="checked"'; ?> <?php echo ($flag=='read')?'readonly':''?> />
                            <span class="lbl"> Ya</span>
                          </label>
                          <label>
                            <input name="is_publish" type="radio" class="ace" value="N" <?php echo isset($value) ? ($value->is_publish == 'N') ? 'checked="checked"' : '' : ''; ?> <?php echo ($flag=='read')?'readonly':''?>/>
                            <span class="lbl">Tidak</span>
                          </label>
                    </div>
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
                  <label class="control-label col-md-2">File Lampiran</label>
                  <div class="col-md-4">
                    <input type="file" name="images" class="form-control" id="images">
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-2">Keterangan</label>
                  <div class="col-md-6">
                    <textarea name="wps_deskripsi" class="form-control" rows="10" style="height:150px !important"><?php echo isset($value->wps_deskripsi)?$value->wps_deskripsi:''?></textarea>
                  </div>
                </div>

                <!-- <div class="form-group">
                  <label class="control-label col-md-2">Nama Foto</label>
                  <div class="col-md-2">
                    <input name="pf_file_name[]" id="pf_file_name" class="form-control" type="text">
                  </div>
                  <label class="control-label col-md-1">File</label>
                  <div class="col-md-3">
                    <input type="file" id="pf_file" name="pf_file[]" class="upload_file form-control"/>
                  </div>
                  <div class ="col-md-1">
                    <input onClick="tambah_file()" value="+" type="button" class="btn btn-sm btn-info" />
                  </div>
                </div>

                <div id="input_file<?php echo $j;?>"></div>

                <div class="form-group">
                  <label class="control-label col-md-2">&nbsp;</label>
                  <div class="col-md-10">
                    <?php echo isset($attachment)?$attachment:''?>
                  </div>
                </div> -->


                <div class="form-actions center">

                  <!--hidden field-->
                  <input type="hidden" name="wm_id" value="3">

                  <a onclick="getMenu('website/Tr_putusan')" href="#" class="btn btn-sm btn-success">
                    <i class="ace-icon fa fa-arrow-left icon-on-right bigger-110"></i>
                    Kembali ke daftar
                  </a>
                  <?php if($flag != 'read'):?>
                  <button id="btnReset" class="btn btn-sm btn-danger">
                    <i class="ace-icon fa fa-close icon-on-right bigger-110"></i>
                    Reset
                  </button>
                  <button id="btnSave" name="submit" class="btn btn-sm btn-info">
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

<script src="<?php echo base_url()?>/assets/js/jquery-ui.custom.js"></script>
<script src="<?php echo base_url()?>/assets/js/jquery.ui.touch-punch.js"></script>
<script src="<?php echo base_url()?>/assets/js/markdown/markdown.js"></script>
<script src="<?php echo base_url()?>/assets/js/markdown/bootstrap-markdown.js"></script>
<script src="<?php echo base_url()?>/assets/js/jquery.hotkeys.js"></script>
<script src="<?php echo base_url()?>/assets/js/bootstrap-wysiwyg.js"></script>
<script src="<?php echo base_url()?>/assets/js/bootbox.js"></script>

<script type="text/javascript">
      jQuery(function($) {
        $('#editor').ace_wysiwyg({
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
        $('#form_posting').on('submit', function(){
          
          //put the editor's html content inside the hidden input to be sent to server
          
          $('#content').val($('#editor').html());

          var formData = new FormData($('#form_posting')[0]);
          /*formData.append('content', $('input[name=wysiwyg-value]' , this).val($('#editor').html()) ); */
          pf_file_name = new Array();
          pf_file = new Array();

           var formData = new FormData($('#form_posting')[0]);
           
            i=0;
           
            $("input#pf_file_name").each(function(){
           
                pf_file_name[i] = $(this).val();
                pf_file[i] = $('input[type=file]')[i].files[i];
                i++;
           
            })

            formData.append('pf_file', pf_file);
            formData.append('pf_file_name', pf_file_name);


          url = $('#form_posting').attr('action');

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
                      $('#page-area-content').load('website/Tr_putusan?_=' + (new Date()).getTime());
                    }else{
                      $.achtung({message: jsonResponse.message, timeout:5});
                    }
                    achtungHideLoader();
                  }
              });

          //but for now we will show it inside a modal box

          /*$('#modal-wysiwyg-editor').modal('show');
          $('#wysiwyg-editor-value').css({'width':'99%', 'height':'200px'}).val($('#editor').html());*/
          
          return false;
        });
        $('#form_posting').on('reset', function() {
          $('#editor').empty();
        });
      });

      

    </script>



