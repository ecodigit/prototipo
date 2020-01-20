<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>OpenStreetMap &amp; OpenLayers - Marker Example</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="./ol_v5.2.0.css"" type="text/css">
<link rel="stylesheet" href="./ol-popup.css"" type="text/css">
<script src="./ol_v5.2.0.js"></script>
<script src="./ol-popup.js"></script>


  
  <script>
    /* OSM & OL example code provided by https://mediarealm.com.au/ */
    var map;
    var mapLat = 41.9028;
    var mapLng = 12.4964;
    var mapDefaultZoom = 10;
    
    function initialize_map() {
      map = new ol.Map({
        target: "map",
        layers: [
            new ol.layer.Tile({
                source: new ol.source.OSM({
                      url: "https://a.tile.openstreetmap.org/{z}/{x}/{y}.png"
                })
            })
        ],
        view: new ol.View({
            center: ol.proj.fromLonLat([mapLng, mapLat]),
            zoom: mapDefaultZoom
        })
      });
    }


    function add_map_point(lat, lng) {
      var vectorLayer = new ol.layer.Vector({
        source:new ol.source.Vector({
          features: [new ol.Feature({
                type: 'click',
                desc: "test desc",
                url: "test url",
                image: "https://upload.wikimedia.org/wikipedia/commons/e/ec/RedDot.svg",
                geometry: new ol.geom.Point(ol.proj.transform([parseFloat(lng), parseFloat(lat)], 'EPSG:4326', 'EPSG:3857')),
            })]
        }),
        style: new ol.style.Style({
          image: new ol.style.Icon({
            anchor: [0.5, 0.5],
            anchorXUnits: "fraction",
            anchorYUnits: "fraction",
            src: "https://upload.wikimedia.org/wikipedia/commons/e/ec/RedDot.svg"
          })
        })
      });
      map.addLayer(vectorLayer); 
      var popup = new ol.Overlay.Popup();
      map.addOverlay(popup);
       // Add an event handler for when someone clicks on a marker
        map.on('singleclick', function(evt) {

            // Hide existing popup and reset it's offset
            popup.hide();
            popup.setOffset([0, 0]);

            // Attempt to find a feature in one of the visible vector layers
            var feature = map.forEachFeatureAtPixel(evt.pixel, function(feature, layer) {
                return feature;
            });

            if (feature) {
                var coord = feature.getGeometry().getCoordinates();
                var props = feature.getProperties();
                var info = '<a style="color:black; font-weight:600; font-size:11px" href="http://www.somedomain.com/' + props.url + '">' +
                '<img width="200" src="' +  props.image + '"  />' +
                '<div style="width:220px; margin-top:3px">' + props.desc + '</div></a>';

                // Offset the popup so it points at the middle of the marker not the tip
                popup.setOffset([0, -22]);
                popup.show(coord, info);
            }
        });

        // Add an event handler for when someone hovers over a marker
        // This changes the cursor to a pointer
        map.on("pointermove", function (evt) {
            var hit = map.forEachFeatureAtPixel(evt.pixel, function(feature, layer) {
                return true;
            });
            if (hit) {
                this.getTargetElement().style.cursor = 'pointer';
            } else {
                this.getTargetElement().style.cursor = '';
            }
        });

    }
  </script>
</head>
<body onload="initialize_map(); add_map_point(41.9028, 12.4964);">
  <div id="map" style="width: 100vw; height: 100vh;"></div>
</body>
</html>
