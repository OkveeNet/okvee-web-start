<?php
/**
 * @author mr.v
 * @copyright http://okvee.net
 */

class register extends MX_Controller {

	
	function __construct() {
		parent::__construct();
		// load model
		$this->load->model( array( 'account/account_model', 'config_model' ) );
		// load helper
		$this->load->helper( array( 'html', 'form', 'language', 'url' ) );
		// load library
		$this->load->library( array( 'securimage/securimage' ) );
		// load langauge
		$this->lang->load( 'account' );
	}// __construct
	
	
	function index() {
		if ( $this->config_model->load( 'member_allow_register' ) == '0' ) {show_404(); exit;}// check for allow register
		if ( $_POST ) {
			$data['account_username'] = trim( strip_tags( $this->input->post( 'username', true ) ) );
			$data['account_email'] = trim( strip_tags( $this->input->post( 'email' ) ) );
			// load form_validation class
			$this->load->library( array( 'form_validation', 'session' ) );
			// validate form
			$this->form_validation->set_rules( 'username', 'lang:account_username', 'trim|required|alpha_dash' );
			$this->form_validation->set_rules( 'email', 'lang:account_email', 'trim|required|valid_email' );
			if ( $this->form_validation->run() == false ) {
				$output['form_status'] = validation_errors( '<div class="txt_error">', '</div>' );
			} else {
				if ( $this->securimage->check( $this->input->post( 'captcha', true ) ) == false ) {
					$output['form_status'] = '<div class="txt_error">' . $this->lang->line( 'account_wrong_captcha_code' ) . '</div>';
				} else {
					// register account
					$result = $this->account_model->register_account( $data );
					if ( $result === true ) {
						$output['form_status'] = '<div class="txt_success">' . $this->lang->line( 'account_registered_please_check_email' ) . '</div>';
					} else {
						$output['form_status'] = '<div class="txt_error">' . $result . '</div>';
					}
				}
			}
			// re-populate form
			$output['username'] = $data['account_username'];
			$output['email'] = $data['account_email'];
		}
		// headr tags output###########################################
		$output['page_title'] = $this->config_model->load( 'site_name' ) . $this->config_model->load( 'page_title_separator' ) . $this->lang->line( 'account_register' );
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
		$this->load->view( 'account/register_view', $output );
	}// index

	
}