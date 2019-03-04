<?php
 
	/**
	 * COMMENTS TEMPLATE
	 */

	/*if('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die(esc_html__('Please do not load this page directly.', 'akina'));*/

	if(post_password_required()){
		return;
	}

?>

	<?php if(comments_open() != false): ?>

	<section id="comments" class="comments">

		<div class="commentwrap comments-hidden">
			<div class="notification"><i class="iconfont icon-mark"></i><?php esc_html_e('查看评论', 'akina'); ?>
			</div>
		</div>

		<div class="comments-main">
		 <h3 id="comments-list-title">Comments | <span class="noticom"><i class="iconfont icon-communityfill" style="margin-right: 5px"></i><?php comments_popup_link('NOTHING', '1 条评论', '% 条评论'); ?> </span></h3> 
		<div id="loading-comments"><span></span></div>
			<?php if(have_comments()): ?>

				<ul class="commentwrap">
					<?php wp_list_comments('type=comment&callback=akina_comment_format&max_depth=10&style=li'); ?>	
				</ul>

          <nav id="comments-navi">
				<?php paginate_comments_links('prev_text=<&next_text=>');?>
			</nav>
		

			 <?php else : ?>

				<?php if(comments_open()): ?>
					<div class="commentwrap">
						<div class="notification-hidden"><i class="iconfont icon-mark"></i> <?php esc_html_e('暂无评论', 'akina'); ?></div>					
					</div>
				<?php endif; ?>

			<?php endif; ?>
        
  
        

<div id="respond_box">
	<div id="respond" class="comment-respond">
		<div class="cancel-comment-reply">
			<?php cancel_comment_reply_link('取消回复'); ?>
		</div>
		<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
		<p><?php print '您必须'; ?><a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"> [ 登录 ] </a>才能发表留言！</p>
    <?php else : ?>
    <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">	
      <?php if ( $user_ID ) : ?>
      <p class="loginwords"><?php print '登录者：'; ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>&nbsp;&nbsp;<a href="<?php echo wp_logout_url(get_permalink()); ?>" title="退出"><?php print '[ 退出 ]'; ?></a></p>
	<?php else :?>	
	
	
	<div class="author-updown"><?php printf(__('欢迎回来 ,  %s '), $comment_author); ?> 
			<a id="toggle-comment-info" href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">[ 修改 ]</a>
	</div>	
	<?php endif; ?>
	<?php if ( ! $user_ID ): ?>
	<div id="comment-author-info">
		
			<input type="text" name="author" id="author" class="commenttext" placeholder="Name"  value="<?php echo $comment_author; ?>" size="22" tabindex="1" placeholder="Name" />
			<label for="author"></label>
		
		
			<input type="text" name="email" id="email" class="commenttext" value="<?php echo $comment_author_email; ?>" size="22" placeholder="Email" tabindex="2" />
			<label for="email"></label>
		
		
			<input type="text" name="url" id="url" class="commenttext" value="<?php echo $comment_author_url; ?>" size="22"placeholder="http://"  tabindex="3" />
			<label for="url"></label>
		
	</div>
      <?php endif; ?>
      <div class="clear"></div>
      
		<p class="coments_words"><textarea name="comment" id="comment" placeholder="come on baby !" tabindex="4" cols="50" rows="5"></textarea></p>
		<div class="com-footer">
	
		<div>
		<label class="siren-checkbox-label"><input class="siren-checkbox-radio" type="checkbox" name="no-robot"><span class="siren-no-robot-checkbox siren-checkbox-radioInput"></span>滴！网络好卡</label>
		<?php if (akina_option('open_private_message') !='0'){?>
		<label class="siren-checkbox-label"><input class="siren-checkbox-radio" type="checkbox" name="is-private"><span class="siren-is-private-checkbox siren-checkbox-radioInput"></span>私密评论</label>
			
		<?php } ?>
			<a ><div class="smli-button"></div></a>
			<div class="smilies-box">
			<?php
				/*hhhhhhhhhhhhh*/
				?>	
     <?php include(TEMPLATEPATH . '/inc/smiley.php'); ?>
	  </div>
		</div>
			<input class="submit" name="submit" type="submit" id="submit" tabindex="5" value="发表评论" />
			<?php comment_id_fields(); ?>
		
		</div>
		<?php do_action('comment_form', $post->ID); ?>
    </form>
	<div class="clear"></div>
    <?php endif; // If registration required and not logged in ?>
  </div>
  </div>
	</div>
	</section>

<?php endif; ?>

        

				

