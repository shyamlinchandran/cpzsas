<div class="modal fade" id="myModal_item">
    <form method="post" id="frmItemmodal" action="<?php echo site_url('Modalcontroller/save_item'); ?>" home="<?php echo site_url('main/members/index'); ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="modal-title"><?= label('Create Item*', $this, $user) ?></h4>
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
                                    <?= label('Item Name', $this, $user) ?>
                                </label>
                                <input autofocus data-validation="required" maxlength="250" type="text" id="modal_itemName" name="modal_itemName" class="form-control" />
                            </div>
                            <div class="col-md-6">
									<?= label('Barcode', $this, $user) ?>
									&nbsp; <?= label('Auto', $this, $user) ?> &nbsp; <input type="radio" checked name="modal_isautoBarcode" id="modal_isautoBarcode" value="1" onchange="modalsetbarcode()">
									&nbsp;  <?= label('Manual', $this, $user) ?> &nbsp; <input type="radio" name="modal_isautoBarcode" onchange="modalsetbarcode()" id="modal_isautoBarcode" value="0">
									&nbsp;  <input data-validation="required" maxlength="100" type="text" name="modal_itemBarcode" id="modal_itemBarcode" class="form-control" />
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <label class="control-label">
                                    <?= label('Item category', $this, $user) ?>
                                </label>
                                <select data-validation="required" onchange="modalsetbarcode()" name="modal_itemCategory" id="modal_itemCategory" class="form-control">
                                    <option value="">Select</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="control-label">
                                    <?= label('Item Brand', $this, $user) ?>
                                </label>
                                <select name="modal_itemBrand" id="modal_itemBrand" class="form-control">
                                    <option value="">Select</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <?= label('Item Tax', $this, $user) ?>
                                <select data-validation="required" name="modal_itemTax" id="modal_itemTax" class="form-control">
                                    <option>Select</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="control-label">
                                    <?= label('Item Unit', $this, $user) ?>
                                </label>
                                <select data-validation="required" name="modal_itemUnit" id="modal_itemUnit" class="form-control">
                                    <option value="">Select</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
							<div class="col-md-6">
                                <label class="control-label">
                                    <?= label('Hsncode', $this, $user) ?>
                                </label>
                                <select data-validation="required" name="modal_itemhsn" id="modal_itemhsn" class="form-control">
                                    <option value="">Select</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="control-label">
                                    <?= label('Item Prate', $this, $user) ?>
                                </label>

                                <input id="modal_itemPrate" class="form-control two-digits price" name="modal_itemPrate" type="text" value="" maxlength="50">
                            </div>
                            
                        </div>
                        <div class="col-md-12">
							<div class="col-md-6">
                                <label class="control-label">
                                    <?= label('Item MRP', $this, $user) ?>
                                </label>
                                <input class="form-control two-digits price" id="modal_itemMrp" name="modal_itemMrp" type="text" value="" maxlength="50">
                            </div>
                            <div class="col-md-6">
                                <label class="control-label">
                                    <?= label('Item Srate', $this, $user) ?>
                                </label>
                                <input class="form-control two-digits price" id="modal_itemSrate" name="modal_itemSrate" type="text" value="" maxlength="50">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button data-toggle="tooltip" type="button" hddid="" title="Add To save" id="btnsaveitemModal" class="btn btn-success" href="#">
                        Save
                    </button>
                    <button type="button" id="btncls" class="btn btn-secondary" data-dismiss="modal"><?= label('Close', $this, $user) ?></button>
                </div>
            </div>
        </div>
    </form>
</div>