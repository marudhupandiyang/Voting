<?php

require_once('init.php');

unset($_SESSION['uname']);
session_destroy();



echo '
<head>

<META HTTP-EQUIV="REFRESH" CONTENT="3;URL=index.php">

</head>

<br/><br/>

Please wait while we log you out..!
';

?>
