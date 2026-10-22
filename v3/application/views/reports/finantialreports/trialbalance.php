<?php
/**
 * TRIAL BALANCE LOGIC
 */
$groupedTransactions = [];
$roundedOpenStock = round($openstock ?? 0, 2);

// 1. Group transactions and round individual line items
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
        'id'     => $transaction['id'] ?? 0,
        'NAME'   => $transaction['name'] ?? $transaction['NAME'] ?? '',
        'debit'  => $d,
        'credit' => $c
    ];

    $groupedTransactions[$mainAccount]['sum_d'] += $d;
    $groupedTransactions[$mainAccount]['sum_c'] += $c;
}

// Sort sub ledger items in ascending order by name
foreach ($groupedTransactions as &$group) {
    usort($group['items'], function ($a, $b) {
        return strcasecmp($a['NAME'] ?? '', $b['NAME'] ?? '');
    });
}
unset($group);

/**
 * 2. CALCULATE DISPLAY TOTALS
 * A Trial Balance sums the NET balances of each account.
 */
$displayTotalDebit  = $roundedOpenStock; // Opening stock is usually a Debit
$displayTotalCredit = 0;

foreach ($groupedTransactions as $group) {
    $net = $group['sum_d'] - $group['sum_c'];
    if ($net > 0) {
        $displayTotalDebit += $net;
    } elseif ($net < 0) {
        $displayTotalCredit += abs($net);
    }
}

/**
 * 3. ADJUSTMENT LOGIC
 * If sides don't match, calculate the difference (Suspense)
 */
$adjDebit = 0;
$adjCredit = 0;
$diff = $displayTotalDebit - $displayTotalCredit;

if (round($diff, 2) != 0) {
    if ($diff > 0) {
        // Debit is higher, add adjustment to Credit
        $adjCredit = abs($diff);
        $displayTotalCredit += $adjCredit;
    } else {
        // Credit is higher, add adjustment to Debit
        $adjDebit = abs($diff);
        $displayTotalDebit += $adjDebit;
    }
}
?>

<style>
    .main-account { cursor: pointer; background-color: #f9f9f9; }
    .main-account:hover { background-color: #f1f1f1; }
    .sub-group tr { background-color: #ffffff; }
    .toggle-icon { font-size: 0.8em; margin-left: 5px; color: #888; }
    .text-adjustment { color: #d9534f; font-style: italic; }
    .grand-total-row { background-color: #333 !important; color: #fff; font-weight: bold; }
    .sub-ledger-link { color: inherit; text-decoration: none; }
    .sub-ledger-link:hover { text-decoration: underline; color: #3c8dbc; }
    .highlight-ledger-row { background-color: #fff3cd !important; }
    .highlight-ledger-text {
        color: #856404 !important;
        font-weight: bold !important;
        background-color: #ffe8a1 !important;
        padding: 2px 6px;
        border-radius: 4px;
    }
</style>

<div class="transaction-table">
    <div style="margin-bottom: 15px;" class="row">
        <div class="col-md-4 col-sm-6">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                <input type="text" id="ledgerSearchInput" class="form-control" placeholder="Search Ledger / Account Head..." onkeyup="searchLedger()">
            </div>
        </div>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="5%">SL</th>
                <th width="45%">Account Head / Ledger</th>
                <th width="25%" class="text-right">Debit</th>
                <th width="25%" class="text-right">Credit</th>
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
                $id = preg_replace('/[^a-zA-Z0-9]/', '', $name);
                $headBalance = $group['sum_d'] - $group['sum_c'];
            ?>
                <tr class="main-account" onclick="toggleGroup('<?= $id ?>', this)">
                    <td><?= $slno++ ?></td>
                    <td>
                        <strong><?= htmlspecialchars($name) ?></strong> 
                        <span class="toggle-icon">▶</span>
                    </td>
                    <td class="text-right">
                        <?= ($headBalance > 0) ? '<b>'.number_format(abs($headBalance), 2).'</b>' : '' ?>
                    </td>
                    <td class="text-right">
                        <?= ($headBalance < 0) ? '<b>'.number_format(abs($headBalance), 2).'</b>' : '' ?>
                    </td>
                </tr>

                <tbody id="<?= $id ?>" style="display: none;" class="sub-group">
                    <?php foreach ($group['items'] as $item): ?>
                        <tr>
                            <td></td>
                            <td class="pl-5  font-size:20px; font-weight:bold" style="padding-left: 40px !important;">
                                <small style="font-weight:bold;font-size:18px;">└ <a class="sub-ledger-item sub-ledger-link" href="javascript:void(0);" onclick="showledger('<?= $item['id'] ?>', '<?= htmlspecialchars($item['NAME'], ENT_QUOTES) ?>')"><?= htmlspecialchars($item['NAME']) ?></a></small>
                            </td>
                            <td class="text-right font-size:20px; font-weight:bold"><small style="font-weight:bold;font-size:18px;"><?= number_format($item['debit'], 2) ?></small></td>
                            <td class="text-right font-size:20px; font-weight:bold"><small style="font-weight:bold;font-size:18px;"><?= number_format($item['credit'], 2) ?></small></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            <?php endforeach; ?>

            <?php if ($adjDebit > 0 || $adjCredit > 0): ?>
            <tr class="text-adjustment">
                <td></td>
                <td><strong>Adjustment / Difference in Trial Balance</strong></td>
                <td class="text-right"><strong><?= ($adjDebit > 0) ? number_format($adjDebit, 2) : '' ?></strong></td>
                <td class="text-right"><strong><?= ($adjCredit > 0) ? number_format($adjCredit, 2) : '' ?></strong></td>
            </tr>
            <?php endif; ?>

            <tr class="grand-total-row">
                <td colspan="2" class="text-right">GRAND TOTAL</td>
                <td class="text-right"><?= number_format($displayTotalDebit, 2) ?></td>
                <td class="text-right"><?= number_format($displayTotalCredit, 2) ?></td>
            </tr>
        </tbody>
    </table>
</div>

<script>
function toggleGroup(id, row) {
    const el = document.getElementById(id);
    const icon = row.querySelector('.toggle-icon');
    const isHidden = el.style.display === 'none';
    
    el.style.display = isHidden ? 'table-row-group' : 'none';
    icon.textContent = isHidden ? '▼' : '▶';
}

function searchLedger() {
    var filter = $('#ledgerSearchInput').val().toLowerCase().trim();
    
    $('.sub-group tr').removeClass('highlight-ledger-row');
    $('.sub-ledger-item').removeClass('highlight-ledger-text');
    
    if (filter === '') {
        return;
    }
    
    $('.main-account').each(function() {
        var mainRow = $(this);
        var mainName = mainRow.find('strong').text().toLowerCase();
        var onclickAttr = mainRow.attr('onclick') || '';
        var match = onclickAttr.match(/'([^']+)'/);
        if (!match) return;
        
        var groupId = match[1];
        var subGroupBody = $('#' + groupId);
        var groupMatches = false;
        
        subGroupBody.find('tr').each(function() {
            var subRow = $(this);
            var subLedgerElem = subRow.find('.sub-ledger-item');
            var subLedgerText = subLedgerElem.text().toLowerCase();
            
            if (subLedgerText.indexOf(filter) > -1 || mainName.indexOf(filter) > -1) {
                groupMatches = true;
                if (subLedgerText.indexOf(filter) > -1) {
                    subRow.addClass('highlight-ledger-row');
                    subLedgerElem.addClass('highlight-ledger-text');
                }
            }
        });
        
        if (groupMatches) {
            subGroupBody.css('display', 'table-row-group');
            mainRow.find('.toggle-icon').text('▼');
        }
    });
}

if (typeof showledger !== 'function') {
    function showledger(toid, ledg) {
        var arr = [];
        var fromdate = $('#startdate').val() || '';
        var todate = $('#enddate').val() || '';
        arr.push({
            stdate: fromdate,
            enddate: todate,
            ledg: ledg,
            toid: toid
        });
        createCookie('<?php echo $login_comid ?? "" ?>ledger_cook', JSON.stringify(arr), 3);
        if ($("#last_click").length) {
            $("#last_click").attr('href', "<?= base_url() ?>reports/accounts/leadger?newpage=new");
            $("#last_click").click();
        } else {
            window.location.href = "<?= base_url() ?>reports/accounts/leadger?newpage=new";
        }
    }
}
</script>