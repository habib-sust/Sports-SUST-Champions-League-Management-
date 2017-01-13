<?php
require 'db_connect.php';

//$ID= 0 ;

$query="SELECT Team_Name,Played,Win,Loss,Draw,Point,Goal_Scored,Goal_Conceded,Goal_Def from groupa";
$query_run = mysqli_query($con,$query);
$query_num_rows=0;
$allrow = array();
//1st soring in term of group id
//2nd sorting will be in term of point for each group
//3rd sorting will be in term of goal difference
function sort_new($arg_1,$arg_2)
{
	$count_1=0;
	$count_2=0;
	$name='';
	while($count_1<$arg_2)
	{
		$count_2=$count_1+1;
		while($count_2<$arg_2){
			
			if($arg_1[$count_1][0]>$arg_1[$count_2][0])
			{
				$name = $arg_1[$count_1];
				$arg_1[$count_1]=$arg_1[$count_2];
				$arg_1[$count_2]=$name;
				
			}
			$count_2++;
		}
		$count_1++;
	}
	return $arg_1;
}

function sort_point($array)
{
	$count=0;
	$count_1=0;
	$row=16;
	$num=0;
	$flag=0;
	for($count;$count<$row;$count++){
	
	for($count_1=$count;$count_1<$count;$count_1++){
			if($array[$count][5]<$array[$count_1][5]){
				
				$num=$array[$count];
				$array[$count]=$array[$count_1];
				$array[$count_1]=$num;
				
			}
			if($count==15){
				$flag=1;
			}
			if($flag==0 && $count%3==0){
				$row+=4;
			}
			
			
		}
	}
	return $array;
}
//all sorting queries will be called from here
function sort_all($array,$row_num)
{
	sort_new($arg_1,0);
    return $retval;
}



?>


<head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="table_3.css">
    </head>
<body style="margin: 0px !important;">

 <div id='cssmenu'>
<ul id='ul'>
   <li><a href='http://localhost/php/new/menu/'>Home</a></li>
   <li><a href='http://localhost/php/new/loginpage.php'>Registration</a></li>
   <li><a href='http://localhost/php/Standings_table/table_versus.php'>Schedule</a></li>
   <li class='active'><a href='http://localhost/php/new/table_3.php'>Standings</a></li>
</ul>
</div>
 <div id="wrapper">

  <h1>Players</h1>
  
  
    
	<?php
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
				<h1>No Players Yet!</h1>
		<?php
				}
				else{
		?>
	<table id="keywords" cellspacing="0" cellpadding="0">
	<thead>
      <tr>
        <th><span>Group A</span></th>
      </tr>
	  <tr>
        <th><span>Team</span></th>
		<th><span>GP</span></th>
        <th><span>W</span></th>
        <th><span>L</span></th>
        <th><span>D</span></th>
		<th><span>P</span></th>
        <th><span>GS</span></th>
		<th><span>GC</span></th>
		<th><span>GD</span></th>
      </tr>  
    </thead>
    <tbody>
	
		<?php
			$count_1 = 4;
			while($row = mysqli_fetch_array($query_run))
			     {
					 
					 array_push ($allrow, $row);
					 //$ID=$ID+1;
				 }
	//			 $allrow = sort_new($allrow,$query_num_rows);
				 $allrow = sort_point($allrow);
				 $count=0;
			while($count<16){
				$count_1++;
				if($count_1==8){
				$query2="SELECT Team_Name,Played,Win,Loss,Draw,Point,Goal_Scored,Goal_Conceded,Goal_Def from groupb";
				$query_run = mysqli_query($con,$query2);
				while($row = mysqli_fetch_array($query_run))
			     {
					 
					 array_push ($allrow, $row);
					 //$ID=$ID+1;
				 }
				}
				if($count_1==9){
					?>
	<thead>
      <tr>
        <th><span>Group B</span></th>
      </tr>
	  <tr>
        <th><span>Team</span></th>
		<th><span>GP</span></th>
        <th><span>W</span></th>
        <th><span>L</span></th>
        <th><span>D</span></th>
		<th><span>P</span></th>
        <th><span>GS</span></th>
		<th><span>GC</span></th>
		<th><span>GD</span></th>
      </tr>  
    </thead>
		<?php			
				}
		if($count_1==12){
			$query="SELECT Team_Name,Played,Win,Loss,Draw,Point,Goal_Scored,Goal_Conceded,Goal_Def from groupc";
			$query_run = mysqli_query($con,$query);
			while($row = mysqli_fetch_array($query_run))
			     {
					 
					 array_push ($allrow, $row);
					 //$ID=$ID+1;
				 }
						}
				if($count_1==13){
					?>
	<thead>
      <tr>
        <th><span>Group C</span></th>
      </tr>
	  <tr>
        <th><span>Team</span></th>
		<th><span>GP</span></th>
        <th><span>W</span></th>
        <th><span>L</span></th>
        <th><span>D</span></th>
		<th><span>P</span></th>
        <th><span>GS</span></th>
		<th><span>GC</span></th>
		<th><span>GD</span></th>
      </tr>  
    </thead>
		<?php			
				}
		if($count_1==16){
			$query="SELECT Team_Name,Played,Win,Loss,Draw,Point,Goal_Scored,Goal_Conceded,Goal_Def from groupd";
			$query_run = mysqli_query($con,$query);
			while($row = mysqli_fetch_array($query_run))
			     {
					 
					 array_push ($allrow, $row);
					 //$ID=$ID+1;
				 }			
						}
				if($count_1==17){
					?>
	<thead>
      <tr>
        <th><span>Group D</span></th>
      </tr>
	  <tr>
        <th><span>Team</span></th>
		<th><span>GP</span></th>
        <th><span>W</span></th>
        <th><span>L</span></th>
        <th><span>D</span></th>
		<th><span>P</span></th>
        <th><span>GS</span></th>
		<th><span>GC</span></th>
		<th><span>GD</span></th>
      </tr>  
    </thead>
		<?php			
				}
		?>
      <tr>
        <td class="lalign"><?php echo $allrow[$count][0]?></td>
        <td><?php echo $allrow[$count][1]?></td>
        <td><?php echo $allrow[$count][2]?></td>
        <td><?php echo $allrow[$count][3]?></td>
        <td><?php echo $allrow[$count][4]?></td>
		<td><?php echo $allrow[$count][5]?></td>
		<td><?php echo $allrow[$count][6]?></td>
		<td><?php echo $allrow[$count][7]?></td>
		<td><?php echo $allrow[$count][8]?></td>
		
      </tr>

	  <?php
				
	  $count++;
			     }
				 mysqli_close($con);
			}
	   ?>
	  
    </tbody>
  </table>
 </div> 
</body>
