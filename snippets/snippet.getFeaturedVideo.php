<?php
/*
    snippet.getFeaturedVideo.php
    =-=-=-=-=-=-=-=-=-=-=-=-=-=-
    A Snippet used to grab a video which serves as a featured video on a page
    Videos can be shown as a standalone video or in conjunction with the 
    full collection of Vimeo videos.
*/

require_once('core/components/vimeo/classes/class.vimeoloader.php');

// Register the default CSS and jQuery files
$modx->regClientCSS('core/components/vimeo/css/vimeoloader.css');
$modx->regClientScript('core/components/vimeo/js/jquery.vimeoloader.js');

$output = '';
$vid = (isset($vid)) ? $vid : '';

$vim = new VimeoLoader($modx);
$output = $vim->getFeaturedVideo($vid);

return $output;
?>