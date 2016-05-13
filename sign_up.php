<?php 
ini_set( 'session.cookie_httponly', 1 );
error_reporting(~E_ALL);
session_start();
if(isset($_SESSION['email_id'])) {
	unset($_POST['Register']);
}
?>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Sign Up</title>
	<link href="dist/css/bootstrap.min.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Josefin+Sans:400,600' rel='stylesheet' type='text/css'>
	<link href="dist/css/signup.css" rel="stylesheet">
	<style type="text/css">
	.btn>a {
		color: white;
		display: block;
		text-decoration: none;
	}
	body {
		font-family: 'Josefin Sans', sans-serif;
	}
	</style>
	<script type="text/javascript">
	var fnv=false;
	var lnv=false;
	var emidv=false;
	var pwv=false;
	var conpwv=false;
		function validatefn() {
			var fn = document.getElementById('fn');
			var parent = document.getElementById('fndiv');
			var span = document.getElementById('fnspan');
			var help = document.getElementById('fnhelp');
			if(fn.value === '' || fn.value === ' ') {
				parent.className = "form-group has-feedback has-error";
				span.className = "form-control-feedback glyphicon glyphicon-remove";
				help.className = "help-block text-muted";
				fnv = false;
			} else {
				parent.className = "form-group has-feedback has-success";
				span.className = "form-control-feedback glyphicon glyphicon-ok";
				help.className = "help-block text-muted hidden";
				fnv = true;
			}
		}
		function validateln() {
			var ln = document.getElementById('ln');
			var parent = document.getElementById('lndiv');
			var span = document.getElementById('lnspan');
			var help = document.getElementById('lnhelp');
			if(ln.value === '' || ln.value === ' ') {
				parent.className = "form-group has-feedback has-error";
				span.className = "form-control-feedback glyphicon glyphicon-remove";
				// help.className = "help-block text-muted";
				lnv = false;
			} else {
				parent.className = "form-group has-feedback has-success";
				span.className = "form-control-feedback glyphicon glyphicon-ok";
				// help.className = "help-block text-muted hidden";
				lnv = true;
			}
		}
		function validatemid() {
			var emid = document.getElementById('emid').value;
			var parent = document.getElementById('emiddiv');
			var span = document.getElementById('emidspan');
			var help = document.getElementById('emidhelp');
			var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
			if(filter.test(emid)) {
				emailCheck(emid);
				// parent.className = "form-group has-feedback has-success";
				// span.className = "form-control-feedback glyphicon glyphicon-ok";
				emidv = true;
			} else {
				parent.className = "form-group has-feedback has-error";
				span.className = "form-control-feedback glyphicon glyphicon-remove";
				emidv = false;
			}
			if (emid === '' || emid === ' ') {
				parent.className = "form-group has-feedback";
				span.className = "form-control-feedback glyphicon";
			}
		}
		function reCheck() {
			var emid = document.getElementById('emid').value;
			var parent = document.getElementById('emiddiv');
			var span = document.getElementById('emidspan');
			var help = document.getElementById('emidhelp');
			var mcheckpar = document.getElementById('ajaxpar').innerHTML;
			var mcheck = document.getElementById('mailcheck').innerHTML.trim();
			// alert(mcheck);
			if (mcheck.startsWith("Email") || mcheck.startsWith("Already")) {
				parent.className = "form-group has-feedback has-error";
				span.className = "form-control-feedback glyphicon glyphicon-remove";
			} else {
				parent.className = "form-group has-feedback has-success";
				span.className = "form-control-feedback glyphicon glyphicon-ok";
			}
				
		}
		function emailCheck(str) {
			if (str.length == 0) { 
				document.getElementById("mailcheck").innerHTML = "";
				return;
			} else {
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						document.getElementById("mailcheck").innerHTML = xmlhttp.responseText;
						reCheck();
					}
				};
				xmlhttp.open("POST", "emailcheckajax.php", true);
				xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xmlhttp.send("emailcheck="+str);
				return;
			}
		}
		function validatepw() {
			var pw = document.getElementById('pw');
			var parent = document.getElementById('pwdiv');
			var span = document.getElementById('pwspan');
			var help = document.getElementById('pwhelp');
			if(pw.value.length < 8 || pw.value.length > 15) {
				parent.className = "form-group has-feedback has-error";
				span.className = "form-control-feedback glyphicon glyphicon-remove";
				help.className = "help-block text-muted";
				pwv = false;
			} else {
				parent.className = "form-group has-feedback has-success";
				span.className = "form-control-feedback glyphicon glyphicon-ok";
				help.className = "help-block text-muted hidden";
				pwv = true;
			}
		}
		function confirmpw() {
			var pw = document.getElementById('pw').value;
			var con_pw = document.getElementById('con_pw').value;
			var parent = document.getElementById('con_pwdiv');
			var span = document.getElementById('con_pwspan');
			var help = document.getElementById('conpwhelp');
			// alert("pw : "+pw+" con_pw : "+con_pw);
			if(pw != con_pw || pw.length == 0) {
				parent.className = "form-group has-feedback has-error";
				span.className = "form-control-feedback glyphicon glyphicon-remove";
				help.className = "help-block text-muted";
				conpwv = false;
			} else {
				parent.className = "form-group has-feedback has-success";
				span.className = "form-control-feedback glyphicon glyphicon-ok";
				help.className = "help-block text-muted hidden";
				conpwv = true;
			}
		}
		function Final() {
			var flag = true;
			if(fnv==false) {
				flag = false;
				validatefn();
			}
			if(emidv==false) {
				flag = false;
				validatemid();
				document.getElementById('fn').focus;
			}
			if(pwv==false) {
				flag = false;
				validatepw();
				document.getElementById('fn').focus;
			}
			if(conpwv==false) {
				flag = false;
				confirmpw();
				document.getElementById('fn').focus;
			}
			return flag;
		}
	</script>
</head>
<body>
	<div class="container">
<?php require 'dist/PHPMailer/PHPMailerAutoload.php';
	// if(isset($_SESSION['']))
	if(isset($_POST['Register']))
	{
		$connect=mysqli_connect('localhost','root','','question_bank');
		$flag=0;
		$email=mysqli_query($connect,"SELECT email_id FROM users");
		while($data=mysqli_fetch_assoc($email)) { // Retrive rows of table into array of data
			if($data['email_id']==$_POST['email_id']) {
				echo '<div class="alert alert-danger"><center>Email is already registered!!</center></div>';
				$flag=1;
			}
		}
		if($flag==0)
		{
			$email=$_POST['email_id'];
			$password=$_POST['password'];
			$user_name=$_POST['first_name'];
			$user_id=$i;
			$last_name=$_POST['last_name'];
			include('mail.php');
			$subject='Verification';
			$link='http://localhost/amoc/verification.php?email='.$email.'&password='.$password.'&user_id='.$user_id.'&first_name='.$user_name.'&last_name='.$last_name;
			$message="Dear ".$user_name."<br/> Please Verify your email id by clicking on this link <a href=".$link.">Here</a>";
			$mail_send=sendmail($email,$subject,$message,$user_name);
			for($i = 0; $mail_send != 1 && $i < 10; $i++) {
				$mail_send=sendmail($email,$subject,$message,$user_name);
			}
			if($mail_send==1) {
				mysqli_query($connect,"INSERT INTO verification(email_id,password)
				VALUES('$email','$password') ");
				$_SESSION['email']=$email;
				$_SESSION['first_name']=$_POST['first_name'];
				$_SESSION['last_name']=$_POST['last_name'];
				$_SESSION['password']=$_POST['password'];
				$_SESSION['user_id']=$i;
				echo '<div class="alert alert-info"><center>Link has been sent to your email address!</center></div>';
			} else {
				echo '<div class="alert alert-info">Sorry! Link can\'t be sent right now! Please try again later...</div>';
			}
		}
	}
?>
		<form class="form-signup form-horizontal" action="sign_up.php"  method="POST">
			<center><h2 class="form-signup-heading">Fill in your details</h2></center>
			<?php if(isset($_SESSION['email_id'])) { echo '<div class="alert alert-warning"><center>Please sign out first !!</center></div>'; } ?>
			<fieldset <?php if(isset($_SESSION['email_id']) || isset($_POST['email_id'])) { echo 'disabled'; } ?> >
			<div id="fndiv" class="form-group has-feedback">
				<label class="control-label col-xs-5 col-sm-4 col-md-3 col-lg-3" for="Fname">First Name : </label>
				<div class="col-xs-7 col-sm-8 col-md-9 col-lg-9">
					<input type="text" name="first_name" id="fn" class="form-control" onblur="validatefn()" onkeyup="validatefn()" placeholder="First name" required><span id="fnspan" class="form-control-feedback glyphicon"></span><span id="fnhelp" class="help-block hidden text-muted"><small>Must enter first name</small></span>
				</div>
			</div>
			<div id="lndiv" class="form-group has-feedback">
				<label class="control-label col-xs-5 col-sm-4 col-md-3 col-lg-3" for="Lname">Last Name : </label>
				<div class="col-xs-7 col-sm-8 col-md-9 col-lg-9">
					<input type="text" name="last_name" id="ln" class="form-control" onkeyup="validateln()" placeholder="Last name"><span id="lnspan" class="form-control-feedback glyphicon"></span>
				</div>
			</div>
			<div id="emiddiv" class="form-group has-feedback">
				<label class="control-label col-xs-5 col-sm-4 col-md-3 col-lg-3" for="Email">Email : </label>
				<div class="col-xs-7 col-sm-8 col-md-9 col-lg-9">
					<input type="email" name="email_id" class="form-control" id="emid" onblur="validatemid()" onkeyup="validatemid()" placeholder="example@host.com" required><span id="emidspan" class="form-control-feedback glyphicon"></span><span id="ajaxpar" class="help-block text-muted"><small id="mailcheck"></small></span>
				</div>
			</div>
			<div id="pwdiv" class="form-group has-feedback">
				<label class="control-label col-xs-5 col-sm-4 col-md-3 col-lg-3" for="Password">Password : </label>
				<div class="col-xs-7 col-sm-8 col-md-9 col-lg-9">
					<input type="password" name="password" id="pw" class="form-control" onblur="validatepw()" onkeyup="validatepw(),confirmpw()" placeholder="Password" required><span id="pwspan" class="form-control-feedback glyphicon"></span><span id="pwhelp" class="help-block hidden text-muted"><small>Password must be 8 to 15 characters long</small></span>
				</div>
			</div>
			<div id="con_pwdiv" class="form-group has-feedback">
				<label class="control-label col-xs-5 col-sm-4 col-md-3 col-lg-3" for="Con_password">Confirm&nbsp;Password&nbsp;: </label>
				<div class="col-xs-7 col-sm-8 col-md-9 col-lg-9">
					<input type="password" name="con_pw" id="con_pw" class="form-control" onblur="validatepw(),confirmpw()" onkeyup="confirmpw(),validatepw()" placeholder="Retype password" requiredx><span id="con_pwspan" class="form-control-feedback glyphicon"></span><span id="conpwhelp" class="help-block hidden text-muted"><small>Passwords must match</small></span>
				</div>
			</div>
			<center>
				<div class="form-group btn-group">
					<button class="btn btn-primary brn-lg center-block" type="submit" id="Submit" onclick="return Final();" name="Register">Submit</button>
					<button class="btn btn-primary brn-lg center-block" type="reset" id="Reset" name="Clear">Clear</button>
				</div>
			</center>
			</fieldset>
		</form>
	</div>



<!-- Placed at the end of the document so the pages load faster
	=============================================================== -->
	<script> window.jQuery || document.write('<script src="dist/js/jquery-2.2.1.min.js"><\/script>') </script>
	<script src="dist/js/bootstrap.min.js"></script>
</body>
</html>