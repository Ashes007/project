<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    

    <?=isset($content_for_layout_meta)?$content_for_layout_meta:'';?>
    <title>Website</title>

    <!-- Bootstrap core CSS -->    
    <link href="<?php echo FRONT_CSS_PATH; ?>bootstrap.css" rel="stylesheet">
    <link href="<?php echo FRONT_CSS_PATH; ?>doc.css" rel="stylesheet">
    <link href="<?php echo FRONT_CSS_PATH; ?>style.css" rel="stylesheet">
    <link href="<?php echo FRONT_CSS_PATH; ?>font-awesome.css" rel="stylesheet">
    <link href="<?php echo FRONT_CSS_PATH; ?>font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i,900" rel="stylesheet"> 
    
    
</head>

<body>
<div class="wrapper">
<?=isset($content_for_layout_header)?$content_for_layout_header:'';?>

<!-- Content Wrapper. Contains page content -->
<?=isset($content_for_layout_middle)?$content_for_layout_middle:'';?>


<?=isset($content_for_layout_footer)?$content_for_layout_footer:'';?>

</div>
<!-- Bootstrap core JavaScript
================================================== -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="<?php echo FRONT_JS_PATH;?>js/bootstrap.js"></script>
</body>
</html>
