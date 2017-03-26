<?php
function __autoload($class_name) {
	require_once('Database.php');
	require_once('User.php');
}
session_start();
if(isset($_SESSION['login'])==true){
	if($_SESSION["obj"]->getUserName()!="admin"){
		//echo "rajat";
		if(isset($_POST['grantButton'])){
			$grantType = $_POST['grantType'];
			$grantMoney = $_POST['grantMoney'];
			if($grantType == '' || $grantMoney == ''){
				$_SESSION['result'] = 'Please fill all fields!';
			}
			else{
				$target_dir = "uploads/";
				$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
				$fileType = pathinfo($target_file,PATHINFO_EXTENSION);
				$uploadOk = 1;
				$target_dir = "uploads/temp.pdf";
				if (file_exists($target_file)) {
					$_SESSION['result'] =  "Sorry, file already exists.";
					$uploadOk = 0;
				}
				$size=$_FILES["fileToUpload"]["size"];
				if ($size> 4194304) {
					$_SESSION['result'] = "Sorry, your file is too large.";
					$uploadOk = 0;
				}
				if($fileType != "pdf" ) {
					$_SESSION['result'] =  "Sorry, only pdf are allowed.";
					$uploadOk = 0;
				}
				if ($uploadOk == 0) {
					$_SESSION['result'] .=  " Sorry, your file was not uploaded.";
				} 
				else {
					if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
						echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
					} 
					else {
						$_SESSION['result'] .= "Sorry, there was an error uploading your file.";
						$uploadOk=0;
					}
				}	
				if($grantMoney <= $_SESSION["obj"]->getPresentLimit() && $uploadOk==1){
					$fileName = $_SESSION["obj"]->requestGrant($grantType,$grantMoney,$size);
					if($fileName=="Unsuccess"){
						unlink($target_file);
					}
					else{
						$fileName = "uploads/".$fileName.".pdf";
						rename($target_file, $fileName);
					}
				}
				else if($uploadOk==0){
					
				}
				else{
					unlink($target_file);
					$_SESSION['result'] = "Not Enough Money Left";
				}
			}
			header("Location:request_layout.php");
		}
		else{
			if($_SERVER["CONTENT_LENGTH"]>((int)ini_get('post_max_size')*1024*1024)){
				$_SESSION['result'] = "File Size may be too large";
				header("Location:request_layout.php");
			}
			else{
				header("Location:profile.php");
			}
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