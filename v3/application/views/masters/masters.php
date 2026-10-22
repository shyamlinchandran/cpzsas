<?php foreach ($css_files as $file): ?>
    <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach ($js_files as $file): ?>
    <script src="<?php echo $file; ?>"></script>
<?php endforeach; ?> 
<input type="hidden" id="listsm" value="<?php echo $this->load->get_var('listurl'); ?>"/>
<input type="hidden" id="insert_primary_key"/>
<section class="content crmc"> 
    <div class="row crmc">
        <div class="col-xs-12 crmc"> 
            <div class="box box-primary crmc"> 
                <?php echo $output; ?> 
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section> 
<?php $url = str_replace(base_url(), "", current_url()); ?>
<script type="text/javascript">
    $(document).ready(function () {
        $.ajax({
            data: {'url': '<?php echo $url; ?>'},
            type: 'POST',
            dataType: 'json',
            url: '<?php echo base_url() . 'dashboard/getpermission'; ?>',
            success: function (result) { 
                if (result !== 'null' && result!==null) {
                    if (result.is_delete === '0') {
                        $('.btn-danger').remove()
                    }
                    if (result.is_write === '0') {
                        $('.btn-success').remove()
                    }
                    if (result.is_read === '0') {
                        $('.btn-info').remove()
                    }
                }
                $('.hidden').removeClass('hidden');
            }

        })
    })


</script>
