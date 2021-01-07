<?php

/**
 *  Page selector for the homepage
 *  @author Maxelweb (marianosciacco.it)
*/


require_once 'config.php';

if(!$name)
	require_once("pages/home.php");
else if($name == "vaccini"){
	require_once("pages/vax.php");
}
else
{
	require_once("pages/graphs.php");
	require_once("pages/regions.php");
}
