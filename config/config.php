<?php
function url()
{
	return sprintf(
		"%s://%s%s",
		isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
		$_SERVER['SERVER_NAME'],
		":" .
			$_SERVER['SERVER_PORT'],
		$_SERVER['REQUEST_URI']
	);
}

function base_url($url = null)
{
	$base_url = rtrim(url(), '/') . "/ptsurya";
	if ($url != null) {
		return $base_url . '/' . $url;
	} else {
		return $base_url;
	}
}

session_start();
date_default_timezone_set('Asia/Makassar');
