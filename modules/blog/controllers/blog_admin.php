<?php
/**
 * @author mr.v
 * @copyright http://okvee.net
 */

class blog_admin extends MX_Controller {
	
	
	function __construct() {
		parent::__construct();
		// load helper
		$this->load->helper(array("url"));
	}// __construct
	
	
	/**
	 * _define_permission
	 * กำหนด permission ที่ method นี้ภายใน controller นี้ (ชื่อโมดูล_admin) สำหรับการทำงานแบบ module
	 * @return array
	 */
	function _define_permission() {
		// return array("permission_page" => array("action1", "action2"));
		return array("blog_admin" => array("blog_add_post", "blog_edit_post", "blog_delete_post", "blog_add_remove"));
	}// _define_permission
	
	
	function admin_nav() {
		return "<li>" . anchor("blog/site-admin/blog", "blog") . "
				<ul>
					<li>" . anchor("blog/site-admin/blog/add", "add post") . "</li>
					<li>" . anchor("blog/site-admin/blog", "manage") . "</li>
					<li>" . anchor("blog/site-admin/package", "install/uninstall") . "
						<ul>
							<li>" . anchor("blog/site-admin/package/install", "install") . "</li>
							<li>" . anchor("blog/site-admin/package/uninstall", "uninstall") . "</li>
						</ul>
					</li>
				</ul>
			</li>";
	}// admin_nav
	
	
}