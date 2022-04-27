<?php
/**
 * Akina functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Akina
 */
 
define( 'SIREN_VERSION', '2.0.5' );

if ( !function_exists( 'akina_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
 
if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
	require_once dirname( __FILE__ ) . '/inc/options-framework.php';
}
 


function akina_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Akina, use a find and replace
	 * to change 'akina' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'akina', get_template_directory() . '/languages' );


	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 150, 150, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( '导航菜单', 'akina' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'status',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'akina_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
	
	add_filter('pre_option_link_manager_enabled','__return_true');
	
	// 优化代码
	//去除头部冗余代码
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'index_rel_link');
    remove_action('wp_head', 'start_post_rel_link', 10, 0);
    remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'wp_generator'); //隐藏wordpress版本
    remove_filter('the_content', 'wptexturize'); //取消标点符号转义
    
	remove_action('rest_api_init', 'wp_oembed_register_route');
	remove_filter('rest_pre_serve_request', '_oembed_rest_pre_serve_request', 10, 4);
	remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
	remove_filter('oembed_response_data', 'get_oembed_response_data_rich', 10, 4);
	remove_action('wp_head', 'wp_oembed_add_discovery_links');
	remove_action('wp_head', 'wp_oembed_add_host_js');
	// Remove the Link header for the WP REST API
	// [link] => <http://cnzhx.net/wp-json/>; rel="https://api.w.org/"
	remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );
	
	function coolwp_remove_open_sans_from_wp_core() {
		wp_deregister_style( 'open-sans' );
		wp_register_style( 'open-sans', false );
		wp_enqueue_style('open-sans','');
	}
	add_action( 'init', 'coolwp_remove_open_sans_from_wp_core' );
	
	/**
	* Disable the emoji's
	*/
	function disable_emojis() {
	 remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	 remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	 remove_action( 'wp_print_styles', 'print_emoji_styles' );
	 remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
	 remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	 remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
	 remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	 add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
	}
	add_action( 'init', 'disable_emojis' );
	 
	/**
	 * Filter function used to remove the tinymce emoji plugin.
	 * 
	 * @param    array  $plugins  
	 * @return   array             Difference betwen the two arrays
	 */
	function disable_emojis_tinymce( $plugins ) {
	 if ( is_array( $plugins ) ) {
	 return array_diff( $plugins, array( 'wpemoji' ) );
	 } else {
	 return array();
	 }
	}
	
	
	
	/*
	 * 评论表情
	 */
	function custom_smilies_src($src, $img){
		return get_bloginfo('template_directory').'/images/smilies/' . $img;
	}
	add_filter('smilies_src', 'custom_smilies_src', 10, 2);

	function init_akinasmilie() {
			global $wpsmiliestrans;
			//默认表情文本与表情图片的对应关系(可自定义修改)
			$wpsmiliestrans = array(
					':mrgreen:' => 'icon_mrgreen.gif',
					':neutral:' => 'icon_neutral.gif',
					':twisted:' => 'icon_twisted.gif',
					':arrow:' => 'icon_arrow.gif',
					':shock:' => 'icon_eek.gif',
					':smile:' => 'icon_smile.gif',
					':???:' => 'icon_confused.gif',
					':cool:' => 'icon_cool.gif',
					':evil:' => 'icon_evil.gif',
					':grin:' => 'icon_biggrin.gif',
					':idea:' => 'icon_idea.gif',
					':oops:' => 'icon_redface.gif',
					':razz:' => 'icon_razz.gif',
					':roll:' => 'icon_rolleyes.gif',
					':wink:' => 'icon_wink.gif',
					':cry:' => 'icon_cry.gif',
					':eek:' => 'icon_surprised.gif',
					':lol:' => 'icon_lol.gif',
					':mad:' => 'icon_mad.gif',
					':sad:' => 'icon_sad.gif',
					'8-)' => 'icon_cool.gif',
					'8-O' => 'icon_eek.gif',
					':-(' => 'icon_sad.gif',
					':-)' => 'icon_smile.gif',
					':-?' => 'icon_confused.gif',
					':-D' => 'icon_biggrin.gif',
					':-P' => 'icon_razz.gif',
					':-o' => 'icon_surprised.gif',
					':-x' => 'icon_mad.gif',
					':-|' => 'icon_neutral.gif',
					';-)' => 'icon_wink.gif',
					'8O' => 'icon_eek.gif',
					':(' => 'icon_sad.gif',
					':)' => 'icon_smile.gif',
					':?' => 'icon_confused.gif',
					':D' => 'icon_biggrin.gif',
					':P' => 'icon_razz.gif',
					':o' => 'icon_surprised.gif',
					':x' => 'icon_mad.gif',
					':|' => 'icon_neutral.gif',
					';)' => 'icon_wink.gif',
					':!:' => 'icon_exclaim.gif',
					':?:' => 'icon_question.gif',
			);
		 
	}
	add_action('init', 'init_akinasmilie', 5); 


	
	// 移除菜单冗余代码
	add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1);
	add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1);
	add_filter('page_css_class', 'my_css_attributes_filter', 100, 1);
	function my_css_attributes_filter($var) {
	return is_array($var) ? array_intersect($var, array('current-menu-item','current-post-ancestor','current-menu-ancestor','current-menu-parent')) : '';
	}
		
}
endif;
add_action( 'after_setup_theme', 'akina_setup' );

function admin_lettering(){
    echo'<style type="text/css">body{font-family: Microsoft YaHei;}</style>';
}
add_action('admin_head', 'admin_lettering');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function akina_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'akina_content_width', 640 );
}
add_action( 'after_setup_theme', 'akina_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
/*function akina_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'akina' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'akina' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'akina_widgets_init' );
*/

/**
 * Enqueue scripts and styles.
 */
function akina_scripts() {
	wp_enqueue_style( 'siren', get_stylesheet_uri(), array(), SIREN_VERSION );
	wp_enqueue_script( 'jq', get_template_directory_uri() . '/js/jquery.min.js', array(), SIREN_VERSION, true ); 
	wp_enqueue_script( 'pjax-libs', get_template_directory_uri() . '/js/jquery.pjax.js', array(), SIREN_VERSION, true );
	wp_enqueue_script( 'qrcode', get_template_directory_uri() . '/js/qrcode.min.js', array(), SIREN_VERSION, true );
    wp_enqueue_script( 'app', get_template_directory_uri() . '/js/app.js', array('qrcode','jquery','jq','pjax-libs'), SIREN_VERSION, true );
	wp_enqueue_script( 'input', get_template_directory_uri() . '/js/input.min.js', array(), SIREN_VERSION, true );
		
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// 20161116 @Louie
	$mv_live = akina_option('focus_mvlive') ? 'open' : 'close';
	$movies = akina_option('focus_amv') ? array('url' => akina_option('amv_url'), 'name' => akina_option('amv_title'), 'live' => $mv_live) : 'close';
	$auto_height = akina_option('focus_height') ? 'fixed' : 'auto';
	$code_lamp = akina_option('open_prism_codelamp') ? 'open' : 'close';
	if(wp_is_mobile()) $auto_height = 'fixed'; //拦截移动端
	wp_localize_script( 'app', 'Poi' , array(
		'pjax' => akina_option('poi_pjax'),
		'movies' => $movies,
		'windowheight' => $auto_height,
		'codelamp' => $code_lamp,
		'ajaxurl' => admin_url('admin-ajax.php'),
		'order' => get_option('comment_order'), // ajax comments
		'formpostion' => 'bottom' // ajax comments 默认为bottom，如果你的表单在顶部则设置为top。
	));
}
add_action( 'wp_enqueue_scripts', 'akina_scripts' );

/**
 * load .php.
 */
require get_template_directory() .'/inc/decorate.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * function update
 */
require get_template_directory() . '/inc/siren-update.php';
require get_template_directory() . '/inc/categories-images.php';


/**
 * COMMENT FORMATTING
 */
if(!function_exists('akina_comment_format')){
	function akina_comment_format($comment, $args, $depth){
		$GLOBALS['comment'] = $comment;
		?>
		<li <?php comment_class(); ?> id="comment-<?php echo esc_attr(comment_ID()); ?>">
			<div class="contents">
				<div class="comment-arrow">
					<div class="main shadow">
						<div class="profile">
							<a href="<?php comment_author_url(); ?>" target="_blank"><?php echo get_avatar( $comment->comment_author_email, '80', '', get_comment_author() ); ?></a>
						</div>
						<div class="commentinfo">
							<section class="commeta">
								<div class="left">
									<h4 class="author"><a href="<?php comment_author_url(); ?>" target="_blank"><?php echo get_avatar( $comment->comment_author_email, '24', '', get_comment_author() ); ?><?php comment_author(); ?> <span class="isauthor" title="<?php esc_attr_e('Author', 'akina'); ?>">博主</span></a></h4>
								</div>
								<?php /*?><?php 
    								$comment_reply_class = 'uk-link-muted uk-text-small';
									echo preg_replace( '/comment-reply-link/', 'comment-reply-link ' . $comment_reply_class, 
        							get_comment_reply_link(array_merge( $args, array(
            						'reply_text' => '回复', 
									'depth' => $depth, 
            						'max_depth' => $args['max_depth']))), 1 ); 
								?><?php */?>
								
								<?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
								<div class="right">
									<div class="info"><time datetime="<?php comment_date('Y-m-d'); ?>"><?php echo poi_time_since(strtotime($comment->comment_date_gmt), true );//comment_date(get_option('date_format')); ?></time><?php echo siren_get_useragent($comment->comment_agent); ?></div>
								</div>
							</section>
						</div>
						<div class="body">
							<?php comment_text(); ?>
						</div>
					</div>
					<div class="arrow-left"></div>
				</div>
			</div>
			<hr>
		<?php
	}
}


/**
 * post views.
 * @bigfa
 */
//计数方式
function restyle_text($number) {
    if($number >= 1000) {
        return round($number/1000,2) . 'k';
    }else{
        return $number;
    }
}

// set post view
function set_post_views() {
    global $post;
    $post_id = intval($post->ID);
    $count_key = 'views';
    $views = get_post_custom($post_id);
    if( !empty($views['views'][0]) ) {
        $views = intval($views['views'][0]);
        if(is_single() || is_page()) {
            if(!update_post_meta($post_id, 'views', ($views + 1))) {
                add_post_meta($post_id, 'views', 1, true);
            }
        }
    }else{
        add_post_meta($post_id, 'views', 1, true);
    }
}
add_action('get_header', 'set_post_views');



//show post view
function get_post_views($post_id) {
    $count_key = 'views';
    $views = get_post_custom($post_id);
    if( !empty($views['views'][0]) ) {
        $views = intval($views['views'][0]);
        $post_views = intval(post_custom('views'));
        if($views == '') {
            return 0;
        }else{
            return restyle_text($views);
        }
    }else{
        add_post_meta($post_id, 'views', 1, true);
    }
} 



/*
 * Ajax点赞
 */
add_action('wp_ajax_nopriv_specs_zan', 'specs_zan');
add_action('wp_ajax_specs_zan', 'specs_zan');
function specs_zan(){
    global $wpdb,$post;
    $id = $_POST["um_id"];
    $action = $_POST["um_action"];
    if ( $action == 'ding'){
        $specs_raters = get_post_meta($id,'specs_zan',true);
        $expire = time() + 99999999;
        $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false; // make cookies work with localhost
        setcookie('specs_zan_'.$id,$id,$expire,'/',$domain,false);
        if (!$specs_raters || !is_numeric($specs_raters)) {
            update_post_meta($id, 'specs_zan', 1);
        } 
        else {
            update_post_meta($id, 'specs_zan', ($specs_raters + 1));
        }
        echo get_post_meta($id,'specs_zan',true);
    } 
    die;
}


/*
 * 友情链接
 */
function get_the_link_items($id = null){
  $default_ico = get_template_directory_uri().'/images/none.png'; 
  $bookmarks = get_bookmarks('orderby=date&category=' .$id );
  $output = '';
  if ( !empty($bookmarks) ) {
      $output .= '<ul class="link-items fontSmooth">';
      foreach ($bookmarks as $bookmark) {
		 $link_favicon = $bookmark->link_url.'/favicon.ico';
         $link_img = $bookmark->link_image;
		 $link_ico = '';
		  if ( !empty($link_img) ){
			  $link_ico = $link_img;
		  }else{
			   $link_ico = $link_favicon;
		  } 
        $output .=  '<li class="link-item"><a class="link-item-inner effect-apollo" href="' . $bookmark->link_url . '" title="' . $bookmark->link_description . '" target="_blank" >
		<img class="linksimage" src="'. $link_ico.'" alt="" onerror="javascript:this.src=\'' . $default_ico . '\'" /><span class="sitename">'. $bookmark->link_name .'</span><div class="linkdes">'. ''. $bookmark->link_description .'</div></a></li>';
      }
      $output .= '</ul>';
  }
  return $output;
}



function get_link_items(){
  $linkcats = get_terms( 'link_category' );
  	if ( !empty($linkcats) ) {
      	foreach( $linkcats as $linkcat){            
        	$result .=  '<h3 class="link-title">'.$linkcat->name.'</h3>';
        	if( $linkcat->description ) $result .= '<div class="link-description">' . $linkcat->description . '</div>';
        	$result .=  get_the_link_items($linkcat->term_id);
      	}
  	} else {
    	$result = get_the_link_items();
  	}
  return $result;
}



/*
 * Gravatar头像使用中国服务器
 */
function gravatar_cn( $url ){ 
	$gravatar_url = array('0.gravatar.com','1.gravatar.com','2.gravatar.com');
	return str_replace( $gravatar_url, 'cn.gravatar.com', $url );
}
add_filter( 'get_avatar_url', 'gravatar_cn', 4 );


/*
 * 阻止站内文章互相Pingback 
 */
function theme_noself_ping( &$links ) { 
	$home = get_option( 'home' );
	foreach ( $links as $l => $link )
	if ( 0 === strpos( $link, $home ) )
	unset($links[$l]); 
}
add_action('pre_ping','theme_noself_ping');


/*
 * 订制body类
*/
function akina_body_classes( $classes ) {
  // Adds a class of group-blog to blogs with more than 1 published author.
  if ( is_multi_author() ) {
    $classes[] = 'group-blog';
  }
  // Adds a class of hfeed to non-singular pages.
  if ( ! is_singular() ) {
    $classes[] = 'hfeed';
  }
  return $classes;
}
add_filter( 'body_class', 'akina_body_classes' );


/*
 * 图片七牛云缓存
 */
add_filter( 'upload_dir', 'wpjam_custom_upload_dir' );
function wpjam_custom_upload_dir( $uploads ) {
	$upload_path = '';
	$upload_url_path = akina_option('qiniu_cdn');

	if ( empty( $upload_path ) || 'wp-content/uploads' == $upload_path ) {
		$uploads['basedir']  = WP_CONTENT_DIR . '/uploads';
	} elseif ( 0 !== strpos( $upload_path, ABSPATH ) ) {
		$uploads['basedir'] = path_join( ABSPATH, $upload_path );
	} else {
		$uploads['basedir'] = $upload_path;
	}

	$uploads['path'] = $uploads['basedir'].$uploads['subdir'];

	if ( $upload_url_path ) {
		$uploads['baseurl'] = $upload_url_path;
		$uploads['url'] = $uploads['baseurl'].$uploads['subdir'];
	}
	return $uploads;
}


/*
 * 删除自带小工具
*/
function unregister_default_widgets() {
	unregister_widget("WP_Widget_Pages");
	unregister_widget("WP_Widget_Calendar");
	unregister_widget("WP_Widget_Archives");
	unregister_widget("WP_Widget_Links");
	unregister_widget("WP_Widget_Meta");
	unregister_widget("WP_Widget_Search");
	unregister_widget("WP_Widget_Text");
	unregister_widget("WP_Widget_Categories");
	unregister_widget("WP_Widget_Recent_Posts");
	unregister_widget("WP_Widget_Recent_Comments");
	unregister_widget("WP_Widget_RSS");
	unregister_widget("WP_Widget_Tag_Cloud");
	unregister_widget("WP_Nav_Menu_Widget");
}
add_action("widgets_init", "unregister_default_widgets", 11);


/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 */
function akina_jetpack_setup() {
  // Add theme support for Infinite Scroll.
  add_theme_support( 'infinite-scroll', array(
    'container' => 'main',
    'render'    => 'akina_infinite_scroll_render',
    'footer'    => 'page',
  ) );

  // Add theme support for Responsive Videos.
  add_theme_support( 'jetpack-responsive-videos' );
}
add_action( 'after_setup_theme', 'akina_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function akina_infinite_scroll_render() {
  while ( have_posts() ) {
    the_post();
    if ( is_search() ) :
        get_template_part( 'tpl/content', 'search' );
    else :
        get_template_part( 'tpl/content', get_post_format() );
    endif;
  }
}


/*
 * 编辑器增强
 */
function enable_more_buttons($buttons) { 
	$buttons[] = 'hr'; 
	$buttons[] = 'del'; 
	$buttons[] = 'sub'; 
	$buttons[] = 'sup';
	$buttons[] = 'fontselect';
	$buttons[] = 'fontsizeselect';
	$buttons[] = 'cleanup';
	$buttons[] = 'styleselect';
	$buttons[] = 'wp_page';
	$buttons[] = 'anchor'; 
	$buttons[] = 'backcolor'; 
	return $buttons;
} 
add_filter("mce_buttons_3", "enable_more_buttons");
// 下载短代码
function download($atts, $content = null) { 
	if (akina_option('download_zan')=='1'){
		$download_post_open = "specsZan";
	};
	$download_post_ID = get_the_ID(); 
return '<a  id = "download_link" class="download" href="'.$content.'" rel="external"  
target="_blank" title="下载地址" >  
<span data-action="ding" data-id="'.$download_post_ID.'" class="'.$download_post_open.'" ><i class="iconfont icon-download"></i>Download</span></a>';  } 
add_shortcode("download", "download"); 


/*
//用于添加编辑器按钮
add_action('after_wp_tiny_mce', 'bolo_after_wp_tiny_mce');  
function bolo_after_wp_tiny_mce($mce_settings) {  
?>  
<script type="text/javascript">  
QTags.addButton( 'download', '下载按钮', "[download]下载地址[/download]" );
	
function bolo_QTnextpage_arg1() {
}  
</script>  
<?php } */


function add_quicktags() {
 if (wp_script_is('quicktags')){
?>
 <script type="text/javascript">
     QTags.addButton( 'All', '分隔线', "————————————————————————————————————————");
	 QTags.addButton( 'All', '回复可见', "<!--hide start{reply_to_this=true}-->隐藏内容<!--hide end-->");
  
 </script>
<?php
 }
}
add_action( 'admin_print_footer_scripts', 'add_quicktags' );
/*
 * 后台登录页
 * @M.J
 */	
//Login Page style
function custom_login() {
	echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('template_directory') . '/inc/login.css" />'."\n";
	echo '<script type="text/javascript" src="'.get_bloginfo('template_directory').'/js/jquery.min.js"></script>'."\n";
	
}
add_action('login_head', 'custom_login');
//Login Page Title
function custom_headertitle ( $title ) {
	return get_bloginfo('name');
}
add_filter('login_headertitle','custom_headertitle');
//Login Page Link
function custom_loginlogo_url($url) {
	return esc_url( home_url('/') );
}

add_filter( 'login_headerurl', 'custom_loginlogo_url' );

//Login Page Footer
function custom_html() {
	if ( akina_option('login_bg') ) {
		$loginbg = akina_option('login_bg'); 
	}else{
		$loginbg = get_bloginfo('template_directory').'/images/background.svg';
	}
	echo '<script type="text/javascript" src="'.get_bloginfo('template_directory').'/js/login.js"></script>'."\n";
	echo '<script type="text/javascript">'."\n";
	echo 'jQuery("body").prepend("<div class=\"loading\"><img src=\"'.get_bloginfo('template_directory').'/images/login_loading.gif\" width=\"58\" height=\"10\"></div><div id=\"bg\"><img /></div>");'."\n";
	echo 'jQuery(\'#bg\').children(\'img\').attr(\'src\', \''.$loginbg.'\').load(function(){'."\n";
	echo '	resizeImage(\'bg\');'."\n";
	echo '	jQuery(window).bind("resize", function() { resizeImage(\'bg\'); });'."\n";
	echo '	jQuery(\'.loading\').fadeOut();'."\n";
	echo '});';
	echo '</script>'."\n";
}

add_action('login_footer', 'custom_html');


### Function: Display Total Views   
if(!function_exists('get_totalviews')){
function get_totalviews($display = true) {   
	global $wpdb;   
	$total_views = intval($wpdb->get_var("SELECT SUM(meta_value+0) FROM $wpdb->postmeta WHERE meta_key = 'views'"));   
	if($display){
		return number_format_i18n($total_views);
	}else{
		   return $total_views; 
	}	 
}  
} 




/*
 * 评论邮件回复
 */
function comment_mail_notify($comment_id){
	$mail_user_name = akina_option('mail_user_name') ? akina_option('mail_user_name') : 'poi';
    $comment = get_comment($comment_id);
    $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
    $spam_confirmed = $comment->comment_approved;
    if(($parent_id != '') && ($spam_confirmed != 'spam')){
    $wp_email = $mail_user_name . '@' . 'email.' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME']));
    $to = trim(get_comment($parent_id)->comment_author_email);
    $subject = '你在 [' . get_option("blogname") . '] 的留言有了回应';
    $message = '
    <table border="1" cellpadding="0" cellspacing="0" width="600" align="center" style="border-collapse: collapse; border-style: solid; border-width: 1;border-color:#ddd;">
	<tbody>
          <tr>
            <td>
				<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" height="48" >
                    <tbody><tr>
                        <td width="100" align="center" style="border-right:1px solid #ddd;"> '. get_option("blogname").'</td>
                        <td width="300" style="padding-left:20px; color:#ec3409;"><strong>您有一条来自' . get_option("blogname") . ' 的回复,系统发送，请勿回复</strong></td>
						</tr>
					</tbody>
				</table>
			</td>
          </tr>
          <tr>
            <td  style="padding:15px;"><p><strong>' . trim(get_comment($parent_id)->comment_author) . '</strong>, 你好!</span>
              <p>你在《' . get_the_title($comment->comment_post_ID) . '》的留言:</p><p style="border-left:3px solid #ddd;padding-left:1rem;color:#999;">'
        . trim(get_comment($parent_id)->comment_content) . '</p><p>
              ' . trim($comment->comment_author) . ' 给你的回复:</p><p style="border-left:3px solid #ddd;padding-left:1rem;color:#999;">'
        . trim($comment->comment_content) . '</p>
        <center ><a href="' . htmlspecialchars(get_comment_link($parent_id)) . '" target="_blank" style="background-color:#6ec3c8; border-radius:10px; display:inline-block; color:#fff; padding:15px 20px 15px 20px; text-decoration:none;margin-top:20px; margin-bottom:20px;">点击查看完整内容</a></center>
</td>
          </tr>
          <tr>
            <td align="center" valign="center" height="38" style="font-size:0.8rem; color:#999;">Copyright © '.get_option("blogname").'</td>
          </tr>
		  </tbody>
  </table>';
    $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
    $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
    wp_mail( $to, $subject, $message, $headers );
  }
}
add_action('comment_post', 'comment_mail_notify');


//图片添加alt属性
add_filter( 'the_content', 'image_alt');
function image_alt($c) {
	global $post;$title = $post->post_title;
	$s = array('/src="(.+?.(jpg|bmp|png|jepg|gif))"/i'=> 'src="$1" alt="'.$title.'"');
	foreach($s as$p => $r){$c = preg_replace($p,$r,$c);
						  }
	return $c;
}


//code end 

//微信评论推送
function sc_send( $comment_id
	  )
{
	$text = '起来！有大佬评论了！' ;
	$comment =get_comment($comment_id);
	$comment_text= $comment ->comment_content;
	$author = $comment ->comment_author;
	$comment_title = get_the_title($comment->comment_post_ID);
	$comment_link = get_comment_link($comment_id);
	$desp = '大佬【'.$author.'】在《'.$comment_title.'》里给你做了批示：“'.$comment_text.'。”---你要看么？<br>'.$comment_link;
	$key = akina_option('akina_server_key');
	
	$postdata = http_build_query(
    array(
        'text' => $text,
        'desp' => $desp
    )
);

$opts = array('http' =>
    array(
        'method'  => 'POST',
        'header'  => 'Content-type: application/x-www-form-urlencoded',
        'content' => $postdata
    )
);
$context  = stream_context_create($opts);
return $result = file_get_contents('https://sc.ftqq.com/'.$key.'.send', false, $context);
}
add_action('comment_post','sc_send',19,2);



//显示统计数量
function simple_stats() {
	global $wpdb;
$stats = array();
$stats['posts'] = number_format_i18n(wp_count_posts('post')->publish);
$stats['pages'] = number_format_i18n(wp_count_posts('page')->publish);
$stats['cats']  = number_format_i18n(wp_count_terms('category'));
$stats['tags'] = number_format_i18n(wp_count_terms('post_tag'));
$stats['comments'] = number_format_i18n(wp_count_comments()->approved);
$stats['users'] = $wpdb->get_var("SELECT COUNT(ID) FROM {$wpdb->prefix}users");
$stats['total_view'] = $wpdb->get_var("SELECT SUM(meta_value+0) FROM $wpdb->postmeta WHERE meta_key = 'views'");
$stats['specs_zan'] = $wpdb->get_var("SELECT SUM(meta_value+0) FROM $wpdb->postmeta WHERE meta_key = 'specs_zan'");
echo 
'<p><i class="iconfont icon-message_fill"></i>发表<span>', $stats['posts'], '</span>篇文章</p><br>',
//'<i class="iconfont icon-shuidi"></i><p>页面总数:</p><span>', $stats['pages'], '</span><p></p><br>',
'<p><i class="iconfont icon-info"></i>建立<span>', $stats['cats'], '</span>个分类</p><br>',
'<p><i class="iconfont icon-tags"></i>生成<span>', $stats['tags'], '</span>个标签</p><br>',
'<p><i class="iconfont icon-communityfill"></i>收到<span>', $stats['comments'], '</span>条评论</p><br>',
'<p><i class="iconfont icon-heart"></i>收到<span>', $stats['specs_zan'], '</span>个赞</p><br>',
//'<i class="iconfont icon-shuidi"></i><p用户总数:</p><span>', $stats['users'], '</span><p></p><br>',
'<p><i class="iconfont icon-camera"></i>文章查阅:<span>', $stats['total_view'], '</span>次</p><br>';
}

function getip(){	
if(getenv('HTTP_CLIENT_IP')) {
    $onlineip = getenv('HTTP_CLIENT_IP');
} elseif(getenv('HTTP_X_FORWARDED_FOR')) {
    $onlineip = getenv('HTTP_X_FORWARDED_FOR');
} elseif(getenv('REMOTE_ADDR')) {
    $onlineip = getenv('REMOTE_ADDR');
} else {
    $onlineip = $HTTP_SERVER_VARS['REMOTE_ADDR'];
}
return $onlineip;   			
}				


//首页特色图片
function get_post_thumb( $return_src = 'true' ){
	global $post, $posts;
	$content = $post->post_content;
	$imgResult = '';
	$pattern = '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i';
	$result = preg_match_all( $pattern, $content, $matches );
	if ( $return_src == 'true' ){
		if ( !empty( $result ) ){
			$imgResult = '<img src="'.get_bloginfo("template_url").'/timthumb.php?src='.$matches[1][0].'&amp;q=100&amp;w=210" alt="" />';
		}
	} else {
		$imgResult = $matches[1][0];
	}
	return $imgResult;
}


//回复可见
//add_filter('the_content', 'hide');  
//add_filter('comment_text','hide');  
//function hide($content) {  
//    if (preg_match_all('/<!--hide start{?([\s\S]*?)}?-->([\s\S]*?)<!--hide end-->/i', $content, $matches)) { 
//        $params = $matches[1][0];  
//        $defaults = array('reply_to_this' => 'false');  
//        $params = wp_parse_args($params, $defaults);  
//        $stats = 'hide';  
//        if ($params['reply_to_this'] == 'true') {  
//            global $current_user;  
//            wp_get_current_user();  
//            if ($current_user->ID) {  
//                $email = $current_user->user_email;  
//            } else if (isset($_COOKIE['comment_author_email_'.COOKIEHASH])) {  
//                $email = $_COOKIE['comment_author_email_'.COOKIEHASH];  
//            }  
//            $ereg = "^[_\.a-z0-9]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,5}$";  
//            if (eregi($ereg, $email)) {  
//                global $wpdb;  
//                global $id;  
//                $comments = $wpdb->get_results("SELECT * FROM $wpdb->comments WHERE comment_author_email = '".$email."' and comment_post_id='".$id."'and comment_approved = '1'");  
//                if ($comments) {  
//                    $stats = 'show';  
//                }  
//            }  
//            $tip = __('<span class="vihide">抱歉，隐藏内容 <a href="#comments">回复</a> 后刷新可见</span>', 'hide');  
//        } else {  
//            if (isset($_COOKIE['comment_author_'.COOKIEHASH]) or current_user_can('level_0')) {  
//               $stats = 'show';  
//            }  
//            $tip = __('<span class="vihide">抱歉，这是可见的 <a href="#comments">回复</a> 后刷新可见</span>', 'hide');  
//        }  
//        $hide_notice = $tip;  
//        if ($stats == 'show') {  
//			
//            $content = str_replace($matches[0], $matches[2], $content);  
//        } else {  
//            $content = str_replace($matches[0], $hide_notice, $content);  
//        }  
//    }  
//    return  $content;  
//}  

add_filter( 'get_avatar' , 'inlojv_custom_avatar' , 10 , 5 );
function inlojv_custom_avatar( $avatar, $id_or_email, $size, $default, $alt) {
		global $comment,$current_user;
		$current_email =  is_int($id_or_email) ? get_user_by( 'ID', $id_or_email )->user_email : $id_or_email;
		$email = !empty($comment->comment_author_email) ? $comment->comment_author_email : $current_email ;
		$email_hash = md5(strtolower(trim($email)));
		$src = 'https://pic.imgdb.cn/api/avatar';
		$avatar = "<img alt='{$alt}' src='//sdn.geekzu.org/avatar/{$email_hash}?d=404' onerror='javascript:this.src=\"{$src}\";this.onerror=null;' class='avatar avatar-{$size} photo' height='{$size}' width='{$size}' />";
    return $avatar;
}

//function article_index($content) {
//$matches = array();
//$ul_li = '';
//$r = "/<h[23]>(.*)<\/h[23]>/im";
//if(preg_match_all($r, $content, $matches)) {
//foreach($matches[1] as $num => $title) {
//$content = str_replace($matches[0][$num], '<h3 id="title-'.$num.'">'.$title.'</h3>', $content);
//$ul_li .= '<li><a href="#title-'.$num.'" title="'.$title.'">'.$title."</a></li>\n";
//}
//$content = "\n<div id=\"article-index\" class=\"article-index hidden-xs\">
//<strong class=\"title\">文章目录</strong>
//<ul id=\"index-ul\" class=\"index-ul\">\n" . $ul_li . "</ul>
//</div>\n" . $content;
//}
//return $content;
//}
//add_filter( "the_content", "article_index" );

/*
 *	文章页面导航
 */
 function article_index($content) {
		 $matches = array();
		 $ul_li = '';
		 //匹配出 h2、h3 标题
		 $rh = "/<h[23]>(.*)<\/h[23]>/im";
		 $h2_num = 0;
		 $h3_num = 0;
		 //判断是否是文章页
		 if(is_single() || !is_tag()){
					if(preg_match_all($rh, $content, $matches)) {
						 // 找到匹配的结果
						 foreach($matches[1] as $num => $title) {
								 $hx = substr($matches[0][$num], 0, 3);      //前缀，判断是 h2 还是 h3
								 $start = stripos($content, $matches[0][$num]);  //匹配每个标题字符串在文章中的起始位置
								 $end = strlen($matches[0][$num]);       //匹配每个标题字符串的长度
								 if($hx == "<h2"){
										 $h2_num += 1; //记录 h2 的序列，此效果请查看百度百科中的序号，如 1.1、1.2 中的第一位数
										 $h3_num = 0;
										 // 文章标题添加 id，便于目录导航的点击定位
										 $content = substr_replace($content, '<h2 id="h2-'.$num.'">'.$title.'</h2>',$start,$end);
										 $title = preg_replace('/<[^>]*>/', "", $title); //将 h2 里面的 a 链接或者其他标签去除，留下文字
										 $ul_li .= '<li class="h2_nav"><a href="#h2-'.$num.'" class="tooltip" title="'.$title.'"><span>'.$title."</span></a></li>\n";
								 }else if($hx == "<h3"){
										 $h3_num += 1; //记录 h3 的序列，此熬过请查看百度百科中的序号，如 1.1、1.2 中的第二位数
										 $content = substr_replace($content, '<h3 id="h3-'.$num.'">'.$title.'</h3>',$start,$end);
										 $title = preg_replace('/<[^>]*>/', "", $title); //将 h3 里面的 a 链接或者其他标签去除，留下文字
										 $ul_li .= '<li class="h3_nav"><a href="#h3-'.$num.'" class="tooltip" title="'.$title.'"><span>'.$title."</span></a></li>\n";
								 }   
						 }
				 }
				 // 将目录拼接到文章
			     if($ul_li){
				 $content =  $content . "<div class=\"total_nav\"><div class=\"nav_icon breath_animation\"><div id =\"nav_icon\" >目录</div></div><div class=\"post_nav\"><ul class=\"post_nav_content\">\n" . $ul_li . "</ul></div></div>\n";
				 return $content;
				}else{
					 return $content;
				 }
		 }else if(is_home()){
				 return $content;
		 }
 }
 add_filter( "the_content", "article_index" );

add_action('login_head', 'wpdx_remove_language');
function wpdx_remove_language(){
	echo '<style type="text/css">.language-switcher { display:none; }</style>';
}

//站点维护中
//function lxtx_wp_maintenance_mode(){
//    if(!current_user_can('edit_themes') || !is_user_logged_in()){
//        $blogname =  get_bloginfo('name');
//        $blogdescription = get_bloginfo('description');
//        wp_die(''.$blogname.'正在例行维护中，请稍候...', '站点维护中 - '.$blogname.' - '.$blogdescription ,array('response' => '503'));
//    }
//}
//add_action('get_header', 'lxtx_wp_maintenance_mode');

