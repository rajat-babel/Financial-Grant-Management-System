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
			echo $_SESSION['result']."<br>";
			unset($_SESSION['result']);
		}
		$result = $_SESSION["obj"]->viewPendingGrants("pending");
		if($result->num_rows>0){
			echo "<table>
					<tr>
						<th>Username</th>
						<th>Grant Id</th>
						<th>Grant Type</th>
						<th>Grant Money</th>
						<th>Request Time</th>
						<th>Link</th>
						<th>Form</th>
					</tr>";
			while($rows = $result->fetch_assoc()){
				$id = $rows['grantId'];
				$userName = $rows['userName'];
				echo "<tr>
						<td>".$rows['userName']."</td>
						<td>".$rows['grantId']."</td>
						<td>".$rows['grantType']."</td>
						<td>".$rows['grantMoney']."</td>
						<td>".$rows['requestTime']."</td>
						<td><a href='uploads/".$rows['grantId'].".pdf' target='_blank'>See Document</a></td>
						<td><form method='POST' action='decision.php' >
						<input type='hidden' name='id' value='$id'>
						<input type='hidden' name='userName' value='$userName'>
						<input type='radio' name='approval' value='Approved' checked>Approve
						<br>
						<input type='radio' name='approval' value='Disapproved'>Disapprove<br>
						<input class='customBtn5' type='submit'></form></td>
					</tr>";
			}
			echo "</table>";
		}
		else{
			echo "No Pending Grants";
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
