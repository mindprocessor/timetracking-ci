<?php $this->extend('\Track\Views\layout\admin'); ?>

<?php $this->section('content'); ?>
<div class="container py-4">
    <div class="row">
        <div class="col">
            <h3>Report detail</h3>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <form method="post" up-submit up-disabled>
                <?=$msg;?>
                <div class="row g-3">
                    <?=csrf_field();?>
                    <div class="col-12">
                        <div class="p-3 rounded bg-primary bg-opacity-10">
                            <span>Title</span>
                            <div class="fs-5">
                                <?=$report['title'];?>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-3 rounded bg-primary bg-opacity-10">
                            <span>Submitted by</span>
                            <div class="fs-5">
                                <?=$user['username'];?>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-3 rounded bg-primary bg-opacity-10">
                            <span>Severity</span>
                            <div class="fs-5">
                                <?=$report['severity'];?>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="p-3 border rounded">
                            <div>Details</div>
                            <pre><?=$report['details'];?></pre>
                        </div>
                    </div>
                    <div class="col-12">
                        <label>Remarks</label>
                        <textarea name="remarks" cols="30" rows="10" class="form-control"><?=$pdata['remarks'];?></textarea>
                    </div>
                    <div class="col-12">
                        <div class="form-check">
                            <?php
                                echo form_checkbox(
                                    data:'resolved', 
                                    value:1,
                                    checked: ($pdata['resolved'] == 1) ? true : false,
                                    extra:[
                                        'class'=>'form-check-input',
                                        'id'=>'resolved-checkbox',
                                        ]
                                    );
                            ?>
                            <label class="form-check-label" for="resolved-checkbox">
                                Resolved
                            </label>
                        </div>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $this->endSection();?>