<?php
	include('login.php'); // Include Login Script

	if ((isset($_SESSION['username']) != '')) 
	{
		header('Location: home.php');
	}	
	

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo NOM_WEB ?></title>
	<link rel="stylesheet" type="text/css" href="asset/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="asset/css/style.css">
	<script src="asset/js/jquery-3.2.1.min.js"></script>
	<script src="asset/js/bootstrap.min.js"></script>
</head>

<body>
		<div class="container">
		    <div class="row vertical-offset-100">
		    	<div class="col-md-4 col-md-offset-4">
		    		<div class="panel panel-default">
		    			<img class="imginicio" src="http://www.rojasgps.com/asset/images/logo_index.png">
					  	<div class="panel-heading">
					    	<h3 class="panel-title">Login</h3>
					 	</div>
					  	<div class="panel-body">
					    	<form accept-charset="UTF-8" role="form" method="post" action="">
			                    <fieldset>
						    	  	<div class="form-group">
						    		    <input class="form-control" placeholder="Usuario" name="username" type="text" required>
						    		</div>
						    		<div class="form-group">
						    			<input class="form-control" placeholder="Password" name="password" type="password" value="" required>
						    		</div>
						    		<input class="btn btn-lg btn-success btn-block" type="submit" name="submit" value="Ingresar">
						    	</fieldset>	

								
								<div class="row" style="text-align: center;padding-top: 10px; color: #b5414c">
									<?php echo $error;?>
								</div>  								
					      	</form>
					    </div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>   