<?php
require_once('init.php');

header('cache-control: no-cache');

echo '

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

function loadpage(page){

switch(page)
{


	case 1:
		ajax_get("view_candidate.php","bodycontent");
		break;
	
	case 2:
		ajax_get("rules.php","bodycontent");
		break;

	case 3:
		ajax_get("dates.php","bodycontent");
		break;
	
	case 4:
		ajax_get("reachus.php","bodycontent");
		break;

	case 5:
		ajax_get("register_candidate.php","bodycontent");	
		break;
	case 6:
		ajax_get("register_voter.php","bodycontent");
		break;
		
	case 7:
		ajax_get("view_voter.php","bodycontent");
		break;
		
	case 8:
		ajax_get("region.php","bodycontent");
		break;

	case 9:
		ajax_get("election.php","bodycontent");
		break;
		
	default:
		alert("empty");
}


}

</script>

';

require_once('db_connect.php');

if (isset($_POST['Login'])){


	$_SESSION['uname']='';

	$query='select uname from users where uname=\'' . $_POST['uname'] . '\' and upass=\'' . md5($_POST['upass']) . '\'';
			

	$res=mysql_query($query) or die ('Try again');
	
	
	unset($_SESSION['uname']);
	
	if ($res==null){
		unset($_SESSION['uname']);
		header("location:/");
	}
	
	if ($row=mysql_fetch_assoc($res)){
		$_SESSION['uname']=$row['uname'];
	}
	else{
	unset($_SESSION['uname']);
	}

}



echo '

<link href="hand.ico" rel="shortcut icon" type="image/x-icon">

<title>Voting System</title>

<style>

	body{

	width:80%;
/*	border:1px solid black;	*/
	margin:5px auto;
	min-height:600px;
	display:block;
	font-size:12px;
	font-weight:bold;
	
/*	background-color:#bab7f9;	*/

	background-color:#c6c6eb; /* a5a5f8;	*/
	
	line-height:1.8em;
	letter-spacing:1.5;
	font-family:verdana, arial, sans-serif;
	}

	table{
	font-size:12px;	
	font-weight:bold;
	}
	
	input[type="textbox"],input[type="password"]{
	font-size:10px;
	color:maroon;
	border: 1px solid #333333;
	padding:2px;
	-moz-border-radius:3px;
	-webkit-border-radius:3px;	
	}
	
	input[type="textbox"]:focus,input[type="password"]:focus{
	background-color:#a5a5f8;
	color:white;
	border:1px solid white;
	}

	.ralign{
	text-align:right;
	}
	
	.lalign{
	text-align:left;
	}

	.banner{
	width:100%;
	min-height:50px;
	text-align:center;
	font-size:40px;
	margin-top:30px;
/*	background-color:whitesmoke;	*/
	color:Maroon;
	}

	a,a:hover,a:active,a:visited,a:link{
	text-decoration:none;
	color:inherit
	}
	
	.menu{
	font-size:14px;
	min-height:30px;
	margin-top:5px;
	margin-left:50px;
/*	background-color:grey;	*/
	}
	
	.menuelement{
	margin-left:5px;
	float:left;
	padding:5px;
	min-width:70px;
	border:1px solid #333333;
	text-align:center;
	-moz-border-radius:5px;
	-webkit-border-radius:5px;	
	-moz-box-shadow: inset 0px 0px 0px 3px whitesmoke;
	-webkit-box-shadow: inset 0px 0px 0px 3px whitesmoke;
	}
	
	.menuelement:hover{	
	background-color:#514ae9;
	color:white;
	border:1px solid white;
	-moz-box-shadow: inset 0px 0px 0px 3px whitesmoke;	
	-webkit-box-shadow: inset 0px 0px 0px 3px whitesmoke;
	cursor:pointer;
	}
	
	.container{
	min-height:350px;
	width:100%;
/*	background-color:grey;	*/
	margin-top:5px;
	}
	
	.leftmenu{
	float:left;
	min-height:200px;
	width:200px;
/*	border-right:1px solid #333333;	*/
	}
	
	.contentcontainer{
	margin-left:210px;
	padding-left:5px;
	border-left:1px solid #333333;	
	min-height:400px;
	}
	
	.loginform{
	margin-top:10px;
	font-size:12px;
	}
	
	.loginbutton{
	font-size:inherit;
	border:1px solid blue;
	
	-moz-border-radius:5px;
	-webkit-border-radius:5px;
	}
	
	.loginbutton:hover{
	color:white;
	background-color:#514ae9;
	}
	
	.footer{
	border-top: 3px solid white;
	width:100%;
	height:20px;
	text-align:center;
	margin-top:10px;
	}
	
	.newscontainer{
	min-height:50px;
	}

	.rfloat{
		float:right;
	}	
</style>

<body>

<div class="banner">
VOTING SYSTEM
</div>

<div class="menu">

	<div class="menuelement">
		<a href="/index.php" > Home </a>
	</div>

	<div class="menuelement">
		<a href="javascript:loadpage(1)" > View Candidates </a>
<!--				<a href="viewcandidates.php" > View Candidates </a>	-->
	</div>


	<div class="menuelement">
		<a href="javascript:loadpage(2)" > Rules </a>
	</div>

	<div class="menuelement">
		<a href="javascript:loadpage(3)" > Important Dates </a>
	</div>

	<div class="menuelement">
		<a href="javascript:loadpage(7)" > Voters </a>
	</div>

	<div class="menuelement">
		<a href="javascript:loadpage(4)" > Reach-us </a>
	</div>

	
</div>

<div class="container">

	<div class="leftmenu">
	
	<div class="loginform">
	';
	
	if(!isset($_SESSION['uname'])){
	echo '
	Login:
		<form action="" method="POST">
		<table>
		
		<tr>
			<td  class="ralign">UserName</td> <td class="lalign"> <input type="textbox" name="uname" size="15"></td>
		</tr>
		
		<tr>
		<td class="ralign"> Password</td><td  class="lalign"> <input type="password" name="upass" size="15"></td>
		</tr>
		
		<tr>
		<td colspan="2"   class="ralign"><input type="submit" value="login" name="Login" class="loginbutton"></td>
		</tr>
		</table>
		</form>
		
		';
		}
		
		else {
		
		echo '
			Welcome '. $_SESSION['uname'] .'!
			<br/> <u><font color="blue"> <a href="logout.php" > Logout </a> </font></u>
		';
		
		}
		
		
	
	echo 	'
	</div>	<!-- login form -->
	
	</div>	<!-- left menu -->

	<div class="contentcontainer">
	
		<div class="newscontainer">
		</div>
		
		<div class="containerbody" id="bodycontent">
		
		';


		if (isset($homebodycontent)){
			echo $homebodycontent;
		}
		else if (!isset($_SESSION['uname'])){
		
		include_once('elect.php');
		include_once('viewresults.php');
		
		echo '
		<img src="voting.jpg" align="right" width=150px height=150px>
		This is Voting new Online website, wherein voters can register themseleves from home and participate in the 
		election. Voters can view the candidates and find all kind of statistics minute by minute update.		
		<br/>
		Every Citizen has the right to exercise his/her vote. So we request you to register and vote on the date given by going to the venue mentioned.
		
		<br/><br/>
		
		<b>
		Voters who hadn\'t registered can register in the voters section before election.
		<br/><br/>
		Check out the candidates participating in view candidates section.
		<br/><br/>
		Feel free to contact us anytime for any queries.
		</b>
		';
		
		}

		else{
		
		include('admin.php');
		
		}


		
echo '		
	</div> <!-- containerbody -->
	
	</div> <!-- contentcontainer -->
	
	</div><!-- container -->


<div class="footer">
	copyright&copy 2012 by careforus.org
</div>

</body>

';

mysql_close($con);

unset($homebodycontent);
?>
