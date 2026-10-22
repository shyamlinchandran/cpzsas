 
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small></small>
    </h1> 
</section> 
<section class="content"> 
    <!--    <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-bar-chart"></i></span>
    
                    <div class="info-box-content">
                        <span class="info-box-text">Cash In Hand</span>
                        <span class="info-box-number">90<small>%</small></span>
                    </div>
    
                </div>
    
            </div>
    
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="glyphicon glyphicon-grain"></i></span>
    
                    <div class="info-box-content">
                        <span class="info-box-text">Item to Reorder</span>
                        <span class="info-box-number">41,410</span>
                    </div>
    
                </div>
    
            </div>
    
            <div class="clearfix visible-sm-block"></div>
    
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="glyphicon glyphicon-list-alt"></i></span>
    
                    <div class="info-box-content">
                        <span class="info-box-text">Todays Sales </span>
                        <span class="info-box-number">760</span>
                    </div>
    
                </div>
    
            </div>
    
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="glyphicon glyphicon-list"></i></span>
    
                    <div class="info-box-content">
                        <span class="info-box-text">Todays Purchase </span>
                        <span class="info-box-number">2,000</span>
                    </div>
    
                </div>
    
            </div>
    
        </div> -->
    <div class="row" id="chkmis">

        <!--        <div class="col-md-8"> 
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Credit Details Today</h3>
        
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
        
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-condensed"  id="table">
                                    <thead>
                                        <tr>
                                            <th>Invoice</th>
                                            <th>Invoice Date</th>
                                            <th>Customer</th>                                    
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
        
                                    </tbody>
                                </table>
                            </div>
        
                        </div>
        
                        <div class="box-footer clearfix">
                            <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
                        </div>
        
                    </div> 
                </div> -->
        <div class="col-md-6"> 
            <div class="box box-danger box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title"><b>Check List Mismatch </b></h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>

                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-condensed"  id="tablechk">
                            <thead>
                                <tr>
                                    <th>Voucher Type</th>
                                    <th>Voucher Number</th>
                                    <th>Debit</th>                                    
                                    <th>Credit</th>  
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                </div>

                <div class="box-footer clearfix">

                </div>

            </div> 
        </div> 

    </div>
    <div class="row">


        <div class="col-md-6"> 
            <div class="box box-primary box-solid collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title"><b>Creditors Reports </b></h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>

                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-condensed"  id="tablecus">
                            <thead>
                                <tr> 
                                    <th>Forwarder</th> 
                                    <th>Invoice</th> 
                                    <th> Date</th>                                    
                                    <th>Debit</th>                                    
                                    <th>Credit</th>  
                                    <th>Balance</th>  
                                    <th>Outstanding Days</th>  
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                </div>

                <div class="box-footer clearfix">

                </div>

            </div> 
        </div> 
        <div class="col-md-6"> 
            <div class="box box-warning box-solid collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title"><b>Debtors Report</b></h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>

                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-condensed"  id="tablesup">
                            <thead>
                                <tr>
                                    <th>Consignee</th> 
                                    <th>Invoice</th> 
                                    <th> Date</th>                                    
                                    <th>Debit</th>                                    
                                    <th>Credit</th>  
                                    <th>Balance</th>  
                                    <th>Outstanding Days</th>  
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                </div>

                <div class="box-footer clearfix">

                </div>

            </div> 
        </div> 
    </div>
</section>

<!--<script type="text/javascript">
/*
    var table;
    var tableCHK, tablesup, tablecus;
    $(document).ready(function () {

        $.ajax({
            url: "<?php echo site_url('dashboard/checklistmismatchcnt'); ?>",
            async: false,
            success: function (result) {
                if (result === '0') {
                    $("#chkmis").hide();
                }
            }
        });

        //datatables
        table = $('#table').DataTable({
             "language": lan,"processing": true, //Feature control the processing indicator.
            "searching": false,
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            //
//"searching": false
            //"scrollX": true, 
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('dashboard/ajax_list') ?>",
                "type": "POST",
                "data": function (data) {
                    // data.country = $('#country').val();
                    //data.type = ;
                    //data.supid = $('#supid').val();
                }
            }


        });
        tablesup = $('#tablesup').DataTable({
             "language": lan,"processing": true, //Feature control the processing indicator.
            "searching": false,
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            //
//"searching": false
            //"scrollX": true, 
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('reports/aeging/ajax_list') ?>",
                "type": "POST",
                "data": function (data) {
                    // data.country = $('#country').val();
                    data.typ = 'Sales';
                    //data.supid = $('#supid').val();
                }
            }


        });
        tablecus = $('#tablecus').DataTable({
             "language": lan,"processing": true, //Feature control the processing indicator.
            "searching": false,
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            //
//"searching": false
            //"scrollX": true, 
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('reports/aeging/ajax_list') ?>",
                "type": "POST",
                "data": function (data) {
                    data.typ = 'Purchase';
                    // data.country = $('#country').val();
                    //data.type = ;
                    //data.supid = $('#supid').val();
                }
            }


        });
        tableCHK = $('#tablechk').DataTable({
             "language": lan,"processing": true, //Feature control the processing indicator.
            "searching": false,
            "bPaginate": false,
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            //
//"searching": false
            //"scrollX": true, 
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('dashboard/checklist') ?>",
                "type": "POST",
                "data": function (data) {
                    // data.country = $('#country').val();
                    //data.type = ;
                    //data.supid = $('#supid').val();
                }
            }


        });

    });

</script> -->