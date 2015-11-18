<?php

    /**
     * Bots Class
     *
     * Version: 1.0 - 11/17/2015
     * Author: Mark Adkins - @realmarkadkins - https://repo.bymark.co/
     */
     class Bots {
         
        function __construct() {
            $directory = "../static/custom-avatar/";
            $bot_avatar = "/static/img/default_icon.png";
            if(!is_empty_dir($directory))
            {
                $first_file = get_first_file($directory);
                if(is_acceptable_image_file($first_file))
                {
                    $bot_avatar = "/static/custom-avatar/" . basename($first_file);
                }
            }
       }
         
        $bots = array (
					array ("autobot", "https://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] . "/static/img/default_icon.png";),
					array ("slackbot", "")
                );
         
     }//Bots