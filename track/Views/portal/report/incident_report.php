<?php $this->extend('\Track\Views\layout\main'); ?>


<?php $this->section('content'); ?>

<div class="container py-4">

    <div class="row">
        <div class="col-12">
            <h3>Incident Report</h3>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <div class="p-4 border rounded bg-dark bg-opacity-10">
                <form method="post" up-submit up-disable>
                    <?=$msg;?>
                    <?=session('fmsg');?>
                    <div class="row g-3">
                        <?=csrf_field();?>
                        <div class="col-12">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" value="<?=$pdata['title']??null;?>">
                            <?=error_tag($errors['title'] ?? null);?>
                        </div>
                        <div class="col-12">
                            <label>Severity</label>
                            <select name="severity" class="form-control">
                                <?php 
                                    foreach($severity_choices as $choices){
                                        if(isset($pdata['severity']) && $pdata['severity'] == $choices){
                                            echo "<option selected>{$choices}</option>";
                                        }else{
                                            echo "<option>{$choices}</option>";
                                        }
                                    }
                                ?>
                            </select>
                            <?=error_tag($errors['severity'] ?? null);?>
                        </div>
                        <div class="col-12">
                            <label>Details</label>
                            <textarea name="details" class="form-control" style="min-height:300px;"><?=$pdata['details']??null;?></textarea>
                            <?=error_tag($errors['details'] ?? null);?>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Submit report</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

</div>

<?php $this->endSection();?>