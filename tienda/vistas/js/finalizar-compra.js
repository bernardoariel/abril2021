$("#btnAgregarEnvio").click(function(){

	  var datosEnvio = new FormData();
    datosEnvio.append("idCompra",$("#idCompra").val());
    datosEnvio.append("telefono", $("#telefono").val());
    datosEnvio.append("direccion", $("#direccion").val());
    datosEnvio.append("localidad", $("#localidad").val());
    datosEnvio.append("idUsuarioCompra", $("#idUsuarioCompra").val());
    
    
    
    console.log("$(\"#telefono\").val()", $("#telefono").val());
    console.log("$(\"#idCompra\").val()", $("#idCompra").val());
    console.log("$(\"#localidad\").val()", $("#localidad").val());
    console.log("$(\"#direccion\").val()", $("#direccion").val());
    console.log("$(\"#idUsuarioCompra\").val()", $("#idUsuarioCompra").val());
                    
    $.ajax({

      url:rutaOculta+"ajax/carrito.ajax.php",
      method:"POST",
      data: datosEnvio,
      cache: false,
      contentType: false,
      processData:false,
      success: function(respuesta){
      	console.log("respuesta", respuesta);
        
        if(respuesta="ok"){
          window.location = "perfil";
        }

      }
	

})

})

$('#modalDatos').modal({backdrop: 'static', keyboard: false})