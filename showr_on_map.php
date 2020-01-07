<?php
    set_include_path(get_include_path() . PATH_SEPARATOR . './lib/');
    require_once "EasyRdf.php";
    require_once "html_tag_helpers.php";
    session_start();
    $s_result = $_SESSION['s_result'];

// DEBUG
    // print_r($_SESSION);

// Clean data in SESSION
    session_destroy();

?>

<!DOCTYPE html>
<html>
<head>
  <title> Results </title>
 
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="./ol_v5.2.0.css"" type="text/css">
  <link rel="stylesheet" href="./ol-popup.css"" type="text/css">
  <script src="./ol_v5.2.0.js"></script>
  <script src="./ol-popup.js"></script>

// Library for creating OpenLayers Map
  <script>
    var map;

// Center the maps in Rome and zooming all region
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
    function add_map_point(wkt, desc, url, img) {
// Parsing WTK record
	var format = new ol.format.WKT();
	var mfeature = format.readFeature(wkt);

// Prepare record on Map adding informations about Object-description-url-img
      var vectorLayer = new ol.layer.Vector({
        source:new ol.source.Vector({
          features: [new ol.Feature({
                type: 'click',
                desc: desc,
                url: url,
                image: img,
                geometry: mfeature.getGeometry().transform('EPSG:4326', 'EPSG:3857'),
            })]
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
                var info = '<a style="color:black; font-weight:600; font-size:11px" href="' + props.url + '">' +
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



<body>
// Create MAP div

<div id="map" style="width: 100vw; height: 100vh;"></div>

<script>

   initialize_map();

  <?php
// Load results from previus array 
	foreach ($s_result as $rec) {
		if($rec[2] != '')
		{
        		$url_j = $rec[0]; 
        		$desc_j = $rec[1]; 
			$wkt_j = $rec[2];
        		$img_j = $rec[3];

// print the results on page
        		echo "var wkt = \"".$wkt_j."\";\n";
        		echo "var desc = \"".$desc_j."\";\n";
        		echo "var url = \"".$url_j."\";\n";
        		echo "var img = '".$img_j."';\n";
        		echo "add_map_point(wkt, desc, url, img);\n";
		}
   	}
   ?>
</script>

</body>
</html>

