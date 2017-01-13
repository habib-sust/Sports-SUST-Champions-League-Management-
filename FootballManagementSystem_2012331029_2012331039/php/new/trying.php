<?php
session_start();
if(isset($_SESSION['user'])!="")
{
	header("Location: home.php");
}
include_once 'db_connect.php';

if(isset($_POST['btn-signup']))
{
	$f_name = mysql_real_escape_string($_POST['uname']);
	$team_id = 0;
	$n_name = mysql_real_escape_string($_POST['email']);
	$reg = md5(mysql_real_escape_string($_POST['pass']));
	$country = md5(mysql_real_escape_string($_POST['pass']));
	$pos = md5(mysql_real_escape_string($_POST['pass']));
	$preference = md5(mysql_real_escape_string($_POST['pass']));
	
	if(mysql_query("INSERT INTO users(Player_ID,Team_ID,First_name,Last_Name,Country_name,team_preference,position) VALUES('$f_name',team_id,'$f_name','$n_name','$country','$preferance','$pos')"))
	{
		?>
        <script>alert('successfully registered ');</script>
        <?php
	}
	else
	{
		?>
        <script>alert('error while registering you...');</script>
        <?php
	}
}
?>