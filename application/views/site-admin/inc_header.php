		<div class="page_container">
			<div class="header">
				<div class="website"><a href="<?php echo site_url("site-admin"); ?>"><span class="logo"><?php echo $this->config_model->load("site_name"); ?></span></a></div>
				<div class="menu"><?php echo sprintf(lang("account_hello"), account_show_info()); ?> | <?php echo anchor("site-admin/logout", lang("account_logout")); ?></div>
				<div class="clear"></div>
				<div class="nav">
					<ul class="sf-menu">
						<li><?php echo anchor("", lang("admin_site")); ?>
							<ul>
								<li><?php echo anchor("site-admin", lang("admin_dashboard")); ?></li>
								<?php if ( check_admin_permission( 'admin_global_config', 'admin_website_config' ) ): ?><li><?php echo anchor("site-admin/config", lang("admin_global_config")); ?></li><?php endif; ?>
							</ul>
						</li>
						<li><?php echo anchor("site-admin/account", lang("account_account")); ?>
							<ul>
								<?php if ( check_admin_permission( 'account_account', 'account_add' ) ): ?><li><?php echo anchor("site-admin/account/add", lang("account_add")); ?></li><?php endif; ?>
								<li><?php echo anchor("site-admin/account/edit", lang("account_edit_yours")); ?></li>
								<li><a><?php echo lang("account_level_n_permissions"); ?></a>
									<ul>
										<?php if ( check_admin_permission( 'account_level', 'account_manage_level' ) ): ?><li><?php echo anchor("site-admin/account-level", lang("account_level")); ?></li><?php endif; ?>
										<?php if ( check_admin_permission( 'account_permissions', 'account_manage_permission' ) ): ?><li><?php echo anchor("site-admin/account-permission", lang("account_permissions")); ?></li><?php endif; ?>
									</ul>
								</li>
							</ul>
						</li>
						<li><?php echo anchor("site-admin", lang("admin_component"), array("onclick" => "return false;")); ?>
							<?php echo $this->modules_model->load_admin_nav(); ?>
						</li>
					</ul>
					<div class="clear"></div>
				</div><!--.nav-->
			</div><!--.header-->



