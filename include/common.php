<?php
require_once 'vendor/autoload.php';
 
session_start();
 
// Add a header indicating this is an OAuth server
header('X-XRDS-Location: http://' . $_SERVER['SERVER_NAME'] .'/services.xrds.php');
 

define ('DB_HOST', '127.0.0.1');				// database host
define ('DB_NAME', 'oauth');							// name of database
define ('DB_USER', 'root');							// username
define ('DB_PASS', 'root');							// password

define ('OAUTH_LOG_REQUEST', "1");
// DB: MySQL
$con = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("keine db verbindung");
$db = mysql_select_db(DB_NAME) or die("keine db verbindung");

// Create a new instance of OAuthStore and OAuthServer
$store = OAuthStore::instance('MySQL', array('conn' => $con));
$server = new OAuthServer();