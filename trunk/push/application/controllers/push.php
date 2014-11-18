<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Push extends DIPA_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->model ( 'push_model' );
	}
	
	// Entry point
	function index() {
		$is_login = $this->session->userdata ( 'dipa_user' );
		if (!$is_login) {
			if (ENVIRONMENT == "development") {
				$data = array (
						"url" => LOGIN_DEV 
				);
				// $data = array_merge($data, array("username" => "marktestvn@gmail.com", "password" => "123456"));
				$this->load->view ( 'login_view', $data );
			} else {
				$data = array (
						"url" => LOGIN_DIS 
				);
				$this->load->view ( 'login_view', $data );
			}
		} else {
			$this->load->view ( 'push_view', $is_login );
		}
	}
	
	/**
	 * Send Push
	 * @param number $platformId
	 */
	function send($platformId = ALL_PLATFORM) {
		$udids = $this->push_model->getAllDevice ( $platformId );
		$ids = array ();
		if (sizeof ( $udids ) > 0) {
			foreach ( $udids as $v ) {
				$ids [] = $v ['udid'];
			}
		}
		$data = array();
		if(array_key_exists('last-news', $this->input->post())){		
			$last_news = $this->input->post('last-news');
			$msg_it = '';
			$msg_uk = '';
			$data = array (
					'msg-it' => $msg_it,
					'msg-uk' => $msg_uk,
					'last-news' => $last_news
			);
		}else{
			$msg_it = $this->input->post ( 'lang-italian' );
			$msg_uk = $this->input->post ( 'lang-english' );
			$data = array (
					'msg-it' => $msg_it,
					'msg-uk' => $msg_uk,
			);
		}
		
		$data_to_send = array (
				'registration_ids' => $ids, // array('APA91bEh3L2DrOBf4YBjp4ffGrgP-43N8kPzbrrS2bFJeyKEOZWpMm_kK9PQzgX5EjoW6fBM4Be4N5mtvDk4bSMBVyfi6LKqijMKyX7181Rmlo2c8HDtT_sbYrl84LQwNjrsDVh_CRDfv301q7E3FSrm7f5gWXM-zqTVgZmeCHu9nO9BAt1lEgQ'),
				'data' => $data 
		);

		switch($platformId){
			case ANDROID_PLATFORM:
				$this->push_android($data_to_send);
				break;
			case IOS_PLATFORM:
				$this->push_ios($data_to_send);
				break;
			case WP8_PLATFORM:
				$this->push_wp8($data_to_send);		
				break;
			default: /* ALL_PLATFORM */
				$this->push_android($data_to_send);
				$this->push_ios($data_to_send);
				$this->push_wp8($data_to_send);
				break;
		}
	}
	
	/**
	 * Push to Android
	 * @param unknown $data_to_send
	 */
	function push_android($data_to_send) {
		// ------------------------------
		// Replace with real GCM API
		// key from Google APIs Console
		//
		// https://code.google.com/apis/console/
		// ------------------------------
		$apiKey = ANDROID_PUSH_ID;
		
		// ------------------------------
		// Define URL to GCM endpoint
		// ------------------------------
		
		$url = ANDROID_PUSH_URL;
		
		// ------------------------------
		// Set GCM post variables
		// (Device IDs and push payload)
		// ------------------------------
		
		// ------------------------------
		// Set CURL request headers
		// (Authentication and type)
		// ------------------------------
		
		$headers = array (
				'Authorization: key=' . $apiKey,
				'Content-Type: application/json' 
		);
		
		// ------------------------------
		// Initialize curl handle
		// ------------------------------
		
		$ch = curl_init ();
		
		// ------------------------------
		// Set URL to GCM endpoint
		// ------------------------------
		
		curl_setopt ( $ch, CURLOPT_URL, $url );
		
		// ------------------------------
		// Set request method to POST
		// ------------------------------
		
		curl_setopt ( $ch, CURLOPT_POST, true );
		
		// ------------------------------
		// Set our custom headers
		// ------------------------------
		
		curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
		
		// ------------------------------
		// Get the response back as
		// string instead of printing it
		// ------------------------------
		
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
		
		// ------------------------------
		// Set post data as JSON
		// ------------------------------
		
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, json_encode ( $data_to_send ) );
		
		// ------------------------------
		// Actually send the push!
		// ------------------------------
		
		$result = curl_exec ( $ch );
		
		// ------------------------------
		// Error? Display it!
		// ------------------------------
		
		if (curl_errno ( $ch )) {
			echo 'GCM error: ' . curl_error ( $ch );
		}
		
		// ------------------------------
		// Close curl handle
		// ------------------------------
		
		curl_close ( $ch );
		
		// ------------------------------
		// Debug GCM response
		// ------------------------------
		if (json_decode ( $result ) != null) {
			echo 1;
		} else {
			echo 0;
		}
	}
	
	/**
	 * Pust to iOS
	 * @param unknown $data_to_send
	 */
	function push_ios($data_to_send){
		// Put your private key's passphrase here:
		$passphrase = 'dipasport';
		////////////////////////////////////////////////////////////////////////////////
		$ctx = stream_context_create();
		stream_context_set_option($ctx, 'ssl', 'local_cert', 'ck.pem');
		stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
		
		// Open a connection to the APNS server
		$server = (ENVIRONMENT == "production") ? APPLE_PUSH_REL : APPLE_PUSH_DEV;
		$fp = stream_socket_client($server, $err,
				$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
		
		if (!$fp)
			exit("Failed to connect: $err $errstr" . PHP_EOL);
		$result = false;
		foreach($data_to_send['registration_ids'] as $deviceToken){
			// Create the payload body
			$body['aps'] = array(
					'alert' => $data_to_send['data'],
					'sound' => 'default'
			);
			
			// Encode the payload as JSON
			$payload = json_encode($body);
			
			// Build the binary notification
			$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
			
			// Send it to the server
			$result = fwrite($fp, $msg, strlen($msg));
			
		}
		//echo 'Message successfully delivered' . PHP_EOL;
		echo 1;
		
		// Close the connection to the server
		fclose($fp);
	}
	
	/**
	 * Push to WP8
	 * @param unknown $data_to_send
	 */
	function push_wp8($data_to_send){
		
	}
	
	function test() {
		$platform = 0;
		if(array_key_exists('p', $_GET)){
			$platform = $this->input->get('p');
		}
		$udids = $this->push_model->getAllDevice ( $platform );
		print_r ( json_encode($udids) );
	}
}