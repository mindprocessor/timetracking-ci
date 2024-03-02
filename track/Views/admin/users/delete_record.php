<?php $this->extend('\Track\Views\layout\admin'); ?>

<?php $this->section('content'); ?>
<div class="container py-4">
    
    <h3>Users / Delete user / <?=$user['username'];?></h3>
    
    <div class="row g-3">

        <div class="col-12">
            <?php echo session('fmsg'); ?>
            
            <div class="p-3 rounded border">
                <a href="<?=base_url("admin/user/id/{$user['id']}");?>" class="btn btn-light">
                    &leftarrow; Back to user
                </a>
            </div>
        </div>

        <div class="col-12">
            <div class="p-3 bg-opacity-10 bg-primary rounded">
                <h6>User Information</h6>
                <div class="row g-3 mt-1">
                    <div class="col">
                        <small>Username</small>
                        <p class="lead fw-bold"><?=$user['username'];?></p>
                    </div>
                    <div class="col">
                        <small>First name</small>
                        <p class="lead fw-bold"><?=$user['first_name'];?></p>
                    </div>
                    <div class="col">
                        <small>Last name</small>
                        <p class="lead fw-bold"><?=$user['last_name'];?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">

            <form method="post" class="py-3 px-4 bg-light rounded border">
                <h6 class="mb-4">Delete User <?=$user['username'];?></h6>

                <?=csrf_field();?>

                <div class="row g-3">

                    <div class="col-12">
                        <div class="alert alert-danger">
                            <p>Are you sure you want to <strong>DELETE</strong> this user along with all the <strong>DATA RELATED</strong> to it?</p>
                            <p>Once deleted it <strong>CANNOT</strong> be undone.</p>
                        </div>
                    </div>
                    
                    <div class="col-sm-6 col-md-4">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control"/>
                        <?=error_tag($errors['password'] ?? null);?>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary mt-4">
                            Continue delete
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
<?php $this->endSection();?>