<?php get_header()?>
<div id="Container" class="thewidth">
  <?php include('the_head.php');?>  
  <!--Central-->
  <div id="Central" class="f_r">
 
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="m_post mb20">
  <div class="m_post_top">
    <h2 class="m_post_top_title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
      <?php the_title(); ?>
      </a></h2>
    <div class="m_post_top_text Con">
	<?php the_content(''); ?>
    <?php wp_link_pages( array( 'before' => '<p class="pages">' . __( '分页:'), 'after' => '</p>' ) ); ?>
    </div>
  </div>
  <div class="post_mata">
  	<span class="post_cate"><?php the_category('、') ?></span>
  	<span class="post_mata_time mata_ico"><a href="<?php the_permalink(); ?>" title="<?php the_time(''); ?>" target="_blank"><?php the_time('Y-m-d'); ?></a></span>
    <?php if ( function_exists( 'printLikes' ) ) {?>
    <span class="the_like mata_ico"><?php printLikes(get_the_ID()); ?></span>
    <?php } ?>
     <?php if ( function_exists( 'the_views' ) ) {?>
    <span class="the_views mata_ico"><?php the_views();?></span>
    <?php } ?>
    <?php if(has_tag()){?>
    <span class="the_tag"><?php the_tags('', ' , ', ''); ?></span>
	<?php } ?>
    <br class="clearBoth">
  </div>

	<?php if (get_previous_post()||get_next_post()) {?>
    <div class="post_page mb20">
    <?php if (get_previous_post()) { previous_post_link('<span>上一篇: %link</span>','%title',true);} ?>
    <?php if (get_next_post()) { next_post_link('<span>下一篇: %link</span>','%title',true);} ?>
    </div>
    <?php } ?>

</div>
<div class="m_post mb20"><div class="post_comm"><?php comments_template(); ?></div></div>
<?php endwhile; else: ?><?php endif; ?>   

  </div>
  <!--/Central-->  
  <br class="clearBoth">
</div>
<?php get_footer()?>