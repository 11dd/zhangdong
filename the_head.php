<!--Header-->
<div id="Header" class="f_l">
  <div id="Head">
    <div id="Logo"><a href="<?php echo get_option('home'); ?>/" title="<?php bloginfo('name'); ?>"><?php echo get_avatar(1); ?></a></div>
    <h1 id="Web_Title"><a href="<?php echo get_option('home'); ?>/" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a></h1>
  </div>
  <div class="head_text"><h2 id="Web_Description"><?php bloginfo('description'); ?></h2></div>
  <div id="Menu">
    <?php wp_nav_menu( array( 'theme_location' => 'lefter-menu' ) ); ?>
  </div>
  <div id="header_seach"><form method="get" id="searchform" action=""><table border="0" cellspacing="0" cellpadding="0"><tr><td><input class="searchInput" type="text" value="<?php if(htmlspecialchars($_GET['s'])){echo htmlspecialchars($_GET['s']);}else{echo '搜索';};?>" name="s" id="s"style="outline: none;" onfocus="if(this.value=='搜索'){this.value='';}" onblur="if(this.value==''){this.value='搜索';}"></td><td><input id="searchsubmit" class="searchBtn" type="submit" title="搜索" value=""></td></tr></table></form></div>
  <div id="Copys"><?php echo stripslashes(get_option('S_Copy')); ?></div>
</div>
<!--/Header-->