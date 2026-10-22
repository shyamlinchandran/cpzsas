<?php ?> 
<form method="post"  id="frmcreate" back="<?php echo site_url('transaction/Purchase/listall/order'); ?>" action="<?php echo site_url('transaction/Purchase/order_email'); ?>"  class="form-horizontal">

    <input type="hidden" value="<?= $id ?>" name="id" id="id" />
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Mail Purchase Order', $this, $user) ?> </h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('transaction/Purchase/listall/order'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('transaction/Purchase/listall/order'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
                            </a>
                        </span>
                    </div> 
                    <div class="box-body tableBodyScroll">
                        <div class="col-sm-12">
                            <div class="col-sm-6">
                                <div class="box-body no-padding">
                                    <table class="table ">
                                        <tr>
                                            <th><?= label('SNo', $this, $user) ?></th>
                                            <th><?= label('Item Name', $this, $user) ?></th>
                                            <th><?= label('Quantity', $this, $user) ?></th>
                                        </tr>
                                        <tbody id="addrow">

                                        </tbody>  

                                    </table>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="col-sm-4 control-label" id="name_display_as_box">
                                    Select Suppliers:
                                </label>
                                <div class="col-sm-8" id="name_input_box">
                                    <input type="text" NoTab="true"  class="form-control" id="supname" name="supname">            
                                </div> 
                                <p>&nbsp;<br /></p>
                            </div>
                            <div class="col-sm-6">
                                <div class="box-body no-padding">
                                    <table class="table ">
                                        <tr>
                                            <td style="text-align: center;font-size: 20px;" colspan="2">Selected Suppliers</td>
                                        </tr>
                                        <tbody id="addsup">

                                        </tbody>  

                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- /.box -->
                    </div>
                    <div class="box-footer" class="col-sm-12">
                        <button id="form-button-save"  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-print'> <i class="glyphicon glyphicon-envelope	
                                                                                                                                              "></i> </button>         
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col -->

        <!-- /.row -->
    </section>
    <script type="text/javascript">

        $(document).ready(function () {
            $("#supname").autocomplete({
                source: "<?php echo site_url('ajaxcall/suppliers'); ?>",
                minLength: 2,
                select: function (event, ui) {
                    addsup(ui.item.id, ui.item.name, ui.item.email);
                    this.value = "";
                    return false;
                }
            });
            load();

        });
        function addsup(id, name, email) {
            clear();

            var singrow = '<td><input data-validation="required" value=' + id + ' type="hidden" name="sup_id[]" id="sup_id"/><input data-validation="required" value="' + name + '" type="hidden" name="sup_name[]" id="sup_name"/>' +
                    '  ' + name + ' </td>' + '<input type="hidden" value="' + email + '" id="mailid" name="mailid[]">' +
                    '<td class="col-sm-1"><span data-toggle="tooltip"   title="Remove" onclick="removesupplier(this)"  class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span>     </span></td>';
            var newrow = "<tr>" + singrow + "</tr>";
            $("#addsup").append(newrow);
        }
        function removesupplier(btn) {
            $(btn).closest('tr').remove();
        }
        function clear() {
            $("#supname").val('');
        }
        function additem(idinc, name, quantity) {
            var singrow = '<td>' + idinc + '</td><td>' + name + '</td><td>' + quantity + '</td>';
            var newrow = '<tr>' + singrow + '</tr>';
            $("#addrow").append(newrow);
        }

        function load() {
            var id = $('#id').val();
            var idinc = 1;
            $.ajax({
                url: "<?php echo site_url('ajaxcall/purchase'); ?>/" + id,
                success: function (result) {
                    $.each(JSON.parse(result), function (i, itemsingle) {

                        additem(idinc, itemsingle.name, itemsingle.quantity);
                        idinc = idinc + 1;
                    });

                }
            });
        }



    </script> 
