<?php
    
    /****   INCLUDE DEPENDANCIES - DO NOT EDIT    ****/
    include "timestamp.php";
    include "functions.php";
    include "bots";
    include "response_builder.php";

    /****   CONFIGURATION FILE - You should edit this one  ****/
    $_SLACK_INCOMING_URL = "From Incoming Webhook Integration"; //URL To Send Messages To Slack
    $_SLACK_OUTGOING_TOKEN = "From Outgoing Webhook Integration"; //Token To Verify Messages Are From Slack