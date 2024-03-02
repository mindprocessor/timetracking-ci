<div id="incident-form-container">
    <?php echo $msg ?? null; ?>
    <form method="post" 
        hx-post="<?=base_url('htmx/home/incident-report-form');?>"
        hx-swap="outerHTML"
        hx-target="#incident-form-container">
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