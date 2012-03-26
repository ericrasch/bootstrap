<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="<?php bloginfo('name'); ?>">

<!-- fav and touch icons -->
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/assets/ico/favicon.ico">
<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/assets/ico/apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/assets/ico/apple-touch-icon-72x72-precomposed.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/assets/ico/apple-touch-icon-114x114-precomposed.png">

<!-- CSS styles -->
<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>">
<link href="<?php echo get_template_directory_uri(); ?>/assets/css/bootstrap-responsive.css" rel="stylesheet">

<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!--  BEGIN WordPress generated header
  ================================================== -->
<?php wp_head(); ?>
<!--  END WordPress generated header
  ================================================== -->

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> Feed" href="<?php echo home_url(); ?>/feed/">

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php if ( is_singular() ) wp_enqueue_script( "comment-reply" ); ?>
