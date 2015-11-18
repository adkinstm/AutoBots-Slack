<?php

    /****   Optional MySQL Database Configuration    ****/

    //Change to `true` if you want to use a database in your integration.
    $enableDB = false;

    //MySQL Database Credentials
    $servername = "";
    $username = "";
    $password = "";
    $database = "";

    //You don't need to modify anything else in this file.

    // Create connection
    if($enableDB)
    {
        $conn = new mysqli($servername, $username, $password, $database);
    }