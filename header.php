<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>
<?php
/*
* Print the <title> tag based on what is being viewed.
*/
global $page, $paged;
wp_title('_', true, 'right');
// Add the blog name.
bloginfo( 'name' );
// Add the blog description for the home/front page.
$site_description = get_bloginfo( 'description', 'display' );
if ( $site_description && ( is_home() || is_front_page() ) )
echo " | $site_description";
// Add a page number if necessary:
// if ( $paged >= 2 || $page >= 2 )
// echo '   ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );
?>
</title>
<link rel="icon" href="http://www.shejiwo.net/wp-content/themes/shejiwo/images/ico.png" type="image/x-icon" />
<link rel="shortcut icon" href="http://www.shejiwo.net/wp-content/themes/shejiwo/images/ico.png" type="image/x-icon" />
<?php if(is_single()){?>
<?php if(get_post_meta($post->ID, "keywords_value", true)){ ?>
<meta name="keywords" content="<?php echo get_post_meta($post->ID, "keywords_value", true); ?>"/>
<?php }else{ ?>
<meta name="keywords" content="<?php echo stripslashes(get_option('S_Keyword')); ?>"/>
<?php } ?>
<?php }else{ ?>
<meta name="keywords" content="<?php echo stripslashes(get_option('S_Keyword')); ?>"/>
<?php } ?>
<?php if(is_single()){?>
<?php if(get_post_meta($post->ID, "description_value", true)){ ?>
<meta name="description" content="<?php echo get_post_meta($post->ID, "description_value", true); ?>"/>
<?php }else{ ?>
<meta name="description" content="<?php echo stripslashes(get_option('S_Description')); ?>"/>
<?php } ?>
<?php }else{ ?>
<meta name="description" content="<?php echo stripslashes(get_option('S_Description')); ?>"/>
<?php } ?>
<link rel="stylesheet" href="<?php echo get_bloginfo("template_url");?>/includes/reset.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo get_bloginfo("template_url");?>/includes/jquery-1.6.4.min.js"></script>
<script type="text/javascript" src="<?php echo get_bloginfo("template_url");?>/includes/jquery.lazyload.js"></script>
<script type="text/javascript" src="<?php echo get_bloginfo("template_url");?>/includes/personal2.js"></script>
<?php wp_head();?>
<script>
$().ready(function(){
	$("#Central img").lazyload({
		effect : "fadeIn",
		failurelimit : 5
	});
});
</script>
</head>
<body>
