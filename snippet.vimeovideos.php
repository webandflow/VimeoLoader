<?php
/*
    getVimeoVideos
    =-=-=-=-=-=-=-
    Used to display the collection of vimeo videos for a given user

*/

require_once('core/components/vimeo/class.vimeoloader.php');
$modx->regClientScript('core/components/vimeo/jquery.vimeoloader.js');
$output = '';

$vid = (isset($featured)) ? $featured : '';

$vim = new VimeoLoader($modx);
$output = $vim->getAllVideos($vid);

return $output;

?>