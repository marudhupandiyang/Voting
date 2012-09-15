<?php

require_once('init.php');
require_once('db_connect.php');


$res=mysql_query('select * from candidates',$con) or die('error in query');


echo "
<style>


.candidate{
margin-top:5px;
border-top: 1px solid white-smoke;
height:120px;
padding:3px;

/*	background-color:#e9eacb;		*/

}


.candidate:hover{
border:1px solid #333333;
cursor:pointer;
}

.candidate_pic{

float:right;
width:100px;
height:110px;
border:3px solid #333333;
}

.eachcandidate{
font-size:14px;

}

</style>

";

while ($r=mysql_fetch_array($res)){

	echo '
	
		<div class="candidate">

		<div class="candidate_pic">
		<img src="' . $r[6] . '" width=100% height=100%>
		</div>


		<div class="candidate_details">';
		
				
		if (isset($_SESSION['uname'])){
		echo '<div class="deletecandidate  rfloat"><a href="delete.php?candidate=' . $r[0] . '">Delete</a></div>';
		}

echo '		<table class="eachcandidate">
		
		<tr><td class="ralign">Candidate:</td><td class="lalign">' . $r[1] . ' </td></tr>
		<tr><td class="ralign">DOB:</td><td class="lalign">' . $r[2] . '  </td></tr>
		<tr><td class="ralign">Region:</td><td class="lalign">' . $r[3] . '  </td></tr>
		<tr><td class="ralign">Post:</td><td class="lalign">' . $r[4] . '  </td></tr>
		<tr><td class="ralign">Docs:</td><td class="lalign">' . $r[5] . '  </td></tr>
		</table>		
		</div>
		</div>
	
	';
}

?>
