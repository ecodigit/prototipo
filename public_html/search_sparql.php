<?php
    $started = session_start();
    /**
     * Making a SPARQL SELECT query
     *
     * This example creates a SPARQL query using EasyRdf package
     *
     * @package    EasyRdf
     * @copyright  Copyright (c) 2009-2013 Nicholas J Humfrey
     * @license    http://unlicense.org/
     */

    require __DIR__ . '/../vendor/autoload.php';
    // set_include_path(get_include_path() . PATH_SEPARATOR . './lib/');
    // require_once "EasyRdf.php";
    require_once __DIR__ . '/../src/html_tag_helpers.php';

//  connessione al server 150.146.207.67
    $sparql = new EasyRdf_Sparql_Client('http://150.146.207.67/sparql/ds');

?>
<!DOCTYPE html>
<html>
<head>
  <title> Results </title>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />

</head>
<body>
<h1> Results </h1>

<ul>
<?php
//  Getting option from search form

    $string_s = $_GET['search'];
    $AreeDisc = $_GET['AreeDisc'];
    $Discipline= $_GET['Discipline'];
    $Settori= $_GET['Settori'];
    $Tematiche= $_GET['Tematiche'];
    $Tipologie= $_GET['Tipologie'];

// DEBUG
    //print_r( $AreeDisc);

    echo "<h2>List of results : ".$string_s."</h2>";

// Preparing query string....

    $query_s ='PREFIX DUL: <http://www.ontologydesignpatterns.org/ont/dul/DUL.owl#>'.
	' PREFIX dc: <http://purl.org/dc/elements/1.1/>'.
	' PREFIX locn:  <https://www.w3.org/ns/locn#>'.
	' PREFIX wgs84: <http://www.w3.org/2003/01/geo/wgs84_pos#>'.
	' PREFIX geo: <http://www.opengis.net/ont/geosparql#>'.
	' PREFIX dcterms: <http://purl.org/dc/terms/>'.
	' PREFIX SM: <http://purl.org/dc/terms/>'.
	' SELECT DISTINCT ?uriOggetto ?titolo ?ser ?imageURL WHERE {'.
  	' ?uriOggetto a  DUL:Object .'.
  	' ?uriOggetto dc:title ?titolo .'.
  	' OPTIONAL  {'.
    	' ?uriOggetto locn:geometry ?geo .'.
    	' ?geo geo:asWKT ?ser .'.
  	'}'.
 	' OPTIONAL{'.
    	' ?uriOggetto SM:hasImage ?image .'.
    	' ?image SM:URL ?imageURL .'.
  	'}'.
  	' FILTER (regex(?titolo,"'.$string_s.'","i")).';

	if (!empty($AreeDisc))
	{
		$query_s = $query_s .
		' ?uriOggetto dcterms:subject ?categoria .'.
		' FILTER (?categoria IN (';
		foreach ($AreeDisc as $value){
			$query_s = $query_s .'<https://w3id.org/ecodigit/resource/'.$value.">,";
		}
		$query_s = substr($query_s, 0, -1);
		$query_s = $query_s.')) .';
	}
	if (!empty($Discipline))
	{
		$query_s = $query_s .
		' ?uriOggetto dcterms:subject ?categoria .'.
		' FILTER (?categoria IN (';
		foreach ($Discipline as $value){
			$query_s = $query_s .'<https://w3id.org/ecodigit/resource/'.$value.">,";
		}
		$query_s = substr($query_s, 0, -1);
		$query_s = $query_s.')) .';
	}
	if (!empty($Settori))
	{
		$query_s = $query_s .
		' ?uriOggetto dcterms:subject ?categoria .'.
		' FILTER (?categoria IN (';
		foreach ($Settori as $value){
			$query_s = $query_s .'<https://w3id.org/ecodigit/resource/'.$value.">,";
		}
		$query_s = substr($query_s, 0, -1);
		$query_s = $query_s.')) .';
	}
	if (!empty($Tematiche))
	{
		$query_s = $query_s .
		' ?uriOggetto dcterms:subject ?categoria .'.
		' FILTER (?categoria IN (';
		foreach ($Tematiche as $value){
			$query_s = $query_s .'<https://w3id.org/ecodigit/resource/'.$value.'>,';
		}
		$query_s = substr($query_s, 0, -1);
		$query_s = $query_s.')) .';
	}
	if (!empty($Tipologie))
	{
		$query_s = $query_s .
		' ?uriOggetto a ?tipologia .'.
		' FILTER (?tipologia IN (';
		foreach ($Tipologie as $value){
			//print_r($value);
			$query_s = $query_s .' <https://w3id.org/ecodigit/resource/'.$value.'>,';

		}
		$query_s = rtrim($query_s,",");
		$query_s = $query_s.')) .';
	}

	$query_s = $query_s .'}';
// DEBUG
        //print_r($query_s);

//Submittinmg query
	$result = $sparql->query($query_s);

// Create array of results
    $s_result = array();
    $ind = 0;

    foreach ($result as $row) {
        $my_obj = $row->uriOggetto;
        $my_titolo = $row->titolo;
	$my_wkt =  $row->ser;
	$my_img =  $row->imageURL;

// Replace http:// .... in WTK record
	$replace = '"(<http?://.*)(?=>)>"';
	$my_wkt = trim(preg_replace($replace, '', $my_wkt));

//DEBUG
//	print_r($my_wkt);

// Create array of results: $ind is index of results, each element of array contains another array with uriOggetto-titolo-ser-imageURL
	$s_result[$ind]=array($my_obj,$my_titolo,$my_wkt, $my_img);

// Print on page results
        echo "<li>".link_to($s_result[$ind][0],$s_result[$ind][0])."  Titolo:  $my_titolo "."    WTK:  $my_wkt"."  Img:  $my_img </li>\n";

	$ind++;
    }

//DEBUG
	//print_r($s_result);

// Put results on session for visualizating on maps
	$_SESSION['s_result'] = $s_result;

?>

</ul>
<p>Total number of results: <?= $result->numRows() ?></p>
<?php
// Link for opening results on maps usting showr_on_map.php page (results is in SESSION)
?>
<a href="./showr_on_map.php">Show record on maps</a>

</body>
</html>
