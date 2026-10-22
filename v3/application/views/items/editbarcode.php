<?php $json = json_encode(array('id' => '0')); ?>
<form method="post" id="frmcreate"   home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('item/listall'); ?>" action="<?php echo site_url('item/savebarcode'); ?>"   class="form-horizontal">
    <input type="hidden" value="<?php echo $id; ?>" name="id" id="id"/> 
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary"> 
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Change Barcode', $this, $user) ?></h3>
                        <span class="pull-right"> <a role="button" class="btn  btn-success align-bottom"href="<?php echo site_url('item/listall'); ?>"> <span class="glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>
                    <div class="box-body">

                        <div class="col-sm-8">
                            <table class="table table-striped table-condensed col-sm-12">
                                <tr>
                                    <th style="text-align:center" colspan="12"><?= label('Change Barcode', $this, $user) ?></th>
                                </tr>
                                <tr>
                                    <td class="col-sm-6"><?= label('Item', $this, $user) ?></td>
                                    <td class="col-sm-2"> <?= label('Unit', $this, $user) ?></td>
                                    <td class="col-sm-2"><?= label('Barcode', $this, $user) ?></td>
                                    <td class="col-sm-2"><?= label('Rate', $this, $user) ?></td>
                                </tr>
                                <tbody id="rowm">

                                </tbody>

                            </table>


                        </div>



                    </div>  
                    <div class="box-footer">          
                        <button id="form-button-save"  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>           
                        <div class='small-loading' id='FormLoading'> </div>
                    </div>
                    <div class=" hidden">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                </div>

            </div> 
        </div>

    </section>
</form>
<script type="text/javascript">
    $(document).ready(function () {
        load();

    });

    function load() {
        var id = $('#id').val();
        if (id !== '0') {
            var item_name = '';
            $.ajax({
                url: "<?php echo site_url('item/getitembarcode'); ?>/" + id + "",
                success: function (results) {
                    $.each(JSON.parse(results), function (i, item) {
                        if (item.name !== '') {
                            item_name = item.name;
                        }
                        if (item.name === '') {
                            item.name = item_name;
                        }
                        addrow(item.sid, item.name, item.uid, item.unit, item.item_barcode, item.rate);
                    });
                }
            });
        }

    }
    function addrow(id, name, unit_id, unit, barcode, rate) {

        var singrow = ' <td class="col-sm-6"><input type="hidden" value=' + id + '  name="item_id[]" /><input value="' + name + '" readonly="readonly"  type="text"     class="form-control"/></td> <td class="col-sm-2"><input type="hidden" value=' + unit_id + '  name="unit_id[]" /><input type="text" value=' + unit + '  name="unit[]" readonly="readonly"   class="form-control"/></td> <td class="col-sm-2"><input type="text" value=' + barcode + '  name="barcode[]"    class="form-control"/></td><td class="col-sm-2"><input type="text" value=' + rate + '  name="rate[]"    class="form-control"/></td>';
        var newRow = "<tr>" + singrow + "</tr>";
        $("#rowm").append(newRow);
    }
</script>
