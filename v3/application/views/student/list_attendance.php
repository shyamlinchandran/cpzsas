<?php
?>
<section class="content"> 
    <div class="row">
        <div class="col-xs-12"> 
            <div class="<?=$this->box_color?>">
                <div class="box-header">
                    <h3 class="box-title"><?= label('Attendance', $this, $user) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
					<input type="hidden" name="class_id" id="class_id" value="<?php echo $class;?>"/>
					<input type="hidden" name="time_id" id="time_id" value="<?php echo $time;?>"/>
                    <table   class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                        <tbody>
                            <tr>

                                <th class = "col-sm-3">
									<?= label('Student', $this, $user) ?>
									<input type = "hidden"   value="0" class = "clschange form-control" id = "student" name = "student">
									<input id="name" class="form-control" name="name" type="text" value=""
                                        maxlength="50">
								</th>
								<th class = "col-sm-2">
										<?= label('Package', $this, $user) ?>
										<select id="package" name="package" class="form-control clschange">
										</select>
								</th>

							<th class = "col-sm-3">
							<?= label('Class', $this, $user) ?>
								<select  type = "text" class = "clschange form-control" id = "class" name = "class">
								
								</select>
							</th>
							<th class = "col-sm-2">
								<?= label('Time', $this, $user) ?>
								<select  class = "clschange form-control" id = "time" name = "time">
								</select>
								
							</th>
							<th class = "col-sm-2">
								<?= label('Date', $this, $user) ?>
								<input type = "text" class = "clschange form-control date" id = "date" name = "date">
								
							</th>
							
                            </tr>
                        </tbody>
                    </table>       
					<span id="balance"></span>
                    <br/>
                    <table id="table"  class="table <?=$this->table_color?> table-responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                 <th> <?= label('SNo', $this, $user) ?></th>
                                <th><?= label('Student', $this, $user) ?></th>
                             <!--   <th><?= label('Course', $this, $user) ?></th> -->
                                <th><?= label('Status', $this, $user) ?></th>
							</tr>
                        </thead>
                        <tbody>
                        </tbody>


                    </table>
					<br />
					 <table id="tableall"  class="table <?=$this->table_color?> table-responsive" cellspacing="0" width="100%">
						 <thead>
                            <tr>
                                 <th> <?= label('SNo', $this, $user) ?></th>
								 <th><?= label('Student', $this, $user) ?></th>
								 <th><?= label('Class', $this, $user) ?></th>
                                 <th><?= label('Date', $this, $user) ?></th>
                                 <th><?= label('Time', $this, $user) ?></th>
                               <!--  <th><?= label('Course', $this, $user) ?></th>-->
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
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<script type="text/javascript">
    $.validate({
        modules: 'date, security,file'
    });
    var table;
	var tableall;
    var id = 0;
	var id_all =  0;
    var now = new Date();
    var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
	function ms_all(){
		if (id_all === 1) {
            tableall.destroy();
        }
        id_all = 1;
        tableall = $('#tableall').DataTable({
            "scrollY": "300px",
            "scrollCollapse": true,
            "paging": false,
            "language": lan, "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "buttons": [
                {
                    extend: 'excelHtml5',
                    className: 'btn bg-navy',
                    filename: 'gstr_report_' + jsDate,
                    text: '<i class="fa fa-file-excel-o"></i>',
                    messageTop: "Printed Date-  " + jsDate,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    },
                    titleAttr: 'Excel',
                    action: newexportaction,
                    customize: function (xlsx) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];
                        var fromdate = $('#startdate').val();
                        var todate = $('#enddate').val();
                        var ledgername = $('#supname').val();
                        var btype = $('#chrq_status').val();
                        $('c[r=A1] t', sheet).text(company + " - " + 'GSTR Report');
                        $('c[r=A2] t', sheet).text("Date from " + fromdate + " to " + todate + " " + btype + " Customer :" + ledgername);
                    }
                },
                {
                    text: '<i class="fa fa-file-pdf-o"></i>',
                    extend: 'pdfHtml5',
                    title: "dsads",
                    className: 'btn bg-olive',
                    filename: 'gstr_report_' + jsDate,
                    messageTop: "Printed Date-  " + jsDate,
                    pageSize: 'A4', //A3 , A5 , A6 , legal , letter
                    action: newexportaction,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5],
                        search: 'applied',
                        order: 'applied'
                    },
                    customize: function (doc) {
                        //Remove the title created by datatTables
                        var fromdate = $('#startdate').val();
                        var todate = $('#enddate').val();
                        var ledgername = $('#supname').val();
                        var btype = $('#chrq_status').val();
                        doc.content.splice(0, 1);
                        doc.content[0].text = "Date from " + fromdate + " to " + todate + " " + btype + " Customer : " + ledgername;
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
                        doc['header'] = (function () {
                            return {
                                columns: [
                                    {
                                        alignment: 'center',
                                        //italics: true,
                                        text: company + " - " + 'GSTR Report',
                                        fontSize: 14,
                                        margin: [10, 0]
                                    }
                                ],
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
                        doc['footer'] = (function (page, pages) {
                            return {
                                columns: [
                                    {
                                        alignment: 'left',
                                        text: ['Created on: ', {text: jsDate.toString()}]
                                    },
                                    {
                                        alignment: 'center',
                                        text: ['Signature ']
                                    }
                                    ,
                                    {
                                        alignment: 'right',
                                        text: ['page ', {text: page.toString()}, ' of ', {text: pages.toString()}]
                                    }
                                ],
                                margin: 20
                            }
                        });
                        // Change dataTable layout (Table styling)
                        // To use predefined layouts uncomment the line below and comment the custom lines below
                        // doc.content[0].layout = 'lightHorizontalLines'; // noBorders , headerLineOnly
                        var objLayout = {};
                        objLayout['hLineWidth'] = function (i) {
                            return .5;
                        };
                        objLayout['vLineWidth'] = function (i) {
                            return .5;
                        };
                        objLayout['hLineColor'] = function (i) {
                            return '#aaa';
                        };
                        objLayout['vLineColor'] = function (i) {
                            return '#aaa';
                        };
                        objLayout['paddingLeft'] = function (i) {
                            return 4;
                        };
                        objLayout['paddingRight'] = function (i) {
                            return 4;
                        };
                        doc.content[0].layout = objLayout;
                    }
                }],
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('education/Attendance/ajax_list_all') ?>",
                "type": "POST",
                "data": function (data) {
                    data.student = $('#student').val();
                    data.class = $('#class').val();
                    data.date = $('#date').val();
					data.time =  $('#time').val();
					data.package = $('#package').val();
                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0], //first column / numbering column
                    "orderable": false //set not orderable
                }]

        });
	}
    function ms()
    {
        if (id === 1) {
            table.destroy();
        }
        id = 1;
        table = $('#table').DataTable({
            "scrollY": "300px",
            "scrollCollapse": true,
            "paging": false,
            "language": lan, "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "buttons": [
                ],
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('education/Attendance/ajax_list') ?>",
                "type": "POST",
                "data": function (data) {
                    data.student = $('#student').val();
                    data.class = $('#class').val();
                    data.date = $('#date').val();
					data.time =  $('#time').val();
					data.package = $('#package').val();
                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0], //first column / numbering column
                    "orderable": false //set not orderable
                }]

        });

    }
	$(document).on("dblclick",".updateattendance",function() {
					var date = $(this).attr('date');
					var status = $(this).attr('status');
					var package_id = $(this).attr('package');
					var course = $(this).attr('course');
					var student = $(this).attr('student');
					var classid = $(this).attr('classid');
					var time = $(this).attr('time');
					if(status === 'present'){
						status = 'absent';
					}else if(status === 'absent'){
						status = 'present';
					}
					var newstatus = '';
					$.ajax({
						url: "<?php echo site_url('education/Attendance/changestatus'); ?>",
						type:"POST",
						async:false,
						data:{time:time,date:date,package_id:package_id,course:course,student:student,classid:classid,status:status},
						success: function (results) {
							newstatus = results;
							ms_all();
						}
					});
					if(newstatus!== ''){
							$(this).attr('status',newstatus);
							$(this).html(newstatus);
							if(newstatus === 'present' ){
								$(this).removeClass("btn-danger");
								$(this).addClass("btn-success");
							}else{
								$(this).removeClass("btn-success");
								$(this).addClass("btn-danger");
							}
					}
	});
	
	function loadpackage(stud_id){
		$.ajax({
                url: "<?php echo site_url('education/Attendance/getallstudentpackage/'); ?>"+stud_id,
				async:false,
                success: function (results) {
					$("#package").html(results);
    
                }
            });
	}
    $(document).ready(function () {
	
		$('#package').change(function(){
			var balance = $('#package option:selected').attr('balance');
			$('#balance').html("Balance Classes : "+balance);
		});
		$("#name").autocomplete({
            source: "<?php echo base_url(); ?>education/Student/getAll", // path to the get_birds method
            minLength: 1,
            select: function (event, ui) {
                $("#student").val(ui.item.id);
				loadpackage(ui.item.id);
               
            }
        });
			 $.ajax({
				url: "<?php echo site_url('ajaxcall/yoga_times'); ?>",
				async:false,
				success: function(result) {
					$('#time').html(result);
					var time_id = $('#time_id').val();
					if(parseFloat(time_id) > 0  ){
						$('#time').val(time_id);
					}
				}
			});
			$('.clschange').change(function(){
				var student = $('#student').val();
				var classid = $('#class').val();
				var date  = $('#date').val();
				var time = $('#time').val();
				var package_id = $('#package').val();
				if(student!=='' && classid !== "" && date !== ""  && time !== '' && student !== 0  && student !== '0' && package_id !== ''){
					ms();
				}
				if(classid !== "" && date !== ""  && time !== ''){
					ms_all();
				}
			});
           var textForBAtch = '';
			$.ajax({
                
                url: "<?php echo site_url('education/Attendance/getallstudent'); ?>",
				async:false,
                success: function (results) {
                    textForBAtch = textForBAtch + '<option value = "">All</option>';
                    $.each(JSON.parse(results), function(i, items){
                        textForBAtch = textForBAtch + '<option value = "'+items.item+'">'+items.label+'</option>';                       
                    });
                    //$('#student').html(textForBAtch);
    
                }
            });

    var textForUniv = '';
    $.ajax({
            url: "<?php echo site_url('education/Attendance/getallclasses'); ?>/" + 0,
			async:false,
            success: function (result) {
                var course = '<option value = "">Select</option>';
                $.each(JSON.parse(result), function (i, items) {
                        course = course + '<option value = "' + items.cls_id + '">' + items.cls_name +
                            '</option>';
                });
                $('#class').html(course);
				var class_id = $('#class_id').val();
				if(parseFloat(class_id) > 0  ){
					 $('#class').val(class_id);
				}

            }
        });
		
		var result = readCookie('attendance');
		 if (result != null) {
				results = JSON.parse(result);
				$.each(results, function (index, value) {
					$('#class').val(value.cls_id);
					$('#time').val(value.time);
				});
							ms_all();
			eraseCookie('attendance');
		 }
		
    });
</script>
