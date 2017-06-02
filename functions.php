<?php
header("Content-type: text/html; charset=utf-8");

// 定义目录常量
define('THEME_FUNCTIONS', TEMPLATEPATH . '/includes/functions');
define('THEME_IMAGES', get_template_directory_uri() . '/images' );

//用户资料添加自定义用户头像功能
require_once(THEME_FUNCTIONS . '/simple-local-avatars.php');

// 去除头部不必要信息
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);

// 后台登陆LOGO修改
function custom_login_logo() {
echo "<link rel='stylesheet' id='colors-fresh-css'  href='".get_bloginfo("template_url")."/includes/admin_style.css' type='text/css' media='all' />";
//$ranum=rand(1,10);
//echo "<style>body.login{background:url(".get_bloginfo("template_url")."/images/login_bg".$ranum.".jpg) top center fixed;}</style>";
}
add_action('login_head', 'custom_login_logo');

//关闭前台显示管理工具条
show_admin_bar(false);

//友情链接
add_filter( 'pre_option_link_manager_enabled', '__return_true' );

//主题自定义菜单
register_nav_menus(
	array(
		'lefter-menu' => __( '左侧导航' )
	)
);

//密码保护提示
function password_hint( $c ){
global $post, $user_ID, $user_identity;
if ( empty($post->post_password) )
return $c;
if ( isset($_COOKIE['wp-postpass_'.COOKIEHASH]) && stripslashes($_COOKIE['wp-postpass_'.COOKIEHASH]) == $post->post_password )
return $c;
if($hint = get_post_meta($post->ID, 'password_hint', true)){
$url = get_option('siteurl').'/wp-pass.php';
if($hint)
$hint = '密码提示：'.$hint;
else
$hint = "请输入您的密码";
if($user_ID)
$hint .= sprintf('欢迎进入，您的密码是：', $user_identity, $post->post_password);
$out = <<<END
<form method="post" action="$url">
<p>这篇文章是受保护的文章，请输入密码继续阅读:</p>
<div>
<label>$hint<br/>
<input type="password" name="post_password"/></label>
<input type="submit" value="Submit" name="Submit"/>
</div>
</form>
END;
return $out;
}else{
return $c;
}
}
add_filter('the_content', 'password_hint');


//文章归档页面
function shejiwo_archives_list() {
 if( !$output = get_option('shejiwo_archives_list') ){
	 $output = '<div id="archives"><p>[<a id="al_expand_collapse" href="#">全部展开/收缩</a>] <em>(注: 点击月份可以展开)</em></p>';
	 $the_query = new WP_Query( 'posts_per_page=-1&ignore_sticky_posts=1' ); //update: 加上忽略置顶文章
	 $year=0; $mon=0; $i=0; $j=0;
	 while ( $the_query->have_posts() ) : $the_query->the_post();
		 $year_tmp = get_the_time('Y');
		 $mon_tmp = get_the_time('m');
		 $y=$year; $m=$mon;
		 if ($mon != $mon_tmp && $mon > 0) $output .= '</ul></li>';
		 if ($year != $year_tmp && $year > 0) $output .= '</ul>';
		 if ($year != $year_tmp) {
			 $year = $year_tmp;
			 $output .= '<h3 class="al_year">'. $year .' 年</h3><ul class="al_mon_list">'; //输出年份
		 }
		 if ($mon != $mon_tmp) {
			 $mon = $mon_tmp;
			 $output .= '<li><span class="al_mon">'. $mon .' 月</span><ul class="al_post_list">'; //输出月份
		 }
		 $output .= '<li>'. get_the_time('d日: ') .'<a href="'. get_permalink() .'">'. get_the_title() .'</a> <em>('. get_comments_number('0', '1', '%') .')</em></li>'; //输出文章日期和标题
	 endwhile;
	 wp_reset_postdata();
	 $output .= '</ul></li></ul></div>';
	 update_option('shejiwo_archives_list', $output);
 }
 echo $output;
}
function clear_zal_cache() {
 update_option('shejiwo_archives_list', ''); // 清空 zww_archives_list
}
add_action('save_post', 'clear_zal_cache'); // 新发表文章/修改文章时




//为WordPress添加自定义域可视化面板

//创建需要的字段信息
$new_meta_boxes =
array(
    "keywords" => array(
        "name" => "keywords",
        "std" => "",
        "title" => "关键字",
		"style" => "textarea"),
    "description" => array(
        "name" => "description",
        "std" => "",
        "title" => "网页描述",
		"style" => "textarea"
		)
);

//创建自定义字段输入框
function new_meta_boxes() {
    global $post, $new_meta_boxes;?><table width="100%" border="0" cellspacing="0" cellpadding="5" style="font-family: 微软雅黑; font-size:14px;"><style>.the_text{ line-height:20px;font-size:14px; padding-right:6px;}</style><?php foreach($new_meta_boxes as $meta_box) {
$meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);
echo "<tr>";if($meta_box_value == "")$meta_box_value = $meta_box['std'];
echo '<td width="150" align="right" valign="top">';
echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
echo'<label for="'.$meta_box['name'].'_value"><h4 style="font-size:14px;font-weight:200;padding:2px 2px; margin:0;font-family: 微软雅黑;">'.$meta_box['title'].'：</h4></label>';
echo '</td><td align="left"  valign="top" style="padding:2px 2px;">';
if($meta_box['style']=='textarea'){
echo '<textarea cols="70" rows="3" name="'.$meta_box['name'].'_value" id="'.$meta_box['name'].'_value">'.$meta_box_value.'</textarea>';
}elseif($meta_box['style']=='input'){
echo '<input name="'.$meta_box['name'].'_value" id="'.$meta_box['name'].'_value" type="text" value="'.$meta_box_value.'" size="70" placeholder="'.$meta_box['placeholder'].'"  class="the_text">';
}elseif($meta_box['style']=='input2'){
echo '<input name="'.$meta_box['name'].'_value" id="'.$meta_box['name'].'_value" type="text" value="'.$meta_box_value.'" size="50" placeholder="'.$meta_box['placeholder'].'" class="the_text">';
}elseif($meta_box['style']=='input3'){
echo '<input name="'.$meta_box['name'].'_value" id="'.$meta_box['name'].'_value" type="text" value="'.$meta_box_value.'" size="20" placeholder="'.$meta_box['placeholder'].'" class="the_text">';
}elseif($meta_box['style']=='checkbox'){ 
?><input name="<?php echo $meta_box['name'].'_value';?>" id="<?php echo $meta_box['name'].'_value';?>" type="checkbox" <?php if($meta_box_value){echo 'checked';}?> style="height:26px;line-height:26px;"><?php 
}if($meta_box['points']){echo '<span style="font-size:12px; color:#999;display:block;padding:2px 0px;">'.$meta_box['points'].'</span>';}echo '</td>';} echo '</tr></table>';}


//创建自定义字段模块
function create_meta_box() {
    global $theme_name;
    if ( function_exists('add_meta_box') ) {
        add_meta_box( 'new-meta-boxes', '文章参数设置', 'new_meta_boxes', 'post', 'normal', 'high' );
    }
}


//保存文章数据
function save_postdata( $post_id ){
    global $post, $new_meta_boxes;
    foreach($new_meta_boxes as $meta_box) {
        if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) ))  {
            return $post_id;
        }
        if ( 'page' == $_POST['post_type'] ) {
            if ( !current_user_can( 'edit_page', $post_id ))
                return $post_id;
        }
        else {
            if ( !current_user_can( 'edit_post', $post_id ))
                return $post_id;
        } 
        $data = $_POST[$meta_box['name'].'_value']; 
        if(get_post_meta($post_id, $meta_box['name'].'_value') == "")
            add_post_meta($post_id, $meta_box['name'].'_value', $data, true);
        elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true))
            update_post_meta($post_id, $meta_box['name'].'_value', $data);
        elseif($data == "")
            delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));
    }
}
add_action('admin_menu', 'create_meta_box');
add_action('save_post', 'save_postdata');





//设计窝主题选项
add_action('admin_menu', 'simple_theme_page'); 
function simple_theme_page (){ 
$action=$_POST['action'];

//常规设置
if ( count($_POST) > 0 && isset($_POST['simple_settings']) ){$S_Keyword = array ('S_Keyword'); foreach ( $S_Keyword as $S_Keyword ){delete_option ($S_Keyword, $_POST[$S_Keyword]);add_option($S_Keyword, $_POST[$S_Keyword]);}		$S_Description = array ('S_Description'); foreach ( $S_Description as $S_Description ){delete_option($S_Description, $_POST[$S_Description]);add_option ($S_Description, $_POST[$S_Description] );}$S_Copy = array ('S_Copy');foreach ( $S_Copy as $S_Copy ){delete_option ( $S_Copy, $_POST[$S_Copy] );add_option ( $S_Copy, $_POST[$S_Copy] );}header("location:".'admin.php?page=functions.php');}add_menu_page(__('设计窝主题选项'), __('设计窝主题选项'), 'edit_themes', basename(__FILE__), 'simple_settings'); }function simple_settings(){?>
<style>#Wrap{font-size:14px;font-family:'微软雅黑', '宋体';}#Wrap h2 {font-weight:100;}#Wrap em {font-size:12px;color:#999;margin-bottom:5px;}#Settings {font-size:14px;font-family:'微软雅黑', '宋体';}.Sma {font-size:12px;margin-left:10px;}.Sinp {line-height:20px;width:500px;}.Sinp2 {line-height:20px;width:442px;}.Sinq{line-height:20px;width:150px;}.Stext {line-height:20px;width:500px;height:80px;}#S_Color{}#Cbox1,#Cbox2{ float:left; margin-right:10px;}#Cbox1 div,#Cbox2 div{ padding:10px; text-align:center; width:100px;}#Cbox1 input,#Cbox2 input{ margin-bottom:10px;}#Cbox1 div{ background:#0059AF; color:#FFF;border-radius: 5px;}#Cbox2 div{ background:#0086AE; color:#FFF;border-radius: 5px;}.clearBoth {clear: both;}/*Tab Style*/#AdminTabs{}#TabTitle{}#TabTitle ul{ margin:0; padding:0;list-style: none;}#TabTitle ul li{ float:left; margin:0; padding:0;list-style: none; margin-right:10px;}#TabTitle ul li a{ display:block; padding:10px 20px; text-decoration:none; color:#666;border: 1px #DDD solid; margin-bottom:-1px;background: #f4f1f1;background: -moz-linear-gradient(top, #fff 0%, #f4f1f1 100%);background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ffffff), color-stop(100%,#f4f1f1));background: -webkit-linear-gradient(top, #fff 0%,#f4f1f1 100%);background: -o-linear-gradient(top, #fff 0%,#f4f1f1 100%);background: -ms-linear-gradient(top, #fff 0%,#f4f1f1 100%);background: linear-gradient(to bottom, #fff 0%,#f4f1f1 100%);filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#f4f1f1',GradientType=0 ); color:#666;}#TabTitle ul li a:hover{ color:#000;}#TabTitle ul li.in a{color: #0059AF;border-bottom: 1px white solid; background:#FFF;}#TabContent{border:1px #DDD solid; width:90%; padding:20px;}.hasborder{border:1px #DDD solid;}.hasborder td{border:1px #DDD solid; padding:10px;}.hascate{ width:150px;}</style>
<div id="Wrap"><h2>设计窝主题选项</h2><!--AdminTabs--><div id="AdminTabs"><?php $action=$_GET['action'];?><!--TabTitle--><div id="TabTitle"><ul><li<?php if($action==''){?> class="in"<?php } ?>><a href="admin.php?page=functions.php">常规设置</a></li><br class="clearBoth"></ul></div><!--/TabTitle--><!--TabContent--><div id="TabContent"><div id="Settings" ><form method="post" action=""><!--action==''--><?php if($action==''){?><table width="100%" border="0" cellspacing="0" cellpadding="2"><tr><td width="229" align="right">网站标题：</td><td><?php echo bloginfo( 'name' );?><a href="options-general.php" class="Sma" target="_blank">请到常规里面进行修改</a></td></tr>
  <tr>
    <td align="right">头像设置：</td>
    <td><a href="profile.php#simple-local-avatar"> 个人资料</a></td>
  </tr>
  <tr><td align="right"><label for="S_Keyword">网站关键词：</label></td><td><textarea name="S_Keyword" class="Stext" id="S_Keyword"><?php echo stripslashes(get_option('S_Keyword')); ?></textarea></td></tr><tr><td align="right"><label for="S_Description">网站描述：</label></td><td><textarea name="S_Description" class="Stext" id="S_Description"><?php echo stripslashes(get_option('S_Description')); ?></textarea></td></tr><tr><td align="right"><label for="S_Copy">底部版权信息：</label></td><td><div style="width:500px;"><?php wp_editor(stripslashes(get_option('S_Copy')), S_Copy, $settings = array(quicktags=>1,tinymce=>1,media_buttons=>0,textarea_rows=>6,editor_class=>"textareastyle") ); ?></div></td></tr><tr><td align="right">&nbsp;</td><td>&nbsp;</td></tr><tr><td align="right">&nbsp;</td><td>&nbsp;</td></tr><tr><td align="right">&nbsp;</td><td height="50"><input type="submit" name="Submit" class="button-primary" value="保存设置" /><input type="hidden" name="simple_settings" value="save" style="display:none;" /></td></tr></table><?php } ?></form></div></div><br /><div style="margin:20px 0 10px;">技术支持：<a href="http://www.shejiwo.net" target="_blank">设计窝</a></div></div>
<?php }
add_theme_support( 'post-thumbnails' );
?>