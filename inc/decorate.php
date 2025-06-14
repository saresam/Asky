<?php
function customizer_css() { ?>
<style type="text/css">
<?php // Style Settings
if ( akina_option('shownav') ) { ?>
.site-top .lower nav {display: block !important;}
<?php } // Style Settings ?>
<?php // theme-skin
if ( akina_option('theme_skin') ) { ?>
	
.author-profile i , .post-like a , .post-share .show-share , .sub-text , .we-info a , span.sitename , .post-more i:hover , #pagination a:hover , .post-content a:hover , .float-content i:hover,.entry-content a:hover , .post-content a:hover , .comment h4 a ,  .comment h4 a:hover , .site-top ul li a:hover , .entry-title a:hover , #archives-temp h3 , span.page-numbers.current , .post_nav_content li a:hover, .sorry li a:hover , .site-title a:hover , i.iconfont.icon-search:hover , .comment-respond input[type='submit']:hover ,.loginwords a ,i.iconfont.icon-people:hover { color: <?php echo akina_option('theme_skin'); //填充颜色和主题保持一致?> }
	
.feature i , .foverlay , .download , .navigator i:hover ,.comment .isauthor, .links ul li:before , .ar-time i , span.ar-circle , .object , .comment .comment-reply-link ,.siren-checkbox-radio:checked, .siren-checkbox-radioInput:after,.comment-respond input[type='submit'], #readprogress, .post-share p, #add_post span, a .page-numbers ,.post_nav_content li a:hover:before  { background-color: <?php echo akina_option('theme_skin'); //背景色和主题一致 ?> }
 
	
.download , .navigator i:hover , .link-title , .links ul li:hover , #pagination a:hover , .comment-respond input[type='submit']:hover  { border-color: <?php echo akina_option('theme_skin'); //边框色和主题一致?> }
	
<?php } // theme-skin ?>
<?php // Custom style
if ( akina_option('site_custom_style') ) {
  echo akina_option('site_custom_style');
} 
// Custom style end ?>
<?php // liststyle
if ( akina_option('list_type') == 'square') { ?>
.post-thumb a{ border-radius: 0px; !important; }
.post-list-thumb{ border-radius: 0px; !important; }
.post-thumb-focus{ border-radius: 0px; !important; }
.comment-respond textarea{ border-radius: 0px; !important; }
.comment-respond input{ border-radius: 0px; !important; }
.comment-respond input:last-of-type{ border-radius: 0px; !important; }
.entry-content p img{ border-radius: 0px; !important; }
.post-squares{ border-radius: 0px; !important; }
.feature img{ border-radius: 0px; !important; }
.feature i { border-radius: 0px; !important; }
.wp-block-image{ border-radius: 0px; !important; }
img{ border-radius: 0px; !important; }
.search-form input{ border-radius: 0px; !important; }
.notification{ border-radius: 0px; !important; }
.comment .profile img{ border-radius: 4px; !important; }
.notice{ border-radius: 0px; !important; }
.comment-respond input[type='submit']{border-radius: 0px; !important;}
.comment-respond #cancel-comment-reply-link{border-radius: 0px; !important;}
.post-share p{border-radius: 0px; !important;}
.comment .profile img{border-radius: 0px; !important;}
h1.page-title{border-radius: 0px; !important;}
.sorry-inner{border-radius: 0px; !important;}
.s-search input{border-radius: 0px; !important;}
.author-profile .profile img{border-radius: 0px; !important;}
.reward-row li img{border-radius: 0px; !important;}
.single-reward .reward-row{border-radius: 0px; !important;}
.links ul li{border-radius: 0px; !important;}
<?php } // liststyle ?>
<?php // comments
if ( akina_option('toggle-menu') == 'no') { ?>
.comments .comments-main {display:block !important;}
.comments .comments-hidden {display:none !important;}
<?php } // comments ?>
</style>
<?php }
add_action('wp_head', 'customizer_css');