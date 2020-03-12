<?php

/**
 *  Core functions and classes
 *  @author Maxelweb (marianosciacco.it)
 *  @version 1.0
 */


function formatTime($time)
{
	$age = time()-$time;
	$years = floor($age/(3600*24*7*4*12));
	$months = floor($age/(3600*24*7*4));
	$weeks = floor($age/(3600*24*7));
	$days = floor($age/(3600*24));
	$hours = floor($age/3600);
	$minutes = floor($age/60);
	$seconds = $age;

	if($years>0)
		$age = ($years>1) ? sprintf('%d years ago', $years) : '1 year ago';
	elseif($months>0)
		$age = ($months>1) ? sprintf('%d months ago', $months) : '1 month ago';
	elseif($weeks>0)
		$age = ($weeks>1) ? sprintf('%d weeks ago', $weeks) : '1 week ago';
	elseif($days>0)
		$age = ($days>1) ? sprintf('%d days ago', $days) : '1 day ago';
	elseif($hours>0)
		$age = ($hours>1) ? sprintf('%d hours ago', $hours) : '1 hour ago';
	elseif($minutes>0)
		$age = ($minutes>1) ? sprintf('%d mins ago', $minutes) : '1 min ago';
	elseif($seconds>0)
		$age = ($seconds>1) ? sprintf('%d sec ago', $seconds) : '1 sec ago';
	else
		$age = "undefined";

	return $age;
}	




