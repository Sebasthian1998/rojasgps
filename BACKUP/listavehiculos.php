<?php
	include("connection.php"); //Establishing connection with our database
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$usuario = $_POST['usuario'];


		$err=0;
		$msg='';

		$sql="select
		  c.clicodcli as Codcli
		 ,l.lcccodcha as Codvhc
		 ,v.vhcalsvhc as Alias
		 ,v.vhccodplc As Placa
		 ,g.gpsimegps As Imei
		 ,g.gpsnumsim As Sim
		 ,v.vchnommdl as Modelo
		 FROM cliente c
		  inner join licencia l
		     on c.clicodcli=l.lcccodcli
		  inner join vehiculo v
		     on l.lcccodcha=v.vhccodchs
		  inner join gps      g
		     on l.lcccodgps=g.gpssregps
		where l.lccflgeli='0'
		and   c.cliflgeli='0'
		and   g.gpsflgeli='0'
		and   v.vhcflgeli='0'
		and   c.clicodcli='".$usuario."'";

		//Check username and password from database
		$result=mysqli_query($db,$sql);
		$row=mysqli_fetch_all($result,MYSQLI_ASSOC);
		//If username and password exist in our database then create a session.
		//Otherwise echo error.
		
		if(mysqli_num_rows($result) >= 1)
		{
			$err=0;
			$msg='';			
		}else
		{
			$err=1;
			$msg='';
		}

  		$response= array('err' => $err , 'msg' => $msg, 'data'=>$row);
  		echo json_encode($response);

	}
?>