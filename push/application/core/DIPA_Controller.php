<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DIPA_Controller extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->library('session');
	}
}