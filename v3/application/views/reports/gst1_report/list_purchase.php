<style>
    .box-title {
        text-transform: capitalize;
    }
</style>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="<?= $this->box_color ?>">

                <div class="box-header">
                    <h3 class="box-title"><?php echo ucwords(str_replace('_', ' ', $titles)) ?></h3>
                    <a style="display: none;" tp="new" target="_blank" id="doc_download" href="<?php echo site_url('uploads/GSTR2export.xls'); ?>">2345</a>
                </div>
                <div class="box-body table-responsive">
                    <table class="table table-strippped table-condensed" cellspacing="0" width="100%">
                        <tbody>
                            <tr>
                                <td class="col-sm-2">
                                    Start Date
                                    <input type="text" class="form-control date" id="startdate" name="startdate" />
                                </td>

                                <td class="col-sm-2">
                                    End Date
                                    <input type="text" class="form-control date" id="enddate" name="enddate" />
                                </td>
                                <td>
                                    <?php $url = site_url('gstsample/GST1Report/action'); ?>
                                    <br>
                                    <button role="button" id="purchase_excell_add" name="purchase_excell_add" tp="new" target="_blank" class="btn  btn-success align-bottom" href="#">
                                        Get Excel

                                    </button>
                                    <!-- ?php echo $url ?> -->
                                    <!-- <button type="button"  id="excell_add" name="excell_add">Get Excel</button> -->
                                </td>
                                </form>

                            </tr>

                        </tbody>

                    </table>
                </div>

            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<script type="text/javascript">
    $(document).ready(function() {

        $('#purchase_excell_add').click(function(e) {

            startdate = $("#startdate").val();
            enddate = $("#enddate").val();
            $.ajax({
                type: 'POST',
                url: "<?php echo site_url('reports/GST1Report/action') ?>",
                data: {
                    startdate: startdate,
                    enddate: enddate,
                },
                success: function(str) {
                },
            }).done(function(data) {
              
                jQuery('#doc_download')[0].click();
               
            });

        });
    });

    
</script>