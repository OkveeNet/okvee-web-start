<?php
/**
 * @author mr.v
 * @copyright http://okvee.net
 */

class index extends MX_Controller {
	
	
	function __construct() {
		parent::__construct();
		// load model
		$this->load->model( array( 'account/account_model', 'config_model' ) );
		// load helper
		$this->load->helper( array( 'html', 'url' ) );
	}// __construct
	
	
	function index() {
		// load config
		$this->config->load( 'website' );
		$output['is_member_login'] = $this->account_model->is_member_login();
		// headr tags output###########################################
		$output['page_title'] = $this->config_model->load( 'site_name' );
		// meta tag
		//$output['page_metatag'][] = meta( 'Cache-Control', 'no-cache', 'http-equiv' );
		//$output['page_metatag'][] = meta( 'Pragma', 'no-cache', 'http-equiv' );
		// link tag
		//$output['page_linktag'][] = link_tag( 'favicon.ico', 'shortcut icon', 'image/ico' );
		//$output['page_linktag'][] = link_tag( 'favicon2.ico', 'shortcut icon2', 'image/ico' );
		// script tag
		//$output['page_scripttag'][] = "<script type=\"text/javascript\" src=\"tinymcs.js\"></script>\n";
		//$output['page_scripttag'][] = "<script type=\"text/javascript\" src=\"fckkeditor.js\"></script>\n";
		// end headr tags output###########################################
		// output
		$this->load->view( 'index_view', $output );
	}// index
	
	
}