<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
  
   <!--Incluye el Favicon-->
  <link rel="icon" type="image/vnd.microsoft.icon" href="<?php echo get_site_url(); ?>/favicon.ico" />
  
  <!--Incluye el css de bootstrap-->
  
  <!-- Latest compiled and minified CSS -->

  <link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/css/bootstrap.min.css">
  
  <!--Optional Theme-->
  <link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/style.css">
  <link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/css/font-awesome.css">


  <!-- Latest compiled and minified JavaScript -->
  <script src="<?php bloginfo( 'template_url' ); ?>/js/jquery-1.12.4.min.js"></script> 
 
  <script src="<?php bloginfo( 'template_url' ); ?>/js/bootstrap.min.js"></script>
  <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_MX/sdk.js#xfbml=1&version=v2.6&appId=556541261138043";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

</head>
