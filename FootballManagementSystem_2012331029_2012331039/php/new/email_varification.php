<?php
	require 'db_connect.php';
	$email=$_GET['email'];
	//$email="shazid1971@gmail.com";
	$hash = md5( rand(0,1000));	
	$query="INSERT INTO users (email, hash) VALUES(
'". mysqli_escape_string($con,$email) ."', 
'". mysqli_escape_string($con,$hash) ."')";
$query_run = mysqli_query($con,$query);
$name='shazid';
$password='haha';
if(!mysqli_query($con,$query)){
	die('Error: ' . mysqli_error($con));
}


$to      = 'shopon2024@gmail.com'; // Send email to our user
$subject = 'Signup | Verification'; // Give the email a subject 
$message = '
 
Thanks for signing up!
Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
 
------------------------
Username: '.$name.'
Password: '.$password.'
------------------------
 
Please click this link to activate your account:
http://www.yourwebsite.com/verify.php?email='.$email.'&hash='.$hash.'
 
'; // Our message above including the link
                     
$headers = 'From:noreply@yourwebsite.com' . "\r\n"; // Set from headers
if(mail($to, $subject, $message, $headers))
	{
		?>
        <script>alert('Pls Confirm ur mail by signing it');</script>
        <?php
	}
	// Send our email

?>
