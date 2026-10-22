<?php $json = json_encode(array('id' => $details['id'])); ?>
<form method="post" id="frmcreate" home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('main/members/listall'); ?>" action="<?php echo site_url('main/members/save'); ?>"  class="form-horizontal">
    <input type="hidden" value="<?php echo $details['id'] ?>" name="id"/> 
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary"> 
                    <div class="box-header with-border">
                        <h3 class="box-title">Members Edit</h3>
                    </div>
                    <div class="box-body">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label  class="col-sm-2 control-label">Member</label>

                                <div class="col-sm-10">
                                    <input name="name" value="<?php echo $details['name'] ?>"  type="text" id="name" data-validation="length" data-validation-length="min2"   class="form-control" placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-sm-2 control-label">Phone</label>

                                <div class="col-sm-10">
                                    <input name="phone" data-validation-req-params='<?php echo $json ?>' type="text" value="<?php echo $details['phone'] ?>"  id="phone"  data-validation-url="<?php echo site_url('main/members/phone'); ?>"  data-validation="length,number,server " data-validation-length="10-13"   class="form-control"  placeholder="Phone"/>
                                </div>
                            </div>
                             <div class="form-group">
                                <label  class="col-sm-2 control-label">Date Of Birth</label>

                                <div class="col-sm-10">
                                    <input name="dob" type="text"   id="dob"    class="form-control date"  placeholder="DOB"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-sm-2 control-label">Member Category</label>

                                <div class="col-sm-10">
                                    <select name="membercategory" data-validation="required"  data-validation="required"  class="form-control" >
                                        <option value="">Select</option>
                                        <?php foreach ($membercategory as $type) { ?>
                                            <option value="<?php echo $type['id']; ?>"><?php echo $type['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-sm-2 control-label">Permanent Address</label>

                                <div class="col-sm-10">
                                    <textarea class="form-control" data-validation="length" data-validation-length="min5"  id="address_line1" name="address_line1"><?php echo $details['address_line1'] ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label  class="col-sm-2 control-label">Email</label>

                                <div class="col-sm-10"> 
                                    <input name="email" data-validation-req-params='<?php echo $json ?>' type="text" data-validation="length,server, email"  data-validation-url="<?php echo site_url('main/members/email'); ?>" data-validation-length="min2" value="<?php echo $details['email'] ?>"   name="email" id="email"  class="form-control"  placeholder="Email"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-sm-2 control-label">Present Address</label>

                                <div class="col-sm-10">
                                    <textarea class="form-control" data-validation="length" data-validation-length="min5"  id="address_line2"  name="address_line2"><?php echo $details['address_line2'] ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-sm-2 control-label">Details</label>

                                <div class="col-sm-10">
                                    <textarea class="form-control" id="details"    name="details"><?php echo $details['details'] ?></textarea>
                                </div>
                            </div>

                        </div> 

                        <table class="table table-striped table-condensed" >
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Member Type</th>
                                    <th>Member Type</th>
                                    <th>
                                        <a data-toggle="tooltip"   title="Add More" id="addmore"  class="btn btn-default" href="#">
                                            <span class="glyphicon glyphicon-plus"></span> 
                                        </a>
                                    </th>
                                </tr>

                            </thead>
                            <tbody id="rowm">
                                <?php $id = 0;
                                foreach ($family as $fm) { ?>
                                    <tr <?php if ($id == 0) { ?> id="add" <?php } ?> >
                                        <td> <input value="<?php echo $fm['name'] ?>" data-validation="length" data-validation-length="min2"   name="pname[]"  type="text"    class="form-control" placeholder="Name"/></td>
                                        <td><input  type="text" name="pphone[]" value="<?php echo $fm['phone'] ?>"    class="form-control" placeholder="Phone"/></td>
                                        <td><input name="pemail[]" value="<?php echo $fm['email'] ?>" type="text" data-validation="email"  data-validation-optional="true"    class="form-control" placeholder="Email"/></td>
                                        <td><select name="membertype[]"  data-validation="required"  class="form-control" >
                                                <option value="">Select</option>
                                                <?php foreach ($membertype as $type) { ?>
                                                    <option value="<?php echo $type['id']; ?>" <?php if ($type['id'] == $fm['member_type_id']) { ?>selected="selected"  <?php } ?>  ><?php echo $type['name']; ?></option>
    <?php } ?>
                                            </select>
                                        </td> 
                                        <td>
                                            <textarea class="form-control" name ="ddetails[]"> <?php echo $fm['details'] ?> </textarea>
                                        </td>
                                        <td>
                                            <span data-toggle="tooltip"   title="Remove"   class="btn btn-danger remove" href="#">
                                                <span class="glyphicon glyphicon-remove-sign"></span> 
                                            </span>
                                        </td>

                                    </tr>
<?php } ?>
                            </tbody>
                        </table>

                    </div>

                    <div class="box-footer">          
                        <button id="form-button-save" type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>           
                        <a role='button' data-toggle="tooltip"   title='Save and back to listing' class='btn btn-info' id="save-and-go-back-button"> <i class="glyphicon glyphicon-hdd"></i> </a> 

                        <div class='small-loading' id='FormLoading'> </div>

                    </div>
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
</form>
<script type="text/javascript">
    $.validate({
        modules: 'date, security,file'
    });
    $(document).ready(function () {
        $('#addmore').click(function () {
            var row = $("#add").html();
            var newRow = "<tr>" + row + "</tr>";
            $("#rowm").append(newRow);
            $(".hidden").removeClass("hidden");
            $(".remove").first().addClass("hidden");

        });
        $(".remove").first().addClass("hidden");
    })
    $(document).on('click', ".remove", function () {
        $('.tooltip').remove();
        $(this).closest('tr').remove();
    });
    function remove() {

    }
</script>