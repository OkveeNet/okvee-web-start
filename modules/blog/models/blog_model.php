<?php
/*
 * @author mr.v
 * @copyright http://okvee.net
 */

class blog_model extends CI_Model {
	
	
	function __construct() {
		parent::__construct();
	}// __construct
	
	
	/**
	 * add_post
	 * @param array $data
	 * @return boolean 
	 */
	function add_post($data = '') {
		if ( !is_array($data) ) {return false;}
		$this->db->set("blog_title", $data['blog_title']);
		$this->db->set("blog_content", $data['blog_content']);
		$this->db->set("blog_author", $data['blog_author']);
		$this->db->set("blog_date", $data['blog_date']);
		$this->db->insert($this->db->dbprefix("b_blog"));
		return true;
	}// add_post
	
	
	/**
	 * edit_post
	 * @param array $data
	 * @return boolean 
	 */
	function edit_post($data = '') {
		$id = trim($this->input->get("id", true));
		if ( !is_numeric($id) ) {redirect($this->uri->segment(1));}
		if ( !is_array($data) ) {return false;}
		$this->db->set("blog_title", $data['blog_title']);
		$this->db->set("blog_content", $data['blog_content']);
		$this->db->where("blog_id", $id);
		$this->db->update($this->db->dbprefix("b_blog"));
		return true;
	}// edit_post
	
	
	/**
	 * list_post
	 * @param 'admin'|'web' $forside admin|web
	 * @return null|array 
	 */
	function list_post($forside = "admin") {
		// load account_model for show account username
		$this->load->model("account/account_model");
		if ( $forside != "admin" ) {$forside = "web";}
		$this->load->database();
		// load 'website' config file.
		$this->config->load("website");
		// query sql
		$sql = "select * from " . $this->db->dbprefix("b_blog") . " order by blog_id desc";
		// query for count total
		$query = $this->db->query($sql);
		$total = $query->num_rows();
		// pagination-----------------------------
		$this->load->library('pagination');
		if ( $forside == "admin" ) {
			$config['base_url'] = site_url()."/".$this->uri->segment(1)."/".$this->uri->segment(2)."/".$this->uri->segment(3)."?blog";
		} else {
			$config['base_url'] = site_url()."/".$this->uri->segment(1)."?blog";
		}
		$config['total_rows'] = $total;
		$config['per_page'] = $this->config->item('web_items_per_page');
		$config['num_links'] = 5;
		$config['page_query_string'] = true;
		$config['full_tag_open'] = "<div class=\"pagination\">";
		$config['full_tag_close'] = "</div>\n";
		$config['first_link'] = $this->lang->line("admin_first_page");
		$config['last_link'] = $this->lang->line("admin_last_page");
		$this->pagination->initialize($config);
		//you may need this in view if you call this in controller or model --> $this->pagination->create_links();
		$start_item = ($this->input->get("per_page") == null ? "0" : $this->input->get("per_page"));
		// end pagination-----------------------------
		$sql .= " limit ".$start_item.", ".$config['per_page']."";
		// re-query again for pagination
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0 ) {
			$output['total_post'] = $total;
			/*foreach ( $query->result() as $row ) {
				$output[$row->blog_id]['blog_title'] = $row->blog_title;
				$output[$row->blog_id]['blog_content'] = $row->blog_content;
				$output[$row->blog_id]['blog_author'] = $row->blog_author;
				$output[$row->blog_id]['blog_author_uname'] = $this->account_model->show_accounts_info($row->blog_author, "account_id", "account_username");
				$output[$row->blog_id]['blog_date'] = $row->blog_date;
			}*/
			$output['items'] = $query->result();
			$query->free_result();
			return $output;
		}
		$query->free_result();
		return null;
	}// list_post
	
	
}