<?php 
/*
* Stop execution if someone tried to get file directly.
*/
if ( !defined( 'ABSPATH' ) ) exit;

						//======================================================================//
								// Class to close the connection with Database //
						//======================================================================//
class ML_CONNECTION_CLOSE {
	var $server = 'localhost';
	var $db_name = 'muallim_db';
	var $db_username = 'root';
	var $db_password = null;

	/*
	* Initate objects and variables
	*/
	function __construct(){
		$this->connection_close_db();
	}

	function connection_close_db(){
		$con = new mysqli($this->server, $this->db_username, $this->db_password, $this->db_name);
		// echo 'connect close';
		$con->close();
	}

}/* ML_CONNECTION_CLOSE Class Ends Here */
$ML_CONNECTION_CLOSE = new ML_CONNECTION_CLOSE();