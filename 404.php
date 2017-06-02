<?php get_header()?>
<div id="Container" class="thewidth">
  <?php include('the_head.php');?>  
  <!--Central-->
  <div id="Central" class="f_r">
 
<div class="m_post mb20">
  <div class="m_post_top">  
	<div id="Page_404">
        <h1>404</h1>
        <h2>未找到页面</h2>
        <div id="post_404_link"><a href="javascript:history.go(-1);">返回</a><a href="<?php echo get_settings('Home'); ?>">首页</a> </div>
    </div>
  </div>
</div>  

  </div>
  <!--/Central-->  
  <br class="clearBoth">
</div>
<?php get_footer()?>