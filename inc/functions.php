<?php

/************************ Helper Functions ****************************/

function sendMessage($message, array $bot, $channel)
{

		global $incomingURL;
		
		//$message = "There was an attempt from " . $clientIP . ":" . $clientPort . " to access " . $hostname . " [" . $serverIP . "] on port " . $serverPort . ".";

        $fields = array(
                            'payload' => urlencode('{"text": "' . $message . '", "channel": "#' . $channel . '", "username": "' . $bot[0] . '", "icon_url": "' . $bot[1] . '"}')
        	            );

        //url-ify the data for the POST
        foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
        rtrim($fields_string, '&');

        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $incomingURL);
        curl_setopt($ch,CURLOPT_POST, count($fields));
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);

        //execute post
        $result = curl_exec($ch);
        
        //close connection
        curl_close($ch);
}//sendMessage

function parseExecutionTime($msgText)
{
	if(contains($msgText, "at"))
		{
		
			$time = str_replace("at ", "", substr($msgText, strpos($msgText, 'at')));
			$task_time = explode(' ',trim($time));
		}
		
		$today = new DateTime('today');
		$today = $today->format('Y-m-d');
		
		$tomorrow = new DateTime('tomorrow');
		$tomorrow = $tomorrow->format('Y-m-d');
		
		$dateFormat = DateTime::createFromFormat('Y-m-d H:i', $today . " " . $task_time[0]);
		
		if ($dateFormat !== false) {
			if (new DateTime() < $dateFormat) {
		   		$task_execution_time = new DateTime($today . " " . $task_time[0]);
		   		$task_execution_time = $task_execution_time->format('Y-m-d H:i:s');
			}else{
		   		$task_execution_time = new DateTime($tomorrow . " " . $task_time[0]);
		   		$task_execution_time = $task_execution_time->format('Y-m-d H:i:s');
			}
		}
		else{
		   $task_execution_time = "0000-00-00 00:00:00";
		}
		
		return $task_execution_time;
}//parseExecutionTime

function makeTimePrintable($task_execution_time)
{
	if ($task_execution_time == "0000-00-00 00:00:00"){
		$printable_time = "ASAP";
	}else{
		$printable_time = "at " . $task_execution_time;
	}
	
	return $printable_time;
}//makeTimePrintable

function createTasks($action, $task_execution_time)
{
	global $msgText;
	global $servers;
	global $userName;
	global $channelName;
	
	$printable_time = makeTimePrintable($task_execution_time);
	$total_tasks = 0;
	
	foreach ($servers as $server)
	{
		if(contains($msgText, $server[0])){
			$task_description = $server[0] . " will " . $action . " " . $printable_time;
			queueTask($channelName, $userName, $server[0], $action, $task_description, true, $task_execution_time);
			$total_tasks++;
		}
	}
	
	return $total_tasks;
}//createTasks

function createTasks($action, $task_execution_time)
{
	global $msgText;
	global $servers;
	global $userName;
	global $channelName;
	
	$printable_time = makeTimePrintable($task_execution_time);
	$total_tasks = 0;
	
	foreach ($servers as $server)
	{
		if(contains($msgText, $server[0])){
			$task_description = $server[0] . " will " . $action . " " . $printable_time;
			queueTask($channelName, $userName, $server[0], $action, $task_description, true, $task_execution_time);
			$total_tasks++;
		}
	}
	
	return $total_tasks;
}//createTasks

function respondIfNoServerSpecified($total_tasks_created)
{
	global $bots;
	global $channelName;
	
	if ($total_tasks_created == 0){
		sendMessage(response_no_server_specified(), $bots[2], $channelName);
	}
}//respondIfNoServerSpecified

function containsArray($str, array $arr)
{
    foreach($arr as $a) {
        if (stripos($str,$a) !== false) return true;
    }
    return false;
}//containsArray

function containsArrayID($str, array $arr)
{
    foreach($arr as $a) {
        if (stripos($str,$a[0]) !== false) return true;
    }
    return false;
}//containsArrayID

function contains($str, $word)
{
    if (stripos($str,$word) !== false){
    	return true;
    }else{
	    return false;
	}
}//contains

function is_empty_dir($dir) {
    if (!is_readable($dir)) return NULL; 
        $handle = opendir($dir);
        while (false !== ($entry = readdir($handle))) {
            if ($entry != "." && $entry != "..") {
                return FALSE;
            }
        }
    return TRUE;
}//is_empty_dir

function get_extension($file_path)
{
    $path = pathinfo($file_path);
    return $path['extension'];
}//get_extension

function get_first_file($dir) {
    $h = opendir($dir); //Open the directory
    while (false !== ($entry = readdir($h))) {
        if($entry != '.' && $entry != '..') { //Skips over . and ..
            return $entry; //Return the file
        }
    }
}//get_first_file

function is_acceptable_image_file($file_path)
{
    $ext = get_extension($result);
    if($ext == "png" || $ext == "jpg" || $ext == "jpeg" || $ext == "gif")
    {
        return true;
    }
    return false;
}//is_acceptable_image_file