<div style="display:flex;justify-content:center;flex-direction:column; align-items:center;">
<?php
	
	session_start();

$alert_get=	$_GET['alert'];
	
	if($alert_get!='')
	{
		?>
        <script>alert('pls go to the link given in ur Email to submit ur prediction');</script>
        <?php
	}
//$team[0]=str_replace('%', ' ',$_GET['team_1']);
//$team[1]=str_replace('%', ' ',$_GET['team_2']);
$team[0]=$_GET['team_1'];
$team[1]=$_GET['team_2'];

//echo $team[0];
//echo " vs";
//echo " ";
//echo $team[1];

	
if(isset($_SESSION['user'])!="")
{
	header("Location: http://localhost/php/new/chart.php?team_1=".$team[0]."&"."team_2=".$team[1]);
	exit();
}
require 'db_connect.php';

$count=0;
//$team_2=$_GET['team_2'];
while($count<2){
	$f_name = mysqli_real_escape_string($con,$team[$count]);
$sql = "SELECT Team_ID from team where Team_Name='".$team[$count]."'";

//$query_run =mysqli_query($con,$sql);
if(!mysqli_query($con,$sql)){
	die('Error: ' . mysqli_error($con));
}
	$query_run = mysqli_query($con,$sql);	
	$row = mysqli_fetch_array($query_run);
	//$row=mysqli_fetch_array($query_run);
//echo $row[0];
	
$query="SELECT SUM(Physical),SUM(Speed),SUM(Mental),SUM(Defending),SUM(Attacking),SUM(Technical),COUNT(*) from player_info,player_attributes where(player_info.Player_ID=player_attributes.Player_ID and player_info.Team_ID='".$row[0]."')";	
$query_check = mysqli_query($con,$query);
if($query_check){
	$query_run_2 = mysqli_fetch_array($query_check);
}
else 
	die('Error: ' . mysqli_error($con));

	
	//shows full array
	//var_dump($query_run_2);
	
	
	
	//echo $query_run_2[0];
	//echo $query_run_2[1];
	//echo $query_run_2[2];
	//echo $query_run_2[3];
	//echo $query_run_2[4];
	//echo $query_run_2[5];
	//echo $query_run_2[6];
	
	$grades[$count] = ($query_run_2[0]+$query_run_2[1]+$query_run_2[2]+$query_run_2[3]+$query_run_2[4]+$query_run_2[5])/$query_run_2[6];
	$grades[$count]/=30;
	$grades[$count]*=100;
	$count++;
}

if($grades[0]>$grades[1]){
	$dif=$grades[0]-$grades[1];
		if($dif<50)
		{
		$grades[0]=50+$dif;
		$grades[1]=50-$dif;
		}
	}
	else if($grades[1]>$grades[0]){
	$dif=$grades[1]-$grades[0];
		if($dif<50)
		{
		$grades[1]=50+$dif;
		$grades[0]=50-$dif;
		}
	}
	else if($grades[1]==$grades[0]){
		$grades[1]=50;
		$grades[0]=50;
	}

	
	if(isset($_POST['signup']))
{
	$name_1=mysqli_real_escape_string($con,$_POST['name_1']);
	$name_2=mysqli_real_escape_string($con,$_POST['name_2']);

	$query_match_id="SELECT Match_ID from result where Team_One='".$name_1."'and Team_Two='".$name_2."'";
	$query_run_2 = mysqli_query($con,$query_match_id);
    $row=mysqli_fetch_array($query_run_2);

	$email=mysqli_real_escape_string($con,$_POST['email']);
	$email_1=$email.$row[0];
	$hash = md5( rand(0,1000));	
	$query="INSERT INTO users (email, hash,Match_ID) VALUES(
'".$email_1."', 
'".mysqli_escape_string($con,$hash)."','".$row[0]."')";
$query_run = mysqli_query($con,$query);

if(!$query_run){
	?>
        <script>alert('sorry ..u have predicted once in this game');</script>
        <?php
	die('Error: ' . mysqli_error($con));
	header("Location: http://localhost/php/new/chart.php?team_1=".$_POST['name_1']."&team_2=".$_POST['name_2']."&alert=".$alert);
}
//$query_new="INSERT INTO prediction_table (email) VALUES('".$email."')";
//$query_run = mysqli_query($con,$query_new);
//if(!$query_run){
//	die('Error: ' . mysqli_error($con));
//}
//convert the post variables in string
$flag='flagged';

//$team_1=$_POST['name_1'];
//$team_2=$_POST['name_2'];

$team_1=str_replace(' ', '%20',$_POST['name_1']);
$team_2=str_replace(' ', '%20',$_POST['name_2']);
$to      = $email; // Send email to our user
$subject = 'Email | Verification'; // Give the email a subject 
$message = '
 
Thanks for visiting our website!
after your prediction you will be gifted based upon your total amount of predictions. 

Please click this link to submit your prediction:
http://localhost/php/new/verify.php?match='.$row[0].'&flag='.$flag.'&email='.$email.'&hash='.$hash.'&team_1='.$team_1.'&team_2='.$team_2.'
'; // Our message above including the link
                     
$headers = 'From:noreply@yourwebsite.com' . "\r\n"; // Set from headers
mail($to, $subject, $message, $headers); // Send our email

$alert='confirm';
//echo $_POST['name_1'];
//echo $_POST['name_1'];
header("Location: http://localhost/php/new/chart.php?team_1=".$_POST['name_1']."&team_2=".$_POST['name_2']."&alert=".$alert);



	
   }
?> 

<head>
        <meta charset="utf-8">
		
		<link rel="stylesheet" href="chart.css">
        
		<script type="text/javascript" src="jquery-2.2.2.min.js"></script>
		<script type="text/javascript" src="Chart.js/Newfolder/chart.min.js"></script>
    </head>
<body>

<canvas id="myChart" width="400" height="400"></canvas>

<script>
	$(document).ready(function(){
		var data_1 = <?php echo json_encode($grades[0]); ?>;
		var data_2 = <?php echo json_encode($grades[1]); ?>;
		var team_1 = <?php echo json_encode($team[0]); ?>;
		var team_2 = <?php echo json_encode($team[1]); ?>;
		var ctx = $("#myChart").get(0).getContext("2d");
		var myNewChart = new Chart(ctx);
		var data = [
		{
			value: data_1,
			color: "cornflowerblue",
			highlight: "lightskyblue",
			label: team_1
		},
		{
			value: data_2,
			color: "lightgreen",
			highlight: "yellowgreen",
			label: team_2
		}
		];
		
		//var piechart = new Chart(ctx).Pie(data);
		var myPieChart = new Chart(ctx).Pie(data);
		
	});

</script>
<h2>Winning Chance</h2>
<h1>Want to Predict?Then give ur Email below:</h1>
<form action="chart.php" method="post">
<fieldset>
<h3><label for="email">Email:</label></h3>
<input type="email" id="email" name="email">
<input type="hidden" id="name_1" value="<?php echo $team[0]?>" name="name_1">
<input type="hidden" id="name_2" value="<?php echo $team[1]?>" name="name_2">
<button type="submit" name="signup">Submit</button>
</fieldset>
</form>
</body>
</div>