<?php
    $started = session_start();
	$_SESSION['pippo'] = "CIAOCIAO";
//    session_destroy();
    /**
     * Making a SPARQL SELECT query
     *
     * This example creates a new SPARQL client, pointing at the
     * dbpedia.org endpoint. It then makes a SELECT query that
     * returns all of the countries in DBpedia along with an
     * english label.
     *
     * Note how the namespace prefix declarations are automatically
     * added to the query.
     *
     * @package    EasyRdf
     * @copyright  Copyright (c) 2009-2013 Nicholas J Humfrey
     * @license    http://unlicense.org/
     */

    set_include_path(get_include_path() . PATH_SEPARATOR . './lib/');
    require_once "EasyRdf.php";
    require_once "html_tag_helpers.php";

    $sparql = new EasyRdf_Sparql_Client('http://150.146.207.67/sparql/ds');

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
    function add_map_point(lat, lng, desc, url, img) {
      var vectorLayer = new ol.layer.Vector({
        source:new ol.source.Vector({
          features: [new ol.Feature({
                type: 'click',
                desc: desc,
                url: url,
                image: img,
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
<h1> Results </h1>

<ul>
<?php

    $string_s = $_GET['search'];
    echo "<h2>List of results : ".$string_s."</h2>";
    $result = $sparql->query(
	'PREFIX DUL: <http://www.ontologydesignpatterns.org/ont/dul/DUL.owl#>'.
	' PREFIX dc: <http://purl.org/dc/elements/1.1/>'.
	' PREFIX geo: <http://www.opengis.net/ont/geosparql#>'.
	' PREFIX geof: <http://www.opengis.net/def/function/geosparql/>'.
	' PREFIX locn:  <https://www.w3.org/ns/locn#>'.
	' PREFIX wgs84: <http://www.w3.org/2003/01/geo/wgs84_pos#>'.
	' SELECT DISTINCT ?uriOggetto ?titolo ?lat ?long WHERE {'.
  	' ?uriOggetto a  DUL:Object .'.
  	' ?uriOggetto dc:title ?titolo .'.
	' ?uriOggetto locn:geometry ?geo .'.
	' ?geo wgs84:lat ?lat .'.
	' ?geo wgs84:long ?long .'.
  	' FILTER (regex(?titolo,"'.$string_s.'","i")).'.
	'}'
    );
    $s_result = array();
    $ind = 0;
    foreach ($result as $row) {
        //echo "<li>".link_to($row->label, $row->country)."</li>\n";
        $my_obj = $row->uriOggetto;
        $my_titolo = $row->titolo;
	$my_lat =  $row->lat;
        $my_long = $row->long;
	$s_result[$ind]=array($my_obj,$my_titolo,$my_lat,$my_long);
        echo "<li>".link_to($s_result[$ind][0],$s_result[$ind][0])."    $my_titolo "."      $my_lat "." $my_long "."</li>\n";
	$ind++;
    }
//print_r($s_result);
//for ($row = 0; $row < $ind; $row++) {
//    	$lat_j = $s_result[$row][2]; 
//    	$long_j = $s_result[$row][3]; 
//    	$desc_j = $s_result[$row][1]; 
//    	$url_j = $s_resulti[$row][0]; 
//        print_r($s_result[$row][0]);
//        print_r($s_result[$row][1]);
//        print_r($s_result[$row][2]);
//        print_r($s_result[$row][3]);
//	}
print_r($s_result);
	$_SESSION['s_result'] = $s_result;
?>

</ul>
<p>Total number of results: <?= $result->numRows() ?></p>
<a href="./showr_on_map.php">Mostra risultati su mappa</a>

  <div id="map" style="width: 100vw; height: 100vh;"></div>
  <script>
   initialize_map();
  <?php
    foreach ($s_result as $rec) {
    	$lat_j =  $rec[2]; 
    	$long_j =$rec[3]; 
    	$desc_j = $rec[1]; 
    	$url_j = $rec[0]; 
	$img_j = "https://upload.wikimedia.org/wikipedia/commons/thumb/8/80/Caldara_di_Manziana.jpg/260px-Caldara_di_Manziana.jpg";
        
        echo "var lat = ".$lat_j.";\n";
        echo "var long = ".$long_j.";\n";
        echo "var desc = '".$desc_j."';\n";
        echo "var url = \"".$url_j."\";\n";
	echo "var img = '".$img_j."';\n";
	echo "add_map_point(lat, long, desc, url, img);\n";
    }
   ?>
  </script>

</body>
</html>
