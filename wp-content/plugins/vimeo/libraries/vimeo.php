<?php

class vimeo
{
	//Fetch the json data using curl
	function get_data($url) {
		$ch = curl_init();
		$timeout = 5;
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}
	
	//Convert seconds to normal time
	function secondsToTime($seconds)
	{
		// extract hours
		$hours = floor($seconds / (60 * 60));
	 
		// extract minutes
		$divisor_for_minutes = $seconds % (60 * 60);
		$minutes = floor($divisor_for_minutes / 60);
	 
		// extract the remaining seconds
		$divisor_for_seconds = $divisor_for_minutes % 60;
		$seconds = ceil($divisor_for_seconds);
	 
		// return the final array
		$obj = array(
			"h" => (int) $hours,
			"m" => (int) $minutes,
			"s" => (int) $seconds,
		);
		$time = str_pad($obj["h"],2,'0',STR_PAD_LEFT).":". str_pad($obj["m"],2,'0',STR_PAD_LEFT) . ":". str_pad($obj["s"],2,'0',STR_PAD_LEFT);
		
		return $time;
	}
	
	//Get channel uploads
	function get_uploads($channel){
		//Vimeo api call
		$vim_videos = "http://vimeo.com/api/v2/".$channel."/videos.json";
		$videos = json_decode($this->get_data($vim_videos),true);
		return $videos;
	}
	//get the Id of a certail video
	function get_video_id($video){
		return $video['id'];
		
	}

	function get_video_thumbnail($video){
		return $video['thumbnail_large'];
		
	}

	function get_video_title($video){
		return $video['title'];
		
	}


	function get_author($user){
		return $user['display_name'];
		
	}	
	
	function get_summary($user_details){
		return $user_details['bio'];
	}
	
	//get all the playlists in a user channel
	function get_likes($channel){
		//Vimeo api call
		$vim_videos = "http://vimeo.com/api/v2/".$channel."/likes.json";
		$videos = json_decode($this->get_data($vim_videos),true);
		return $videos;
	}	
	
	function get_subscriptions($channel){
		//Vimeo api call
		$vim_videos = "http://vimeo.com/api/v2/".$channel."/subscriptions.json";
		$videos = json_decode($this->get_data($vim_videos),true);
		return $videos;
	}	
	
	function get_tagged($channel){
		//Vimeo api call
		$vim_videos = "http://vimeo.com/api/v2/".$channel."/appears_in.json";
		$videos = json_decode($this->get_data($vim_videos),true);
		return $videos;
	}	
	
	function get_albums($channel){
		//Vimeo api call
		$vim_videos = "http://vimeo.com/api/v2/".$channel."/albums.json";
		$videos = json_decode($this->get_data($vim_videos),true);
		return $videos;
	}	
	
	function get_channels($channel){
		//Vimeo api call
		$vim_videos = "http://vimeo.com/api/v2/".$channel."/channels.json";
		$videos = json_decode($this->get_data($vim_videos),true);
		return $videos;
	}	
	
	function get_groups($channel){
		//Vimeo api call
		$vim_videos = "http://vimeo.com/api/v2/".$channel."/groups.json";
		$videos = json_decode($this->get_data($vim_videos),true);
		return $videos;
	}	
	
	function get_user_details($profile){
		$vim_videos = "http://vimeo.com/api/v2/".$profile."/info.json";
		return json_decode($this->get_data($vim_videos),true);
	}
	
	function get_profile_image($user_details){
		return '<img src="'.$user_details['portrait_large'].'" />';
	}

}

?>