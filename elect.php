<?php

require_once('init.php');

if (isset($_GET['error'])){


	if ($_GET['error']==1){
	
		$homebodycontent ='<center><font color=red>Error during Voting.Try Again</font></center>';
		include_once('index.php');	
		return;
	}

}


require_once('db_connect.php');


$homebodycontent = "";
if (isset($_GET['elected'])){

$homebodycontent .='<center><font size="30px" color=red>Thanks for <br/><br/>Voting</font></center>';

include_once('index.php');

return;
}

if (isset($_POST['cand'])){


		$res=mysql_query('select * from election where dte between curdate() and  curdate() + INTERVAL (noofdays - 1) DAY and id=' . $_POST['id']);
		
	
		if ($res==null || mysql_num_rows($res)==0){

		echo '/';
		
		return;
		
		}


		
		if ($row=mysql_fetch_assoc($res)){
					
			$res=mysql_query('insert into results values(' .$_POST['id'] . ',curdate(),' . $_POST['cand'] . ',1)');
			
			if ($res==null || mysql_affected_rows($res)==0){
			$res=mysql_query('update results set votes=votes + 1 where electid= ' .$_POST['id'] . ' and electdate=curdate() and candidate=' . $_POST['cand']);
				
			if ($res==null){
				echo '/elect.php?error=11';
				return;
			}
			
			}
			
			echo '/elect.php?elected=' . 'update results set votes=votes + 1 where electid= ' .$_POST['id'] . ' and electdate=curdate() and candidate=' . $row['id'];
			return;

		}



return;
}






$homebodycontent .= '



<script type="text/javascript">




function ajax_get(query , divname){


		
	if (window.ActiveXObject){
		var xhttp=new ActiveXObject("Microsoft.XMLHttp");
	}
	else{
		var xhttp= new XMLHttpRequest();
	}
	
	xhttp.open("get","/" + query,true);
	
	xhttp.send(null);
	
	xhttp.onreadystatechange= function (){	if (xhttp.readyState==4 ){
	
		if (xhttp.status==200 || xhttp.status==0){
			document.getElementById(divname).innerHTML=xhttp.responseText;

		}
		else{
			document.getElementById(divname).innerHTML="Error Occured..Try again..";				
		}
	}
	
	};
}


function ajax_post(post,query , divname,func){


		
	if (window.ActiveXObject){
		var xhttp=new ActiveXObject("Microsoft.XMLHttp");
	}
	else{
		var xhttp= new XMLHttpRequest();
	}
	
	xhttp.open("post",post,true);
	
	xhttp.setRequestHeader("content-type","application/x-www-form-urlencoded");
	
	xhttp.send(query);
	
	xhttp.onreadystatechange= function (){	if (xhttp.readyState==4 ){
	
		if (xhttp.status==200 || xhttp.status==0){
			document.getElementById(divname).innerHTML=xhttp.responseText;

			func();
		}
		else{
			document.getElementById(divname).innerHTML="Error Occured..Try again..";				
		}
	}
	
	};
}

</script>
';


if (isset($_GET['id'])){



	$homebodycontent .= '
	<style>
	.elecionTitle{
		font-size:30px;
		color:maroon;
		text-align:center;
		margin-top:50px;
	}
	
	.bodycontent{
		
		width:80%;
		margin:50px auto;
	}
	
	.Votefor{
		margin:20px;
		border:solid 1px white;
	}
	
	.Votefor:hover{
		border:solid 1px #333333;
	}

	</style>
	';


$homebodycontent .= "
<style>


.candidate{
margin-top:20px;
border-top: 1px solid white-smoke;
height:120px;
padding:3px;

/*	background-color:#e9eacb;		*/

}


.candidate:hover{
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

.candidate_name{
	font-size:40px;
	height:50px;
	
}

.votenow_button{
	padding:5px;
	border: 1px solid #333333;
	color:maroon;
	background-color:inherit;
	-moz-border-radius:3px;
	font-weight:bold;
	font-size:20px;
}
.votenow_button:hover{

	background-color:#514AE9;
	color:white;
}
</style>

";
	

$homebodycontent .= '<div id="voteres" style="display:none;"></div>';	
	$homebodycontent .=  '<div class="elecionTitle">ELECT NOW</div>';
	
	$homebodycontent .=  '<div class="bodycontent">';
	
	$homebodycontent .=  '<div class="uid">Enter your UID: <input type="textbox" name="uid" size="10" id="uid"></div>';

	$res=mysql_query(' Select * from candidates where region=(select nme from region where id='. $_GET['id'] . ')');
	

while ($r=mysql_fetch_array($res)){

	$homebodycontent.= '
	
		<div class="candidate" ">

		<div class="candidate_pic">
		<img src="' . $r[6] . '" width=100% height=100%>
		</div>


		<div class="candidate_name">';
	
			$homebodycontent .=   $r[1] .'
		</div>
		
		<input type="button" value="votenow" name="" onclick="javascript:votenow(this)"" class="votenow_button">
		<input type="hidden" value="' .$r[0] . '" id="candidate_id">
		</div>
	
	';
}


$homebodycontent .= '

<script type="text/javascript">




	function votenow(obj){

	if (!isUID()){
		alert("Enter your UID");
	return;
	}
	
	var a=obj.parentNode;
//	alert(a.childNodes[7].value);
	
	ajax_post("/elect.php","cand=" + a.childNodes[7].value + "&id=' . $_GET['id'] . '&uid=" + document.getElementById("uid").value ,"voteres",replacebody);
	
	}
	
	function isUID(){
	
	if (document.getElementById("uid").value !=""){
		return true;
	}
	else{
	return false;
	}
	
	}
	
	function replacebody(){
	window.location=document.getElementById("voteres").innerHTML;

		
	
	}
	
</script>

';
	
	$homebodycontent .='</div>';
}


else{

		$res=mysql_query('select * from election where  dte between curdate() and  curdate() + INTERVAL (noofdays - 1) DAY');
		
		if ($res==null || mysql_num_rows($res)==0){
		
		return;
		}
		
		echo '
		
		<style>
		
			.election_details{
				min-height:40px;
				font-style:italic;
				color:maroon;
			}
			
		</style>
			';
		
		echo '<br/>Current Elections<br/><br/>';
		while ($row=mysql_fetch_assoc($res)){
		
		
		
		echo  '<div class="election_details">';
		
		echo  'Region:<b>' . $row['region'] .'</b>';
		
		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="elect.php?id=' . $row['id'] . '">Elect Now</a>';
		
		echo '</div>';
		
		}
		
		

return;
}

include_once('index.php');
?>
