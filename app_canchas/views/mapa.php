<div id="mapid" style="width: 800px; height: 600px;">
</div>

<!-- Modal -->
<div id="myVentanaModal" class="modal hide fade" >

		<P ALIGN=center>Localizar Cancha mas cercana</p>
    
		<br>
		<P ALIGN=center>Tu ubicación:</p>

		<P ALIGN=center> <b>Lon:</b> <span id="coord_x"></span>  <b>Lat:</b> <span id="coord_y"></span> </p>

		<br>

</div>

<script>


//Llamado de capas para cartografia base//
	construirElementos();

	  var basemaps =
		{
			Grayscale: L.tileLayer('http://{s}.tiles.wmflabs.org/bw-mapnik/{z}/{x}/{y}.png',
			{
				maxZoom: 18,
				attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
			}),

			Streets: L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
			{
				maxZoom: 19,
				attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
			})
		};

		//Llmado de capas base//

		var Comunas = new L.tileLayer.wms('http://idesc.cali.gov.co:8081/geoserver/wms?', {
		  layers: 'idesc:mc_comunas',
		  attribution: 'comunas Cali',
		  format: 'image/png',
		  transparent: true
		});


		//Capas propias//

		var canchas = new L.tileLayer.wms('http://localhost:8080/geoserver/wms?', {
		  layers: 'app_canchas:empresas',
		  attribution: 'empresas',
		  format: 'image/png',
		  transparent: true
		});

		var clinicas = new L.tileLayer.wms('http://localhost:8080/geoserver/wms?', {
		  layers: 'sig_canchas:clinicas',
		  attribution: 'clinicas',
		  format: 'image/png',
		  transparent: true
		});

		var cajeros = new L.tileLayer.wms('http://localhost:8080/geoserver/wms?', {
		  layers: 'sig_canchas:cajeros',
		  attribution: 'cajeros',
		  format: 'image/png',
		  transparent: true
		});
		
		var vias = new L.tileLayer.wms('http://localhost:8080/geoserver/wms?', {
		  layers: 'app_canchas:vias_wgs84',
		  attribution: 'vias',
		  format: 'image/png',
		  transparent: true
		});




	var flag_reporte=false;


	var mymap = L.map('mapid',
	{
		zoom: 10
	}).setView([3.42335,-76.52086], 13);

//Grupos de capas//
  basemaps.Grayscale.addTo(mymap);
  Comunas.addTo(mymap);
  canchas.addTo(mymap);
  clinicas.addTo(mymap);
  cajeros.addTo(mymap);
  vias.addTo(mymap);

  var capamarcador = L.marker([3.44420 , -76.47892 ]).addTo(mymap).bindPopup("<b>Hola Clase</b><br />Esta es una ventana Emergente !!.").openPopup();

//ControlCapas

  var groupedOverlays = {
	  "cartografia base": {
		"Comunas": Comunas
	  },
	  "Capas propias": {
		"cajeros":cajeros,
		"clinicas": clinicas,
		"canchas": canchas,
		"vias": vias
	  }
	};


	var layerControl=L.control.groupedLayers(basemaps, groupedOverlays);
	layerControl.addTo(mymap);

	var popup = L.popup();

	function onMapClick(e) {

		if(flag_reporte)
		{
			lanzarVentanaBusqueda(e);
			flag_reporte=false;
		}
	}

	mymap.on('click', onMapClick);


	//Para que el cursor retorne estado por defecto
	mymap.on('mousedown', function (e) { document.getElementById('mapid').style.cursor = ''; });


	var helloPopup = L.popup().setContent('Mensaje desde boton');

	L.easyButton('<img src="images/fut.png">', function(btn, map)
	{
		var coordenadas = [3.483820,-76.509149];
		map.setView(coordenadas);

		map.setZoom(20);

		helloPopup.setLatLng(coordenadas).openOn(map);
	}).addTo( mymap );


	L.easyButton('<img src="images/fire.png">', function(btn, map)
	{
		flag_reporte=true;
		document.getElementById('mapid').style.cursor = 'crosshair';
	}).addTo( mymap );

	var miEstiloLinea1 = {
		"color": "#ff7800",
		"weight": 5,
		"opacity": 0.8
	};

	var capaGeojson = L.geoJson();
	var geojsonFeature;

	function pintarRuta_EmergenciaHospital(data)
	{
		console.log('PUNT');
		//console.log(data);

		mymap.removeLayer(capaGeojson);

		geojsonFeature= eval('('+data+')');
		capaGeojson = L.geoJson(geojsonFeature,  {style: miEstiloLinea1 }).addTo(mymap);
		layerControl.addOverlay(capaGeojson,"Emergencia - Hospital ", "Rutas");
		mymap.addLayer(capaGeojson);
		layerControl._update();
		capaGeojson.addTo( mymap );
	}

	function construirElementos()
	{
		//Leo todas las categorias registradas en la base de datos y se las asigno al combobox
			$.post("config/funciones.php",
    );
	}
	
	function lanzarVentanaBusqueda(e)
	{
		$('#coord_y').html(e.latlng.lat.toString());
		$('#coord_x').html(e.latlng.lng.toString());



		 var item_dialog_con = bootbox.dialog({
			title: "Tu Cancha",
			message: $('#myVentanaModal').html(),
			size: "medium",  //small , large , medium
			onEscape: true,
			show: false,
			buttons: {

				registrar:
				{
					label: "Localizar",
					className: "btn-success",
					callback: function ()
					{
						
						var coordenada_y = e.latlng.lat.toString();
						var coordenada_x = e.latlng.lng.toString();

						var iduser = '<?php echo $_SESSION["iduser"]; ?>';

						
						alert('X:'+coordenada_x);
						alert('Y:'+coordenada_y);


						$.post("src/funciones.php",
						{
							peticion: 'generar-rutas',
							parametros:
							{  x: coordenada_x  ,
							   y: coordenada_y ,
							   user:iduser
							}
						},
						function(data, status){
							console.log("Datos recibidos: " + data + "\nStatus: " + status);
							if(status=='success')
							{
								if(data=='NUEVA_EMERGENCIA_CREADA')
								{
									alert('Rutas para atender la Emergencia fueron creadas con exito !!');
									//Aqui incluir funcion para pintar el mapa


									$.post("src/funciones.php",
									{
										peticion: 'recupera_ruta',
										parametros:
										{
											ruta:'emergencia_hospital'
										}
									},
									function(data, status)
									{
										if(status=='success')
										{
											pintarRuta_EmergenciaHospital(data);
										}
									});


								}
							else
								{
									alert('Problemas al generar las ruats ');
								}
							}
						});

					}
				},
				cancel:
				{
					label: "Cerrar",
					className: "btn-default",
					callback: function () {
						item_dialog_con.modal("hide");
					}
				}



			}
		});



		//Muestro el mensaje de dialogo
		item_dialog_con.modal('show');

	}
</script>