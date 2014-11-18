<?php
class Push_Model extends CI_Model{
	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	/**
	 * 
	 * @param unknown $udid
	 * @param unknown $platform
	 * 	-1: unknown platform
	 *   0: all platforms
	 *   1: Android
	 *   2: iOS
	 *   3: WP8
	 */
	function addDevice($udid, $platformId = UNKNOWN_PLATFORM /* none */){
		if($platformId == UNKNOWN_PLATFORM) return FALSE;
		$this->db->trans_start();
		$data = array(
			'udid' => $udid,
			'platform' => $platformId
		);
		$this->db->insert('push_message', $data);
		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE){
			return FALSE;
		}else{
			$rows = $this->db->affected_rows();
			return $rows;
		}
	}
	
	/**
	 * 
	 * @param unknown $platformId
	 * 	-1: unknown platform
	 *   0: all platforms
	 *   1: Android
	 *   2: iOS
	 *   3: WP8
	 * @return multitype:
	 */
	function getAllDevice($platformId = UNKNOWN_PLATFORM){
		if($platformId == UNKNOWN_PLATFORM) return array();
		$this->db->select('udid');
		if($platformId != 0){
			$this->db->where('platform', $platformId);
		}
		$this->db->distinct();
		$query = $this->db->get('push_message');
		if($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return array();
		}
	}
}