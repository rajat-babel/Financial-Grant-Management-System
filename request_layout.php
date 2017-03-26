<?php 
require_once('menuBar.php');
function __autoload($class_name) {
    require_once('Database.php');
	require_once('User.php');
}
session_start();
if(isset($_SESSION['login'])==true){
	if($_SESSION["obj"]->getUserName()=="admin"){
		header("Location:profile_admin.php");
	}
}	
else{
	header("Location:login.php");	
}
?>
<style>
select {
    border: 0 none;
    color: white;    
    font-size: 16px;
    font-weight: bold;
    padding: 2px 10px;
    width: 200px;
    height:50px;
    background:#339966;
    margin-top:40px;
}
#mainselection {
    overflow: hidden;
    background:#f9f9f9;
    width: 200px;
    -moz-border-radius: 9px 9px 9px 9px;
    -webkit-border-radius: 9px 9px 9px 9px;
    border-radius: 5px;
    border: thin  white;
    margin-top:50px;
}
</style>
<p>
	<?php if(isset($_SESSION['result'])){
			
			echo $_SESSION['result'];
			unset($_SESSION['result']);}
		
	?>
</p>
<form action="request.php" method="POST" enctype="multipart/form-data">
	<div class="background1">
		
		<div class="transbox2">
			<p align="center">
				<label class="label2" ><b >Type of Grant : </b></label>
					<div id="mainselection">
						<select name="grantType" required>
						<option value="">Select an Option</option>
						<option value="Research Grant" >Research Grant</option>
						<option value="Medical Allowances" >Medical Allowances</option>
						<option value="Conference Expenses" >Conference Expenses</option>
						<option value="Travelling Expenses" >Travelling Expenses</option>
						</select>
			  		</div>
			</p>
			<p align="center">
				<label class="label2"><b>Money Required : </b></label>
				<input class="custombox1" placeholder="Enter Amount" type="number"  name="grantMoney" required >
				<br><br>
				<label class="label2"><b>Select File to Upload : </b></label><br><br><br><br>
				<input type="file" name="fileToUpload" id="fileToUpload" required>
				<input align="center" class="customBtn2" type="submit" name="grantButton" value="Submit">
			</p>
		</div>
	</div>
</form>