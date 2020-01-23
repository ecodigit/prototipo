<?php

    require __DIR__ . '/../vendor/autoload.php';

    session_start();

//  Getting options from search form

    $string_s = $_GET['search'];
    $AreeDisc = $_GET['AreeDisc'];
    $Discipline= $_GET['Discipline'];
    $Settori= $_GET['Settori'];
    $Tematiche= $_GET['Tematiche'];
    $Tipologie= $_GET['Tipologie'];

    $TYPE_LABEL_MAP = [
        "Object" => "Prodotti",
        "PublicInvestmentProject" => "Progetti",
        "Person" => "Persone",
        "Organization" => "Organizzazioni"
    ];

    // $twig = $_SESSION['twigEnvironment'];
    // if (!$twig) {
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../src/templates');
        $twig = new \Twig\Environment($loader);
    //     $_SESSION['twigEnvironment'] = $twig;
    // }

    $dl_client = new \Local\DL_Client();

// DEBUG
    //print_r( $AreeDisc);

    $resultCount = $dl_client->queryTotalCount($string_s);

    $countByBroadType = $dl_client->queryCountByBroadType($string_s);

    $facets = $dl_client->queryFacets($string_s);

    $result = $dl_client->queryEachType(
        $string_s, $AreeDisc, $Discipline,$Settori, $Tematiche, $Tipologie, 5);

    echo $twig->render('results.html',
            ['searchString' => $string_s, 'resultCount' => $resultCount,
            'countByBroadType' => $countByBroadType,
            'results' => $result, 'facets' => $facets, 'typeLabels' => $TYPE_LABEL_MAP]);

            // Create array of results
                $s_result = array();
                $ind = 0;

    foreach ($result as $row) {
        $my_obj = $row->item;
        $my_titolo = $row->title;
    	$my_wkt =  $row->wktGeometry;
    	$my_img =  $row->imageURL;

        // Replace http:// .... in WTK record
    	$replace = '"(<http?://.*)(?=>)>"';
    	$my_wkt = trim(preg_replace($replace, '', $my_wkt));

        //DEBUG
        //	print_r($my_wkt);

        // Create array of results: $ind is index of results, each element of array contains another array with uriOggetto-titolo-ser-imageURL
    	$s_result[$ind]=array($my_obj,$my_titolo,$my_wkt, $my_img);

	    $ind++;
    }

//DEBUG
	//print_r($s_result);

// Put results on session for visualizating on maps
	$_SESSION['s_result'] = $s_result;

?>
