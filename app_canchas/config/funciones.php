<?php

  //Archivo de funciones

   include('conexion.php');

   session_start();


   $peticion = isset($_POST['peticion']) ? $_POST['peticion'] : null;
   $parametros = isset($_POST['parametros']) ? $_POST['parametros'] : null;

   switch($peticion)
   {
		//Caso para generar las rutas en la base de datos
		case 'generar-rutas':
		{
			$x = $parametros['x'];
			$y = $parametros['y'];

			$usuario = $parametros['user'];

			//sql de calculo de rutas
			$sql="select generaRUTAS($x, $y , $nivel );";

			$query = pg_query($dbcon,$sql);
			//si se ejecuto la consulta con exito
			if($query)
			{
				echo "NUEVA_EMERGENCIA_CREADA";
			}else
			{
				echo "NOVALIDO";
			}

			break;
		}



		case 'recupera_ruta':
		{
			$ruta = $parametros['ruta'];

			if($ruta=='emergencia_hospital')
			{
				$sql=" SELECT row_to_json(fc)
				FROM ( SELECT 'FeatureCollection' As type, array_to_json(array_agg(f)) As features
				FROM (SELECT 'Feature' As type
				, ST_AsGeoJSON(lg.the_geom)::json As geometry
				, row_to_json((SELECT l FROM (SELECT node, edge) As l
				)) As properties
				FROM ruta_entre_usuario_hospital As lg   ) As f )  As fc;";

				$query3 = pg_query($dbcon,$sql);
				$row = pg_fetch_row($query3);
				echo $row[0];
			}

			break;
		}

   }


?>
