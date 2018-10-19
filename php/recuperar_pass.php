<? include_once("__encabezado.php"); 

	$data = $_POST;


	$data['funcion'] = 'recuperarClave';

   // $data['idcontacto'] = $_SESSION['usr_id'];
    //$data['idperfil'] = $_SESSION['usr_perfil'];
   // $data['email'] = 

	//var_dump($data);
  	$url = $url_backend.'/siig/class/BACKEND/generales/Contactos.php';
	$resp = obtenerCURL($url, $data, $status, $message, $controlDeErrores);
	
	//echo($data);
	$resultado["mensaje"] = $message;
	$resultado["estado"] = $status;
		
	/*if ($status==1) { //OK
		$resultado["actividad_id"] = $resp->idinsumo;
	} else {
		$resultado["actividad_id"] = $data['idinsumo'];
	}
	
	$resultado["respuesta"] = $resp;
	$resultado["estado"] = $status;
	$resultado["mensaje"] = $message;
	$resultado["controlDeErrores"] = $controlDeErrores;*/

	$JS1 = json_encode($resultado);
	

	echo '<JS>'.$JS1;
?>