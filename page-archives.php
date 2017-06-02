<?php
/*
Template Name: 归档页面
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
    <div class="m_post_top_text Con">
    <?php shejiwo_archives_list(); ?>
    </div>
  </div>

</div>
<?php endwhile; else: ?><?php endif; ?>   

  </div>
  <!--/Central-->  
  <br class="clearBoth">
</div>
<?php get_footer()?>