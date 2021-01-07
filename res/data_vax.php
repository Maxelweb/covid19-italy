<?php 

/**
 *  Data catcher
 *  @author Maxelweb (marianosciacco.it)
*/


require_once 'config.php';

$data_vax = json_decode(file_get_contents(DATA_DPC_VAX), true);

