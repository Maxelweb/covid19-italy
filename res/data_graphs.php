<?php 

/**
 *  Data catcher
 *  @author Maxelweb (marianosciacco.it)
 *  @version 1.2
 */


require_once 'config.php';

$data = json_decode(file_get_contents(DATA_DPC), true);

