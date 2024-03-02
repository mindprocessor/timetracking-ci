<!DOCTYPE html>
<html lang="en">

<head>
    <title> 24/7 intouch - tracking tool </title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=base_url('assets/bs5/css/bootstrap.min.css');?>">
    <link rel="stylesheet" href="<?=base_url('assets/unpoly/unpoly.min.css');?>">

    <script src="<?=base_url('assets/bs5/js/bootstrap.min.js');?>"></script>
    <script src="<?=base_url('assets/js/moment.min.js');?>"></script>
    <script src="<?=base_url('assets/js/htmx.min.js');?>"></script>
    <script src="<?=base_url('assets/unpoly/unpoly.min.js');?>"></script>
    <script src="<?=base_url('assets/js/jquery.js');?>"></script>
    <script src="<?=base_url('assets/js/base.js');?>"></script>
</head>

<body>

    <?php 
        if(session('uid')) {
            echo view('\Track\Views\blocks\header_admin');
        }
    ?>

    <main>
        <?php $this->renderSection('content'); ?>
    </main>

    <?php $this->renderSection('bottomtags'); ?>

</body>
</html>