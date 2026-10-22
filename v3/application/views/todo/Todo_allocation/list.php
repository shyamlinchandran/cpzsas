<?php
$add_url = site_url('todo/Todo_allocation/create');
?>
<input type="hidden" value="<?php echo $settings[0]['crm_type']; ?>" name="crmtype" id="crmtype" />

<style>
    .box-title {
        text-transform: capitalize;
    }

    * {
        padding: 0;
        margin: 0;
    }

    .float {
        position: fixed;
        width: 150px;
        height: 150px;
        bottom: 40px;
        right: 40px;
        background-color: #fffdd0 ;
        color: #FFF;
        border-radius: 5px;
        text-align: center;
        box-shadow: 2px 2px 3px #999;
    }

    .my-float {
        margin-left: 130px;
        color: red;
    }
</style>
<div class="modal fade" id="myFollowupModal">
    <form method="post" id="frmcreate" back="<?php echo site_url('todo/Todo_allocation/list_all'); ?>" action=" <?php echo site_url('todo/Todo_allocation/completion'); ?>" home="<?php echo site_url('main/members/index'); ?>">
        <input type="hidden" id="followup_id" name="followup_id">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?= label('Complete Task', $this, $user) ?></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="container">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="">
                                <?= label('Date', $this, $user) ?>
                                <input type="text" name="date" id="date" class="form-control date">
                            </div>
                            <div class="">
                                <?= label('Status', $this, $user) ?>
                                <select name="statt" id="statt" class="form-control">
                                    <option value='1'>Approve</option>
                                    <option value='0'>Reject</option>
                                </select>
                            </div>
                            <div class="">
                                <?= label('Remarks*', $this, $user) ?>
                                <textarea name="remark" id="remark" data-validation="required" class="form-control"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal"><?= label('Close*', $this, $user) ?></button>
                                <button type="submit" id="sv" class="btn btn-primary"><?= label('Save*', $this, $user) ?>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="myTodoModal">
    <div>
        <form method="post" id="frmcreatemodelc" back="<?php echo site_url('todo/Todo_allocation/list_all'); ?>" action="<?php echo site_url('todo/Todo_allocation/save'); ?>" class="form-horizontal">
            <input type="hidden" value="<?php echo $id; ?>" id="id" name="id">
            <input type="hidden" value="<?php echo $option; ?>" id="option" name="option">
            <section class="content">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?= label('Create Task', $this, $user) ?></h3>
                        </div>
                        <input type="hidden" name="invoice" id='invoice' />
                        <div class="box-body">

                            <div class="" style="height:60px">
                                <?= label('Date', $this, $user) ?> <span class="required"></span> :
                                <input tabIndex="1" name="date" id="date" type="text" class="form-control date">
                            </div>
                            <div class="" style="height:60px">
                                <?= label('User: ', $this, $user) ?>
                                <select tabIndex="11" name="user" id="userzz" class="form-control">
                                </select>
                            </div>
                            <div class="" style="height:60px">
                                <?= label('Status', $this, $user) ?> <span class="required"></span> :
                                <select tabIndex="11" name="stat" id="stat" class="form-control">
                                </select>
                            </div>
                            <div class="" style="height:60px">
                                <?= label('Task', $this, $user) ?>
                                <textarea class="form-control" name="task" id="task"></textarea>
                            </div>
                            <br>
                            <div class="box-footer" id="foot">
                                <button id="btnsaved" type='submit' id="btn_sub" data-toggle="tooltip" title='Save' class='btn bg-success btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>
                                <button id="btnclose" type='button' id="btn_sub" data-toggle="tooltip" title='Save' class='btn bg-info btn-flat'> Close </button>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
            </section>
        </form>
    </div>
</div>
<form method="post" id="allocForm" back="<?php echo site_url('todo/Todo_allocation/list_all'); ?>" action="<?php echo site_url('todo/todo_allocation/save_todo_allocation'); ?>" home="<?php echo site_url('main/members/index'); ?>">
    <input type="hidden" value="" name="isbulk" id="isbulk" />
    <input type="hidden" value="<?php echo $usertype ?>" name="usertype" id="usertype" />
    <input type="hidden" value="<?php echo $datenow; ?>" name="datenow" id="datenow" />

    <section class="content">


        <div class="row">
            <div class="col-xs-12">
                <div class="<?=$this->box_color?>">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Todo Master', $this, $user) ?></h3>
                        <span class="pull-right">
                            <a role="button" id="addbutton" back="<?php echo site_url('crm_general/Enquiry_allocation/list_all'); ?>" class="btn  btn-success align-bottom" href="#">
                                <span class="glyphicon glyphicon-plus"></span>
                            </a>
                        </span>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table no-border" cellspacing="0" width="100%">
                            <tr class="col-sm-12" style="display:inline">
                                <th class="col-sm-4">


                                </th>

                            </tr>
                        </table>
                        <table id="table" class="table <?=$this->table_color?> table-responsive" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" class="selectall" name="check" value="' . $items->id . '"> &nbsp; <?= label('SNo', $this, $user) ?></th>
                                    <th><?= label('Date', $this, $user) ?></th>
                                    <th id="qualify"><?= label('Task', $this, $user) ?></th>
                                    <th id="name"><?= label('Status', $this, $user) ?></th>
                                    <th id="phone"><?= label('User', $this, $user) ?></th>
                                    <th id="phone"><?= label('Allocated to', $this, $user) ?></th>
                                    <th><?= label('Action', $this, $user) ?></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>

</form>

<div class="card float">
    <i class="fa fa-plus my-float" id = "closepopup"></i>  
    <div class = "card-header">
        <span style = "color:green">Work Pending</span><br>
    </div>
    <div class = "card-body">
    <span style = "color:green"><br>Your Word is pending. Check your todo now!!</span>
    </div>
</div>




<script type="text/javascript">
    setStatus();
    setUser();
    var table;
    varid = 0;
    $('.selectall').click(function() {
        if ($(this).is(':checked')) {
            $('input:checkbox').prop('checked', true);
        } else {
            $('input:checkbox').prop('checked', false);
        }
    });

    $('#addbutton').click(function() {
        $('#foot').show();
        $('#myTodoModal').modal('show');
    });
    $('#btn_sub').click(function() {
        $('#myTodoModal').modal('hide');
    });
    $('#btnclose').click(function() {
        $('#myTodoModal').modal('hide');
    });
    $(document).on('click', '.editmod', function() {
        $id = $(this).attr('id');
        $('#id').val($id);
        load();
    });
    $(document).on('click', '.viewmod', function() {
        $id = $(this).attr('id');
        $('#id').val($id);
        $('#foot').hide();
        load();
    });


    function load() {
        var id = $('#id').val();
        if (id != 0) {
            $.ajax({
                url: "<?php echo site_url('todo/Todo_allocation/getdata'); ?>/" + id,
                success: function(results) {
                    var result = JSON.parse(results);

                    $("#date").val(formatDate(result.date));
                    setStatus(result.status);
                    setUser(result.user);
                    $("#task").val(result.task);
                }
            });
        }


    }

    $(document).ready(function() {



        $('#allo_btn').click(function() {
            var formId = '#allocForm';
            var isValid = $(formId).isValid();
            if (isValid) {
                $('#allo_btn').submit();
                //    var formData = $(formId).serialize();
                //    $.ajax({
                //     url:$(formId).attr('action'),
                //     type : "POST",
                //     data : formData,
                //     success:function(response){

                //     }
                //   });
                $(document).on("click", "#allo_btn", function() {
                    $('#myEnquiryModal').modal('hide');
                });
            } else {
                $('#changess').val('Please fill the required fields');
                $('#myWarning').modal('show');
            }


        });
        var crmtype = $('#crmtype').val()

        if (crmtype == 'COURSE_CRM') {
            $('#amount').hide();
        }


        $('#deletes').click(function() {
            if (!$('input.enquiry:checkbox:checked').val()) {
                $('#changess').val('Nothing to Delete');
                $('#myWarning').modal('show');
            } else {
                $('#myConfirm').modal('show');
                $('#delConf').click(function() {
                    var text = "";
                    $('input.enquiry:checkbox:checked').each(function() {
                        if (text === "") {
                            text = $(this).val();
                        } else {
                            text = text + ',' + $(this).val();
                        }
                    });
                    if (text != "") {
                        $.ajax({
                            url: "<?php echo site_url('crm_general/Enquiry_allocation/deleteEnq'); ?>/",
                            type: "POST",
                            data: {
                                text: text
                            },
                            success: function(response) {}
                        });
                    }
                });


            }


        });

        $('.datepicker').datepicker({
            autoclose: true,
        })

        var crmtype = $("#crmtype").val();

        if (crmtype == "COURSE_CRM") {
            $("#qualify").text("Qualification");
            $("#name").text("Full Name");
            $("#phone").text("Phone");
        }

        $.ajax({
            url: "<?php echo site_url('crm_general/Enquiry_register/user'); ?>",
            success: function(result) {
                $('#user').html(result);
            }
        });

        $(document).on("click", "#clos_btn", function() {
            $('#myClosureModal').modal('hide');
        });
        $(document).on("click", ".test", function() {
            $('#isbulk').val(0);
            var id = $(this).attr('id');



            $('#myEnquiryModal').modal('show');
            var allocate_id = $(this).attr('id');
            var date = $(this).attr('date');
            $('#Sdate').val(formatDate(date));
            dates = $('#datenow').val()
            $('#Edate').val(formatDate(dates));
            $('#allocate_id').val(allocate_id);
        });

        // $(document).on("click", "#cclose", function() {
        //     dates = $('#datenow').val();
        //     $('#dates').val(formatDate(dates));
        // });

        $('#Ddate').change(function() {


        });



        $(document).on("click", "#allo", function() {
            $('#isbulk').val(1);
            if (!$('input.enquiry:checkbox:checked').val()) {
                $('#changess').val('Nothing to allocate');
                $('#myWarning').modal('show');
            } else {

                $('#myEnquiryModal').modal('show');
                var allocate_id = $(this).attr('id');
                dates = $('#datenow').val();
                $('#Sdate').val(formatDate(dates));
                $('#Edate').val(formatDate(dates));
                $('#allocate_id').val(allocate_id);
            }

        });

        $(document).on("click", ".followup", function() {
            $('#myFollowupModal').modal('show');
            var followup_id = $(this).attr('id');
            // alert(followup_id);
            $('#followup_id').val(followup_id);
        });

        $(document).on("click", "#sv", function() {
            $('#myFollowupModal').modal('hide');
        });


        $(document).on("click", ".closure", function() {
            var var_id = $(this).attr('var_id');
            $('#var_id').val(var_id);
            table.ajax.reload(null, false);
            $('#myClosureModal').modal('show');
            var closure_id = $(this).attr('idss');
            $('#closure_id').val(closure_id);

        });


        //datatables
        table = $('#table').DataTable({
            "language": lan,
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "scrollX": true,
            "lengthMenu": [
                [10, 25, 50, 100],
                [10, 25, 50, 100]
            ],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            'buttons': [],
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('todo/Todo_allocation/ajax_list') ?>",
                "type": "POST",
                "data": function(data) {}
            },
            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [0], //first column / numbering column
                "orderable": false //set not orderable
            }]

        });

        $('#btn-filter').click(function() { //button filter event click
            table.ajax.reload(null, false); //just reload table
        });
        $('#btn-reset').click(function() { //button reset event click
            table.ajax.reload(null, false); //just reload table
        });
        $('#delConf').click(function() {
            setTimeout(function() {
                table.ajax.reload(null, false);
            }, 250);

        });
    });

    function setUser(logged = 0) {

        var text = "";
        $.ajax({

            url: "<?php echo site_url('crm_general/Enquiry_register/users'); ?>",
            success: function(results) {
                text = '<option value = "">Select</option>';
                $.each(JSON.parse(results), function(i, items) {
                    if (items.Id == logged) {
                        text = text + '<option selected = "selected" value = "' + items.Id + '">' + items.user_name + '</option>';
                    } else {
                        text = text + '<option value = "' + items.Id + '">' + items.user_name + '</option>';
                    }

                    $('#userzz').html(text);

                });


            }
        });
    }

    function setStatus(statuss = 0) {

        var text = "";
        $.ajax({

            url: "<?php echo site_url('todo/Todo_allocation/getStatus'); ?>",
            success: function(results) {
                $.each(JSON.parse(results), function(i, items) {
                    if (items.id == statuss) {
                        text = text + '<option selected = "selected" value = "' + items.id + '">' + items.status + '</option>';
                    } else {
                        text = text + '<option value = "' + items.id + '">' + items.status + '</option>';
                    }

                    $('#stat').html(text);

                });


            }
        });
    }

    function formatDate(input) {
        var datePart = input.match(/\d+/g),
            year = datePart[0], // get only two digits
            month = datePart[1],
            day = datePart[2];

        return day + '/' + month + '/' + year;
    }
</script>

<script type="text/javascript">
    var now = new Date();
    var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();

    $(document).on("click", ".closure", function() {
        // setTimeout(function() {
        var table = $('#tablenot').DataTable();
        table.destroy();
        var id = $('#id').val();
        var table = $('#tablenot').DataTable({
            "language": lan,
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "scrollX": false,
            "lengthMenu": [
                [10, 25, 50, 100],
                [10, 25, 50, 100]
            ],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "buttons": [{
                    extend: 'excelHtml5',
                    className: 'btn bg-navy',
                    filename: 'Followups' + jsDate,
                    text: '<i class="fa fa-file-excel-o"></i>',
                    messageTop: "Printed Date-  " + jsDate,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    },
                    titleAttr: 'Excel',
                    action: newexportaction,
                    customize: function(xlsx) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];
                        $('c[r=A1] t', sheet).text(company + " - " + 'Followups');
                        $('c[r=A2] t', sheet).text("");
                    }
                },
                {
                    text: '<i class="fa fa-file-pdf-o"></i>',
                    extend: 'pdfHtml5',
                    title: "dsads",
                    className: 'btn bg-olive',
                    filename: 'Followups' + jsDate,
                    messageTop: "Printed Date-  " + jsDate,
                    pageSize: 'A4', //A3 , A5 , A6 , legal , letter
                    action: newexportaction,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4],
                        search: 'applied',
                        order: 'applied'
                    },
                    customize: function(doc) {
                        //Remove the title created by datatTables
                        doc.content.splice(0, 1);
                        doc.content[0].text = "Followups";
                        //Create a date string that we use in the footer. Format is dd-mm-yyyy

                        // Logo converted to base64
                        // var logo = getBase64FromImageUrl('https://datatables.net/media/images/logo.png');
                        // The above call should work, but not when called from codepen.io
                        // So we use a online converter and paste the string in.
                        // Done on http://codebeautify.org/image-to-base64-converter
                        // It's a LONG string scroll down to see the rest of the code !!!

                        //  doc.pageMargins = [20, 60, 20, 30];
                        // Set the font size fot the entire document
                        doc.defaultStyle.fontSize = 9;
                        // Set the fontsize for the table header
                        doc.styles.tableHeader.fontSize = 9;
                        // Create a header object with 3 columns
                        // Left side: Logo
                        // Middle: brandname
                        // Right side: A document title
                        doc['header'] = (function() {
                            return {
                                columns: [{
                                    alignment: 'center',
                                    //italics: true,
                                    text: company + " - " + 'Followups',
                                    fontSize: 14,
                                    margin: [10, 0]
                                }],
                                margin: 20
                            }
                        });
                        /*for (var i = 1; i < doc.content[1].table.body.length; i++) {
                         doc.content[1].table.body[i][4].alignment = 'right';
                         doc.content[1].table.body[i][0].alignment = 'center';
                         doc.content[1].table.body[i][1].alignment = 'center';
                         }*/
                        // Create a footer object with 2 columns
                        // Left side: report creation date
                        // Right side: current page and total pages
                        doc['footer'] = (function(page, pages) {
                            return {
                                columns: [{
                                        alignment: 'left',
                                        text: ['Created on: ', {
                                            text: jsDate.toString()
                                        }]
                                    },
                                    {
                                        alignment: 'center',
                                        text: ['Signature ']
                                    },
                                    {
                                        alignment: 'right',
                                        text: ['page ', {
                                            text: page.toString()
                                        }, ' of ', {
                                            text: pages.toString()
                                        }]
                                    }
                                ],
                                margin: 20
                            }
                        });
                        // Change dataTable layout (Table styling)
                        // To use predefined layouts uncomment the line below and comment the custom lines below
                        // doc.content[0].layout = 'lightHorizontalLines'; // noBorders , headerLineOnly
                        var objLayout = {};
                        objLayout['hLineWidth'] = function(i) {
                            return .5;
                        };
                        objLayout['vLineWidth'] = function(i) {
                            return .5;
                        };
                        objLayout['hLineColor'] = function(i) {
                            return '#aaa';
                        };
                        objLayout['vLineColor'] = function(i) {
                            return '#aaa';
                        };
                        objLayout['paddingLeft'] = function(i) {
                            return 4;
                        };
                        objLayout['paddingRight'] = function(i) {
                            return 4;
                        };
                        doc.content[0].layout = objLayout;
                    }
                }
            ],
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('crm_general/Enquiry_followup/getsing'); ?>/" + $('#var_id').val(),
                "type": "POST",
                "data": function(data) {
                    data.var_id = $('#var_id').val();
                    data.type = 'create';
                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [0], //first column / numbering column
                "orderable": false //set not orderable
            }]

        });

        // }, 2000);

    });
</script>