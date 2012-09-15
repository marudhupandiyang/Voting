<?php

require_once('init.php');

require_once('db_connect.php');

$homebodycontent="";

if(isset($_POST['pictureupload'])){

//	print_r($_FILES);
	
	if(	copy($_FILES['votepic']['tmp_name'],'img/' . $_POST['id'] . '.jpg')){
	
//	echo 'done';

	if (mysql_query('update candidates set  pic=\'/' .'img/' . $_POST['id'] . '.jpg'  . '\' where id=' .  $_POST['id'] ,$con)){
	
			$homebodycontent.= "<br/>Candidate Sucessfully Registered.<br/>" . "The ID for current Candidate is: " . $_POST['id'];
		}
	
	}

	require_once('index.php');
	return;
}


if (isset($_GET['registerCandidate'])){


$homebodycontent.= '
Name: ' .	$_GET['candidateName']

. '
<br/>

DOB: ' . $_GET['day'] . ' - ' . $_GET['mon'] . ' - ' . $_GET['year']

. '<br/>

Region: ' . $_GET['region']

. '
<br/>
Post: ' . $_GET['candidatepost'] 

. '
<br/>
Documents Submited: '; 

$docs="";

 foreach ( $_GET['Docssubmitted'] as $selectedOption)	 $docs.=$selectedOption;
 
// echo $docs;




//echo $query;
$query='insert into candidates values(\'\',\''. $_GET['candidateName']  .'\',\''. $_GET['year'] . '-' . $_GET['mon'] . '-' . $_GET['day'] .'\',\''.  $_GET['region'] .'\',\''.$_GET['candidatepost']  .'\',\'' . $docs . '\',\'\',now(),\'1\')';

	if (mysql_query($query,$con)){
		
		
		
		$res=mysql_query('select max(id) from candidates;',$con);
		if ($r=mysql_fetch_array($res)){
		
		
		$homebodycontent.= '
			<br/><br/>
			
			<form method="POST" action="" enctype="multipart/form-data">
			<input type="hidden" value="' . $r[0] . '" name="id">
			Choose the Image for this candidate: <br/>	<input type="file" name="votepic">
			<br/><input type="submit" value="Upload" name="pictureupload">
			</form>

		';
		}



	require_once('index.php');
	
	}
	
	else{
	$homebodycontent.= 'Retry again..! Some error Occured' . mysql_error();
	
	require_once('index.php');
	}
}

else
{


$form='


	<form method="GET" action="register_candidate.php">
	
	<table>
	<tr>
	<td>Name</td>	<td> <input type="textbox" size="35" name="candidateName"></td>
	
	</tr>	<tr>
		
	<td>DOB</td>	<td> <input type="textbox" size="2" name="day">-<input type="textbox" size="2" name="mon">-<input type="textbox" size="4" name="year"></td>
	
	</tr>	<tr>
			
	<td>Region</td>	<td>
	
	<select name="region">';

	$res=mysql_query("select nme from region",$con);
	if ($res!=null){
	
	while ($row=mysql_fetch_assoc($res)){
		$form .='<option>' . $row['nme'] . '</option>';
	}

	}
	else{
		$form .='faile';
	}

$form .='	</select>
	</td>
	
	</tr>	<tr>	
	
	<td>Post</td>	
	
	<td>
	<select name="candidatepost">
	<option>MLA</option>
	<option>MP</option>
	</select>
		
	</td>
	
	</tr>	<tr>	
	
	
	<td>Documents Submited</td>	<td>
	
	<select multiple name="Docssubmitted[]">
	<option>Property</option>
	<option>Certificate</option>
	</select>
	
	</td>
	
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
}
?>
