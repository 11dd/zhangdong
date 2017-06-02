<?php
/*
Template Name: 友情链接
*/
?>
<?php get_header()?>
<div id="Container" class="thewidth">
  <?php include('the_head.php');?>    
  <!--Central-->
  <div id="Central" class="f_r">
 
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="m_post mb20">
  <div class="m_post_top">
    <h2 class="m_post_top_title"><?php the_title(); ?></h2>
    <div class="m_post_top_text Con"><div id="PageLink"><ul><?php wp_list_bookmarks('title_li=&before=<li>&after=</li>&show_description=1'); ?></ul></div></div>
  </div>

</div>
<?php endwhile; else: ?><?php endif; ?>   

  </div>
  <!--/Central-->  
  <br class="clearBoth">
</div>
<?php get_footer()?>