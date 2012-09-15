<?php

require_once('init.php');

$con=mysql_connect('localhost','root','root') or die ('Error in Mysql <br/><br/>' . mysql_error());

$db=mysql_selectdb('voting');

?>
