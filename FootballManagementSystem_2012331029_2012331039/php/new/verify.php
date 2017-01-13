<html>
<head>

</head>

<body>
<?php
include_once 'db_connect.php';

$team_1=str_replace('%',' ',$_GET['team_1']);
$team_2=str_replace('%', ' ',$_GET['team_2']);

if($_GET['flag']=='flagged'){
$hash  = $_GET['hash'];
$match_id = $_GET['match'];
$email=mysqli_real_escape_string($con,$_GET['email']).$match_id;

//$team_1=$_GET['team_1'];
//$team_2=$_GET['team_2'];


$team_1=str_replace('%20',' ',$_GET['team_1']);
$team_2=str_replace('%20', ' ',$_GET['team_2']);

//$query_2="SELECT hash from users where email='".$email."'";
//$query_run_2=mysqli_query($con,$query_2);
//$row=mysqli_fetch_array($query_run_2);
//echo $row[0];
//echo $hash;
//echo $query_run_2;

/*$alert_get=	$_GET['alert'];
	
	if($alert_get!='')
	{
		?>
        <script>alert('ur prediction has been taken successfully');</script>
        <?php
	}*/
}
else
{
	?>
        <script>alert('ur prediction has been taken successfully');</script>
        <?php
}


?>
<form action="verify.php" method="post">
  <input type="radio" name="predict" value="<?php echo $team_1 ?>"> <?php echo $team_1?><br>
  <input type="radio" name="predict" value="<?php echo $team_2 ?>"> <?php echo $team_2?><br>
  <input type="hidden" id="name_1" value="<?php echo $team_1?>" name="name_1">
  <input type="hidden" id="name_2" value="<?php echo $team_2?>" name="name_2">
  <input type="hidden" id="email" value="<?php echo $email?>" name="email">
  <input type="hidden" id="match_id" value="<?php echo $match_id?>" name="match_id">
  <input type="radio" name="predict" value="Draw"> Draw
  <button type="submit" id="submit" name="submit">Enter</button>
  </form>
<?php

if(isset($_POST['submit'])){

$prediction=$_POST['predict'];

$team_again_1=str_replace(' ','%20',$_POST['name_1']);
$team_again_2=str_replace(' ','%20',$_POST['name_2']);
$prediction=mysqli_real_escape_string($con,$_POST['predict']);
$email=mysqli_real_escape_string($con,$_POST['email']);
$match_id=mysqli_real_escape_string($con,$_POST['match_id']);
echo $email;

$query="INSERT INTO prediction_table (email, prediction,Match_ID) VALUES(
'".$email."', 
'".$prediction."','".$match_id."')";
$query_run = mysqli_query($con,$query);

if(!$query_run){
	?>
        <script>alert('sorry something went wrong.pls try again');</script>
        <?php
	//die('Error: ' . mysqli_error($con));
	header("Location: http://localhost/php/new/verify.php?team_1=".$team_again_1."&team_2=".$team_again_2."&flag=".'1');	
}
header("Location: http://localhost/php/new/verify.php?team_1=".$team_again_1."&team_2=".$team_again_2."&flag=".'1');	


}

?>
</body>


</html>