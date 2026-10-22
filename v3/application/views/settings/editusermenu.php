
       <script type="text/javascript" src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css"  href="https://code.jquery.com/ui/1.11.4/themes/ui-lightness/jquery-ui.css"/>
        <link href="<?php echo base_url(); ?>assets/src/js/hummingbird-treeview.css" rel="stylesheet" type="text/css">
    <form method="post" home="<?php echo site_url('main/members/index'); ?>"  back="<?php echo site_url('settings/Menus/menuuser'); ?>"   action="<?php echo site_url('settings/Menus/Save'); ?>"  class="form-horizontal has-validation-callback">  
        
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
                            <input type="hidden" name="username" value="<?php echo $user[0]['Id'] ?>"/>
                                        <label value="<?php echo $user[0]['Id'] ?>" name=user class="col-sm-1 control-label" id="name_display_as_box">
                                            <?php echo $user[0]['user_name'] ?>
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

            <script src="<?php echo base_url(); ?>assets/src/js/hummingbird-treeview.js"></script>
            <script>
                  
            </script>
            <script type="text/javascript">

                

            </script>
    </body>
</html>
