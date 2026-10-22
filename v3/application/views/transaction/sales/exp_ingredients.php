<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Product Ingredients List</title>
    <style>
        @page {
            margin-bottom: 60px;
        }
        body {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            font-size: 11px;
            color: #000;
            margin: 0;
            padding: 10px;
            padding-bottom: 60px;
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
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            width: 100%;
            text-align: center;
            font-size: 10px;
            line-height: 1.5;
            border-top: 1px solid #000;
            padding-top: 8px;
            padding-bottom: 5px;
            background-color: #ffffff;
        }
    </style>
</head>
<body>

<?php
// Ensure $sub_products is available
if (!isset($sub_products) || empty($sub_products)) {
    $sales_id = 0;
    if (isset($sale[0]['sales_id'])) {
        $sales_id = $sale[0]['sales_id'];
    } elseif (isset($sales[0]['sales_id'])) {
        $sales_id = $sales[0]['sales_id'];
    }
    if ($sales_id > 0) {
        $sp_qry = "SELECT c.name as product, b.`name` AS subproduct, a.percentage, a.productid FROM bom_sub_material AS a INNER JOIN item AS b ON a.materialid = b.id INNER JOIN item AS c ON c.id = a.productid WHERE a.is_available = 'yes' AND a.productid IN (SELECT item_id FROM sales_items WHERE published = 'yes' AND sales_id = " . (int)$sales_id . ")";
        $sub_products = $this->db->query($sp_qry)->result_array();
    } else {
        $sub_products = [];
    }
}

// Map sub_products by productid
$sub_map = [];
if (!empty($sub_products)) {
    foreach ($sub_products as $sp) {
        $pid = $sp['productid'];
        if (!isset($sub_map[$pid])) {
            $sub_map[$pid] = [];
        }
        $sub_map[$pid][] = $sp;
    }
}

// Header details
$invoice_no = !empty($sale[0]['invoice']) ? $sale[0]['invoice'] : (!empty($sales[0]['invoice']) ? $sales[0]['invoice'] : '');
$cntrs_no = !empty($sale[0]['container_no']) ? $sale[0]['container_no'] : (!empty($sales[0]['container_no']) ? $sales[0]['container_no'] : '');
$sb_no = !empty($sale[0]['sb_no']) ? $sale[0]['sb_no'] : (!empty($sales[0]['sb_no']) ? $sales[0]['sb_no'] : '');
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
        <col width="40%" />
        <col width="45%" />
        <col width="10%" />
    </colgroup>
    <tbody>
        <?php
        $sl_no = isset($len) ? $len : 0;
        if (!empty($sales_items)) {
            foreach ($sales_items as $item) {
                $sl_no++;
                $item_id = isset($item['item_id']) ? $item['item_id'] : (isset($item['id']) ? $item['id'] : 0);
                
                $matched_ingredients = [];
                if (!empty($sub_map[$item_id])) {
                    foreach ($sub_map[$item_id] as $sp_item) {
                        $pct = trim($sp_item['percentage']);
                        if ($pct !== '' && strpos($pct, '%') === false) {
                            $pct .= '%';
                        }
                        $matched_ingredients[] = [
                            'name' => $sp_item['subproduct'],
                            'pct' => $pct
                        ];
                    }
                }
                
                // Fallback if no matching BOM sub_material exists for this item
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
                            <td rowspan="<?php echo $row_span; ?>" style="text-align: center; font-weight: bold; vertical-align: middle;"><?php echo $sl_no; ?></td>
                            <td rowspan="<?php echo $row_span; ?>" style="vertical-align: middle; width: 40%;"><strong><?php echo htmlspecialchars($item['name']); ?></strong></td>
                        <?php } ?>
                        <td><?php echo htmlspecialchars($ing['name']); ?></td>
                        <td style="text-align: center;"><?php echo htmlspecialchars($ing['pct']); ?></td>
                    </tr>
                    <?php
                }
            }
        }
        ?>
    </tbody>
</table>

<div class="footer-section">
    <strong>FOODCREST LLP</strong> | 17/505 | MARUTHORVATTOM P.O | THANNEERMUKKOM | CHERTHALA | Alappuzha | Kerala | India | 688539<br/>
    Email: Factory@foodcrest.in | Sales@foodcrest.in | Phone: +91 9567190965
</div>

</body>
</html>
