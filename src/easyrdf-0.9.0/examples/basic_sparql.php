<?php
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

    set_include_path(get_include_path() . PATH_SEPARATOR . '../lib/');
    require_once "EasyRdf.php";
    require_once "html_tag_helpers.php";

    $sparql = new EasyRdf_Sparql_Client('http://150.146.207.67/sparql/ds');
?>
<html>
<head>
  <title> Basic Sparql Example</title>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
<h1> Basic Sparql Example</h1>

<h2>List of results</h2>
<ul>
<?php
    $result = $sparql->query(
	'PREFIX geo: <http://www.opengis.net/ont/geosparql#>'.
	' PREFIX geof: <http://www.opengis.net/def/function/geosparql/>'.
	' PREFIX DUL: <http://www.ontologydesignpatterns.org/ont/dul/DUL.owl#>'.
	' PREFIX dc: <http://purl.org/dc/elements/1.1/>'.
	' PREFIX locn: <https://www.w3.org/ns/locn#>'.
	' PREFIX wgs84: <http://www.w3.org/2003/01/geo/wgs84_pos#>'.
	' PREFIX dcterms: <http://purl.org/dc/terms/>'.
        ' SELECT DISTINCT ?uriOggetto ?titolo ?lat ?long WHERE {'.
	'  ?uriOggetto a DUL:Object .'.
	'  ?uriOggetto dc:title ?titolo .'.
	'  ?uriOggetto locn:geometry ?geo .'.
	'  ?uriOggetto a  ?tipologia .'.
	'  ?uriOggetto dcterms:subject ?categoria .'.
	'  ?geo wgs84:lat ?lat .'.
	'  ?geo wgs84:long ?long .'.
	'  ?geo geo:asWKT ?fWKT .'. 
	'  FILTER (?categoria IN (<https://w3id.org/ecodigit/resource/Rilievo_dell%27architettura>, <https://w3id.org/ecodigit/resource/Modellazione_3d>)) .'.
	'  FILTER (?tipologia IN (<https://w3id.org/ecodigit/resource/Articolo>)) .'.
	'  FILTER (regex(?titolo,"m","i")) .'.
//        '  ?concept a skos:Concept .'.
//        '  ?concept skos:inScheme <https://w3id.org/ecodigit/resource/tipologia> .'.
//        '  ?concept skos:prefLabel ?label .'.
//        '  FILTER ( lang(?label) = "en" )'.
//        '} ORDER BY ?label'
        '}'
    );
    foreach ($result as $row) {
        //echo "<li>".link_to($row->label, $row->country)."</li>\n";
        echo "<li>"." $row->uriOggetto "." $row->titolo "." $row->lat "." $row->long "."</li>\n";
    }
?>
</ul>
<p>Total number of results: <?= $result->numRows() ?></p>

</body>
</html>
