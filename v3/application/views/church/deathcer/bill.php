<html>
<head>
    <style >
    span.cls_002{font-family:"Old English Text MT",serif;font-size:32.3px;color:rgb(55,52,53);font-weight:bold;text-align: center;font-style:normal;text-decoration: none}
div.cls_002{font-family:"Old English Text MT",serif;font-size:20.3px;color:rgb(55,52,53);font-weight:normal;font-style:normal;text-decoration: none}
span.cls_003{font-family:Times,serif;font-size:17.1px;color:rgb(55,52,53);text-align: center;font-weight:bold;font-style:normal;text-decoration: none}
div.cls_003{font-family:Times,serif;font-size:17.1px;color:rgb(55,52,53);font-weight:bold;font-style:normal;text-decoration: none}
span.cls_004{font-family:Times,serif;font-size:17.1px;color:rgb(55,52,53);font-weight:bold;font-style:normal;text-decoration: none}
div.cls_004{font-family:Times,serif;font-size:12.1px;color:rgb(55,52,53);font-weight:bold;font-style:normal;text-decoration: none}
span.cls_005{font-family:Times,serif;font-size:17.1px;color:rgb(55,52,53);font-weight:bold;font-style:italic;text-decoration: none}
div.cls_005{font-family:Times,serif;font-size:12.1px;color:rgb(55,52,53);font-weight:bold;font-style:italic;text-decoration: none}
span.cls_006{font-family:Arial,serif;font-size:24.7px;color:rgb(254,255,255);font-weight:bold;font-style:normal;text-decoration: none}
div.cls_006{font-family:Arial,serif;font-size:24.7px;color:rgb(254,255,255);font-weight:bold;font-style:normal;text-decoration: none}
span.cls_007{font-family:"Freestyle Script",serif;font-size:19.1px;color:rgb(55,52,53);font-weight:bold;font-style:normal;text-decoration: none}
div.cls_007{font-family:"Freestyle Script",serif;font-size:30.1px;color:rgb(55,52,53);font-weight:normal;font-style:normal;text-decoration: none}
  body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: black;
        font: 12pt ;
    }
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }
    .page {
        width: 210mm;
        min-height: 297mm;
        
        margin: 20mm auto;
        border: 1px  solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }
    .subpage {
        
        
        height: 257mm;
        
    }
    
    @page {
        size: A4;
        margin: 0;
    }
    @media print {
        html, body {
            width: 210mm;
            height: 297mm;        
        }
        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }
    }
    </style>
    <script type="text/javascript" src="71c0df76-b8b1-11e8-b59b-0cc47a792c0a_id_71c0df76-b8b1-11e8-b59b-0cc47a792c0a_files/wz_jsgraphics.js"></script>
</head>

<body >
<div class="book">
    <div class="page">
        
        <div class="subpage"style="position:absolute;">
<img src="<?php echo base_url()?>assets/images/free-certificate-.jpg" width="791" height="1105">
<div style="position:absolute;left:75.86px;top:140.13px" class="cls_002"><span class="cls_002"><?php echo $company['name'] ?></span></div>
<div style="position:absolute;left:110.86px;top:200.99px" class="cls_003"><span class="cls_003">(UNDER THE HOLY APOSTOLIC SEE OF ANTIOCH & ALL THE EAST)</span></div><br />
<div style="position:absolute;left:310.57px;top:230.49px" class="cls_004"><span class="cls_004">ANGAMALY DIOCESE</span></div><br />
<div style="position:absolute;left:180.98px;top:260.77px" class="cls_004"><span class="cls_004">Pukkattupady, Kizhakkambalam P.O - 683 562 ,aluva (via)</span></div>>
<div style="position:absolute;left:280.48px;top:287.06px" class="cls_005"><span class="cls_005">Eranakulam Dist , Kerala India</span></div>
<div style="position:absolute;left:277.38px;top:312.24px" class="cls_006"><span class="cls_006">DEATH CERTIFICATE</span></div>
<div style="position:absolute;left:318.37px;top:455.08px" class="cls_007"><span class="cls_007">This is to acknowledge the death of</span></div>
<div style="position:absolute;left:165.27px;top:490.10px" class="cls_007"><span class="cls_007"><b><?php echo ucfirst(strtolower($deathcer['mbr_name'])); ?></b></span></div>
<div style="position:absolute;left:445.27px;top:490.10px" class="cls_007"><span class="cls_007"> <?php echo $deathcer['fmm_age']; ?> </span></div>
<div style="position:absolute;left:515.27px;top:490.10px" class="cls_007"><span class="cls_007"> <?php echo $deathcer['deathdate']; ?></span></div>

<div style="position:absolute;left:155.27px;top:495.10px" class="cls_007"><span class="cls_007">.................................................  age  .......... on .....................</span></div>
<div style="position:absolute;left:173.85px;top:540.14px;" class="cls_007"><span class="cls_007">as per the Death Register maintained in this Church.</span></div>

<div style="position:absolute;left:143.85px;top:800.60px" class="cls_007"><span class="cls_007" style="font-size:30px; text-align:justify;">Punnala<br/><?php $dt = new DateTime();echo $dt->format('d-m-Y'); ?>
</span></div>
<div style="position:absolute;left:450.80px;top:800.60px" class="cls_007"><span class="cls_007"><?php echo ucfirst(strtolower($deathcer['priestname'])); ?><br/>Vicar</span></div>
</div>
        </div>    
    </div>
    
</div>
</body>
</html>