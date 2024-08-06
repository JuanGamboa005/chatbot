<?php 
require_once "global.php";


$conexion = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

mysqli_query($conexion, 'SET NAMES "'.DB_ENCODE.'"');
//Si hay error 
if (mysqli_connect_errno())
{
	printf("Falló la conexión a la base de datos: %s\n", mysqli_connect_error());
	exit();
}



if (!function_exists('ejecutarConsulta'))
{
	function ejecutarConsulta($sql)
	{
		global $conexion;
		$query = $conexion->query($sql);
		return $query;
	}

	
	function ejecutarConsultaTrans($sql)
	{
		global $conexion;
		
		$conexion->autocommit(false);

		for($i=0;$i<count($sql);$i++){
			$query= $conexion->query($sql[$i]);
			if (!$query){
				$error = $conexion;
                $conexion->rollback();
				$conexion->autocommit(false);
				// return var_dump($sql[$i]);
				return $query;
				break; 
			}
		}

		$conexion->commit();
		return $query;
	}	

	function ejecutarConsultaSimpleFila($sql)
	{
		global $conexion;
		$query = $conexion->query($sql);
		$row = $query->fetch_assoc();
		return $row;
	}


	function limpiarCadena($str)
	{
		global $conexion;
        // var_dump( $conexion);
		$str =  mysqli_real_escape_string($conexion,trim($str));
		return htmlspecialchars($str);
	}


}

 ?>