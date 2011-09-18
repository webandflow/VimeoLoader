<?php
require_once('core/components/vimeo/class.vimeoloader.php');
$output = '';

$vid = (isset($vid)) ? $vid : '';

$vim = new VimeoLoader($modx);
$output = $vim->getFeaturedVideo($vid);

return $output;

?>