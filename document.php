<?php
function __autoload($class_name) {
    require_once('Database.php');
	require_once('User.php');
}
session_start();
if(isset($_SESSION['login'])==true){
	if($_SESSION["obj"]->getUserName()!="admin"){
		if(isset($_POST['document'])){
			$grantId = $_POST['grantId'];
			$grantMoney = $_POST['grantMoney'];
			$grantType = $_POST['grantType'];
			$userName = $_POST['userName'];
		}
		else{
			header("Location:profile.php");
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
<!DOCTYPE html>
<html>
<head>
<style>
p.custompgh{
	margin-left:700px;
}
h4.custom1{
	margin-left:500px;
}
h2.custom2{
	margin-left:500px;
}
img.custom3{
	margin-right:500px;
}
h4.custom4{
	margin-right:700px;
}
h4.custom5{
	margin-right:500px;
}
</style>
<img class="custom3" align="right" src="Logo_IITJ.png" alt="college logo" style="width:70px;height:70px;"><h2 class="custom2" >Indian Institute Of Technology,<br>Jodhpur</h2></p>
</head>
<body>
		<br><br>
		<h2 >Grant acceptance letter</h2>
		<br>
		<h4 class="custom1">Date : 1/2/3 </h4>
		<h4 align="right" class="custom4">Grant ID : </h4>
		<h4 class="custom1">Dear babel,</h4>
		<p class="custompgh">We are pleased to inform you that your request for 
		/*echo grant type*/ has been accepted by us.So you 
		can collect your money from admin office by this 
		acceptance letter.</p>
		<br><br><br><br>
		<h4 class="custom1" align="left">Signature of applicant</h4>
		<h4 class="custom5" align="right">Signature of admin</h4>
</body>
</html>
