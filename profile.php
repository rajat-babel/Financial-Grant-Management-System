<?php
require_once('menuBar.php');
function __autoload($class_name) {
	require_once('Database.php');
	require_once('User.php');
}
session_start();
if(isset($_SESSION['login'])==true){
	if($_SESSION["obj"]->getUserName()!="admin"){
		if(isset($_SESSION['result'])){
			echo $_SESSION['result'];
			unset($_SESSION['result']);
		}
	}
	else{
		header("Location:profile_admin.php");
	}
}
else{
	header("Location:login.php");
}
?>
<br><br>
<div class="background">
  <div class="transbox4">
    <p class="labelclass" align="center">
	<label class="label3"><b>Name :<?php echo $_SESSION["obj"]->getFirstName()." ".$_SESSION["obj"]->getlastName(); ?></b></label><br>
	<label class="label3"><b>Username:<?php echo $_SESSION["obj"]->getUserName(); ?> </b></label>
	<label class="label3"><b>Gender:<?php echo $_SESSION["obj"]->getGender(); ?></b></label>       
	<label class="label3"><b>Role:<?php echo $_SESSION["obj"]->getRole(); ?></b></label><br> 
	<label class="label3"><b>Present Limit:<?php echo $_SESSION["obj"]->getPresentLimit(); ?></b></label> 
	<label class="label3"><b>Grant Money Left:<?php echo $_SESSION["obj"]->getGrantMoneyLeft(); ?></b></label> 
	<label class="label3"><b>Number of Grant Requested:<?php echo $_SESSION["obj"]->getNumberOfGrantsRequested(); ?></b></label><br>
  </div>
</div>
</body>
</html>
 
