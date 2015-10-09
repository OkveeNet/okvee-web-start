<?php
/**
 * @author mr.v
 * @copyright http://okvee.net
 */

class blog extends MX_Controller {
	
	
	function __construct() {
		parent::__construct();
		// load model
		$this->load->model(array("blog_model", "config_model"));
		// load helper
		$this->load->helper( array( 'account/account' ) );
	}// __construct
	
	
	function index() {
		$output['list_blog_post'] = $this->blog_model->list_post("web");
		$output['pagination'] = @$this->pagination->create_links();
		// headr tags output###########################################
		$output['page_title'] = $this->config_model->load("site_name") . $this->config_model->load("page_title_separator") . "blog";
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
		$this->load->view("blog/blog_view", $output);
	}// index
	
	
	function quicklist() {
		$output['list_blog_post'] = $this->blog_model->list_post("web");
		// output
		return $this->load->view("blog/blog_quicklist_view", $output, true);
	}
	
	
}