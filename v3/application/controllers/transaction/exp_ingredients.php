<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Product Ingredients List</title>
    <style>
        body {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            font-size: 11px;
            color: #000;
            margin: 0;
            padding: 10px;
        }
        .header-section {
            width: 100%;
            margin-bottom: 25px;
            margin-top: 10px;
        }
        .header-left {
            float: left;
            width: 70%;
            font-size: 12px;
            line-height: 1.6;
        }
        .header-right {
            float: right;
            width: 30%;
            text-align: right;
        }
        .logo-box {
            display: inline-block;
            background-color: #a82424;
            color: #fff;
            padding: 5px 15px;
            font-weight: bold;
            border-radius: 8px;
            font-size: 15px;
            font-family: Arial, Helvetica, sans-serif;
            letter-spacing: 1px;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #000;
            margin-top: 15px;
        }
        .items-table td {
            border: 1px solid #000;
            padding: 6px 8px;
            vertical-align: middle;
            font-size: 10px;
        }
        .footer-section {
            width: 100%;
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            line-height: 1.5;
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }
    </style>
</head>
<body>

<?php
// --- Map database fields to variables with hardcoded fallbacks ---
$invoice_no = !empty($sales[0]['invoice']) ? $sales[0]['invoice'] : 'EXPFC 50/25-26';
$cntrs_no = !empty($sales[0]['container_no']) ? $sales[0]['container_no'] : 'HLBU6058410';
$sb_no = !empty($sales[0]['sb_no']) ? $sales[0]['sb_no'] : '8301442';

// --- Hardcoded Ingredients Mapping ---
$ingredients_map = [
    'porotta' => [
        ['name' => 'REFINED WHEAT FLOUR', 'pct' => '86%'],
        ['name' => 'REFINED VEG .OIL', 'pct' => '1%'],
        ['name' => 'SUGAR', 'pct' => '1%'],
        ['name' => 'WATER', 'pct' => '10%'],
        ['name' => 'SALT', 'pct' => '2%'],
    ],
    'banana fry' => [
        ['name' => 'BANANA', 'pct' => '87%'],
        ['name' => 'REFINED VEG .OIL', 'pct' => '2%'],
        ['name' => 'GRAM FLOUR', 'pct' => '4%'],
        ['name' => 'RICE FLOUR', 'pct' => '1%'],
        ['name' => 'SUGAR', 'pct' => '0.50%'],
        ['name' => 'CUMINSEED', 'pct' => '0.50%'],
        ['name' => 'TURMERIC POWDER', 'pct' => '1%'],
        ['name' => 'CARDAMOM', 'pct' => '0.50%'],
        ['name' => 'SALT', 'pct' => '0.50%'],
        ['name' => 'WATER', 'pct' => '3%'],
    ],
    'family pack' => [
        ['name' => 'BANANA', 'pct' => '87%'],
        ['name' => 'REFINED VEG .OIL', 'pct' => '2%'],
        ['name' => 'GRAM FLOUR', 'pct' => '4%'],
        ['name' => 'RICE FLOUR', 'pct' => '1%'],
        ['name' => 'SUGAR', 'pct' => '0.50%'],
        ['name' => 'CUMINSEED', 'pct' => '0.50%'],
        ['name' => 'TURMERIC POWDER', 'pct' => '1%'],
        ['name' => 'CARDAMOM', 'pct' => '0.50%'],
        ['name' => 'SALT', 'pct' => '0.50%'],
        ['name' => 'WATER', 'pct' => '3%'],
    ],
    'coconut' => [
        ['name' => 'COCONUT', 'pct' => '100%']
    ],
    'cassava' => [
        ['name' => 'CASSAVA', 'pct' => '100%']
    ],
    'potato' => [
        ['name' => 'chinees potato', 'pct' => '100%']
    ],
    'jilebi' => [
        ['name' => 'UZHUNNU', 'pct' => '86%'],
        ['name' => 'CORN FLOUR', 'pct' => '5%'],
        ['name' => 'SUGAR', 'pct' => '4%'],
        ['name' => 'OIL', 'pct' => '4%'],
    ]
];

// --- Support dummy/mock data fallback ---
$dummy_items = [
    ['name' => 'Restaurant porotta'],
    ['name' => 'Banana fry'],
    ['name' => 'Banaana Fry Family pack'],
    ['name' => 'Sliced coconut'],
    ['name' => 'cassava cut'],
    ['name' => 'chinees potato'],
    ['name' => 'Jilebi']
];

// If dummy parameter is requested or if the sales_items list is empty, use the mock data
if (empty($sales_items) || (isset($_GET['dummy']) && $_GET['dummy'] == '1')) {
    $sales_items = $dummy_items;
}
?>

<table class="header-section">
    <tr>
        <td class="header-left">
            <strong>Invoice No:</strong> <?php echo htmlspecialchars($invoice_no); ?><br/><br/>
            <strong>Container No:</strong> <?php echo htmlspecialchars($cntrs_no); ?><br/>
            <strong>SB:</strong> <?php echo htmlspecialchars($sb_no); ?>
        </td>
        <td class="header-right">
            <div class="logo-box">Foodcrest</div>
        </td>
    </tr>
</table>

<table class="items-table">
    <colgroup>
        <col width="5%" />
        <col width="35%" />
        <col width="50%" />
        <col width="10%" />
    </colgroup>
    <tbody>
        <?php
        $sl_no = $len;
        foreach ($sales_items as $item) {
            $sl_no++;
            
            // Match the product name to determine the ingredients
            $matched_ingredients = [];
            $lower_name = strtolower($item['name']);
            
            foreach ($ingredients_map as $key => $ingredients) {
                if (stripos($lower_name, $key) !== false) {
                    $matched_ingredients = $ingredients;
                    break;
                }
            }
            
            // Fallback if no matching product is found
            if (empty($matched_ingredients)) {
                $matched_ingredients = [
                    ['name' => strtoupper($item['name']), 'pct' => '100%']
                ];
            }
            
            $row_span = count($matched_ingredients);
            
            foreach ($matched_ingredients as $index => $ing) {
                ?>
                <tr>
                    <?php if ($index === 0) { ?>
                        <td rowspan="<?php echo $row_span; ?>" style="text-align: center; font-weight: bold;"><?php echo $sl_no; ?></td>
                        <td rowspan="<?php echo $row_span; ?>"><strong><?php echo htmlspecialchars($item['name']); ?></strong></td>
                    <?php } ?>
                    <td><?php echo htmlspecialchars($ing['name']); ?></td>
                    <td style="text-align: center;"><?php echo htmlspecialchars($ing['pct']); ?></td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>

<?php if ($inc == ($cpz + 1)) { ?>
    <div class="footer-section">
        <strong>FOODCREST LLP</strong> | 17/505 | MARUTHORVATTOM P.O | THANNEERMUKKOM | CHERTHALA | Alappuzha | Kerala | India | 688539<br/>
        Email: Factory@foodcrest.in | Sales@foodcrest.in | Phone: +91 9567190965
    </div>
<?php } ?>

</body>
</html>
