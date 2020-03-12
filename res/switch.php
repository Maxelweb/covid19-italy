<?php

/**
 *  Page selector for the homepage
 *  @author Maxelweb (marianosciacco.it)
 *  @version 1.0
 */


require_once 'config.php';

switch ($name) {
	
	default:
		require_once("pages/graphs.php");
		break;
}