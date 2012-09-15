<?php

require_once('init.php');
require_once('db_connect.php');

$homebodycontent="";

if (isset($_POST['registerCandidate'])){


$dte=$_POST['year'] . '-' . $_POST['mon'] .'-' .$_POST['day'];

$res=mysql_query('insert into voters values (\'\',\''  . $_POST['voterName'] . '\',\'' . $dte . '\',\'' . $_POST['Region'] . '\')');

if ($res!=null){

$homebodycontent.= 'Voter ' . $_POST['voterName'] . ' Registered';

}
else{

$homebodycontent.= "Error required...!";
}




require_once('index.php');
return;
}

$form='


	<form method="POST" action="register_voter.php">
	
	<table>
	<tr>
	<td>Name</td>	<td> <input type="textbox" size="35" name="voterName"></td>
	
	</tr>	<tr>
		
	<td>DOB</td>	<td> <input type="textbox" size="2" name="day">-<input type="textbox" size="2" name="mon">-<input type="textbox" size="4" name="year"></td>
	
	</tr>	<tr>
			
	<td>Region</td>	<td>
	
	<select name="Region">';
	
	
	
	$res=mysql_query("select nme from region",$con);
	if ($res!=null){
	
	while ($row=mysql_fetch_assoc($res)){
		$form .='<option>' . $row['nme'] . '</option>';
	}

	}
	else{
		$form .='faile';
	}



$form.='	</td>
	
	</tr>
		
		<tr>
		
		<td colspan=2>
		<input type="submit" name="registerCandidate" value="Register">
		</td>
		</tr>
	</table>
	
	</form>


	';
	
	echo $form;

?>
