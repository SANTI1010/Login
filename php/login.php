<?PHP
	include_once("__encabezadoSinSeguridad.php");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?=$title?></title>
		<!-- Bootstrap -->
		<link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
		<!-- Font Awesome -->
		<link href="../vendors/fontawesome/css/font-awesome.min.css" rel="stylesheet">
		<!-- Animate.css -->
		<link href="../vendors/animate.css/animate.css" rel="stylesheet">
		<!-- Custom Theme Style -->
		<link href="../src/scss/template.css" rel="stylesheet">
		<!--Login Only Desktop-->
		<link href="../src/scss/login.css" rel="stylesheet">
		<!--Font-awesome.css-->
		<link href="../vendors/fontawesome/css/font-awesome.css" rel="stylesheet">

		<!-- Jquery-ui -->
		<link href="../vendors/jquery-ui/themes/base/jquery-ui.min.css" rel="stylesheet" >

	</head>
	<body class="login">
		<div>
			<a class="hiddenanchor" id="signup"></a>
			<a class="hiddenanchor" id="signin"></a>
			<div class="login_wrapper">
				<div class="animate form login_form">
					<h1 style="text-align:center"><?=$title?></h1>
					</br>
					<section class="login_content">
						<form action="validar_usuario.php" method="post" id="login_form" name="login_form" enctype="multipart/form-data" target="login_contenedor">
							<div class="alert alert-dark" role="alert">
  								<h3><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Advertencia<h3>
  								<h5>Página disponible sólo para PC Escritorio</h5>
							</div>
							<div>
								<input id="login_usuario" name="login_usuario" type="text" class="form-control input-lg" placeholder="Nombre de usuario"  onkeypress="return validarLogin(event)" />
							</div>
							<div>
								<input id="login_password" name="login_password" type="password" class="form-control input-lg" placeholder="Contraseña" onkeypress="return validarLogin(event)" />
							</div>

							

							<div>
								<a class="btn btn-lg btn-success btn-block loguearse" type="button" href="#" onclick="botonLogin();">Iniciar sesión</a>
							</div>

							<!--Recover Password-->

							<div class="container">
							  <a class="recuperar" href="#" onclick="recuperarPass();" data-toggle="modal">¿Olvidaste tu contraseña?</a>
							</div>

							

							<div class="row flush"><div id="respuestaLogin"></div></div>
							<div class="clearfix"></div>
							<!--<div class="separator">-->
								<!--<p class="change_link">New to site?
									<a href="#signup" class="to_register"> Create Account </a>
								</p>-->
								<!--
								<div class="clearfix"></div>
								<br />
								<div>
									<h1><i class="fa fa-hand-spock-o"></i> MILK</h1>
									<p>©2017 Todos los derechos reservados. </p>
								</div>
								-->
							</div>
							<iframe width="1" height="1" frameborder="0" name="login_contenedor" style="display: none"></iframe>
						</form>
					</section>
				</div>
			</div>
		</div>




		
		<!-- jQuery -->
		<script src="../vendors/jquery/dist/jquery.min.js"></script>
		<!-- jQuery UI -->
	  	<script src="../vendors/jquery-ui/jquery-ui.min.js"></script>

		<!-- Bootstrap -->
		<script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
		<!-- Block UI -->
		<script type="text/javascript" src="js/jquery.blockUI.js"></script>
		<!-- CryptoJS -->
		<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/md5.js"></script>-->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.min.js"></script>
		
		<!--<script type="text/javascript" src="js/jquery.blockUI.js"></script>-->
		
		<script type="text/javascript" src="js/UCAR_login.js"></script>
		<script type="text/javascript" src="js/UCAR_funciones.js"></script>
		<script type="text/javascript">
			var marginTopOverlay='0px';
		</script>
		
	</body>
	
</html>



<div id="pwdModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  	<div class="modal-dialog">
  	<div class="modal-content">
      	<div class="modal-header">
          	<h3 id="titulo">Recuperar contraseña</h3>
      	</div>					                    

        <div class="panel-body">

     	 <h5 class="modal-title"><b>Importante: </b>El correo electrónico debe ser el mismo que ingresó al sistema al momento de registrarse como usuario.</h5><br>
            
                <input class="form-control input-lg" placeholder="Correo electrónico" id="mailRecuperar" name="email" type="email">
            
        </div>
        <div class="modal-footer">
			<button type="button" class="btn btn-secondary" onclick="$('#pwdModal').modal('hide');">Cancel</button>
        	<button type="button" class="btn btn-success" onclick="recoverPass();">Solicitar</button>
		</div>
  	</div>
  </div>
</div>




<!--<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id='smallRespuesta'>
	<div class="modal-dialog  modal-sm">
	    <div class="modal-content" id="respuestaRecuperar"></div>
	</div>
</div>-->


<!-- Modal -->
<div class="modal fade" id='smallRespuesta' tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header"  id='smallRespuesta'>
        <h3 class="modal-title" id="exampleModalLabel">Recupera tu contraseña</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="respuestaRecuperar">      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnReintentar" onclick="$('#pwdModal').modal('show');">Reintentar</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div>