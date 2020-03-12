<?php

/**
 *  Configuration file
 *  @author Maxelweb (marianosciacco.it)
 *  @version 1.0
 */


/**
 * Edit the array to change the configuration
 * -----
 * You can also edit the .htaccess in the root directory to change the timezone
 */


define("VERSION", "0.1");
define("REPO", "https://github.com/Maxelweb/covid19-italy");
define("DATA_DPC", "https://raw.githubusercontent.com/pcm-dpc/COVID-19/master/dati-json/dpc-covid19-ita-andamento-nazionale.json");
$name = isset($_GET['name']) ? $_GET['name'] : '';

require_once("utils/core.php");

