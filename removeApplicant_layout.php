<?php
require_once('menuBarAdmin.php');
function __autoload($class_name) {
    require_once('Database.php');
	require_once('User.php');
}
$message="";
session_start();
if(isset($_SESSION['login'])==true){
	if($_SESSION["obj"]->getUserName()=="admin"){
		echo 
			"<form action='removeApplicant.php' method='POST'>
			    <div class='background'>
  					<div class='transbox'>
						<p align='center'>
		  					<label class='label5'><b>Username : </b></label>
							<input class='custombox5' placeholder='Enter Username' type='text' name='userName' ><br><br>
							<input class='customBtn7' type='submit' name='SubmitButton' value='Submit'><br>
						</p>
					</div>
				</div>
			</form>";
	}
	else{
		header("Location:profile.php");
	}	
}
else{
	header("Location:login.php");
}
?>

