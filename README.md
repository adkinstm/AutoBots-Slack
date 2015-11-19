# AutoBots
AutoBots is a two-way Slack Webhook Bot that allows your server to communicate with Slack in a PHP environment, and recognize keywords to trigger programmable tasks.  Limited functionality is built in, but if you know PHP you can extend it in just about any way you can imagine.  This implementation is object-oriented.  Be familiar with object-oriented programming before working with this implementation.

![Bulletins Status](https://img.shields.io/badge/Status-In%20Progress-0A96B5.svg)
![Bulletins Version](https://img.shields.io/badge/Current%20Version-v0.1.1-043A47.svg)

##Configuration
The configuration files are located in /inc/config.php as well as /inc/db/connect.php if you would like to enable a MySQL database connection in your implementation.  To ensure privacy and security of your API credentials, you should only run this program on an SSL encrpyted web server over HTTPS.

####Required Setup In /inc/config.php
At https://yourslackdomain.slack.com/services create both an Incoming Webhook and an Outgoing Webhook.  Add the generated credentials to the appropriate variables.
```php
/****   CONFIGURATION FILE  ****/
$_SLACK_INCOMING_URL = "Replace with your incoming webhook URL";
$_SLACK_OUTGOING_TOKEN = "Replace with your outgoing webhook verification token";
```

####Optional Database Integration Setup /inc/db/connect.php
Simply add your MySQL credentials in the appropriate fields and change $enableDB to `true`.
```php
/****   Optional MySQL Database Configuration    ****/

//Change to `true` if you want to use a database in your integration.
$enableDB = false;

//MySQL Database Credentials
$servername = "SERVER URL";
$username = "MYSQL USERNAME";
$password = "MYSQL PASSWORD";
$database = "MYSQL DATABASE";
```

####Custom Bot Avatar
To use a custom profile image for your bot integration, add a square JPEG, PNG, or GIF image to `/static/custom-avatar/`.  The first file in the directory will be used as the Bot's avatar, so no reason to put multiple images in here.

## License
The MIT License (MIT)

Copyright (c) 2015 Mark Adkins

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
