<?php

require_once 'vendor/autoload.php';
 
session_start();

define('OAUTH_HOST', 'http://' . $_SERVER['SERVER_NAME']."/snippets/oauth");
$id = 0;

//Init the OAuthStore
$options = array(
	'consumer_key' => 'deed093bce4fbd47beffb5ea49223ce205501515c',
	'consumer_secret' => '5df430d0f418b326e69740a22016339c',
	'server_uri' => OAUTH_HOST,
	'request_token_uri' => OAUTH_HOST . '/request_token.php',
	'authorize_uri' => OAUTH_HOST . '/login.php',
	'access_token_uri' => OAUTH_HOST . '/access_token.php'
);
OAuthStore::instance('Session', $options);

$s = OAuthStore::instance();

if(empty($_GET['oauth_token'])) {
	// get a request token
	$tokenResultParams = OAuthRequester::requestRequestToken($options['consumer_key'], $id);
	
	header('Location: ' . $options['authorize_uri'] . '?oauth_token=' . $tokenResultParams['token'] .  
			'&oauth_callback=' . urlencode('http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']));
}
else {
	// get an access token
	$oauthToken = $_GET['oauth_token'];
	$tokenResultParams = $_GET;

	/*echo $options['consumer_key']."\n";
	echo $tokenResultParams['oauth_token']."\n";
	die();*/
	//die($_GET['oauth_token']);
	
	OAuthRequester::requestAccessToken($options['consumer_key'], $tokenResultParams['oauth_token'], $id, 'POST', $_GET);
	
	$request = new OAuthRequester(OAUTH_HOST . '/has_subscription.php', 'GET', $tokenResultParams);
	$result = $request->doRequest(0);
	if ($result['code'] == 200) {
		echo "request 1";
		var_dump($result['body']);
	} else {
		echo 'Error';
	}
	
	$request = new OAuthRequester(OAUTH_HOST . '/has_subscription.php', 'GET', $tokenResultParams);
	$result = $request->doRequest(0);
	if ($result['code'] == 200) {
		echo "request 2";
		var_dump($result['body']);
	} else {
		echo 'Error';
	}
	
	$request = new OAuthRequester(OAUTH_HOST . '/has_subscription.php', 'GET', $tokenResultParams);
	$result = $request->doRequest(0);
	if ($result['code'] == 200) {
		echo "request 3";
		var_dump($result['body']);
	} else {
		echo 'Error';
	}
}