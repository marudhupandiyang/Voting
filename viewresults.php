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



		$homebodycontent= '';
		
if ($_GET['id']){


		$res=mysql_query('select e.id,e.region,e.dte as fromdte ,e.dte + INTERVAL e.noofdays DAY as todte from election e where  reslutdate <= curdate()');
		
		if ($res==null || mysql_num_rows($res)==0){
		header('location:/');
		return;
		}

		while ($row=mysql_fetch_assoc($res)){
		
		$homebodycontent.= '
			<div class="results">
					<br/>Results for Region <i>' .  $row['region'] . '</i><br/>';


		$res1=mysql_query('select c.name,r.votes  from candidates c , results r , election e where c.id=r.candidate and r.electid='.$row['id'] . ' order by r.votes');

		echo '
		
		<style>
		.cand{
		font-size:30px;
		margin-top:10px;
		}
		
		.cand_name{
		color:maroon;
		height:30px;
		float:left;
		}
		
		.cand_votes{
		float:left;
		margin-left:50px;
		margin-right:50px;
		}
		</style>
		';


		while($row1=mysql_fetch_assoc($res1)){
		
			$homebodycontent.= '<div class="cand">
					<div class="cand_name">Name: ' .  $row1['name']. '</div>
					<div class="cand_votes">'. $row1['votes'] . '</div>
					</div>
					';
					
	
		}


		}
		
		include_once('index.php');
		return;
}

else{



		$res=mysql_query('select * from election where  reslutdate <= curdate()');
		
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
		
		echo '<br/>Past Election Results<br/><br/>';
		while ($row=mysql_fetch_assoc($res)){
		
		
		
		echo  '<div class="election_details">';
		
		echo  'Region:<b>' . $row['region'] .'</b>';
		
		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="viewresults.php?id=' . $row['id'] . '">View Results</a>';
		
		echo '</div>';

		}

return;

}


?>
