<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2006, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Logging Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Logging
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/general/errors.html
 */
class CI_Log {

	var $log_path;
	var $_threshold	= 1;
	var $_date_fmt	= 'Y-m-d H:i:s';
	var $_enabled	= TRUE;
	var $_levels	= array('HIGH' => -1, 'ERROR' => '1', 'DEBUG' => '3',  'INFO' => '2', 'ALL' => '4');
	var $CI;

	/**
	 * Constructor
	 *
	 * @access	public
	 */
	function __construct()
	{
		$config =& get_config();
		
		$this->log_path = ($config['log_path'] != '') ? $config['log_path'] : BASEPATH.'logs/';
		
		if ( ! is_dir($this->log_path) OR ! is_really_writable($this->log_path))
		{
			$this->_enabled = FALSE;
		}
		
		if (is_numeric($config['log_threshold']))
		{
			$this->_threshold = $config['log_threshold'];
		}
			
		if ($config['log_date_format'] != '')
		{
			$this->_date_fmt = $config['log_date_format'];
		}
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Write Log File
	 *
	 * Generally this function will be called using the global log_message() function
	 *
	 * @access	public
	 * @param	string	the error level
	 * @param	string	the error message
	 * @param	bool	whether the error is a native PHP error
	 * @return	bool
	 */		
	function write_log($level = 'error', $msg, $php_error = FALSE)
	{		
		if ($this->_enabled === FALSE)
		{
			return FALSE;
		}
	
		$level = strtoupper($level);
		
		if ( ! isset($this->_levels[$level]) OR ($this->_levels[$level] > $this->_threshold))
		{
			return FALSE;
		}
	
		/**
		 * 修改日志记录，添加high级别的记录
		 *
		 * @author edit by Cyning <haohailuo@163.com> at Thu Feb 17 11:57:10 CST 2011
		*/
		if ('HIGH' == $level) {
			$filepath = $this->log_path.'log_high-'.date('Y-m-d').EXT;
		}elseif ($php_error) {
			$filepath = $this->log_path.'log_php-'.date('Y-m-d').EXT;
		}else {
			$filepath = $this->log_path.'log-'.date('Y-m-d').EXT;
		}
		//edit end
		//$filepath = $this->log_path.'log-'.date('Y-m-d').EXT;
		$message  = '';
		
		if ( ! file_exists($filepath))
		{
			$message .= "<"."?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?".">\n\n";
		}
			
		if ( ! $fp = @fopen($filepath, FOPEN_WRITE_CREATE))
		{
			return FALSE;
		}

		$message .= $this->_get_ip() . ' - ' . $level.' '.(($level == 'INFO') ? ' -' : '-').' '.date($this->_date_fmt). ' - '. $_SERVER['REQUEST_URI'] . ' - ' . $msg . "\n";
		
		flock($fp, LOCK_EX);	
		fwrite($fp, $message);
		flock($fp, LOCK_UN);
		fclose($fp);
	
		@chmod($filepath, FILE_WRITE_MODE); 		
		return TRUE;
	}

	/**
	 * 获取IP地址
	 */
	private function _get_ip(){
		$ip_address = false;
		if (!empty($_SERVER['REMOTE_ADDR']) && !empty($_SERVER['HTTP_CLIENT_IP'])) {
			 $ip_address = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['REMOTE_ADDR'])) {
			 $ip_address = $_SERVER['REMOTE_ADDR'];
		} elseif (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			 $ip_address = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			 $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}

		if ($ip_address === FALSE) {
			$ip_address = '0.0.0.0';
			return $ip_address;
		}

		if (strstr($ip_address, ',')) {
			$x = explode(',', $ip_address);
			$ip_address = end($x);
		}

		if ( ! $this->_valid_ip($ip_address)) {
			$ip_address = '0.0.0.0';
		}
		
		return $ip_address;
	}
	
	/**
	 * 验证IP地址的有效性
	 *
	 * @param unknown_type $ip
	 * @return unknown
	 */
	private function _valid_ip($ip) {
		$ip_segments = explode('.', $ip);

		// Always 4 segments needed
		if (count($ip_segments) != 4) {
			return FALSE;
		}
		// IP can not start with 0
		if (substr($ip_segments[0], 0, 1) == '0') {
			return FALSE;
		}
		// Check each segment
		foreach ($ip_segments as $segment) {
			// IP segments must be digits and can not be longer than 3 digits or greater then 255
			if (preg_match("/[^0-9]/", $segment) || $segment > 255 || strlen($segment) > 3)	{
				return FALSE;
			}
		}

		return TRUE;
	}
}
// END Log Class

/* End of file Log.php */
/* Location: ./system/libraries/Log.php */