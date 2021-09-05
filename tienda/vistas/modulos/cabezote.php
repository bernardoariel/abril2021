<?php

$servidor = Ruta::ctrRutaServidor();
$url = Ruta::ctrRuta();

$social = ControladorPlantilla::ctrEstiloPlantilla();

/*=============================================
CREAR EL OBJETO DE LA API DE GOOGLE
=============================================*/

$cliente = new Google_Client();
$cliente-> setAuthConfig('modelos/client_secret.json');
$cliente->setAccessType("offline");
$cliente->setScopes(['profile','email']);

/*=============================================
RUTA PARA EL LOGIN DE GOOGLE
=============================================*/

$rutaGoogle = $cliente->createAuthUrl();

/*=============================================
RECIBIMOS LA VARIABLE GET DEGOOGLE LLAMADA CODE
=============================================*/

if(isset($_GET["code"])){

	$token = $cliente->authenticate($_GET["code"]);

	$cliente->setAccessToken($token);
}
/*=============================================
RECIBIMOS LOS DATOS CIFRADOS DE GOOGLE EN UN ARRAY
=============================================*/

if($cliente->getAccessToken()){

	$item = $cliente->verifyIdToken();

	$datos = array();


	$datos = array("nombre"=>$item['name'],
				   "email"=>$item['email'],
				   "foto"=>$item['picture'],
				   "password"=>"null",
				   "modo"=>"google",
				   "verificacion"=>0,
				   "emailEncriptado"=>"null");

	$respuesta = ControladorUsuarios::ctrRegistroRedesSociales($datos);
	
}

?>

<!--=====================================
TOP
======================================-->

<div class="container-fluid barraSuperior" id="top" style="background-color:#1E1F21;">
	
	<div class="container-fluid">
		
		<div class="row">
				
			<!--=====================================
			LOGOTIPO
			======================================-->
			
			<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" id="logotipo" style="margin-left: -40px;">
				
				<center>

					<a href="<?php echo $url; ?>">
						
						<img src="<?php echo $servidor.$social["logo"]; ?>" class="img-responsive">
				
					</a>
				
			</div>

			<!--=====================================
			BLOQUE CATEGORÍAS Y BUSCADOR
			======================================-->

			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					
				<!--=====================================
				BOTÓN CATEGORÍAS
				======================================-->

				<div class="col-lg-1 col-md-2 col-sm-1 col-xs-1 categoriaMenu">

					
					<div class="input-group margin">

		                <div class="input-group-btn">
		                  
		                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" 
		                  style="margin-top:6px;border-radius:0;color:white;background: #F17900;border-color: #F17900;margin-left: -15px;">
		                  	
		                    <span class="caret"></span>

		                  </button>

		                  <ul class="dropdown-menu"  style="background: #1E1F21;border-color: white;border-radius:0;margin-left: -25px;">

		                  	<?php $categorias = ControladorProductos::ctrMostrarCategoriasMenu(null,null); 
		                  	?>

		                  	<?php foreach ($categorias as $key => $value): ?>

		                  		<li><a class="fondoMenu" href="<?php echo $url.$value["ruta"]; ?>"><?php echo $value["categoria"]; ?></a></li>
		                  		
		                  	<?php endforeach ?>

		                  </ul>

		                </div>		
							
					</div>

				</div>

				<!--=====================================
				BUSCADOR
				======================================-->
				
				<div class="input-group col-lg-9 col-md-9 col-sm-11 col-xs-10" id="buscador">
					
					<input type="search" name="buscar" class="form-control" placeholder="Buscar..." style="margin-top:6px;border-radius:0;border-color: white;">	

					<span class="input-group-btn">
						
						<a href="<?php echo $url; ?>buscador/1/recientes">

							<button class="btn btn-default backColor" type="submit" style="margin-top:6px;border-radius:0;border-color: #F17900;">
								
								<i class="fa fa-search"></i>

							</button>

						</a>

					</span>

				</div>
			
			</div>

			<!--=====================================
			CARRITO DE COMPRAS
			======================================-->

			<div class="col-lg-2 col-md-2 col-sm-6 col-xs-12" id="carrito" style="margin-left: -20px;">


				
				<a href="<?php echo $url; ?>carrito-de-compras">

					<button class="btn btn-default pull-left backColor" style="margin-top:6px;border-radius:0;border-color: #F17900;"> 
						
						<i class="fa fa-shopping-cart" aria-hidden="true"></i>
					
					</button>
				
				</a>	

				<p style=" margin-top:6px; border:0px solid #aaa;  font-size:12px;background-color: #fff;color:black;padding-left: 60px;">
					ITEMS <span class="cantidadCesta"></span> <br> $ <span class="sumaCesta"></span>
				</p>	

			</div>

			<!--=====================================
			REGISTRO
			======================================-->

			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 registro">
				
				<ul>
					
					<?php

				if(isset($_SESSION["validarSesion"])){

					if($_SESSION["validarSesion"] == "ok"){

						if($_SESSION["modo"] == "directo"){

							if($_SESSION["foto"] != ""){

								echo '<li>

										<img class="img-circle" src="'.$url.$_SESSION["foto"].'" width="10%">

									 </li>';

							}else{

								echo '<li>

									<img class="img-circle" src="'.$servidor.'vistas/img/usuarios/default/anonymous.png" width="10%">

								</li>';

							}

							echo '<li>|</li>
							 <li><a href="'.$url.'perfil">Ver Perfil</a></li>
							 <li>|</li>
							 <li><a href="'.$url.'salir">Salir</a></li>';


						}

						if($_SESSION["modo"] == "facebook"){

							echo '<li>

									<img class="img-circle" src="'.$_SESSION["foto"].'" width="10%">

								   </li>
								   <li>|</li>
						 		   <li><a href="'.$url.'perfil">Ver Perfil</a></li>
						 		   <li>|</li>
						 		   <li><a href="'.$url.'salir" class="salir">Salir</a></li>';

						}

						if($_SESSION["modo"] == "google"){

							echo '<li>

									<img class="img-circle" src="'.$_SESSION["foto"].'" width="10%">

								   </li>
								   <li>|</li>
						 		   <li><a href="'.$url.'perfil">Ver Perfil</a></li>
						 		   <li>|</li>
						 		   <li><a href="'.$url.'salir">Salir</a></li>';

						}

					}

				}else{

					echo '<li><a href="#modalIngreso" data-toggle="modal">Ingresar</a></li>
						  <li>|</li>
						  <li><a href="#modalRegistro" data-toggle="modal">Crear una cuenta</a></li>';

				}

				?>

				</ul>

			</div>	

		</div>	

	</div>

</div>

<!--=====================================
HEADER
======================================-->

<header class="container-fluid">
	
	<div class="container">
		
		<div class="row" id="cabezote">

		<!--=====================================
		CATEGORÍAS
		======================================-->

		<div class="col-xs-12 backColor" id="categorias" style="margin-top:8px;">

			<?php

				$item = null;
				$valor = null;

				$categorias = ControladorProductos::ctrMostrarCategorias($item, $valor);

				foreach ($categorias as $key => $value) {

					if($value["estado"] != 0 && $value["precio"] > 0 && $value["stock"] > 2){

					echo '<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
							
							<h4>
								<a href="'.$url.$value["ruta"].'" class="pixelCategorias">'.$value["categoria"].'</a>
							</h4>
							
							<hr>

							<ul>';

							$item = "id_categoria";

							$valor = $value["id"];

							$subcategorias = ControladorProductos::ctrMostrarSubCategorias($item, $valor);
							
							foreach ($subcategorias as $key => $value) {
									
									echo '<li><a href="'.$url.$value["ruta"].'" class="pixelSubCategorias">'.$value["subcategoria"].'</a></li>';
								}	
								
							echo '</ul>

						</div>';
					}

				}

			?>	

		</div>

	</div>

</header>


<!--=====================================
VENTANA MODAL PARA EL REGISTRO
======================================-->

<div class="modal fade modalFormulario" id="modalRegistro" role="dialog">

    <div class="modal-content modal-dialog">

        <div class="modal-body modalTitulo">

        	<h3 class="barraSuperior">REGISTRARSE</h3>

           <button type="button" class="close" data-dismiss="modal">&times;</button>
        	
			<!--=====================================
			REGISTRO FACEBOOK
			======================================-->

			<div class="col-sm-6 col-xs-12 facebook">
				
				<p>
				  <i class="fa fa-facebook"></i>
					Registro con Facebook
				</p>

			</div>

			<!--=====================================
			REGISTRO GOOGLE
			======================================-->
			<a href="<?php echo $rutaGoogle; ?>">

				<div class="col-sm-6 col-xs-12 google">
					
					<p>
					  <i class="fa fa-google"></i>
						Registro con Google
					</p>

				</div>
			</a>

			<!--=====================================
			REGISTRO DIRECTO
			======================================-->

			<form method="post">
				
			<hr>

				<div class="form-group">
					
					<div class="input-group">
						
						<span class="input-group-addon">
							
							<i class="glyphicon glyphicon-user"></i>
						
						</span>

						<input type="text" class="form-control text-uppercase" id="regUsuario" name="regUsuario" placeholder="Nombre Completo" required>

					</div>

				</div>

				<div class="form-group">
					
					<div class="input-group">
						
						<span class="input-group-addon">
							
							<i class="glyphicon glyphicon-envelope"></i>
						
						</span>

						<input type="email" class="form-control" id="regEmail" name="regEmail" placeholder="Correo Electrónico" required>

					</div>

				</div>

				<div class="form-group">
					
					<div class="input-group">
						
						<span class="input-group-addon">
							
							<i class="glyphicon glyphicon-lock"></i>
						
						</span>

						<input type="password" class="form-control" id="regPassword" name="regPassword" placeholder="Contraseña" required>

					</div>

				</div>

				<!--=====================================
				https://www.iubenda.com/ CONDICIONES DE USO Y POLÍTICAS DE PRIVACIDAD
				======================================-->

				<div class="checkBox">
					
					<label>
						
						<input id="regPoliticas" type="checkbox">
					
							<small>
								
								Al registrarse, usted acepta nuestras condiciones de uso y políticas de privacidad

								<br>

								<a href="https://www.iubenda.com/privacy-policy/47917582" class="iubenda-white iubenda-embed" title="Privacy Policy ">Privacy Policy</a><script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src="https://cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>

							</small>

					</label>

				</div>

				<?php

					$registro = new ControladorUsuarios();
					$registro -> ctrRegistroUsuario();

				?>
				
				<input type="submit" class="btn btn-default barraSuperior btn-block" value="ENVIAR">	

			</form>

        </div>

        <div class="modal-footer">
          
			¿Ya tienes una cuenta registrada? | <strong><a href="#modalIngreso" data-dismiss="modal" data-toggle="modal">Ingresar</a></strong>

        </div>
      
    </div>

</div>


<!--=====================================
VENTANA MODAL PARA EL INGRESO
======================================-->

<div class="modal fade modalFormulario" id="modalIngreso" role="dialog">

    <div class="modal-content modal-dialog">

        <div class="modal-body modalTitulo">

        	<h3 class="barraSuperior">INGRESAR</h3>

           <button type="button" class="close" data-dismiss="modal">&times;</button>
        	
			<!--=====================================
			INGRESO FACEBOOK
			======================================-->

			<div class="col-sm-6 col-xs-12 facebook">
				
				<p>
				  <i class="fa fa-facebook"></i>
					Ingreso con Facebook
				</p>

			</div>

			<!--=====================================
			INGRESO GOOGLE
			======================================-->
			<a href="<?php echo $rutaGoogle; ?>">
			
				<div class="col-sm-6 col-xs-12 google">
					
					<p>
					  <i class="fa fa-google"></i>
						Ingreso con Google
					</p>

				</div>

			</a>

			<!--=====================================
			INGRESO DIRECTO
			======================================-->

			<form method="post">
				
			<hr>

				<div class="form-group">
					
					<div class="input-group">
						
						<span class="input-group-addon">
							
							<i class="glyphicon glyphicon-envelope"></i>
						
						</span>

						<input type="email" class="form-control" id="ingEmail" name="ingEmail" placeholder="Correo Electrónico" required>

					</div>

				</div>

				<div class="form-group">
					
					<div class="input-group">
						
						<span class="input-group-addon">
							
							<i class="glyphicon glyphicon-lock"></i>
						
						</span>

						<input type="password" class="form-control" id="ingPassword" name="ingPassword" placeholder="Contraseña" required>

					</div>

				</div>

				

				<?php

					$ingreso = new ControladorUsuarios();
					$ingreso -> ctrIngresoUsuario();

				?>
				
				<input type="submit" class="btn btn-default barraSuperior btn-block btnIngreso" value="ENVIAR">	

				<br>

				<center>
					
					<a href="#modalPassword" data-dismiss="modal" data-toggle="modal">¿Olvidaste tu contraseña?</a>

				</center>

			</form>

        </div>

        <div class="modal-footer">
          
			¿No tienes una cuenta registrada? | <strong><a href="#modalRegistro" data-dismiss="modal" data-toggle="modal">Registrarse</a></strong>

        </div>
      
    </div>

</div>

<!--=====================================
VENTANA MODAL PARA OLVIDO DE CONTRASEÑA
======================================-->

<div class="modal fade modalFormulario" id="modalPassword" role="dialog">

    <div class="modal-content modal-dialog">

        <div class="modal-body modalTitulo">

        	<h3 class="barraSuperior">SOLICITUD DE NUEVA CONTRASEÑA</h3>

           <button type="button" class="close" data-dismiss="modal">&times;</button>
        	
			<!--=====================================
			OLVIDO CONTRASEÑA
			======================================-->

			<form method="post">

				<label class="text-muted">Escribe el correo electrónico con el que estás registrado y allí te enviaremos una nueva contraseña:</label>

				<div class="form-group">
					
					<div class="input-group">
						
						<span class="input-group-addon">
							
							<i class="glyphicon glyphicon-envelope"></i>
						
						</span>
					
						<input type="email" class="form-control" id="passEmail" name="passEmail" placeholder="Correo Electrónico" required>

					</div>

				</div>			

				<?php

					$password = new ControladorUsuarios();
					$password -> ctrOlvidoPassword();

				?>
				
				<input type="submit" class="btn btn-default barraSuperior btn-block" value="ENVIAR">	

			</form>

        </div>

        <div class="modal-footer">
          
			¿No tienes una cuenta registrada? | <strong><a href="#modalRegistro" data-dismiss="modal" data-toggle="modal">Registrarse</a></strong>

        </div>
      
    </div>

</div>





