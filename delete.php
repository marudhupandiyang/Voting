<?php


require_once('init.php');

require_once('db_connect.php');


if (!isset($_SESSION['uname'])){
header('location:/');
return;
}

$homebodycontent="";

if (isset($_GET['voter'])){

	$res=mysql_query('delete from voters where id=' . $_GET['voter']);
	
if ($res!=null){
	$homebodycontent .= "Voter Deleted";
}
else{
	$homebodycontent .= "Error in Operation";
}



require_once('index.php');
return;
}

if (isset($_GET['candidate'])){

	$res=mysql_query('delete from candidates where id=' . $_GET['candidate']);

	
if ($res!=null){
	unlink('/var/www/html/voting/img/' . $_GET['candidate']. '.jpg');
	
	$homebodycontent .= "candidate Deleted";
}
else{
	$homebodycontent .= "Error in Operation" . mysql_error();
}



require_once('index.php');
return;
}

?>
