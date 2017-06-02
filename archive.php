<?php get_header()?>
<div id="Container" class="thewidth">
  <?php include('the_head.php');?>    
  <!--Central-->
  <div id="Central" class="f_r">
 	<h2 id="ArchiveTitle">
      <?php if ( is_category() ) : ?>
      <?php single_cat_title(); ?>
      <?php elseif ( is_day() ) : ?>
      Archive for
      <?php the_time( 'F jS, Y' ); ?>
      <?php elseif ( is_month() ) : ?>
      Archive for
      <?php the_time( 'F, Y' ); ?>
      <?php elseif ( is_year() ) : ?>
      Archive for
      <?php the_time('Y'); ?>
      <?php elseif ( is_tag() ) : ?>
      TAG: <?php single_tag_title(); ?>
      <?php endif; ?>
    </h2>
  
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