<?php
ini_set( 'session.cookie_httponly', 1 );
session_start();
if (!isset($_SESSION['email_id'])) {
		header('location:login.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Crop the Image</title>
	<style type="text/css">
		#photo {
			width: 500px;
			max-width: 500px;
			max-height: 500px;
			margin: 0 0.3em
			padding: 10px;
		}
	</style>
	<link rel="stylesheet" type="text/css" href="dist/css/imgareaselect-default.css" />
	<link href="dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="dist/css/bootstrap-theme.min.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Josefin+Sans' rel='stylesheet' type='text/css'>
</head>
<body>
	<div class="container">
		<div id="crop"></div>
		<button id="RC" class="btn">Crop</button>
		<form id="crp" class="form-inline" action="crop.php" method="POST">
			<div class="row">
				<input name="imagebase64" id="imagebase64" type="hidden" >
			</div>
		</form>
	</div>
	

<!-- Placed at the end of the document so the pages load faster
	=============================================================== -->
	<script> window.jQuery || document.write('<script src="dist/js/jquery-2.2.1.min.js"><\/script>') </script>
	<script src="dist/js/bootstrap.min.js"></script>
	
	<script type="text/javascript">
			var el = document.getElementById('crop');
			var vanilla = new Croppie(el, {
				viewport: {
					width: 200,
					height: 200,
					type: 'circle'
				},
				boundary: {
					width: 300,
					height: 300
				},
				enableZoom: true,
				showZoomer: true,
				mouseWheelZoom: true,
				update: function (cropper) { }
			});
			vanilla.bind('<?php echo "IMG/".$_SESSION['email_id'].".original.jpg" ?>');
			//on button click
			//vanilla.result('canvas,viewport,jpeg');
			$('#RC').on('click', function(ev) {
				vanilla.result({type:'canvas',size:'original',format:'jpeg'}).then(function (resp) {
					$('#imagebase64').val(resp);
					// console.log(resp);
					// console.log(img.points);
					// $('input[name="x1"]').val(point[0]);
					// $('input[name="y1"]').val(point[1]);
					// $('input[name="x2"]').val(point[2]);
					// $('input[name="y2"]').val(point[3]);
					$('#crp').submit();
				});
			});
			// get crop points from croppie
			// var data = vanilla.get();
			// get result from croppie
			// returns Promise
			// var result = vanilla.result('canvas').then(function (img) {
				//img is html positioning & sizing the image correctly if resultType is 'html'
				//img is base64 url of cropped image if resultType is 'canvas' 
			// });
		</script>
</body>
</html>