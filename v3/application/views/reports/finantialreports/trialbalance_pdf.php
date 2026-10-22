<?php
/**
 * TRIAL BALANCE PDF TEMPLATE
 */
$groupedTransactions = [];
$roundedOpenStock = round($openstock ?? 0, 2);

foreach ($Transactions as $transaction) {
    $mainAccount = $transaction['mainaccount'];
    $d = round($transaction['debit'], 2);
    $c = round($transaction['credit'], 2);

    if (!isset($groupedTransactions[$mainAccount])) {
        $groupedTransactions[$mainAccount] = [
            'sum_d' => 0, 
            'sum_c' => 0, 
            'items' => []
        ];
    }

    $groupedTransactions[$mainAccount]['items'][] = [
        'NAME'   => $transaction['NAME'],
        'debit'  => $d,
        'credit' => $c
    ];

    $groupedTransactions[$mainAccount]['sum_d'] += $d;
    $groupedTransactions[$mainAccount]['sum_c'] += $c;
}

$displayTotalDebit  = $roundedOpenStock;
$displayTotalCredit = 0;

foreach ($groupedTransactions as $group) {
    $net = $group['sum_d'] - $group['sum_c'];
    if ($net > 0) {
        $displayTotalDebit += $net;
    } elseif ($net < 0) {
        $displayTotalCredit += abs($net);
    }
}

$adjDebit = 0;
$adjCredit = 0;
$diff = $displayTotalDebit - $displayTotalCredit;

if (round($diff, 2) != 0) {
    if ($diff > 0) {
        $adjCredit = abs($diff);
        $displayTotalCredit += $adjCredit;
    } else {
        $adjDebit = abs($diff);
        $displayTotalDebit += $adjDebit;
    }
}

$company_name = isset($company_name) ? $company_name : 'Company';
$end_date_formatted = !empty($enddate) ? date('d/m/Y', strtotime($enddate)) : date('d/m/Y');
$printed_date = date('d/m/Y h:i A');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Trial Balance</title>
    <style>
        body { font-family: sans-serif; font-size: 11pt; color: #333; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h2 { margin: 0 0 5px 0; font-size: 16pt; color: #222; }
        .header h4 { margin: 0 0 5px 0; font-size: 13pt; color: #555; }
        .header p { margin: 0; font-size: 9pt; color: #777; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ccc; padding: 6px 8px; font-size: 10pt; }
        th { background-color: #f2f2f2; font-weight: bold; text-align: left; }
        th.text-right, td.text-right { text-align: right; }
        
        .main-account-row { background-color: #f9f9f9; font-weight: bold; }
        .sub-account-row td { background-color: #ffffff; color: #444; font-size: 9.5pt; }
        .adjustment-row { background-color: #fff8f8; font-style: italic; color: #d9534f; font-weight: bold; }
        .grand-total-row { background-color: #333; color: #ffffff; font-weight: bold; font-size: 10.5pt; }
        .grand-total-row td { border-color: #333; }
    </style>
</head>
<body>
    <div class="header">
        <h2><?= htmlspecialchars($company_name) ?></h2>
        <h4>Trial Balance Report</h4>
        <p>As on <?= $end_date_formatted ?> | Printed on <?= $printed_date ?></p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 8%;">SL</th>
                <th style="width: 52%;">Account Head / Ledger</th>
                <th style="width: 20%;" class="text-right">Debit</th>
                <th style="width: 20%;" class="text-right">Credit</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td><b>Opening Stock</b></td>
                <td class="text-right"><b><?= number_format($roundedOpenStock, 2) ?></b></td>
                <td></td>
            </tr>

            <?php $slno = 1; foreach ($groupedTransactions as $name => $group): 
                $headBalance = $group['sum_d'] - $group['sum_c'];
            ?>
                <tr class="main-account-row">
                    <td><?= $slno++ ?></td>
                    <td><strong><?= htmlspecialchars($name) ?></strong></td>
                    <td class="text-right">
                        <?= ($headBalance > 0) ? number_format(abs($headBalance), 2) : '' ?>
                    </td>
                    <td class="text-right">
                        <?= ($headBalance < 0) ? number_format(abs($headBalance), 2) : '' ?>
                    </td>
                </tr>

                <?php foreach ($group['items'] as $item): ?>
                    <tr class="sub-account-row">
                        <td></td>
                        <td style="padding-left: 25px;">
                            &lfloor; <?= htmlspecialchars($item['NAME']) ?>
                        </td>
                        <td class="text-right"><?= ($item['debit'] > 0) ? number_format($item['debit'], 2) : '' ?></td>
                        <td class="text-right"><?= ($item['credit'] > 0) ? number_format($item['credit'], 2) : '' ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>

            <?php if ($adjDebit > 0 || $adjCredit > 0): ?>
            <tr class="adjustment-row">
                <td></td>
                <td><strong>Adjustment / Difference in Trial Balance</strong></td>
                <td class="text-right"><?= ($adjDebit > 0) ? number_format($adjDebit, 2) : '' ?></td>
                <td class="text-right"><?= ($adjCredit > 0) ? number_format($adjCredit, 2) : '' ?></td>
            </tr>
            <?php endif; ?>

            <tr class="grand-total-row">
                <td colspan="2" class="text-right">GRAND TOTAL</td>
                <td class="text-right"><?= number_format($displayTotalDebit, 2) ?></td>
                <td class="text-right"><?= number_format($displayTotalCredit, 2) ?></td>
            </tr>
        </tbody>
    </table>
</body>
</html>
