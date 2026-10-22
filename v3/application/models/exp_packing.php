<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Packing List</title>
    <style>
        body {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            font-size: 11px;
            color: #000;
            margin: 0;
            padding: 10px;
        }
        .header-title {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 10px;
        }
        .header-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #000;
        }
        .header-table td {
            border: 1px solid #000;
            padding: 5px;
            vertical-align: top;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #000;
            margin-top: 15px;
        }
        .items-table th {
            border: 1px solid #000;
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: center;
            padding: 5px;
        }
        .items-table td {
            border: 1px solid #000;
            padding: 5px;
        }
        .empty-row td {
            height: 25px;
        }
        .footer-table {
            width: 100%;
            margin-top: 15px;
            border-collapse: collapse;
        }
        .footer-table td {
            vertical-align: top;
            padding: 5px;
        }
        .stamp-box {
            text-align: center;
            vertical-align: middle;
        }
    </style>
</head>
<body>

<?php
// --- Fetch all items in sale for summary calculation ---
$sale_id = $sales[0]['sales_id'];
$all_items = $this->db->query("SELECT * FROM sales_items WHERE published = 'yes' AND sales_id = ?", [$sale_id])->result_array();

$grand_total_ctns = 0;
$grand_total_net_wt = 0;
$grand_total_gross_wt = 0;

foreach ($all_items as $itm) {
    $ctn = !empty($itm['cartel_no']) ? floatval($itm['cartel_no']) : 0;
    $packets_per_ctn = !empty($itm['unit_count']) ? floatval($itm['unit_count']) : 24;
    $qty = floatval($itm['quantity']);
    if ($ctn == 0) {
        $ctn = ($packets_per_ctn > 0) ? round($qty / $packets_per_ctn) : 0;
    }
    $grand_total_ctns += $ctn;
    
    $packet_wt = !empty($itm['end_unit_kg']) ? floatval($itm['end_unit_kg']) : 0.340;
    $net_wt = $ctn * $packets_per_ctn * $packet_wt;
    $grand_total_net_wt += $net_wt;
    
    $gross_wt = !empty($itm['cartel_wt']) ? floatval($itm['cartel_wt']) : 0;
    if ($gross_wt == 0) {
        $gross_wt = $net_wt + ($ctn * 0.75);
    }
    $grand_total_gross_wt += $gross_wt;
}

// --- Map database fields to variables with hardcoded fallbacks ---
$exporter_name = !empty($company['name']) ? $company['name'] : 'FOODCREST LLP';
$exporter_address = !empty($company['address']) ? $company['address'] : "17/505 MARUTHORVATTOM POST,\nTHANNEERMUKKOM, CHERTHALA,\nALAPPUZHA, KERALA, 688539";
$exporter_email = "Factory@foodcrest.in";
$exporter_ref = !empty($sales[0]['exporter_ref']) ? $sales[0]['exporter_ref'] : 'IEC # AAIFF6818K';

$consignee = !empty($sales[0]['cusname']) ? $sales[0]['cusname'] : 'TO THE ORDER OF SHIPPER';
$consignee_address = !empty($sales[0]['address_line1']) ? $sales[0]['address_line1'] : "TO THE ORDER OF SHIPPER";

$invoice_no = !empty($sales[0]['invoice']) ? $sales[0]['invoice'] : 'EXPFC 59/25-26';
$invoice_date = !empty($sales[0]['in_date']) ? $sales[0]['in_date'] : '20.03.2026';
$po_number = !empty($sales[0]['buyer_order_no']) ? $sales[0]['buyer_order_no'] : '—';
$rex_no = '';
$fda = '';
$duns = '';

$terms_of_payment = !empty($sales[0]['payment_term']) ? $sales[0]['payment_term'] : '50% Advance remaining against doc.';
$terms_of_sale = !empty($sales[0]['shipping_terms']) ? $sales[0]['shipping_terms'] : 'C & F';

$country_origin = !empty($sales[0]['country_origin_of_goods']) ? $sales[0]['country_origin_of_goods'] : 'INDIA';
$country_final = !empty($sales[0]['final_destination']) ? $sales[0]['final_destination'] : 'AUSTRALIA';

$port_of_loading = !empty($sales[0]['port_of_landing']) ? $sales[0]['port_of_landing'] : 'COCHIN';
$port_of_discharge = !empty($sales[0]['port_of_discharge']) ? $sales[0]['port_of_discharge'] : 'SYDNEY';
$final_destination = !empty($sales[0]['final_destination']) ? $sales[0]['final_destination'] : 'SYDNEY';

$vessel_flight = !empty($sales[0]['flight_no']) ? $sales[0]['flight_no'] : '—';
$cntrs_no = 'KKTU6079197';
$sb_no = '—';
$place_of_receipt = !empty($sales[0]['place_of_receipt']) ? $sales[0]['place_of_receipt'] : 'pre carrier';

$currency = !empty($sales[0]['currency']) ? $sales[0]['currency'] : 'AUD';
?>

<div class="header-title">PACKING LIST</div>

<table class="header-table">
    <tr>
        <td width="50%" rowspan="3">
            <strong>Exporter:</strong><br/>
            <strong><?php echo htmlspecialchars($exporter_name); ?></strong><br/>
            <?php echo nl2br(htmlspecialchars($exporter_address)); ?><br/>
            E-MAIL: <?php echo htmlspecialchars($exporter_email); ?>
        </td>
        <td width="25%">
            <strong>Invoice No. & Date:</strong><br/>
            <?php echo htmlspecialchars($invoice_no); ?><br/>
            Date: <?php echo htmlspecialchars($invoice_date); ?>
        </td>
        <td width="25%">
            <strong>Exporter's Ref:</strong><br/>
            IEC # <?php echo htmlspecialchars($exporter_ref); ?>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <strong>PO Number:</strong><br/>
            <?php echo htmlspecialchars($po_number); ?>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <strong>REX No:</strong> <?php echo htmlspecialchars($rex_no); ?><br/>
            <strong>FDA:</strong> <?php echo htmlspecialchars($fda); ?><br/>
            <strong>D-U-N-S:</strong> <?php echo htmlspecialchars($duns); ?>
        </td>
    </tr>
    <tr>
        <td width="50%">
            <strong>Buyer:</strong><br/>
            TO THE ORDER OF SHIPPER
        </td>
        <td colspan="2" width="50%">
            <strong>Consignee:</strong><br/>
            <strong><?php echo htmlspecialchars($consignee); ?></strong><br/>
            <?php echo nl2br(htmlspecialchars($consignee_address)); ?>
        </td>
    </tr>
    <tr>
        <td width="50%">
            <strong>Terms of Sale:</strong> <?php echo htmlspecialchars($terms_of_sale); ?><br/>
            <strong>Terms of payment:</strong> <?php echo htmlspecialchars($terms_of_payment); ?>
        </td>
        <td width="25%">
            <strong>Country of Origin of Goods:</strong><br/>
            <?php echo htmlspecialchars($country_origin); ?>
        </td>
        <td width="25%">
            <strong>Country of Final destination:</strong><br/>
            <?php echo htmlspecialchars($country_final); ?>
        </td>
    </tr>
    <tr>
        <td width="50%">
            <strong>Pre-carriage by:</strong> <?php echo htmlspecialchars($place_of_receipt); ?>
        </td>
        <td width="25%">
            <strong>Port of discharge:</strong><br/>
            <?php echo htmlspecialchars($port_of_discharge); ?>
        </td>
        <td width="25%">
            <strong>Final destination:</strong><br/>
            <?php echo htmlspecialchars($final_destination); ?>
        </td>
    </tr>
    <tr>
        <td width="50%">
            <strong>Port of Loading:</strong> <?php echo htmlspecialchars($port_of_loading); ?>
        </td>
        <td colspan="2" width="50%">
            <strong>Place of receipt by pre carrier:</strong> <?php echo htmlspecialchars($place_of_receipt); ?>
        </td>
    </tr>
</table>

<div style="font-size: 11px; font-weight: bold; margin-top: 10px; margin-bottom: 5px;">
    <?php echo htmlspecialchars($grand_total_ctns); ?> CTNS OF KEMCHHO BRAND FOOD PRODUCTS<br/>
    Net Weight: <?php echo number_format($grand_total_net_wt, 3); ?> KG<br/>
    Gross Weight: <?php echo number_format($grand_total_gross_wt, 3); ?> KG
</div>

<table class="items-table">
    <thead>
        <tr>
            <th width="5%">SL.<br/>No</th>
            <th width="35%">ITEM NAME</th>
            <th width="8%">CTN</th>
            <th width="12%">Batch Code</th>
            <th width="12%">Best Before</th>
            <th width="28%">Packing</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // 1. Group the page items by product name to implement merged rows for multiple batches
        $grouped_page_items = [];
        foreach ($sales_items as $item) {
            $key = $item['name'];
            if (!isset($grouped_page_items[$key])) {
                $grouped_page_items[$key] = [
                    'items' => [],
                    'total_ctns' => 0,
                    'total_net_wt' => 0,
                    'total_gross_wt' => 0
                ];
            }
            
            $ctn = !empty($item['cartel_no']) ? floatval($item['cartel_no']) : 0;
            $packets_per_ctn = !empty($item['unit_count']) ? floatval($item['unit_count']) : 24;
            $qty = floatval($item['quantity']);
            if ($ctn == 0) {
                $ctn = ($packets_per_ctn > 0) ? round($qty / $packets_per_ctn) : 0;
            }
            
            $packet_wt = !empty($item['end_unit_kg']) ? floatval($item['end_unit_kg']) : 0.340;
            $net_wt = $ctn * $packets_per_ctn * $packet_wt;
            
            $gross_wt = !empty($item['cartel_wt']) ? floatval($item['cartel_wt']) : 0;
            if ($gross_wt == 0) {
                $gross_wt = $net_wt + ($ctn * 0.75);
            }
            
            $item['_calculated_ctn'] = $ctn;
            $item['_calculated_net_wt'] = $net_wt;
            $item['_calculated_gross_wt'] = $gross_wt;
            $item['_packets_per_ctn'] = $packets_per_ctn;
            $item['_packet_wt_g'] = $packet_wt * 1000;
            
            $grouped_page_items[$key]['items'][] = $item;
            $grouped_page_items[$key]['total_ctns'] += $ctn;
            $grouped_page_items[$key]['total_net_wt'] += $net_wt;
            $grouped_page_items[$key]['total_gross_wt'] += $gross_wt;
        }

        $sl_no = $len;
        $rendered_rows_count = 0;

        foreach ($grouped_page_items as $item_name => $group) {
            $sl_no++;
            $row_span = count($group['items']);
            
            foreach ($group['items'] as $index => $item) {
                $rendered_rows_count++;
                ?>
                <tr>
                    <?php if ($index === 0) { ?>
                        <td rowspan="<?php echo $row_span; ?>" style="text-align: center; vertical-align: middle;"><?php echo $sl_no; ?></td>
                        <td rowspan="<?php echo $row_span; ?>" style="vertical-align: middle;">
                            <strong><?php echo htmlspecialchars($item['name']); ?></strong><br/>
                            HSN: <?php echo htmlspecialchars($item['hsncd']); ?>
                        </td>
                    <?php } ?>
                    
                    <td style="text-align: center;"><?php echo $item['_calculated_ctn']; ?></td>
                    <td style="text-align: center;"><?php echo htmlspecialchars($item['batch']); ?></td>
                    <td style="text-align: center;"><?php echo htmlspecialchars($item['expdate']); ?></td>
                    
                    <td>
                        <?php
                        echo $item['_packet_wt_g'] . ' GM X ' . $item['_packets_per_ctn'] . ' PKTS<br/>';
                        echo $item['_calculated_ctn'] . 'CTN ,Net Wt: ' . number_format($item['_calculated_net_wt'], 2) . ' kg<br/>';
                        
                        // If it's the last item in a multi-batch group, append group totals
                        if ($index === $row_span - 1 && $row_span > 1) {
                            echo '<hr style="margin: 2px 0; border: none; border-top: 1px dashed #000;"/>';
                            echo '<strong>Total ' . $group['total_ctns'] . ' CTN</strong><br/>';
                            echo 'Net Wt: ' . number_format($group['total_net_wt'], 2) . ' kg<br/>';
                            echo 'Gross Wt: ' . number_format($group['total_gross_wt'], 3) . ' kg';
                        } else if ($row_span === 1) {
                            // Single batch item shows gross weight directly
                            echo 'Gross Wt: ' . number_format($item['_calculated_gross_wt'], 3) . ' kg';
                        }
                        ?>
                    </td>
                </tr>
                <?php
            }
        }

        // Print empty rows to maintain page height consistent
        $empty_rows_to_print = $size - count($sales_items);
        for ($k = 0; $k < $empty_rows_to_print; $k++) {
            ?>
            <tr class="empty-row">
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>

<?php if ($inc == ($cpz + 1)) { ?>
    <table class="footer-table" width="100%" border="1" cellpadding="5" style="border-collapse: collapse; margin-top: 15px; font-size: 10px;">
        <tr>
            <td colspan="2">
                <strong>Declaration:</strong> We declare that this invoice shows the actual price of the goods described and that all particulars are true and correct.
            </td>
        </tr>
        <tr>
            <td width="50%" class="stamp-box">
                <br/><br/>
                <div style="border: 2px dashed #000; border-radius: 50%; width: 120px; height: 120px; display: inline-block; padding: 10px; text-align: center;">
                    <br/>
                    <strong>FOOD CREST LLP</strong><br/>
                    <small>PIN - 688 539</small><br/>
                    <small>MARUTHORVATTOM</small>
                </div>
            </td>
            <td width="50%" style="text-align: right;">
                Signature and date<br/>
                <strong>JIMMY JOSE</strong><br/>
                CEO<br/>
                <?php echo htmlspecialchars($invoice_date); ?><br/><br/>
                <div style="font-family: 'Courier New', Courier, monospace; font-size: 20px;"><em>J. Jose</em></div>
            </td>
        </tr>
    </table>
<?php } ?>

</body>
</html>
