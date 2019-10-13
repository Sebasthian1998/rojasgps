<?php
namespace PortoContactForm;
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'php/simple-php-captcha/simple-php-captcha.php';
require 'php/php-mailer/src/PHPMailer.php';
require 'php/php-mailer/src/SMTP.php';
require 'php/php-mailer/src/Exception.php';

// Step 1 - Enter your email address below.
$email = 'server@rojasgps.com';

// If the e-mail is not working, change the debug option to 2 | $debug = 2;
$debug = 0;

if(isset($_POST['emailSent'])) {

	// If contact form don't has the subject input change the value of subject here
	$asunto=( isset($_POST['asunto']) ) ? $_POST['asunto'] : 'no definido';
	$nombre=( isset($_POST['nombre']) ) ? $_POST['nombre'] : '';
	$subject ="Formulario de contacto".' - '.$nombre;

	// Step 2 - If you don't want a "captcha" verification, remove that IF.
	if (strtolower($_POST['captcha']) == strtolower($_SESSION['captcha']['code'])) {

		$message = '';

		foreach($_POST as $label => $value) {
			if( !in_array( $label, array( 'emailSent', 'captcha' ) ) ) {
				$label = ucwords($label);

				// Use the commented code below to change label texts. On this example will change "Email" to "Email Address"

				// if( $label == 'Email' ) {               
				// 	$label = 'Email Address';              
				// }

				// Checkboxes
				if( is_array($value) ) {
					// Store new value
					$value = implode(', ', $value);
				}

				$message .= $label.": " . htmlspecialchars($value, ENT_QUOTES) . "<br>\n";
			}
		}
		
		$message.="<br>\n"."<br>\n"."Este correo ha sido enviado desde el formulario de contactenos de la página web http://rojasgps.com/";

		$mail = new PHPMailer();

		try {

			$mail->SMTPDebug = $debug;                            // Debug Mode

			// Step 3 (Optional) - If you don't receive the email, try to configure the parameters below:

			//$mail->IsSMTP();                                         // Set mailer to use SMTP
			//$mail->Host = 'mail.rojasgps.com';				       // Specify main and backup server
			//$mail->SMTPAuth = true;                                  // Enable SMTP authentication
			//$mail->Username = 'server@rojasgps.com';                    // SMTP username
			//$mail->Password = 'Administrador18+';                              // SMTP password
			//$mail->SMTPSecure = 'ssl';                               // Enable encryption, 'ssl' also accepted
			//$mail->Port = 587;   								       // TCP port to connect to

			$mail->AddAddress($email);	 						       // Add a recipient
			$mail->AddAddress('acastaneda@rojasgps.com', 'Andrea');    // Add another recipient
			$mail->AddAddress('rrojas@rojasgps.com', 'Ricardo');       // Add another recipient
			
			//$mail->AddCC('raaularteagapereyra@gmail.com', 'Ricardo');				// Add a "Cc" address. 
			//$mail->AddAddress('raularteagapereyra@rojasgps.com', 'System');         // Add a "Bcc" address. 

			// From - Name
			$fromName = ( isset($_POST['name']) ) ? $_POST['name'] : 'Website User';
			$mail->SetFrom($email, $fromName);

			// Repply To
			if( isset($_POST['email']) ) {
				$mail->AddReplyTo($_POST['email'], $fromName);
			}

			$mail->IsHTML(true);                                  		// Set email format to HTML

			$mail->CharSet = 'UTF-8';

			$mail->Subject = $subject;
			$mail->Body    = $message;

			// Step 4 - If you don't want to attach any files, remove that code below
			if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] == UPLOAD_ERR_OK) {
				$mail->AddAttachment($_FILES['attachment']['tmp_name'], $_FILES['attachment']['name']);
			}

			$mail->Send();

			$arrResult = array ('response'=>'success');

		} catch (Exception $e) {
			$arrResult = array ('response'=>'error','errorMessage'=>$e->errorMessage());
		} catch (\Exception $e) {
			$arrResult = array ('response'=>'error','errorMessage'=>$e->getMessage());
		}

	} else {

		$arrResult = array ('response'=>'captchaError');

	}

}
?>
<!DOCTYPE html>
<html>
	<head>

		<!-- Basic -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">	

		<title>CONTÁCTENOS - ELECTRÓNICA AUTOMOTRIZ ROJAS</title>	

		<meta name="keywords" content="HTML5 Template" />
		<meta name="description" content="ELECTRÓNICA AUTOMOTRIZ ROJAS">
		<meta name="author" content="rojasgps.com">
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
		<link rel="apple-touch-icon" href="img/apple-touch-icon.png">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">

		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light%7CPlayfair+Display:400" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="vendor/fontawesome-free/css/all.min.css">
		<link rel="stylesheet" href="vendor/animate/animate.min.css">
		<link rel="stylesheet" href="vendor/simple-line-icons/css/simple-line-icons.min.css">
		<link rel="stylesheet" href="vendor/owl.carousel/assets/owl.carousel.min.css">
		<link rel="stylesheet" href="vendor/owl.carousel/assets/owl.theme.default.min.css">
		<link rel="stylesheet" href="vendor/magnific-popup/magnific-popup.min.css">

		<!-- Theme CSS -->
		<link rel="stylesheet" href="css/theme.css">
		<link rel="stylesheet" href="css/theme-elements.css">
		<link rel="stylesheet" href="css/theme-blog.css">
		<link rel="stylesheet" href="css/theme-shop.css">

		<!-- Current Page CSS -->
		<link rel="stylesheet" href="vendor/rs-plugin/css/settings.css">
		<link rel="stylesheet" href="vendor/rs-plugin/css/layers.css">
		<link rel="stylesheet" href="vendor/rs-plugin/css/navigation.css">
		
		<!-- Demo CSS -->


		<!-- Skin CSS -->
		<link rel="stylesheet" href="css/skins/skin-corporate-7.css"> 

		<!-- Theme Custom CSS 
		<link rel="stylesheet" href="css/custom.css">-->
		<link rel="stylesheet" href="styles.css">
		<!-- Head Libs -->
		<script src="vendor/modernizr/modernizr.min.js"></script>

		<style>
		    .sticky-header-active .header-logo img
		    {
		        width:80px !important;
		    }
		</style>

	</head>
	<body >
	<div class="CARGADOR1" id="carga"></div>
		<!--class="loading-overlay-showing" data-plugin-page-transition data-loading-overlay data-plugin-options="{'hideDelay': 500}"
			<div class="loading-overlay">
			<div class="bounce-loader">
				<div class="bounce1"></div>
				<div class="bounce2"></div>
				<div class="bounce3"></div>
			</div>
		</div> -->
	<div class="TODO" id="TODO">
		<div class="body">
			<header id="header" class="header-effect-shrink" data-plugin-options="{'stickyEnabled': true, 'stickyEffect': 'shrink', 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': true, 'stickyChangeLogo': true, 'stickyStartAt': 30, 'stickyHeaderContainerHeight': 70}">
				<div class="header-body border-top-0 bg-dark box-shadow-none">
					<div class="header-container container">
						<div class="header-row">
							<div class="header-column">
								<div class="header-row">
									<div class="header-logo">
										<a href="index.php">
											<img alt="Electrónica Automotriz Rojas" width="165" src="img/logo_rojas.png">
										</a>
									</div>
								</div>
							</div>
							<div class="header-column justify-content-end">
								<div class="header-row">
									<div class="header-nav header-nav-links header-nav-dropdowns-dark header-nav-light-text order-2 order-lg-1">
										<div class="header-nav-main header-nav-main-mobile-dark header-nav-main-square header-nav-main-dropdown-no-borders header-nav-main-effect-2 header-nav-main-sub-effect-1">
											<nav class="collapse">
												<ul class="nav nav-pills" id="mainNav">
													<li class="dropdown">
														<a class="dropdown-item dropdown-toggle" href="index.php">
															Home
														</a>
													</li>
													<li class="dropdown dropdown-mega">
														<a class="dropdown-item dropdown-toggle" href="nosotros.php">
															Nosotros
														</a>
													</li>
													<li class="dropdown">
														<a class="dropdown-item dropdown-toggle" href="#">
															Servicios
														</a>
														<ul class="dropdown-menu">
															<li><a class="dropdown-item" href="gpsvehicular.php">GPS Vehícular</a></li>
															<li><a class="dropdown-item" href="accautomotriz.php">Boutique de accesorios automotriz</a></li>
															<li><a class="dropdown-item" href="cerrajeria.php">Cerrajería Electrónica</a></li>
															<li><a class="dropdown-item" href="labvehiculo.php">Laboratorio vehícular</a></li>
															<li><a class="dropdown-item" href="autopartes.php">Autopartes eléctricas y electrónicas</a></li>
														</ul>													
													</li>
													<li class="dropdown">
														<a class="dropdown-item dropdown-toggle active" href="contactenos.php">
															Contáctenos
														</a>
													</li>
												</ul>
											</nav>
										</div>
										<button class="btn header-btn-collapse-nav" data-toggle="collapse" data-target=".header-nav-main nav">
											<i class="fas fa-bars"></i>
										</button>
									</div>
				                    <?php include("inc/atajo.html");?>	
								</div>
							</div>
						</div>
					</div>
				</div>
			</header>

			<div role="main" class="main">
				<!-- Google Maps - Go to the bottom of the page to change settings and map location. -->
				<div id="googlemaps" class="google-map m-0" style="height: 450px;"></div>

				<div class="container">
					<h2 class="font-weight-normal text-8 line-heigh-2 mb-2 py-4 text-center"><strong class="font-weight-extra-bold">Contáctenos</strong>
					</h2>
					<p class="text-5 text-center">Sus opiniones, comentarios y sugerencias son bienvenidos ya que a partir de ellos podemos ofrecerle un mejor servicio.</p>
					<div class="row py-4">
						<div class="col-lg-7 appear-animation" data-appear-animation="fadeIn" data-appear-animation-delay="650">

							<div class="offset-anchor" id="contact-sent"></div>

							<?php
							if (isset($arrResult)) {
								if($arrResult['response'] == 'success') {
								?>
								<div class="alert alert-success" id="contactSuccess">
									<strong>Success!</strong> El mensaje ha sido enviado!.
								</div>
								<?php
								} else if($arrResult['response'] == 'error') {
								?>
								<div class="alert alert-danger" id="contactError">
									<strong>Error!</strong> Sucedió un error al enviar un mensaje.
									<span class="font-size-xs mt-2 d-block" id="mailErrorMessage"><?php echo $arrResult['errorMessage'];?></span>
								</div>
								<?php
								} else if($arrResult['response'] == 'captchaError') {
								?>
								<div class="alert alert-danger" id="contactError">
									<strong>Error!</strong> Captcha Incorrecta.
								</div>
								<?php
								}
							}
							?>

							<form id="contactFormAdvanced" action="<?php echo basename($_SERVER['PHP_SELF']); ?>#contact-sent" method="POST" enctype="multipart/form-data">
								<input type="hidden" value="true" name="emailSent" id="emailSent">
								<div class="form-row">
									<div class="form-group col-md-6">
										<label class="required font-weight-bold text-dark text-2">Nombre</label>
										<input type="text" value="" data-msg-required="Debe de ingresar su nombre" maxlength="100" class="form-control" name="nombre" id="name" required>
									</div>
									<div class="form-group col-md-6">
										<label class="required font-weight-bold text-dark text-2">Teléfono</label>
										<input type="text" value="" data-msg-required="Debe de ingresar su telefono o celular" data-msg-email="Please enter a valid email address." maxlength="100" class="form-control" name="telefono" id="phone" required>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-12">
										<label class="required font-weight-bold text-dark text-2">E-mail</label>
										<input type="email" value="" data-msg-required="Debe de especificar su e-mail" maxlength="100" class="form-control" name="email" id="email" required>
									</div>

								</div>								
								<div class="form-row">
									<div class="form-group col-md-12">
										<label class="font-weight-bold text-dark text-2">Asunto</label>
										<select data-msg-required="Seleccione un asunto" class="form-control" name="asunto" id="subject" required>
											<option value="">Seleccione</option>
											<option value="GPS">GPS</option>
											<option value="Accesorios Automotriz">Accesorios Automotriz</option>
											<option value="Cerrajería Eléctrica">Cerrajería Electrónica</option>
											<option value="Otros">Otros</option>
										</select>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-12 mb-4">
										<label class="required font-weight-bold text-dark text-2">Mensaje</label>
										<textarea maxlength="5000" data-msg-required="Especifique el mensaje" rows="6" class="form-control" name="mensaje" id="message" required></textarea>
									</div>
								</div>
								<div class="form-row pt-2">
									<div class="form-group col-md-4">
										<div class="captcha form-control">
											<div class="captcha-image">
												<?php
												$_SESSION['captcha'] = simple_php_captcha(array(
													'min_length' => 6,
													'max_length' => 6,
													'min_font_size' => 20,
													'max_font_size' => 20,
													'angle_max' => 2
												));
							
												$_SESSION['captchaCode'] = $_SESSION['captcha']['code'];
							
												echo '<img id="captcha-image" src="' . "php/simple-php-captcha/simple-php-captcha.php/" . $_SESSION['captcha']['image_src'] . '" alt="CAPTCHA code">';
												?>
											</div>
											<div class="captcha-refresh">
												<a href="#" id="refreshCaptcha"><i class="fas fa-sync"></i></a>
											</div>
										</div>
									</div>
									<div class="form-group col-md-8">
										<input type="text" value="" maxlength="6" data-msg-captcha="Wrong verification code." data-msg-required="Ingrese el código captcha" placeholder="Ingrese el código captcha" class="form-control form-control-lg captcha-input" name="captcha" id="captcha" required>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-12">
										<hr>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-12 mb-5">
										<input type="submit" id="contactFormSubmit" value="Enviar Mensaje" class="btn btn-primary btn-modern pull-right" data-loading-text="Cargando...">
									</div>
								</div>
							</form>

						</div>
						<div class="col-lg-5">

							<div class="overflow-hidden mb-1">
								<h4 class="text-primary mb-0 appear-animation" data-appear-animation="maskUp" data-appear-animation-delay="200">Información de contacto</h4>
							</div>
							<div class="overflow-hidden mb-3">
								<p class="lead text-4 mb-0 appear-animation" data-appear-animation="maskUp" data-appear-animation-delay="400">Gracias por su interés en <strong>ELECTRÓNICA AUTOMOTRIZ ROJAS</strong>. Por favor, utilice el formulario del a izquierda para enviarnos un mensaje. Procuraremos responderle a la brevedad.</p>
							</div>

							<div class="appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="800">
								
								<ul class="list list-icons list-icons-style-3 mt-2">
									<li><i class="fas fa-map-marker-alt top-6"></i> <strong>Dirección:</strong> Av. San Idelfonso N°194 – Chincha Alta – Chincha – Ica</li>
									<li><i class="fas fa-phone top-6"></i> <strong>Teléfonos:</strong> 981&nbsp;135&nbsp;138 / 981&nbsp;264&nbsp;833</li>
									<li><i class="fas fa-envelope top-6"></i> <strong>Email:</strong> <a href="informes@rojasgps.com">informes@rojasgps.com</a></li>
								</ul>

								<h4 class="text-primary pt-5">Horario de atención</h4>
								<ul class="list list-icons list-dark mt-2">
									<li><i class="far fa-clock top-6"></i> De lunes a sábado de 8:00 AM a 06:00 PM</li>
								</ul>
							</div>

						</div>

					</div>

				</div>

				<hr>

				<?php include("inc/service.html");?>

			</div>

				<?php include("inc/footer.html");?>
		</div>
	</div>
		<!-- Vendor -->
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/jquery.appear/jquery.appear.min.js"></script>
		<script src="vendor/jquery.easing/jquery.easing.min.js"></script>
		<script src="vendor/jquery.cookie/jquery.cookie.min.js"></script>
		<script src="vendor/popper/umd/popper.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/common/common.min.js"></script>
		<script src="vendor/jquery.validation/jquery.validate.min.js"></script>
		<script src="vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
		<script src="vendor/jquery.gmap/jquery.gmap.min.js"></script>
		<script src="vendor/jquery.lazyload/jquery.lazyload.min.js"></script>
		<script src="vendor/isotope/jquery.isotope.min.js"></script>
		<script src="vendor/owl.carousel/owl.carousel.min.js"></script>
		<script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
		<script src="vendor/vide/jquery.vide.min.js"></script>
		<script src="vendor/vivus/vivus.min.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="js/theme.js"></script>
		
		<!-- Current Page Vendor and Views -->
		<script src="vendor/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
		<script src="vendor/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
		
		<!-- Theme Custom 
		<script src="js/custom.js"></script>-->
		<script src="scripts.js"></script>
		<!-- Theme Initialization Files -->
		<script src="js/theme.init.js"></script>

		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCI1xZwolCJsEDYtrxneEQAbT7H5E_gC6I"></script>
		<script>

			/*
			Map Settings

				Find the Latitude and Longitude of your address:
					- http://universimmedia.pagesperso-orange.fr/geo/loc.htm
					- http://www.findlatitudeandlongitude.com/find-address-from-latitude-and-longitude/

			*/

			// Map Markers
			var mapMarkers = [{
				//address: "ELECTRONICA ROJAS AUTOMOTRIZ",
				latitude: -13.4244036,
				longitude: -76.1344945,
				html: "<strong>ELECTRÓNICA AUTOMOTRIZ ROJAS</strong><br>Av. San Idelfonso N°194 – Chincha Alta – Chincha – Ica<br><br><a href='#' onclick='mapCenterAt({latitude: -13.4244036, longitude: -76.1344945, zoom: 16}, event)'>[+] Como llegar aquí</a>",
				icon: {
					image: "img/pin.png",
					iconsize: [26, 46],
					iconanchor: [12, 46]
				},
				popup: true			
			}];

			// Map Initial Location
			var initLatitude = -13.4244036;
			var initLongitude = -76.1344945;

			// Map Extended Settings
			var mapSettings = {
				controls: {
					draggable: (($.browser.mobile) ? false : true),
					panControl: true,
					zoomControl: true,
					mapTypeControl: true,
					scaleControl: true,
					streetViewControl: true,
					overviewMapControl: true
				},
				scrollwheel: false,
				markers: mapMarkers,
				latitude: initLatitude,
				longitude: initLongitude,
				zoom: 17
			};

			var map = $('#googlemaps').gMap(mapSettings),
				mapRef = $('#googlemaps').data('gMap.reference');

			// Map Center At
			var mapCenterAt = function(options, e) {
				e.preventDefault();
				$('#googlemaps').gMap("centerAt", options);
			}

			// Styles from https://snazzymaps.com/
			var styles = [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}];

			var styledMap = new google.maps.StyledMapType(styles, {
				name: 'Styled Map'
			});

			mapRef.mapTypes.set('map_style', styledMap);
			//mapRef.setMapTypeId('map_style');

		</script>

		<!-- Google Analytics: Change UA-XXXXX-X to be your site's ID. Go to http://www.google.com/analytics/ for more information.
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		
			ga('create', 'UA-12345678-1', 'auto');
			ga('send', 'pageview');
		</script>
		 -->

	</body>
</html>
