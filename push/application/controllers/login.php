<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends DIPA_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
	}
	
	function index(){
		$login_json = $this->input->post('login');
		$login_data = json_decode($login_json);
		if($login_data != null){
			if($login_data->ErrorCode == 0){
				$session = array('dipa_user' => $login_data->DATA);
				$this->session->set_userdata($session);
				echo 0;
			}else{
				echo -1; // login failed
			}
		}
	}
	
	function access(){
		echo '{"ErrorCode":0,"Login":0,"DATA":{"userId":"4605","user":"van vo","groupId":"14","company":"my company","telephone":"0123456789","email":"sad"},"Message":"Login Success"}';
	}
	
	function logout(){
		$this->session->unset_userdata('dipa_user');
	}
}