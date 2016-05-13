<?php
ini_set( 'session.cookie_httponly', 1 );
session_start();
?>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Verify your Email</title>
	<link href="dist/css/bootstrap.min.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Josefin+Sans:400,600' rel='stylesheet' type='text/css'>
	<link href="dist/css/verification.css" rel="stylesheet">

</head>
<body>
	<div class="container">
	<?php
		if(isset($_GET['email'])) {
			$email=$_GET['email'];
			$password=$_GET['password'];
			$last_name=$_GET['last_name'];
			$first_name=$_GET['first_name'];
			$connect=mysqli_connect('localhost','root','','question_bank');
			$query="SELECT * FROM verification WHERE email_id='$email'";
			$result=mysqli_query($connect,$query);
			$row=mysqli_fetch_assoc($result);
			if($row['password']==$password && $row['email_id']==$email) {
				mysqli_query($connect,"DELETE FROM verification WHERE email_id='$email'");
				$query1="INSERT INTO users(first_name,last_name,email_id,password,user_id)
				VALUES('$first_name','$last_name','$email','$password','$user_id')";
				$result=mysqli_query($connect,$query1);
			} else{
				echo "Something went wrong";
			}
		}
	?>
	</div>
</body>
</html>