<!DOCTYPE html>
<html>
  <head>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 600px;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      h1{
          text-align: center;
      }
    </style>
  </head>
  <body>
        <h1>Mapa basico de ubicacion de personas</h1>
        <div id="map"></div>
        <h1><a href="admin">Administrar</a></h1>
        
        <script>
                var map;
                function initMap() {

                    map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 11,
                        //center: {lat: 4.710988599999999, lng: -74.072092},
                        center: {lat: 4.631329, lng: -74.112430},
                        mapTypeId: 'roadmap'
                    });
                    loadDataToMap();
                }

                function loadDataToMap() {

                    var origen = [];
                    var heatmapData = [];
                    origen =[<?php 
                            $text="";
                            foreach ($personas as $persona){
                                $text .= $persona->geocoding.",";
                            }
                            echo rtrim($text,',');;
                        ?>];

                        for (var i = 0; i < origen.length; i++) {
                            
                            var lat = origen[i]['results'][0]['geometry']['location']['lat'];
                            var lng = origen[i]['results'][0]['geometry']['location']['lng'];
                            
                            var latLng = new google.maps.LatLng(lat, lng);

                            heatmapData.push(latLng);
                            
                            //mapa marcadores basico
                            var marker = new google.maps.Marker({
                                position: latLng,
                                map: map
                            });
                            
                        }
                        
                    //mapa de calor
                    // var heatmap = new google.maps.visualization.HeatmapLayer({
                    //     data: heatmapData,
                    //     dissipating: false,
                    //     map: map
                    // });
                }
            </script>
            <script async defer
              src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTvT-0R3XOcphma8hBgFtb-1UA3ICKZMA&libraries=visualization&callback=initMap">
             </script>
            
  </body>
</html>