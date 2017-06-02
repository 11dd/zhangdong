<?php get_header()?>
<div id="Container" class="thewidth">
  <?php include('the_head.php');?>   
  <!--Central-->
  <div id="Central" class="f_r">
    <?php if (have_posts()) : ?>
    <?php $i=1;
while (have_posts()) : the_post(); ?>
    <?php include('m_post.php');?>
    <?php $i++;
endwhile; ?>
    <?php endif ?>    
    
    <br class="clearBoth">
    
	<?php if(function_exists('wp_pagenavi')) { ?>
    <div id="Pagenavis">
    <?php wp_pagenavi(); ?>
    </div>
    <?php }?>    
  </div>
  <!--/Central-->  
  <br class="clearBoth">
</div>
<?php get_footer()?>