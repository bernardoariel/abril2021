/*=============================================
/*=============================================
/*=============================================
/*=============================================
/*=============================================
VISUALIZAR LA CESTA DEL CARRITO DE COMPRAS
=============================================*/


if(localStorage.getItem("cantidadCesta") != 0){

	$(".cantidadCesta").html(localStorage.getItem("cantidadCesta"));
	$(".sumaCesta").html(localStorage.getItem("sumaCesta"));
	// crearCookie("sumadeCesta", localStorage.getItem("sumaSesta"), 1);

}else{

	$(".cantidadCesta").html("0");
	$(".sumaCesta").html("0");
	
	localStorage.removeItem('listaProductos');
}

/*=============================================
/*=============================================
/*=============================================
/*=============================================
/*=============================================
VISUALIZAR LOS PRODUCTOS EN LA PÁGINA CARRITO DE COMPRAS
=============================================*/


if(localStorage.getItem("listaProductos") != null){

	var listaCarrito = JSON.parse(localStorage.getItem("listaProductos"));
	crearCookie("listaCarrito", localStorage.getItem("listaProductos"), 1);


}else{

	$(".cuerpoCarrito").html('<div class="well">Aún no hay productos en el carrito de compras.</div>');
	$(".sumaCarrito").hide();
	$(".cabeceraCheckout").hide();
	

}

for(var i = 0; i < indice.length; i++){

	if(indice[i] == "carrito-de-compras"){

		listaCarrito.forEach(funcionForEach);

		function funcionForEach(item, index){

			var datosProducto = new FormData();
			var precio = 0;

			datosProducto.append("id", item.idProducto);

			$.ajax({

				url:rutaOculta+"ajax/producto.ajax.php",
				method:"POST",
				data: datosProducto,
				cache: false,
				contentType: false,
				processData:false,
				dataType: "json",
				success: function(respuesta){
		
					if(respuesta["precioOferta"] == 0){

						precio = Math.ceil(respuesta["precio"]);

					}else{

						precio = Math.ceil(respuesta["precioOferta"]);
						
					}

					$(".cuerpoCarrito").append(

						'<div clas="row itemCarrito">'+
							
							'<div class="col-sm-1 col-xs-12">'+
								
								'<br>'+

								'<center>'+
									
									'<button class="btn backColor quitarItemCarrito" idProducto="'+item.idProducto+'" peso="'+item.peso+'">'+
										
										'<i class="fa fa-times"></i>'+

									'</button>'+

								'</center>'+	

							'</div>'+
							'<div class="col-sm-1 col-xs-12">'+
								
								'<figure>'+
									
									'<img src="'+item.imagen+'" class="img-thumbnail">'+

								'</figure>'+

							'</div>'+

							'<div class="col-sm-4 col-xs-12">'+

								'<br>'+

								'<p class="tituloCarritoCompra text-left">'+item.titulo+'</p>'+

							'</div>'+

							'<div class="col-md-2 col-sm-1 col-xs-12">'+

								'<br>'+

								'<p class="precioCarritoCompra text-center"> $<span>'+precio+'</span></p>'+

							'</div>'+

							'<div class="col-md-2 col-sm-3 col-xs-8">'+

								'<br>'+	

								'<div class="col-xs-8">'+

									'<center>'+
									
										'<input type="number" class="form-control cantidadItem" min="1" value="'+item.cantidad+'" tipo="'+item.tipo+'" precio="'+precio+'" idProducto="'+item.idProducto+'" item="'+index+'">'+	

									'</center>'+

								'</div>'+

							'</div>'+

							'<div class="col-md-2 col-sm-1 col-xs-4 text-center">'+
								
								'<br>'+

								'<p class="subTotal'+index+' subtotales">'+
									
									'<strong> $<span>'+(Number(item.cantidad)*Number(precio))+'</span></strong>'+

								'</p>'+

							'</div>'+
							
						'</div>'+

						'<div class="clearfix"></div>'+

						'<hr>');

					/*=============================================
					EVITAR MANIPULAR LA CANTIDAD EN PRODUCTOS VIRTUALES
					=============================================*/

					$(".cantidadItem[tipo='virtual']").attr("readonly","true");

					// /*=============================================
					// /*=============================================
					// /*=============================================
					// /*=============================================
					// /*=============================================
					// ACTUALIZAR SUBTOTAL
					// =============================================*/
					var precioCarritoCompra = $(".cuerpoCarrito .precioCarritoCompra span");

					cestaCarrito(precioCarritoCompra.length);

					sumaSubtotales();		
				
				}

			})	

		}		
		
	}

}



/*=============================================
/*=============================================
/*=============================================
/*=============================================
/*=============================================
AGREGAR AL CARRITO
=============================================*/

$(".agregarCarrito").click(function(){

	var idProducto = $(this).attr("idProducto");
	var imagen = $(this).attr("imagen");
	var titulo = $(this).attr("titulo");
	var precio = $(this).attr("precio");
	var tipo = $(this).attr("tipo");
	var peso = $(this).attr("peso");

	var agregarAlCarrito = true;

	
	/*=============================================
	ALMACENAR EN EL LOCALSTARGE LOS PRODUCTOS AGREGADOS AL CARRITO
	=============================================*/

	if(agregarAlCarrito){

		/*=============================================
		RECUPERAR ALMACENAMIENTO DEL LOCALSTORAGE
		=============================================*/

		if(localStorage.getItem("listaProductos") == null){

			listaCarrito = [];



		}else{

			var listaProductos = JSON.parse(localStorage.getItem("listaProductos"));

			for(var i = 0; i < listaProductos.length; i++){

				if(listaProductos[i]["idProducto"] == idProducto && listaProductos[i]["tipo"] == "virtual"){

					swal({
					  title: "El producto ya está agregado al carrito de compras",
					  text: "",
					  type: "warning",
					  showCancelButton: false,
					  confirmButtonColor: "#DD6B55",
					  confirmButtonText: "¡Volver!",
					  closeOnConfirm: false
					})

					return;

				}

			}

			listaCarrito.concat(localStorage.getItem("listaProductos"));

		}

		listaCarrito.push({"idProducto":idProducto,
						   "imagen":imagen,
						   "titulo":titulo,
						   "precio":precio,
					       "tipo":tipo,
				           "peso":peso,
				           "cantidad":"1"});

		localStorage.setItem("listaProductos", JSON.stringify(listaCarrito));
		crearCookie("listaCarrito", localStorage.getItem("listaProductos"), 1);
		


		/*=============================================
		ACTUALIZAR LA CESTA
		=============================================*/

		var cantidadCesta = Number($(".cantidadCesta").html()) + 1;
		var sumaCesta = Number($(".sumaCesta").html()) + Number(precio);
		console.log("sumaCesta", sumaCesta);

		$(".cantidadCesta").html(cantidadCesta);
		$(".sumaCesta").html(sumaCesta);

		localStorage.setItem("cantidadCesta", cantidadCesta);
		localStorage.setItem("sumaCesta", sumaCesta);

		crearCookie("sumadeCesta", sumaCesta, 1);
		
		/*=============================================
		MOSTRAR ALERTA DE QUE EL PRODUCTO YA FUE AGREGADO
		=============================================*/

		swal({
			  title: "",
			  text: "¡Se ha agregado un nuevo producto al carrito de compras!",
			  type: "success",
			  showCancelButton: true,
			  confirmButtonColor: "#DD6B55",
			  cancelButtonText: "¡Continuar comprando!",
			  confirmButtonText: "¡Ir a mi carrito de compras!",
			  closeOnConfirm: false
			},
			function(isConfirm){
				if (isConfirm) {	   
					 window.location = rutaOculta+"carrito-de-compras";
				} 
		});

	}

})

/*=============================================
/*=============================================
/*=============================================
/*=============================================
/*=============================================
QUITAR PRODUCTOS DEL CARRITO
=============================================*/

$(document).on("click", ".quitarItemCarrito", function(){

	$(this).parent().parent().parent().prev().remove();
	$(this).parent().parent().parent().remove();

	var idProducto = $(".cuerpoCarrito button");
	var imagen = $(".cuerpoCarrito img");
	var titulo = $(".cuerpoCarrito .tituloCarritoCompra");
	var precio = $(".cuerpoCarrito .precioCarritoCompra span");
	var cantidad = $(".cuerpoCarrito .cantidadItem");

	/*=============================================
	SI AÚN QUEDAN PRODUCTOS VOLVERLOS AGREGAR AL CARRITO (LOCALSTORAGE)
	=============================================*/

	listaCarrito = [];

	if(idProducto.length != 0){

		for(var i = 0; i < idProducto.length; i++){

			var idProductoArray = $(idProducto[i]).attr("idProducto");
			var imagenArray = $(imagen[i]).attr("src");
			var tituloArray = $(titulo[i]).html();
			var precioArray = $(precio[i]).html();
			var pesoArray = $(idProducto[i]).attr("peso");
			var tipoArray = $(cantidad[i]).attr("tipo");
			var cantidadArray = $(cantidad[i]).val();

			listaCarrito.push({"idProducto":idProductoArray,
						   "imagen":imagenArray,
						   "titulo":tituloArray,
						   "precio":precioArray,
					       "tipo":tipoArray,
				           "peso":pesoArray,
				           "cantidad":cantidadArray});

		}

		localStorage.setItem("listaProductos",JSON.stringify(listaCarrito));

		sumaSubtotales();
		cestaCarrito(listaCarrito.length);

		crearCookie("listaCarrito", localStorage.getItem("listaProductos"), 1);


	}else{

		/*=============================================
		SI YA NO QUEDAN PRODUCTOS HAY QUE REMOVER TODO
		=============================================*/	

		localStorage.removeItem("listaProductos");

		localStorage.setItem("cantidadCesta","0");
		
		localStorage.setItem("sumaCesta","0");

		$(".cantidadCesta").html("0");
		$(".sumaCesta").html("0");

		$(".cuerpoCarrito").html('<div class="well">Aún no hay productos en el carrito de compras.</div>');
		$(".sumaCarrito").hide();
		$(".cabeceraCheckout").hide();

		crearCookie("listaCarrito", 0, 1);
		crearCookie("sumadeCesta", 0, 1);

	}

})


/*=============================================
/*=============================================
/*=============================================
/*=============================================
/*=============================================
GENERAR SUBTOTAL DESPUES DE CAMBIAR CANTIDAD
=============================================*/
$(document).on("change", ".cantidadItem", function(){

	var cantidad = $(this).val();
	var precio = $(this).attr("precio");
	var idProducto = $(this).attr("idProducto");
	var item = $(this).attr("item");

	$(".subTotal"+item).html('<strong> $<span>'+(cantidad*precio)+'</span></strong>');

	/*=============================================
	ACTUALIZAR LA CANTIDAD EN EL LOCALSTORAGE
	=============================================*/

	var idProducto = $(".cuerpoCarrito button");
	var imagen = $(".cuerpoCarrito img");
	var titulo = $(".cuerpoCarrito .tituloCarritoCompra");
	var precio = $(".cuerpoCarrito .precioCarritoCompra span");
	var cantidad = $(".cuerpoCarrito .cantidadItem");

	listaCarrito = [];

	for(var i = 0; i < idProducto.length; i++){

			var idProductoArray = $(idProducto[i]).attr("idProducto");
			var imagenArray = $(imagen[i]).attr("src");
			var tituloArray = $(titulo[i]).html();
			var precioArray = $(precio[i]).html();
			var pesoArray = $(idProducto[i]).attr("peso");
			var tipoArray = $(cantidad[i]).attr("tipo");
			var cantidadArray = $(cantidad[i]).val();

			listaCarrito.push({"idProducto":idProductoArray,
						   "imagen":imagenArray,
						   "titulo":tituloArray,
						   "precio":precioArray,
					       "tipo":tipoArray,
				           "peso":pesoArray,
				           "cantidad":cantidadArray});

		}

		localStorage.setItem("listaProductos",JSON.stringify(listaCarrito));

		sumaSubtotales();

		cestaCarrito(listaCarrito.length);

		crearCookie("listaCarrito", localStorage.getItem("listaProductos"), 1);
})

/*=============================================
/*=============================================
/*=============================================
/*=============================================
/*=============================================
SUMA DE TODOS LOS SUBTOTALES
=============================================*/
function sumaSubtotales(){

	var subtotales = $(".subtotales span");
	var arraySumaSubtotales = [];
	
	for(var i = 0; i < subtotales.length; i++){

		var subtotalesArray = $(subtotales[i]).html();

		arraySumaSubtotales.push(Number(subtotalesArray));
		
	}

	
	function sumaArraySubtotales(total, numero){

		return total + numero;

	}

	var sumaTotal = arraySumaSubtotales.reduce(sumaArraySubtotales);
	
	$(".sumaSubTotal").html('<strong> $<span>'+(sumaTotal).toFixed(2)+'</span></strong>');

	$(".sumaCesta").html((sumaTotal).toFixed(2));

	localStorage.setItem("sumaCesta", (sumaTotal).toFixed(2));

	crearCookie("sumadeCesta", localStorage.getItem("sumaCesta"), 1);



}

/*=============================================
/*=============================================
/*=============================================
/*=============================================
/*=============================================
ACTUALIZAR CESTA AL CAMBIAR CANTIDAD
=============================================*/
function cestaCarrito(cantidadProductos){

	/*=============================================
	SI HAY PRODUCTOS EN EL CARRITO
	=============================================*/

	if(cantidadProductos != 0){
		
		var cantidadItem = $(".cuerpoCarrito .cantidadItem");

		var arraySumaCantidades = [];
	
		for(var i = 0; i < cantidadItem .length; i++){

			var cantidadItemArray = $(cantidadItem[i]).val();
			arraySumaCantidades.push(Number(cantidadItemArray));
			
		}
	
		function sumaArrayCantidades(total, numero){

			return total + numero;

		}

		var sumaTotalCantidades = arraySumaCantidades.reduce(sumaArrayCantidades);
		
		$(".cantidadCesta").html(sumaTotalCantidades );
		localStorage.setItem("cantidadCesta", sumaTotalCantidades);

	}

}

function crearCookie(nombre, valor, diasExpedicion){

  var hoy = new Date();

  hoy.setTime(hoy.getTime() + (diasExpedicion * 24 * 60 * 60 * 1000));

  var fechaExpedicion = "expires=" + hoy.toUTCString();

  document.cookie = nombre + "=" + valor + "; " + fechaExpedicion;

}
/*=============================================
/*=============================================
/*=============================================
/*=============================================
/*=============================================
CHECKOUT
=============================================*/

$("#btnCheckout").click(function(){

	$(".listaProductos table.tablaProductos tbody").html("");

	// $("#checkPaypal").prop("checked",true);
	// $("#checkPayu").prop("checked", false);
	

	crearCookie("sumadeCesta", localStorage.getItem("sumaCesta"), 1);

	var idUsuario = $(this).attr("idUsuario");

	var peso = $(".cuerpoCarrito button, .comprarAhora button");

	var titulo = $(".cuerpoCarrito .tituloCarritoCompra, .comprarAhora .tituloCarritoCompra");

	var cantidad = $(".cuerpoCarrito .cantidadItem, .comprarAhora .cantidadItem");
	
	var subtotal = $(".cuerpoCarrito .subtotales span, .comprarAhora .subtotales span");
	
	var tipoArray =[];
	var cantidadPeso = [];

	/*=============================================
	SUMA SUBTOTAL
	=============================================*/

	var sumaSubTotal = $(".sumaSubTotal span")
	
	$(".valorSubtotal").html($(sumaSubTotal).html());
	$(".valorSubtotal").attr("valor",$(sumaSubTotal).html());

	/*=============================================
	TASAS DE IMPUESTO
	=============================================*/

	var impuestoTotal = ($(".valorSubtotal").html() * $("#tasaImpuesto").val()) /100;
	
	$(".valorTotalImpuesto").html((impuestoTotal).toFixed(2));
	$(".valorTotalImpuesto").attr("valor",(impuestoTotal).toFixed(2));

	sumaTotalCompra();

	/*=============================================
	VARIABLES ARRAY 
	=============================================*/

	for(var i = 0; i < titulo.length; i++){

		var pesoArray = $(peso[i]).attr("peso");
		var tituloArray = $(titulo[i]).html();
		var cantidadArray = $(cantidad[i]).val();		
		var subtotalArray = $(subtotal[i]).html();

		/*=============================================
		EVALUAR EL PESO DE ACUERDO A LA CANTIDAD DE PRODUCTOS
		=============================================*/

		cantidadPeso[i] = pesoArray * cantidadArray;

		function sumaArrayPeso(total, numero){

			return total + numero;

		}

		var sumaTotalPeso = cantidadPeso.reduce(sumaArrayPeso);
		
		/*=============================================
		MOSTRAR PRODUCTOS DEFINITIVOS A COMPRAR
		=============================================*/

		$(".listaProductos table.tablaProductos tbody").append('<tr>'+
															   '<td class="valorTitulo">'+tituloArray+'</td>'+
															   '<td class="valorCantidad">'+cantidadArray+'</td>'+
															   '<td>$<span class="valorItem" valor="'+subtotalArray+'">'+subtotalArray+'</span></td>'+
															   '<tr>');

		/*=============================================
		SELECCIONAR PAÍS DE ENVÍO SI HAY PRODUCTOS FÍSICOS
		=============================================*/
	
		tipoArray.push($(cantidad[i]).attr("tipo"));
		
		function checkTipo(tipo){

			return tipo == "fisico";
		
		}

	}

	/*=============================================
	EXISTEN PRODUCTOS FÍSICOS
	=============================================*/

	if(tipoArray.find(checkTipo) == "fisico"){

		// $(".seleccionePais").html('<select class="form-control" id="seleccionarPais" required>'+
						
		// 				          '<option value="">Seleccione el país</option>'+

		// 			              '</select>');


		$(".formEnvio").show();

		$(".btnPagar").attr("tipo","fisico");

		sumaTotalCompra();
		

	}else{

		$(".btnPagar").attr("tipo","virtual");
	}

	mitotal=localStorage.getItem("sumaCesta");
	
})

/*=============================================
/*=============================================
/*=============================================
/*=============================================
/*=============================================
SUMA TOTAL DE LA COMPRA
=============================================*/
function sumaTotalCompra(){

	var sumaTotalTasas = Number($(".valorSubtotal").html())+ 
	                     Number(0)+ 
	                     Number(0);


	$(".valorTotalCompra").html((sumaTotalTasas).toFixed(2));
	$(".valorTotalCompra").attr("valor",(sumaTotalTasas).toFixed(2));

	localStorage.setItem("total",hex_md5($(".valorTotalCompra").html()));

	
}




/*=============================================
/*=============================================
/*=============================================
/*=============================================
/*=============================================
BOTÓN PAGAR PAYPAL
=============================================*/

$(".btnPagar").click(function(){

	var tipo = $(this).attr("tipo");

	

	var divisa = "ARS";//$("#cambiarDivisa").val();
	console.log("divisa", divisa);
	var total = $(".valorTotalCompra").html();
	console.log("total", total);
	var totalEncriptado = localStorage.getItem("total");
	console.log("totalEncriptado", totalEncriptado);
	var impuesto = $(".valorTotalImpuesto").html();
	console.log("impuesto", impuesto);
	var envio = $(".valorTotalEnvio").html();
	console.log("envio", envio);
	var subtotal = $(".valorSubtotal").html();
	console.log("subtotal", subtotal);
	var titulo = $(".valorTitulo");
	console.log("titulo", titulo);
	var cantidad = $(".valorCantidad");
	console.log("cantidad", cantidad);
	var valorItem = $(".valorItem");
	console.log("valorItem", valorItem);
	var idProducto = $('.cuerpoCarrito button, .comprarAhora button');
	console.log("idProducto", idProducto);

	var tituloArray = [];
	var cantidadArray = [];
	var valorItemArray = [];
	var idProductoArray = [];

	for(var i = 0; i < titulo.length; i++){

		tituloArray[i] = $(titulo[i]).html();
		cantidadArray[i] = $(cantidad[i]).html();
		valorItemArray[i] = $(valorItem[i]).html();
		idProductoArray[i] = $(idProducto[i]).attr("idProducto");

	}

	var datos = new FormData();

	datos.append("divisa", divisa);
	datos.append("total",total);
	datos.append("totalEncriptado",totalEncriptado);
	datos.append("impuesto",impuesto);
	datos.append("envio",envio);
	datos.append("subtotal",subtotal);
	datos.append("tituloArray",tituloArray);
	datos.append("cantidadArray",cantidadArray);
	datos.append("valorItemArray",valorItemArray);
	datos.append("idProductoArray",idProductoArray);

	$.ajax({
		 url:rutaOculta+"ajax/carrito.ajax.php",
		 method:"POST",
		 data: datos,
		 cache: false,
         contentType: false,
         processData: false,
         success:function(respuesta){
         	   	
              window.location = respuesta;

         }

	})

})


$(".btnEditarEnvio").click(function(){



	var idCompraEnvio = $(this).attr("idCompraEnvio");
	console.log("idCompraEnvio", idCompraEnvio);
	console.log("$(this).attr(\"idCompraEnvio\")", $(this).attr("idCompraEnvio"));

	$("#idCompraEnvio").val(idCompraEnvio);
})
