<?php

    /****   MAIN INDEX FILE (In General Customization Should Not Take Place In This File)    ****/
    include_once "inc/config.php";

    //TAD Bot Listener
    $responseDelay = 1; //Response delay in seconds
    $outgoingToken = $_SLACK_INCOMING_URL;
    $incomingURL = $_SLACK_INCOMING_URL;
					
$names = array (
                    "tadbot",
                    "tad",
                    "tad bot",
                    "tadmin",
                    "tadie",
                    "bot"
                );
						
$attention_getters = array (
							"whats up",
							"you there",
							"you still there",
							"hello",
							"hi",
							"hey",
							"yo "
						  );
						
$thanks = array (
                    "thanks",
                    "thank you"
                );

// Sytntax for array(array(%keyword%, %keywork%, function_name_to_call)
$brain = array (
                    array("when", "payday", "getPayday"), //send next paydate
                    array("when", "timecard", "getPayday") //send next paydate
                );
						

$channelName = null;
$userName = null;


if ($_POST['token']==$outgoingToken)
{
	$channelName = $_POST['channel_name'];
	$userName = $_POST['user_name'];
	$msgText = strtolower(str_replace("'", "", $_POST['text']));
    
	if (contains($msgText, $names))
	{
		if (contains($msgText, $attention_getters))
		{
			sendMessage(response_greetings(), $bots[0], $channelName, $incomingURL);
		}
		elseif (contains($msgText, $thanks))
		{
			sendMessage(response_acknowledgements(), $bots[0], $channelName, $incomingURL);
		}
        else
        {
            $matchFound = false;
            for ($i = 0; $i < count($brain); $i++)
            {
                if(containsWord($msgText, $brain[$i][0]) && containsWord($msgText, $brain[$i][1]))
                {
                    sendMessage(call_user_func($brain[$i][2]), $bots[0], $channelName, $incomingURL);
                    $matchFound = true;
                    break;
                }
            }
            
            if(!$matchFound)
            {
                sendMessage($response_wat, $bots[0], $channelName, $incomingURL);
            }
        }
	}
}

function contains($str, array $arr)
{
    foreach($arr as $a) {
        if (stripos($str,$a) !== false) return true;
    }
    return false;
}

function containsWord($str, $word)
{
        if (stripos($str,$word) !== false) return true;
    
    return false;
}

function sendMessage($message, array $bot, $channel, $destinationURL)
{
	sleep($responseDelay);
	$fields = array(
							'payload' => urlencode('{"text": "' . $message . '", "channel": "#' . $channel . '", "username": "' . $bot[0] . '", "icon_url": "' . $bot[1] . '"}')
					);

	//url-ify the data for the POST
	foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
	rtrim($fields_string, '&');

	//open connection
	$ch = curl_init();

	//set the url, number of POST vars, POST data
	curl_setopt($ch,CURLOPT_URL, $destinationURL);
	curl_setopt($ch,CURLOPT_POST, count($fields));
	curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

	//execute post
	$result = curl_exec($ch);

	//close connection
	curl_close($ch);
}

function getPayday()
{
    
    $scraperURL = 'http://www.jmu.edu/financeoffice/accounting-operations-disbursements/payroll/index.shtml';
    $content = file_get_contents($scraperURL);
    $first_step = explode( '<a href="https://mymadison.jmu.edu/psp/pprd/?cmd=login&languageCd=ENG">' , $content );
    $payday = str_replace(PHP_EOL, '', explode("</a>" , $first_step[1] ));

    return response_payday() . trim($payday[0]);
}