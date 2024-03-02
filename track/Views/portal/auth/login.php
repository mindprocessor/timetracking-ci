<?php $this->extend('\Track\Views\layout\main'); ?>


<?php $this->section('content'); ?>

<div class="container">

    <div class="mt-5 row d-flex justify-content-center">
        <div class="col-12 col-sm-6">
            <div class="p-4 border bg-light">
                <h4 class="mb-4">24/7 intouch</h4>

                <?php echo $msg; ?>

                <?php echo form_open() ;?>

                    <div>
                        <label>Username</label>
                        <input type="text" name="username" class="form-control">
                        <?php echo error_tag($errors['username'] ?? null); ?>
                    </div>

                    <div class="mt-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control">
                        <?php echo error_tag($errors['password'] ?? null); ?>
                    </div>

                    <div class="mt-3 text-center">
                        <button type="submit" class="btn btn-primary px-5">
                            Login
                        </button>
                    </div>

                <?php echo form_close();?>
            </div>
        </div>    
    </div>

</div>

<?php $this->endSection();?>