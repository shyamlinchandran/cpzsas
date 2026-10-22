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