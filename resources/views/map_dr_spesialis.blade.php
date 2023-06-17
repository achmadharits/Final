<?php
use App\Models\CityFacility;
use App\Models\FacilityWorker;

function getColorByCityFacility($cityId, $facilityId)
{
    $color = FacilityWorker::whereHas('cityfacility', function ($query) use ($cityId, $facilityId) {
            $query->where('city_id', $cityId)
                ->where('facility_id', $facilityId);
        })
        ->value('color');

    // Create an associative array with the color value
    $data = array('color' => $color);

    // Convert the array to JSON format
    $json = json_encode($data);

    // Return the JSON data
    return $json;
}
// Retrieve the 'color' from the 'FacilityWorker' model based on city_facility_id and worker_id
// function getColorByFacilityWorker($cityFacilityId, $workerId) {
//   $color = FacilityWorker::where('city_facility_id', $cityFacilityId)
//                         ->where('worker_id', $workerId)
//                         ->value('color');

//   // Retrieve city, facility, and worker names from the 'cityfacility' table
//   $cityFacility = CityFacility::find($cityFacilityId);
//   $cityName = $cityFacility->city->name;
//   $facilityName = $cityFacility->facility->name;

//   $worker = Worker::find($workerId);
//   $workerName = $worker->name;

//   // Create an associative array with the color value
//   $data = array('color' => $color);

//   // Convert the array to JSON format
//   $json = json_encode($data);

//   // Return the JSON data
//   return $json;
// }
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
          var workers = [
          { id: 1, name: "Dokter Spesialis" },
          { id: 2, name: "Dokter Umum" },
          { id: 3, name: "Dokter Gigi" },
          { id: 4, name: "Dokter Gigi Spesialis" },
          { id: 5, name: "Bidan" },
          { id: 6, name: "Perawat" },
          { id: 7, name: "Tenaga Kesehatan Masyarakat" },
          { id: 8, name: "Tenaga Kesehatan Lingkungan" },
          { id: 9, name: "Tenaga Gizi" },
          { id: 10, name: "Ahli Teknologi Laboratorium Medik" },
          { id: 11, name: "Tenaga Teknik Biomedika Lainnya" },
          { id: 12, name: "Keterapian Fisik" },
          { id: 13, name: "Keteknisian Medis" },
          { id: 14, name: "Tenaga Teknis Kefarmasian" },
          { id: 15, name: "Apoteker" }
        ];

        var facilities = [
          { id: 1, name: "Puskesmas" },
          { id: 2, name: "Rumah Sakit" },
          { id: 3, name: "Sarana Kesehatan Lain" }
        ];

        var facilityWorkers = [];
        const urlParams = new URLSearchParams(window.location.search);

        if (urlParams.has('worker')) {
          let id = urlParams.get('worker');
          id -= 1;
          // id = String(id);

          for (let i = 0; i < facilities.length; i++) {
            var name = `${workers[id].name} di ${facilities[i].name}`;
            var facilityWorker = {
              facility_id: facilities[i].id,
              worker_id: workers[id].id,
              name: name
            };
            
            facilityWorkers.push(facilityWorker);
          }
        } else {
          for (let i = 0; i < workers.length; i++) {
            for (let j = 0; j < facilities.length; j++) {
              var name = `${workers[i].name} di ${facilities[j].name}`;
              var facilityWorker = {
                facility_id: facilities[j].id,
                worker_id: workers[i].id,
                name: name
              };
              
              facilityWorkers.push(facilityWorker);
            }
          }
        }

        // var contohOjoDigawe = [
        //   { facility_id: 1, worker_id: 1, name: "Dokter Spesialis di Puskesmas" },
        //   { facility_id: 2, worker_id: 1, name: "Dokter Spesialis di Rumah Sakit" },
        //   { facility_id: 3, worker_id: 1, name: "Dokter Spesialis di Sarana Kesehatan lain" }
        // ];
        
        if (urlParams.has('worker')) {
          console.table(facilityWorkers)
          facilityWorkers.forEach(function(facilityworker) {
              addLayerToMap(data, facilityworker.name, facilityworker.facility_id, facilityworker.worker_id);
          });
        } else {
          facilityWorkers.forEach(function(facilityworker) {
              addLayerToMap(data, facilityworker.name, facilityworker.facility_id, facilityworker.worker_id);
          });
        }

        }

        function addLayerToMap(data, layerName, facility_id, worker_id) {
          var workerGroup = L.layerGroup();

          data.features.forEach((feature) => {
            var city_id = feature.properties.ID
            var city_name = feature.properties.NAME_2
            var color = ""
            $.ajax({
              url: '/get-color-worker',
              method: 'POST',
              data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                worker_id: worker_id,
                facility_id: facility_id,
                city_id: city_id 
              },
              success: function(response) {
                  color = response.color;
                  status = response.status;
                  total = response.total;
                  population = response.population;
                  ratio = response.ratio;
                  worker = layerName.split(" di ")[0]
                  facility = layerName.split(" di ")[1]
                  if (color != null && color != "0" && city_id !== undefined) {
                    var popupContent =
                      `<strong>${worker} ${facility} di ${city_name}</strong><br>Total: ${total}<br>Populasi : ${population}<br>Rasio   :${ratio}<br>Status: ${status}`;
                    console.log(
                      `${feature.properties.NAME_2} / ${feature.properties.ID} - ${facility_id}-${ratio} = ${color}`)
                    var layer = L.geoJSON(feature, {
                      style: {
                        fillColor: color,
                        color: "white",
                        weight: 2,
                        opacity: 1,
                        fillOpacity: 1
                      },
                      onEachFeature: function(feature, layer) {
                        layer.bindPopup(popupContent);
                      }
                    });
        
                    workerGroup.addLayer(layer); 
                  }
              },
              error: function(error) {
                  console.error(error);
              }
            });
          });
          
          // Uncheck the layer group
          workerGroup.eachLayer(function (layer) {
            layerControl._layers[layer._leaflet_id].checked = false;
          });

          myCityLayer.addLayer(workerGroup);
          layerControl.addOverlay(workerGroup, layerName);
        }

    </script>
</body>
</html>
