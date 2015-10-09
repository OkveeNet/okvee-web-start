<?php

/**
 * @author mr.v
 * @copyright http://okvee.net
 */
class package extends admin_controller {

	
	function __construct() {
		parent::__construct();
	}// __construct
	
	
	function index() {
		// check permission
		if ( $this->account_model->check_admin_permission("blog_admin", "blog_add_remove") == false ) {redirect( 'site-admin' );}
		// nothing here
		echo anchor("blog/site-admin/package/install", "install") . "<br />";
		echo anchor("blog/site-admin/package/uninstall", "uninstall") . "<br />";
	}// index
	
	
	function install() {
		// check permission
		if ( $this->account_model->check_admin_permission("blog_admin", "blog_add_remove") == false ) {redirect( 'site-admin' );}
		// load db
		$this->load->database();
		if ( $this->db->table_exists($this->db->dbprefix("b_blog")) ) {
			$output['install_result'] = "บล็อกได้ติดตั้งอยู่แล้ว คุณอาจ uninstall ก่อนแล้วจึงติดตั้งอีกครั้ง";
		} else {
			include(APPPATH."/config/database.php");
			$sql = "CREATE TABLE `" . $db['default']['database'] . "`.`" . $this->db->dbprefix("b_blog") . "` (
				`blog_id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
				`blog_title` VARCHAR( 255 ) NULL DEFAULT NULL ,
				`blog_content` TEXT NULL DEFAULT NULL ,
				`blog_author` INT( 11 ) NULL DEFAULT NULL COMMENT 'refer to account_id',
				`blog_date` DATE NULL DEFAULT NULL
				) ENGINE = InnoDB;";
			$result = $this->db->query($sql);
			if ( $result === true ) {
				$output['install_result'] = "ติดตั้งสำเร็จ";
			} else {
				$output['install_result'] = "ติดตั้งล้มเหลว ลองนำคำสั่งนี้รันผ่าน mysql, phpmyadmin<br />\n $sql";
			}
		}
		$output['admin_content'] = $this->load->view("blog/site-admin/blog_install_view", $output, true);
		// headr tags output###########################################
		$output['page_title'] = $this->config_model->load("site_name") . $this->config_model->load("page_title_separator") . "install blog";
		// meta tag
		//$output['page_metatag'][] = meta("Cache-Control", "no-cache", "http-equiv");
		//$output['page_metatag'][] = meta("Pragma", "no-cache", "http-equiv");
		// link tag
		//$output['page_linktag'][] = link_tag("favicon.ico", "shortcut icon", "image/ico");
		//$output['page_linktag'][] = link_tag("favicon2.ico", "shortcut icon2", "image/ico");
		// script tag
		//$output['page_scripttag'][] = "<script type=\"text/javascript\" href=\"tinymcs.js\"></script>\n";
		//$output['page_scripttag'][] = "<script type=\"text/javascript\" href=\"fckkeditor.js\"></script>\n";
		// end headr tags output###########################################
		// output
		$this->load->view("site-admin/index_view", $output);
	}// install
	
	
	function uninstall() {
		// check permission
		if ( $this->account_model->check_admin_permission("blog_admin", "blog_add_remove") == false ) {redirect( 'site-admin' );}
		// load db
		$this->load->database();
		if ( $this->db->table_exists($this->db->dbprefix("b_blog")) ) {
			$this->db->query("DROP TABLE `" . $this->db->dbprefix("b_blog") . "`");
		}
		$output['install_result'] = "ถอนการติดตั้งสำเร็จ";
		$output['admin_content'] = $this->load->view("blog/site-admin/blog_install_view", $output, true);
		// headr tags output###########################################
		$output['page_title'] = $this->config_model->load("site_name") . $this->config_model->load("page_title_separator") . "uninstall blog";
		// meta tag
		//$output['page_metatag'][] = meta("Cache-Control", "no-cache", "http-equiv");
		//$output['page_metatag'][] = meta("Pragma", "no-cache", "http-equiv");
		// link tag
		//$output['page_linktag'][] = link_tag("favicon.ico", "shortcut icon", "image/ico");
		//$output['page_linktag'][] = link_tag("favicon2.ico", "shortcut icon2", "image/ico");
		// script tag
		//$output['page_scripttag'][] = "<script type=\"text/javascript\" href=\"tinymcs.js\"></script>\n";
		//$output['page_scripttag'][] = "<script type=\"text/javascript\" href=\"fckkeditor.js\"></script>\n";
		// end headr tags output###########################################
		// output
		$this->load->view("site-admin/index_view", $output);
	}// uninstall

	
}