<?php

function generate_token()
{
	$token = uniqid(rand(), true);
	$_SESSION['_token'] = $token;
	return $token;
}

function check_token()
{
if(isset($_SESSION['_token']) && isset($_POST['token']))
	if($_SESSION['_token'] == $_POST['token'])
		return true;
return false;
}

?>