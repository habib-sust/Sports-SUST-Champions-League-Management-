<?php

require 'db_connect.php';

$ID=mysqli_real_escape_string($con,$_GET['team_id']);
$sql="SELECT Team_Name from team where Team_ID='".$ID."'";


$query_run = mysqli_query($con,$sql);	
if(!$query_run){
	die('Error: ' . mysqli_error($con));
}


$row = mysqli_fetch_array($query_run);
//echo $row[0];
$query="SELECT Team_One,Team_Two,Goal_T1,Goal_T2,Match_result,Category,Match_Date,Match_Time from result where '".$row[0]."' in(Team_One,Team_Two)";
$query_run = mysqli_query($con,$query);
$query_num_rows=0;

if(!$query_run){
		?>
			<h1>Error!</h1> 
		<?php
		die('Error: ' . mysqli_error($con));
			}
			else{
				$query_num_rows = mysqli_num_rows($query_run);
			}	
				if($query_num_rows==0){
		?>
				<h1>No Schedule</h1>
		<?php
				}
				else{
		?>


<head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="match_myteam.css">
    </head>
<body style="margin: 0px !important;">

<div id='cssmenu'>
<ul id='ul'>
   <li><a href='http://localhost/php/new/menu/'>Home</a></li>
   <li><a href='http://localhost/php/new/table_2.php?team_id=<?php echo $ID ?>'>Players</a></li>
   <li class='active'><a href='http://localhost/php/Standings_table/table_versus.php'>Matches</a></li>

</ul>
</div>

<div style="display:flex;justify-content:center;flex-direction:column; align-items:center;">
<div class='container'>

		<?php
				$flag=0;
				$t1='';
				$t2='';
				$t3=0;
				$t4=0;
				$t5='Not Played Yet';
				$group='';
				$t6='';
				$t7='';
			
			while($flag<$query_num_rows)//$row = mysqli_fetch_array($query_run))
			     {
					 $row = mysqli_fetch_array($query_run);
					 $t1=$row[0];
					 $t2=$row[1];
					 $t3=$row[2];
					 $t4=$row[3];
					 $t5=$row[4];
					 $group=$row[5];
					 $t6=$row[6];
					 $t7=$row[7];
					 $flag++;
					 
		?>

  <div class='silver'>
 <!--   <h1><?php //echo $group ?></h1> -->
    <h2><?php echo $t1 ?></h2>
    <div class='price'>VS</div>
    <h2><?php echo $t2 ?></h2>
	<p>Score</p>
    <span><?php if($t5=='') {echo "<br>";echo 'Not';
echo "<br>"; echo 'Played';echo "<br>"; echo 'Yet';} else {echo $t3 ?><h2>-</h2><?php echo $t4;} ?></span> 
    
	<p>Date</p>
	<h2><?php if($t5=='') {echo 'Not Fixed Yet';} else {echo $t3 ?><h2>-</h2><?php echo $t5;} ?></h2>
	<p>Time</p>
	<h2><?php if($t6=='') {echo 'Not Fixed Yet';} else {echo $t3 ?><h2>-</h2><?php echo $t6;} ?></h2>
    <!--<div class='pricing-table-signup-tiny'><a href="http://localhost/php/new/chart.php?team_1=<?php// echo $t1 ?>&team_2=<?php// echo $t2 ?>">Details</a></div>-->
    </div>
  
  	  <?php
	  //$t1++;
	  //$t2++;
	  
			     }
				 
		}
				 mysqli_close($con);
			//}
	   ?>
  
  
<!--  
  <div class='plat'>
    <h1>Platinum Plan</h1>
    <h2>Elite! Enough Said!</h2>
    <div class='price'>$45/m</div>
    <p>Number of Courses</p>
    <span>Unlimited</span>
    <p>Downloads</p>
    <span>Unlimited</span>
    <p>Forums</p>
    <span>ALL</span>
    <button>Select Plan</button>
  </div>-->
</div>
</body>
</div>