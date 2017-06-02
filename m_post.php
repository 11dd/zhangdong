<div class="m_post mb20">
  <div class="m_post_top">
    <?php if(has_post_thumbnail()){?>
    <div class="m_post_top_img the_hover"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank"><?php echo the_post_thumbnail(array(540,500));?></a></div>
    <?php }else{ ?>
    <h2 class="m_post_top_title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank">
      <?php the_title(); ?>
      </a></h2>
    <div class="m_post_top_text"><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 1000,"..."); ?></div>
    <?php } ?>
  </div>
  <div class="post_mata">  	
  	<span class="post_cate"><?php the_category('、') ?></span>
  	<span class="post_mata_time mata_ico"><a href="<?php the_permalink(); ?>" title="<?php the_time(''); ?>" target="_blank"><?php the_time('m-d'); ?></a></span>
    <?php if ( function_exists( 'printLikes' ) ) {?>
    <span class="the_like mata_ico"><?php printLikes(get_the_ID()); ?></span>
    <?php } ?>
    <span class="the_comments mata_ico"><?php comments_popup_link('0', '1', '%','', '评论已关闭'); ?></span>
    <?php if ( function_exists( 'the_views' ) ) {?>
    <span class="the_views mata_ico"><?php the_views();?></span>
    <?php } ?>
    <?php if(has_tag()){?>
    <span class="the_tag">
    <?php the_tags('', ' , ', ''); ?>
    </span><?php } ?> <br class="clearBoth">
  </div>
</div>
