<form method="post" id="frmcreate"  back="<?php echo site_url('transport/order/order'); ?>" action="<?php echo site_url('transport/order/order_savetwo'); ?>"  class="form-horizontal">
    <input type="hidden" name="pid" id="pid" value="<?= $id ?>" />
    <input type="hidden" name="pid_p" id="pid_p"/> 
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary"> 
                    <div class="box-header with-border">
                        <h3 class="box-title">Order</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-striped table-condensed" >
                            <tr>

                                <td>Date</td>
                                <td>Forworder</td> 
                                <td>Consignee</td>
                                <td>Consiner</td>

                            </tr>
                            <tr>

                                <td><input type="text"  data-validation="required"  name="ord_date"  id="ord_date"  class="form-control date col-lg-1" ></td>

                                <td>
                                    <select data-validation="required" name="forworder" id="forworder" class="form-control">
                                        <option value="">Select</option>
                                        <?php
                                        foreach ($fwdr as $fwd) {
                                            $selected = '';
                                            if ($id != '') {
                                                if ($pall['forwrd_id'] == $fwd['Id']) {
                                                    $selected = 'Selected ="Selected"';
                                                }
                                            }
                                            ?>
                                            <option <?= $selected ?> value="<?php echo $fwd['Id']; ?>"> <?php echo $fwd['Name']; ?></option>
                                        <?php } ?>
                                    </select></td>
                                <td><select data-validation="required" name="consignee"  id="consignee" class="form-control">
                                        <option value="">Select</option>
                                        <?php
                                        foreach ($consignee as $fwd) {
                                            $selected = '';
                                            if ($id != '') {
                                                if ($pall['consinee_id'] == $fwd['Id']) {
                                                    $selected = 'Selected ="Selected"';
                                                }
                                            }
                                            ?> 
                                            <option  <?= $selected ?> value="<?php echo $fwd['Id']; ?>"> <?php echo $fwd['Name'] . $fwd['Phone']; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td><select data-validation="required" name="consiner" id="consiner"   class="form-control">
                                        <option value="" class="form-control">Select</option>
                                        <?php
                                        foreach ($consigner as $fwd) {
                                            $selected = '';
                                            if ($id != '') {
                                                if ($pall['consignr_id'] == $fwd['Id']) {
                                                    $selected = 'Selected ="Selected"';
                                                }
                                            }
                                            ?>
                                            <option  <?= $selected ?>   value="<?php echo $fwd['Id']; ?>"> <?php echo $fwd['Name'] . $fwd['Phone']; ?></option>
                                        <?php } ?>
                                    </select>
                                </td> </tr>
                            <tr>
                                <td>Line</td>
                                <td>Transport</td>
                                <td> Details</td>  
                                <td>Container No</td>
                            </tr>

                            <tr> 
                                <td><select  data-validation="required" name="line"  id="line"    class="form-control">
                                        <option value="">Select</option>
                                        <?php
                                        foreach ($line as $fwd) {
                                            $selected = '';
                                            if ($id != '') {
                                                if ($pall['line_id'] == $fwd['Id']) {
                                                    $selected = 'Selected ="Selected"';
                                                }
                                            }
                                            ?>
                                            <option  <?= $selected ?>  value="<?php echo $fwd['Id']; ?>"> <?php echo $fwd['Name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td><select data-validation="required" name="transopter" id="transopter"   class="form-control">
                                        <option value="" class="form-control">Select</option>
                                        <?php
                                        foreach ($transopter as $fwd) {
                                            $selected = '';
                                            if ($id != '') {
                                                if ($pall['trspt_id'] == $fwd['id']) {
                                                    $selected = 'Selected ="Selected"';
                                                }
                                            }
                                            ?>
                                            <option  <?= $selected ?>   value="<?php echo $fwd['id']; ?>"> <?php echo $fwd['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td><input type="text"  data-validation="required"  name="dtls" value="<?php echo $pall['details']; ?>" id="dtls"   class="form-control" ></td>
                                <td><input  data-validation="required" type="text"  name="container" value="<?php echo $pall['contner_no']; ?>" id="container"  class="form-control"></td> 

                            </tr>
                            <tr> 
                                <td>Delivery Date</td>
                                <td>Vehicle</td>
                                <td>Driver</td>
                                <td>Remark</td>
                            </tr> 
                            <tr> 
                                <td><input type="text"  data-validation="required"  name="delvery_date"  id="delvery_date"  class="form-control date col-lg-1" ></td>
                                <td><input  data-validation="required" type="text"  name="vehicle" value="<?php echo $pall['vhicle']; ?>" id="vehicle"  class="form-control"></td>
                                <td><input  data-validation="required" type="text"  name="driver" value="<?php echo $pall['driver']; ?>"  id="driver"  class="form-control"></td>
                                <td><input  data-validation="required" type="text"  name="remark" value="<?php echo $pall['remarks']; ?>"  id="remark"  class="form-control"></td>
                            </tr>
                            <tr> 
                                <td>ETA </td>
                                <td><input  data-validation="required" type="text"  name="eta" value="<?php echo $pall['eta']; ?>" class="form-control" /></td>
                                <td>ETD</td>
                                <td><input  data-validation="required" type="text"  name="etd" value="<?php echo $pall['etd']; ?>" class="form-control" /></td>
                            </tr> 
                        </table>
                        <input type="submit"/>
                    </div>
                </div> 
            </div>
        </div> 
    </section>
</form>
<script type="text/javascript">

    function details() {
        var pid = $("#pid").val();
        if (pid !== '0') {
            $.ajax({
                url: "<?php echo site_url('transport/order/getcont'); ?>/" + pid,
                async: false,
                success: function (result) {
                    var itemsingle = JSON.parse(result);

                    $('#ord_date').val(itemsingle.odate);
                    $('#delvery_date').val(itemsingle.ddate);

                }
            });
        }
    }
    $(document).ready(function () {


        details();

    });

</script>