<?php
$is_discount = 1;
$is_bankac = 1;
$login_comid = $this->session->userdata('login_base_comid');
$language = $this->language;
$user = '';
$img_file2 = ''; // Set base_url() . 'assets/images/bg.jpg' if sample 2 uses a background image

// Extract PAN from GSTIN (Characters 3 to 12 of GSTIN usually represent the PAN)
$pan_number = '';
if(isset($company['tin']) && strlen($company['tin']) >= 15) {
    $pan_number = substr($company['tin'], 2, 10);
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>New PDF</title>
        <style>
            body {
                font-family: sans-serif;
            }
            div {
                margin: 0px !important;
                padding: 0px !important;
            }
            .cls33 {
                width: 35%;
                float: left;
                font-size: 13px;
                font-family: sans-serif;
            }
            .cls30 {
                width: 30%;
                float: left;
                font-size: 13px;
                font-family: sans-serif;
            }
            .hedrnd {
                background-color: transparent; /* Changed to transparent to keep background color as is */
                border-radius: 10px; 
            }
            .hedrnd p {
                padding-left: 10px;
                line-height: 1.5;
            }
            .txtleft { text-align: left; }
            .txtright { text-align: right; }
        </style>
    </head>
    <!-- Kept background property structure similar to bill_settings.php to ensure background color/image applies -->
    <body style="width:100%; padding: 0px; margin: 0; background-repeat: no-repeat; background-size: contain; background-image: url('<?= $img_file2 ?>');">

        <!-- HEADER SECTION -->
        <div style="width:100%; padding: 0px; margin: 0px;">

            <!-- Left Section: Company Name and Address -->
            <div class="cls33 txtleft hedrnd">
                <p>
                    <font style="font-size:18px; font-weight:bold;"><?php echo isset($company['name']) ? $company['name'] : ''; ?></font><br/>
                    <?php echo isset($company['address']) ? $company['address'] : ''; ?>
                </p>  
            </div>

            <!-- Middle Section: Company Logo -->
            <div class="cls30"> 
                <?php if(isset($company['logo']) && $company['logo'] != ""){ ?>
                    <img align="middle" style="margin: 0px;" width="100%" height="100px" src="uploads/company/<?php echo $company['logo']; ?>" />  
                <?php } else { echo '&nbsp;'; } ?>
            </div>

            <!-- Right Section: Mobile, GSTIN, PAN Number -->
            <div class="cls33 txtright hedrnd">
                <p>
                    <strong>Mobile:</strong> <?php echo isset($company['phone']) ? $company['phone'] : ''; ?> <br/>
                    <strong>GSTIN:</strong> <?php echo isset($company['tin']) ? $company['tin'] : ''; ?> <br/>
                    <strong>PAN Number:</strong> <?php echo $pan_number; ?>
                </p>  
            </div>

        </div>
        <div style="clear: both;"></div>

        <!-- THE OTHER SECTION: REMOVED ALL TEXT AND LINES AS REQUESTED -->
        <!-- Only the background color/image from the body will be visible below this point -->

    </body>
</html>
