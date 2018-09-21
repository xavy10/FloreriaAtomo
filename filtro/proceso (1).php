<?php
header('Access-Control-Allow-Origin: *');
$con = new mysqli("192.168.0.30", "floreria", "1234", "floreria");
$tarea = $_POST["tarea"];
$arrayTa = json_decode($tarea,true);
//echo $arrayTa["opc"]." " .$arrayTa["acc"];
switch ($arrayTa["opc"]) {
    case 'usuario':
        switch ($arrayTa["acc"]) {
            case 'existe':
                $json = $_POST["usuario"];
                $array = json_decode($json,true);
                $datos = $con->query("SELECT * FROM user WHERE user_use='$array[user_use]' and password_use='$array[password_use]'");
                while ($ren = $datos->fetch_array(MYSQLI_ASSOC)) {
                    echo $ren["user_use"];
                }
                break;
            case 'buscar':
                $json = $_POST["folio"];
                $array = json_decode($json,true);
                $datos = $con->query("select t.id_tic, nombre_pro, nomrec_tic, status_prti from ticket as t join prodtick as pt on t.id_tic=pt.id_tic join producto as p on pt.id_pro=p.id_pro where t.id_tic='$array[folio]'");
                while ($ren = $datos->fetch_array(MYSQLI_ASSOC)) {
                    echo "
                    <div class='rounded p-3 mb-4 ' style='padding: 4px;box-shadow: 3px 2px 7px #888888;'>
                    <table style='width: 100%; margin-left:2%;'  class='text-center'>
                      <tr>
                          <td><h6 class='font-weight-light text-left'>".$ren["id_tic"]."</h6></td>
                        <td><h6 class='font-weight-light text-left'>".$ren["nomrec_tic"]."</h6></td>
                        <td><h6 class='font-weight-light text-left'>".$ren["nombre_pro"]."</h6></td>
                        <td></td>
                  <td></td>
                        <td><input type='text' value='".$ren["status_prti"]."'></td>
                  <td><input class='btn btn-info' type='button' value='Guardar' data-toggle='modal' data-target='#SacaModal'/></td>
                      </tr>
                    </table>
                    </div>";
                }
                break;
            
            default:
                # code...
                break;
        }
        break;
    case "presentacion":
        switch ($arrayTa["acc"]) {
            case 'registrar':
                $json = $_POST["presentacion"];
                $array = json_decode($json,true);
                echo $con->query("INSERT INTO presentacion VALUE(NULL, '$array[nombre]')");
                
                break;
            case 'listar':
               $datos= $con->query("SELECT * FROM presentacion order by nombre_pre asc");
                while ($ren = $datos->fetch_array(MYSQLI_ASSOC)) {
                    echo $ren["nombre_pre"]."<br>";
                }
                break;
            case 'cargar':
                $cargar="<select id='id_pre' class='custom-select'>";
                $datos= $con->query("SELECT * FROM presentacion order by nombre_pre asc");
                while ($ren = $datos->fetch_array(MYSQLI_ASSOC)) {
                    $cargar.="<option value='".$ren["id_pre"]."'>".$ren["nombre_pre"]."</option>";
                }
                $cargar.="</select>";
                echo $cargar;
                break;
            case 'eliminar':
                # code...
                break;
        }
        break;
    case 'flor':
        switch ($arrayTa["acc"]) {
            case 'registrar':
                $json = $_POST["flor"];
                $array = json_decode($json,true);
                echo $con->query("INSERT INTO flor VALUE(NULL, '$array[nombre]')");
                
                break;
            case 'listar':
               $datos= $con->query("SELECT * FROM flor order by nombre_flo asc");
                while ($ren = $datos->fetch_array(MYSQLI_ASSOC)) {
                    echo $ren["nombre_flo"]."<br>";
                }
                break;
            case 'cargar':
                $cargar="<select id='id_flo' class='custom-select'>";
                $datos= $con->query("SELECT * FROM flor order by nombre_flo asc");
                while ($ren = $datos->fetch_array(MYSQLI_ASSOC)) {
                    $cargar.="<option value='".$ren["id_flo"]."'>".$ren["nombre_flo"]."</option>";
                }
                $cargar.="</select>";
                echo $cargar;
                break;
            case 'eliminar':
                # code...
                break;
        }
        break;
    case 'producto':
         switch ($arrayTa["acc"]) {
            case 'registrar':
                
                $json = $_POST["producto"];
                $array = json_decode($json,true);
                $host="192.168.0.25";
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
                            if(@ftp_put($conn_id,$_FILES["archivo"]["name"],$_FILES["archivo"]["tmp_name"],FTP_BINARY))
                                echo "Fichero subido correctamente";
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

                // $json = $_POST["flor"];
                // $array = json_decode($json,true);
                $img= $_FILES["archivo"]["name"];
                $con->query("INSERT INTO producto VALUE(NULL, '$array[nombre]', '$array[descripcion]', '$array[precio]', '$img', 1, 'MX', '$array[id_flo]', '$array[id_pre]')");
                echo "INSERT INTO producto VALUE(NULL, '$array[nombre]', '$array[descripcion]', '$array[precio]', '$img', 1, 'MX', '$array[id_flo]', '$array[id_pre]')";
                break;
            case 'listar':
               $datos= $con->query("SELECT * FROM flor order by nombre_flo asc");
                while ($ren = $datos->fetch_array(MYSQLI_ASSOC)) {
                    echo $ren["nombre_flo"]."<br>";
                }
                break;
            case 'actualizar':
                
                break;
            case 'eliminar':
                # code...
                break;
        }
        break;
    default:
        # code...
        break;
}
$con->close();
?>