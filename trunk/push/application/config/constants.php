<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

//URLs
define('LOGIN_DEV',								'http://testdipacommerce.no-ip.org:8000/services/service.php?op=login');
define('LOGIN_DIS',								'http://dipacommerce.com/services/service.php?op=login');

// Platforms
define('UNKNOWN_PLATFORM', 						-1);
define('ALL_PLATFORM', 							0);
define('ANDROID_PLATFORM', 						1);
define('IOS_PLATFORM', 							2);
define('WP8_PLATFORM', 							3);

define('ANDROID_PUSH_ID',						'AIzaSyBWoTZhOqIdiROPE7prUkmgYLxqyR_u8lQ');
define('ANDROID_PUSH_URL',						'https://android.googleapis.com/gcm/send');

define('APPLE_PUSH_DEV',						'ssl://gateway.sandbox.push.apple.com:2195');
define('APPLE_PUSH_REL',						'ssl://gateway.push.apple.com:2195');
/* End of file constants.php */
/* Location: ./application/config/constants.php */