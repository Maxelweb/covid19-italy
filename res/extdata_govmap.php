<?php 

/**
 *  Data catcher
 *  @author Maxelweb (marianosciacco.it)
 */


require_once 'config.php';

$data = file_get_contents(DATA_GOV_ZONES_FAQ);
preg_match('/<div class="col-md-6 contenitore_svg">(.*?)<\/div>/s', $data, $match);

if(empty($match)){
	outputErrorLoading();
} else {

	preg_match('/<svg/s', $match[0], $matchMap);

	if(empty($matchMap))
		outputErrorLoading();
	else
		echo preg_replace('/onclick="(.*?)"/is', "", $match[1]);
}
