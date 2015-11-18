<?php
date_default_timezone_set('America/New_York');

function timestamp() {
    return date("Y-m-d H:i:s");
}

function datetimestamp() {
    return date("m/d/Y H:i:s") . " - ";
}