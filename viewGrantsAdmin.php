<?php
require_once('menuBarAdmin.php');
function __autoload($class_name) {
	require_once('Database.php');
	require_once('User.php');
}
session_start();
if(isset($_SESSION['login'])==true){
	if($_SESSION["obj"]->getUserName()=="admin"){
		$result = $_SESSION["obj"]->viewOldGrants();
		
		if($result->num_rows>0){
			echo "<table>
					<tr>
						<th>Username</th>
						<th>Grant Id</th>
						<th>Grant Type</th>
						<th>Grant Money</th>
						<th>Request Time</th>
						<th>Status</th>
				</tr>";
			while($rows = $result->fetch_assoc()){
				echo "<tr>
						<td>".$rows['userName']."</td>
						<td>".$rows['grantId']."</td>
						<td>".$rows['grantType']."</td>
						<td>".$rows['grantMoney']."</td>
						<td>".$rows['requestTime']."</td>
						<td>".$rows['grantStatus']."</td>
					</tr>";
			}
			echo "</table>";
		}
		else{
			echo "No old data";
		}
		
	}
	else{
		header("Location:profile.php");
	}
}
else{
	header("Location:login.php");
}
?>