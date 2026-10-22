 <?php
    $add_url = site_url('crm_general/Enquiry_register/create');
    ?>

 <input type="hidden" value="<?php echo $settings[0]['crm_type']; ?>" name="crmtype" id="crmtype" />

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
             <div class="<?= $this->box_color ?>">
                 <div class="box-header">
                     <h3 class="box-title"> <?= label('Bussiness Opportunity Report', $this, $user) ?></h3>
                     <span class="pull-right"> <a role="button" class="btn  btn-success align-bottom" href="<?php echo site_url('crm_general/Enquiry_register/list_all'); ?>">
                             <span class="glyphicon glyphicon-arrow-left" title="back"></span>
                         </a>
                         <a role="button" class="btn" style="border-color:lightgreen;background-color:white;color:lime" id="filter"><i class="fa fa-filter"></i></a></a>

                     </span>

                 </div>
                 <!-- /.box-header -->

                 <div class="box-body">
                     <div style="padding-left:15px">

                     </div>

                     <table id="table" class="table <?= $this->table_color ?> table-responsive" cellspacing="0" width="100%">
                         <thead>
                             <tr>
                                 <th><?= label('SNo', $this, $user) ?></th>
                                 <th><?= label('Employee', $this, $user) ?></th>
                                 <th><?= label('Jan', $this, $user) ?></th>
                                 <th><?= label('Feb', $this, $user) ?></th>
                                 <th><?= label('Mar', $this, $user) ?></th>
                                 <th><?= label('Apr', $this, $user) ?></th>
                                 <th><?= label('May', $this, $user) ?></th>
                                 <th><?= label('Jun', $this, $user) ?></th>
                                 <th><?= label('Jul', $this, $user) ?></th>
                                 <th><?= label('Aug ', $this, $user) ?></th>
                                 <th><?= label('Sep', $this, $user) ?></th>
                                 <th><?= label('Oct', $this, $user) ?></th>
                                 <th><?= label('Nov', $this, $user) ?></th>
                                 <th><?= label('Dec', $this, $user) ?></th>
                                 <th><strong><?= label('Total', $this, $user) ?></strong></th>
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

 <div class="modal fade" id="myFilterModal">
     <input type="hidden" id="closure_id" name="closure_id">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title"> <?= label('Apply Filter', $this, $user) ?></h4>
             </div>
             <div class="modal-body">

                 <table class="table no-border" cellspacing="0" width="100%">
                     <tr>
                         <th class="col-sm-2 ">
                             <?= label('User', $this, $user) ?>
                             <select tabIndex="8" name="sort_user" id="sort_user" class="form-control">

                             </select>
                         </th>
                         <th class="col-sm-2 ">
                         <?= label('Year', $this, $user) ?>
                         <select id="year" name = "year" class="form-control"></select>
                         </th>
                     </tr>
                 </table>

                 <div class="modal-footer">
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                     <button type="button" id="clos_btn" data-dismiss="modal" class="btn btn-primary">Filter
                     </button>
                 </div>
             </div>
         </div>
     </div>
 </div>

 <script type="text/javascript">
     var table;
     var now = new Date();
     var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
     $(document).ready(function() {

         if ($('#sort').val() == 'none') {
             $('.datess').hide()
         }

         var crmtype = $("#crmtype").val();

         if (crmtype == "COURSE_CRM") {
             $("#qualify").text("Qualification");
             $("#name").text("Full Name");
             $("#phone").text("Phone");
         }

         $(document).on("click", "#filter", function() {
             $('#myFilterModal').modal('show');
         });
         $(document).on("click", "#allo_btn", function() {
             $('#myEnquiryModal').modal('hide');
         });
         $(document).on("click", "#clos_btn", function() {
             $('#myClosureModal').modal('hide');
         });
         $(document).on("click", ".test", function() {
             $('#myEnquiryModal').modal('show');
             var allocate_id = $(this).attr('id');
             $('#allocate_id').val(allocate_id);
         });
         $(document).on("click", ".followup", function() {
             $('#myFollowupModal').modal('show');
             var followup_id = $(this).attr('id');
             $('followup_id').val(followup_id);
         });
         $(document).on("click", ".closure", function() {
             $('#myClosureModal').modal('show');
             var closure_id = $(this).attr('idss');
             $('#closure_id').val(closure_id);
             $.ajax({
                 url: "<?php echo site_url('crm_general/Enquiry_allocation/getItems'); ?>/" + closure_id,
                 success: function(result) {
                     text = "<tr> <th class = 'text-center' colspan = '3'><b>Enquiry Products</b></th></tr>"
                     text = text + "<tr> <th><b>Item Name</b></th> <th><b>Quantity</b></th> <th><b>Price</b></th> </tr>"
                     $.each(JSON.parse(result), function(i, items) {
                         text = text + '<tr> <td>' + items.itemname + '</td> <td>' + items.quantity + '</td> <td>' + items.price + '</td> </tr>'
                     });

                     $('#items').html(text);
                 }
             });
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
             "buttons": [{
                     extend: 'excelHtml5',
                     className: 'btn bg-navy',
                     filename: 'Bussiness Opportunity Report' + jsDate,
                     text: '<i class="fa fa-file-excel-o"></i>',
                     messageTop: "Printed Date-  " + jsDate,
                     exportOptions: {
                         columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14]
                     },
                     titleAttr: 'Excel',
                     action: newexportaction,
                     customize: function(xlsx) {
                         var sheet = xlsx.xl.worksheets['sheet1.xml'];
                         $('c[r=A1] t', sheet).text(company + " - " + 'Bussiness Opportunity REPORT');
                         $('c[r=A2] t', sheet).text("");
                     }
                 },
                 {
                     text: '<i class="fa fa-file-pdf-o"></i>',
                     extend: 'pdfHtml5',
                     title: "dsads",
                     className: 'btn bg-olive',
                     filename: 'Bussiness Opportunity Report' + jsDate,
                     messageTop: "Printed Date-  " + jsDate,
                     pageSize: 'A4', //A3 , A5 , A6 , legal , letter
                     action: newexportaction,
                     exportOptions: {
                         columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14],
                         search: 'applied',
                         order: 'applied'
                     },
                     customize: function(doc) {
                         //Remove the title created by datatTables
                         doc.content.splice(0, 1);
                         doc.content[0].text = "Bussiness Opportunity Report";
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
                                     text: company + " - " + 'Bussiness Opportunity',
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
                 "url": "<?php echo site_url('crm_general/reports/Bussiness_opportunity_report/ajax_list') ?>",
                 "type": "POST",
                 "data": function(data) {
                     data.crmtype = crmtype;
                     data.fromDate = $('#fromDate').val();
                     data.toDate = $('#toDate').val();
                     data.dat = $('#sort').val();
                     data.userr = $('#sort_user').val();
                     data.year = $('#year').val();
                 }
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
         //  $('#fromDate').change(function() { //button filter event click
         //      table.ajax.reload(null, false); //just reload table
         //  });
         //  $('#toDate').change(function() { //button filter event click
         //      table.ajax.reload(null, false); //just reload table
         //  });
         //  $('#sort').change(function() { //button filter event click
         //      table.ajax.reload(null, false); //just reload table
         //  });
         //  $('#sort_user').change(function() { //button filter event click
         //      table.ajax.reload(null, false); //just reload table
         //  });

         $('#clos_btn').click(function() { //button filter event click
             table.ajax.reload(null, false); //just reload table
             $('#myClosureModal').modal('hide');
         });

         var min = new Date('01-01-2015').getFullYear(),
             max = min + 10,
             select = document.getElementById('year');

         for (var i = min; i <= max; i++) {
             var opt = document.createElement('option');
             opt.value = i;
             opt.innerHTML = i;
             select.appendChild(opt);
         }

         $('#year').val(new Date().getFullYear());

         $('#clos_btn').trigger('click');

     });

     $('#sort').change(function() {
         if ($('#sort').val() == 'none') {
             $('.datess').hide()
         } else {
             $('.datess').show();
         }

     });

     var text = "";
     $.ajax({

         url: "<?php echo site_url('crm_general/Enquiry_register/users'); ?>",
         success: function(results) {
             text = '<option value = "">All</option>';
             $.each(JSON.parse(results), function(i, items) {
                 text = text + '<option value = "' + items.Id + '">' + items.user_name + '</option>';
                 $('#sort_user').html(text);

             });


         }
     });
 </script>