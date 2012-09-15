<?php



require_once('init.php');
require_once('db_connect.php');


$homebodycontent="";

if (isset($_POST['scheduleElection'])){

	$dte =  $_POST['year'] . '-' . $_POST['mon'] . '-' . $_POST['day'];
	
	$rdte =  $_POST['ryear'] . '-' . $_POST['rmon'] . '-' . $_POST['rday'];
	
	$res =mysql_query('select id from candidates where region=\'' . $_POST['region'] . '\'');
	
//	$homebodycontent .= 'select id from candidates where region=\'' . $_POST['region'] . '\'';

	$cand='';
	while($row=mysql_fetch_assoc($res)){
	$cand .=$row['id'] . ',' ;
	$homebodycontent .= $row['id'] . ',';
	}
	
	

	$res=mysql_query(' insert into election values(\'\',\''.$_POST['region'] . '\',\'' .$cand . '\',\'' . $dte . '\',' .$_POST['noofdays'] . ',\'' .   $rdte . '\')');

//	$homebodycontent .= '<br/> insert into election values(\'\',\''.$_POST['region'] . '\',\'' .$cand . '\',\'' . $dte . '\',' .$_POST['noofdays'] . ')';
	
	if ($res==null){
		$homebodycontent .= 'Election Not Schedlued' . mysql_error();
	}
	else{
		$homebodycontent .= 'Election Schedlued';
	}
	

require_once('index.php');

return;
}

if(isset($_GET['region'])){


	$res=mysql_query('select name from candidates where region=\'' .  $_GET['region'] . '\'');
	
	echo 'test';
	
	return;

}

echo '

	<form action="election.php" method="POST" >
	Election Region: 
		
	<select name="region" id="region">';

	$res=mysql_query("select nme from region",$con);
	
	if ($res!=null){
	
	while ($row=mysql_fetch_assoc($res)){
		echo '<option>' . $row['nme'] . '</option>';
	}

	}
	else{
		echo 'faile';
	}

	echo '	</select>


	<br/><br/>
	Election Date: 
	<input type="textbox" size="2" name="day" /> - <input type="textbox" size="2" name="mon" /> - <input type="textbox" size="4" name="year" />
	<br/><br/>

	No of Election Days: 
	<input type="textbox" size="2" name="noofdays" />
	<br/><br/>
	
	Election Results Date: 
	<input type="textbox" size="2" name="rday" /> - <input type="textbox" size="2" name="rmon" /> - <input type="textbox" size="4" name="ryear" />
	<br/><br/>
	

	<input type="submit" value="Schedule Election" name="scheduleElection" >
	
	</form>
	

	';


?>
