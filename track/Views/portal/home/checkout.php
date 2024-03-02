<?php $this->extend('\Track\Views\layout\main'); ?>


<?php $this->section('content'); ?>

<div class="container pt-3">

    <div class="row">
        <div class="col-12">
            <h3>Check OUT</h3>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <div class="rounded border p-3">
                <h5 class="mb-3">End of Day Report</h5>

                <form method="post" up-submit>
                    <?=csrf_field();?>
                    <div>
                        <label>Details</label>
                        <textarea name="details" class="form-control"><?=$pdata['details']; ?></textarea>
                        <?=error_tag($errors['details'] ?? null);?>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary px-5">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<?php $this->endSection();?>