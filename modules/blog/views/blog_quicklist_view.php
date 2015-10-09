	<div>
		<h3>Blog</h3>
		
		<?php $count = 1; ?>
		<?php if ( isset($list_blog_post['items']) && is_array($list_blog_post['items']) ): ?>
		<?php foreach ( $list_blog_post['items'] as $key ): ?>
		
		<h3><?php echo $key->blog_title; ?></h3>
		<span><?php echo $key->blog_date; ?> - <?php echo account_show_info($key->blog_author, "account_id", "account_username"); ?></span>
		<p>
			<?php echo mb_strimwidth($key->blog_content, 0, 200, "..."); ?>
		</p>
		<hr />
		
				<?php
				if ( $count >= 5 ) {break;}
				$count++;
				?>
		<?php endforeach; ?>
		
		<?php echo anchor("blog", "More.."); ?>
		
		<?php else: ?>
		No blog post.
		<?php endif; ?>
	</div>