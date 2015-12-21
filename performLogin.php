<?php
session_start();

if ($_POST['token']):
	$token = $_POST['token'];
	echo '<p>Received token is: '.$token;
	$_SESSION['access_token'] = $token;
	$_SESSION['user_id'] = substr($token, -8);
	// lets give it a try
	$url = "https://api.mercadolibre.com/users/".$_SESSION['user_id']; // ."/addresses?access_token=".$token;
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
