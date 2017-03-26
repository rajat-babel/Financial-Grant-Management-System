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
		$result = $_SESSION["obj"]->viewGrants("Approved");
		if($result->num_rows>0){
			echo "<table>
				<tr>
					<th>Grant Id</th>
					<th>Grant Type</th>
					<th>Grant Money</th>
					<th>Request Time</th>
					<th>Status</th>
					<th>Approval Document</th>
				</tr>";
			while($rows = $result->fetch_assoc()){
				echo "<tr>
					<td>".$rows['grantId']."</td>
					<td>".$rows['grantType']."</td>
					<td>".$rows['grantMoney']."</td>
					<td>".$rows['requestTime']."</td>
					<td>".$rows['grantStatus']."</td>";
					if($rows['grantStatus']=="Approved"){
						$grantId = $rows['grantId'];
						$grantType = $rows['grantType'];
						$grantMoney = $rows['grantMoney'];
						$userName = $rows['userName'];
						echo "<td><form method='POST' action='document.php' target='_blank'>
							<input type='hidden' name='grantId' value='$grantId'>
							<input type='hidden' name='grantType' value='$grantType'>
							<input type='hidden' name='grantMoney' value='$grantMoney'>
							<input type='hidden' name='userName' value='$userName'>
							<input type='submit' name = 'document' value='Document'></form></td>";
					}
				echo "</tr>";
			}
			echo "</table>";
		}
		else{
			echo "No data";
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