<?php

namespace Local;

class DL_Client {

    private $sparql_client;
    private $twig;

    function __construct() {
        $this->sparql_client = new \EasyRdf_Sparql_Client('http://150.146.207.67/sparql/ds');
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../src/templates');
        $this->twig = new \Twig\Environment($loader, ['autoescape' => false]);
    }

    private static $TYPE_MAP = [
        "object" => "dul:Object",
        "project" => "project:PublicInvestmentProject",
        "person" => "foaf:Person",
        "organization" => "org:Organization"
    ];

    public function query($string_s, $item_types, $AreeDisc, $Discipline, $Settori, $Tematiche, $Tipologie, $limit) {

        $filters = [];
        if (!empty($item_types)) {
            $filters['broadTypes'] = $item_types;
        }

        $filterCategories = [];
        if (!empty($AreeDisc)) {
            $filterCategories['AreeDisc'] = $AreeDisc;
        }
        if (!empty($Discipline)) {
            $filterCategories['Discipline'] = $Discipline;
        }
        if (!empty($Settori)) {
            $filterCategories['Settori'] = $Settori;
        }
        if (!empty($Tematiche)) {
            $filterCategories['Tematiche'] = $Tematiche;
        }
        if (!empty($filterCategories)) {
            $filters['categories'] = $filterCategories;
        }

        if (!empty($Tipologie)) {
            $filters['specificTypes'] = $Tipologie;
        }

        $params = ['searchString' => $string_s, 'filters' => $filters];
        if ($limit && is_int($limit)) {
            $params['limit'] = $limit;
        }

        $query_s = $this->twig->render('search.rq', $params);

        //Submitting query
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
