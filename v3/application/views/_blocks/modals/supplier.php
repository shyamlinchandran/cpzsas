<div class="modal fade" id="myModal_Supplier">
    <form method="post" id="frmSuppliermodal" action="<?php echo site_url('Modalcontroller/save_supplier'); ?>" home="<?php echo site_url('main/members/index'); ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 id="modal_title_Supplier" class="modal-title"></h4>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                    </div> 
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <label class="control-label">
                                    <label id="modal_field_Supplier"></label> <?= label(' Name', $this, $user) ?>
                                </label>
                                <input type="hidden" name="modal_supplierType" id="modal_supplierType" class="form-control" />
                                <input autofocus data-validation="required" maxlength="250" type="text" id="modal_supplierName" name="modal_supplierName" class="form-control" />
                            </div>
                            <div class="col-md-6">
                                <label class="control-label">
                                    <?= label('Phone', $this, $user) ?>
                                </label>
                                <input maxlength="250" type="text" id="modal_supplierPhone" name="modal_supplierPhone" class="form-control" />
                            </div>

                        </div>
                        
                        <div class="col-md-12">
                            <?php if(strtolower($this->session->userdata('login_comid')) == 'omgold' ){ ?>
                                <div class="col-md-6">
                                    <label class="control-label">
                                        <?= label('Aadhar', $this, $user) ?>
                                    </label>
                                    <input id="modal_aadhar" class="form-control" name="modal_aadhar" type="text" value="" maxlength="20">   

                                </div>
                                <div class="col-md-6">
                                    <label class="control-label">
                                        <?= label('Pan', $this, $user) ?>
                                    </label>
                                    <input id="modal_pan" class="form-control" name="modal_pan" type="text" value="" maxlength="20">   

                                </div>
                            <?php }?>
                            <div class="col-md-6">
                                <label class="control-label">
                                    <?= label('GSTIN', $this, $user) ?>
                                </label>
                                <input maxlength="16" type="text" id="modal_supplierGST" name="modal_supplierGST" class="form-control" />

                            </div>
                            <div class="col-md-6">
                                <label class="control-label">
                                    <?= label('Email', $this, $user) ?>
                                </label>
                                <input type="text" id="modal_supplierEmail" name="modal_supplierEmail" class="form-control" />

                            </div>
							
							<div class="col-md-6">
                                <label class="control-label">
                                    <?= label('State', $this, $user) ?>
                                </label>
                                <select id="modal_supplierstate" name="modal_supplierstate" class="form-control" >
								</select>
                            </div>
							
							
							<div class="col-md-6">
                                <label class="control-label">
                                    <?= label('Area', $this, $user) ?>
                                </label>
                                <select id="modal_supplierArea" name="modal_supplierArea" class="form-control" >
								</select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <?= label('Addres', $this, $user) ?>
                                <textarea id="modal_supplierAdd1" name="modal_supplierAdd1" class="form-control"></textarea>
                            </div>
                            <div class="col-md-6">
                                <?= label('Addresline 2', $this, $user) ?>
                                <textarea id="modal_supplierAdd2" name="modal_supplierAdd2" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">

                    <button data-toggle="tooltip" type="button" hddid="" title="Add To save" id="btnsaveSupplierModal" class="btn btn-success" href="#">
                        Save
                    </button>
                    <button type="button" id="btncls" class="btn btn-secondary" data-dismiss="modal"><?= label('Close', $this, $user) ?></button>
                </div>
            </div>
        </div>
    </form>
</div>