<?php 
function __autoload($class_name) {
	// including the classes files
	require_once('User.php');
	require_once('Database.php');
}

session_start();
// Checking whether the user is logged in or not.
if(isset($_SESSION['login'])==true){
	// Checking the user is admin or applicant.
	if($_SESSION["obj"]->getUserName()=="admin"){
		header("Location:profile_admin.php");
	}
	else{
		header("Location:profile.php");
	}	
}
// Checking whether the submit is pressed or not.
else if(isset($_POST['submitButton'])){
	// Storing data in variables.
	$userName = $_POST['userName'];
	$password = $_POST['password'];
	$role = $_POST['role'];
	// Checking whether all the fields are filled or not.
	if($userName == '' || $password == '' || $role == ''){
		$_SESSION['result'] = "Please fill all values!";
	}
	// Checking the credentials.
	else{
		require_once('dbConnect.php');
		// sql query.
		$sql = "SELECT * FROM users WHERE userName='$userName'";
		// Creating session object of database class.
		$_SESSION['databaseObj'] = new Database();
		// Finding the row in database which matches with the username provided by user.
		$result = $_SESSION['databaseObj']->retrieveQuery($con,$sql);
		if($result->num_rows==1){
			$row = $result->fetch_assoc();
			// Checking that the other fields are matching or not.
			if($row['password']==$password && $row['role'] == $role){
				// Session login object.
				$_SESSION['login'] = true;
				$_SESSION['result'] = "Successfully Logged in";
				if($role=="Admin"){
					// Creating Session object of Admin class.
					$_SESSION['obj'] = new Admin($row['firstName'],$row['lastName'],$userName,$row['gender'],$role);
					header("Location:profile_admin.php");
				}
				else{
					// Creating Session object of Applicant class.
					$_SESSION['obj'] = new Applicant($row['firstName'],$row['lastName'],$userName,$row['gender'],$role,$row['presentLimit'],$row['grantMoneyLeft'],$row['numberOfGrantsRequested']);
					header("Location:profile.php");
				}	
			}
			else{
				$_SESSION['result'] = "Password or Role is not correct ";
			}
		}
		else{
			$_SESSION['result'] = "Username does not exist";
		}
		mysqli_close($con);
	}
}
?>
<link rel="stylesheet" href="final.css" type="text/css">
<!DOCTYPE html>
<html>
<style>
select {
    border: 0 none;
    color: white;    
    font-size: 16px;
    font-weight: bold;
    padding: 2px 10px;
    width: 200px;
    height:40px;
    margin-top:30px;
    background:#339966;
}
#mainselection {
    overflow: hidden;
    background-color:#f9f9f9;
    width: 200px;
    margin-top:30px;
    -moz-border-radius: 5px 5px 5px 5px;
    -webkit-border-radius: 5px 5px 5px 5px;
}
</style>
<body>
<img align="right" src="Logo_IITJ.png" alt="college logo" style="width:70px;height:70px;"><h2 align ="left">Indian Institute Of Technology,<br>Jodhpur</h2></p>
<p>
	<?php if(isset($_SESSION['result'])){
			if($_SESSION['result']!="Successfully Logged in"){
			echo $_SESSION['result'];
			unset($_SESSION['result']);}
		}
		?></p>
<div class="background2">
	<div class="transbox5">
		<form action="login.php" method="POST">
		<p align="center" margin-top="20px">
		  <label class="label4"><b>Username : </b></label>
			<input class="custombox3" type="text" placeholder="	Enter Username" name="userName" required><br><br>
		  <label class="label4"><b>Password : </b></label>
			<input class="custombox3" type="password" placeholder="	Enter Password" name="password" required><br><br>

		  <label class="label4"><b>Roles : </b></label>
		  <div id="mainselection">
			<select name="role" required>
			<option value="">Select an Option</option>
			<option value="Btech" >Btech</option>
			<option value="Mtech" >Mtech</option>
			<option value= "Msc" >Msc</option>
			<option value="Phd" >Phd</option>
			<option value="Faculty" >Faculty</option>    
			<option value="Admin" >Admin</option>
			</select>
		  </div>
		  <br>
		  <input class="customBtn4" type="submit" name="submitButton" value="Login">
		</p>
		</form>
	</div>
</div>	
</body>
</html>