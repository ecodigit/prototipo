<?php

require __DIR__ . '/../vendor/autoload.php';

class DL_Client {

  private $sparql_client;

  function __construct() {
    $this->sparql_client = new EasyRdf_Sparql_Client('http://150.146.207.67/sparql/ds');
  }

  public function query($string_s, $AreeDisc, $Discipline, $Settori, $Tematiche, $Tipologie) {

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

    if (!empty($AreeDisc)) {
      $query_s = $query_s .
      ' ?uriOggetto dcterms:subject ?categoria .'.
      ' FILTER (?categoria IN (';
      foreach ($AreeDisc as $value) {
        $query_s = $query_s .'<https://w3id.org/ecodigit/resource/'.$value.">,";
      }
      $query_s = substr($query_s, 0, -1);
      $query_s = $query_s.')) .';
    }
    if (!empty($Discipline)) {
      $query_s = $query_s .
      ' ?uriOggetto dcterms:subject ?categoria .'.
      ' FILTER (?categoria IN (';
      foreach ($Discipline as $value){
        $query_s = $query_s .'<https://w3id.org/ecodigit/resource/'.$value.">,";
      }
      $query_s = substr($query_s, 0, -1);
      $query_s = $query_s.')) .';
    }
    if (!empty($Settori)) {
      $query_s = $query_s .
      ' ?uriOggetto dcterms:subject ?categoria .'.
      ' FILTER (?categoria IN (';
      foreach ($Settori as $value){
        $query_s = $query_s .'<https://w3id.org/ecodigit/resource/'.$value.">,";
      }
      $query_s = substr($query_s, 0, -1);
      $query_s = $query_s.')) .';
    }
    if (!empty($Tematiche)) {
      $query_s = $query_s .
      ' ?uriOggetto dcterms:subject ?categoria .'.
      ' FILTER (?categoria IN (';
      foreach ($Tematiche as $value){
        $query_s = $query_s .'<https://w3id.org/ecodigit/resource/'.$value.'>,';
      }
      $query_s = substr($query_s, 0, -1);
      $query_s = $query_s.')) .';
    }
    if (!empty($Tipologie)) {
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
    return $this->sparql_client->query($query_s);

  }

};
