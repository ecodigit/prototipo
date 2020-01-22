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
        "object" => "Prodotti",
        "project" => "Progetti",
        "person" => "Persone",
        "organization" => "Organizzazioni"
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

    $result = $dl_client->queryEachType(
        $string_s, $AreeDisc, $Discipline,$Settori, $Tematiche, $Tipologie, 5);

// Create array of results
    $s_result = array();
    $ind = 0;

    echo $twig->render('results.html',
            ['searchString' => $string_s, 'results' => $result, 'typeLabels' => $TYPE_LABEL_MAP]);

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

	    $ind++;
    }

//DEBUG
	//print_r($s_result);

// Put results on session for visualizating on maps
	$_SESSION['s_result'] = $s_result;

?>
