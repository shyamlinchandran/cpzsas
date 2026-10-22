<?php
$is_discount = 1;
$is_bankac = 1;
$user = '';
$language = isset($this->language) ? $this->language : 'en';
$login_comid = $this->session->userdata('login_base_comid');
if (empty($login_comid)) {
    $login_comid = $this->session->userdata('login_comid');
}

// Support both $sales and $purchase data structures seamlessly
$p = isset($sales[0]) ? $sales[0] : (isset($purchase[0]) ? $purchase[0] : array());
$items_list = isset($sales_items) ? $sales_items : (isset($purchase_items) ? $purchase_items : array());

$com = isset($company['comset_statecode']) ? substr($company['comset_statecode'], 0, 2) : (isset($company['statecode']) ? $company['statecode'] : 32);
$statecode = isset($p['statecode']) ? $p['statecode'] : '';
$cust = ($statecode == '' || $statecode == null) ? $com : $statecode;

// Multi-page variables passed from controller
$tot_pages = isset($inc) && (int)$inc > 0 ? (int)$inc : 1;
$curr_page_idx = isset($cpz) ? (int)$cpz : 0;
$curr_page_num = $curr_page_idx + 1;
$is_last_page = ($tot_pages == $curr_page_num);

// Bill Title
$stype = isset($p['stype']) ? strtolower($p['stype']) : (isset($p['ptp']) ? strtolower($p['ptp']) : 'purchase');
if ($stype == 'sales') {
    $bill_title = 'TAX INVOICE';
} else if ($stype == 'purchase') {
    $bill_title = 'PURCHASE BILL';
} else if ($stype == 'estimate') {
    $bill_title = 'ESTIMATE';
} else if ($stype == 'sales_return') {
    $bill_title = 'CREDIT NOTE';
} else if ($stype == 'purchase_return') {
    $bill_title = 'DEBIT NOTE';
} else {
    $bill_title = 'PURCHASE BILL';
}

$tax_basis = isset($p['tax_basis']) && $p['tax_basis'] != '' ? $p['tax_basis'] : '(Normal Tax Payment Basis)';
$payment_type = isset($p['payment_type']) && $p['payment_type'] != '' ? strtoupper($p['payment_type']) : (isset($p['cash_type']) && $p['cash_type'] != '' ? strtoupper($p['cash_type']) : 'CREDIT');

// Company / Buyer Details (Dynamic from DB)
$com_name = !empty($company['name']) ? $company['name'] : '';
$com_address = !empty($company['address']) ? $company['address'] : '';
$com_pin = isset($company['pin']) ? $company['pin'] : (isset($company['pincode']) ? $company['pincode'] : (isset($company['zip']) ? $company['zip'] : ''));
$com_phone = isset($company['phone']) ? $company['phone'] : '';
$com_tin = isset($company['tin']) ? $company['tin'] : (isset($company['gstin']) ? $company['gstin'] : '');
$com_email = isset($company['email']) ? $company['email'] : '';
$com_state = isset($company['state']) && $company['state'] != '' ? $company['state'] : 'Kerala';
$com_statecode = isset($company['statecode']) && $company['statecode'] != '' ? $company['statecode'] : (isset($company['comset_statecode']) ? substr($company['comset_statecode'], 0, 2) : '32');

// Supplier / Party Details (Dynamic from DB with complete fallbacks)
$party_name = isset($p['name']) && $p['name'] != '' ? $p['name'] : (isset($p['cusname']) && $p['cusname'] != '' ? $p['cusname'] : (isset($p['supname']) && $p['supname'] != '' ? $p['supname'] : (isset($p['supplier_name']) ? $p['supplier_name'] : '')));
$party_address = isset($p['address_line1']) && $p['address_line1'] != '' ? $p['address_line1'] : (isset($p['cusdetails']) && $p['cusdetails'] != '' ? $p['cusdetails'] : (isset($p['supaddress']) && $p['supaddress'] != '' ? $p['supaddress'] : (isset($p['address']) ? $p['address'] : '')));
$party_phone = isset($p['phone']) && $p['phone'] != '' ? $p['phone'] : (isset($p['supphone']) && $p['supphone'] != '' ? $p['supphone'] : (isset($p['con_contact']) ? $p['con_contact'] : ''));
$party_tin = isset($p['tin']) ? $p['tin'] : (isset($p['gstin']) ? $p['gstin'] : '');
$party_pan = isset($p['pan']) ? $p['pan'] : '';
$party_aadhar = isset($p['aadhar']) ? $p['aadhar'] : '';
$party_pin = isset($p['pin']) && $p['pin'] != '' ? $p['pin'] : (isset($p['pincode']) && $p['pincode'] != '' ? $p['pincode'] : (isset($p['zip']) ? $p['zip'] : ''));
$party_state = isset($p['state']) && $p['state'] != '' ? $p['state'] : 'Kerala';
$party_statecode = isset($p['statecode']) && $p['statecode'] != '' ? $p['statecode'] : '32';

// Invoice metadata
$inv_no = isset($p['invoice']) && $p['invoice'] != '' ? $p['invoice'] : (isset($p['bill_no']) ? $p['bill_no'] : '');
$inv_date = isset($p['in_date']) ? $p['in_date'] : date('d-M-y');
$place_of_supply = !empty($p['place_of_supply']) ? $p['place_of_supply'] : $com_state;

// Old purchase adjustment fields from billgold.php
$old_pur_total = isset($p['purtotal']) && (float)$p['purtotal'] > 0 ? (float)$p['purtotal'] : 0;
$old_pur_inv = isset($p['pinv']) ? $p['pinv'] : '';

// Bank & notes info
$bank_name = isset($company['bank_name']) && $company['bank_name'] != '' ? $company['bank_name'] : (isset($p['bank_name']) ? $p['bank_name'] : '');
$tr_details = isset($p['tr_details']) && $p['tr_details'] != '' ? $p['tr_details'] : (isset($p['po_ref_no']) && $p['po_ref_no'] != '' ? $p['po_ref_no'] : (isset($p['ref_no']) ? $p['ref_no'] : ''));
$notes_text = isset($p['notes']) ? $p['notes'] : (isset($p['remarks']) ? $p['remarks'] : '');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $bill_title; ?></title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 11px;
            color: #000;
            margin: 0;
            padding: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }
        .outer-cell {
            border: 1px solid #000;
        }
        .border-bottom {
            border-bottom: 1px solid #000;
        }
        .border-top {
            border-top: 1px solid #000;
        }
        .border-right {
            border-right: 1px solid #000;
        }
        .border-left {
            border-left: 1px solid #000;
        }
        .header-title {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            padding: 6px;
            border: 1px solid #000;
        }
        .section-header {
            font-weight: bold;
            font-size: 12px;
            padding-bottom: 4px;
        }
        .box-cell {
            vertical-align: top;
            padding: 6px;
        }
        .center-text {
            text-align: center;
        }
        .right-text {
            text-align: right;
        }
        .bold {
            font-weight: bold;
        }
        .item-table th {
            border: 1px solid #000;
            font-size: 11px;
            padding: 4px;
            text-align: center;
            font-weight: bold;
            background-color: #fff;
        }
        .item-table td {
            border-left: 1px solid #000;
            border-right: 1px solid #000;
            font-size: 11px;
            padding: 4px;
        }
        .item-table tr.item-row td {
            border-bottom: none;
        }
        .item-table tr.total-row th, .item-table tr.total-row td {
            border-top: 1px solid #000;
            border-bottom: 1px solid #000;
            border-left: 1px solid #000;
            border-right: 1px solid #000;
            font-size: 11px;
            padding: 4px;
            font-weight: bold;
        }
        .net-payable-row td {
            border: 1px solid #000;
            padding: 6px 4px;
            font-size: 12px;
            font-weight: bold;
        }
        .payment-info-row td {
            border-left: 1px solid #000;
            border-right: 1px solid #000;
            border-bottom: 1px solid #000;
            padding: 6px 4px;
            font-size: 11px;
        }
        .footer-cell {
            border-left: 1px solid #000;
            border-right: 1px solid #000;
            border-bottom: 1px solid #000;
            padding: 6px 4px;
            font-size: 10px;
        }
        .sig-cell {
            border-left: 1px solid #000;
            border-right: 1px solid #000;
            border-bottom: 1px solid #000;
            padding: 15px 8px 6px 8px;
            font-size: 11px;
            font-weight: bold;
        }
        .page-num {
            font-size: 10px;
            font-weight: normal;
            float: right;
        }
    </style>
</head>
<body>
    <table>
        <!-- Top Company Header & Bill Title Block -->
        <tr>
            <td colspan="3" class="header-title">
                <?php if ($tot_pages > 1) { ?>
                    <span class="page-num">Page <?php echo $curr_page_num; ?> of <?php echo $tot_pages; ?></span>
                <?php } ?>
                <div><?php echo strtoupper($com_name); ?></div>
                <div style="font-size: 13px; font-weight: bold; margin-top: 4px;"><?php echo $bill_title; ?></div>
                <div style="font-size: 10px; font-weight: normal; margin-top: 2px;"><?php echo $tax_basis; ?></div>
                <div style="font-size: 11px; font-weight: bold; margin-top: 2px;"><?php echo $payment_type; ?></div>
            </td>
        </tr>

        <!-- Details Block (Company Logo | Customer Details | Supplier Details) -->
        <tr>
            <!-- Company Logo (Left First Column) -->
            <td class="box-cell border-left border-right border-bottom center-text" style="width: 24%; vertical-align: middle; text-align: center;">
                <?php if (!empty($company['logo'])) { ?>
                    <img align="middle" style="margin: 0px;" width="100%" height="100px" src="uploads/company/<?php echo $company['logo']; ?>" />
                <?php } else { echo '&nbsp;'; } ?>
            </td>

            <!-- Customer Details (Middle Column) -->
            <td class="box-cell border-right border-bottom" style="width: 38%;">
                <div class="section-header">Customer Details</div>
                <div class="bold"><?php echo $com_name; ?></div>
                <div><?php echo $com_address; ?></div>
                <div>Pin Code : <?php echo $com_pin; ?></div>
                <div>Phone : <?php echo $com_phone; ?></div>
                <div>GstIn : <?php echo $com_tin; ?></div>
                <div>State : <?php echo $com_state; ?></div>
                <div>State Code : <?php echo $com_statecode; ?></div>
            </td>

            <!-- Supplier Details (Right Column) -->
            <td class="box-cell border-right border-bottom" style="width: 38%;">
                <div class="section-header">Supplier Details</div>
                <div>Name : <?php echo $party_name; ?></div>
                <div>Address : <?php echo $party_address; ?></div>
                <?php if(!empty($p['address_line2'])){ ?>
                    <div> : <?php echo $p['address_line2']; ?></div>
                <?php } ?>
                <?php if(!empty($p['city'])){ ?>
                    <div> : <?php echo $p['city']; ?></div>
                <?php } ?>
                <div>Pin Code : <?php echo $party_pin; ?></div>
                <div>Phone : <?php echo $party_phone; ?></div>
                <div>
                    State : <?php echo $party_state; ?>
                    <?php if(!empty($party_pan)){ echo ' PAN:' . $party_pan; } ?>
                </div>
                <div>
                    State Code : <?php echo $party_statecode; ?>
                    <?php if(!empty($party_aadhar)){ echo ' Aadhar:' . $party_aadhar; } ?>
                </div>
            </td>
        </tr>

        <!-- Invoice Meta Info Bar -->
        <tr>
            <td class="box-cell border-left border-right border-bottom" style="padding: 4px 6px;">
                Invoice No: <span class="bold"><?php echo $inv_no; ?></span>
            </td>
            <td class="box-cell border-right border-bottom" style="padding: 4px 6px;">
                Date: <span class="bold"><?php echo $inv_date; ?></span>
            </td>
            <td class="box-cell border-right border-bottom" style="padding: 4px 6px;">
                Place of Supply: <span class="bold"><?php echo $place_of_supply; ?></span>
            </td>
        </tr>

        <!-- Main Items Table -->
        <tr>
            <td colspan="3" style="padding: 0;">
                <table class="item-table">
                    <thead>
                        <tr>
                            <th style="width: 4%;">Qty</th>
                            <th style="width: 24%;">Description</th>
                            <th style="width: 7%;">HSN</th>
                            <th style="width: 8%;">Rate</th>
                            <th style="width: 7%;">Purity</th>
                            <th style="width: 10%;">Gross Wt</th>
                            <th style="width: 7%;">M Loss</th>
                            <th style="width: 10%;">Net Wt</th>
                            <th style="width: 8%;">St Value</th>
                            <th style="width: 15%;">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $tot_qty = 0;
                        $tot_gross_wt = 0;
                        $tot_m_loss = 0;
                        $tot_net_wt = 0;
                        $tot_st_val = 0;
                        $tot_amount = 0;
                        $line_count = 0;

                        if (!empty($items_list)) {
                            foreach ($items_list as $item) {
                                $line_count++;
                                $qty = isset($item['quantity']) ? $item['quantity'] : (isset($item['qty']) ? $item['qty'] : (isset($item['pcs']) ? $item['pcs'] : (isset($item['nos']) ? $item['nos'] : 0)));
                                $name = isset($item['name']) ? $item['name'] : (isset($item['item_name']) ? $item['item_name'] : '');
                                if (!empty($item['item_discription'])) {
                                    $name .= ' <br/><small>' . $item['item_discription'] . '</small>';
                                }
                                if (!empty($item['hudid'])) {
                                    $name .= ' <br/><small>HUID: ' . $item['hudid'] . '</small>';
                                } else if (!empty($item['huid'])) {
                                    $name .= ' <br/><small>HUID: ' . $item['huid'] . '</small>';
                                }

                                $hsn = isset($item['hsncd']) ? $item['hsncd'] : (isset($item['hsn_code']) ? $item['hsn_code'] : (isset($item['hsn']) ? $item['hsn'] : ''));
                                $rate = isset($item['rate']) ? $item['rate'] : (isset($item['mrp']) ? $item['mrp'] : 0);
                                $purity = isset($item['purity']) ? $item['purity'] : (isset($item['touch']) ? $item['touch'] : '');
                                $gross_wt = isset($item['gross_wt']) ? $item['gross_wt'] : (isset($item['grossweight']) ? $item['grossweight'] : 0);
                                $m_loss = isset($item['m_loss']) ? $item['m_loss'] : (isset($item['melt_loss_wt']) ? $item['melt_loss_wt'] : (isset($item['loss']) ? $item['loss'] : (isset($item['wastage']) ? $item['wastage'] : 0)));
                                $net_wt = isset($item['net_wt']) ? $item['net_wt'] : (isset($item['netweight']) ? $item['netweight'] : 0);
                                $st_value = isset($item['st_value']) ? $item['st_value'] : (isset($item['stone_val']) ? $item['stone_val'] : (isset($item['stone_charge']) ? $item['stone_charge'] : (isset($item['stone_amount']) ? $item['stone_amount'] : 0)));
                                $amount = isset($item['total']) ? $item['total'] : (isset($item['amount']) ? $item['amount'] : 0);

                                $tot_qty += (float)$qty;
                                $tot_gross_wt += (float)$gross_wt;
                                $tot_m_loss += (float)$m_loss;
                                $tot_net_wt += (float)$net_wt;
                                $tot_st_val += (float)$st_value;
                                $tot_amount += (float)$amount;
                        ?>
                                <tr class="item-row">
                                    <td class="center-text"><?php echo round($qty, 0); ?></td>
                                    <td><?php echo $name; ?></td>
                                    <td class="center-text"><?php echo $hsn; ?></td>
                                    <td class="right-text"><?php echo $rate > 0 ? number_format($rate, 2, '.', '') : ''; ?></td>
                                    <td class="center-text"><?php echo $purity; ?></td>
                                    <td class="right-text"><?php echo $gross_wt > 0 ? number_format($gross_wt, 3, '.', '') : ''; ?></td>
                                    <td class="right-text"><?php echo $m_loss > 0 ? number_format($m_loss, 3, '.', '') : ''; ?></td>
                                    <td class="right-text"><?php echo $net_wt > 0 ? number_format($net_wt, 3, '.', '') : ''; ?></td>
                                    <td class="right-text"><?php echo $st_value > 0 ? number_format($st_value, 2, '.', '') : '0'; ?></td>
                                    <td class="right-text"><?php echo number_format($amount, 0, '.', ''); ?></td>
                                </tr>
                        <?php 
                            }
                        }

                        // Fill empty padding rows controlled to max 5 rows to ensure footer fits on Page 1
                        $min_padding_rows = ($line_count < 5) ? (5 - $line_count) : 1;
                        for ($i = 0; $i < $min_padding_rows; $i++) {
                        ?>
                            <tr class="item-row">
                                <td class="center-text">&nbsp;</td>
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
                        <?php } ?>

                        <!-- Sub Total / Page Total Row -->
                        <tr class="total-row">
                            <td class="center-text"><?php echo round($tot_qty, 0); ?></td>
                            <td>&nbsp;</td>
                            <td class="right-text bold"><?php echo $is_last_page ? 'Sub Total' : 'Page Total'; ?></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td class="right-text bold"><?php echo $tot_gross_wt > 0 ? number_format($tot_gross_wt, 3, '.', '') : ''; ?></td>
                            <td class="right-text bold"><?php echo $tot_m_loss > 0 ? number_format($tot_m_loss, 3, '.', '') : ''; ?></td>
                            <td class="right-text bold"><?php echo $tot_net_wt > 0 ? number_format($tot_net_wt, 3, '.', '') : ''; ?></td>
                            <td class="right-text bold"><?php echo $tot_st_val > 0 ? number_format($tot_st_val, 2, '.', '') : ''; ?></td>
                            <td class="right-text bold">&#8377; <?php echo number_format($tot_amount, 0, ',', ','); ?></td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>

        <?php if ($is_last_page) { 
            $final_total = isset($p['total']) ? (float)$p['total'] : $tot_amount;
            $net_payable_amount = $old_pur_total > 0 ? ($final_total - $old_pur_total) : $final_total;
        ?>
            <!-- Net Payable Row (Last Page Only) -->
            <tr class="net-payable-row">
                <td colspan="2" class="right-text border-right" style="padding-right: 15px;">
                    Net Payable
                    <?php if ($old_pur_total > 0) { ?>
                        <br/><small style="font-weight: normal; font-size: 10px;">(Total: &#8377;<?php echo number_format($final_total, 0, ',', ','); ?> - Old Pur: &#8377;<?php echo number_format($old_pur_total, 0, ',', ','); ?> <?php echo !empty($old_pur_inv) ? '['.$old_pur_inv.']' : ''; ?>)</small>
                    <?php } ?>
                </td>
                <td class="right-text bold" style="padding-right: 8px;">
                    &#8377; <?php echo number_format(round($net_payable_amount), 0, ',', ','); ?>
                </td>
            </tr>

            <!-- Payment Details & Amount in Words Row (Last Page Only) -->
            <tr class="payment-info-row">
                <!-- Left: Amount in Words -->
                <td class="box-cell border-right" style="vertical-align: middle;">
                    <div class="bold">
                        <?php 
                        if (isset($msd) && !empty($msd)) {
                            echo $msd;
                        } else {
                            echo round($net_payable_amount) . ' Rupees';
                        }
                        ?>
                    </div>
                </td>

                <!-- Center/Right: Payment Breakdown -->
                <td colspan="2" style="padding: 0;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td style="padding: 4px 6px; font-weight: bold;">
                                PAYMENT ::: <?php echo isset($p['payment_mode']) ? strtoupper($p['payment_mode']) : (isset($p['cash_type']) ? strtoupper($p['cash_type']) : 'BANK'); ?>
                            </td>
                            <td class="right-text bold" style="padding: 4px 6px; font-style: italic;">
                                <?php echo !empty($bank_name) ? strtoupper($bank_name) : 'BANK'; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 4px 6px; font-weight: bold;">
                                Amount Paid (Bank)
                            </td>
                            <td class="right-text bold" style="padding: 4px 6px;">
                                &#8377; <?php echo isset($p['paid_amount']) ? number_format($p['paid_amount'], 0, ',', ',') : (isset($p['paid']) ? number_format($p['paid'], 0, ',', ',') : number_format(round($net_payable_amount), 0, ',', ',')); ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <!-- Footer / Bank Details / Declarations (Last Page Only) -->
            <tr>
                <td colspan="3" class="footer-cell">
                    <?php if (!empty($bank_name)) { ?>
                        <div>Bank:<?php echo $bank_name; ?></div>
                    <?php } ?>
                    <?php if (!empty($tr_details)) { ?>
                        <div>Tr.Details:<?php echo $tr_details; ?></div>
                    <?php } ?>
                    <?php if (!empty($notes_text)) { ?>
                        <div><?php echo $notes_text; ?></div>
                    <?php } ?>
                    <div style="margin-top: 4px;">E&OE Thanks, Visit Again</div>
                </td>
            </tr>

            <!-- Signatures Row (Last Page Only) -->
            <tr>
                <td class="sig-cell" style="text-align: left;">
                    Supplier Signature
                </td>
                <td colspan="2" class="sig-cell" style="text-align: right;">
                    Authorised Recipient Signature
                </td>
            </tr>
        <?php } else { ?>
            <!-- Continued Notice for Intermediate Pages -->
            <tr>
                <td colspan="3" class="footer-cell right-text bold" style="padding: 10px;">
                    Continued on Page <?php echo ($curr_page_num + 1); ?>...
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
