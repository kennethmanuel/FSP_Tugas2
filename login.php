<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<style type="text/css">
		#container{
			text-align: center;
		}
	</style>
</head>
<body>
	<div id="container">
		<div id="title">
			<h1>Welcome to Tictactoe</h1>
		</div>
		<div>
			<h3>Choose circle/cross</h3>
		</div>
		<div id="form">
			<form action="index.php" method="POST">
				<input id="radio_circle" type="radio" value="circle" name="role" checked="checked">
        		<label for="radio_circle">Circle</label>

        		<input id="radio_cross" type="radio" value="cross" name="role">
        		<label for="radio_cross">Cross</label><br><br>
        		<input type="submit" name="btnsubmit" value="START">
			</form>
		</div>
	</div>		
</body>
</html>