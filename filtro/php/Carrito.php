<?php

  require_once("ProductoModelo.lib.php");
  $pro = new ProductoModelo();
  switch ($_POST["proc"]) {
    case 'sacarCarrito':
      echo "
        <li class='header-cart dropdown default-dropdown'>
          <a class='dropdown-toggle' data-toggle='dropdown' aria-expanded='true'>
            <div class='header-btns-icon'>
              <i class='fa fa-shopping-cart'></i>
              <span class='qty' id='cantidad'>0</span>
            </div>
            <strong class='text-uppercase'>Mi carrito:</strong>
            <br>
            <span id='total'>0.00</span>
          </a>
          <div class='custom-menu'>
            <div id='shopping-cart' height='300px'></div>
          </div>
        </li>
      ";
      break;
    case 'sacarProductos':
    $res = "";

    $consul = $pro->sacarDatos("");

    foreach($consul as $ren) {
      $dire = 'javascript:detallesProducto('.$ren["id_pro"].');';
      $res .= "
      <div style='height:150px;width:100px;float:left;margin:10px;'>
        <center>
          <table style='width:100%;'>
            <tr>
              <td>
                <h2>".$ren["nombre_pro"]."</h2>
              </td>
            </tr>
            <tr>
              <td>
                <h4>".$ren["imagen_pro"]."</h4>
              </td>
            </tr>
            <tr>
              <td>
                <h4>Costo: ".$ren["precio_pro"]."</h4>
              </td>
            </tr>
            <tr>
              <td>
                <a href='$dire'>Deltalles</a>
              </td>
            </tr>
          </table>
        </center>
      </div>";
    }
    echo $res;
      break;
    case 'ingresarProducto':
      if (isset($_COOKIE["carrito"])) {
        $arre = $_COOKIE["carrito"];
        $car = json_decode($arre);
        $encontro = false;
        for ($i=0; $i < count($car); $i++) {
          if ($car[$i]->id_pro==$_POST["id_pro"]) {
            $car[$i]->cantidad = $car[$i]->cantidad+1;
            $encontro = true;
          }
        }
        if (!$encontro) {
          $obj = array('id_pro' => $_POST["id_pro"],
                        'cantidad' => 1);
          array_push($car, $obj);
        }
        setcookie("carrito", json_encode($car), time()+3600*24*3);
        echo "Se ha P1 ingresado el producto a tu carrito.";//<br><br><a href='http://localhost/RIA/Actividad3'>Home</a>";
      } else {
        $arre[] = array('id_pro' => $_POST["id_pro"],
                      'cantidad' => 1);
        setcookie("carrito", json_encode($arre), time()+3600*24*3);
        echo "Se ha P2 ingresado el producto a tu carrito.";//<br><br><a href='http://localhost/RIA/Actividad3'>Home</a>";
      }
      break;
      case 'sacarProductosCar':
      $res = "
        <div class='shopping-cart-list'>
      ";
        if (isset($_COOKIE["carrito"])) {
          $arre = $_COOKIE["carrito"];
          $car = json_decode($arre);
          $consul = $pro->sacarDatos("");
          $total = 0;
          $cantidad = 0;
          for ($i=0; $i < count($car); $i++) {
            foreach($consul as $ren) {
              if ($ren["id_pro"]==$car[$i]->id_pro) {
                $cantidad = $cantidad+1;
                $res .= "
                  <div class='product product-widget'>
                    <div class='product-thumb'>
                      <img src='http://192.168.0.24/floreria/php/imagenes/".$ren['imagen_pro']."'>
                    </div>
                    <div class='product-body'>
                      <h3 class='product-price'>".$ren['precio_pro']."<span class='qty'>x".$car[$i]->cantidad."</span></h3>
                      <h2 class='product-name'><a href='#'>".$ren['nombre_pro']."</a></h2>
                    </div>
                    <button class='cancel-btn' onclick='javascript:eliminarProductoCar(".$car[$i]->id_pro.")'><i class='fa fa-trash'></i></button>
                  </div>
                ";
                $total = $total+($ren["precio_pro"]*$car[$i]->cantidad);
              }
            }
          }
        } else {
          $res .= "<b>No hay productos en el carrito.</b>";
        }
        $res .= "
          </div>
          <div class='shopping-cart-btns'>
            <button class='main-btn'><a href='javascript:vistaCarrito();'>Ver</a></button>
            <button class='main-btn' id='pagarCarro'>Pagar <i class='fa fa-arrow-circle-right'></i></button>
          </div>
        ";
        echo $cantidad."?".$res."?".$total;
        break;
    case 'vistaCarrito':
     if (isset($_COOKIE["carrito"])) {
        $folio=$_POST["folio"];
        $arre = $_COOKIE["carrito"];
        $car = json_decode($arre);
        $consul = $pro->sacarDatos("");
        $res = "
        <center>
          <h2>Mi carrito</h2>
          <table style='width:100%;'>
            <tr>
              <th>Imagen</th>
              <th>Nombre</th>
              <th>Cantidad</th>
              <th>Costo Unitario</th>
              <th>Subtotal</th>
              <th>Total</th>
              <th>Modificacion</th>
              <th>Pagar</th>
            </tr>
        ";
        $total = 0;
        for ($i=0; $i < count($car); $i++) {
          foreach($consul as $ren) {
            if ($ren["id_pro"]==$car[$i]->id_pro) {
              $res .= "
                <tr>
                  <td><center><h3>".$ren["imagen_pro"]."</h3></center></td>
                  <td><center><h3>".$ren["nombre_pro"]."</h3></center></td>
                  <td><center><input type='number' value='".$car[$i]->cantidad."' min='1' max='50' onBlur='actualizarCostoCar(this, ".$car[$i]->id_pro.")'></center></td>
                  <td><center><h3>".$ren["precio_pro"]."</h3></center></td>
                  <td><center><input type='number' value='".$ren["precio_pro"]*$car[$i]->cantidad."' readonly></center></td>
                  <td><center></center></td>
                  <td><center><input type='button' onclick='javascript:eliminarProductoCar(".$car[$i]->id_pro.")' value='Eliminar'></center></td>
                </tr>
              ";
              $total = $total+($ren["precio_pro"]*$car[$i]->cantidad);
            }
          }
        }
        if ($total==0) {
          $res = "<h2>No P1 tienes productos en el carrito.</h2>";
        } else {
          $res .= "
              <tr>
                <td colspan='3'></td>
                <td><center><input type='number' id='total' value='".$total."' readonly></center></td>
                <td></td>
              </tr>
              <tr>
              <td colspan='2'>
               <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#AgregaTicket'>Pagar</button>


<!-- Modal flores -->
        <div class='modal fade' id='AgregaTicket' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
          <div class='modal-dialog modal-lg' role='document'>
            <div class='modal-content'>
              <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLabel'>Ticket</h5>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
      </button>
              </div>
              <div class='modal-body'>
                <form action='javascript:registrar_ticket()' id='form-reg-tic'>
                  <div class='row'>
                  <div class='col-md-1' style='text-align:'><span class='form-control' style='border: none'>Folio</span></div>
                  <div class='col-md-4'><input type='text' class='form-control' aria-label='Small' aria-describedby='inputGroup-sizing-sm' value='$folio' disabled id='id'></div>
                    <div class='col-md-7'><input type='email' class='form-control' aria-label='Small' aria-describedby='inputGroup-sizing-sm' id='email'></div>
                  <div class='col-md-7'></div>
                </div>
                <br/>
                <div class='row'>
                  <div class='col-md-12'>
                    <input type='text' class='form-control' aria-label='Small' aria-describedby='inputGroup-sizing-sm' placeholder='Telefono de quien envia' id='telenv'>
                  </div>
                </div>
                <br/>
                <div class='row'>
                  <div class='col-md-6'>
                    <input type='text' class='form-control' aria-label='Small' aria-describedby='inputGroup-sizing-sm' placeholder='Nombre persona que envia' id='nomenv'>
                  </div>
                  <div class='col-md-6'>
                    <input type='text' class='form-control' aria-label='Small' aria-describedby='inputGroup-sizing-sm' placeholder='Apellidos persona que envia' id='apenv'>
                  </div>
                </div>
                
                <br/>
                <div class='row'>
                  <div class='col-md-6'>
                    <input type='date' id='fecharec' class='form-control' aria-label='Small' aria-describedby='inputGroup-sizing-sm'>
                  </div>
                  <div class='col-md-6'>
                      <input type='time' id='horarec' class='form-control' aria-label='Small' aria-describedby='inputGroup-sizing-sm' >
                  </div>
                </div>
                <br/>
                <div class='row'>
                  <div class='col-md-12'>
                    <input type='text' id='telrec' class='form-control' aria-label='Small' aria-describedby='inputGroup-sizing-sm' placeholder='Telefono de quien recibe'>
                  </div>
                </div>
                <br/>
                <div class='row'>
                  <div class='col-md-6'>
                    <input type='text' id='nomrec' class='form-control' aria-label='Small' aria-describedby='inputGroup-sizing-sm' placeholder='Nombre persona que recibe'>
                  </div>
                  <div class='col-md-6'>
                    <input type='text' id='aprec' class='form-control' aria-label='Small' aria-describedby='inputGroup-sizing-sm' placeholder='Apellidos persona que recibe'>
                  </div>
                </div>
                <br/>
                <div class='row'>
                  <div class='col-md-12'style='text-align:'><span class='form-control' style='border: none'>Metodo de pago</span>
                  </div>
                </div>
                <div class='row'>
                  <div class='col-md-2'></div>
                  <div class='col-md-2'><img src='oxxo.png' style='width: 100px; height: 50px'></div>
                  <div class='col-md-2'><input type='radio' name='metodo' class='form-control' aria-label='Small' aria-describedby='inputGroup-sizing-sm' value='1'></div>
                  <div class='col-md-2'><img src='paypal.png' style='width: 100px; height: 50px'></div>
                  <div class='col-md-2'><input type='radio' name='metodo' class='form-control' aria-label='Small' aria-describedby='inputGroup-sizing-sm' value='2'></div>
                  <div class='col-md-2'></div>
                </div>
                <br/>
                <div class='row'>
                  <div class='col-md-1' style='text-align:'><span class='form-control' style='border: none'>Total</span></div>
                  <div class='col-md-4'><input type='text' class='form-control' aria-label='Small' aria-describedby='inputGroup-sizing-sm' value='$total' disabled id='total'></div>
                  <div class='col-md-7'></div>
                  <div class='modal-footer'>
                  <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                  <button type='submit' class='btn btn-primary' onclick='javascript:document.querySelector('#form-reg-tic').submit();'>Pagar</button>
                </div> 
                </div> 
                </div>                
                </form>
              
              </div>
            </div>
          </div>
      </main>
    </div>


              </td>

              </tr>
            </table>
          </center>";
        }
        echo $res;
      } else {
        echo "<h2>No tienes P2 productos en el carrito.</h2>";
      }
      break;
    case 'detallesProducto':
    $res = "";

    $consul = $pro->sacarDatos("");

    foreach($consul as $ren) {
      if ($ren["id_pro"]==$_POST["id_pro"]) {
        $flor = $pro->sacarFlores();
        $pres = $pro->sacarPresentacion();
        $res .= "
          <div>
            <center>
              <table>
                <tr>
                  <td>
                    <h2>".$ren["nombre_pro"]."</h2>
                  </td>
                </tr>
                <tr>
                  <td>
                    <h4>".$ren["imagen_pro"]."</h4>
                  </td>
                </tr>
                <tr>
                  <td>
                    <h4>$".$ren["precio_pro"]."</h4>
                  </td>
                </tr>
                <tr>
                  <td>
                    <h4>Descripcion: ".$ren["descrip_pro"]."</h4>
                  </td>
                </tr>
                <tr>
                  <td>
                    <h4>Flores: ";
                    foreach ($flor as $col) {
                      if ($col["id_flo"]==$ren["id_flo"]) {
                        $res .= $col["nombre_flo"];
                      }
                    }
                    $res .= "</h4>
                  </td>
                </tr>
                <tr>
                  <td>
                    <h4>Presentacion: ";
                    foreach ($pres as $col) {
                      if ($col["id_pre"]==$ren["id_pre"]) {
                        $res .= $col["nombre_pre"];
                      }
                    }
                    $res .= "</h4>
                  </td>
                </tr>
                <tr>
                  <td>
                    <input type='button' onclick='cargarProdCarrito(".$ren["id_pro"].")' value='Cargar al carrito'/>
                  </td>
                </tr>
              </table>
            </center>
          </div>
        ";
      }
    }
    echo $res;
      break;
    case 'eliminarProducto':
      $arre = $_COOKIE["carrito"];
      $car = json_decode($arre);
      $nuev[] = array('id_pro' => 1,
                     'cantidad' => 0);
      for ($i=1; $i < count($car); $i++) {
        if ($car[$i]->id_pro!=$_POST["id_pro"]) {
          array_push($nuev, $car[$i]);
        }
      }
      setcookie("carrito", json_encode($nuev), time()+1800);
      echo "Fue eliminado el producto.";
      break;

    case 'actualizarCosto':
      $arre = $_COOKIE["carrito"];
      $car = json_decode($arre);
      $encontro = false;
      for ($i=0; $i < count($car); $i++) {
        if ($car[$i]->id_pro==$_POST["id_pro"]) {
          $car[$i]->cantidad = $_POST["cantidad"];
          $encontro = true;
        }
      }
      setcookie("carrito", json_encode($car), time()+3600*24*3);
      if ($encontro) {
        echo "1";
      } else {
        echo "0";
      }
      break;
      //----------------------------------------Parte del ticket---------------->
        case 'realizarPago':
        include('../include/function.php');
include('../include/conexion.php');

$arre = $_COOKIE["carrito"];
$car = json_decode($arre);
abrir_conexion();//Abre la conexion a la base de datos
if (isset($_POST['ticket'])){  
  $array=json_decode($_POST["ticket"],true);
  $folio=$array['id'];
  if ($array['metodo']=='1') {
    $arre = $_COOKIE["carrito"];
    $car = json_decode($arre);
    Insert_To_Table_Ticket($array);
    for ($i=0; $i < count($car); $i++) {
      if ($car[$i]->cantidad>0) {
        Insert_To_Table_ProdTic($car[$i]->cantidad, $car[$i]->id_pro, $folio);
      }

    }
    setcookie('carrito','',time()-100);

    echo ";
    <input type='hidden' id='email' value='$array[email]'>
    <input type='hidden' id='folio' value='$array[id]'>
    <input type='hidden' id='donde' value='1'>";

  }elseif ($array['metodo']=='2') {
    $arre = $_COOKIE["carrito"];
    $car = json_decode($arre);
    Insert_To_Table_Ticket($array);
    for ($i=0; $i < count($car); $i++) {
      if ($car[$i]->cantidad>0) {
        Insert_To_Table_ProdTic($car[$i]->cantidad, $car[$i]->id_pro, $folio);
      }

    }
    actTicket($array[id]);
    setcookie('carrito','',time()-100);

    $paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
  //URL Paypal para Recibir pagos 
  //$paypal_url = 'https://www.paypal.com/cgi-bin/webscr';
  //Correo electronico del comercio. 
     $merchant_email = 'hunter22001@hotmail.com';
  //Pon aqui la URL para redireccionar cuando el pago es completado
  $cancel_return = "http://localhost/floreria/php/pago.php";
  //Colocal la URL donde se redicciona cuando el pago fue completado con exito.
  $success_return = "http://192.168.0.24/floreria/index.html";
echo "
<div style=margin-left: 40%'><img src='img/processing_animation.gif'>
<form id='myform' action='$paypal_url' method='post' target='_top'>
<input type='hidden' name='cmd' value='_xclick'>
<input type='hidden' name='cancel_return' value='$cancel_return'>
<input type='hidden' name='return' value='$success_return'>
<input type='hidden' name='business' value='$merchant_email'>
<input type='hidden' name='lc' value='C2'>
<input type='hidden' name='item_name' value='Floreria'>
<input type='hidden' name='amount' value='$array[total]'>
<input type='hidden' name='currency_code' value='MXN'>
<input type='hidden' name='button_subtype' value='services'>
<input type='hidden' name='no_note' value='0'>
<input type='hidden' id='email' value='$array[email]'>
<input type='hidden' id='folio' value='$array[id]'>
<input type='hidden' id='donde' value='2'>
</form>";
?>
<?
    # code...
  }
  //URL Paypal Modo pruebas.
  
} else {
  header('location:index.html');
  exit;
}
          break;
          case 'oxxo':
          echo "
          <form action='javascript:pagoOxxo()' id='fpagado'>
          <input type='text' id='folio' disabled value='$_POST[folio]'>
          <input type='file' id='file'>
          <input type='submit' value='Enviar Ticket'>
          </form>
          ";
            break;
            case 'pagadoOxxo':
            include('../include/function.php');
include('../include/conexion.php');
abrir_conexion();
            $host="198.162.0.25";
                $port=21;
                $user="floreria";
                $password="1234";
                $ruta="productos";
                $conn_id=@ftp_connect($host,$port);
                if($conn_id)
                {
                    # Realizamos el login con nuestro usuario y contraseña
                    if(@ftp_login($conn_id,$user,$password))
                    {
                        # Canviamos al directorio especificado
                        if(@ftp_chdir($conn_id,$ruta))
                        {
                            # Subimos el fichero
                            if(@ftp_put($conn_id,$_FILES["archivo"]["name"],$_FILES["archivo"]["tmp_name"],FTP_BINARY)){
                                actTicket($_POST["folio"]);

                                echo "Fichero subido correctamente";}

                            else
                                echo "No ha sido posible subir el fichero";
                        }else
                            echo "No existe el directorio especificado";
                    }else
                        echo "El usuario o la contraseña son incorrectos";
                    # Cerramos la conexion ftp
                    ftp_close($conn_id);
                }else
                    echo "No ha sido posible conectar con el servidor";
              break;
  }

 ?>
