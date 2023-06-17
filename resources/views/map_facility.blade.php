<?php
use App\Models\CityFacility;
// Retrieve the 'color' from the 'CityFacility' model based on city_id and facility_id
function getColorByCityFacility($cityId, $facilityId) {
  $color = CityFacility::where('city_id', $cityId)
                       ->where('facility_id', $facilityId)
                       ->value('color');

  // Create an associative array with the color value
  $data = array('color' => $color);

  // Convert the array to JSON format
  $json = json_encode($data);

  // Return the JSON data
  return $json;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Peta Fasilitas Kesehatan</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin=""/>
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        #mapCityRegency {
            width: auto;
            height: 100%;
        }
        #infoLayer {
          position: absolute;
          bottom: 30px;
          left: 30px;
          z-index: 1000;
          padding: 10px;
          background: white;
          box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        
        
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div id="mapCityRegency"></div>
    <script src='https://code.jquery.com/jquery-3.3.1.min.js', integrity='sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=', crossorigin='anonymous'></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
    <script>
        // City and Regency
        var myCityMap = L.map('mapCityRegency').setView([-7.6, 112.3], 8);

        var tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 15,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(myCityMap);

        function getColor(d) {
        // Replace with your actual database query to retrieve the color based on the facility ID
        var cityFacility = cityFacilities.find(function(facility) {
          return facility.facility_id === d;
        });

        if (cityFacility) {
          return cityFacility.color;
        } else {
          return "#FFFFFF"; // Default color if facility ID not found
          }
        }
        var myCityLayer = L.geoJSON().addTo(myCityMap);
        var layerControl = L.control.layers().addTo(myCityMap);
        var sortData;

        $(function() {
          $.ajax({
            dataType: "json",
            url: "/jawa-timur.json",
            method: "GET",
            success: function(data) {
              sortData = data;
              sortData.features.sort(function(a, b) {
                var idA = a.properties.ID;
                var idB = b.properties.ID;
                // Convert the IDs to numbers if they are strings
                idA = typeof idA === 'string' ? parseInt(idA) : idA;
                idB = typeof idB === 'string' ? parseInt(idB) : idB;
                
                // Compare the IDs
                if (idA < idB) {
                  return -1;
                }
                if (idA > idB) {
                  return 1;
                }
                
                // IDs are equal
                return 0;
              });
              console.table(data);
              loadCityLayer(data);
            },
            error: function(err) {
              alert(err);
            }
          });
        });


        function loadCityLayer(data) {
          var cityFacilities = [
            { facility_id: 1, name: "Puskesmas", color: getColor },
            { facility_id: 2, name: "Rumah Sakit", color: getColor },
            { facility_id: 3, name: "Sarana Kesehatan lain", color: getColor }
          ]; // Replace with your actual city facility data from the database

          cityFacilities.forEach(function(cityFacility) {
            if (cityFacility.facility_id === 1) {
              addLayerToMap(data, cityFacility.name, cityFacility.facility_id);
            } else if (cityFacility.facility_id === 2) {
              addLayerToMap(data, cityFacility.name, cityFacility.facility_id);
            } else if (cityFacility.facility_id === 3) {
              addLayerToMap(data, cityFacility.name, cityFacility.facility_id);
            }
          });
        }

        function addLayerToMap(data, layerName, facility_id) {
          var facilityGroup = L.layerGroup();

          data.features.forEach((feature) => {
            var city_name = feature.properties.NAME_2;
            var city_id = feature.properties.ID
            var color = ""
            $.ajax({
              url: '/get-color',
              method: 'POST',
              data: { _token: $('meta[name="csrf-token"]').attr('content'), city_id: city_id, facility_id: facility_id },
              success: function(response) {
                  color = response.color;
                  status = response.status;
                  total = response.total;
                  population = response.population;
                  ratio = response.ratio;
                  if (color != null && color != "0" && city_id !== undefined) {
                    // console.log(`${feature.properties.NAME_2} / ${facility_id} = ${color}`)
                    // Create a custom popup content
                    var popupContent =
                      `<strong>${layerName} di ${city_name}</strong><br>Jumlah  : ${total}<br>Populasi: ${population}<br>Rasio   :${ratio}<br>Status  : ${status}`;
                    var layer = L.geoJSON(feature, {
                      style: {
                        fillColor: color,
                        color: "white",
                        weight: 2,
                        opacity: 1,
                        dashArray: '',
                        fillOpacity: 1
                      },
                      onEachFeature: function(feature, layer) {
                        layer.bindPopup(popupContent);
                      }
                    });
        
                    facilityGroup.addLayer(layer); 
                  }
              },
              error: function(error) {
                  console.error(error);
              }
            });
          });

          myCityLayer.addLayer(facilityGroup);
          layerControl.addOverlay(facilityGroup, layerName);

          // Lock the control layer list
          layerControl.options.collapsed = false; // Set collapsed option to false
          layerControl.expand(); // Expand the layer control

          layerControl.options.autoZIndex = true;
          layerControl.options.hideSingleBase = true;
          layerControl.options.closePopupOnClick = false;
          layerControl._expand();

          function uncheckAllLayerGroups() {
            for (var id in layerControl._layers) {
              var layer = layerControl._layers[id].layer;
              
              if (layer instanceof L.LayerGroup) {
                layer.clearLayers();
              }
            }
          }

          // Call the function to uncheck all layer groups
          uncheckAllLayerGroups();

          // var infoLayer = document.getElementById('infoLayer');
          // var totalLayers = Object.keys(layerControl._layers).length;
          // infoLayer.innerHTML = '<h4>Total Layers: ' + totalLayers + '</h4>';
        }

    </script>
    <!-- <div id="infoLayer"></div> -->
</body>
</html>
