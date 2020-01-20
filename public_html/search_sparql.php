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
    require_once __DIR__ . '/../src/html_tag_helpers.php';

    // $dlClient = new Local\DL_Client();
    require_once __DIR__ . '/../src/DL_Client.php';
    $dl_client = new DL_Client();

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

//  Getting options from search form

    $string_s = $_GET['search'];
    $AreeDisc = $_GET['AreeDisc'];
    $Discipline= $_GET['Discipline'];
    $Settori= $_GET['Settori'];
    $Tematiche= $_GET['Tematiche'];
    $Tipologie= $_GET['Tipologie'];

// DEBUG
    //print_r( $AreeDisc);

    echo "<h2>List of results : ".$string_s."</h2>";

    $result = $dl_client->query(
        $string_s, $AreeDisc, $Discipline,$Settori, $Tematiche, $Tipologie);

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
