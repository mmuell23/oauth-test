<?php
require_once 'include/common.php';

// check if the login information is valid and get the user's ID
$row = false; 
if(isset($_GET['requester_email'])) {
	$sql = "SELECT id FROM users WHERE email = '".$_GET['requester_email']."'";
	$qy = mysql_query($sql) or die($sql);
	$row = mysql_fetch_array($qy);
}

if (!$row) {
	?>
	<form action="login.php" method="get">
		<input type="text" name="requester_email"/>
		<input type="hidden" name="oauth_token" value="<?php echo $_GET["oauth_token"]; ?>"/>
		<input type="hidden" name="oauth_callback" value="<?php echo $_GET["oauth_callback"]; ?>"/>
		<input type="hidden" name="allow" value="1"/>
		<input type="submit" value="login"/>
	</form>
	<?php
	die("nicht eingeloggt");
}
$id = $row['id'];

// Check if there is a valid request token in the current request.
// This returns an array with the consumer key, consumer secret,
// token, token secret, and token type.
$rs = $server->authorizeVerify();
// See if the user clicked the 'allow' submit button (or whatever
// you choose)

$authorized = array_key_exists('allow', $_GET);
// Set the request token to be authorized or not authorized
// When there was a oauth_callback then this will redirect to
// the consumer
$server->authorizeFinish($authorized, $id);
?>
