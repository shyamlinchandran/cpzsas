<form method="post"  id="frmcreate" back="<?php echo site_url('kaasma/enquiry/create'); ?>" action="<?php echo site_url('kaasma/enquiry/save'); ?>"  class="form-horizontal">
    <input type="hidden" value="<?= $id ?>" name="id" id="id" />
    <input type="hidden" value="<?= $enq_no; ?>" name="enq_no_add" id="enq_no_add" />
    <section class="content"> 
        <div class="row">
           <!--  data-validation="server" data-validation-url="<?php echo site_url('kaasma/enquiry/save'); ?>" -->
            <div class="col-xs-12"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo ucwords(str_replace('_', ' ', $title)) ?></h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('kaasma/enquiry/listall/'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('kaasma/enquiry/listall/'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
                            </a>
                        </span>
                    </div> 

                    <div class="box-body">
                        <div class="tab-pane" id="timeline">
                            <!-- The timeline -->
                            <!-- <div class="box-header with-border mailbox-controls">
                                <h3 class="box-title">Time Line</h3>
                                <div class="btn-group pull-right">
                                    <button type="button" class="btn btnPrevious btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                                    <button type="button" class="btn btnNext btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                                </div> 
                            </div> -->
                            <ul class="timeline timeline-inverse">

                                <!-- timeline time label -->
                                <?php foreach ($details as $item) { ?>
                                    <li class="time-label">
                                        <span class="bg-red"> <?php echo $item['enqno'] ?>  </span>

                                    </li>       
                                    <li>
                                        <i class="fa fa-envelope bg-blue"></i>

                                        <div class="timeline-item">  
                                            <h3 class="timeline-header"><a href="#">Enquiry History</a> </h3>
                                            <div class="timeline-body">
                                                <b>User   :</b>   <?php echo $item['user'] ?> <br></br>
                                                <b>Status   :</b>   <?php echo $item['enqstatus'] ?> <br></br>
                                                <b>Updated On      :</b>   <?php echo $item['updatedate'] ?> <br></br>
                                            </div> 
                                        </div>
                                    </li>
                                <?php } ?>  


                                <li>
                                    <i class="fa fa-clock-o bg-gray"></i>
                                </li>
                            </ul>
                            <div class="btn-group pull-right">
                                <button type="button" class="btn btnPrevious btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                                <button type="button" class="btn btnNext btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                            </div> 
                        </div>
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
    </section>