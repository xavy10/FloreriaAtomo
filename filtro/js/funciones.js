            function registrar_presentacion(){
	var datos=new FormData();
	var sol=new XMLHttpRequest();

	var f=document.querySelector("#form-reg-pre");
	var presentacion={
		id:parseInt(f.id.value),
		nombre:f.nombre.value
	};
	presentacion=JSON.stringify(presentacion);          //Covierte el objeto a fomato json
	datos.append('presentacion',presentacion);
	datos.append('tarea',getTarea("registrarPresentacion"));

	sol.addEventListener("load",resRegPres,false);
	sol.open("POST","http://192.168.0.13/floreria/php/proceso.php",true);
	sol.send(datos);
}
function resRegPres(e){
	console.log(e.target.responseText);
}


function listar_presentacion(){
	var datos=new FormData();
	var sol=new XMLHttpRequest();
	tarea={
		opc:"presentacion",
		acc:"listar"
	};

	tarea=JSON.stringify(tarea);          //Covierte el array a fomato json
	datos.append('tarea',tarea);

	sol.addEventListener("load",resLisPres,false);
	sol.open("POST","http://192.168.0.13/floreria/php/proceso.php",true);
	sol.send(datos);
}
function resLisPres(e){
	console.log(e.target.responseText);
}

function actualizar_presentacion(){
	var datos=new FormData();
	var sol=new XMLHttpRequest();

	var f=document.querySelector("#form-act-pre");
	var presentacion={
		id:parseInt(f.id.value),
		nombre:f.nombre.value
	};
	presentacion=JSON.stringify(presentacion);          //Covierte el array a fomato json


	datos.append('presentacion',presentacion);
	datos.append('tarea',getTarea("actualizarPresentacion"));

	sol.addEventListener("load",resActPres,false);
	sol.open("POST","http://192.168.0.13/floreria/php/proceso.php",true);
	sol.send(datos);
}
function resActPres(e){
	console.log(e.target.responseText);
}

function eliminar_presentacion(id){
	var datos=new FormData();
	var sol=new XMLHttpRequest();

	// var f=document.querySelector("#form-act-pre");
	var presentacion={
		id:parseInt(id)
		// nombre:f.nombre.value
	};

	presentacion=JSON.stringify(presentacion);          //Covierte el array a fomato json
	datos.append('presentacion',presentacion);
	datos.append('tarea',getTarea("eliminarPresentacion"));

	sol.addEventListener("load",resEliPres,false);
	sol.open("POST","http://192.168.0.13/floreria/php/proceso.php",true);
	sol.send(datos);
}
function resEliPres(e){
	console.log(e.target.responseText);
}
/*######################################################################
################# Fin de metodos de presentacion #######################
######################################################################*/





function registrar_flor(){
	var datos=new FormData();
	var sol=new XMLHttpRequest();

	var f=document.querySelector("#form-reg-pre");
	var flor={
		id:parseInt(f.id.value),
		nombre:f.nombre.value
	};

	flor=JSON.stringify(flor);          //Covierte el objeto a fomato json
	datos.append('flor',flor);
	datos.append('tarea',getTarea("registrarFlor"));

	sol.addEventListener("load",resRegFlor,false);
	sol.open("POST","http://192.168.0.13/floreria/php/proceso.php",true);
	sol.send(datos);
}
function resRegFlor(e){
	console.log(e.target.responseText);
}


function listar_flor(){
	var datos=new FormData();
	var sol=new XMLHttpRequest();

	tarea={
		opc:"flor",
		acc:"listar"
	};
	tarea=JSON.stringify(tarea);
	datos.append('tarea',tarea);

	sol.addEventListener("load",resLisFlor,false);
	sol.open("POST","http://192.168.0.13/floreria/php/proceso.php",true);
	sol.send(datos);
}
function resLisFlor(e){
	console.log(e.target.responseText);
}

function actualizar_flor(){
	var datos=new FormData();
	var sol=new XMLHttpRequest();

	var f=document.querySelector("#form-lis-flo");
	var flor={
		id:parseInt(f.id.value),
		nombre:f.nombre.value
	};

	flor=JSON.stringify(flor);
	datos.append('flor',flor);
	datos.append('tarea',getTarea("actualizarFlor"));

	sol.addEventListener("load",resActFlor,false);
	sol.open("POST","http://192.168.0.13/floreria/php/proceso.php",true);
	sol.send(datos);
}
function resActFlor(e){
	console.log(e.target.responseText);
}

function eliminar_flor(id){
	var datos=new FormData();
	var sol=new XMLHttpRequest();

	var flor={
		id:parseInt(id)
	};

	flor=JSON.stringify(flor);          //Covierte el array a fomato json
	datos.append('flor',flor);
	datos.append('tarea',getTarea("eliminarFlor"));

	sol.addEventListener("load",resEliFlor,false);
	sol.open("POST","http://192.168.0.13/floreria/php/proceso.php",true);
	sol.send(datos);
}
function resEliFlor(e){
	console.log(e.target.responseText);
}
/*######################################################################
##################### Fin de metodos de flor ###########################
######################################################################*/



function registrar_producto(){
	var datos=new FormData();
	var sol=new XMLHttpRequest();

	var f=document.querySelector("#form-reg-pro");
	var producto={
		id:parseInt(f.id.value),
		nombre:f.nombre.value,
		precio:parseFloat(f.precio.value),
		imagen:f.imagen.value,
		descrip:f.descrip.value,
		status:f.status.value,
		id_flor:f.id_flor.value,
		id_pre:f.id_pre.value
	};
	producto=JSON.stringify(producto);
	tarea={
		opc:"producto",
		acc:"registrar"
	};
	tarea=JSON.stringify(tarea);
	datos.append('producto',producto);
	datos.append('tarea',tarea)
	datos.append('tarea',getTarea("registrarProducto"));

	sol.addEventListener("load",resRegProd,false);
	sol.open("POST","http://192.168.0.13/floreria/php/proceso.php",true);
	sol.send(datos);
}
function resRegProd(e){
	console.log(e.target.responseText);
}


function listar_producto(){
	var datos=new FormData();
	var sol=new XMLHttpRequest();

	datos.append('tarea',getTarea("listarProducto"));

	sol.addEventListener("load",resLisProd,false);
	sol.open("POST","http://192.168.0.13/floreria/php/proceso.php",true);
	sol.send(datos);
}
function resLisProd(e){
	console.log(e.target.responseText);
}

function actualizar_producto(){
	var datos=new FormData();
	var sol=new XMLHttpRequest();

	var f=document.querySelector("#form-lis-pro");
	var producto={
		id:parseInt(f.id.value),
		nombre:f.nombre.value,
		precio:parseFloat(f.precio.value),
		imagen:f.imagen.value,
		descrip:f.descrip.value,
		status:f.status.value,
		id_flor:f.id_flor.value,
		id_pre:f.id_pre.value
	};

	producto=JSON.stringify(producto);
	datos.append('producto',producto);
	datos.append('tarea',getTarea("actualizarProducto"));

	sol.addEventListener("load",resActProd,false);
	sol.open("POST","http://192.168.0.13/floreria/php/proceso.php",true);
	sol.send(datos);
}
function resActProd(e){
	console.log(e.target.responseText);
}

function eliminar_producto(id){
	var datos=new FormData();
	var sol=new XMLHttpRequest();

	var producto={
		id:parseInt(id)
	};

	producto=JSON.stringify(producto);
	datos.append('producto',producto);
	datos.append('tarea',getTarea("eliminarProducto"));

	sol.addEventListener("load",resEliProd,false);
	sol.open("POST","http://192.168.0.13/floreria/php/proceso.php",true);
	sol.send(datos);
}
function resEliProd(e){
	console.log(e.target.responseText);
}
/*######################################################################
#################### Fin de metodos de ticket ##########################
######################################################################*/

function rand_code(){
chars = "0123456789abcdefABCDEF";
lon = 10;
code = "";
for (x=0; x < lon; x++)
{
rand = Math.floor(Math.random()*chars.length);
code += chars.substr(rand, 1);
}
return code;
}

function registrar_ticket(){
  var datos=new FormData();
  var sol=new XMLHttpRequest();

  var f=document.querySelector("#form-reg-tic");
  var ticket={
    id:f.id.value,
    email:f.email.value,
    telenv:f.telenv.value,
    nomenv:f.nomenv.value,
    apenv:f.apenv.value,
    fecharec:f.fecharec.value,
    horarec:f.horarec.value,
    telrec:f.telrec.value,
    status:0,
    nomrec:f.nomrec.value,
    aprec:f.aprec.value,
    metodo:f.metodo.value,
    total:f.total.value
  };

  ticket=JSON.stringify(ticket);
  datos.append('ticket',ticket);
  datos.append('proc','realizarPago');

  sol.addEventListener("load",resRegTick,false);
  sol.open("POST","php/Carrito.php",true);
  sol.send(datos);
}
function resRegTick(e){
   document.getElementById('capa-ticket').innerHTML=e.target.responseText;
   console.log(e.target.responseText);
   emailjs.init("user_3M5akVAIt8yczsWqfUNFJ");
   new Vue({
                el: '#app',
                data(){
                    return {
                        from_name: '',
                        from_email: '',
                        message: '',
                        subject: '',
                        url:'',
                    }
                },
                methods: {
                    enviar(){
                        let data = {
                            cliente:document.getElementById('email').value,//Este se cambia
                            from_name: "Floreria monrevflores",
                            from_email: "hunter22001@hotmail.com",
                            message: "Tu pedido con folio: "+document.getElementById('folio').value+" a sido pagado con exito",
                            subject: "Estado de tu pedido",
                            url:"sin url aun",//dinamico
                        };
                        emailjs.send("Gmail","ria_clone", data)
                        .then(function(response) {
                            if(response.text === 'OK'){
                            	if (document.getElementById('donde').value==1) {
                            		var datos=new FormData();
  									var sol=new XMLHttpRequest();
  									datos.append('folio',document.getElementById('folio').value);
									datos.append('proc','oxxo');

									sol.addEventListener("load",resPago,false);
									sol.open("POST","php/Carrito.php",true);
									sol.send(datos);


                            	}else if (document.getElementById('donde').value==2) {
                            		document.getElementById('myform').submit();
                            	}
                                  
                            }
                           console.log("SUCCESS. status=%d, text=%s", response.status, response.text);
                        }, function(err) {
                            alert('Ocurrió un problema al enviar el correo');
                           console.log("FAILED. error=", err);
                        });}}}).enviar();
   

}

function listar_ticket(){
	var datos=new FormData();
	var sol=new XMLHttpRequest();

	datos.append('tarea',getTarea("listarTicket"));

	sol.addEventListener("load",resLisTick,false);
	sol.open("POST","http://192.168.0.13/floreria/php/proceso.php",true);
	sol.send(datos);
}
function resLisTick(e){
	console.log(e.target.responseText);
}

function actualizar_ticket(){
	var datos=new FormData();
	var sol=new XMLHttpRequest();

	var f=document.querySelector("#form-lis-pro");
	var ticket={
		id:parseInt(f.id.value),
		tel:f.tel.value,
		nombre:parseFloat(f.nombre.value),
		ap:f.ap.value,
		fecha:f.fecha.value,
		hora:f.hora.value,
		telenvia:f.telenvia.value,
		telrecibe:f.telrecibe.value,
		status:f.status.value,
		correo:f.correo.value
	};

	ticket=JSON.stringify(ticket);
	datos.append('ticket',ticket);
	datos.append('tarea',getTarea("actualizarTicket"));

	sol.addEventListener("load",resActTick,false);
	sol.open("POST","http://192.168.0.13/floreria/php/proceso.php",true);
	sol.send(datos);
}
function resActTick(e){
	console.log(e.target.responseText);
}

function eliminar_ticket(id){
	var datos=new FormData();
	var sol=new XMLHttpRequest();

	var ticket={
		id:parseInt(id)
	};

	ticket=JSON.stringify(ticket);          //Covierte el array a fomato json
	datos.append('ticket',ticket);
	datos.append('tarea',getTarea("eliminarTicket"));

	sol.addEventListener("load",resEliTick,false);
	sol.open("POST","http://192.168.0.13/floreria/php/proceso.php",true);
	sol.send(datos);
}
function resEliTick(e){
	console.log(e.target.responseText);
}
/*######################################################################
#################### Fin de metodos de ticket ##########################
######################################################################*/



function getTarea(tarea){
	var tarea;
	switch(tarea){
		case "registrarPresentacion":
			tarea={
				opc:"presentacion",
				acc:"registrar"
			};
		break;
		case "listarPresentacion":
			tarea={
				opc:"presentacion",
				acc:"listar"
			};
		case "actualizarPresentacion":
			tarea={
				opc:"presentacion",
				acc:"actualizar"
			};
		case "eliminarPresentacion":
			tarea={
				opc:"presentacion",
				acc:"eliminar"
			};
		break;
		case "registrarFlor":
			tarea={
				opc:"flor",
				acc:"registrar"
			};
		break;
		case "listarFlor":

		case "actualizarFlor":
			tarea={
				opc:"flor",
				acc:"actualizar"
			};
		case "eliminarFlor":
			tarea={
				opc:"flor",
				acc:"eliminar"
			};
		break;
		case "registrarProducto":

		break;
		case "listarProducto":
			tarea={
				opc:"producto",
				acc:"listar"
			};
		case "actualizarProducto":
			tarea={
				opc:"producto",
				acc:"actualizar"
			};
		case "eliminarProducto":
			tarea={
				opc:"producto",
				acc:"eliminar"
			};
		break;
		case "registrarTicket":
			tarea={
				opc:"ticket",
				acc:"registrar"
			};
		break;
		case "listarTicket":
			tarea={
				opc:"ticket",
				acc:"listar"
			};
		case "actualizarTicket":
			tarea={
				opc:"ticket",
				acc:"actualizar"
			};
		case "eliminarTicket":
			tarea={
				opc:"ticket",
				acc:"eliminar"
			};
		break;
	}
	return JSON.stringify(tarea);
}

function funcionesPrincipales() {
	sacarCarrito();
	sacarPresentaciones();
}

function sacarCarrito() {
	var data = new FormData();
  var sol = new XMLHttpRequest();

  data.append("proc", "sacarCarrito");

  sol.addEventListener("load", resSacarCarrito, false);
  sol.open("POST", "php/Carrito.php");
  sol.send(data);
}

function resSacarCarrito(e) {
	document.getElementById("carrito").innerHTML = e.target.responseText;
	sacarProductosCar();
}

function sacarProductosCar() {
	var data = new FormData();
  var sol = new XMLHttpRequest();

  data.append("proc", "sacarProductosCar");

  sol.addEventListener("load", resSacarProductosCar, false);
  sol.open("POST", "php/Carrito.php");
  sol.send(data);
}

function resSacarProductosCar(e) {
	//alert(e.target.responseText);
	var vec = e.target.responseText.split("?")
	document.getElementById("cantidad").innerHTML = vec[0];
	document.getElementById("shopping-cart").innerHTML = vec[1];
	document.getElementById("total").innerHTML = "$"+vec[2]+".00";
}

function sacarPresentaciones() {
	var data = new FormData();
  var sol = new XMLHttpRequest();

  data.append("proc", "sacarPresentaciones");

  sol.addEventListener("load", resSacarPresentaciones, false);
  sol.open("POST", "php/Catalogo.php");
  sol.send(data);
}

function resSacarPresentaciones(e) {
  document.getElementById("presentaciones").innerHTML = e.target.responseText;
}

function catalogoPresentaciones(nombre) {
	var data = new FormData();
  var sol = new XMLHttpRequest();

  data.append("proc", "catalogoPresentaciones");
	data.append("nombre_pre", nombre);

  sol.addEventListener("load", resCatalogoPresentaciones, false);
  sol.open("POST", "php/Catalogo.php");
  sol.send(data);
}

function resCatalogoPresentaciones(e) {
	//alert(e.target.responseText);
	document.getElementById("home").innerHTML = e.target.responseText;
}
//Carrito chilanggo
function sacarProductos() {
  var data = new FormData();
  var sol = new XMLHttpRequest();

  data.append("proc", "sacarProductos");

  sol.addEventListener("load", resSacarProductos, false);
  sol.open("POST", "php/Carrito.php");
  sol.send(data);
}

function resSacarProductos(e) {
  document.getElementById("home").innerHTML = e.target.responseText;
}

function cargarProdCarrito(id) {
  ingresarProducto(id);
}

function ingresarProducto(id) {
  var data = new FormData();
  var sol = new XMLHttpRequest();

  data.append("proc", "ingresarProducto");
  data.append("id_pro", id);

  sol.addEventListener("load", resIngresarProducto, false);
  sol.open("POST", "php/Carrito.php");
  sol.send(data);
}

function resIngresarProducto(e) {
  //alert(e.target.responseText);
	sacarCarrito();
  vistaCarrito();
  document.getElementById("capa-catalogos").innerHTML = e.target.responseText;
}

function detallesProducto(id) {
  var data = new FormData();
  var sol = new XMLHttpRequest();

  data.append("proc", "detallesProducto");
  data.append("id_pro", id);

  sol.addEventListener("load", resDetallesProducto, false);
  sol.open("POST", "php/Carrito.php");
  sol.send(data);
}

function resDetallesProducto(e) {
  document.getElementById("home").innerHTML = e.target.responseText;
}

function vistaCarrito() {
  var data = new FormData();
  var sol = new XMLHttpRequest();

  data.append("proc", "vistaCarrito");
  data.append("folio",rand_code());
  sol.addEventListener("load", resVistaCarrito, false);
  sol.open("POST", "php/Carrito.php");
  sol.send(data);
}

function resVistaCarrito(e) {
  document.getElementById("home").innerHTML = e.target.responseText;
}

function eliminarProductoCar(id) {
  var data = new FormData();
  var sol = new XMLHttpRequest();

  data.append("proc", "eliminarProducto");
  data.append("id_pro", id);

  sol.addEventListener("load", resEliminarProducto, false);
  sol.open("POST", "php/Carrito.php");
  sol.send(data);
}

function resEliminarProducto(e) {
  //alert(e.target.responseText);
	sacarCarrito();
	vistaCarrito();
}

function actualizarCostoCar(cant, id) {
  var data = new FormData();
  var sol = new XMLHttpRequest();

  data.append("proc", "actualizarCosto");
  data.append("id_pro", id);
  data.append("cantidad", cant.value);

  sol.addEventListener("load", resActualizarCostoCar, false);
  sol.open("POST", "php/Carrito.php");
  sol.send(data);
}

function resActualizarCostoCar(e) {
  if (e.target.responseText==1) {
    vistaCarrito();
  } else {
    alert("Hubo problemas al modificar la cantidad.");
  }
}
function $(selector){
	alert(selector);
	return document.querySelector(selector);
}

function pagoOxxo(){
	var datos=new FormData();
	var sol=new XMLHttpRequest();

	var f=document.querySelector("#fpagado");
	var folio=f.folio.value;
	var x=document.getElementById("file");
	file=x.files[0];

	datos.append('archivo',file);
	datos.append('folio',folio);
	datos.append('proc','pagadoOxxo')

	sol.addEventListener("load",resPagoO,false);
	sol.open("POST","http://192.168.0.24/floreria/php/Carrito.php",true);
	sol.send(datos);
}
function resPago(e){
	document.getElementById('home').innerHTML=e.target.responseText;
}
function resPagoO(e){
	alert(e.target.responseText);
}




/********************MI PARTE*************************************/

function filtrarProducto(){
	var datos = new FormData();
	var sol = new XMLHttpRequest();
	var f=document.querySelector("#form_filtrar");
	if(f.flor.value === "Todos"){
		datos.append('flor',"");
	}else{
		datos.append('flor',f.flor.value);
	}

	if(f.presentacion.value === "Todos"){
		datos.append('presentacion',"");
	}else{
		datos.append('presentacion',f.presentacion.value);
	}
	datos.append('precio',f.precio.value);
	datos.append("proc", "catalogoFiltrado");

	sol.addEventListener("load",resFiltrarProducto,false);
	sol.open("POST", "php/Catalogo.php");
	sol.send(datos);

  sol.addEventListener("load", resCatalogoPresentaciones, false);
  sol.open("POST", "php/Catalogo.php", true);
  sol.send(datos);
}

function resFiltrarProducto(e){
	document.getElementById("home").innerHTML = e.target.responseText;
}