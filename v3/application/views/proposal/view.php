<?php
	
?> 
<form method="post"  id="frmcreate" back="<?php echo site_url('Proposal/listall'); ?>" action="<?php echo site_url('Proposal/save'); ?>"  class="form-horizontal">
    <input type="hidden" value="<?= $id ?>" name="id" id="id" />
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Proposal', $this, $user) ?> Create</h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('Proposal/listall'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('Proposal/listall'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
							</a>
						</span>
					</div> 
                    <div class="box-body" id="printJS-form">
						<style>
							#printJS-form { 
							margin-left:48px;
							margin-right:48px;
							
							}
							#cc{ 
							position:relative;  
							width: 94%;
							height:auto;
							}
							div#header {
							position:fixed;
							top:0px;
							left:0px; 
							width:100%;
							color:#CCC;
							background:#333;
							padding:8px; 
							}
							#header img{
							height:100px;
							margin:auto;
							}
							
							div#footer {
							position:fixed;
							bottom:0px;
							left:0px;
							width:100%;
							height:40px;
							color:#CCC;
							border-top:2px double #000 ;
							background:#333;
							padding:8px;
							 
							}
							.printable {display:none;}
							@media print {
							.printable {display:block;}
							body
							{
							margin-top: 40mm;
							}
							hr {
							page-break-before: always;
							margin-top:40mm;
							color:#fff; 
							border: #fff;
						 
							}
							}
						</style>
						<div id="header" class="printable">
							<table style="color:black;width:90%;">
								<tr>
									<td><img alt="" src="<?php echo base_url(); ?>uploads/images/tricolour.png" style="height:100px; width:400px" /></td>
									<td style="text-align:right">
										<p>Door No &ndash;X / 303</p>
										<p>Office No - 09</p>
										<p>Cochin - 61</p>
										<p style="font-size:15px;font-weight:bold">GSTIN/UIN: 32AAOFT8210F1ZA</p>
									</td>
								</tr>
							</table>
						</div>
						
						<div id="cc"> 
							<table style="color:black;width:100%;margin-top:50px;">
								<tr>
									<td style="font-weight:bold;font-size:14px;width:80%"><p><?php echo $proposal['name'];?></p></td>
									<td style="font-weight:bold;font-size:13px;text-align:right"><?php echo $proposal['fdate'];?></td>
								</tr>
								<?php $arr_ph = explode(";",$proposal['address_line1']);
									
									$size = sizeof($arr_ph);?>
								<tr>
									<td  style="font-weight:bold;font-size:13px;width:80%"><i><?php echo str_replace(';', '<br />', $arr_ph[0]);  ?></i></td>
									<td style="font-weight:bold;font-size:13px;text-align:right">QTN No: <?php echo str_replace('<br />',';',$proposal['bill_no']);?></td>
								</tr>
								<?php for($i=1;$i<$size;$i++){?>
								<tr>
									<td  style="font-weight:bold;font-size:13px;width:80%"><i><?php echo str_replace(';', '<br />', $arr_ph[$i]);  ?></i></td>
									<td></td>
								</tr>
								<?php }?>
							</table>
							<?php echo $proposal['text'];?>
							<div class="col-sm-12 " >
								<font style="font-size:14px;">Thank You ,<br /></font><br />
								For <font style="color:red;font-size:16px;font-weight:bold">Tricolour Trading and Contracting</font><br />
								<img  style="float:left;" src="<?php echo base_url();?>uploads/images/thanks1.png" />
								
							</div>
						</div>
						<div id="footer" class="printable">
							<table style="color:red;width:100%">
								<tr>
									<td style="text-align:center">+91 9947875882</td>
									<td style="text-align:center">Door No &ndash;X / 303</td>
									<td style="text-align:center">info@ tricolourwll.com</td>
								</tr>
								<tr>
									<td style="text-align:center">+91 8589952872</td>
									<td style="text-align:center">Office No - 09 Cochin - 61</td>
									<td style="text-align:center">www.tricolourwll.com</td>
								</tr>
								
							</table>
						</div>
                        <!-- /.box -->
					</div>
                    <div class="box-footer" class="col-sm-12">
						
						<button class="btn btn-primary" type="button" onclick="printJS({ printable: 'printJS-form', type: 'html'  })">
							<span class="glyphicon glyphicon-print"></span>
						</button>
					</div>
				</div>
			</div>
		</div>
        <!-- /.col -->
		
        <!-- /.row -->
	</section>
	<script src="<?php echo base_url(); ?>asset/plugins/ckeditor/ckeditor.js"></script>
	<!-- Bootstrap WYSIHTML5 -->
	<script src="<?php echo base_url(); ?>asset/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <script type="text/javascript">
		$.validate({
            modules: 'security'
		});
		
        $(document).ready(function () {
			
			
			
		});
		
		
		
		
		
		
	</script> 		