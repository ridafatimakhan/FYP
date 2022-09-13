<?php 
/*
* Stop execution if someone tried to get file directly.
*/
// if ( !defined( 'ABSPATH' ) ) exit;

						//======================================================================//
								// GLobal Function //
						//======================================================================//

function ml_update_option($op_key = null, $op_value = null){
	$con = new ML_CONNECTION();
	$con = $con->connection_db();

	$op_query = "SELECT option_key FROM global_options WHERE option_key = '$op_key'";
	$result = $con->query($op_query);
	if($result->num_rows == 0){
		$in_query = "INSERT INTO global_options (option_key, option_value) VALUES ('$op_key' ,'$op_value')";
	}else{
		$in_query = "UPDATE global_options SET option_key='$op_key', option_value='$op_value'";
	}
	$result = $con->query($in_query);

	if(empty($con->error)){
		return true;
	}else{
		return false;
	}
	
}

function ml_delete_option($op_key = null, $op_value = null){
	$con = new ML_CONNECTION();
	$con = $con->connection_db();

	$del_query = "DELETE FROM global_options WHERE option_key = '$op_key' AND option_value ='$op_value'";
	$del_query = $con->query($del_query);
	//echo "<pre>"; print_r($del_query);exit();

	if ($con->query($del_query) === TRUE) {
    	return true;
	} else {
	  return false;
	}
	
}

function ml_get_option($op_key = null){
	$con = new ML_CONNECTION();
	$con = $con->connection_db();

	$get_query = "SELECT option_value FROM global_options WHERE option_key = '$op_key'";
	$result = $con->query($get_query);

	$result = $result->fetch_assoc();
	return $result['option_value'];
}



function ml_current_url(){
	return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
}

function ml_get_user_data($user_id = null){
	$con = new ML_CONNECTION();
	$con = $con->connection_db();

	$uVar = $_SESSION['userid'];
	$get_query = "SELECT * FROM users WHERE user_id = '$user_id'";
	$result = $con->query($get_query);
	return $result->fetch_assoc();
	 // echo '<pre>'; print_r($result); exit;
}


// Break line function
function autop($pee, $br = true) {
  $pre_tags = array();

	if ( trim($pee) === '' )
		return '';

	$pee = $pee . "\n"; // just to make things a little easier, pad the end

	if ( strpos($pee, '<pre') !== false ) {
		$pee_parts = explode( '</pre>', $pee );
		$last_pee = array_pop($pee_parts);
		$pee = '';
		$i = 0;

		foreach ( $pee_parts as $pee_part ) {
			$start = strpos($pee_part, '<pre');

			// Malformed html?
			if ( $start === false ) {
				$pee .= $pee_part;
				continue;
			}

			$name = "<pre wp-pre-tag-$i></pre>";
			$pre_tags[$name] = substr( $pee_part, $start ) . '</pre>';

			$pee .= substr( $pee_part, 0, $start ) . $name;
			$i++;
		}

		$pee .= $last_pee;
	}

	$pee = preg_replace('|<br />\s*<br />|', "\n\n", $pee);
	// Space things out a little
	$allblocks = '(?:table|thead|tfoot|caption|col|colgroup|tbody|tr|td|th|div|dl|dd|dt|ul|ol|li|pre|select|option|form|map|area|blockquote|address|math|style|p|h[1-6]|hr|fieldset|noscript|samp|legend|section|article|aside|hgroup|header|footer|nav|figure|figcaption|details|menu|summary)';
	$pee = preg_replace('!(<' . $allblocks . '[^>]*>)!', "\n$1", $pee);
	$pee = preg_replace('!(</' . $allblocks . '>)!', "$1\n\n", $pee);
	$pee = str_replace(array("\r\n", "\r"), "\n", $pee); // cross-platform newlines
	if ( strpos($pee, '<object') !== false ) {
		$pee = preg_replace('|\s*<param([^>]*)>\s*|', "<param$1>", $pee); // no pee inside object/embed
		$pee = preg_replace('|\s*</embed>\s*|', '</embed>', $pee);
	}
	$pee = preg_replace("/\n\n+/", "\n\n", $pee); // take care of duplicates
	// make paragraphs, including one at the end
	$pees = preg_split('/\n\s*\n/', $pee, -1, PREG_SPLIT_NO_EMPTY);
	$pee = '';
	foreach ( $pees as $tinkle )
		$pee .= '<p>' . trim($tinkle, "\n") . "</p>\n";
	$pee = preg_replace('|<p>\s*</p>|', '', $pee); // under certain strange conditions it could create a P of entirely whitespace
	$pee = preg_replace('!<p>([^<]+)</(div|address|form)>!', "<p>$1</p></$2>", $pee);
	$pee = preg_replace('!<p>\s*(</?' . $allblocks . '[^>]*>)\s*</p>!', "$1", $pee); // don't pee all over a tag
	$pee = preg_replace("|<p>(<li.+?)</p>|", "$1", $pee); // problem with nested lists
	$pee = preg_replace('|<p><blockquote([^>]*)>|i', "<blockquote$1><p>", $pee);
	$pee = str_replace('</blockquote></p>', '</p></blockquote>', $pee);
	$pee = preg_replace('!<p>\s*(</?' . $allblocks . '[^>]*>)!', "$1", $pee);
	$pee = preg_replace('!(</?' . $allblocks . '[^>]*>)\s*</p>!', "$1", $pee);
	if ( $br ) {
		$pee = preg_replace_callback('/<(script|style).*?<\/\\1>/s', create_function('$matches', 'return str_replace("\n", "<PreserveNewline />", $matches[0]);'), $pee);
		$pee = preg_replace('|(?<!<br />)\s*\n|', "<br />\n", $pee); // optionally make line breaks
		$pee = str_replace('<PreserveNewline />', "\n", $pee);
	}
	$pee = preg_replace('!(</?' . $allblocks . '[^>]*>)\s*<br />!', "$1", $pee);
	$pee = preg_replace('!<br />(\s*</?(?:p|li|div|dl|dd|dt|th|pre|td|ul|ol)[^>]*>)!', '$1', $pee);
	$pee = preg_replace( "|\n</p>$|", '</p>', $pee );

	if ( !empty($pre_tags) )
		$pee = str_replace(array_keys($pre_tags), array_values($pre_tags), $pee);

	return $pee;
}