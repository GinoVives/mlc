<?php
session_start();

if ($_POST['token']):
	$token = $_POST['token'];
	$_SESSION['access_token'] = $token;
	$_SESSION['user_id'] = substr($token, strrpos($token,"-")-strlen($token)+1);
	// lets give it a try
	$url = "https://api.mercadolibre.com/users/".$_SESSION['user_id'];
	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_URL => $url,
	));
	$response = curl_exec($curl);
	curl_close($curl);
	$json_user = json_decode($response);

	// Guardamos algunas variables para despues
	$_SESSION['nickname'] = $json_user->nickname;
else:
	echo 'No token received';
endif;
?>
