<?php 

/**
 *  Data catcher
 *  @author Maxelweb (marianosciacco.it)
 *  @version 1.1
 */


require_once 'config.php';

$data_global_latest =  json_decode(file_get_contents(DATA_DPC_GLOBAL_LATEST), true);
$data_regions = json_decode(file_get_contents(DATA_DPC_REGIONS), true);

