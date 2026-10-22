<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>jQuery hummingbird-treeview Demo</title>
        <script type="text/javascript" src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <link rel="stylesheet" type="text/css"  href="https://code.jquery.com/ui/1.11.4/themes/ui-lightness/jquery-ui.css"/>
        <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
        <link href="https://bootswatch.com/cosmo/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="<?php echo base_url(); ?>assets/src/js/hummingbird-treeview.css" rel="stylesheet" type="text/css">
    <form method="post" home="<?php echo site_url('main/members/index'); ?>"  back="<?php echo site_url('settings/Menus/menuuser'); ?>"   action="<?php echo site_url('settings/Menus/Save'); ?>"  class="form-horizontal has-validation-callback">  
        <style>
            body { background-color:#fafafa;}
            .container { margin:0px auto; min-height:0vh;}
            .stylish-input-group .input-group-addon{
                background: white !important;
            }
            .stylish-input-group .form-control{
                box-shadow:0 0 0;
                border-color:#ccc;
            }
            .stylish-input-group button{
                border:0;
                background:transparent;
            }

            .h-scroll {
                background-color: #fcfdfd;
                height: 260px;
                overflow-y: scroll;
            }
        </style>
    </head>

    <body>
        <!-- <div id="jquery-script-menu">
        <div class="jquery-script-center">
        <ul>
        <li><a href="https://www.jqueryscript.net/other/Collapsible-Tree-View-Checkboxes-jQuery-hummingbird/">Download This Plugin</a></li>
        <li><a href="https://www.jqueryscript.net/">Back To jQueryScript.Net</a></li>
        </ul>
        <div class="jquery-script-ads"><script type="text/javascript"><!
        google_ad_client = "ca-pub-2783044520727903";
        /* jQuery_demo */
        google_ad_slot = "2780937993"
        google_ad_width = 728;
        google_ad_height = 90;
        //-->
        </script>
        <script type="text/javascript"
                src="https://pagead2.googlesyndication.com/pagead/show_ads.js">
        </script></div>
     <?php
    $output = array_filter($list, function($object) {
        return ($object['Url'] == '');
    });

    function getchild($list, $val) {
        $filter_rules = array(
            'parent' => $val
        );
        $filter = function ($player) use ($filter_rules) {
            foreach ($filter_rules as $rulekey => $rulevalue) {
                if ($player[$rulekey] != $rulevalue) {
                    return false;
                }
            }
            return true;
        };
        $filtered = array_filter($list, $filter);
        return $filtered;
    }
    ?>

        <div class="jquery-script-clear"></div>
        <div class="container">
            <div id="treeview_container" class="hummingbird-treeview well h-scroll-large">
                <ul> <li><div class="col-sm-2" id="name_input_box">
                            <select name="username" data-validation="required" id="username" data-validation="required"  class="form-control" >
                                <option value="">Select</option>
                                <?php foreach ($user as $type) { ?>
                                    <option value="<?php echo $type['id']; ?>"><?php echo $type['username']; ?></option>
                                <?php } ?>
                            </select>

                        </div> 
                    </li>
                </ul>
                <div id="treeview_container" class="hummingbird-treeview">
                    <ul id="treeview" class="hummingbird-base">
                        <?php foreach ($output as $item) { ?>
                            <li><i class="fa fa-minus"></i> <label> <input id="node-0-<?php echo $item['id'] ?>" data-id="custom-0-<?php echo $item['id'] ?>"  name="chk[]" <?php if ($item['menu_id'] > 0) { ?>checked="checked"<?php } ?> value="<?php echo $item['id'] ?>" type="checkbox"> <?php echo $item['ListName'] ?></label>
                                <?php
                                $aisl = getchild($list, $item['id']);
                                if (count($aisl) > 0) {
                                    ?>
                                    <ul>
                                        <?php foreach ($aisl as $chi) { ?>
                                            <li><i class="fa fa-plus"></i> <label> <input id="node-0-1-<?php echo $chi['id'] ?>" data-id="custom-1-<?php echo $chi['id'] ?>" type="checkbox" name="chk[]" <?php if ($chi['is_read'] == 1 or $chi['is_write'] == 1 or $chi['is_delete'] == 1) { ?>checked="checked"<?php } ?> value="<?php echo $chi['id'] ?>">  <?php echo $chi['ListName'] ?></label>
                                                <ul><li><label><input id="read<?php echo $chi['id'] ?>"  name="read<?php echo $chi['id'] ?>"<?php if ($chi['is_read'] == 1) { ?>checked="checked"<?php } ?> data-id="custom-1-1-<?php echo $chi['id'] ?>" type="checkbox"> Read</label>
                                                    </li><li> <label> <input id="Write<?php echo $chi['id'] ?>" name="write<?php echo $chi['id'] ?>" <?php if ($chi['is_write'] == 1) { ?>checked="checked"<?php } ?> data-id="custom-1-2-<?php echo $chi['id'] ?>" type="checkbox"> Write</label>
                                                    </li><li> <label> <input id="Delete<?php echo $chi['id'] ?>" name="delete<?php echo $chi['id'] ?>"  <?php if ($chi['is_delete'] == 1) { ?>checked="checked"<?php } ?> data-id="custom-1-3-<?php echo $chi['id'] ?>" type="checkbox"> Delete</label>
                                                    </li>
                                                </ul> <?php }
                                        ?></li>                
                                    </ul>
                                </li>
                                <?php
                            }
                        }
                        ?>
                        <input type="submit" align="center" name="submit" value="Submit">  

                    </ul>
                </div>
            </div>

            <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
            <script src="<?php echo base_url(); ?>assets/src/js/hummingbird-treeview.js"></script>
            <script>
                    $("#treeview").hummingbird();
                    $("#checkAll").click(function () {
                        $("#treeview").hummingbird("checkAll");
                    });
                    $("#uncheckAll").click(function () {
                        $("#treeview").hummingbird("uncheckAll");
                    });
                    $("#collapseAll").click(function () {
                        $("#treeview").hummingbird("collapseAll");
                    });
                    $("#checkNode").click(function () {
                        $("#treeview").hummingbird("checkNode", {attr: "id", name: "node-0-2-2", expandParents: false});
                    });
            </script>
            <script type="text/javascript">

                var _gaq = _gaq || [];
                _gaq.push(['_setAccount', 'UA-36251023-1']);
                _gaq.push(['_setDomainName', 'jqueryscript.net']);
                _gaq.push(['_trackPageview']);

                (function () {
                    var ga = document.createElement('script');
                    ga.type = 'text/javascript';
                    ga.async = true;
                    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                    var s = document.getElementsByTagName('script')[0];
                    s.parentNode.insertBefore(ga, s);
                })();

            </script>
    </body>
</html>
