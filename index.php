<?php
include('conf/config.php');
$tpl=new TemplatePower('templates/index.html');
$tpl->prepare();
 
$tpl->printToScreen();
?>