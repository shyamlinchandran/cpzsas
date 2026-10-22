<?php
function num($num) {
    return number_format($num, 2);
}

// Group liabilities by ledger group (show actual values, negative if applicable)
$grouped_liability = [];
foreach ($liability_data as $item) {
    $groupName = $item['name'] ?? 'Other';
    if (!isset($grouped_liability[$groupName])) {
        $grouped_liability[$groupName] = [
            'total' => 0,
            'items' => []
        ];
    }
    $grouped_liability[$groupName]['items'][] = $item;
    $grouped_liability[$groupName]['total'] += $item['balance']; // Keep original value
}

// Group assets by ledger group (show actual values, negative if applicable)
$grouped_asset = [];
foreach ($asset_data as $item) {
    $groupName = $item['name'] ?? 'Other';
    if (!isset($grouped_asset[$groupName])) {
        $grouped_asset[$groupName] = [
            'total' => 0,
            'items' => []
        ];
    }
    $grouped_asset[$groupName]['items'][] = $item;
    $grouped_asset[$groupName]['total'] += $item['balance']; // Keep original value
}

$total_liability = array_sum(array_column($liability_data, 'balance')) + $profit;
$total_asset = array_sum(array_column($asset_data, 'balance')) + $closingstock + $lose;
$net_profit = $total_asset - $total_liability;
$liability_groups = array_keys($grouped_liability);
$asset_groups = array_keys($grouped_asset);
$balance_length = max(count($liability_groups), count($asset_groups));
?>

<div class="bs-container">
    <div class="bs-row bs-controls">
    <div class="bs-col">
        <button type="button" onclick="toggleAllGroups()" class="bs-toggle-btn">Expand All</button>
    </div>
</div>

<!-- Add this to your CSS -->
<style>
.bs-toggle-btn {
    background: #4CAF50;
    color: white;
    border: none;
    padding: 5px 10px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
}
.bs-toggle-btn:hover {
    background: #45a049;
}
.bs-controls {
    padding: 8px 10px;
    background: #f8f8f8;
    border-bottom: 1px solid #ddd;
}
</style>

    <div class="bs-row bs-header">
        <div class="bs-col bs-particulars"><?= label('Liabilities', $this, $user) ?></div>
        <div class="bs-col bs-amount text-right"><?= label('Amount', $this, $user) ?></div>
        <div class="bs-col bs-particulars"><?= label('Assets', $this, $user) ?></div>
        <div class="bs-col bs-amount text-right"><?= label('Amount', $this, $user) ?></div>
    </div>
<?php $login_comid = $this->session->userdata('login_comid'); ?>


    <!-- Add this right after the header row in your view -->
<?php if ($profit > 0 || $lose > 0): ?>
<div class="bs-row bs-group">
    <div class="bs-col bs-particulars">
        <?php if ($profit > 0): ?>
            <strong>Net Profit</strong>
        <?php endif; ?>
    </div>
    <div class="bs-col bs-amount text-right">
        <?php if ($profit > 0): ?>
            <?= num($profit) ?>
        <?php endif; ?>
    </div>
    <div class="bs-col bs-particulars">
        <?php if ($lose > 0): ?>
            <strong>Net Loss</strong>
        <?php endif; ?>
    </div>
    <div class="bs-col bs-amount text-right">
        <?php if ($lose > 0): ?>
            <?= num($lose) ?>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>

    <?php for ($i = 0; $i < $balance_length; $i++): ?>
        <?php $liability_group = $liability_groups[$i] ?? null; ?>
        <?php $asset_group = $asset_groups[$i] ?? null; ?>

        <div class="bs-row bs-group">
            <div class="bs-col bs-particulars">
                <?php if ($liability_group): ?>
                    <span class="toggle-icon" onclick="toggleGroup(this, 'liab_<?= $i ?>')">▼</span>
                    <strong><?= $liability_group ?></strong>
                <?php endif; ?>
            </div>
            <div class="bs-col bs-amount text-right">
                <?php if ($liability_group): ?>
                    <span class="<?= $grouped_liability[$liability_group]['total'] < 0 ? 'negative' : '' ?>">
                        <?= num($grouped_liability[$liability_group]['total']) ?>
                    </span>
                <?php endif; ?>
            </div>

            <div class="bs-col bs-particulars">
                <?php if ($asset_group): ?>
                    <span class="toggle-icon" onclick="toggleGroup(this, 'asset_<?= $i ?>')">▼</span>
                    <strong><?= $asset_group ?></strong>
                <?php endif; ?>
            </div>
            <div class="bs-col bs-amount text-right">
                <?php if ($asset_group): ?>
                    <span class="<?= $grouped_asset[$asset_group]['total'] < 0 ? 'negative' : '' ?>">
                        <?= num($grouped_asset[$asset_group]['total']) ?>
                    </span>
                <?php endif; ?>
            </div>
        </div>

        <?php if ($liability_group): ?>
            <div class="bs-group-items" id="liab_<?= $i ?>" style="display: none;">
                <?php foreach ($grouped_liability[$liability_group]['items'] as $item): ?>
                    <div class="bs-row bs-item">
                        <div class="bs-col bs-particulars">
                            <a onclick="showledger(<?= $item['id'] ?>, '<?= $item['ledger'] ?>')"><?= $item['ledger'] ?></a>
                        </div>
                        <div class="bs-col bs-amount text-right">
                            <span class="<?= $item['balance'] < 0 ? 'negative' : '' ?>">
                                <?= num($item['balance']) ?>
                            </span>
                        </div>
                        <div class="bs-col bs-particulars"></div>
                        <div class="bs-col bs-amount"></div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if ($asset_group): ?>
            <div class="bs-group-items" id="asset_<?= $i ?>" style="display: none;">
                <?php foreach ($grouped_asset[$asset_group]['items'] as $item): ?>
                    <div class="bs-row bs-item">
                        <div class="bs-col bs-particulars"></div>
                        <div class="bs-col bs-amount"></div>
                        <div class="bs-col bs-particulars">
                            <a onclick="showledger(<?= $item['id'] ?>, '<?= $item['ledger'] ?>')"><?= $item['ledger'] ?></a>
                        </div>
                        <div class="bs-col bs-amount text-right">
                            <span class="<?= $item['balance'] < 0 ? 'negative' : '' ?>">
                                <?= num($item['balance']) ?>
                            </span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    <?php endfor; ?>

    <!-- Closing Stock Row -->
    <div class="bs-row">
        <div class="bs-col bs-particulars"></div>
        <div class="bs-col bs-amount"></div>
        <div class="bs-col bs-particulars">
            <a href="<?= site_url('reports/items/fifo_lifo') ?>">Closing Stock</a>
        </div>
        <div class="bs-col bs-amount text-right">
            <span class="<?= $closingstock < 0 ? 'negative' : '' ?>">
                <?= num($closingstock) ?>
            </span>
        </div>
    </div>

    
    <!-- Net Profit/Loss at Bottom -->
   <?php
// Calculate the difference
$difference = abs($total_liability - $total_asset);
$left_diff = ($total_liability > $total_asset) ? $difference : 0;
$right_diff = ($total_asset > $total_liability) ? $difference : 0;
?>

<!-- <div class="bs-row bs-total">
    <div class="bs-col bs-particulars"><strong>Total Liabilities</strong></div>
    <div class="bs-col bs-amount text-right">
        <strong class="<?= $total_liability < 0 ? 'negative' : '' ?>">
            <?= num($total_liability) ?>
        </strong>
    </div>
    <div class="bs-col bs-particulars"><strong>Total Assets</strong></div>
    <div class="bs-col bs-amount text-right">
        <strong class="<?= $total_asset < 0 ? 'negative' : '' ?>">
            <?= num($total_asset) ?>
        </strong>
    </div>
</div> -->
  <?php if ($total_liability != $total_asset): ?>
<div class="bs-row bs-difference">
    <?php if ($total_liability > $total_asset): ?>
       
    <?php elseif ($total_asset > $total_liability): ?>
         <div class="bs-col bs-particulars"><strong>Difference in Opening</strong></div>
        <div class="bs-col bs-amount text-right">
            <strong><?= num($difference) ?></strong>
        </div>
        <div class="bs-col bs-particulars"></div>
        <div class="bs-col bs-amount"></div>

       
    <?php endif; ?>
</div>
<?php endif; ?>
   
    <?php 
// Calculate the greater total for balancing the sheet
$grand_total = max(abs($total_liability), abs($total_asset));
$liability_diff = $grand_total - abs($total_liability);
$asset_diff = $grand_total - abs($total_asset);
?>

<div class="bs-row bs-grand-total">
    <div class="bs-col bs-particulars"><strong> Total</strong></div>
    <div class="bs-col bs-amount text-right">
        <strong><?= num($grand_total) ?></strong>
    </div>
    <div class="bs-col bs-particulars"><strong> Total</strong></div>
    <div class="bs-col bs-amount text-right">
        <strong><?= num($grand_total) ?></strong>
    </div>
</div>




</div>

<style>
.bs-container { font-family: Arial; border: 1px solid #ccc; border-radius: 5px; margin-top: 10px; }
.bs-row { display: flex; padding: 8px 0; border-bottom: 1px solid #eee; }
.bs-header { background: #f0f0f0; font-weight: bold; }
.bs-col { width: 25%; padding: 0 10px; }
.bs-particulars { text-align: left; }
.bs-amount { text-align: right; }
.bs-total { background: #eaeaea; font-weight: bold; }
.bs-group-items { background: #fafafa; padding-left: 20px; }
.toggle-icon { cursor: pointer; margin-right: 4px; }
.bs-item { font-size: 90%; }
.negative { color: red; }
</style>

<script>

    let allExpanded = false;

function toggleAllGroups() {
    const groupItems = document.querySelectorAll('.bs-group-items');
    const toggleIcons = document.querySelectorAll('.toggle-icon');
    const toggleBtn = document.querySelector('.bs-toggle-btn');
    
    allExpanded = !allExpanded;
    
    groupItems.forEach(item => {
        item.style.display = allExpanded ? 'block' : 'none';
    });
    
    toggleIcons.forEach(icon => {
        icon.textContent = allExpanded ? '▼' : '▶';
    });
    
    toggleBtn.textContent = allExpanded ? 'Collapse All' : 'Expand All';
}

function toggleGroup(el, id) {
    const div = document.getElementById(id);
    const icon = el;
    if (div.style.display === "block") {
        div.style.display = "none";
        icon.textContent = "▶";
    } else {
        div.style.display = "block";
        icon.textContent = "▼";
    }
    
    // Update the global state if needed
    const anyCollapsed = Array.from(document.querySelectorAll('.bs-group-items'))
        .some(item => item.style.display === 'none');
    allExpanded = !anyCollapsed;
    document.querySelector('.bs-toggle-btn').textContent = allExpanded ? 'Collapse All' : 'Expand All';
}

// function toggleGroup(el, id) {
//     const div = document.getElementById(id);
//     const icon = el;
//     if (div.style.display === "block") {
//         div.style.display = "none";
//         icon.textContent = "▼";
//     } else {
//         div.style.display = "block";
//         icon.textContent = "▶";
//     }
// }

    function showledger(toid, ledg) {
        var arr = [];
        var fromdate = $('#startdate').val();
        var todate = $('#enddate').val();
        arr.push({
            stdate: fromdate,
            enddate: todate,
            ledg: ledg,
            toid: toid
        });
        createCookie('<?php echo $login_comid?>ledger_cook', JSON.stringify(arr), 3);
        $("#last_click").attr('href', "<?= base_url() ?>reports/accounts/leadger?newpage=new");
        $("#last_click").click();
    }
</script>