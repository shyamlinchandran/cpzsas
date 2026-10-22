<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="<?=$this->box_color?>">
                <div class="box-header">
                    <h3 class="box-title">Physical Inventory Excel Study Tool</h3>
                </div>
                <div class="box-body">
                    <!-- Upload Form -->
                    <form id="uploadForm" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="excelFile">Select Physical Stock Excel File</label>
                                    <input type="file" id="excelFile" name="file" class="form-control" accept=".xlsx, .xls, .csv" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <br>
                                <button type="submit" id="btnStudy" class="btn btn-success" style="margin-top: 5px;">
                                    <span class="glyphicon glyphicon-eye-open"></span> Study Excel File
                                </button>
                                <button type="button" id="btnImport" class="btn btn-primary" style="margin-top: 5px; margin-left: 10px;">
                                    <span class="glyphicon glyphicon-import"></span> Import Physical Inventory (Dummy)
                                </button>
                                <button type="button" id="btnUpdatePrate" class="btn btn-warning" style="margin-top: 5px; margin-left: 10px;">
                                    <span class="glyphicon glyphicon-usd"></span> Update prate
                                </button>
                                <button type="button" id="btnCreateComparison" class="btn btn-info" style="margin-top: 5px; margin-left: 10px;">
                                    <span class="glyphicon glyphicon-tasks"></span> Create comparison table
                                </button>
                            </div>
                        </div>
                    </form>

                    <hr>

                    <!-- Loading Indicator -->
                    <div id="loading" style="display: none; text-align: center; padding: 20px;">
                        <i class="fa fa-spinner fa-spin fa-3x"></i>
                        <p id="loadingText">Processing Excel file and matching items with database... Please wait.</p>
                    </div>

                    <!-- Results Section -->
                    <div id="resultsSection" style="display: none;">
                        <div style="margin-bottom: 15px;">
                            <h4>Matched Results</h4>
                        </div>
                        <div class="table-responsive">
                            <table id="resultsTable" class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Excel Row</th>
                                        <th>Excel Item Name</th>
                                        <th>Excel Barcode</th>
                                        <th>Cleaned Name (For Match)</th>
                                        <th>DB Item ID</th>
                                        <th>DB Item Name</th>
                                        <th>DB Barcode</th>
                                        <th style="text-align: right;">Excel Closing Stock</th>
                                        <th style="text-align: right;">DB Stock</th>
                                        <th style="text-align: right;">Stock Diff</th>
                                        <th style="text-align: right;">Excel Phys Qty</th>
                                        <th style="text-align: right;">Phys Diff</th>
                                        <th style="text-align: right;">Excel Rate</th>
                                        <th style="text-align: right;">DB prate</th>
                                        <th style="text-align: center;">Date</th>
                                        <th style="text-align: center;">Match Status</th>
                                    </tr>
                                </thead>
                                <tbody id="resultsBody">
                                    <!-- Populated via Ajax -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
$(document).ready(function() {
    // Handle Excel Upload & Study
    $('#uploadForm').on('submit', function(e) {
        e.preventDefault();
        
        var formData = new FormData(this);
        $('#btnStudy').prop('disabled', true);
        $('#loadingText').text('Processing Excel file and matching items with database... Please wait.');
        $('#loading').show();
        $('#resultsSection').hide();
        $('#resultsBody').empty();

        $.ajax({
            url: '<?php echo site_url("Physical_inventory_import/study"); ?>',
            type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
                $('#btnStudy').prop('disabled', false);
                $('#loading').hide();
                
                if (response.valid) {
                    var html = '';
                    $.each(response.data, function(index, item) {
                        var statusClass = 'label label-danger';
                        if (item.status === 'Found by Barcode') {
                            statusClass = 'label label-success';
                        } else if (item.status === 'Found by Cleaned Name' || item.status === 'Found by Original Name') {
                            statusClass = 'label label-info';
                        } else if (item.status === 'Found by Fuzzy Name') {
                            statusClass = 'label label-warning';
                        }
                        
                        var isUnmatched = (item.db_id === 'Not Found' || parseInt(item.db_id) <= 0);
                        var idStyle = isUnmatched ? 'color: red; font-weight: bold;' : 'font-weight: bold; color: green;';
                        
                        var stockDiffColor = item.stock_diff < 0 ? 'color: red;' : (item.stock_diff > 0 ? 'color: green;' : '');
                        var physDiffColor = item.difference < 0 ? 'color: red;' : (item.difference > 0 ? 'color: green;' : '');
                        
                        html += '<tr>';
                        html += '<td>' + item.row_no + '</td>';
                        html += '<td>' + item.excel_name + '</td>';
                        html += '<td>' + (item.excel_barcode ? item.excel_barcode : '-') + '</td>';
                        html += '<td><code>' + item.cleaned_name + '</code></td>';
                        html += '<td style="' + idStyle + '">' + item.db_id + '</td>';
                        html += '<td>' + item.db_name + '</td>';
                        html += '<td>' + item.db_barcode + '</td>';
                        html += '<td style="text-align: right;">' + parseFloat(item.excel_closing_stock).toFixed(2) + '</td>';
                        html += '<td style="text-align: right;">' + parseFloat(item.db_stock).toFixed(2) + '</td>';
                        html += '<td style="text-align: right; font-weight: bold; ' + stockDiffColor + '">' + parseFloat(item.stock_diff).toFixed(2) + '</td>';
                        html += '<td style="text-align: right; font-weight: bold;">' + parseFloat(item.excel_physical_stock).toFixed(2) + '</td>';
                        html += '<td style="text-align: right; font-weight: bold; ' + physDiffColor + '">' + parseFloat(item.difference).toFixed(2) + '</td>';
                        html += '<td style="text-align: right;">' + parseFloat(item.excel_closing_rate).toFixed(2) + '</td>';
                        html += '<td style="text-align: right;">' + parseFloat(item.db_prate).toFixed(2) + '</td>';
                        html += '<td style="text-align: center;">' + item.today_date + '</td>';
                        html += '<td style="text-align: center;"><span class="' + statusClass + '">' + item.status + '</span></td>';
                        html += '</tr>';
                    });
                    
                    $('#resultsBody').html(html);
                    $('#resultsSection').show();
                    
                    toastr.options = {
                        "timeOut": "3000",
                        "positionClass": "toast-top-right"
                    };
                    toastr["success"]("Excel study completed successfully!");
                } else {
                    toastr["error"](response.message || "Failed to process Excel file.");
                }
            },
            error: function(xhr, status, error) {
                $('#btnStudy').prop('disabled', false);
                $('#loading').hide();
                toastr["error"]("An error occurred while uploading. Please try again.");
                console.error(error);
            }
        });
    });

    // Handle Dummy Physical Inventory Import
    $('#btnImport').on('click', function() {
        var fileInput = $('#excelFile')[0];
        if (fileInput.files.length === 0) {
            toastr["error"]("Please select an Excel file first.");
            return;
        }
        
        if (!confirm("Are you sure you want to import this Excel file into the phy_stk and phy_stk_items tables? This will create physical stock voucher entries (max 50 items per voucher).")) {
            return;
        }
        
        var formData = new FormData($('#uploadForm')[0]);
        $('#btnStudy').prop('disabled', true);
        $('#btnImport').prop('disabled', true);
        $('#loadingText').text('Importing physical stock entries... Please wait.');
        $('#loading').show();
        $('#resultsSection').hide();

        $.ajax({
            url: '<?php echo site_url("Physical_inventory_import/ImportDummyPhysicalInventory"); ?>',
            type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
                $('#btnStudy').prop('disabled', false);
                $('#btnImport').prop('disabled', false);
                $('#loading').hide();
                
                if (response.valid) {
                    toastr.options = {
                        "timeOut": "5000",
                        "positionClass": "toast-top-right"
                    };
                    toastr["success"](response.message);
                } else {
                    toastr["error"](response.message || "Failed to import physical stock.");
                }
            },
            error: function(xhr, status, error) {
                $('#btnStudy').prop('disabled', false);
                $('#btnImport').prop('disabled', false);
                $('#loading').hide();
                toastr["error"]("An error occurred while importing. Please try again.");
                console.error(error);
            }
        });
    });

    // Handle Purchase Rate Update
    $('#btnUpdatePrate').on('click', function() {
        var fileInput = $('#excelFile')[0];
        if (fileInput.files.length === 0) {
            toastr["error"]("Please select an Excel file first.");
            return;
        }
        
        if (!confirm("Are you sure you want to update the purchase rates (prate) for these items? The current rates will be backed up to the 'oldprate' column, and new rates will be loaded from the Excel sheet's Closing Stock Rate.")) {
            return;
        }
        
        var formData = new FormData($('#uploadForm')[0]);
        $('#btnStudy').prop('disabled', true);
        $('#btnImport').prop('disabled', true);
        $('#btnUpdatePrate').prop('disabled', true);
        $('#btnCreateComparison').prop('disabled', true);
        $('#loadingText').text('Updating purchase rates... Please wait.');
        $('#loading').show();
        $('#resultsSection').hide();

        $.ajax({
            url: '<?php echo site_url("Physical_inventory_import/UpdatePrate"); ?>',
            type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
                $('#btnStudy').prop('disabled', false);
                $('#btnImport').prop('disabled', false);
                $('#btnUpdatePrate').prop('disabled', false);
                $('#btnCreateComparison').prop('disabled', false);
                $('#loading').hide();
                
                if (response.valid) {
                    toastr.options = {
                        "timeOut": "5000",
                        "positionClass": "toast-top-right"
                    };
                    toastr["success"](response.message);
                } else {
                    toastr["error"](response.message || "Failed to update purchase rates.");
                }
            },
            error: function(xhr, status, error) {
                $('#btnStudy').prop('disabled', false);
                $('#btnImport').prop('disabled', false);
                $('#btnUpdatePrate').prop('disabled', false);
                $('#btnCreateComparison').prop('disabled', false);
                $('#loading').hide();
                toastr["error"]("An error occurred while updating rates. Please try again.");
                console.error(error);
            }
        });
    });

    // Handle Create Comparison Table
    $('#btnCreateComparison').on('click', function() {
        var fileInput = $('#excelFile')[0];
        if (fileInput.files.length === 0) {
            toastr["error"]("Please select an Excel file first.");
            return;
        }
        
        if (!confirm("Are you sure you want to create the comparison table? This will create (or overwrite) the 'physical_stock_comparison' table and populate it with Excel data matched against database stock (summed over all batches/godowns) and purchase rates.")) {
            return;
        }
        
        var formData = new FormData($('#uploadForm')[0]);
        $('#btnStudy').prop('disabled', true);
        $('#btnImport').prop('disabled', true);
        $('#btnUpdatePrate').prop('disabled', true);
        $('#btnCreateComparison').prop('disabled', true);
        $('#loadingText').text('Generating comparison table... Please wait.');
        $('#loading').show();
        $('#resultsSection').hide();

        $.ajax({
            url: '<?php echo site_url("Physical_inventory_import/CreatePhysicalStockComparison"); ?>',
            type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
                $('#btnStudy').prop('disabled', false);
                $('#btnImport').prop('disabled', false);
                $('#btnUpdatePrate').prop('disabled', false);
                $('#btnCreateComparison').prop('disabled', false);
                $('#loading').hide();
                
                if (response.valid) {
                    toastr.options = {
                        "timeOut": "5000",
                        "positionClass": "toast-top-right"
                    };
                    toastr["success"](response.message);
                } else {
                    toastr["error"](response.message || "Failed to create comparison table.");
                }
            },
            error: function(xhr, status, error) {
                $('#btnStudy').prop('disabled', false);
                $('#btnImport').prop('disabled', false);
                $('#btnUpdatePrate').prop('disabled', false);
                $('#btnCreateComparison').prop('disabled', false);
                $('#loading').hide();
                toastr["error"]("An error occurred while creating comparison table. Please try again.");
                console.error(error);
            }
        });
    });
});
</script>
