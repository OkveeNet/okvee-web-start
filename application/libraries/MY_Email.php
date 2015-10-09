<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Email extends CI_Email {
	function __construct( $config = array() ) {
		parent::__construct( $config );
	}

	// --------------------------------------------------------------------
	
	/**
	 * Set Email Subject
	 *
	 * @access	public
	 * @param	string
	 * @return	void
	 */
	function subject( $subject )
	{
		$subject = "=?UTF-8?B?".base64_encode( $subject )."?=";
		//$subject = $this->_prep_q_encoding($subject);
		$this->_set_header( 'Subject', $subject );
		return $this;
	}// subject
	
}

/* End of file MY_Email.php */
/* Location: ./system/libraries/MY_Email.php */