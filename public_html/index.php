<html>
<head>
<title>Prototipo Ecodigit T4.4</title>
<meta charset="utf-8">
<meta name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<title>EcoDigit - Ecosistema digitale per la fruizione e la
        valorizzazione dei beni e delle attività culturali della regione Lazio</title>

<!-- Bootstrap core CSS -->
<link href="/prototipo//vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


<!-- Custom styles for this template -->
<link href="/prototipo//css/style1.css" rel="stylesheet">

<link rel="stylesheet"
        href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
        crossorigin="anonymous">

</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
function f1(objButton){  
    $("#advsearch").show();
}
</script>

<body id="page-top">
 <nav class="navbar navbar-expand-lg fixed-top nav-ecodigit"
                id="mainNav">
                <div class="container">
                        <a class="navbar-brand js-scroll-trigger" href="https://dtclazio.it"><img
                                class="logo-nav" src="/prototipo/logo_dtc.png"></a> <a
                                class="navbar-brand js-scroll-trigger" href="#page-top"><img
                                class="logo-nav" src="/prototipo/semplice-1.png"></a>
                        <button class="navbar-toggler bg-navbar-toggler" type="button"
                                data-toggle="collapse" data-target="#navbarResponsive"
                                aria-controls="navbarResponsive" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon "> <i
                                        class="fas fa-bars navbar-toggler-icon-white"></i>
                                </span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarResponsive">
                                <ul class="navbar-nav ml-auto">
                                        <li class="nav-item"><a class="nav-link js-scroll-trigger"
                                                href="#obiettivi">Obiettivi</a></li>
                                        <li class="nav-item"><a class="nav-link js-scroll-trigger"
                                                href="#partner">Partner</a></li>
                                        <li class="nav-item"><a class="nav-link js-scroll-trigger"
                                                href="#contribuisci">Contribuisci</a></li>
                                        <!--  <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#inevidenza">In Evidenza</a>
          </li> -->
                                        <li class="nav-item"><a class="nav-link js-scroll-trigger"
                                                href="#sal">SAL</a></li>
                                        <li class="nav-item"><a class="nav-link js-scroll-trigger"
                                                href="#deliverable">Deliverable</a></li>
                                        <!--<li class="nav-item"><a class="nav-link js-scroll-trigger"
                                                href="#news">Notizie</a></li>-->
                                </ul>
                        </div>
                </div>
        </nav>
       <header class="text-white">
                <div class="container text-center">
                        <object type="image/svg+xml" data="/prototipo/esteso.svg"> Your
                                browser does not support SVG </object>

			 <div class="col-lg-10 mx-auto row-title">
                             <p class="section-title">
				<form action="/prototipo/search_sparql.php" method="GET">

					<input id="search" name="search" type="text" placeholder="Type here">
					<input id="submit" type="submit" value="Search">

			 <div id="advsearch" style="display:none">
			<br>
			<br>
			<p>
			<h3>Aree Disciplinari</h3>
			</p>
			<select name="AreeDisc[]" multiple>
				 <option value="Scienze_fisiche">Scienze fisiche</option>
				 <option value="Scienze_biologiche">Scienze biologiche</option>
				 <option value="Scienze_dell%27antichit%C3%A0%2C_filologico-letterarie_e_storico-artistiche">Scienze dell'antichità, filologico-letterarie e storico-artistiche</option>
				 <option value="Ingegneria_civile_e_Architettura">Ingegneria civile e Architettura</option>
				 <option value="Scienze_storiche%2C_filosofiche%2C_pedagogiche_e_psicologiche">Scienze storiche, filosofiche, pedagogiche e psicologiche</option>
				 <option value="Scienze_matematiche_e_informatiche">Scienze matematiche e informatiche</option>
				 <option value="Scienze_della_terra">Scienze della terra</option>
				 <option value="Scienze_chimiche">Scienze chimiche</option>
			</select>	
			<br>
			<br>
			<p>
			<h3>Discipline</h3>
			</p>
			<select name="Discipline[]" multiple>
				<option value="URBANISTICA">URBANISTICA</option>
				<option value="BOTANICA_AMBIENTALE_E_APPLICATA">BOTANICA AMBIENTALE E APPLICATA</option>
				<option value="STORIA_DELL%E2%80%99ARTE_MODERNA">STORIA DELL'ARTE MODERNA</option>
				<option value="COMPOSIZIONE_ARCHITETTONICA_E_URBANA">COMPOSIZIONE ARCHITETTONICA E URBANA</option>
				<option value="ARCHIVISTICA%2C_BIBLIOGRAFIA_E_BIBLIOTECONOMIA">ARCHIVISTICA, BIBLIOGRAFIA E BIBLIOTECONOMIA</option>
				<option value="GEORISORSE_MINERARIE_E_APPLICAZIONI_MINERALOGICO-_PETROGRAFICHE_PER_L%27AMBIENTE_ED_I_BENI_CULTURALI">GEORISORSE MINERARIE E APPLICAZIONI MINERALOGICO- PETROGRAFICHE PER L'AMBIENTE ED I BENI CULTURALI</option>
				<option value="PALEONTOLOGIA_E_PALEOECOLOGIA">PALEONTOLOGIA E PALEOECOLOGIA</option>
				<option value="GEOGRAFIA_ECONOMICO-POLITICA">GEOGRAFIA ECONOMICO-POLITICA</option>
				<option value="ARCHEOLOGIA_CRISTIANA_E_MEDIEVALE">ARCHEOLOGIA CRISTIANA E MEDIEVALE</option>
				<option value="STORIA_DELL%E2%80%99ARTE_CONTEMPORANEA">STORIA DELL'ARTE CONTEMPORANEA</option>
				<option value="INFORMATICA">INFORMATICA</option>
				<option value="FISICA_APPLICATA_%28A_BENI_CULTURALI%2C_AMBIENTALI%2C_BIOLOGIA_E_MEDICINA%29">FISICA APPLICATA (A BENI CULTURALI, AMBIENTALI, BIOLOGIA E MEDICINA)</option>
				<option value="ARCHITETTURA_DEL_PAESAGGIO">ARCHITETTURA DEL PAESAGGIO</option>
				<option value="STORIA_MEDIEVALE">STORIA MEDIEVALE</option>
				<option value="TECNICA_E_PIANIFICAZIONE_URBANISTICA">TECNICA E PIANIFICAZIONE URBANISTICA</option>
				<option value="STORIA_CONTEMPORANEA">STORIA CONTEMPORANEA</option>
				<option value="GEOGRAFIA">GEOGRAFIA</option>
				<option value="MUSEOLOGIA_E_CRITICA_ARTISTICA_E_DEL_RESTAURO">MUSEOLOGIA E CRITICA ARTISTICA E DEL RESTAURO</option>
				<option value="GEOGRAFIA_FISICA_E_GEOMORFOLOGIA">GEOGRAFIA FISICA E GEOMORFOLOGIA</option>
				<option value="RAPPRESENTAZIONE">RAPPRESENTAZIONE</option>
				<option value="ANTROPOLOGIA">ANTROPOLOGIA</option>
				<option value="ARCHEOLOGIA_CLASSICA">,ARCHEOLOGIA CLASSICA</option>
				<option value="TOPOGRAFIA_E_CARTOGRAFIA">TOPOGRAFIA E CARTOGRAFIA</option>
				<option value="LETTERATURA_ITALIANA">LETTERATURA ITALIANA</option>
				<option value="ECONOMIA_E_PIANIFICAZIONE_TERRITORIALE">ECONOMIA E PIANIFICAZIONE TERRITORIALE</option>
				<option value="METODOLOGIE_DELLA_RICERCA_ARCHEOLOGICA">METODOLOGIE DELLA RICERCA ARCHEOLOGICA</option>
				<option value="PREISTORIA_E_PROTOSTORIA">PREISTORIA E PROTOSTORIA</option>
				<option value="TOPOGRAFIA_ANTICA">TOPOGRAFIA ANTICA</option>
				<option value="STORIA_DELL%E2%80%99ARTE_MEDIEVALE">STORIA DELL'ARTE MEDIEVALE</option>
				<option value="CHIMICA_DELL%27AMBIENTE_E_DEI_BENI_CULTURALI">CHIMICA DELL'AMBIENTE E DEI BENI CULTURALI</option>
				<option value="STORIA_MODERNA">STORIA MODERNA</option>
				<option value="ECOLOGIA">ECOLOGIA</option>
				<option value="FONDAMENTI_CHIMICI_DELLE_TECNOLOGIE">FONDAMENTI CHIMICI DELLE TECNOLOGIE</option>
				<option value="RESTAURO">,RESTAURO</option>
				<option value="ETRUSCOLOGIA_E_ANTICHIT%C3%80_ITALICHE">ETRUSCOLOGIA E ANTICHITA' ITALICHE</option>
			</select>	
			<br>
			<br>
			<p>
			<h3>Settori Affini</h3>
			</p>
			<select name="Settori[]" multiple>
				<option value="STORIA_MODERNA%2FCONTEMPORANEA">STORIA MODERNA/CONTEMPORANEA</option>
				<option value="ARCHEOLOGIA_E_STORIA_DELL%27ARTE_DELL%27INDIA_E_DELL%27ASIA_CENTRALE">ARCHEOLOGIA E STORIA DELL'ARTE DELL'INDIA E DELL'ASIA CENTRALE</option>
				<option value="CHIMICA_ANALITICA">CHIMICA ANALITICA</option>
				<option value="MINERALOGIA">MINERALOGIA</option>
				<option value="GEOGRAFIA_ECONOMICO-POLITICA">GEOGRAFIA ECONOMICO-POLITICA</option>
				<option value="CHIMICA_FISICA">CHIMICA FISICA</option>
				<option value="STORIA_ROMANA">STORIA ROMANA</option>
				<option value="FILOLOGIA_ITALICA%2C_ILLIRICA_E_CELTICA">FILOLOGIA ITALICA, ILLIRICA E CELTICA</option>
				<option value="ARCHEOLOGIA_CRISTIANA_E_MEDIEVALE">ARCHEOLOGIA CRISTIANA E MEDIEVALE</option>
				<option value="STORIA_DELL%E2%80%99ARTE_MEDIEVALE%2FCONTEMPORANEA">STORIA DELL'ARTE MEDIEVALE/CONTEMPORANEA</option>
				<option value="ARCHITETTURA_DEL_PAESAGGIO">ARCHITETTURA DEL PAESAGGIO</option>
				<option value="RESTAURO">RESTAURO</option>
				<option value="TOPOGRAFIA_ANTICA">TOPOGRAFIA ANTICA</option>
				<option value="STORIA_DELL%E2%80%99ARTE_MEDIEVALE%2FMODERNA">STORIA DELL'ARTE MEDIEVALE/MODERNA</option>
				<option value="STORIA_GRECA">STORIA GRECA</option>
				<option value="GEOGRAFIA">GEOGRAFIA</option>
				<option value="METODOLOGIE_DELLA_RICERCA_ARCHEOLOGICA_ARCHEOLOGIA_DEL_PAESAGGIO">METODOLOGIE DELLA RICERCA ARCHEOLOGICA ARCHEOLOGIA DEL PAESAGGIO</option>
				<option value="CHIMICA_ORGANICA">CHIMICA ORGANICA</option>
				<option value="STORIA">STORIA</option>
				<option value="ETRUSCOLOGIA_E_ANTICHITA%27_ITALICHE">ETRUSCOLOGIA E ANTICHITA' ITALICHE</option>
				<option value="URBANISTICA">URBANISTICA</option>
				<option value="ARCHEOLOGIA_CLASSICA">ARCHEOLOGIA CLASSICA</option>
				<option value="CHIMICA_GENERALE_E_INORGANICA">CHIMICA GENERALE E INORGANICA</option>
				<option value="ARCHEOLOGIA_E_STORIA_DELL%27ARTE_DEL_VICINO_ORIENTE_ANTICO">ARCHEOLOGIA E STORIA DELL'ARTE DEL VICINO ORIENTE ANTICO</option>
				<option value="STORIA_DELL%E2%80%99ARTE_MODERNA%2FCONTEMPORANEA">STORIA DELL'ARTE MODERNA/CONTEMPORANEA</option>
				<option value="PIETROLOGIA_E_PETROGRAFIA">PIETROLOGIA E PETROGRAFIA</option>
				<option value="STORIA_MEDIEVALE%2FCONTEMPORANEA">STORIA MEDIEVALE/CONTEMPORANEA</option>
				<option value="ARCHEOLOGIA_FENICIO-PUNICA">ARCHEOLOGIA FENICIO-PUNICA</option>
				<option value="ANTROPOLOGIA">ANTROPOLOGIA</option>
				<option value="STORIA_MEDIEVALE%2FMODERNA">STORIA MEDIEVALE/MODERNA</option>
				<option value="ARCHITETTURA_DEGLI_INTERNI_E_ALLESTIMENTO">ARCHITETTURA DEGLI INTERNI E ALLESTIMENTO</option>
				<option value="METODOLOGIE_DELLA_RICERCA_ARCHEOLOGICA">METODOLOGIE DELLA RICERCA ARCHEOLOGICA</option>
				<option value="BOTANICA_GENERALE">BOTANICA GENERALE</option>
				<option value="STORIA_MODERNA">STORIA MODERNA</option>
				<option value="TECNICA_E_PIANIFICAZIONE_URBANISTICA">TECNICA E PIANIFICAZIONE URBANISTICA</option>
				<option value="BOTANICA_SISTEMATICA">BOTANICA SISTEMATICA</option>
				<option value="PREISTORIA_E_PROTOSTORIA">PREISTORIA E PROTOSTORIA</option>
				<option value="FISICA_SPERIMENTALE">FISICA SPERIMENTALE</option>
			</select>	
			<br>
			<br>
			<p>
			<h3>Tematiche</h3>
			</p>
			<select name="Tematiche[]" multiple>
				<option value="Pianificazione_economica_territoriale">Pianificazione economica territoriale</option>
				<option value="Economia">Economia</option>
				<option value="Conservazione_dei_beni_architettonici_e_ambientali">Conservazione dei beni architettonici e ambientali</option>
				<option value="Tecnologie_per_la_conservazione_e_il_restauro_dei_beni_cultural">Tecnologie per la conservazione e il restauro dei beni culturali</option>
				<option value="Voci_del_territorio">Voci del territorio</option>
				<option value="Restauro">Restauro</option>
				<option value="Rilievo_dell%27architettura">Rilievo dell'architettura</option>
				<option value="Economia_per_l%27ambiente_e_la_cultura">Economia per l'ambiente e la cultura</option>
				<option value="Ricostruzione_virtuale_in_ambito_architettonico">Ricostruzione virtuale in ambito architettonico</option>
				<option value="Cartografia_e_GIS">Cartografia e GIS</option>
				<option value="Turismo">Turismo</option>
				<option value="Valutazioni_VAS_e_TIA">Valutazioni VAS e TIA</option>
				<option value="Conservazione_e_restauro_dei_beni_culturali">Conservazione e restauro dei beni culturali</option>
				<option value="Beni_Culturali">Beni Culturali</option>
				<option value="Pianificazione_territoriale%2C_urbanistica%2C_paesaggistica_e_ambientale">Pianificazione territoriale, urbanistica, paesaggistica e ambientale</option>
				<option value="Architettura_del_Paesaggio">Architettura del Paesaggio</option>
				<option value="Formazione">Formazione</option>
				<option value="Anastilosi_virtuale_in_ambito_archeologico">Anastilosi virtuale in ambito archeologico</option>
				<option value="Fotografie_e_rappresentazioni_artistiche">Fotografie e rappresentazioni artistiche</option>
				<option value="Competenze">Competenze</option>
				<option value="Progettazione_e_gestione_di_sistemi_turistici">Progettazione e gestione di sistemi turistici</option>
				<option value="Storytelling">Storytelling</option>
				<option value="Metolodogia_informatica_per_le_discipline_umanistiche">Metolodogia informatica per le discipline umanistiche</option>
				<option value="Geografia">Geografia</option>
				<option value="Scavi_archeologici_e_ricostruzioni_virtuali">Scavi archeologici e ricostruzioni virtuali</option>
				<option value="Modellazione_3d">Modellazione 3d</option>
				<option value="Cartografia_storica_e_HGIS">Cartografia storica e HGIS</option>
				<option value="Archeologia">Archeologia</option>

			</select>	
			<br>
			<br>
			<p>
			<h3>Tipologie</h3>
			</p>
			<select name="Tipologie[]" multiple>
				<option value="Esercitazioni">Esercitazioni</option>
				<option value="risultati_economico-finanziari">risultati economico-finanziari</option>
				<option value="modelli_formativi">modelli formativi</option>
				<option value="SHAPE_File">SHAPE File</option>
				<option value="Articolo">Articolo</option>
				<option value="Grafici">Grafici</option>
				<option value="governance">governance</option>
				<option value="Scheda_informativa">Scheda informativa</option>
				<option value="mappatura_modelli_gestione">mappatura modelli gestione</option>
				<option value="App">App</option>
				<option value="Infographic">Infographic</option>
				<option value="Cartografia_storica">Cartografia storica</option>
				<option value="Video">Video</option>
				<option value="Piani_strategici">Piani strategici</option>
				<option value="Immagini">Immagini</option>
				<option value="Visori">Visori</option>
				<option value="Modelli">Modelli</option>
				<option value="Scenari">Scenari</option>
				<option value="News_%2FEventi">News /Eventi</option>
				<option value="Ricostruzioni_3d_di_ambienti_virtuali">Ricostruzioni 3d di ambienti virtuali</option>
				<option value="Metadati">Metadati</option>
				<option value="Cartografia_e_mappe_tematiche">Cartografia e mappe tematiche</option>
				<option value="Fonti">Fonti</option>
				<option value="mappatura_ex_ante_e_ex_post">mappatura ex ante e ex post</option>
				<option value="Blogs">Blogs</option>
				<option value="quadri_programmatici">quadri programmatici</option>
			</select>	
			<br>
			<br>
                         </div>
				</form>
					<button onclick='f1(this)'>Show search options</button>
                               </p>
                          </div>

                </div>
        </header>
</body>
</html>`

