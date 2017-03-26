<?php
require_once('menuBarAdmin.php');
function __autoload($class_name) {
    require_once('Database.php');
	require_once('User.php');
}
session_start();
if(isset($_SESSION['login'])==true){
	if($_SESSION["obj"]->getUserName()=="admin"){
		if(isset($_SESSION['result'])){
			echo $_SESSION['result'];
			unset($_SESSION['result']);
		}
		echo 
			"<form action='grantMoney.php' method='POST'>
				<div class='background'>
  					<div class='transbox'>
						<p align='center'>
		  					<label class='label5'><b>Grant Id : </b></label>
							<input class='custombox5' placeholder='Enter Grant Id' type='text' name='grantId' ><br><br>
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