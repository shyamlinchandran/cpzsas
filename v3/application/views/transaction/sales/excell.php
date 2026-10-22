 <script src="<?php echo base_url(); ?>assets/js/jquery.min.js" type="text/javascript"></script>
  <script type="text/javascript">
            $(document).ready(function (e) {
                $('#upload').on('click', function () {
                    var file_data = $('#file').prop('files')[0];
                    var form_data = new FormData();
                    form_data.append('file', file_data);
                    $.ajax({
                        url: "<?php echo site_url($page.'/exceldataadd') ?>", // point to server-side controller method
                        dataType: 'text', // what to expect back from the server
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        type: 'post',
                        
                    });
                });
            });
            
        </script>
<form method="post" id="frmcreate" home="<?php echo site_url('dashboard/main'); ?>" back="<?php echo site_url($page.'/ExcelDataAdd'); ?>" action="<?php site_url($page.'/ExcelDataAdd'); ?>"  class="form-horizontal"> 
<?php
$pageurl = site_url($page.'/ExcelDataAdd');
$attributes = array('class' => 'form-horizontal', 'id' => 'frmcreate','home'=>$pageurl,'back'=>$pageurl);
echo form_open_multipart($page.'/ExcelDataAdd',$attributes);?> 
<?php
$attributes = array('class' => 'form-horizontal', 'id' => 'frmcreate','home'=>"<?php echo site_url('main/members/index'); ?>",'back'=>"<?php echo site_url($page.'/ExcelDataAdd'); ?>");
echo form_open_multipart($page.'/ExcelDataAdd',$attributes);?>   
<section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary"> 
                    <div class="box-header with-border">
                        <h3 class="box-title">Excel to database </h3>
                    </div>

                    <div class="box-body">
                        <table class="table table-striped table-condensed" >
                           <tr>
                                <td>
                                  <input type="file" name="file" />                                
                                  <input type="submit" value="upload" name="upload" />
                              </td>

                            </tr>
                        </table>
                    </form>
                    </div>
                </div>
            </div>
