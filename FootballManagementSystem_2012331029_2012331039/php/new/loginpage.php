<?php
session_start();
if(isset($_SESSION['user'])!="")
{
	header("Location: http://localhost/php/new/loginpage.php");
	exit();
}
include_once 'db_connect.php';

$success="true";

if(isset($_POST['signup']))
{
	$f_name = mysqli_real_escape_string($con,$_POST['full_name']);
	$team_id = 0;
	$n_name = mysqli_real_escape_string($con,$_POST['nick_name']);
	$reg = mysqli_real_escape_string($con,$_POST['registration']);
	$country = mysqli_real_escape_string($con,$_POST['country']);
	$pos = mysqli_real_escape_string($con,$_POST['position']);
	$preference = mysqli_real_escape_string($con,$_POST['preference']);

	//$pattern = '/^[0-9]/';
	//$flag=preg_match($pattern, substr($f_name,1), $matches, PREG_OFFSET_CAPTURE);
	//$flag=preg_match("/[0-9]/i", $f_name, $match)
	//echo $flag;
	
	$sql="INSERT INTO player_info(Player_ID,First_name,Last_Name,Country_name,team_preference,position) VALUES('$reg','$f_name','$n_name','$country','$preference','$pos')";
	$sql_1="INSERT INTO player_attributes(Player_ID) VALUES('$reg')";
	
	if(mysqli_query($con,$sql))
	{
		?>
        <script>alert('successfully registered ');</script>
        <?php
	}
	else 
	   die('Error: ' . mysqli_error($con));

   mysqli_query($con,$sql_1);
   }

mysqli_close($con);
?>


    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign Up Form</title>
        <!-- <link rel="stylesheet" href="css/normalize.css"> -->
        <link href='http://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="main.css">
    </head>
    <body background="img_background.jpg" style="margin: 0px !important;">
	
	<div id='cssmenu'>
	<ul id='ul'>
   <li><a href='http://localhost/php/new/menu/'>Home</a></li>
   <li class='active'><a href='http://localhost/php/new/loginpage.php'>Registration</a></li>
   <li><a href='http://localhost/php/Standings_table/table_versus.php'>Schedule</a></li>
   <li><a href='http://localhost/php/new/table_3.php'>Standings</a></li>
	</ul>
	</div>
	
      <form action="loginpage.php" method="post">

        <h1>Sign Up</h1>

        <fieldset>
          <legend><span class="number">1</span>Your basic info</legend>
          <label for="full">Full Name:</label>
          <input type="text" id="full" name="full_name">

          <label for="nick">Nick Name:</label>
          <input type="text" id="nick" name="nick_name">

          <label for="reg">Registration:</label>
          <input type="number" id="reg" name="registration">
		  
		  <label for="country">Country:</label>
          <input type="text" id="country" name="country">

          
        </fieldset>

        <fieldset>
          <legend><span class="number">2</span>Your profile</legend>
          <label for="position">Position:</label>
          <input type="text" id="position" name="position">
        </fieldset>
        
		<fieldset>
        <label for="job">Teams Preference:</label>
        <select id="job" name="preference">
         
            <option value="Manchester City">Manchester City</option>
            <option value="Arsenal">Arsenal</option>
            <option value="Manchester United">Manchester United</option>
            <option value="Chealsea">Chealsea</option>
            <option value="Juventus">Juventus</option>
            <option value="Borussia Dortmund">Borussia Dortmund</option>
			<option value="Bayern Munich">Bayern Munich</option>
			<option value="FC Schalke 04">FC Schalke 04</option>
			<option value="Real Madrid">Real Madrid</option>
			<option value="Shaktar Donetsk">Shaktar Donetsk</option>
			<option value="FC Barcelona">FC Barcelona</option>
			<option value="Paris Saint Germain">Paris Saint Germain</option>
			<option value="AC Milan">AC Milan</option>
			<option value="Napoli">Napoli</option>
			<option value="AS Roma">AS Roma</option>
			<option value="Inter Milan">Inter Milan</option>
			<option value="Inter Milan">No team</option>
          
        </select>
		</fieldset>
		
        <!--<input type="submit" name="signup" value="Sign Up">-->
		<button type="submit" name="signup">Sign Up</button>
      
	  </form>
      
    </body>
</html>