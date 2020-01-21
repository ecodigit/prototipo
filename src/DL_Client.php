<?php

namespace Local;

class DL_Client {

    private $sparql_client;

    function __construct() {
        $this->sparql_client = new \EasyRdf_Sparql_Client('http://150.146.207.67/sparql/ds');
    }

    private static $TYPE_MAP = [
        "object" => "dul:Object",
        "project" => "foaf:Project",
        "person" => "foaf:Person",
        "organization" => "org:Organization"
    ];

    public function query($string_s, $item_types, $AreeDisc, $Discipline, $Settori, $Tematiche, $Tipologie, $limit) {

        $query_s =  'PREFIX dul: <http://www.ontologydesignpatterns.org/ont/dul/DUL.owl#>'.
                    ' PREFIX dc: <http://purl.org/dc/elements/1.1/>'.
                    ' PREFIX locn:  <https://www.w3.org/ns/locn#>'.
                    ' PREFIX wgs84: <http://www.w3.org/2003/01/geo/wgs84_pos#>'.
                    ' PREFIX geo: <http://www.opengis.net/ont/geosparql#>'.
                    ' PREFIX dcterms: <http://purl.org/dc/terms/>'.
                    ' PREFIX foaf: <http://xmlns.com/foaf/0.1/>' .
                    ' PREFIX org: <http://www.w3.org/ns/org#>' .
                    ' SELECT DISTINCT ?uriOggetto ?titolo ?ser ?imageURL WHERE {'.
                        ' ?uriOggetto a ?type .'.
                        ' ?uriOggetto dc:title ?titolo .'.
                        ' OPTIONAL  {'.
                            ' ?uriOggetto locn:geometry ?geo .'.
                            ' ?geo geo:asWKT ?ser .'.
                        '}'.
                        ' OPTIONAL {'.
                            ' ?uriOggetto dcterms:hasImage ?image .'.
                            ' ?image dcterms:URL ?imageURL .'.
                        '}'.
                        ' FILTER (regex(?titolo,"'.$string_s.'","i")).';

        $item_type_res = [];

        if (!empty($item_types)) {
            foreach($item_types as $type) {
                $type_res = $this::$TYPE_MAP[$type];
                if ($type_res) {
                    array_push($item_type_res, $type_res);
                }
            }
        }

        if (!empty($item_type_res)) {
            $query_s = $query_s . ' FILTER (?type IN (';
            foreach ($item_type_res as $type_res) {
                $query_s = $query_s . $type_res . ",";
            }
            $query_s = substr($query_s, 0, -1);
            $query_s = $query_s.')) .';
        }

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
                $query_s = $query_s .' <https://w3id.org/ecodigit/resource/'.$value.'>,';
            }
            $query_s = rtrim($query_s,",");
            $query_s = $query_s.')) .';
        }

        $query_s = $query_s .'}';
        if ($limit && is_int($limit)) {
            $query_s = $query_s .
                    ' LIMIT '. $limit . '';
        }

        //Submittinmg query
        return $this->sparql_client->query($query_s);

    }

    public function queryEachType(
                $string_s, $AreeDisc, $Discipline, $Settori, $Tematiche,
                $Tipologie, $limit) {
        $results = [];
        foreach(array_keys($this::$TYPE_MAP) as $type) {
            $results[$type] = $this->query(
                    $string_s, [$type], $AreeDisc, $Discipline, $Settori,
                    $Tematiche, $Tipologie, $limit);
        }
        return $results;
    }

};
