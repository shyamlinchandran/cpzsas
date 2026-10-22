<?php
$user = $this->session->userdata('user');
$utype = $user['utype'];
?>
<section class="content"> 
    <div class="row">
        <div class="col-xs-12"> 
            <div class="box">
                <input type="hidden" value="<?php echo $utype; ?>" id="utype" name="utype"/> 
                <div class="box-header">
                    <h3 class="box-title"><?= label('Salary Details', $this, $user) ?></h3>
                    <span class="pull-right">
                        <a role="button" back="<?php echo site_url('hr/employee/list_all'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('hr/employee/list_all'); ?>">
                            <span class="glyphicon glyphicon-arrow-left"></span> 
                        </a>
                    </span>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table   class="table table-bordered table-striped" cellspacing="0" width="100%">
                        <tbody>
                            <tr>

                                <td class="col-sm-2">
                                    <?= label('year', $this, $user) ?>
                                    <?php
                                    // Sets the top option to be the current year. (IE. the option that is chosen by default).
                                    $currently_selected = date('Y');
                                    // Year to start available options at
                                    $earliest_year = 2019;
                                    // Set your latest year you want in the range, in this case we use PHP to just set it to the current year.
                                    $latest_year = 2030;

                                    $current_year = date('Y');

                                    print '<select id="year" name="year" class="form-control">';
                                    // Loops over each int[year] from current year, back to the $earliest_year [1950]
                                    foreach (range($earliest_year, $latest_year) as $i) {
                                        // Prints the option with the next year in range.
                                        if ($current_year == $i) {
                                            echo '<option selected="selected" value="' . $i . '">' . $i . '</option>';
                                        } else {
                                            echo '<option value="' . $i . '">' . $i . '</option>';
                                        }
//                                        print '<option value="' . $i . '"' . ($i === $current_year ? ' selected="selected"' : '') . '>' . $i . '</option>';
                                    }
                                    print '</select>';
                                    ?>
                                </td>
                                <td class="col-sm-2">
                                    <?= label('Month', $this, $user) ?>  
                                    <select class="form-control" id="month" name="month" size='1'>
                                        <option value="">All</option>
                                        <?php
                                        for ($i = 0; $i < 12; $i++) {
                                            $time = strtotime(sprintf('%d months', $i));
                                            $label = date('F', $time);
                                            $value = date('n', $time);
                                            echo "<option id='ottion$value' class='clsoption' value='$value'>$label</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td class="col-sm-2">
                                    <input type="hidden" id="emp_id" name="emp_id" value="<?php echo $id; ?>"/>

                                </td>



                                <td>
                                    <br/>
                                    <input type="button" class="btn btn-success" id="btn-filter"  value="<?= label('Search', $this, $user) ?>"/>
                                </td>
                                <td>
                                    <br/>
                                    <input type="button" class="btn btn-success" id="btn-reset"  value="<?= label('Reset', $this, $user) ?>"/>
                                </td>
                            </tr>
                        </tbody>
                    </table>                     
                    <br/>
                    <table id="table"  class="table table-bordered table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><?= label('SNo', $this, $user) ?></th>
                                <th><?= label('Name', $this, $user) ?></th>
                                <th><?= label('Year', $this, $user) ?></th>
                                <th><?= label('Month', $this, $user) ?></th> 
                                <th><?= label('Paid Date', $this, $user) ?></th> 
                                <th><?= label('Salary', $this, $user) ?></th>
                                <th><?= label('Paid Amount', $this, $user) ?></th>
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
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<script type="text/javascript">
    $.validate({
        modules: 'date, security,file'
    });
    var table;
    var id = 0;
    var now = new Date();
    var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
    function ms()
    {
        if (id === 1) {
            table.destroy();
        }
        id = 1;
        table = $('#table').DataTable({
            //"scrollY": "200px",
            "scrollCollapse": true,
            "paging": true,
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
                    filename: 'Salary Report' + jsDate,
                    text: '<i class="fa fa-file-excel-o"></i>',
                    messageTop: "Printed Date-  " + jsDate,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    },
                    titleAttr: 'Excel',
                    action: newexportaction,
                    customize: function (xlsx) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];
                        var employee = $('#emp_name').val();
                        var month = $("#month option:selected").text();
                        var year = $("#year option:selected").text();
                        $('c[r=A1] t', sheet).text(company + " - " + 'Total Salary Report');
                        $('c[r=A2] t', sheet).text("Year  " + year + " Month:  " + month + " Employee :" + employee);
                    }
                },
                {
                    text: '<i class="fa fa-file-pdf-o"></i>',
                    extend: 'pdfHtml5',
                    title: "dsads",
                    className: 'btn bg-olive',
                    filename: 'Salary Report' + jsDate,
                    messageTop: "Printed Date-  " + jsDate,
                    pageSize: 'A4', //A3 , A5 , A6 , legal , letter
                    action: newexportaction,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6],
                        search: 'applied',
                        order: 'applied'
                    },
                    customize: function (doc) {
                        //Remove the title created by datatTables
                        var employee = $('#emp_name').val();
                        var month = $("#month option:selected").text();
                        var year = $("#year option:selected").text();
                        doc.content.splice(0, 1);
                        doc.content[0].text = "Year  " + year + " Month:  " + month + " Employee : " + employee;
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
                                        text: company + " - " + 'Salary  Report',
                                        fontSize: 14,
                                        margin: [10, 0]
                                    }
                                ],
                                margin: 20
                            }
                        });
                        for (var i = 1; i < doc.content[1].table.body.length; i++) {
                            doc.content[1].table.body[i][4].alignment = 'right';
                            doc.content[1].table.body[i][0].alignment = 'center';
                            doc.content[1].table.body[i][1].alignment = 'center';
                        }
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
                "url": "<?php echo site_url('hr/Employee/salary_ajax_list') ?>",
                "type": "POST",
                "data": function (data) {
                    data.month = $('#month').val();
                    data.year = $('#year').val();
                    // data.toid = $('#toid').val();
                    data.emp_id = $('#emp_id').val();
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
    $(document).ready(function () {

        ms();
        $('#btn-filter').click(function () { //button filter event click

            ms();
            //  table.ajax.reload(null, false);  //just reload table
        });
        $('#btn-reset').click(function () { //button reset event click

            ms();
        });

    });
</script>
