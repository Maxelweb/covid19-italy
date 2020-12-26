<?php 

/**
 *  Data catcher
 *  @author Maxelweb (marianosciacco.it)
*/


require_once 'config.php';

$data = json_decode(file_get_contents(DATA_DPC), true);

