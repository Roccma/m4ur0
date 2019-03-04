<?php

define("API_URL","https://api.instagram.com/");
define("API_VERSION","v1");
define("CLIENT_ID","9192f97d399c463098fcb11f43ef9fb9");
define("CLIENT_SECRET","bfacead84d574e419f4eca46f338341f");
define("REDIRECT_URI","http://localhost/retail65/insta_redirect.php/");

define("IG_ACCOUNT_ID","697994684");

define("IG_IDENTIFIER","username");

define("DEBUG", false);

$IMPORT = array(
	'posts'		=> true,
	'comments'	=> true,
	'likes'		=> true
	);

//TEMP
define("ACCESS_TOKEN", "697994684.9192f97.a775464a29fc4e7c8863ac0fab547de4");


//Referencias vtiger
define('MODULENAME','Contacts');
define('TABLENAME', 'vtiger_contactdetails');
define('FIELDNAME', ''); //define('FIELDNAME', 'id_instagram');



?>