<style>
    .note-group-select-from-files {
        display: none;
    }
</style>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/summernote.css">
<form method="post"  id="frmcreate" back="<?php echo site_url('clinic/Medicine/listall'); ?>" action="<?php echo site_url('clinic/Medicine/save'); ?>"  class="form-horizontal">
    <input type="hidden" value = "<?= $id ?>" name="id" id="id" />
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">ADD/EDIT Medicine</h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('clinic/Medicine/listall'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('clinic/Medicine/listall'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
                            </a>
                        </span>
                    </div> 
                    <!--  <div class="box-body">
                         <div class="col-sm-12 form-group" id="name_field_box">
                            
                         </div>
                     </div> -->
                    <div class="box-body">
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Book :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <a href="../../../controllers/clinic/Medicine.php"></a>
                                <select  data-validation="required" id="book"  name="book" class="form-control" >
                                    <option value="">Select</option> 
                                </select>             
                            </div> 
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Body Part :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <select  data-validation="required" id="bodypart"  name="bodypart" class="form-control" >
                                    <option value="">Select</option> 
                                </select>             
                            </div> 

                            <div class="col-sm-4" id="name_input_box">

                            </div> 
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Medicine :
                            </label>
                            <div class="col-sm-10" id="name_input_box">
                                <textarea  name="textsummer" id="textsummer" class="summertext"></textarea>   
                            </div> 

                        </div>


                    </div>
                    <div class="box-body">
                        <div class="box-header with-border">
                            <h3 class="box-title">Select Symptoms</h3>

                        </div> 
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <div class="col-sm-6" id="name_input_box">
                                <table id="symptomtable" class="table table-condensed table-striped">
                                    <thead>
                                        <tr>
                                            <th class="col-sm-10">Symptoms</th>
                                            <th class="col-sm-1">Remove</th>
                                        </tr>
                                    <tbody id="rowm">

                                    </tbody>
                                    </thead>

                                </table>
                            </div>
                            <div class="col-sm-6" id="name_input_box">
                                <select id="tablefields"    style="font-size: 20px; line-height: 50px; width:400px !important;height: 200px !important " name="dummy" size="13" multiple="multiple" ondblclick="insertanswer(this)">
                                </select>
                            </div>


                        </div>
                    </div>

                    <div class="box-footer">
                        <button id="form-button-save"  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>     
                    </div>
                </div>

            </div>           <!-- /.col -->

        </div> <!-- /.row -->
    </section>

    <script  type="text/javascript" src="<?php echo base_url(); ?>assets/js/summernote.min.js"></script> 
    <script type="text/javascript">
                                    $(document).ready(function () {
                                        $.ajax({
                                            url: "<?php echo site_url('clinic/Medicine/book'); ?>",
                                            success: function (result) {
                                                $('#book').html(result);
                                            }
                                        });
                                        $.ajax({
                                            url: "<?php echo site_url('ajaxcall/bodypart'); ?>",
                                            success: function (result) {
                                                $('#bodypart').html(result);
                                                load();

                                            }
                                        });

                                        var mainary = [];
                                        var subary = [];

                                        $(".summertext").summernote({
                                            height: 300,
                                            placeholder: '',
                                            hint: {
                                                words: [],
                                                match: /\b(\w{1,})$/,
                                                search: function (keyword, callback) {
                                                    $.getJSON('<?php echo base_url(); ?>ajaxcall/items1/name?', {term: keyword}, function (result) {
                                                        $.each(result, function (i, field) {
                                                            mainary[i] = field;
                                                            subary[i] = field.name;
                                                        });

                                                        callback(subary);

                                                    });

                                                },
                                                content: function (item) {
                                                    var st = $.grep(mainary, function (items) {
                                                        var sm = items.name.indexOf(item) === 0;
                                                        return sm;
                                                    });
                                                    return $('<a href="' + st[0].name + '" class="mentionned mentioned-' + st[0].id + '">' + st[0].name + '</a>')[0];
                                                }
                                            }
                                        });

                                    });
                                    function insertanswer(btn) {
                                        // alert($( "#tablefields option:selected" ).val());
                                        var id = $("#tablefields option:selected").val();
                                        var text = $("#tablefields option:selected").text();
                                        addrow(id, text);
                                    }
                                    function addrow(id, text) {
                                        var singrow = '<td><input data-validation="required" value=' + id + ' type="hidden" name="answerid[]" id="answerid"/>' +
                                                '<input type="text"  class="col-sm-12 form-control" name="answer" disabled id="answer" value=' + text + ' >' +
                                                '<td class="col-sm-1"><span data-toggle="tooltip"   title="Remove" onclick="removeanswer(this)"  class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span>     </span></td>';
                                        var newrow = "<tr>" + singrow + "</tr>";
                                        $("#rowm").append(newrow);
                                    }
                                    function removeanswer(btn) {
                                        $(btn).closest('tr').remove();
                                    }

                                    $("#bodypart").change(function () {
                                        $("#tablefields").empty(); //this is the solution code
                                        var bodypart = $("#bodypart").val();
                                        $.ajax({
                                            url: "<?php echo site_url('ajaxcall/symptoms'); ?>/" + bodypart,
                                            success: function (result) {
                                                $('#tablefields').html(result);
                                            }
                                        });
                                    });
                                    function load() {
                                        var id = $("#id").val();
                                        if (id !== '0') {
                                            $.ajax({

                                                async: false,
                                                url: "<?php echo site_url('clinic/Medicine/Medicine'); ?>/" + id,
                                                success: function (result) {
                                                    $.each(JSON.parse(result), function (i, itemsingle) {
                                                        if (i < 1) {
                                                            $('#book').val(itemsingle.book_id);
                                                            $('#bodypart').val(itemsingle.part_id);

                                                            $('.summertext').summernote('code', itemsingle.details);

                                                            $.ajax({
                                                                url: "<?php echo site_url('ajaxcall/symptoms'); ?>/" + itemsingle.med_id,
                                                                success: function (result) {
                                                                    $('#tablefields').html(result);
                                                                }
                                                            });
                                                        }
                                                        addrow(itemsingle.symptom_id, itemsingle.symptom);
                                                    });
                                                }
                                            });
                                        }
                                    }

    </script> 
