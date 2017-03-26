<?php
require_once('menuBarAdmin.php');
function __autoload($class_name) {
    require_once('Database.php');
	require_once('User.php');
}
session_start();
if(isset($_SESSION['login'])==true){
	if($_SESSION["obj"]->getUserName()=="admin"){
	}
	else{
		header("Location:profile.php");
	}
}
else{
	header("Location:login.php");
}
?>
<br><br>
<div class="background">
  <div class="transbox3">
	<p><?php if(isset($_SESSION['result'])){
			echo $_SESSION['result'];
			unset($_SESSION['result']);
		}?></p>
    <p class="labelclass" align="center">
		<label class="label3"><b>Name:<?php echo $_SESSION["obj"]->getFirstName()." ".$_SESSION["obj"]->getlastName(); ?> </b></label><br> 
		<label class="label3"><b>Username : <?php echo $_SESSION["obj"]->getUserName(); ?> </b></label><br>   
		<label class="label3"><b>Gender : <?php echo $_SESSION["obj"]->getGender(); ?> </b></label><br>       
		<label class="label3"><b>Role : <?php echo $_SESSION["obj"]->getRole(); ?> </b></label><br>    
	</div>
  </div>         