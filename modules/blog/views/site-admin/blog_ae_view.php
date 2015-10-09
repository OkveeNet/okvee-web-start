<h1><?php if ( $this->uri->segment(4) == "add" ): ?>Add blog<?php else: ?>Edit blog<?php endif; ?></h1>

<?php echo form_open(current_url().($this->uri->segment(4) == "edit" ? "?id=$id" : "")); ?>
	<?php echo (isset($form_status) ? $form_status : ""); ?>

	<dl class="form_item">
		<dt>Title: </dt>
		<dd><input type="text" name="blog_title" value="<?php echo (isset($blog_title) ? $blog_title : ""); ?>" maxlength="255" /></dd>
		
		<dt>Content: </dt>
		<dd><?php echo form_textarea("blog_content", (isset($blog_content) ? $blog_content : "")); ?></dd>
		<dd class="comment">HTML allowed.</dd>
		
		<dt>&nbsp;</dt>
		<dd><?php echo form_submit("btn", "save"); ?></dd>
	</dl>
<?php echo form_close("\n"); ?>