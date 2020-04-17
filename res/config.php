<?php

/**
 *  Configuration file
 *  @author Maxelweb (marianosciacco.it)
 *  @version 1.1
 */


/**
 * Edit the array to change the configuration
 * -----
 * You can also edit the .htaccess in the root directory to change the timezone
 */


define("VERSION", "1.1");
define("REPO", "https://github.com/Maxelweb/covid19-italy");
define("DATA_DPC", "https://raw.githubusercontent.com/pcm-dpc/COVID-19/master/dati-json/dpc-covid19-ita-andamento-nazionale.json");
$name = isset($_GET['name']) ? $_GET['name'] : '';

function nformat($n) {
	return number_format($n, 0, ',', '.'); 
}

$_data = array("ricoverati_con_sintomi",
		        "terapia_intensiva",
		        "totale_ospedalizzati",
		        "isolamento_domiciliare",
		        "totale_positivi",
		        "nuovi_positivi",
		        "dimessi_guariti",
		        "deceduti",
		        "totale_casi",
		        "tamponi");


