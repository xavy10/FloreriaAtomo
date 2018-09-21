<?php

  require_once("ProductoModelo.lib.php");
  $pro = new ProductoModelo();

  switch ($_POST["proc"]) {
    case 'sacarPresentaciones':
      $res = "";
      $pre = $pro->sacarPresentaciones();
      foreach ($pre as $col) {
        $dire = 'javascript:catalogoPresentaciones("'.$col["nombre_pre"].'");';
        $res .= "
          <li><a href='$dire'>".$col["nombre_pre"]."</a>
        ";
      }
      echo $res;
      break;
    case 'catalogoPresentaciones':
    $host="localhost";
    $port=21;
    $user="floreria";
    $password="1234";
    $ruta="productos";
      $res = "
      <div class='section'>
        <!-- container -->
        <div class='container'>
          <!-- row -->
          <div class='row'>
          <!-- MI PARTE CARRITO -->
            <form action='javascript:filtrarProducto();' id='form_filtrar'>
            <!-- ASIDE -->
            <div id='aside' class='col-md-3'>
              <!-- aside widget -->
              <div class='aside'>
                <h3 class='aside-title'>Buscar por tipo de flor:</h3>
                <ul class='filter-list'>
                  <li><input aria-label='Small' aria-describedby='inputGroup-sizing-sm' type='radio' name='flor' id='flor' value='Todos' checked/>Todos</li><br/>";
        $flores = $pro->sacarFlores();
        foreach ($flores as $tupla) {
            $res .= "<li><input  aria-label='Small' aria-describedby='inputGroup-sizing-sm' type='radio' name='flor' id='flor' value='".$tupla["nombre_flo"]."'/>".$tupla["nombre_flo"]."</li><br>";
        }
        $res .= "
                </ul>

              </div>
              <!-- /aside widget -->

              <!-- aside widget -->
              <div class='aside'>
                <h3 class='aside-title'>Buscar por tipo de presentacion:</h3>
                <ul class='filter-list'>
                  <li><input aria-label='Small' aria-describedby='inputGroup-sizing-sm' type='radio' name='presentacion' id='presentacion' value='Todos' checked/>Todos</li><br/>";
        $pro = new ProductoModelo();
        $presentacionesFiltro = $pro->sacarPresentacion();
        foreach ($presentacionesFiltro as $tupla1) {
            $res .= "<li><input  aria-label='Small' aria-describedby='inputGroup-sizing-sm' type='radio' name='presentacion' id='presentacion' value='".$tupla1["nombre_pre"]."'/>".$tupla1["nombre_pre"]."</li><br>";
        }
        $res .= "
                </ul>

              </div>
              <!-- /aside widget -->

              <!-- aside widget -->
              <div class='aside'>
                <h3 class='aside-title'>Filtrado por precio</h3>
                <input type='range' name='precio' id='precio' min='0' max='10000'/>
              </div>
              <!-- aside widget -->
              <input  class='primary-btn'type='submit' value='Buscar'/>

            </div>
            <!-- /ASIDE -->

            </form>
            <!-- MI PARTE CARRITO -->
            
            <!-- MAIN -->
            <div id='main' class='col-md-9'>
              <!-- store top filter -->
              <div class='store-filter clearfix'>
                <div class='pull-left'>
                  <div class='row-filter'>
                    <a href='#'><i class='fa fa-th-large'></i></a>
                    <a href='#' class='active'><i class='fa fa-bars'></i></a>
                  </div>
                  <div class='sort-filter'>
                    <span class='text-uppercase'>Ordenar por:</span>
                    <select class='input'>
                        <option value='0'>ordenar por</option>
                        <option value='0'>Lo mas nuevo</option>
                        <option value='0'>Precio (de bajo a alto)</option>
                        <option value='0'>Precio (de alto a bajo)</option>
                      </select>
                    <a href='#' class='main-btn icon-btn'><i class='fa fa-arrow-down'></i></a>
                  </div>
                </div>
              </div>
              <!-- /store top filter -->
              <!-- STORE -->
              <div id='store'>
            <!-- row -->
            <div class='row'>
      ";
      $cata = $pro->sacarCatalogo($_POST["nombre_pre"]);
      foreach ($cata as $col) {
        if ($col["imagen_pro"]!=NULL) {
          $directory = "imagenes/".$col["imagen_pro"];
          if (!file_exists($directory)) {
            $local_file = "imagenes/".$col["imagen_pro"];
            $server_file = $col["imagen_pro"];
            $conn_id=@ftp_connect($host,$port);
          	if($conn_id) {
          		if(@ftp_login($conn_id,$user,$password)) {
          			if(@ftp_chdir($conn_id,$ruta)) {
          				if (ftp_get($conn_id, $local_file, $server_file, FTP_BINARY)) {
                    $ima = "<img src='http://192.168.0.24/floreria/php/".$local_file."' width='33%' height='auto' alt=''>";
          				   //  if (file_exists($local_file)) {
          					  //   unlink($local_file);
          					  // }else
          					  // echo "No se puedo eliminar";
          				} else {
          				    echo "Ha habido un problema\n";
          				}
          			}else
          				echo "No existe el directorio especificado";
          		}else
          			echo "El usuario o la contraseña son incorrectos";
          		# Cerramos la conexion ftp
          		ftp_close($conn_id);
          	}else
          		echo "No ha sido posible conectar con el servidor";
          } else {
            $ima = "<img src='http://192.168.0.24/floreria/php/".$directory."' width='33%' height='auto' alt=''>";
          }
          $res .= "
                <!-- Product Single -->
                <div class='col-md-4 col-sm-6 col-xs-6' style='margin:10px;'>
                  <div class='product product-single'>
                    <div class='product-thumb'>
                      <button class='main-btn quick-view'><i class='fa fa-search-plus'></i>Vista rapida</button>
                      ".$ima."
                    </div>
                    <div class='product-body'>
                      <h3 class='product-price'>".$col["precio_pro"]."</h3>
                      <h2 class='product-name'>".$col["nombre_pro"]."</a></h2>
                      <div class='product-btns'>
                        <button class='primary-btn add-to-cart' onclick='cargarProdCarrito(".$col['id_pro'].")'><i class='fa fa-shopping-cart'></i>
                        <button class='primary-btn add-to-cart'><a href='productos/producto01.html'></i>Ver producto</button>
                      </div>
                    </div>
                  </div>
                </div>
          ";
        }
      }
      $res .= "
                </div>
                <!-- /row -->
              </div>
              <!-- /STORE -->
            </div>
            <!-- /MAIN -->
          </div>
          <!-- /row -->
        </div>
        <!-- /container -->
      </div>
      ";
      echo $res;
      break;
      ////////////////////////////////////////////MI PARTE//////////////////
    case 'catalogoFiltrado':
    $host="192.168.0.25";
    $port=21;
    $user="floreria";
    $password="1234";
    $ruta="productos";
      $res = "
      <div class='section'>
        <!-- container -->
        <div class='container'>
          <!-- row -->
          <div class='row'>
          <!-- MI PARTE CARRITO -->
            <form action='javascript:filtrarProducto();' id='form_filtrar'>
            <!-- ASIDE -->
            <div id='aside' class='col-md-3'>
              <!-- aside widget -->
              <div class='aside'>
                <h3 class='aside-title'>Buscar por tipo de flor:</h3>
                <ul class='filter-list'>
                  <li><input aria-label='Small' aria-describedby='inputGroup-sizing-sm' type='radio' name='flor' id='flor' value='Todos' checked/>Todos</li><br/>";
        $flores = $pro->sacarFlores();
        $checked = "checked";
        foreach ($flores as $tupla) {
          if($tupla["nombre_flo"]===$_POST["flor"]){
            $checked = "checked";
          }else{
            $checked = "";
          }
            $res .= "<li><input  aria-label='Small' aria-describedby='inputGroup-sizing-sm' type='radio' name='flor' id='flor' value='".$tupla["nombre_flo"]."' ".$checked." '/>".$tupla["nombre_flo"]."</li><br>";
        }
        $res .= "
                </ul>

              </div>
              <!-- /aside widget -->

              <!-- aside widget -->
              <div class='aside'>
                <h3 class='aside-title'>Buscar por tipo de presentacion:</h3>
                <ul class='filter-list'>
                  <li><input aria-label='Small' aria-describedby='inputGroup-sizing-sm' type='radio' name='presentacion' id='presentacion' value='Todos' checked/>Todos</li><br/>";
        $pro = new ProductoModelo();
        $presentacionesFiltro = $pro->sacarPresentacion();
        foreach ($presentacionesFiltro as $tupla1) {
          if($tupla1["nombre_pre"]===$_POST["presentacion"]){
            $checked = "checked";
          }else{
            $checked = "";
          }
            $res .= "<li><input  aria-label='Small' aria-describedby='inputGroup-sizing-sm' type='radio' name='presentacion' id='presentacion' value='".$tupla1["nombre_pre"]."' ".$checked."/>".$tupla1["nombre_pre"]."</li><br>";
        }
        $precioFiltro = "";
        if($_POST["precio"]!=0){
          $precioFiltro = "value='".$_POST["precio"]."'";
        }
        $res .= "
                </ul>

              </div>
              <!-- /aside widget -->

              <!-- aside widget -->
              <div class='aside'>
                <h3 class='aside-title'>Filtrado por precio</h3>
                <input type='range' name='precio' id='precio' ".$precioFiltro." min='0' max='10000'/>
              </div>
              <!-- aside widget -->
              <input  class='primary-btn'type='submit' value='Buscar'/>

            </div>
            <!-- /ASIDE -->

            </form>
            <!-- MI PARTE CARRITO -->
            
            <!-- MAIN -->
            <div id='main' class='col-md-9'>
              <!-- store top filter -->
              <div class='store-filter clearfix'>
                <div class='pull-left'>
                  <div class='row-filter'>
                    <a href='#'><i class='fa fa-th-large'></i></a>
                    <a href='#' class='active'><i class='fa fa-bars'></i></a>
                  </div>
                  <div class='sort-filter'>
                    <span class='text-uppercase'>Ordenar por:</span>
                    <select class='input'>
                        <option value='0'>ordenar por</option>
                        <option value='0'>Lo mas nuevo</option>
                        <option value='0'>Precio (de bajo a alto)</option>
                        <option value='0'>Precio (de alto a bajo)</option>
                      </select>
                    <a href='#' class='main-btn icon-btn'><i class='fa fa-arrow-down'></i></a>
                  </div>
                </div>
              </div>
              <!-- /store top filter -->
              <!-- STORE -->
              <div id='store'>
            <!-- row -->
            <div class='row'>
      ";
      $cata = $pro->filtrarProductos($_POST["flor"],$_POST["presentacion"],$_POST["precio"]);
      foreach ($cata as $col) {
        if ($col["imagen_pro"]!=NULL) {
          $directory = "imagenes/".$col["imagen_pro"];
          if (!file_exists($directory)) {
            $local_file = "imagenes/".$col["imagen_pro"];
            $server_file = $col["imagen_pro"];
            $conn_id=@ftp_connect($host,$port);
            if($conn_id) {
              if(@ftp_login($conn_id,$user,$password)) {
                if(@ftp_chdir($conn_id,$ruta)) {
                  if (ftp_get($conn_id, $local_file, $server_file, FTP_BINARY)) {
                    $ima = "<img src='http://192.168.0.24/floreria/php/".$local_file."' width='33%' height='auto' alt=''>";
                     //  if (file_exists($local_file)) {
                      //   unlink($local_file);
                      // }else
                      // echo "No se puedo eliminar";
                  } else {
                      echo "Ha habido un problema\n";
                  }
                }else
                  echo "No existe el directorio especificado";
              }else
                echo "El usuario o la contraseña son incorrectos";
              # Cerramos la conexion ftp
              ftp_close($conn_id);
            }else
              echo "No ha sido posible conectar con el servidor";
          } else {
            $ima = "<img src='http://192.168.0.24/floreria/php/".$directory."' width='33%' height='auto' alt=''>";
          }
          $res .= "
                <!-- Product Single -->
                <div class='col-md-4 col-sm-6 col-xs-6' style='margin:10px;'>
                  <div class='product product-single'>
                    <div class='product-thumb'>
                      <button class='main-btn quick-view'><i class='fa fa-search-plus'></i>Vista rapida</button>
                      ".$ima."
                    </div>
                    <div class='product-body'>
                      <h3 class='product-price'>".$col["precio_pro"]."</h3>
                      <h2 class='product-name'>".$col["nombre_pro"]."</a></h2>
                      <div class='product-btns'>
                        <button class='primary-btn add-to-cart' onclick='cargarProdCarrito(".$col['id_pro'].")'><i class='fa fa-shopping-cart'></i>
                        <button class='primary-btn add-to-cart'><a href='productos/producto01.html'></i>Ver producto</button>
                      </div>
                    </div>
                  </div>
                </div>
          ";
        }
      }
      $res .= "
                </div>
                <!-- /row -->
              </div>
              <!-- /STORE -->
            </div>
            <!-- /MAIN -->
          </div>
          <!-- /row -->
        </div>
        <!-- /container -->
      </div>
      ";
      echo $res;
      break;
  }

?>
