<?php get_header()?>
<div id="Container" class="thewidth">
  <?php include('the_head.php');?>    
  <!--Central-->
  <div id="Central" class="f_r">
 	<h2 id="ArchiveTitle"><?php printf('搜索结果 ：%s', '<span id="search-key">' . get_search_query() . '</span>' ); ?></h2>
  
    <?php if (have_posts()) : ?>
    <?php $i=1;
while (have_posts()) : the_post(); ?>
    <?php include('m_post.php');?>
    <?php $i++;
endwhile; ?>
	<?php else : ?>
    
    <h3 class="has_nosearch">未能找到你想要的内容....</h3>
    
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