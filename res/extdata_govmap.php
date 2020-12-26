<?php 

/**
 *  Data catcher
 *  @author Maxelweb (marianosciacco.it)
 */


require_once 'config.php';

$data = file_get_contents(DATA_GOV_ZONES_FAQ);
preg_match('/<div class="col-md-6 contenitore_svg">(.*?)<\/div>/s', $data, $match);

if(!empty($match)){

	$svgimage = preg_replace('/onclick="(.*?)"/is', "", $match[1]);
	echo $svgimage;
}
