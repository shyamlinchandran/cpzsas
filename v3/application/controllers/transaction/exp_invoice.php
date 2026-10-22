<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Commercial Invoice</title>
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
            padding: 4px 2px;
            font-size: 9px;
            line-height: 1.2;
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
// --- Helper function to convert number to words ---
if (!function_exists('convertNumberToWords')) {
    function convertNumberToWords($number) {
        $hyphen      = '-';
        $conjunction = ' and ';
        $separator   = ', ';
        $negative    = 'negative ';
        $decimal     = ' point ';
        $dictionary  = array(
            0                   => 'Zero',
            1                   => 'One',
            2                   => 'Two',
            3                   => 'Three',
            4                   => 'Four',
            5                   => 'Five',
            6                   => 'Six',
            7                   => 'Seven',
            8                   => 'Eight',
            9                   => 'Nine',
            10                  => 'Ten',
            11                  => 'Eleven',
            12                  => 'Twelve',
            13                  => 'Thirteen',
            14                  => 'Fourteen',
            15                  => 'Fifteen',
            16                  => 'Sixteen',
            17                  => 'Seventeen',
            18                  => 'Eighteen',
            19                  => 'Nineteen',
            20                  => 'Twenty',
            30                  => 'Thirty',
            40                  => 'Forty',
            50                  => 'Fifty',
            60                  => 'Sixty',
            70                  => 'Seventy',
            80                  => 'Eighty',
            90                  => 'Ninety',
            100                 => 'Hundred',
            1000                => 'Thousand',
            1000000             => 'Million',
            1000000000          => 'Billion',
            1000000000000       => 'Trillion',
            1000000000000000    => 'Quadrillion',
            1000000000000000000 => 'Quintillion'
        );

        if (!is_numeric($number)) {
            return false;
        }

        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
            trigger_error(
                'convertNumberToWords only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
                E_USER_WARNING
            );
            return false;
        }

        if ($number < 0) {
            return $negative . convertNumberToWords(abs($number));
        }

        $string = $fraction = null;

        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }

        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens   = ((int) ($number / 10)) * 10;
                $ones   = $number % 10;
                $string = $dictionary[$tens];
                if ($ones) {
                    $string .= $hyphen . $dictionary[$ones];
                }
                break;
            case $number < 1000:
                $hundreds  = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . convertNumberToWords($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int) ($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = convertNumberToWords($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= convertNumberToWords($remainder);
                }
                break;
        }

        if (null !== $fraction && is_numeric($fraction) && intval($fraction) > 0) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string) $fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }

        return $string;
    }
}

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

$bank_name = !empty($company['comset_bank']) ? $company['comset_bank'] : 'STATE BANK OF INDIA';
$bank_ac = !empty($company['comset_account_no']) ? $company['comset_account_no'] : '42365572255';
$bank_swift = !empty($company['comset_ifsccode']) ? $company['comset_ifsccode'] : 'SBININBBT12';
$bank_micr = '688002055';
$account_name = 'M/s FOODCREST LLP';

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

$dollar_val = floatval($sales[0]['dollar_value']);
if ($dollar_val <= 0) {
    $dollar_val = 1.0;
}
$currency = !empty($sales[0]['currency']) ? $sales[0]['currency'] : 'AUD';
?>

<div class="header-title">COMMERCIAL INVOICE</div>

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
        <td width="50%" rowspan="2">
            <strong>Consignee:</strong><br/>
            <strong><?php echo htmlspecialchars($consignee); ?></strong><br/>
            <?php echo nl2br(htmlspecialchars($consignee_address)); ?>
        </td>
        <td colspan="2" width="50%">
            <strong>Buyer (If other than consignee):</strong><br/>
            TO THE ORDER OF SHIPPER
        </td>
    </tr>
    <tr>
        <td colspan="2" width="50%">
            <strong>Bank Details:</strong><br/>
            ACCOUNT NAME: <?php echo htmlspecialchars($account_name); ?><br/>
            ACCOUNT NUMBER: <?php echo htmlspecialchars($bank_ac); ?><br/>
            BANK: <?php echo htmlspecialchars($bank_name); ?><br/>
            SWIFT CODE: <?php echo htmlspecialchars($bank_swift); ?><br/>
            MICR: <?php echo htmlspecialchars($bank_micr); ?>
        </td>
    </tr>
    <tr>
        <td width="50%">
            <strong>Terms of delivery and payment:</strong><br/>
            Terms of Sale: <?php echo htmlspecialchars($terms_of_sale); ?><br/>
            Terms of payment: <?php echo htmlspecialchars($terms_of_payment); ?>
        </td>
        <td width="25%">
            <strong>Country of Origin of Goods:</strong><br/>
            <?php echo htmlspecialchars($country_origin); ?>
        </td>
        <td width="25%">
            <strong>Country of Final:</strong><br/>
            <?php echo htmlspecialchars($country_final); ?>
        </td>
    </tr>
    <tr>
        <td width="50%">
            <strong>Vessel/flight no:</strong> <?php echo htmlspecialchars($vessel_flight); ?><br/>
            <strong>CNTRS No:</strong> <?php echo htmlspecialchars($cntrs_no); ?><br/>
            <strong>SB NO.</strong> <?php echo htmlspecialchars($sb_no); ?>
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
    <tr>
        <td colspan="3" style="padding: 6px; font-weight: bold; font-size: 11px; border-top: 1px solid #000;">
            <?php echo htmlspecialchars($grand_total_ctns); ?> CTNS OF KEMCHHO BRAND FOOD PRODUCTS<br/>
            Net Weight: <?php echo number_format($grand_total_net_wt, 3); ?> KG<br/>
            Gross Weight: <?php echo number_format($grand_total_gross_wt, 3); ?> KG
        </td>
    </tr>
</table>

<table class="items-table">
    <thead>
        <tr>
            <th width="5%">SL.<br/>No</th>
            <th width="35%">Production Description</th>
            <th width="8%">UOM</th>
            <th width="8%">WT/<br/>Packets</th>
            <th width="8%">Packets/<br/>CTN</th>
            <th width="10%">Rate /<br/>Packets <?php echo htmlspecialchars($currency); ?></th>
            <th width="10%">Rate /<br/>CTN <?php echo htmlspecialchars($currency); ?></th>
            <th width="8%">No of<br/>CTNS</th>
            <th width="8%">Total<br/><?php echo htmlspecialchars($currency); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Group the page items by product name to avoid multiple rows for batches in the Invoice view
        $grouped_page_items = [];
        foreach ($sales_items as $item) {
            $key = $item['name'];
            if (!isset($grouped_page_items[$key])) {
                $grouped_page_items[$key] = [
                    'name' => $item['name'],
                    'ucode' => $item['ucode'],
                    'end_unit_kg' => $item['end_unit_kg'],
                    'unit_count' => $item['unit_count'],
                    'quantity' => 0,
                    'total' => 0,
                    'cartel_no' => 0
                ];
            }
            $grouped_page_items[$key]['quantity'] += floatval($item['quantity']);
            $grouped_page_items[$key]['total'] += floatval($item['total']);
            
            $ctn = !empty($item['cartel_no']) ? floatval($item['cartel_no']) : 0;
            if ($ctn == 0) {
                $packets_per_ctn = !empty($item['unit_count']) ? floatval($item['unit_count']) : 24;
                $ctn = ($packets_per_ctn > 0) ? round(floatval($item['quantity']) / $packets_per_ctn) : 0;
            }
            $grouped_page_items[$key]['cartel_no'] += $ctn;
        }

        $row_idx = $len;
        $total_page_ctns = 0;
        $total_page_aud = 0;

        foreach ($grouped_page_items as $item) {
            $row_idx++;
            $qty = floatval($item['quantity']);
            $total_inr = floatval($item['total']);
            $rate_pkt = ($qty > 0) ? ($total_inr / $qty) / $dollar_val : 0;
            
            $pkts_ctn = !empty($item['unit_count']) ? floatval($item['unit_count']) : 24;
            $rate_ctn = $rate_pkt * $pkts_ctn;
            
            $ctns = $item['cartel_no'];
            $total_page_ctns += $ctns;
            
            $row_total_aud = $total_inr / $dollar_val;
            $total_page_aud += $row_total_aud;
            
            $wt_packets = floatval($item['end_unit_kg']) * 1000;
            if ($wt_packets == 0) {
                if (preg_match('/(\d+)\s*(?:G|GM|g|gm)?$/', $item['name'], $matches)) {
                    $wt_packets = floatval($matches[1]);
                } else {
                    $wt_packets = 340;
                }
            }
            ?>
            <tr>
                <td style="text-align: center;"><?php echo $row_idx; ?></td>
                <td><?php echo htmlspecialchars($item['name']); ?></td>
                <td style="text-align: center;"><?php echo htmlspecialchars($item['ucode']); ?></td>
                <td style="text-align: center;"><?php echo $wt_packets; ?></td>
                <td style="text-align: center;"><?php echo $pkts_ctn; ?></td>
                <td style="text-align: right;"><?php echo number_format($rate_pkt, 4); ?></td>
                <td style="text-align: right;"><?php echo number_format($rate_ctn, 4); ?></td>
                <td style="text-align: center;"><?php echo $ctns; ?></td>
                <td style="text-align: right;"><?php echo number_format($row_total_aud, 2); ?></td>
            </tr>
            <?php
        }

        // Print empty rows to maintain exactly 5 rows height
        $rendered_rows = count($grouped_page_items);
        $empty_rows_to_print = $size - $rendered_rows;
        for ($k = 0; $k < $empty_rows_to_print; $k++) {
            ?>
            <tr class="empty-row">
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <?php
        }
        
        // --- ONLY show grand totals & footers on the last page ---
        if ($inc == ($cpz + 1)) {
            $grand_total_aud = floatval($sales[0]['total']) / $dollar_val;
            $grand_roundoff_aud = floatval($sales[0]['roundoff']) / $dollar_val;
            $subtotal_aud = $grand_total_aud - $grand_roundoff_aud;
            
            $words_total = round($grand_total_aud, 0);
            $words_currency_name = 'Australian Dollar';
            if ($currency == 'USD') {
                $words_currency_name = 'US Dollar';
            } else if ($currency == 'EUR') {
                $words_currency_name = 'Euro';
            }
            $words_str = convertNumberToWords($words_total) . ' ' . $words_currency_name;
            ?>
            <tr>
                <td colspan="7" style="text-align: right; font-weight: bold;">Total</td>
                <td style="text-align: center; font-weight: bold;"><?php echo $grand_total_ctns; ?></td>
                <td style="text-align: right; font-weight: bold;"><?php echo number_format($subtotal_aud, 2); ?></td>
            </tr>
            <tr>
                <td colspan="8" style="text-align: right; font-weight: bold;">Round Off</td>
                <td style="text-align: right; font-weight: bold;"><?php echo number_format($grand_roundoff_aud, 2); ?></td>
            </tr>
            <tr>
                <td colspan="8" style="text-align: right; font-weight: bold;">Total <?php echo htmlspecialchars($currency); ?></td>
                <td style="text-align: right; font-weight: bold;"><?php echo number_format($grand_total_aud, 2); ?></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>

<?php if ($inc == ($cpz + 1)) { ?>
    <table class="footer-table" width="100%" border="1" cellpadding="5" style="border-collapse: collapse; margin-top: 15px; font-size: 10px;">
        <tr>
            <td width="40%">
                <strong><?php echo htmlspecialchars($currency); ?> Chargeable in Words:</strong><br/>
                <strong><?php echo htmlspecialchars($words_str); ?></strong>
            </td>
            <td width="60%">
                <strong>Declaration:</strong><br/>
                We declare that this invoice shows the actual price of the goods described and that all particulars are true and correct.
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <strong>Terms and Conditions of Sale:</strong><br/>
                Payment Terms: <?php echo htmlspecialchars($terms_of_payment); ?><br/>
                Validity of offer: seven (7) calendar days from date of quote.<br/>
                Shipment Date: TWENTY FIVE (25) Days after receipt of payment,<br/>
                Export Control: Please be advised, this order may be subject to an export license.
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
