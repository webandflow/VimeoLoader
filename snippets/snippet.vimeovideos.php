<?php
/*
    getVimeoVideos
    =-=-=-=-=-=-=-
    Used to display the collection of vimeo videos for a given user

*/

require_once('core/components/vimeo/classes/class.vimeoloader.php');

// Register the default CSS and jQuery files
$modx->regClientCSS('core/components/vimeo/css/vimeoloader.css');
$modx->regClientScript('core/components/vimeo/js/jquery.vimeoloader.js');
$output = '';


$vid = (isset($featured)) ? $featured : '';

$vim = new VimeoLoader($modx);
$output = $vim->getAllVideos($vid);

return $output;

?>