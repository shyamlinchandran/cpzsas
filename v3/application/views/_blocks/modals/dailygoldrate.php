<div class="modal fade" id="myModalGold">
    <form method="post" id="frmGoldmodal" action="<?php echo site_url('Categor_price_model/save'); ?>" home="<?php echo site_url('main/members/index'); ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="modal-title"><?= label('Add/Edit Daily Gold Rate', $this, $user) ?></h4>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input value = "0" type = "hidden" name ="modal_gold_id" id = "modal_gold_id"/>
                            <div class="col-md-6">
                                <label class="control-label">
                                    <?= label('Date', $this, $user) ?>
                                </label>
                                <input autofocus type ="text" id ="modal_gold_date" name = "modal_gold_date"  class ="form-control date"/>
                            </div>
                            <div class="col-md-6">
                                <label class="control-label">
                                    <?= label('Category', $this, $user) ?>
                                </label>
                                <select data-validation="required"  name="modal_gold_category" id="modal_gold_category" class="form-control">
                                    <option value="">Select</option>
                                </select>
                            </div>

                        </div>


                        <div class="col-md-12">
                            <div class="col-md-6">
                                <label class="control-label">
                                    <?= label('Gold Rate', $this, $user) ?>
                                </label>
                                <input data-validation="required" type ="text" id ="modal_gold_rate" name = "modal_gold_rate"  class ="form-control"/>
                            </div>
                            <div class="col-md-6">
                                <label class="control-label">
                                    <?= label('Old Gold Rate', $this, $user) ?>
                                </label>
                                <input data-validation="required" type ="text" id ="modal_old_gold_rate" name = "modal_old_gold_rate"  class ="form-control"/>
                            </div>

                        </div>


                 
                    </div>
                </div>
                <div class="modal-footer">
                    <button data-toggle="tooltip" type="button" hddid="" title="Add To save" id="btnaddgoldrate" class="btn btn-success" href="#">
                        Save
                    </button>
                    <button type="button" id="" class="btn btn-secondary" data-dismiss="modal"><?= label('Close', $this, $user) ?></button>
                </div>
            </div>
        </div>
    </form>
</div>