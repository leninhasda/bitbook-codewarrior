<?php 

if(!function_exists('get_user_id')) {
	function get_user_id() {
		return $this->session->userdata('user_id');
	}
}


if(!function_exists('humanTiming')) {
	function humanTiming ($time)
	{
		// $time = strtotime($time);
	    $time = time() - $time; // to get the time since that moment

	    $tokens = array (
	        31536000 => 'year',
	        2592000 => 'month',
	        604800 => 'week',
	        86400 => 'day',
	        3600 => 'hour',
	        60 => 'minute',
	        1 => 'second'
	    );

	    foreach ($tokens as $unit => $text) {
	        if ($time < $unit) continue;
	        $numberOfUnits = floor($time / $unit);
	        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
	    }
	}
}

if(!function_exists('is_my_friend')) {
	// function is_my_friend($uid, $fid) {
	// 	return User::is_friend($uid, $fid);
	// }
}