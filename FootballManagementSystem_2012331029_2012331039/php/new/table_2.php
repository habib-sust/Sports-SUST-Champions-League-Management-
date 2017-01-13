<?php
require 'db_connect.php';

$ID=$_GET['team_id'];

$query="SELECT First_Name,player_info.Player_ID,position,Physical,Speed,Mental,Defending,Attacking,Technical from player_info,player_attributes where player_info.Player_ID=player_attributes.Player_ID and player_info.Team_ID='$ID'";
$query_run = mysqli_query($con,$query);
$query_num_rows=0;
?>


<head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="table_2.css">
    </head>
<body>

<div id='cssmenu'>
<ul id='ul'>
   <li><a href='http://localhost/php/new/menu/'>Home</a></li>
   <li class='active' class='active'><a href='http://localhost/php/new/table_2.php?team_id=<?php echo $ID ?>'>Players</a></li>
   <li><a href='http://localhost/php/new/match_myteam.php?team_id=<?php echo $ID ?>'>Matches</a></li>
   
</ul>
</div>


 <div id="wrapper">
  <h1>Players</h1>
  
  
    
	<?php
			if(!$query_run){
		?>
			<h1>Error!</h1>
		<?php
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
        <th><span>Name</span></th>
		<th><span>Registration</span></th>
        <th><span>Position</span></th>
        <th><span>Physical</span></th>
        <th><span>Speed</span></th>
        <th><span>Mental</span></th>
		<th><span>Defending</span></th>
		<th><span>Attacking</span></th>
		<th><span>Technical</span></th>
      </tr>
    </thead>
    <tbody>
		<?php
			while($row = mysqli_fetch_array($query_run))
			     {
		?>
      <tr>
        <td class="lalign"><?php echo $row[0]?></td>
        <td><?php echo $row[1]?></td>
        <td><?php echo $row[2]?></td>
        <td><?php echo $row[3]?></td>
        <td><?php echo $row[4]?></td>
		<td><?php echo $row[5]?></td>
		<td><?php echo $row[6]?></td>
		<td><?php echo $row[7]?></td>
		<td><?php echo $row[8]?></td>
		
      </tr>

	  <?php
			     }
				 mysqli_close($con);
			}
	   ?>
	  
    </tbody>
  </table>
 </div> 
</body>
