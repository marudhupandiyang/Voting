<?php

require_once('db_connect.php');

$homebodycontent="";



if (isset($_POST['createRegion'])){

$res=mysql_query('insert into region values(\'\',\''. $_POST['region'] .'\')');


if ($res!=null){


$homebodycontent .= $_POST['region'] . " Region Added";

}
else{

$homebodycontent .="Error in Region Registration";

}

require_once('index.php');
return;
}

else{

echo '

<center> Add a Region</center>

<form action="region.php" method="POST">

Region: <input type="textbox" name="region" >

<input type="submit" name="createRegion" Value="Add Region">
</form>
';

}

?>
