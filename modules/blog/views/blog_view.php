<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Simple Sample Blog module</title>
	</head>
	<body>
		<?php echo anchor("", "Home"); ?>
		<h1>Blog</h1>
		
		<?php if ( isset($list_blog_post['items']) && is_array($list_blog_post['items']) ): ?>
		<?php foreach ( $list_blog_post['items'] as $key ): ?>
		
		<h2><?php echo $key->blog_title; ?></h2>
		<span><?php echo $key->blog_date; ?> - <?php echo account_show_info($key->blog_author, "account_id", "account_username"); ?></span>
		<p>
			<?php echo $key->blog_content; ?>
		</p>
		<hr />
		
		<?php endforeach; ?>
		
		<?php echo (isset($pagination) ? $pagination : ""); ?>
		
		<?php else: ?>
		No blog post.
		<?php endif; ?>
	</body>
</html>