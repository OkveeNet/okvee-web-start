<h1>Blog</h1>

<?php echo anchor("blog/site-admin/blog/add", "New post"); ?> | <?php echo (isset($list_blog_post['total_post']) ? $list_blog_post['total_post'] : '0'); ?> posts.

<?php echo form_open("blog/site-admin/blog/process_bulk"); ?>
	<?php echo (isset($form_status) ? $form_status : ""); ?>

	<table class="list_item">
		<thead>
			<tr>
				<th><input type="checkbox" name="id_all" value="" onclick="checkAll(this.form,'id[]',this.checked)" /></th>
				<th>id</th>
				<th>title</th>
				<th>by</th>
				<th>date</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php if ( isset($list_item['items']) && is_array($list_item['items']) ): ?>
			<?php foreach ( $list_item['items'] as $row ): ?>
			<tr>
				<td><?php echo form_checkbox("id[]", $row->blog_id); ?></td>
				<td><?php echo $row->blog_id; ?></td>
				<td>
					<?php echo $row->blog_title ?><br />
					<?php echo nl2br(mb_strimwidth(strip_tags($row->blog_content), 0, 50, "...")); ?>
				</td>
				<td><?php echo account_show_info($row->blog_author, "account_id", "account_username"); ?></td>
				<td><?php echo $row->blog_date; ?></td>
				<td><?php echo anchor("blog/site-admin/blog/edit?id=".$row->blog_id, "edit"); ?></td>
				
			</tr>
			<?php endforeach; ?>
			<?php else: ?>
			<tr>
				<td colspan="6">no entry.</td>
			</tr>
			<?php endif; ?>
		</tbody>
	</table>

	<div class="list_item_cmdleft">
		<select name="cmd">
			<option></option>
			<option value="del"><?php echo lang("admin_delete"); ?></option>
		</select>
		<?php echo form_submit("btn", lang("admin_submit")); ?>
	</div><!--.list_item_cmdleft-->
	<div class="list_item_cmdright">
		<?php echo (isset($pagination) ? $pagination : ""); ?>
	</div><!--.list_item_cmdright-->
	<div class="clear"></div>
<?php echo form_close("\n"); ?>