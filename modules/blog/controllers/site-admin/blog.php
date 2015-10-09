<?php
/**
 * @author mr.v
 * @copyright http://okvee.net
 */

class blog extends admin_controller {
	
	
	function __construct() {
		parent::__construct();
		// load model
		$this->load->model(array("blog_model"));
		// load helper
		$this->load->helper(array("form", "url"));
	}// __construct
	
	
	function add() {
		// check permission
		if ( $this->account_model->check_admin_permission("blog_admin", "blog_add_post") == false ) {redirect( 'site-admin' );}
		if ( ! $this->db->table_exists( 'b_blog' ) ) {echo 'please install blog before use.'; exit;}
		$output = "";
		if ( $_POST ) {
			$data['blog_title'] = trim($this->input->post("blog_title", true));
			$data['blog_content'] = trim($this->input->post("blog_content", true));
			$ca_account = $this->account_model->get_account_cookie("admin");
			$data['blog_author'] = $ca_account['id'];
			$data['blog_date'] = date("Y-m-d", time());
			// load form_validation class
			$this->load->library(array("form_validation"));
			// validate form
			$this->form_validation->set_rules("blog_title", "Title", "trim|required");
			$this->form_validation->set_rules("blog_content", "Content", "trim|required");
			if ( $this->form_validation->run() == false ) {
				$output['form_status'] = validation_errors("<div class=\"txt_error\">", "</div>");
			} else {
				// add
				$result = $this->blog_model->add_post($data);
				if ( $result === true ) {
					$output['form_status'] = "<div class=\"txt_success\">Saved.</div>";
				} else {
					$output['form_status'] = "<div class=\"txt_error\">" . $result . "</div>";
				}
			}
			// re-populate form
			$output['blog_title'] = $data['blog_title'];
			$output['blog_content'] = htmlentities($data['blog_content'], ENT_QUOTES, "UTF-8");
		}
		$output['admin_content'] = $this->load->view("blog/site-admin/blog_ae_view", $output, true);
		// headr tags output###########################################
		$output['page_title'] = $this->config_model->load("site_name") . $this->config_model->load("page_title_separator") . "blog / new post";
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
	}// add
	
	
	function edit() {
		// check permission
		if ( $this->account_model->check_admin_permission("blog_admin", "blog_edit_post") == false ) {redirect( 'site-admin' );}
		$id = trim($this->input->get("id", true));
		if ( !is_numeric($id) ) {redirect( 'site-admin' );}
		$output['id'] = $id;
		// load data for form
		$this->db->where("blog_id", $id);
		$query = $this->db->get($this->db->dbprefix("b_blog"));
		if ( $query->num_rows() > 0 ) {
			$row = $query->row();
			$output['blog_title'] = $row->blog_title;
			$output['blog_content'] = $row->blog_content;
			$output['blog_author'] = $row->blog_author;
			$output['blog_author_uname'] = $this->account_model->show_accounts_info($row->blog_author, "account_id", "account_username");
		} else {
			$query->free_result();
			show_404();
			exit();
		}
		$query->free_result();
		// post method
		if ( $_POST ) {
			$data['blog_title'] = trim($this->input->post("blog_title", true));
			$data['blog_content'] = trim($this->input->post("blog_content", true));
			// load form_validation class
			$this->load->library(array("form_validation"));
			// validate form
			$this->form_validation->set_rules("blog_title", "Title", "trim|required");
			$this->form_validation->set_rules("blog_content", "Content", "trim|required");
			if ( $this->form_validation->run() == false ) {
				$output['form_status'] = validation_errors("<div class=\"txt_error\">", "</div>");
			} else {
				// add
				$result = $this->blog_model->edit_post($data);
				if ( $result === true ) {
					$output['form_status'] = "<div class=\"txt_success\">Saved.</div>";
				} else {
					$output['form_status'] = "<div class=\"txt_error\">" . $result . "</div>";
				}
			}
			// re-populate form
			$output['blog_title'] = $data['blog_title'];
			$output['blog_content'] = $data['blog_content'];
		}
		$output['admin_content'] = $this->load->view("blog/site-admin/blog_ae_view", $output, true);
		// headr tags output###########################################
		$output['page_title'] = $this->config_model->load("site_name") . $this->config_model->load("page_title_separator") . "blog / edit post";
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
	}// edit
	
	
	function index() {
		if ( ! $this->db->table_exists( 'b_blog' ) ) {echo 'please install blog before use.'; exit;}
		$output['list_item'] = $this->blog_model->list_post();
		if ( is_array( $output['list_item'] ) ) {
			$output['pagination'] = $this->pagination->create_links();
		}
		$output['admin_content'] = $this->load->view("blog/site-admin/blog_view", $output, true);
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
		$this->load->view("site-admin/index_view", $output);
	}// index
	
	
	function process_bulk() {
		$this->load->database();
		$id = $this->input->post("id");
		$cmd = trim($this->input->post("cmd"));
		foreach ( $id as $an_id ) {
			if ( $cmd == "del" ) {
				// check permission
				if ( $this->account_model->check_admin_permission('blog_admin', "blog_delete_post") != false ) {
					$this->db->where("blog_id", $an_id);
					$this->db->delete($this->db->dbprefix("b_blog"));
				}
			}
		}
		// go back
		redirect($this->uri->segment(1)."/".$this->uri->segment(2)."/blog");
	}// process_bulk
	
	
}