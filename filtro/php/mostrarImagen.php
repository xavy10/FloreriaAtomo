<?php

##### http://www.lawebdelprogramador.com #####



# Comprovamos que se haya enviado algo desde el formulario

	# Definimos las variables

	$host="127.0.0.1";

	$port=21;

	$user="floreria";

	$password="1234";

	$ruta="productos";

	$local_file = 'prueba.jpg';

	$server_file = 'rosas.jpg';



	# Realizamos la conexion con el servidor

	$conn_id=@ftp_connect($host,$port);

	if($conn_id)

	{

		# Realizamos el login con nuestro usuario y contraseña

		if(@ftp_login($conn_id,$user,$password))

		{

			# Canviamos al directorio especificado

			if(@ftp_chdir($conn_id,$ruta))

			{

				// intenta descargar $server_file y guardarlo en $local_file
				if (ftp_get($conn_id, $local_file, $server_file, FTP_BINARY)) {
				    echo "Se ha guardado satisfactoriamente en $local_file\n";
				    echo "var_dump($local_file)";
				    echo "<img src='$local_file'>";
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

?>
