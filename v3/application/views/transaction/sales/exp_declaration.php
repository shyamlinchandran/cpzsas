<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Declaration</title>
    <style>
        body {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            font-size: 14px;
            color: #000;
            margin: 0;
            padding: 40px;
        }
        .date-section {
            text-align: right;
            margin-bottom: 60px;
            font-weight: bold;
        }
        .info-section {
            margin-bottom: 40px;
            margin-left: 80px;
        }
        .content-section {
            margin-bottom: 40px;
            line-height: 1.6;
        }
        .signature-section {
            margin-top: 60px;
        }
        .signature-section p {
            margin: 3px 0;
        }
        .missing-image-icon {
            display: inline-block;
            width: 12px;
            height: 12px;
            border: 1px solid #000;
            text-align: center;
            line-height: 12px;
            font-size: 10px;
            color: red;
            margin-right: 5px;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<?php
$invoice_date = !empty($sales[0]['in_date']) ? $sales[0]['in_date'] : '02/10/2026';
$invoice_no = !empty($sales[0]['invoice']) ? $sales[0]['invoice'] : '. MS1';
$cntrs_no = 'ONEU8014115'; // Or you can fetch this from the db if available
?>

    <div class="date-section">
        Date: <?php echo htmlspecialchars($invoice_date); ?>
    </div>

    <div class="info-section">
        Invoice No: <?php echo htmlspecialchars($invoice_no); ?><br>
        Container Number: <?php echo htmlspecialchars($cntrs_no); ?>
    </div>

    <div class="content-section">
        Food product supplied in these consignments is for human consumption and commercially manufactured and packed. Goods<br>
        are clean and free from contaminants, seeds, soil, animal, plant debris and other biosecurity risk materials, Goods are retail<br>
        packaged in clean and new packaging.
    </div>

    <div class="signature-section">
        <p>Yours Sincerely,</p>
        <p>Jimmy jose</p>
        <p>CEO, FOODCREST LLP</p>
        
        <div>
            <span class="missing-image-icon">x</span>
            <span class="missing-image-icon">x</span>
        </div>
    </div>

</body>
</html>
