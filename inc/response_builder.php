<?php
/**
 * response_builder.php - Returnes responses for specific actions.  Responses are randomized, but pre-constructed.
 * Required by service.php
 *
 * @author - Mark Adkins | @realmarkadkins | mark@bymark.co
 * @version - 1.0
 */


function response_greetings()
{
    $responses = array (
							"What's up",
							"Yo",
							"Hello",
							"Hey",
							"Hi",
							"How's it going?"
					);
    return randomResponse($responses);
}

function response_payday()
{
    $responses = array (
                                "Looks like the next payday is ",
                                "Looks like",
                                "",
                                "Next payday for JMU staff is "
 
                        );
    return randomResponse($responses);
}

function response_acknowledgements()
{
    $responses = array (
                                "No problem",
                                "Yup yup",
                                "You got it",
                                "Sure thing",
                                "You're welcome",
                                "You bet"
 
                        );
    return randomResponse($responses);
}

function response_wat()
{
    $responses = array (
                                "What?",
                                "Uh, wat?",
                                "Come again?",
                                "Rephrase that please?",
                                "I dunno what that means...",
                                "Huh?",
                                "I don't know what to do with that"
 
                        );
    return randomResponse($responses);
}

// When authorization of a specified task is attempted but the task does not exist.
function response_task_not_exist($id)
{
	$responses = array (
							"Well, task " . $id . " doesn't exist... So there's that",
							"Double check that.  Task " . $id . " isn't a thing",
							"Hold on a sec... " . $id . " isn't actually a thing",
							"If task " . $id . " existed, you could totally do that",
							"Try that task ID again.  Doesn't look like " . $id . " exists"
					);
					
	return randomResponse($responses);
}

// When authorization of a specified task is attempted but the task has already been authorized.
function response_task_already_authorized($id, $authorized_by)
{
	$responses = array (
							"Task " . $id . " has already been authorized by " . $authorized_by,
							$authorized_by . " has already authorized that",
							"You're a little late to the party... " . $id . " was already authorized by " . $authorized_by,
							"If tasks could be authorized twice that would work, but " . $authorized_by . " beat you to it",
							"That was already authorized by " . $authorized_by
					);
					
	return randomResponse($responses);
}

// When authorization of a specified task is attempted but the task has already been authorized and executed.
function response_task_already_executed($id)
{
	$responses = array (
							"Task " . $id . " has already been executed",
							"Check that task ID again. Task " . $id . " has already been executed",
							"We already did that...",
							"You can't authorize something we already did",
							"We took care of that already.  No need to authorize it"
					);
					
	return randomResponse($responses);
}

// When authorization of a specified task is successfully queued
function response_task_queued($id, $description)
{
	$responses = array (
							"Task " . $id . " has been successfully queued - " . $description,
							"Will do. Standby.  Task ID is " . $id . " - " . $description
					);
					
	return randomResponse($responses);
}

// When a task queue attempt is made but there is no server specified
function response_no_server_specified()
{
	$responses = array (
							"You didn't specify which server",
							"Try that again with a server ID",
							"Uh, wat?"
					);
					
	return randomResponse($responses);
}


// Choose a random response from an array
function randomResponse(array $arr)
{
	$length = count($arr) - 1;
	return $arr[rand(0, $length)];
}