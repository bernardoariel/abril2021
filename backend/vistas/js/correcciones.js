$("#btnCorregir").on("click", function(){

	var datos = new FormData();
 	datos.append("correccion", 1);

  	$.ajax({

	  url:"ajax/correcciones.ajax.php",
	  method: "POST",
	  data: datos,
	  cache: false,
      contentType: false,
      processData: false,
      // dataType: "json",
      success: function(respuesta){

      	console.log("respuesta", respuesta);

      }

  	})

})


$("#btnStockaCero").on("click", function(){
  
  var datos = new FormData();
  datos.append("stockcero", 1);

  $.ajax({

    url:"ajax/correcciones.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
      
    success: function(respuesta){
      console.log("respuesta", respuesta);

      if(respuesta=="ok"){

          swal({
          
                title: "Todo un Exito",
                text: "Stock = 0 /\r?\n/g Precio = 0 /\r?\n/g finOferta = 0000-00-00 00:00:00 /\r?\n/g precioOferta = 0 /\r?\n/g descuentoOferta=0",
                type: "success",
                confirmButtonText: "¡Cerrar!"

          });

        }

    }

  })

})

$("#btnActualizarProductos").on("click", function(){

  var datos = new FormData();
  datos.append("actualizarProductos", 1);

  $.ajax({

    url:"ajax/correcciones.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
      
    success: function(respuesta){
      console.log("respuesta", respuesta);

     

    }

  })

})