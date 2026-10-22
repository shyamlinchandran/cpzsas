<link href="<?php echo base_url(); ?>assets/css/hummingbird-treeview.css" rel="stylesheet" type="text/css">
<form method="post"    back="<?php echo site_url('settings/MenuToUser/listall'); ?>"   action="<?php echo site_url('settings/MenuToUser/Save'); ?>"  class="form-horizontal has-validation-callback">  
</head>
<?php
$result = array_filter($list, function($object) {
    return ($object['parent'] == '0');
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
<style> 
    ul li ul li ul {
        /*        background: #FF9797; */

    }
    ul li ul li ul li {
        list-style: none;
        /*        float: left;*/
    }
</style>

<section class="content"> 
    <div class="row">
        <div class="col-xs-12"> 
            <div class="box box-primary"> 
                <div class="box-header with-border">
                    <h3 class="box-title">Menus Create</h3>
                    <span class="pull-right"> <a role="button"
                                                 class="btn  btn-success align-bottom"
                                                 href="<?php echo site_url('settings/MenuToUser/listall'); ?>"> <span
                                class="glyphicon glyphicon-arrow-left" title="back"></span>
                        </a>
                    </span>
                </div>
                <div class="box-body">

                    <div class="container">
                        <div  class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                User-type<span class="required">*</span>  :
                            </label>
                            <div class="col-sm-10">
                                <select name="username" data-validation="required" id="username" data-validation="required" style="width:200px" class="form-control" >
                                    <option value="">Select</option>
                                    <?php foreach ($user as $type) { ?>
                                        <option value="<?php echo $type['Id']; ?>"><?php echo $type['username']; ?></option>
                                    <?php } ?>
                                </select> 
                            </div> 
                        </div>

                        <div id=" treeview_container" class="col-sm-12 form-group hummingbird-treeview">
                            <ul id="treeview" class="hummingbird-base">
                                <?php foreach ($result as $item) { ?>
                                    <li><i class="fa fa-plus"></i> <label> <input id="node-0-<?php echo $item['id'] ?>" data-id="custom-0-<?php echo $item['id'] ?>"  name="chk[]" value="<?php echo $item['id'] ?>" type="checkbox"> <?php echo $item['ListName'] ?></label>
                                        <?php
                                        $aisl = getchild($list, $item['id']);
                                        if (count($aisl) > 0) {
                                            ?>
                                            <ul>
                                                <?php foreach ($aisl as $chi) { ?>
                                                    <li><i class="fa fa-plus"></i> <label> <input id="node-0-1-<?php echo $chi['id'] ?>" data-id="custom-1-<?php echo $chi['id'] ?>" type="checkbox" name="chk[]" value="<?php echo $chi['id'] ?>">  <?php echo $chi['ListName'] ?></label>
														<?php if($chi['Url']!=""){ ?>
															<ul>
                                                                <li><label><input id="add<?php echo $chi['id'] ?>"  name="add<?php echo $chi['id'] ?>" data-id="custom-1-4-<?php echo $chi['id'] ?>" type="checkbox"> Add</label>
																</li>
                                                                <li><label><input id="read<?php echo $chi['id'] ?>"  name="read<?php echo $chi['id'] ?>" data-id="custom-1-1-<?php echo $chi['id'] ?>" type="checkbox"> Read</label>
																</li>
                                                                <li> <label> <input id="Write<?php echo $chi['id'] ?>" name="write<?php echo $chi['id'] ?>" data-id="custom-1-2-<?php echo $chi['id'] ?>" type="checkbox"> Edit</label>
																</li>
                                                                <li> <label> <input id="Delete<?php echo $chi['id'] ?>" name="delete<?php echo $chi['id'] ?>" data-id="custom-1-3-<?php echo $chi['id'] ?>" type="checkbox"> Delete</label>
																</li>

                                                                <li> <label> <input id="cancel<?php echo $chi['id'] ?>" name="cancel<?php echo $chi['id'] ?>" data-id="custom-1-5-<?php echo $chi['id'] ?>" type="checkbox"> Cancel</label>
																</li>
															</ul> 
														<?php } else{ $submenus = getchild($list, $chi['id']);if (count($aisl) > 0) {?>
															<ul>
																<?php foreach ($submenus as $chi) { ?>
																	<li><i class="fa fa-plus"></i> <label> <input id="node-0-1-<?php echo $chi['id'] ?>" data-id="custom-1-<?php echo $chi['id'] ?>" type="checkbox" name="chk[]" value="<?php echo $chi['id'] ?>">  <?php echo $chi['ListName'] ?></label>
																	<ul>
                                                                        
                                                                        <li><label><input id="add<?php echo $chi['id'] ?>"  name="add<?php echo $chi['id'] ?>" data-id="custom-1-4-<?php echo $chi['id'] ?>" type="checkbox"> Add</label>
																        </li>
                                                                        <li><label><input id="read<?php echo $chi['id'] ?>"  name="read<?php echo $chi['id'] ?>" data-id="custom-1-1-<?php echo $chi['id'] ?>" type="checkbox"> Read</label>
																        </li>
                                                                         <li> <label> <input id="Write<?php echo $chi['id'] ?>" name="write<?php echo $chi['id'] ?>" data-id="custom-1-2-<?php echo $chi['id'] ?>" type="checkbox"> Edit</label>
																        </li>
                                                                        <li> <label> <input id="Delete<?php echo $chi['id'] ?>" name="delete<?php echo $chi['id'] ?>" data-id="custom-1-3-<?php echo $chi['id'] ?>" type="checkbox"> Delete</label>
																	    </li>
                                                                        <li> <label> <input id="cancel<?php echo $chi['id'] ?>" name="cancel<?php echo $chi['id'] ?>" data-id="custom-1-5-<?php echo $chi['id'] ?>" type="checkbox"> Cancel</label>
																        </li>
                                                                    </ul> 
																	</li>    
                                                                 <?php } ?>                                  
                                                           </ul>
														<?php }}?>
                                                    </li>    
                                                <?php } ?>
                                            </ul>
                                        </li>
                                        <?php
                                    }
                                }
                                ?>
                        </div>
                    </div>  
                    <input type="submit" align="center" name="submit" value="Submit">   

                </div>
            </div>
        </div>
    </div>
</section>
<script src="<?php echo base_url(); ?>assets/src/js/hummingbird-treeview.js"></script>
<script>
    $("#treeview").hummingbird();
</script>

