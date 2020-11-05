<?php

/**
 *  Page selector for the homepage
 *  @author Maxelweb (marianosciacco.it)
 *  @version 1.2
 */


require_once 'config.php';

if(!$name)
	require_once("pages/home.php");
else
{
	require_once("pages/graphs.php");
	require_once("pages/regions.php");
}
