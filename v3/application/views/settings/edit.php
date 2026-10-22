<form method="post" home="<?php echo site_url('main/members/index'); ?>"  back="<?php echo site_url('settings/companytype/menuuser'); ?>"action="<?php echo site_url('settings/companytype/SaveCtype'); ?>">  

    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary"> 
                    <div class="box-header with-border">

                        <h3 class="box-title">Edit MenuType</h3>

                    </div>
                    <div class="box-body">
                        <div id="accordion"> 
                            <div id="example-0"> 
                                

                                
                                <input type="hidden" name="type" value="<?=$id?>"/>

                                <ul> 
                                    


                                    <?php foreach ($result as $menuid) { ?>

                                        <?php
                                        if ($menuid['id'] == $menuid['menuid']) {
                                            $params = 'checked="checked"'; 
                                        } else {
                                            $params = ''; 
                                        }
                                        ?> 

                                        <li>
                                            <input type="checkbox" <?php echo $params; ?>  name="chk[]"  value="<?php echo $menuid['id'] ?>"><span><?php echo $menuid['ListName'] ?></span>
                                        </li>
										</br>
                                    <?php }
                                    ?>

                                    <input type="submit" name="Update" value="Submit">  

                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>