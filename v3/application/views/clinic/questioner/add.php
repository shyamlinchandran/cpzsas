
<form method="post"  id="frmcreate" back="<?php echo site_url('clinic/Questioner/listall'); ?>" action="<?php echo site_url('clinic/Questioner/save'); ?>"  class="form-horizontal">
    <input type="hidden" value = "<?= $id ?>" name="id" id="id" />
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">ADD/EDIT Questioner</h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('clinic/Questioner/listall'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('clinic/Questioner/listall'); ?>">
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
                            <label class="col-sm-1 control-label" id="name_display_as_box">
                                Question :
                            </label>
                            <div class="col-sm-6" id="name_input_box">
                               <textarea rows="6" cols="50" style="width:500px !important;height: 100px !important " id="questione" name="questione"></textarea>          
                            </div> 
                             <label class="col-sm-2 control-label" id="name_display_as_box">
                                Body Part :
                            </label>
                            <div class="col-sm-3" id="name_input_box">
                                <select  data-validation="required" id="bodypart"  name="bodypart" class="form-control" >
                                <option value="">Select</option> 
                                </select>             
                            </div> 
                        </div>
                    </div>
                     <div class="box-body">
                        <div class="box-header with-border">
                        <h3 class="box-title">Select Your Answer</h3>
                       
                       </div> 
                        <div class="col-sm-12 form-group" id="name_field_box">
                             <div class="col-sm-7" id="name_input_box">
                                    <table id="answerTable" class="table table-condensed table-striped">
                                        <thead>
                                            <tr>
                                                <th class="col-sm-10">Answers</th>
                                                <th class="col-sm-2">Remove</th>
                                            </tr>
                                              <tbody id="rowm">

                                             </tbody>
                                        </thead>

                                    </table>
                            </div>
                            <div class="col-sm-5" id="name_input_box">
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
<script type="text/javascript">

    $(document).ready(function () {
    $.ajax({
        url: "<?php echo site_url('ajaxcall/bodypart'); ?>",
        success: function (result) {
            $('#bodypart').html(result);
        }
    });
            load();
    });
    function insertanswer(btn) {
            // alert($( "#tablefields option:selected" ).val());
            var id=$( "#tablefields option:selected" ).val();
            var text =$( "#tablefields option:selected" ).text();
            addrow(id,text);
    }
    function addrow(id,text){
        var singrow ='<td class="col-sm-10"><input data-validation="required" value=' + id + ' type="hidden" name="answerid[]" id="answerid"/>'+
        '<input type="text" name="answer" disabled id="answer" value=' + text + ' >'+
         '<td class="col-sm-2"><span data-toggle="tooltip"   title="Remove" onclick="removeanswer(this)"  class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span>     </span></td>';
        var newrow = "<tr>" + singrow + "</tr>"; 

        $("#rowm").append(newrow);
    }
    function removeanswer(btn) {
         $(btn).closest('tr').remove();
     }

      $("#bodypart").change(function () {
        $("#tablefields").empty();  //this is the solution code
        var bodypart = $("#bodypart").val();
         $.ajax({
        url: "<?php echo site_url('ajaxcall/symptoms'); ?>/" + bodypart,
        success: function (result) {
            $('#tablefields').html(result);
        }
       });
        
    });

    function load(){
        var id = $("#id").val();
        if(id !=='0'){
             $.ajax({
                url: "<?php echo site_url('clinic/Questioner/getquestion'); ?>/" + id,
                success: function (result) {
                    $.each(JSON.parse(result), function (i, itemsingle) {
                        if(i<1){
                            $('#bodypart').val(itemsingle.que_part_id);
                            $('#questione').val(itemsingle.question);
                                 $.ajax({
                                 url: "<?php echo site_url('ajaxcall/symptoms'); ?>/" + itemsingle.que_part_id,
                                 success: function (result) {
                                 $('#tablefields').html(result);
                                  }
                                });
                        }
                       addrow(itemsingle.sid,itemsingle.symptom);
                    });
                }
            });

        }
    }

 </script> 