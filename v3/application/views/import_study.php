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
                            </div>
                        </div>
                    </form>

                    <hr>

                    <!-- Loading Indicator -->
                    <div id="loading" style="display: none; text-align: center; padding: 20px;">
                        <i class="fa fa-spinner fa-spin fa-3x"></i>
                        <p>Processing Excel file and matching items with database... Please wait.</p>
                    </div>

                    <!-- Results Section -->
                    <div id="resultsSection" style="display: none;">
                        <h4>Matched Results</h4>
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
                                        <th>Match Status</th>
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
    $('#uploadForm').on('submit', function(e) {
        e.preventDefault();
        
        var formData = new FormData(this);
        $('#btnStudy').prop('disabled', true);
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
                        
                        var idStyle = item.db_id === 'Not Found' ? 'color: red; font-weight: bold;' : 'font-weight: bold; color: green;';
                        
                        html += '<tr>';
                        html += '<td>' + item.row_no + '</td>';
                        html += '<td>' + item.excel_name + '</td>';
                        html += '<td>' + (item.excel_barcode ? item.excel_barcode : '-') + '</td>';
                        html += '<td><code>' + item.cleaned_name + '</code></td>';
                        html += '<td style="' + idStyle + '">' + item.db_id + '</td>';
                        html += '<td>' + item.db_name + '</td>';
                        html += '<td><span class="' + statusClass + '">' + item.status + '</span></td>';
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
});
</script>
