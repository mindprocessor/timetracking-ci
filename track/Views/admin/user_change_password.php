<?php $this->extend('\Track\Views\layout\admin'); ?>

<?php $this->section('content'); ?>
<div class="container py-4">
    
    <h3>Users / Chamge Password / <?=$user['username'];?></h3>
    
    <div class="row g-3">
        <div class="col-12">
            <div class="p-3 rounded border">
                <a href="<?=base_url("admin/user/id/{$user['id']}");?>" class="btn btn-light">
                    &leftarrow; Back to user details
                </a>
            </div>
        </div>
        <div class="col-sm-12 col-md-6">
            <?php echo session('fmsg'); ?>

            <form method="post" class="py-3 px-4 bg-light rounded border">
                <h6 class="mb-4">Change password for <?=$user['username'];?></h6>

                <?=csrf_field();?>

                <div class="row g-3">

                    <div class="col-12">
                        <label>New Password</label>
                        <input type="password" name="new_password" class="form-control"/>
                        <?=error_tag($errors['new_password'] ?? null);?>
                    </div>

                    <div class="col-12">
                        <label>Your Current Password</label>
                        <input type="password" name="current_password" class="form-control"/>
                        <?=error_tag($errors['current_password'] ?? null);?>
                    </div>

                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary mt-4">
                            Proceed Change Password
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
<?php $this->endSection();?>