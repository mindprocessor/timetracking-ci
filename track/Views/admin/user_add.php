<?php $this->extend('\Track\Views\layout\admin'); ?>

<?php $this->section('content'); ?>
<div class="container py-4">
    
    <h3>Users / Add new user</h3>
    
    <div class="row g-3">
        <div class="col-12">
            <div class="p-3 rounded border">
                <a href="<?=base_url("admin/users");?>" class="btn btn-light">
                    &leftarrow; Back to users
                </a>
            </div>
        </div>
        <div class="col">
            <?php echo session('fmsg'); ?>

            <form method="post" class="py-3 px-4 bg-light rounded border">
                <h6 class="mb-4">User Information</h6>

                <?=csrf_field();?>

                <div class="row g-3">

                    <div class="col-6">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" value="<?=$pdata['username'];?>"/>
                        <?=error_tag($errors['username'] ?? null);?>
                    </div>

                    <div class="col-6">
                        <label>Employee ID</label>
                        <input type="text" name="eid" class="form-control" value="<?=$pdata['eid'];?>"/>
                        <?=error_tag($errors['eid'] ?? null);?>
                    </div>

                    <div class="col-6">
                        <label>First name</label>
                        <input type="text" name="first_name" class="form-control" value="<?=$pdata['first_name'];?>"/>
                        <?=error_tag($errors['first_name'] ?? null);?>
                    </div>

                    <div class="col-6">
                        <label>Last name</label>
                        <input type="text" name="last_name" class="form-control" value="<?=$pdata['last_name'];?>"/>
                        <?=error_tag($errors['last_name'] ?? null);?>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <label>Acount</label>
                        <input type="text" name="account" class="form-control" value="<?=$pdata['account'];?>"/>
                        <?=error_tag($errors['account'] ?? null);?>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="<?=$pdata['email'];?>"/>
                        <?=error_tag($errors['email'] ?? null);?>
                    </div>

                    <div class="col-sm-12 col-md-4">
                        <label>Level</label>
                        <select name="level" class="form-control">
                            <?php
                                foreach($level_choices as $level){
                                    if($pdata['level'] == $level){
                                        echo "<option selected>{$level}</option>";
                                    }else{
                                        echo "<option>{$level}</option>";
                                    }
                                }
                            ?>
                        </select>
                        <?=error_tag($errors['level'] ?? null);?>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <label>Password</label>
                        <input type="text" name="password" class="form-control" value="<?=$pdata['password'];?>"/>
                        <?=error_tag($errors['password'] ?? null);?>
                    </div>

                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary mt-4">
                            Save Changes
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
<?php $this->endSection();?>