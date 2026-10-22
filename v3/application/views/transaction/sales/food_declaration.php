<?php
// Function to safely embed images directly into the HTML so PDF engines never fail
function render_pdf_img($relative_path, $style = '', $extra_attr = '') {
    $doc_root = isset($_SERVER['DOCUMENT_ROOT']) ? rtrim($_SERVER['DOCUMENT_ROOT'], '/') : '';
    $clean_path = ltrim($relative_path, '/');
    $full_path = $doc_root . '/' . $clean_path;

    if (!empty($relative_path) && file_exists($full_path)) {
        $ext = strtolower(pathinfo($full_path, PATHINFO_EXTENSION));
        $mime = ($ext === 'jpg' || $ext === 'jpeg') ? 'image/jpeg' : 'image/png';
        $base64 = base64_encode(file_get_contents($full_path));
        return '<img src="data:' . $mime . ';base64,' . $base64 . '" style="' . $style . '" ' . $extra_attr . ' />';
    } elseif (!empty($relative_path) && file_exists($relative_path)) {
        $ext = strtolower(pathinfo($relative_path, PATHINFO_EXTENSION));
        $mime = ($ext === 'jpg' || $ext === 'jpeg') ? 'image/jpeg' : 'image/png';
        $base64 = base64_encode(file_get_contents($relative_path));
        return '<img src="data:' . $mime . ';base64,' . $base64 . '" style="' . $style . '" ' . $extra_attr . ' />';
    }
    return '&nbsp;';
}

$invoice_no   = !empty($sales[0]['invoice']) ? $sales[0]['invoice'] : 'EXPFC08/26-27';
$invoice_date = !empty($sales[0]['in_date']) ? $sales[0]['in_date'] : '28-06-2026';
$container_no = !empty($sales[0]['container_no']) ? $sales[0]['container_no'] : 'ONEU8014115';

$logo_rel_path      = !empty($company['logo']) ? 'uploads/company/' . $company['logo'] : '';
$signature_rel_path = 'uploads/company/signature.png'; // adjust to your signature filename
$stamp_rel_path     = 'uploads/company/stamp.png';     // adjust to your seal filename
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Food Declaration</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 25mm 20mm 20mm 20mm;
        }
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 13.5px;
            color: #000;
            margin: 0;
            padding: 0;
            line-height: 1.4;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        .date-text {
            font-size: 13.5px;
            font-weight: bold;
            text-align: right;
        }
        .invoice-block {
            font-size: 13px;
            line-height: 1.5;
            font-weight: 500;
        }
        .declaration-body {
            font-size: 13.5px;
            line-height: 1.55;
            text-align: justify;
        }
        .signatory-name {
            font-size: 12.5px;
            line-height: 1.35;
        }
        .footer-text {
            font-size: 11px;
            line-height: 1.5;
            text-align: center;
            color: #000;
        }
    </style>
</head>
<body>

    <!-- 1. Top Logo (Right-aligned) -->
    <table border="0" cellpadding="0" cellspacing="0" style="margin-bottom: 25px;">
        <tr>
            <td style="width: 60%;"></td>
            <td style="width: 40%; text-align: right;" align="right" valign="top">
                <?php echo render_pdf_img($logo_rel_path, 'max-height: 75px; max-width: 190px;'); ?>
            </td>
        </tr>
    </table>

    <!-- 2. Date (Right-aligned, below logo) -->
    <table border="0" cellpadding="0" cellspacing="0" style="margin-bottom: 50px;">
        <tr>
            <td class="date-text" align="right">
                Date: <?php echo htmlspecialchars($invoice_date); ?>
            </td>
        </tr>
    </table>

    <!-- 3. Invoice & Container (Indented left block) -->
    <table border="0" cellpadding="0" cellspacing="0" style="margin-bottom: 60px;">
        <tr>
            <td style="width: 11%;"></td>
            <td style="width: 89%;" class="invoice-block">
                Invoice No: . <?php echo htmlspecialchars($invoice_no); ?><br>
                Container Number:<?php echo htmlspecialchars($container_no); ?>
            </td>
        </tr>
    </table>

    <!-- 4. Declaration Content Body -->
    <table border="0" cellpadding="0" cellspacing="0" style="margin-bottom: 75px;">
        <tr>
            <td class="declaration-body">
                Food product supplied in these consignments is for human consumption and commercially manufactured and packed. Goods are clean and free from contaminants, seeds, soil, animal, plant debris and other biosecurity risk materials, Goods are retail packaged in clean and new packaging.
            </td>
        </tr>
    </table>

    <!-- 5. Signatory, Handwritten Signature & Blue Seal -->
    <table border="0" cellpadding="0" cellspacing="0" style="margin-bottom: 120px;">
        <tr>
            <td class="signatory-name" style="padding-bottom: 12px;">
                Yours Sincerely,<br>
                Jimmy jose<br>
                CEO, FOODCREST LLP
            </td>
        </tr>
        <tr>
            <td>
                <table border="0" cellpadding="0" cellspacing="0" style="width: auto;">
                    <tr>
                        <!-- Signature Image -->
                        <td valign="middle" style="padding-right: 20px;">
                            <?php echo render_pdf_img($signature_rel_path, 'height: 50px; width: auto;'); ?>
                        </td>
                        <!-- Blue Seal Stamp -->
                        <td valign="middle">
                            <?php echo render_pdf_img($stamp_rel_path, 'height: 85px; width: auto;'); ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <!-- 6. Bottom Address Footer (Matches exact wording & structure from your image, no line) -->
    <table border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td class="footer-text" align="center">
                FOODCREST LLP | 17/505 |MARUTHORVATTOMP.OITHANNEERMUKKOM |CHERTHALA|<br>
                Alappuzha | Kerala | India | 688539<br>
                Email: Facory@foodcrest.in | Sales@foodcrest.in | Phone: +91 9567190965
            </td>
        </tr>
    </table>

</body>
</html>