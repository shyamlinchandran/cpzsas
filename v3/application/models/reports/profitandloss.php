<?php
function num($num) {
    // Format number with proper sign (negative shows as negative)
    return number_format($num, 2);
}

// Initialize variables with defaults
$direxp_data = $direxp_data ?? [];
$dirinc_data = $dirinc_data ?? [];
$indirexp_data = $indirexp_data ?? [];
$indirinc_data = $indirinc_data ?? [];
$openstock = isset($openstock) ? abs($openstock) : 0;  // Force positive for display
$closingstock = isset($closingstock) ? abs($closingstock) : 0;  // Force positive for display

// Group and calculate direct expenses (keep original signs for calculations)
$grouped_direxp = [];
$total_direxp_items = 0;
foreach ($direxp_data as $item) {
    $groupName = $item['name'] ?? 'Other';
    if (!isset($grouped_direxp[$groupName])) {
        $grouped_direxp[$groupName] = ['total' => 0, 'items' => []];
    }
    $grouped_direxp[$groupName]['items'][] = $item;
    $grouped_direxp[$groupName]['total'] += $item['balance'];
    $total_direxp_items += $item['balance']; // Use original signed value
}
$total_direxp = $openstock + $total_direxp_items;

// Group and calculate direct income (keep original signs for calculations)
$grouped_dirinc = [];
$total_dirinc_items = 0;
foreach ($dirinc_data as $item) {
    $groupName = $item['name'] ?? 'Other';
    if (!isset($grouped_dirinc[$groupName])) {
        $grouped_dirinc[$groupName] = ['total' => 0, 'items' => []];
    }
    $grouped_dirinc[$groupName]['items'][] = $item;
    $grouped_dirinc[$groupName]['total'] += $item['balance'];
    $total_dirinc_items += $item['balance']; // Use original signed value
}
$total_dirinc = $closingstock + $total_dirinc_items;

// Calculate profits
$gross_profit = $total_dirinc - $total_direxp;

// Group and calculate indirect expenses
$grouped_indirexp = [];
$total_indirexp = 0;
foreach ($indirexp_data as $item) {
    $groupName = $item['name'] ?? 'Other';
    if (!isset($grouped_indirexp[$groupName])) {
        $grouped_indirexp[$groupName] = ['total' => 0, 'items' => []];
    }
    $grouped_indirexp[$groupName]['items'][] = $item;
    $grouped_indirexp[$groupName]['total'] += $item['balance'];
    $total_indirexp += $item['balance'];
}

// Group and calculate indirect income
$grouped_indirinc = [];
$total_indirinc = 0;
foreach ($indirinc_data as $item) {
    $groupName = $item['name'] ?? 'Other';
    if (!isset($grouped_indirinc[$groupName])) {
        $grouped_indirinc[$groupName] = ['total' => 0, 'items' => []];
    }
    $grouped_indirinc[$groupName]['items'][] = $item;
    $grouped_indirinc[$groupName]['total'] += $item['balance'];
    $total_indirinc += $item['balance'];
}

$net_profit = ($gross_profit + $total_indirinc) - $total_indirexp;
?>

<div class="pl-container">
    <!-- Header Row -->
    <div class="pl-row pl-header">
        <div class="pl-col pl-particulars"><?= label('Particulars', $this, $user) ?></div>
        <div class="pl-col pl-amount"><?= label('Amount', $this, $user) ?></div>
        <div class="pl-col pl-particulars"><?= label('Particulars', $this, $user) ?></div>
        <div class="pl-col pl-amount"><?= label('Amount', $this, $user) ?></div>
    </div>
    
    <!-- Opening and Closing Stock (always positive) -->
    <div class="pl-row">
        <div class="pl-col pl-particulars"><?= label('Opening Stock', $this, $user) ?></div>
        <div class="pl-col pl-amount text-right"><?= num(abs($openstock)) ?></div>
        <div class="pl-col pl-particulars"><a href="<?= site_url('reports/items/fifo_lifo') ?>">Closing Stock</a></div>
        <div class="pl-col pl-amount text-right"><?= num(abs($closingstock)) ?></div>
    </div>
    
    <!-- Direct Expenses vs Direct Income -->
    <div class="pl-row pl-section-header">
        <div class="pl-colspan-2">Direct Expense</div>
        <div class="pl-colspan-2">Direct Income</div>
    </div>
    
    <div class="pl-section">
        <!-- Left Side - Direct Expenses -->
        <div class="pl-side">
            <?php foreach ($grouped_direxp as $groupName => $group): ?>
                <div class="pl-group">
                    <div class="pl-group-header" onclick="toggleGroup(this, 'direxp_<?= md5($groupName) ?>')">
                        <div class="pl-col pl-particulars">
                            <span class="toggle-icon">▼</span> <?= $groupName ?>
                        </div>
                        <div class="pl-col pl-amount text-right">
                            <?= num($group['total']) ?>
                        </div>
                    </div>
                    <div class="pl-group-items" id="direxp_<?= md5($groupName) ?>">
                        <?php foreach ($group['items'] as $item): ?>
                            <div class="pl-row pl-item">
                                <div class="pl-col pl-particulars">
                                    <a onclick="showledger(<?= $item['id'] ?>, '<?= $item['ledger'] ?>')">
                                        <?= $item['ledger'] ?>
                                    </a>
                                </div>
                                <div class="pl-col pl-amount text-right">
                                    <?= num($item['balance']) ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
            
            <!-- Direct Expenses Total -->
            <!-- <div class="pl-row pl-total">
                <div class="pl-col pl-particulars text-right"><?= label('Total', $this, $user) ?></div>
                <div class="pl-col pl-amount text-right"><?= num($total_direxp) ?></div>
            </div> -->
        </div>
        
        <!-- Right Side - Direct Income -->
        <div class="pl-side">
            <?php foreach ($grouped_dirinc as $groupName => $group): ?>
                <div class="pl-group">
                    <div class="pl-group-header" onclick="toggleGroup(this, 'dirinc_<?= md5($groupName) ?>')">
                        <div class="pl-col pl-particulars">
                            <span class="toggle-icon">▼</span> <?= $groupName ?>
                        </div>
                        <div class="pl-col pl-amount text-right">
                            <?= num($group['total']) ?>
                        </div>
                    </div>
                    <div class="pl-group-items" id="dirinc_<?= md5($groupName) ?>">
                        <?php foreach ($group['items'] as $item): ?>
                            <div class="pl-row pl-item">
                                <div class="pl-col pl-particulars">
                                    <a onclick="showledger(<?= $item['id'] ?>, '<?= $item['ledger'] ?>')">
                                        <?= $item['ledger'] ?>
                                    </a>
                                </div>
                                <div class="pl-col pl-amount text-right">
                                    <?= num($item['balance']) ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
            
            <!-- Direct Income Total -->
            <!-- <div class="pl-row pl-total">
                <div class="pl-col pl-particulars text-right"><?= label('Total', $this, $user) ?></div>
                <div class="pl-col pl-amount text-right"><?= num($total_dirinc) ?></div>
            </div> -->
        </div>
    </div>
    
    <!-- Gross Profit/Loss -->
   <!-- Direct Expenses Total and Gross Profit/Loss -->
<div class="pl-row pl-total">
    <?php if ($gross_profit >= 0): ?>
        <!-- Gross Profit (left side) -->
        <div class="pl-col pl-particulars text-right">
            <strong><?= label('Gross Profit', $this, $user) ?></strong>
        </div>
        <div class="pl-col pl-amount text-right">
            <strong><?= num($gross_profit) ?></strong>
        </div>
        <!-- Direct Income Total (right side) -->
        <div class="pl-col pl-particulars text-right"></div>
        <div class="pl-col pl-amount text-right"></div>
    <?php else: ?>
        <!-- Direct Expenses Total (left side) -->
        <div class="pl-col pl-particulars text-right"></div>
        <div class="pl-col pl-amount text-right"></div>
        <!-- Gross Loss (right side) -->
        <div class="pl-col pl-particulars text-right">
            <strong><?= label('Gross Loss', $this, $user) ?></strong>
        </div>
        <div class="pl-col pl-amount text-right">
            <strong><?= num(abs($gross_profit)) ?></strong>
        </div>
    <?php endif; ?>
</div>


<div class="pl-row pl-total">
        <!-- Gross Profit (left side) -->
        <div class="pl-col pl-particulars text-right">
            <strong><?= label('Total', $this, $user) ?></strong>
        </div>
        <div class="pl-col pl-amount text-right">
            <strong><?= num(max($total_dirinc, $total_direxp))?></strong>
        </div>
        <!-- Direct Income Total (right side) -->
        <div class="pl-col pl-particulars text-right"><?= label('Total', $this, $user) ?></div>
        <div class="pl-col pl-amount text-right"><?= num(max($total_dirinc, $total_direxp)) ?></div>
  
</div>
    

<!-- Empty Row -->
<div class="pl-row">
    <div class="pl-col pl-particulars">&nbsp;</div>
    <div class="pl-col pl-amount">&nbsp;</div>
    <div class="pl-col pl-particulars">&nbsp;</div>
    <div class="pl-col pl-amount">&nbsp;</div>
</div>

<!-- Gross Profit or Gross Loss (opposite display logic) -->
<div class="pl-row pl-total">
    <?php if ($gross_profit < 0): ?>
        <!-- Gross Loss on left side -->
        <div class="pl-col pl-particulars text-right">
            <strong><?= label('Gross Loss', $this, $user) ?></strong>
        </div>
        <div class="pl-col pl-amount text-right">
            <strong><?= num(abs($gross_profit)) ?></strong>
        </div>
        <!-- Empty on right side -->
        <div class="pl-col pl-particulars text-right"></div>
        <div class="pl-col pl-amount text-right"></div>
    <?php else: ?>
        <!-- Empty on left side -->
        <div class="pl-col pl-particulars text-right"></div>
        <div class="pl-col pl-amount text-right"></div>
        <!-- Gross Profit on right side -->
        <div class="pl-col pl-particulars text-right">
            <strong><?= label('Gross Profit', $this, $user) ?></strong>
        </div>
        <div class="pl-col pl-amount text-right">
            <strong><?= num($gross_profit) ?></strong>
        </div>
    <?php endif; ?>
</div>



    <!-- Indirect Expenses vs Indirect Income -->
    <div class="pl-row pl-section-header">
        <div class="pl-colspan-2">Indirect Expense</div>
        <div class="pl-colspan-2">Indirect Income</div>
    </div>
    
    <div class="pl-section">
        <!-- Left Side - Indirect Expenses -->
        <div class="pl-side">
            <?php foreach ($grouped_indirexp as $groupName => $group): ?>
                <div class="pl-group">
                    <div class="pl-group-header" onclick="toggleGroup(this, 'indirexp_<?= md5($groupName) ?>')">
                        <div class="pl-col pl-particulars">
                            <span class="toggle-icon">▼</span> <?= $groupName ?>
                        </div>
                        <div class="pl-col pl-amount text-right">
                            <?= num($group['total']) ?>
                        </div>
                    </div>
                    <div class="pl-group-items" id="indirexp_<?= md5($groupName) ?>">
                        <?php foreach ($group['items'] as $item): ?>
                            <div class="pl-row pl-item">
                                <div class="pl-col pl-particulars">
                                    <a onclick="showledger(<?= $item['id'] ?>, '<?= $item['ledger'] ?>')">
                                        <?= $item['ledger'] ?>
                                    </a>
                                </div>
                                <div class="pl-col pl-amount text-right">
                                    <?= num($item['balance']) ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
            
            <!-- Indirect Expenses Total -->
            <!-- <div class="pl-row pl-total">
                <div class="pl-col pl-particulars text-right"><?= label('Total', $this, $user) ?></div>
                <div class="pl-col pl-amount text-right"><?= num($total_indirexp) ?></div>
            </div> -->
        </div>
        
        <!-- Right Side - Indirect Income -->
        <div class="pl-side">
            <?php foreach ($grouped_indirinc as $groupName => $group): ?>
                <div class="pl-group">
                    <div class="pl-group-header" onclick="toggleGroup(this, 'indirinc_<?= md5($groupName) ?>')">
                        <div class="pl-col pl-particulars">
                            <span class="toggle-icon">▼</span> <?= $groupName ?>
                        </div>
                        <div class="pl-col pl-amount text-right">
                            <?= num($group['total']) ?>
                        </div>
                    </div>
                    <div class="pl-group-items" id="indirinc_<?= md5($groupName) ?>">
                        <?php foreach ($group['items'] as $item): ?>
                            <div class="pl-row pl-item">
                                <div class="pl-col pl-particulars">
                                    <a onclick="showledger(<?= $item['id'] ?>, '<?= $item['ledger'] ?>')">
                                        <?= $item['ledger'] ?>
                                    </a>
                                </div>
                                <div class="pl-col pl-amount text-right">
                                    <?= num($item['balance']) ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
            
            <!-- Indirect Income Total -->
            <!-- <div class="pl-row pl-total">
                <div class="pl-col pl-particulars text-right"><?= label('Total', $this, $user) ?></div>
                <div class="pl-col pl-amount text-right"><?= num($total_indirinc) ?></div>
            </div> -->
        </div>
    </div>
    
    <!-- Net Profit/Loss -->
  <!-- Net Profit/Loss - Matching Indirect Expenses/Income Total Format -->
<div class="pl-row pl-total">
    <?php if ($net_profit >= 0): ?>

        
          <!-- Net Profit shows on left side (where Indirect Expenses total would be) -->
        <div class="pl-col pl-particulars text-right">
            <strong><?= label('Net Loss', $this, $user) ?></strong>
        </div>
        <div class="pl-col pl-amount text-right">
            <strong><?= num($net_profit) ?></strong>
        </div>
        <!-- Keep Indirect Income Total on right side -->
        <div class="pl-col pl-particulars text-right"></div>
        <div class="pl-col pl-amount text-right"></div>



      
    <?php else: ?>
  <!-- Keep Indirect Expenses Total on left side -->
        <div class="pl-col pl-particulars text-right"></div>
        <div class="pl-col pl-amount text-right"></div>
        <!-- Net Loss shows on right side (where Indirect Income total would be) -->
        <div class="pl-col pl-particulars text-right">
            <strong><?= label('Net Profit ', $this, $user) ?></strong>
        </div>
        <div class="pl-col pl-amount text-right">
            <strong><?= num(abs($net_profit)) ?></strong>
        </div>

      
    <?php endif; ?>
</div>


<div class="pl-row pl-total">
        <!-- Gross Profit (left side) -->
        <div class="pl-col pl-particulars text-right">
            <strong><?= label('Total', $this, $user) ?></strong>
        </div>
        <div class="pl-col pl-amount text-right">
            <strong><?= num(max($total_dirinc, $total_direxp))?></strong>
        </div>
        <!-- Direct Income Total (right side) -->
        <div class="pl-col pl-particulars text-right"><?= label('Total', $this, $user) ?></div>
        <div class="pl-col pl-amount text-right"><?= num(max($total_dirinc, $total_direxp)) ?></div>
  
</div>


</div>

<style>
.pl-container {
    width: 100%;
    font-family: Arial, sans-serif;
    border: 1px solid #ddd;
    border-radius: 4px;
    overflow: hidden;
}

.pl-header, .pl-row, .pl-group-header, .pl-total, .pl-result, .pl-section-header {
    display: flex;
    border-bottom: 1px solid #eee;
    padding: 8px 0;
}

.pl-section {
    display: flex;
}

.pl-side {
    width: 50%;
    border-right: 1px solid #eee;
}

.pl-side:last-child {
    border-right: none;
}

.pl-col {
    width: 50%;
    padding: 0 10px;
}

.pl-colspan-2 {
    width: 50%;
    padding: 0 10px;
    font-weight: bold;
}

.pl-particulars {
    text-align: left;
}

.pl-amount {
    text-align: right;
}

.pl-group-header {
    cursor: pointer;
    font-weight: bold;
    background-color: #f9f9f9;
}

.pl-group-items {
    display: none;
    background-color: #f5f5f5;
}

.pl-item {
    padding-left: 20px;
}

.pl-total {
    font-weight: bold;
    background-color: #f0f0f0;
}

.pl-result {
    font-weight: bold;
    background-color: #e9e9e9;
}

.pl-section-header {
    font-weight: bold;
    background-color: #e0e0e0;
}

.toggle-icon {
    display: inline-block;
    width: 15px;
}

.negative {
    color: red;
}
</style>

<script>
function toggleGroup(element, id) {
    const groupItems = document.getElementById(id);
    const toggleIcon = element.querySelector('.toggle-icon');
    
    if (groupItems.style.display === 'block') {
        groupItems.style.display = 'none';
        toggleIcon.textContent = '▼';
    } else {
        groupItems.style.display = 'block';
        toggleIcon.textContent = '▶';
    }
}

function showledger(id, name) {
    // Your existing ledger display function
    console.log("Show ledger:", id, name);
}
</script>