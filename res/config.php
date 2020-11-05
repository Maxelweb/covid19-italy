<?php

/**
 *  Configuration file
 *  @author Maxelweb (marianosciacco.it)
 *  @version 1.2
 */


/**
 * Edit the array to change the configuration
 * -----
 * You can also edit the .htaccess in the root directory to change the timezone
 */


define("VERSION", "1.2");
define("REPO", "https://github.com/Maxelweb/covid19-italy");
define("DATA_DPC", "https://raw.githubusercontent.com/pcm-dpc/COVID-19/master/dati-json/dpc-covid19-ita-andamento-nazionale.json");
define("DATA_DPC_REGIONS", "https://raw.githubusercontent.com/pcm-dpc/COVID-19/master/dati-json/dpc-covid19-ita-regioni-latest.json");
define("DATA_DPC_GLOBAL_LATEST", "https://raw.githubusercontent.com/pcm-dpc/COVID-19/master/dati-json/dpc-covid19-ita-andamento-nazionale-latest.json");

$name = isset($_GET['name']) ? $_GET['name'] : '';

function nformat($n) { // numbers
	return number_format($n, 0, ',', '.'); 
}

function nameFormat($n) {
	return ucfirst(str_replace("_", " ", $n));
}

function outputErrorLoading() {
	echo "<p class='text-danger my-4 text-center'><i class='far fa-frown'></i> Non è stato possibile caricare i dati. Riprova più tardi.</p>";
}

function calcTrend($data, $name, $days){
	$x = array_slice($data,(-1)*$days,$days);
	$total = 0;
  	for($i = 0; $i<count($x); $i++) {
    	if($i == 0) 
      		continue;
    	else
      		$total += $x[$i][$name] - $x[$i-1][$name];
	}
	return number_format($total/$days, 0, "," , ".");
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


