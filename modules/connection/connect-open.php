<?php 
/*
* Stop execution if someone tried to get file directly.
*/
// if ( !defined( 'ABSPATH' ) ) exit;

						//======================================================================//
								// Class to create the connection with Database //
						//======================================================================//
session_start();
class ML_CONNECTION {
	var $server = 'localhost';
	var $db_name = 'muallim_db';
	var $db_username = 'root';
	var $db_password = null;

	/*
	* Initate objects and variables
	*/
	function __construct(){
		$this->connection_db();
	}

	function connection_db(){
		$con = new mysqli($this->server, $this->db_username, $this->db_password, $this->db_name);
		// echo 'connect open';
		if(!empty($con->connect_error)){
			echo 'connection failed'; 
			die();
		}
		return $con;
	}

}/* ML_CONNECTION Class Ends Here */
$ML_CONNECTION = new ML_CONNECTION();