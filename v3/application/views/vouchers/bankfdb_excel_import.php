<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Bank Voucher Excel Import
            <small>Import Receipts & Payments from Excel (bankfdb format)</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?= base_url('transaction/vouchers/list_all/receipt'); ?>">Vouchers</a></li>
            <li class="active">Bank Excel Import</li>
        </ol>
    </section>

    <section class="content">
        <!-- Settings & Info Box -->
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-info-circle text-primary"></i> Account Mapping Configuration</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="info-box bg-aqua">
                                    <span class="info-box-icon"><i class="fa fa-university"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Bank Account</span>
                                        <span class="info-box-number">ID: 166</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-box bg-green">
                                    <span class="info-box-icon"><i class="fa fa-arrow-down"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Receipt (Deposits)</span>
                                        <span class="info-box-number">Suspense ID: 6734</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-box bg-red">
                                    <span class="info-box-icon"><i class="fa fa-arrow-up"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Payment (Withdrawals)</span>
                                        <span class="info-box-number">Suspense ID: 6735</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Upload Form Card -->
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-upload"></i> Step 1: Upload Excel File (`bankfdb.xlsx`)</h3>
                    </div>
                    <form id="uploadForm" enctype="multipart/form-data"  home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('BankfdbExcelImport'); ?>" >
                        <div class="box-body">
                            <div class="form-group col-md-6">
                                <label for="excel_file">Select Excel File (.xlsx, .xls):</label>
                                <input type="file" name="excel_file" id="excel_file" class="form-control" accept=".xlsx,.xls,.csv" required>
                                <p class="help-block">Upload your `bankfdb.xlsx` file containing Deposits and Withdrawals tabs.</p>
                            </div>
                            <div class="form-group col-md-6 text-right" style="margin-top: 25px;">
                                <a href="<?= base_url('sample_bank_vouchers.xlsx'); ?>" class="btn btn-default" download>
                                    <i class="fa fa-download"></i> Download Sample Template
                                </a>
                                <button type="submit" id="btnPreview" class="btn btn-primary">
                                    <i class="fa fa-eye"></i> Upload & Preview Data
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Preview & Import Card -->
        <div class="row" id="previewContainer" style="display: none;">
            <div class="col-md-12">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-table"></i> Step 2: Review Parsed Vouchers (<span id="totalCount">0</span> rows)</h3>
                        <div class="box-tools pull-right">
                            <button type="button" id="btnImport" class="btn btn-success btn-lg">
                                <i class="fa fa-check-circle"></i> Create Vouchers Now
                            </button>
                        </div>
                    </div>
                    <div class="box-body table-responsive">
                        <table class="table table-bordered table-striped table-hover" id="previewTable">
                            <thead>
                                <tr class="bg-gray">
                                    <th>#</th>
                                    <th>Sheet Name</th>
                                    <th>Date</th>
                                    <th>Particulars / Narration</th>
                                    <th class="text-right">Amount (₹)</th>
                                    <th>Voucher Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Dynamic rows via JS -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script>
    var parsedRowsData = [];

    $(document).ready(function () {
        $('#uploadForm').on('submit', function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            $('#btnPreview').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Reading Excel...');

            $.ajax({
                url: '<?= base_url("BankfdbExcelImport/upload_and_preview"); ?>',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function (res) {
                    $('#btnPreview').prop('disabled', false).html('<i class="fa fa-eye"></i> Upload & Preview Data');
                    if (res.status === 'success') {
                        parsedRowsData = res.rows;
                        $('#totalCount').text(res.total_count);
                        renderPreviewTable(res.rows);
                        $('#previewContainer').slideDown();
                    } else {
                        alert('Error: ' + res.message);
                    }
                },
                error: function (xhr, status, error) {
                    $('#btnPreview').prop('disabled', false).html('<i class="fa fa-eye"></i> Upload & Preview Data');
                    alert('An error occurred while communicating with the server.');
                }
            });
        });

        $('#btnImport').on('click', function () {
            if (parsedRowsData.length === 0) {
                alert('No data available to import.');
                return;
            }

            if (!confirm('Are you sure you want to import ' + parsedRowsData.length + ' vouchers into the database?')) {
                return;
            }

            $('#btnImport').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Creating Vouchers...');

            $.ajax({
                url: '<?= base_url("BankfdbExcelImport/execute_import"); ?>',
                type: 'POST',
                data: { rows_json: JSON.stringify(parsedRowsData) },
                dataType: 'json',
                success: function (res) {
                    $('#btnImport').prop('disabled', false).html('<i class="fa fa-check-circle"></i> Create Vouchers Now');
                    if (res.status === 'success') {
                        alert(res.message);
                        window.location.href = '<?= base_url("transaction/vouchers/list_all/receipt"); ?>';
                    } else {
                        alert('Import failed: ' + res.message);
                    }
                },
                error: function () {
                    $('#btnImport').prop('disabled', false).html('<i class="fa fa-check-circle"></i> Create Vouchers Now');
                    alert('An error occurred during execution.');
                }
            });
        });
    });

    function renderPreviewTable(rows) {
        var tbody = $('#previewTable tbody');
        tbody.empty();

        $.each(rows, function (idx, row) {
            var typeBadge = row.type === 'receipt' 
                ? '<span class="label label-success"><i class="fa fa-arrow-down"></i> Receipt</span>' 
                : '<span class="label label-danger"><i class="fa fa-arrow-up"></i> Payment</span>';

            var tr = '<tr>' +
                '<td>' + (idx + 1) + '</td>' +
                '<td><span class="label label-default">' + row.sheet + '</span></td>' +
                '<td>' + row.date + '</td>' +
                '<td>' + row.particulars + '</td>' +
                '<td class="text-right"><strong>' + row.amount.toLocaleString('en-IN', {minimumFractionDigits: 2}) + '</strong></td>' +
                '<td>' + typeBadge + '</td>' +
                '</tr>';
            tbody.append(tr);
        });
    }
</script>
