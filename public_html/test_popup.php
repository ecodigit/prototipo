<html>

<head>
	<title>Sample OpenLayers Map</title>
</head>
<body>


<link rel="stylesheet" href="./ol_v5.2.0.css"" type="text/css">
<link rel="stylesheet" href="./ol-popup.css"" type="text/css">
<script src="./ol_v5.2.0.js"></script>
<script src="./ol-popup.js"></script>


<div id="map-canvas"></div>


<script>
	var locations = [
      	["Statue Of Liberty", 40.6892534, -74.0446426, "the-statue-of-libety", "https://cdn.getyourguide.com/img/tour_img-739075-148.jpg", 1],
      	["Central Park", 40.7828687, -73.9659076, "central-park", "https://www.centralpark.com/downloads/7777/download/header.central-park-4.jpg?cb=c41c17ea856fbf7a49b80f2d2c0c6c99&w=640", 2],
      	["Rockefeller Center", 40.7562179,-73.9848441, "rockerfeller-center","https://www.nycgo.com/images/venues/106/_masthead_rockfellercenterspring_taggeryanceyiv_5990__x_large.jpg", 3]
      	];

	// Array of Icon features
	var iconFeatures=[];
	for (var i = 0; i < locations.length; i++) {
	  var iconFeature = new ol.Feature({
	  	type: 'click',
		desc: locations[i][0],
		url: locations[i][3],
		image: locations[i][4], 
	    geometry: new ol.geom.Point(ol.proj.transform([locations[i][2], locations[i][1]], 'EPSG:4326', 'EPSG:3857')),
	  });

	  iconFeatures.push(iconFeature);
	}

	var vectorSource = new ol.source.Vector({
		features: iconFeatures
	});

	// Custom image for marker
	var iconStyle = new ol.style.Style({
	    image: new ol.style.Icon({
	      anchor: [0.5, 0.5],
	      anchorXUnits: 'fraction',
	      anchorYUnits: 'fraction',
	      src: './map-pin.png',
	      scale: 0.15
		    })
	});
	  
	var vectorLayer = new ol.layer.Vector({
	  source: vectorSource,
	  style: iconStyle,
	  updateWhileAnimating: true,
	  updateWhileInteracting: true,
	});

	// Create our initial map view
	var mapCenter = ol.proj.fromLonLat([  -74.0446426, 40.6892534 ]);
	var view = new ol.View({
	  center: mapCenter,
	  zoom: 8
	});

	// Now create our map
	var map = new ol.Map({
	  target: 'map-canvas',
	  view: view,
	  layers: [
	    new ol.layer.Tile({
	      source: new ol.source.OSM(),
	    }),
	    vectorLayer,
	  ],
	  loadTilesWhileAnimating: true,
	});

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

</script>



</body>
</html>
