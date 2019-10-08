<?php
	include("connection.php"); //Establishing connection with our database
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$usuario = $_POST['usuario'];
		$password = $_POST['password'];


		$err=0;
		$msg='';

		//Check username and password from database
		$sql="SELECT * FROM cliente WHERE clicodcli='$usuario' and contra1='$password'";
		$result=mysqli_query($db,$sql);
		$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
		
		if(mysqli_num_rows($result) == 1)
		{
			$err=0;
			$msg='';			
		}else
		{
			$err=1;
			$msg='El usuario o password es incorrecto!';
		}
		$array=array();
		array_push($array,$row);
  		$response= array('err' => $err , 'msg' => $msg, 'data'=>$array);
  		echo json_encode($response);

	}
?>