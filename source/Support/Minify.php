<?php
var_dump(2);die;
/**
 * JS 
 */
$minJS = new \MatthiasMullie\Minify\JS();
$minJS->add(dirname(__DIR__, 1) . "/views/SocialAuth/Auth/assets/js/jquery.js");
$minJS->add(dirname(__DIR__, 1) . "/views/SocialAuth/Authassets/js/jquery-ui.js");
$minJS->minify(dirname(__DIR__, 1) . "/views/SocialAuth/Auth/assets/scripts.min.js");