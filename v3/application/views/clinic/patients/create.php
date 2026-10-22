<form method="post"  id="frmcreate" back="<?php echo site_url('clinic/Patients/listall'); ?>" action="<?php echo site_url('clinic/Patients/save'); ?>"  class="form-horizontal">
    <input type="hidden" value="<?= $id ?>" name="id" id="id" />
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo ucwords(str_replace('_', ' ', $title)) ?></h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('clinic/patients/listall/'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('clinic/patients/calendar/'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
                            </a>
                        </span>
                    </div> 
                    <div class="box-body">
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Name*<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="name" class="form-control" name="name" type="text" value="" data-validation="required" maxlength="50">              
                            </div> 
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Phone<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="phone" class="form-control" name="phone" type="text" value="" maxlength="50"></div> 
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Email<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="email" class="form-control" name="email" type="text" value="" maxlength="50"></div> 
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Gender<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <select name="gender" id="gender" class="form-control" >
                                    <option value="">Select</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div> 
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Date of Birth<span class="required"></span>  :
                            </label>
                            <div class="col-sm-2" id="name_input_box">
                                <input name="dob" type="text" id="dob"
                                       data-validation="required" class="form-control date"
                                       placeholder="Date">
                            </div> 
                            <div class="col-sm-2" id="name_input_box">
                                <input name="age" type="text" id="age" data-validation="required" class="form-control" placeholder="Age">
                            </div> 
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Blood Group<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <select name="bloodgrp" id="bloodgrp" class="form-control" >
                                    <option value="">Select</option>
                                </select>
                            </div> 
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Occupation<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="occupation" class="form-control" name="occupation" type="text" value="" maxlength="50">              
                            </div> 
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Referred by<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="reference" class="form-control" name="reference" type="text" value="" maxlength="50"></div> 
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Address*<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="address_line1" class="form-control" name="address_line1" type="text" value="" maxlength="50">              
                            </div> 
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Groups<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="pat_grp" class="form-control" name="pat_grp" type="text" maxlength="50">
                            </div> 
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Notes<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <textarea rows="4" cols="50" id="notes" name="notes" class="form-control"></textarea>
                                <!-- <input id="notes" class="form-control" name="notes" type="text" value="" maxlength="50">  --> 
                            </div> 
                            <!-- <label class="col-sm-2 control-label" id="name_display_as_box">
                                Family Member<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="fmly" class="form-control" name="fmly" type="text" value="" maxlength="50">             
                            </div>  -->
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Add Family Member<span class="required"></span>:
                            </label>
                            <div class="col-sm-9" id="name_input_box">
                                <table class="table">
                                    <tbody id="rowm">
                                        <tr id="add">
                                            <td class="col-sm-3">
                                                <select name="relation" id="relation" class="form-control">
                                                    <option value="Child">Child</option>
                                                    <option value="Parent">Parent</option>
                                                    <option value="Brother/Sister">Brother/Sister</option>
                                                    <option value="Husband/Wife">Husband/Wife</option>
                                                    <option value="Grandchild">Grandchild</option>
                                                    <option value="GrandParent">GrandParent</option>
                                                    <option value="Uncle/Aunt">Uncle/Aunt</option>
                                                    <option value="Nephew/Niece">Nephew/Niece</option>
                                                    <option value="Cousin">Cousin</option>
                                                </select>
                                            </td>
                                            <td class="col-sm-4">
                                                <input id="member_name" placeholder="Name" class="form-control" name="member_name" type="text">
                                                <input id="member_id" class="form-control" name="member_id" type="hidden">
                                            </td>
                                            <td class="col-sm-4">
                                                <input id="member_phone" placeholder="phone" class="form-control phone" name="member_phone" type="text" value="">
                                            </td>
                                            <td>
                                                <a data-toggle="tooltip" style="float: left"
                                                   title="Add More" id="addmore" class="btn btn-success"
                                                   href="#"> <span class="glyphicon glyphicon-plus"></span>
                                                </a>
                                            </td>
                                        </tr>
                                </table>
                            </div>
                            <div class="form-group" id="name_field_box">
                            </div> 
                            <div class="box-footer">
                                <?php if ($view != 'view') { ?>
                                    <button id="form-button-save"  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>         
                                <?php } ?>
                            </div>
                            <!-- /.box -->
                        </div>
                        <!-- /.col -->

                        <!-- /.row -->
                        </section>
                        <script type="text/javascript">

                            $(document).ready(function () {

                                load();
                                var id = $("#id").val();
                                var idinc = 0;
                                $('#addmore').click(function () {
                                    idinc = idinc + 1;
                                    var Rel_Id = document.getElementById('relation').value;
                                    var relativ = document.getElementById('member_name').value;
                                    var relativid = document.getElementById('member_id').value;
                                    var rphone = document.getElementById('member_phone').value;
                                    var reltype = $('#relation option:selected').text();
                                    newrow = '<tr><td ><input class="form-control"   value="' + reltype + ' "type="text" disabled><input   value="' + Rel_Id + ' "type="text" name="relatvid[' + idinc + ']" placeholder="' + Rel_Id + ' "   class="hidden deb form-control  cal debit two-digits"/></td>' +
                                            '<td ><input  class="form-control"    value="' + relativ + ' "type="text" disabled><input  value="' + relativid + '"  type="text" name="relativid[' + idinc + ']"  class="hidden cre form-control"/></td>' +
                                            '<td ><input  class="form-control"    value="' + rphone + ' "type="text" disabled><input  value="' + rphone + '"  type="text" name="rphone[' + idinc + ']" class="hidden cre form-control"/></td>' +
                                            '<td><span data-toggle="tooltip" title="Remove"   class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span>     </span></td></tr>';
                                    $("#rowm").append(newrow);
                                    $('#member_phone').val("");
                                    $('#member_name').val("");
                                    $('#member_id').val("");
                                });
                                $(document).on('click', ".remove", function () {
                                    $('.tooltip').remove();
                                    $(this).closest('tr').remove();
                                });
                            });
                            $.ajax({
                                url: "<?php echo site_url('clinic/patients/bloodgroup'); ?>",
                                success: function (result) {
                                    $('#bloodgrp').html(result);
                                }
                            });


                            var id = $("#id").val();
                            $.ajax({
                                url: "<?php echo site_url('clinic/patients/getrelations'); ?>/" + id,
                                success: function (result) {
                                    $.each(JSON.parse(result), function (i, itemsingle) {
                                        var Pat_Id = itemsingle.Pat_Id;
                                        var reltype = itemsingle.reltype;
                                        var relativ = itemsingle.relativ;
                                        var rphone = itemsingle.relphone;
                                        newrow = '<tr><td ><input class="form-control"   value="' + reltype + ' "type="text" disabled><input   value="' + reltype + ' "type="text" name="relatvid[' + idinc + ']" placeholder="' + reltype + ' "   class="hidden deb form-control  cal debit two-digits"/></td>' +
                                                '<td ><input  class="form-control"    value="' + relativ + ' "type="text" disabled><input  value="' + relativ + '"  type="text" name="relativ[' + idinc + ']"  style="width=100%"    class="hidden cre form-control" placeholder="name"/></td>' +
                                                '<td ><input  class="form-control"    value="' + rphone + ' "type="text" disabled><input  value="' + rphone + '"  type="text" name="rphone[' + idinc + ']"  style="width=100%"    class="hidden cre form-control" placeholder="phone"/></td>' +
                                                '<td><span data-toggle="tooltip" title="Remove"   class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span>     </span></td></tr>';
                                        $("#rowm").append(newrow);


                                    });
                                }
                            });
                            $("#member_name").autocomplete({
                                source: "<?php echo site_url('ajaxcall/Patient'); ?>",
                                minLength: 2,
                                select: function (event, ui) {
                                    loadCust(ui);
                                }
                            });
                            $("#dob").change(function (e) {
                                var today = new Date();
                                var bdate=$('#dob').val();
                                array = bdate.split('/');
                                var newDate = array[1] + "/" + array[0] + "/" + array[2];
                                var birthDate = new Date(newDate);
                                var age = today.getFullYear() - birthDate.getFullYear();
                                var m = today.getMonth() - birthDate.getDay();
//                                if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
//                                    age--;
//                                }
                                $('#age').val(age);
                            });
                            function DobtoAge(agesaved)
                            {
                                var today = new Date();
                                var bdate=$('#dob').val();
                                array = bdate.split('/');
                                var newDate = array[1] + "/" + array[0] + "/" + array[2];
                                var birthDate = new Date(newDate);
                                var age = today.getFullYear() - birthDate.getFullYear();
                                if(agesaved>age)
                                {
                                    age = agesaved;
                                }
                                var m = today.getMonth() - birthDate.getDay();
//                                if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
//                                    age--;
//                                }
                                $('#age').val(age);
                            }
                            function formatDate(input) {
                                var datePart = input.match(/\d+/g),
                                        year = datePart[0].substring(2), // get only two digits
                                        month = datePart[1], day = datePart[2];

                                return day + '/' + month + '/' + year;
                            }
                            var inc_inary = 0;
                            $(document).on('click', ".remove", function () {
                                $('.tooltip').remove();
                                $(this).closest('tr').remove();
                            });
                            var idinc = 0;
                            function loadCust(ui) {
                                $('#member_phone').val(ui.item.Pat_Phone);
                                $('#member_name').val(ui.item.Pat_Name);
                                $('#member_id').val(ui.item.Pat_Id);
                                //$('#cat').focus();
                            }
                            function load() {
                                var id = $("#id").val();
                                //alert(id);
                                if (id > 0) {
                                    $.ajax({
                                        url: "<?php echo site_url('clinic/patients/getsing'); ?>/" + id,
                                        success: function (results) {
                                            var result = JSON.parse(results);
                                            $("#name").val(result.Pat_Name);
                                            $("#email").val(result.Pat_Email);
                                            $("#phone").val(result.Pat_Phone);
                                            $("#gender").val(result.Pat_Gender);
                                            if (result.Pat_Dob != '0000-00-00') {
                                             $('#dob').val(formatDate(result.Pat_Dob));
                                             DobtoAge(result.Pat_Age);
                                            }
                                            //$("#age").val(result.Pat_Age);
                                            $("#occupation").val(result.Pat_Occupation);
                                            $("#bloodgrp").val(result.Pat_Blood);
                                            $("#address_line1").val(result.Pat_Address);
                                            $("#notes").val(result.Pat_Notes);
                                            $("#reference").val(result.Pat_Refered);
                                            $("#pat_grp").val(result.Pat_Groups);
                                        }
                                    });
                                }
                            }
                        </script>