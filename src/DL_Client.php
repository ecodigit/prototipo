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
        "Object" => "dul:Object",
        "PublicInvestmentProject" => "project:PublicInvestmentProject",
        "Person" => "foaf:Person",
        "Organization" => "org:Organization"
    ];

    public function query($string_s, $item_types, $filter_categories, $Tipologie, $limit) {

        $filters = [];
        if (!empty($item_types)) {
            $filters['broadTypes'] = $item_types;
        }

        if (!empty($filter_categories)) {
            $filters['categories'] = $filter_categories;
        }

        if (!empty($Tipologie)) {
            $filters['specificTypes'] = $Tipologie;
        }

        $params = ['searchString' => $string_s, 'filters' => $filters];
        if ($limit && is_int($limit)) {
            $params['limit'] = $limit;
        }

        $query_s = $this->twig->render('search.rq', $params);
#        $this::console_log($query_s);
        $result = $this->sparql_client->query($query_s);
        return $result;
    }

    private static function console_log($obj) {
        echo ' <script>console.log(`' . var_export($obj, true) . '`);</script> ';
    }

    public function queryTotalCount($string_s) {
        $query_s = $this->twig->render('searchResultCount.rq', ['searchString' => $string_s]);
        $result = $this->sparql_client->query($query_s);
        return $result[0]->count;
    }

    public function queryCountByBroadType($string_s, $filter_categories, $Tipologie) {
        $filters = [];
        if (!empty($filter_categories)) {
            $filters['categories'] = $filter_categories;
        }
        if (!empty($Tipologie)) {
            $filters['specificTypes'] = $Tipologie;
        }
        $query_s = $this->twig->render('searchByBroadTypeCounts.rq',
                ['searchString' => $string_s, 'filters' => $filters]);
        $result = $this->sparql_client->query($query_s);
        return from($result)->toDictionary('$v->broadType->localName()', '$v->count->getValue()');
    }

    public function queryFacets($string_s) {
        $query_s = $this->twig->render('searchFacets.rq', ['searchString' => $string_s]);
        $result = $this->sparql_client->query($query_s);
        $grouped = from($result)->groupBy(
                '$v->scheme->localName()', NULL,
                function ($e, $k) {
                    return [ "id"=>$e[0]->scheme->localName(), "label"=>$e[0]->schemeLabel,
                            "categories"=>from($e)->select('["id"=>($v->category ? $v->category->localName() : NULL), "label"=>$v->categoryLabel, "count"=>$v->count]')->toArray() ];
                }
                )->toArray();
        return $grouped;
    }

    public function queryEachType(
                $string_s, $filter_categories,
                $Tipologie, $limit) {
        $results = [];
        foreach(array_keys($this::$TYPE_MAP) as $type) {
            $results[$type] = $this->query(
                    $string_s, [$type], $filter_categories, $Tipologie, $limit);
        }
        return $results;
    }

};
