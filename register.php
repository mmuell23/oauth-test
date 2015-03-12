<?php
	require_once 'include/common.php';

	if(isset($_POST['requester_name'])) {
		$sql = "INSERT INTO users (name, email, created) VALUES ('".$_POST['requester_name']."', '".$_POST['requester_email']."', NOW())";
		mysql_query($sql) or die($sql);
		$id = mysql_insert_id();
	
		$key = $store->updateConsumer($_POST, $id, true);
		$c = $store->getConsumer($key, $id);
		
		
		//id 1
		//consumer key a0c2b578b59ccf7921ff9b81544902b605500397e
		//consumer secret efb8c3ace487df59459cd9bab54ac34a
		?>
		<p><strong>Save these values!</strong></p>
		<p>Consumer key: <strong><?=$c['consumer_key']; ?></strong></p>
		<p>Consumer secret: <strong><?=$c['consumer_secret']; ?></strong></p>
		<?php 
	}
?>
<form method="post" action="register.php">
 <fieldset>
  <legend>Register</legend>
  <div>
   <label for="requester_name">Name</label>
   <input type="text" id="requester_name" name="requester_name">
  </div>
  <div>
   <label for="requester_email">Email</label>
   <input type="text" id="requester_email" name="requester_email">
  </div>
  <div>
   <label for="application_uri">URI</label>
   <input type="text" id="application_uri" name="application_uri">
  </div>
  <div>
   <label for="callback_uri">Callback URI</label>
   <input type="text" id="callback_uri" name="callback_uri">
  </div>
 </fieldset>
 <input type="submit" value="Register">
</form>