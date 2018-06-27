<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <?=isset($content_for_layout_meta)?$content_for_layout_meta:'';?>
    <title>Techspecs</title>

    <!-- Bootstrap core CSS -->    
    <link href="<?php echo FRONT_CSS_PATH; ?>token-input.css" rel="stylesheet">
    <link href="<?php echo FRONT_CSS_PATH; ?>bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo FRONT_CSS_PATH; ?>doc.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo FRONT_CSS_PATH; ?>bootstrap-select.css"> 
    <script src="<?php echo FRONT_JS_PATH;?>jquery-1.10.2.min.js"></script>

</head>

<body>
<?=isset($content_for_layout_header)?$content_for_layout_header:'';?>

<!-- Content Wrapper. Contains page content -->
<?=isset($content_for_layout_middle)?$content_for_layout_middle:'';?>


<?=isset($content_for_layout_footer)?$content_for_layout_footer:'';?>
<!-- Bootstrap core JavaScript -->

<script src="<?php echo FRONT_JS_PATH;?>bootstrap.js"></script>
<script src="<?php echo FRONT_JS_PATH;?>bootstrap-select.js"></script>
<script src="<?php echo FRONT_JS_PATH;?>jquery.tokeninput.js"></script>
<script>
$('.request_btn').click( function(){
    if ( $(this).hasClass('current') ) {
        $(this).removeClass('current');
    } else {
        $('.request_btn.current').removeClass('current');
        $(this).addClass('current');    
    }
});
$('.open_sos').click( function(){
    if ( $(this).hasClass('open') ) {
        $(this).removeClass('open');
    } else {
        $('.open_sos.open').removeClass('open');
        $(this).addClass('open');    
    }
});
$(document).ready(function(){
		$('#open').click(function(){
		$('#hide').slideToggle();
		});
	});
$(document).ready(function() {
    // $("#product_search_field").tokenInput( "<?php echo FRONTEND_URL."product/autocomplete"; ?>", {
    //   tokenLimit: 1,
    // });

    $( "#product_search_field" ).autocomplete({
        source: '<?php echo FRONTEND_URL."product/autocomplete"; ?>'
    });

    $('#send_request').click(function(){
        var email    = $('#request_email').val();
        var category = $('#request_category').val();
        var device   = $('#request_device').val();
        if(email == '')
        {
            $('#request_message').html('Please enter your email');
            return false;
        }
        if(device == '')
        {
            $('#request_message').html('Please enter device name');
            return false;
        }

        $.ajax({
            'type' : 'POST',
            'data' : {email:email,category:category,device:device},
            'url'  : '<?php echo FRONTEND_URL; ?>'+ 'welcome/request_device',
            'success' : function(msg){
                $('#request_message').html(msg);
            } 
          });
    });

    $('.alpha_search').click(function(){
        var alpha    = $(this).text();
        
        $.ajax({
            'type' : 'POST',
            'data' : {alpha:alpha},
            'beforeSend' : function(){
                $('.loading_img').show();
            },
            'url'  : '<?php echo FRONTEND_URL; ?>'+ 'welcome/ajax_alpha',
            'success' : function(msg){
                $('#alpha_search_sec').html(msg);
                $('.loading_img').hide();
            } 
          });
    });
});

</script>
</body>
</html>
