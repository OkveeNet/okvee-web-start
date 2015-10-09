<?php echo doctype("html5") . "\n"; ?>
<html>
	<head>
		<?php echo meta('Content-type', 'text/html; charset=utf-8', 'equiv'); ?>
		<title><?php echo (isset($page_title) ? $page_title : ""); ?></title>
		<?php
		if ( isset($page_metatag) && is_array($page_metatag) ) {
			echo "<!-- additional meta tag -->\n";
			foreach ( $page_metatag as $key => $item ) {
				echo $item;
			}
			echo "<!-- end additional meta tag -->\n";
		}
		?>
		
		<?php
		echo link_tag( 'client/themes/'.$this->config->item( 'usetheme' ).'/style-sample.css' );// sample css.
		if ( isset($page_linktag) && is_array($page_linktag) ) {
			echo "<!-- additional link tag -->\n";
			foreach ( $page_linktag as $key => $item ) {
				echo $item . "\n";
			}
			echo "<!-- end additional link tag -->";
		}
		?>
		
		<script src="<?php echo base_url(); ?>client/js/jquery.js" type="text/javascript"></script>
		<?php
		if ( isset($page_scripttag) && is_array($page_scripttag) ) {
			echo "<!-- additional script tag -->\n";
			foreach ( $page_scripttag as $key => $item ) {
				echo $item;
			}
			echo "<!-- end additional script tag -->\n";
		}
		?>
		
	</head>
	
	<body>
		
		
		<div class="container">
			<h1 class="site-name"><?php echo lang("account_register"); ?></h1>

			<div class="full-column">
				<?php echo form_open(); ?>
					<div class="form_result"><?php echo (isset($form_status) ? $form_status : ""); ?></div>
					<dl>
						<dt><?php echo lang("account_username"); ?>:</dt>
						<dd><input type="text" name="username" value="<?php echo (isset($username) ? $username : ""); ?>" /></dd>
						<dd class="comment"></dd>
						<dt><?php echo lang("account_email"); ?>:</dt>
						<dd><input type="text" name="email" value="<?php echo (isset($email) ? $email : ""); ?>" /></dd>
						<dd class="comment"></dd>
						<dt class="captcha_fieldset">&nbsp;</dt>
						<dd class="captcha_fieldset"><img src="<?php echo base_url(); ?>client/images/securimage_show.php" alt="securimage" id="captcha" />
							<a href="#" onclick="document.getElementById('captcha').src = '<?php echo base_url(); ?>client/images/securimage_show.php?' + Math.random(); return false"><img src="<?php echo base_url(); ?>client/images/reload.gif" alt="" /></a>
						</dd>
						<dt class="captcha_fieldset"><?php echo lang("account_captcha"); ?>:</dt>
						<dd class="captcha_fieldset"><?php echo form_input("captcha", (isset($captcha) ? $captcha : "")); ?></dd>

						<dt>&nbsp;</dt>
						<dd><?php echo form_submit("btn", lang("account_submit")); ?></dd>
					</dl>

					<div class="clear"></div>
				<?php echo form_close("\n"); ?>
			</div>
		</div>
		
		
	</body>
</html>