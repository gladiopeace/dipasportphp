<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Register extends DIPA_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->model ( 'push_model' );
	}
	
	public function add_device() {
		$status = true;
		$results = array ();
		if (sizeof ( $this->input->post () ) == 0 || sizeof ( $this->input->get () ) == 0) {
			$status = false;
		} else {
			if (array_key_exists ( 'udid', $this->input->get () ) && array_key_exists ( 'platform', $this->input->get () )) {
				$udid = $this->input->get ( 'udid' );
				$platformId = $this->input->get('platform');
				$status = $this->push_model->addDevice ( $udid, $platformId );
			}
		}
		
		$results = array (
				'status' => $status 
		);
		
		echo json_encode ( $results );
	}
}