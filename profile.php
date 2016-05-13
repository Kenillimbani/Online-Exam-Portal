<?php 
ini_set( 'session.cookie_httponly', 1 );
error_reporting(~E_ALL);
session_start();
if (!isset($_SESSION['email_id'])) {
	header('location:login.php');
}
?>

<html lang="en">
<head>
	<!-- metadata -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link href="dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="dist/css/bootstrap-theme.min.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Josefin+Sans:400,600' rel='stylesheet' type='text/css'>
	<link href="dist/css/custom.css" rel="stylesheet">

	<style type="text/css">
	#edit-data{
		text-align: center;
	}
	.affix {
			top: 0;
			width: 100%;
	}
	div.name{
		/*overflow: auto;
		display: inline-block;*/
		/*font-size: 24pt;*/
		margin-left: 10%;
		padding-top: 5px;
		}
	div.details{
		overflow: auto;
		margin-left: 10%;
		padding-top: 5px;
	}
	a{
		text-decoration: none;
		/*font-size: 11pt;*/
	}
	a:link{
		text-decoration: none;
	}
	span{
		padding: 2px;
		margin: 5px;
	}
	div.panel-group{
		
		width: 50%;
		margin-left: 10%;
		padding-top: 5px;
	}
	p.clg{
		font-family:'Josefin Sans',sans-serif;
		font-size: 12pt;
	}
	p.year{
		font-size: 12pt;
		color:black;
	}
	th{
		text-align: center;
	}
	table{
		margin-top: 1%;

	}
	div.progress{
		margin-left: 10%;
		margin-right: 20%;
		max-height: 20px;
	}
	div.exp{

		border-radius: 15px;
		height: 30px;
		width: 30px;
		background-color: #1874CD;
		text-align: center;
		color: white;
		padding-top: 5px; 
	 /* margin-left: 25%;
		margin-top: 7%;*/
	}
	tr.edit{
		margin:5px;
	}
	td.edit{
		text-align: center;
	}
	div.add-education{
		text-decoration:none;
		text-align: center;
		width: 100%;
		padding: 2%;
		background-color:#6CA6CD;
		color: white ;
	}
	div.add-education:hover{
		background-color: #9BC4E2;
	}
	div.chart{
		margin-left: 5%;
	}
	div.inline-year{
		display:inline-block;
		padding-top: 0px;
		margin-bottom: 10px;
	}
	</style>

</head>

<body style=" font-family:'Josefin Sans',sans-serif;">
<?php
 $connect=mysqli_connect('localhost','root','','question_bank');
	if(!empty($_POST['update-fname']))
	{
		$new=$_POST['update-fname'];
		mysqli_query($connect,"UPDATE users SET first_name='$new' WHERE email_id='$_SESSION[email_id]'");
	}
	if(!empty($_POST['update-lname']))
	{
		$new=$_POST['update-lname'];
		mysqli_query($connect,"UPDATE users SET last_name='$new' WHERE email_id='$_SESSION[email_id]'");
	}
	if(!empty($_POST['update-home']))
	{
		$new=$_POST['update-home'];
		mysqli_query($connect,"UPDATE users SET hometown='$new' WHERE email_id='$_SESSION[email_id]'");
	}
	if(!empty($_POST['exp']))
	{
	 $experience=mysqli_query($connect,"SELECT experience FROM users WHERE email_id='$_SESSION[email_id]'");
	 $data=mysqli_fetch_assoc($experience);
	 if(!empty($data['experience']))
			 $newexp = $data['experience'].';'.$_POST['exp'];
		 else
			 $newexp = $_POST['exp'];
	 mysqli_query($connect,"UPDATE users SET experience='$newexp' WHERE email_id='$_SESSION[email_id]'");
	}

		if(!empty($_POST['clg']))
	{
	 $college=mysqli_query($connect,"SELECT college FROM users WHERE email_id='$_SESSION[email_id]'");
	 $data=mysqli_fetch_assoc($college);
	if(!empty($data['college']))
			 $newexp = $data['college'].';'.$_POST['clg'].';'.$_POST['from'];
		 else
			 $newexp = $_POST['clg'].';'.$_POST['from'];
	if(($_POST['to'])!=1979){
			$newexp = $newexp.'-'.$_POST['to'];
	}
				
	 mysqli_query($connect,"UPDATE users SET college='$newexp' WHERE email_id='$_SESSION[email_id]'");
	}


?>
<!-- Fixed navbar -->
	<nav id="myScrollSpy" class="navbar navbar-inverse" data-spy="affix" data-offset-top="100" style="margin-bottom: 0;z-index: 50;border-radius: 0">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#top"><span class="glyphicon glyphicon-home"></span></a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li><a href="homepage2.php">Home</a></li>
					<li  class="active"><a href="Profile.php">Profile</a></li>
					<li><a href="Dashboard.php">Dashboard</a></li>
					<li><a href="forumhome.php">Forum</a></li>
					<li><a href="#" data-toggle="modal" data-target="#edit">Edit</a></li>
				</ul>
				<div class="container-fluid btn-group pull-right">
					<?php
					if(isset($_SESSION['email_id'])) {
						echo '<button class="btn btn-primary navbar-btn" role="button"><a href="Dashboard.php">'.$_SESSION['first_name'].'</a></button><button class="btn btn-primary navbar-btn" role="button"><a href="login.php?logout=1">Sign Out</a></button>';
						} else {
							echo '<button class="btn btn-primary navbar-btn" role="button"><a href="login.php">Sign In</a></button><button class="btn btn-primary navbar-btn" role="button"><a href="sign_up.php">Sign Up</a></button>';
						} 
					?>
				</div>
			</div><!--/.nav-collapse -->
		</div>
	</nav>
<!-- <nav class="navbar navbar-inverse navbar-fixed-top"  data-spy="affix" data-offset-top="0">
	<ul class="nav navbar-nav">
		<li class="active"><a href="profile.php">Profile</a></li>
		<li><a href="forum_questions.php">Forum</a></li>
		<li><a href="leaderboard.php">LeaderBoard</a></li>
		<li><a href="#" data-toggle="modal" data-target="#edit">Edit</a></li>
		<li><a href="logout.php">Logout</a></li>

	</ul>
</nav> -->
<?php
	$flag=0;
	 $connect=mysqli_connect('localhost','root','','question_bank');
	 $record=mysqli_query($connect,"SELECT * FROM users WHERE email_id='$_SESSION[email_id]'"); //$_SESSION[email_id]
	

	while($data=mysqli_fetch_assoc($record))
	{
			$userid=$data["user_id"];
			$lastname=$data["last_name"];
			$firstname=$data["first_name"];
			$gender=$data["gender"];
			$birthdate=date_format($data["birthdate"],"jS-M-Y");
			if(!empty($data["college"]))
				$clgdata=1;
			else 
				$clgdata=0;
			$clg=explode(";",$data["college"]);
			$length=count($clg);
			$home=$data["hometown"];
			if(!empty($data["experience"]))
				$expdata=1;
			else 
				$expdata=0;
			$exp=explode(";",$data["experience"]);
	}

	 $stats=mysqli_query($connect,"SELECT difficulty*total_marks AS exp FROM exam WHERE u_id=$userid ");
	$progress=0;
	$total=0;
	 while($data=mysqli_fetch_assoc($stats))
				$progress=$progress+$data["exp"];
	$total=$progress/10;
	echo "
						<div class='name'>  <h1>".$firstname." ".$lastname."</h1> </div>
					 ";	
		if($progress<500)
{
		echo "<div class='progress'>
				<div class='progress-bar progress-bar-success' role='progressbar' style='width:$total%'>
				 $total%
			</div>
	</div>";
}  
elseif ($progress<1000) {
	 echo "<div class='progress'>
	<div class='progress-bar progress-bar-info' role='progressbar' style='width:$total%'>
		$total%
	</div>
</div>";
}

elseif ($progress<5000) {
	echo "<div class='progress'>
	<div class='progress-bar progress-bar-warning' role='progressbar' style='width:$total%'>
		$total%
	</div>
</div>";
}
else
{
	echo " <div class='progress'>
									<div class='progress-bar progress-bar-danger' role='progressbar' style='width:$total%'>
									$total%
									</div>";
}

	echo"<div class='details' ><h4>";
	echo "<p class='home'>".$home."</p>";
	echo "<p class='gender'>Gender: ".$gender."</p>";
	echo "<p class='birthdate'>Birth: ".$birthdate."</p></div></h4>";
	echo "<div class='panel-group'>
					<div class='row'>
						<div class='col-sm-8'>
	 <div class='panel panel-primary'>
			<div class='panel-heading'><h4>Education</h4></div>";
			if($length>0){
if($clgdata==1){
		echo "<table> <col width='70%'> <col width='100px'> <tr>  <th> Student At</th>  <th>Year</th> </tr>";
			for($i=0;$i<$length;$i=$i+1){
				if($i%2==0)
					echo "<tr><td class='clg'><p class='clg'><span class='glyphicon glyphicon-chevron-right'> </span> ".$clg[$i]."</p></td>";
				else{

					echo "<td><p class='year'><span class='glyphicon'> </span>".$clg[$i]."</p></td></tr>";
				}
			}
	 echo "   </table>";
 }
 echo"
	 <a href='#' data-toggle='modal' data-target='#modal-edu'><div class='add-education'> Add </div></a>
				</div>
					<br>";
			}
				echo "<div class='panel panel-primary'>
				 <div class='panel-heading'><h4>Experience</h4></div>";
		 if($expdata==1){ $length2=count($exp);
			for($i=0;$i<$length2;$i=$i+1){
					echo "<tr><td class='clg'><p class='clg'><span class='glyphicon glyphicon-chevron-right'> </span> ".$exp[$i]."</p></td>";
			}
		}
		 echo "<a href='#' data-toggle='modal' data-target='#modal-exp'><div class='add-education'> Add </div></a>   
				</div>
				 </div>
					 <div class='col-sm-4'> 
					 <div class='panel panel-primary'>
								<div class='panel-heading'><h4>Post</h4></div>";
			// $post=mysqli_query($connect,"SELECT title FROM forum_questions WHERE u_id=$userid ");
			// $length2=count($post);
								$length2=0;
								if($length2==0){
											echo "<div class='add-education'> No Threads Available </div>     "; 
								}
								else{
			// for($i=0;$i<$length2 && $i<6;$i=$i+1){
			//   if($i%2==0)
			//     echo "<tr><td class='clg'><p class='clg'><span class='glyphicon glyphicon-chevron-right'> </span> ".$post[$i]."</p></td>";
			//   else
			//     echo "<td><p class='year'><span class='glyphicon'> </span>".$post[$i]."</p></td></tr>";
			// }
								}


								//<a href='forum.php'> <div class='add-education'> Add </div></a>
			echo"

				</div>
				</div>
					</div>
					</div>";

?>
<div class="container">
	<div class="modal fade" id="modal-exp" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add</h4>
				</div>
				<div class="modal-body">
				 <form role="form" method="post">
				<div class="form-group">
			<label for="inputlg">Experience:</label>
			<input class="form-control input-lg" id="add-exp" type="text" placeholder="Worked at" name="exp">
		</div>
	<button type="submit" class="btn btn-default">Submit</button>
</form>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="modal fade" id="modal-edu" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add</h4>
				</div>
				<div class="modal-body">
				 <form role="form" method="post">
				<div class="form-group">
					<label for="inputlg">College:</label>
				 <input class="form-control input-lg" id="add-edu" type="text" required=" required" placeholder="Studied at" name="clg" id="clgname">
				</div>
				<div class="form-group">
					<label for="inputlg">Year:</label>
				</div>
						<div class="inline-year">
						<?php
							echo" <select name=from class='form-control input-lg' id='setfrom' required='required'>";
								for($i=1979;$i<=date("Y");$i=$i+1)
								{
									echo "<option>$i</option>";
								} 
							 echo "</select>";
							 ?>
						</div>
						<div class="inline-year">
							 
						</div>
						<div class="inline-year">
								<?php
								$frm=1979;
							echo" <select class='form-control input-lg' name=to id='setto'>";
								for($i=$frm+1;$i<=date("Y");$i=$i+1)
								{
									echo "<option>$i</option>";
								} 
							 echo "</select>";
							 ?>
						</div>
						<br>
	<button type="submit" class="btn btn-default" onclick="From()">Submit</button>
</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
function From() {
		var x = document.getElementById("setfrom");
		if(document.getElementById("setfrom")>document.getElementById("setto"))
		{
			alert("Values of Year are incorrect !");
		}
				var x= document.getElementById("clgname")
		if (!isNaN(x)) 
			{
					alert("Must input Characters");
					return false;
			}
	}
}
function validation(){
		var x= document.getElementById("firstname")
		if (!isNaN(x)) 
			{
					alert("Must input Characters");
					return false;
			}
		var x= document.getElementById("lastname")
		if (!isNaN(x)) 
			{
					alert("Must input Characters");
					return false;
			}

		// var x= document.getElementById("firstname")
		// if (!isNaN(x)) 
		//   {
		//       alert("Must input Characters");
		//       return false;
		//   }

}
</script>
<div class="container">
	<div class="modal fade" id="edit" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Edit</h4>
				</div>
				<div class="modal-body">
				 <form role="form" method="post" id="edit">
				<div class="form-group">
					 <label for="inputlg">First Name:</label>
					 <?php 
					echo "<input class='form-control input-lg' id='add-exp' type='text' value='$firstname' id='firstname' name='update-fname'>";
					?>
			 </div>

			 <div class="form-group">
					 <label for="inputlg">Last Name:</label>
					<?php 
					echo "<input class='form-control input-lg' id='add-exp' type='text' value='$lastname' id='lastname' name='update-lname'>";
					?>
			 </div>

			 <div class="form-group">
					 <label for="inputlg">Hometown:</label>
					 <?php 
					echo "<input class='form-control input-lg' id='add-exp' type='text' value='$home' id='home' name='update-home'>";
					?>
			 </div>

			 <!-- <div>
				<?php
					if($clgdata==1){
								 echo "<table><tr>  <th> Student At</th>  <th>From</th> <th> To </th> </tr>";
					for($i=0;$i<$length;$i=$i+1){
						if($i%2==0)
									echo "<tr class='edit'><td><input class='form-control input-sm' id='add-exp' type='text' value='$clg[$i]' id='clgname'></td>";
								else{
									$frm=explode("-",$clg[$i]);
									echo "<td class='edit'><input class='form-control input-sm' id='edit-data' type='text' value='$frm[0]' id='clgname'></td>";
									echo "<td class='edit'><input class='form-control input-sm' id='edit-data' type='text' value='$frm[1]' id='clgname'></td></tr>";
									
								}
			}
	 echo "</table>";
 }
 echo"<br>";
 echo "<table>";
		 if($expdata==1){
			$length2=count($exp);
			for($i=0;$i<$length2;$i=$i+1){
					echo "<tr><td>".$exp[$i]."</td></tr>";
			}
		}
echo "</table>";
				?>

			 </div>
 -->

			 
	<button type="submit" class="btn btn-default" onclick="validation()">Done</button>
</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Placed at the end of the document so the pages load faster
	=============================================================== -->
	<script> window.jQuery || document.write('<script src="dist/js/jquery.min.js"><\/script>') </script>
	<script src="dist/js/bootstrap.min.js"></script>
</body>
</html>