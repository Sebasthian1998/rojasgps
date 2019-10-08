<?php
	include("check.php");
	$user_check=$_SESSION['username'];

	$sql="select c.clicodcli,c.clinomrzs,v.vhcalsvhc,v.vhccodplc,g.gpsimegps,g.gpsnumsim,date_format(l.lccfchfin,'%Y-%m-%d') as lccfchfin
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
and   c.clicodcli='".$user_check."'";
	$ses_sql = mysqli_query($db,$sql);
	$result=mysqli_fetch_all($ses_sql,MYSQLI_ASSOC);
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

    <script type="text/javascript" src="asset/js/loc/Base.js"></script>    
    <script type="text/javascript" src="asset/js/loc/Res.js"></script>    
    <script type="text/javascript" src="asset/js/loc/Func.js"></script>    
    <script type="text/javascript" src="asset/js/loc/Protocol.js"></script>    
    <script type="text/javascript" src="asset/js/loc/Store.js"></script>    
    <script type="text/javascript" src="asset/js/loc/InitData.js"></script>    

    <script type="text/javascript" src="asset/js/loc/struct/SUserInfo.js"></script>
    <script type="text/javascript" src="asset/js/loc/struct/SCarInfo.js"></script>
    <script type="text/javascript" src="asset/js/loc/struct/SUserOwnCarInfo.js"></script>
    <script type="text/javascript" src="asset/js/loc/struct/SPosition.js"></script> 

</head>

<body>
	<div class="wrapper">
		<div class="infovehiculo">
			<div class="row contleft">
			        <div class="container-fluid">
			            <div class="panel panel-default panel-no-border">
			                <div class="panel-heading">
			                        <h4>Bievenido, <strong><?php echo $login_user;?></strong></h4>
									<a href="logout.php">Salir</a>
			                </div>			            
			                <div class="panel-body">
			                    <div class="row">
			                    	<p style="text-align: center;"><strong>Mis Vehículos </strong></p>
			                    </div>
			                    <div class="row">
									<div class="form-group">
									  <label for="sel1">Modo : <span id="txtmodo"></span></label>
									  <select class="form-control" id="sel1">
			                    		<option value="0">Tracker</option>
			                    		<option value="1">Replay</option>
									  </select>
									</div>
			                    </div>			                    
								<div class="row">
								<div class="table-container list-dispositivos">
								<table class="table table-filter">
									<tbody>
										<?php 
											foreach ($result as $key => $value) {
												$fila='<tr id="'.$value["gpsimegps"].'" class="selrowitem" data-status="pagado" data-field-placa='.$value["vhccodplc"].' data-field-sim='.$value["gpsnumsim"].'><td>';
												$fila=$fila.'<div class="media">';
												$fila=$fila.'<a href="#" class="pull-left"><img src="http://localhost:90/asset/images/icongps.png" class="media-photo"></a>';
												$fila=$fila.'<div class="media-body">';
												$fila=$fila.'<span class="media-meta pull-right">Vence : '.$value["lccfchfin"].'</span>';
												$fila=$fila.'<h4 class="title">'.$value["vhccodplc"].'<span class="pull-right pagado">('.$value["vhcalsvhc"].')</span></h4>';
												$fila=$fila.'<p class="summary">'.$value["gpsnumsim"].'</p>';
												$fila=$fila.'</div>';
												$fila=$fila.'</div>';
												$fila=$fila.'</td></tr>';
												echo $fila;
											}
										?>
									</tbody>
								</table>	
									</div>
								</div>			                    
			                </div>
			            </div>
			        </div>
			</div>
		</div>

		<div class="inftime">
			    <table class="Style_PosInfo_Refresh" border="0">
			    	<tbody><tr>
			    		<td align="right" id="ID_Time_Value" style="color:#000;width: 33%">2016-12-12 17:24:19</td>
			    		<td align="left" style="color:#000;width: 33%;text-align: center;">
			    		    <span id="ID_Online_Value">Online</span>
			    		</td>
			    		<td align="left" id="ID_DelayRate_Value" style="color:#000;padding-right:0.5em;width: 33%">7 Sencond later update</td>
			    	</tr>
			    </tbody></table>


			    <div style="background: #fff" id="cont-replay">
					<div style="width:100%;height:0px;border-bottom:solid 1px #ffffff;border-top:solid 1px #bbbbbb;"></div>
					<table border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;background-color:#f6f6f6;">
						<tbody><tr>
								<td style="width:100%;height:1.8em;padding-left:0.4em;padding-right:0.5em;">
									<input id="ID_RangeRate" type="range" onchange="oReplay.Drag();" min="0" max="1" value="0" style="width:100%;margin:0em;padding:0em;">
								</td>
								<td onclick="oReplay.Click(this);" style="padding:0.4em;" align="center">
									<img id="ID_BtnAction" style="height:1em;" src="http://localhost:90/asset/images/icon_pause.png">
								</td>
								<td>&nbsp;</td>
							</tr>
						</tbody>
					</table>
					<div style="width:100%;height:0px;border-bottom:solid 1px #ffffff;border-top:solid 1px #bbbbbb;"></div>
					<div class="TableForm" style="margin:0px;border:0px;">
						<table class="Body" cellpadding="0" cellspacing="0" style="">
							<tbody><tr class="Top">
								<td style="padding:0.4em;">
									<input id="ID_SelectDate" name="SelectDate" type="date" class="Style_Normal_Input" style="margin:0em;width:90%;">  
								</td>
								<th style="padding:0.5em;padding-left:1em;padding-right:1em;" align="center" valign="middel">
									<input id="ID_Botton_Download" type="submit" class="Style_Normal_Input" style="width:100%;height:2.2em;" value="Descargar">
								</th>
							</tr>
						</tbody></table>
					</div>
				</div>

		</div>
		
		<div class="infodisp contright">
			<div class="container-fluid cont-fluid-infgps">
				<div class="panel panel-default panel-no-border">
					<div class="panel-heading">                        	
	                </div>	
					<div class="panel-body">
						<div class="row">
	                    	<p style="text-align: center;"><strong>Información de GPS </strong></p>
	                    </div>

						<div class="row">
			                    	<div class="table-container list-infogps">
			                    	<table class="table table-infogps">
			                    		<tbody>
			                    			<tr>
			                    				<td><span class="">Nro Placa</span></td>
			                    				<td><span id="ID_CarNum_Value" class="bold"></span></td>
			                    			</tr>
			                    			<tr>
			                    				<td>IMEI </td>
			                    				<td><span id="ID_TEID_Value" class="bold"></span></td>
			                    			</tr>
			                    			<tr>
			                    				<td>Nro Sim </td>
			                    				<td id="ID_NroSim_Value" class="bold"></td>
			                    			</tr>			                    			
			                    			<tr>
			                    				<td>Km. / Recorr. </td>
			                    				<td><span id="ID_Mileage_Value" class="bold"></span></td>
			                    			</tr>
			                    			<tr>
			                    				<td>Temp (℃). </td>
			                    				<td id="ID_Temp_Value"></td>
			                    			</tr>
			                    			<tr>
			                    				<td>Velocidad(Km/h)</td>
			                    				<td id="ID_Speed_Value"></td>
			                    			</tr>
			                    			<tr>
			                    				<td>Logintud</td>
			                    				<td id="ID_Lat_Value"></td>
			                    			</tr>
			                    			<tr>
			                    				<td id="ID_Lat_Text">Latitud</td>
			                    				<td id="ID_Lon_Value"></td>
			                    			</tr> 
			                    		</tbody>
			                    	</table>
			                    	</div>
			                </div>

					</div>	                
				</div>
			</div>
		</div>

		<div class="infoaddres">
			<div>
				<span id="ID_Address" class="bold">Dirección</span>
			</div>			
		</div>

		<!--<div class="contbuttom">
			<button id="buttonmap" class="btn">&times;</button>
		</div>-->

		<div id="ID_Map_Content"></div>
	</div>
</body>
</html>
<script>
	var nRamainSec = 0;
	$(document).ready(function()
	{

		var timerId = 0;
		var oMap = null;
	   	var arrHistoryPos = [];
	   	var rangosecond=1000;
	   	var secondinit=10;
	   	var rangoupdate=secondinit;

	   	var gpstracker=
	   	{
	   		init: function()
	   		{
				MGTS.InitMap( function() 
				    {
				        oMap = new MGTS.CMap({
				            m_strDiv        :   'ID_Map_Content',
				            m_oCenter       :   {   m_nLon : MGTS.Config.nInitLon,  m_nLat : MGTS.Config.nInitLat   },
				            m_nZoom         :   MGTS.Config.nInitZoom
				        });


						var idn, wplaca;
						$("table.table-filter tbody tr").each(function (index) {
								$(this).toggleClass('selected');
								idn=($(this).attr('id'));
								grand_idn=idn;
								return false;
				         });

				        gpstracker.ShowPos(idn);
						//var closeButton = $("#buttonmap");	        
				});

				MGTS.LoadLang( gpstracker.SetBarPosInfoLang() );

	   			timerId=setInterval( function()
						{
						    nRamainSec++;
						    if( nRamainSec > rangoupdate )
						    {
						        nRamainSec = 0;

						        var idn;			
								$("table.table-filter tbody tr").filter(".selected").each(function (index){
										idn=($(this).attr('id'));
										return false;
								});
								//CargaInicial();

						        gpstracker.ShowPos(idn);
						        return;
						    }
						    gpstracker.SetDelayRateInfo( ( (rangoupdate+1) -nRamainSec ) + " "  );
						}, rangosecond );


			    oReplay = {
				    m_isLoaded	:	false,
				    m_isPlay	:	false,
				    m_arrPos	:	[],
				    m_nCurRate	:	-1,
				    m_strMarkerName	:	null,
				    m_oSosoMap	:	null
			    };


			    /***********************/
				oReplay.Init = function( arrPos ) 
				    {
					    if ( arrPos == null ) 
					    {
						    oReplay.m_arrPos	= [];
						    oReplay.m_nCurRate	= -1;
						    oReplay.m_isLoaded	= false;
						    oReplay.m_isPlay	= false;
						    oReplay.m_strMarkerName	= null;
						    oReplay.SetState();
				    		
						    return;
					    }
				    	
					    oReplay.m_arrPos	= arrPos;
					    oReplay.m_nCurRate	= 0;
					    oReplay.m_isLoaded	= true;
					    oReplay.m_isPlay	= false;
					    oReplay.m_strMarkerName	= null;
					    oReplay.SetState();
				    }

				    //-------------------------
				    // ����״̬
				    oReplay.SetState = function() 
				    {
					    if ( oReplay.m_strMarkerName == null ) 
					    {
						    return;
					    }
					    //----- ������
					    $( '#ID_RangeRate' ).attr( 'min', 1 );
					    $( '#ID_RangeRate' ).attr( 'max', oReplay.m_arrPos.length );
					    $( '#ID_RangeRate' ).attr( 'value', oReplay.m_nCurRate + 1 );
				    	
					    //----- ��λ
					    var oPos = oReplay.m_arrPos[oReplay.m_nCurRate];
					    if ( oPos == null ) 
					    {
						    return;
					    }
				    	
					    //----- ��Ϣ����
					    gpstracker.SetTopBarPosInfo( oPos );
					    $( '#ID_DelayRate_Value' ).text( oReplay.m_nCurRate + " / " + oReplay.m_arrPos.length );
				    }

				    //-------------------------
				    // ��ק
				    oReplay.Drag = function() 
				    {
					    var nRate = $( '#ID_RangeRate' ).val();
					    oReplay.m_nCurRate = nRate;
					    oReplay.Show();
				    }
				    
				    //-------------------------
				    // ���
				    oReplay.Click = function( self ) 
				    {
					    // ��ɫ
					    self.style.backgroundColor = "#dddddd";
					    setTimeout( function()
					    {
						    self.style.backgroundColor = "";
					    }, 500 );
				    	
					    if ( oReplay.m_isLoaded == false ) 
					    {
						    return;
					    }
					    //----- ֹͣ
					    if ( oReplay.m_isPlay ) 
					    {
						    oReplay.Stop();
					    }
					    //----- ����
					    else
					    {
						    oReplay.Play();
					    }	
				    }

				    //-------------------------
				    // ����
				    oReplay.Play = function() 
				    {
					    if ( oReplay.m_isLoaded == false ) 
					    {
						    return;
					    }
				    	
				        // �������ֹͣ
				        if( oReplay.m_nCurRate >= oReplay.m_arrPos.length )
				        {
						    oReplay.m_nCurRate = 0;
				        }
				    	
					    oReplay.m_isPlay	= true;
					    console.log(oReplay.m_arrPos.length);
					    oReplay.Refresh();
					    $( '#ID_BtnAction' ).attr( "src", "http://localhost:90/asset/images/icon_pause.png" );
				    }

				    //-------------------------
				    // ֹͣ
				    oReplay.Stop = function() 
				    {
					    if ( oReplay.m_isLoaded == false ) 
					    {
						    return;
					    }
					    oReplay.m_isPlay	= false;
					    $( '#ID_BtnAction' ).attr( "src", "http://localhost:90/asset/images/icon_play.png" );
				    }

				    //-------------------------
				    // ��ʾ
				    oReplay.Refresh = function()
				    {
					    if ( oReplay.m_isLoaded == false || oReplay.m_isPlay == false ) 
					    {
						    return;
					    }

				    
					    //----- ����ֹͣ�Զ���ʼ��
				        if( oReplay.m_nCurRate >= oReplay.m_arrPos.length )
				        {
						    oReplay.m_nCurRate = 0;
						    oReplay.Stop();
						    return;
				        }
				    	
					    //----- ��ǰ�㾲ֹ�������ʾ
				        var oPos = oReplay.m_arrPos[ oReplay.m_nCurRate ];
				        if ( oPos == null || oPos.m_nSpeed < 2 ) 
				        {
						    oReplay.m_nCurRate++;
						    oReplay.Refresh();
						    return;
				        }
				        
					    oReplay.Show();

					    //----- ѭ������
					    setTimeout( oReplay.Refresh, 300 );
				    }

				    //-------------------------
				    // ˢ��
				    oReplay.Show = function() 
				    {
				        //----- ���õ�ǰλ��
				        oReplay.m_nCurRate++;
				        
				        var nMaxLen	= oReplay.m_arrPos.length;
				        
				        // �������ֹͣ
				        if( oReplay.m_nCurRate >= nMaxLen )
				        {
						    oReplay.m_nCurRate = 0;
						    oReplay.Stop();
				        }
				        else if ( oReplay.m_nCurRate < 0 ) 
				        {
						    oReplay.m_nCurRate = 0;
				        }
				        
				        // ��ǰ��
				        var oPos = oReplay.m_arrPos[ oReplay.m_nCurRate ];
				    	
					    //----- ɾ��֮ǰ��
					    if( oReplay.m_strMarkerName != null )
					    {
						    oMap.RemovePosition({
						        strName :   oReplay.m_strMarkerName
						    });
						    oReplay.m_strMarkerName = null;
					    }

				        //----- ��ʾ��λ
				        var oData = {   
				            m_nLon  :  oPos.m_dbLon,
				            m_nLat  :  oPos.m_dbLat
				        };
				      
						$("table.table-filter tbody tr").filter(".selected").each(function (index){
								idn=($(this).attr('id'));
								wnroplaca=($(this).attr('data-field-placa'));
								return false;
						});

		            setTimeout( function()
		            {
					    oMap.AddPosition({
					        strImageURL	:	oPos.GetImageURL(),
					        oLonLat	    :	oData,
					        nDir		:	oPos.m_nDirection,
					        strName		:	oPos.m_strTEID,
					        strCarNum	:	wnroplaca,
					        iSpeedy		:  	oPos.m_nSpeed,

				        }); 
				        oReplay.m_strMarkerName = '_posName';
				    		
					    //----- ����
					    oMap.SetCenter( oData.m_nLon, oData.m_nLat );
					    oReplay.SetState();

		            }, 100 );					    
				    	
					    //----- ��ȡ��ַ
					    oMap.GetAddressByLonLat( oPos.m_dbLon, oPos.m_dbLat, function( strAddress )
					    {
						    //$( "#ID_Address" ).html( strAddress );
						    $( "#ID_Address" ).html( "" );
					    });
				    	
				    }
				    /************/


	   			gpstracker.event();	 
  	
	   			$("#cont-replay").hide();

	   		}
	   		,event:function()
	   		{
				    $('.selrowitem').on('click', function () {
				     $(".selrowitem").removeClass("selected");
				      $(this).toggleClass('selected');
				      idn=($(this).attr('id'));
				      	//Refresco las Lineas
						oMap.RemoveAllLine();
						arrHistoryPos=[];
						nRamainSec=0;
				        gpstracker.ShowPos(idn);
				    });

				    $("#sel1").change(function()
				    {
				    	if ($(this).val()=="0")
				    	{


				    		rangoupdate=secondinit;
				    		nRamainSec=0;
				    		$("#cont-replay").hide();
				    		$("#ID_Online_Value").show();

							$("table.table-filter tbody tr").each(function (index) {
									$(".selrowitem").removeClass("selected");
									$(this).toggleClass('selected');
									idn=($(this).attr('id'));
									grand_idn=idn;
									return false;
					         });

					        gpstracker.ShowPos(idn);

		   					timerId=setInterval( function()
							{
							    nRamainSec++;
							    if( nRamainSec > rangoupdate )
							    {
							        nRamainSec = 0;

							        var idn;			
									$("table.table-filter tbody tr").filter(".selected").each(function (index){
											idn=($(this).attr('id'));
											return false;
									});
									//CargaInicial();

							        gpstracker.ShowPos(idn);
							        return;
							    }
							    gpstracker.SetDelayRateInfo( ( (rangoupdate+1) -nRamainSec ) + " "  );
							}, rangosecond );				    		
				    	}
				    	else
				    	{
				    		$("#cont-replay").show();
				    		$("#ID_Online_Value").hide();
							clearInterval(timerId);

							oMap.RemoveAllLine();
							arrHistoryPos=[];
						    oMap.RemovePosition({
						        strName :   "_PositionMark"
						    });							

				    	}
				    });

				    $("#ID_Botton_Download").click(function()
				    {
				    	$(this).attr('disabled','disabled');
				    	$("#sel1").attr('disabled','disabled');
				    	gpstracker.Download();
				    });
	   		}
	   		,SetBarPosInfoLang: function()
	   		{
	   			$( "#ID_Lat_Text" ).text( MGTS.Lang.Lat );
	   		}
	   		,ShowPos: function(idn)
	   		{

				MGTS.Database( MGTS.Protocol.CreateCmd_GetPos( idn), function( oJson ) 
		        {
		            if( oMap == null || typeof( oJson ) != "object" )
		            {
		                return;
		            }
		            var arrPos = MGTS.Struct.ParsePosition( oJson );
		            if( arrPos == null || arrPos.length < 1 )
		            {
		                MGTS.Alert( MGTS.Lang.CarNoPositionData );
		                return;            
		            }
		            MGTS.Store.PushPos( arrPos );
		            
		            var oPos = arrPos[0];
					oPos = MGTS.Func.GPSCorrect( oPos );
		        
		            //----- ������Ϣ
		            gpstracker.SetTopBarPosInfo( oPos );
		            
		            //----- ����
		            arrHistoryPos.push({ 
			            m_nLon  :   oPos.m_dbLon,
			            m_nLat  :   oPos.m_dbLat 
		            });
		            
		            //#00ff00

		            oMap.AddLine({
						strColor	:	"#c72c2c",
						strWeight	:	5,
		                arrLonLat   :   arrHistoryPos
		            });
		            
		            var wnroplaca;
					$("table.table-filter tbody tr").filter(".selected").each(function (index){
							idn=($(this).attr('id'));
							wnroplaca=($(this).attr('data-field-placa'));
							return false;
					});


					if ($("#sel1").val()=="0")
					{
						//----- ��λͼ��, �ӳ���ʾ, ��ֹ����ͼ������ʾ
			            setTimeout( function()
			            {
							oMap.AddPosition({
								strImageURL	:	oPos.GetImageURL(),
								oLonLat	    :	{   m_nLat:oPos.m_dbLat, m_nLon:oPos.m_dbLon },
								nDir		:	oPos.m_nDirection,
								strCarNum	:	wnroplaca,
								iSpeedy		:  	oPos.m_nSpeed,
							}); 
							
							//----- ��ͼ����
							oMap.SetCenter( oPos.m_dbLon, oPos.m_dbLat );
				            
			            }, 100 );
			 	

			 	        //----- ������ַ
			            oMap.GetAddressByLonLat( oPos.m_dbLon, oPos.m_dbLat, function( strAddress )
			            {
				            document.getElementById( "ID_Address" ).innerHTML = strAddress;
			            });
					}		             
		        });
	   		}
	   		,SetTopBarPosInfo:function(oPos)
	   		{
				if( typeof( oPos ) != "object" ) 
				    {
				    	return;
				    }

				    var wnroplaca="";
				    var wnroserie="";
				    var wnrosim="";

				    
					$("table.table-filter tbody tr").filter(".selected").each(function (index){
							wnroplaca=($(this).attr('data-field-placa'));						
							wnroserie=($(this).attr('data-field-serie'));
							wnrosim=($(this).attr('data-field-sim'));
							return false;
					});	
						    
				    
				    $('#ID_CarNum_Value' ).text( wnroplaca	);
				    $("#ID_NroSim_Value").text(wnrosim);
				    //$("#ID_Serie_Value").text(wnroserie);

				    $( '#ID_Time_Value' ).text( MGTS.Func.GetStrTime( oPos.m_nTime ) );  

				    $( '#ID_TEID_Value' ).text( oPos.m_strTEID );
				    $( '#ID_Online_Value' ).html( MGTS.Func.GetOnlineState( oPos ) );
				    
				    $( '#ID_Speed_Value' ).text( oPos.m_nSpeed );
				    $( '#ID_Dir_Value' ).text( oPos.m_nDirection );
				    
				    $( '#ID_Mileage_Value' ).text( ( oPos.m_nMileage / 1000 ).toFixed( 1 ) );
				    $( '#ID_TEState_Value' ).text( oPos.m_strTEState );
				    
				    $( '#ID_Fuel_Value' ).text( oPos.m_nFuel * ( oPos.m_nFuelBoxSize * 0.01 ).toFixed( 2 ) );
				    $( '#ID_CarState_Value' ).text( oPos.m_strCarState );
				    
				    $( '#ID_Temp_Value' ).text( ( oPos.m_nTemp * 0.1 ).toFixed( 1 ) );
				    $( '#ID_AlarmState_Value' ).text( oPos.m_strAlarmState );
				    
				    $( '#ID_GSMSignal_Value' ).text( oPos.m_nGSMSignal );
				    $( '#ID_Lon_Value' ).text( oPos.m_dbLon );
				    
				    $( '#ID_GPSSignal_Value' ).text( oPos.m_nGPSSignal );
				    $( '#ID_Lat_Value' ).text( oPos.m_dbLat );	   			
	   		}

	   	 ,SetDelayRateInfo: function(strText)
	   	 {
        	$("#ID_DelayRate_Value").html( strText + "Segundos para la actualización" );	   	 	
	   	 }

	   	 ,Download: function()
	   	 {

		        var idn;			
				$("table.table-filter tbody tr").filter(".selected").each(function (index){
						idn=($(this).attr('id'));
						return false;
				});

		        //----- ����ʱ��
		    	var strTEID		= idn;//MGTS.Config.strCurTEID;
			    var strDate		= $("#ID_SelectDate").val();
			    
			    var oTime		= new Date();
			    if ( strDate == "undefined" ) 
			    {
				    oTime.setHours( 0, 0, 0 );
			    }
			    else
			    {
				    var nY	= strDate.substr( 0, 4 );
				    var nM	= strDate.substr( 5, 2 ) - 1;
				    var nD	= strDate.substr( 8, 2 );
		    		
				    oTime	= new Date( nY, nM, nD, 0, 0, 0 );
			    }
			    var strReQuestTime	= MGTS.Func.GetStrTime( oTime );
			    var nStartTime		= parseInt( oTime.getTime() / 1000 );
			    var nEndTime		= parseInt( nStartTime + 24 * 60 * 60 );			    


			    /**Bloquear Opciones*/

			    //----- ���ع켣
			     MGTS.Database( MGTS.Protocol.CreateCmd_GetTrack( strTEID, nStartTime, nEndTime ), function( oJson ) 
		        {
		           
		        	/**Borrar Opciones **/

		            var arrPos = MGTS.Struct.ParsePosition( oJson );
		            if( arrPos == null || arrPos.length < 1 )
		            {
		                MGTS.Alert( MGTS.Lang.CarNoPositionData );
		                return;            
		            }
		      
		            //----- ���ɹ켣��
		            var arrData  	= [];
		            var nLenPos		= arrPos.length;
		            for( var n = 0; n < nLenPos; n++ )
		            {
				        if( arrPos[n] == null )
				        {
					        continue;
				        }
					
				        arrData.push({ 
				            m_nLon  :   arrPos[n].m_dbLon,
				            m_nLat  :   arrPos[n].m_dbLat 
			            });
		            }
		    
		            //----- ��ͼ���е�һ����
		            if( arrData.length > 0 )
		            {
		                oMap.SetCenter( arrData[0].m_nLon, arrData[0].m_nLat );
		            }
		            
		            //----- ���켣��
		            oMap.AddLine({
		                arrLonLat   :   arrData
		            });
		            
		            //----- ��ʼ����ʾ
		            oReplay.Init( arrPos );
			        oReplay.Show();
			        oReplay.Stop();
		        });	   	 	
	   	 	}
	   	}

	   	gpstracker.init();		   	

});

</script>