<?php
    $add_url = site_url('crm_general/Enquiry_register/create');
    ?>


 <style>
     .box-title {
         text-transform: capitalize;
     }

     .label {
         margin-bottom: -2px;
     }
 </style>
 <section class="content">
     <div class="row">
         <div class="col-xs-12">
             <div class="<?=$this->box_color?>">
                 <div class="box-header">
                     <h3 class="box-title"> <?= label('Payment Blance Report', $this, $user) ?></h3>
                     <!-- <span class="pull-right"> <a role="button" class="btn  btn-success align-bottom" href="<?php echo site_url('crm_general/Enquiry_register/list_all'); ?>">
                             <span class="glyphicon glyphicon-arrow-left" title="back"></span>
                         </a>
                         <a role="button" class="btn" style="border-color:lightgreen;background-color:white;color:lime" id="filter"><i class="fa fa-filter"></i></a></a>

                     </span> -->

                 </div>
                 <!-- /.box-header -->

                 <div class="box-body">
                 <table   class="table <?=$this->table_color?>" cellspacing="0" width="100%" style="margin:15px;">
                        <tbody>
                            <tr>

                                <td class="col-sm-2">
                                  Start Date
                                    <input type="text" class="form-control date" id="start_date"/>
                                </td>
                                <td class="col-sm-2">
                                    End Date  
                                    <input type="text" class="form-control date" id="end_date"/> 
                                </td>
                               
                                <td class="col-sm-2">
                                    Student 
                                    <input  NoTab="true" type="text" class="form-control" id="student"/> 
                                    <input  NoTab="true" type="hidden" class="form-control" id="student_id"/> 

                                </td>
                                <td class="col-sm-2">
                                    Course 
                                    <input  NoTab="true" type="text" class="form-control" id="course"/> 
                                    <input  NoTab="true" type="hidden" class="form-control" id="course_id"/> 

                                </td>
                                <td class="col-sm-2">
                                    Status 
                                    <select  NoTab="true" type="text" class="form-control" id="status">
                                    <option value="">All</option>
                                    <option value="completed">Completed</option>
                                    <option value="pending">Pending</option>

                                    </select> 
                                </td>
                                <td>
                                    <br/>
                                    <input type="button" class="btn btn-success" id="btn-filter"  value="Search"/>
                                </td>
                            </tr>
                        </tbody>
                    </table> <br>

                     <table id="table" class="table table-bordered table-striped table-responsive dataTable no-footer"cellspacing="0" width="100%">
                         <thead>
                             <tr>
                                 <th><?= label('SNo', $this, $user) ?></th>
                                 <th><?= label('Student', $this, $user) ?></th>
                                 <th><?= label('Phone', $this, $user) ?></th>
                                 <th><?= label('Course', $this, $user) ?></th>
                                 <th><?= label('Date of Payment', $this, $user) ?></th>
                                 <th><?= label('Amount', $this, $user) ?></th>
                                 <th><?= label('Paid', $this, $user) ?></th>
								 <th><?= label('Balance', $this, $user) ?></th>                              
                             </tr>
                         </thead>
                         <tbody>
                         </tbody>
                     </table>
                 </div>
             </div>
         </div>
     </div>
 </section>



 <script type="text/javascript">

$("#student").autocomplete({

source: "<?php echo base_url(); ?>education/Student/getAll", // path to the get_birds method
minLength: 1,
select: function (event, ui) {
    $("#student_id").val(ui.item.id);
    stud_id = ui.item.id;

    // $.ajax({
    //     url: "<?php echo site_url('education/Student/getStudentCourse'); ?>/" +
    //         stud_id,
    //     success: function (results) {

    //         var result = JSON.parse(results);
    //         var option = '<option value="">Select</option>';
    //         $.each(result, function (i, item) {

    //             option = option + '<option value="' + item
    //                 .course_id + '">' + item.course + '</option>';

    //         })
    //         $('#course').html(option);
    //     }
    // });
}

});


$("#course").autocomplete({

source: "<?php echo base_url(); ?>education/Student/getAllCourse", // path to the get_birds method
minLength: 1,
select: function (event, ui) {
    $("#course_id").val(ui.item.id);
    // stud_id = ui.item.id;

}

});




     var table;
     var now = new Date();
     var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
     $(document).ready(function() {

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
             "buttons": [{
                     extend: 'excelHtml5',
                     className: 'btn bg-navy',
                     filename: 'Payment Report' + jsDate,
                     text: '<i class="fa fa-file-excel-o"></i>',
                     messageTop: "Printed Date-  " + jsDate,
                     exportOptions: {
                         columns: [0, 1, 2, 3, 4, 5, 6]
                     },
                     titleAttr: 'Excel',
                     action: newexportaction,
                     customize: function(xlsx) {
                         var sheet = xlsx.xl.worksheets['sheet1.xml'];
                         $('c[r=A1] t', sheet).text(company + " - " + 'Payment Report');
                         $('c[r=A2] t', sheet).text("");
                     }
                 },
                 {
                     text: '<i class="fa fa-file-pdf-o"></i>',
                     extend: 'pdfHtml5',
                     title: "dsads",
                     className: 'btn bg-olive',
                     filename: 'Allocated Report' + jsDate,
                     messageTop: "Printed Date-  " + jsDate,
                     pageSize: 'A4', //A3 , A5 , A6 , legal , letter
                     action: newexportaction,
                     exportOptions: {
                         columns: [0, 1, 2, 3, 4, 5, 6],
                         search: 'applied',
                         order: 'applied'
                     },
                     customize: function(doc) {
                         //Remove the title created by datatTables
                         doc.content.splice(0, 1);
                         doc.content[0].text = "Payment Report";
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
                                     text: company + " - " + 'Payment',
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
                 "url": "<?php echo site_url('education/Student/getpaymentBalanceRrport') ?>",
                 "type": "POST",
                 "data": function(data) {
                    
                     data.start_date = $('#start_date').val();
                     data.end_date = $('#end_date').val();
                     data.student_id = $('#student_id').val();
                     data.status = $('#status').val();
                     data.course_id = $("#course_id").val();

                 }
             },
             //Set column definition initialisation properties.
             "columnDefs": [{
                 "targets": [0], //first column / numbering column
                 "orderable": false //set not orderable
             }]
         });
         $('#btn-filter').click(function() { 
             table.ajax.reload(null, false); //just reload table
         });

       



     });

   
 </script>