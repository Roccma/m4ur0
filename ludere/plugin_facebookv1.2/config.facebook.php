<?php

// FB api config
define('FB_APP_ID', '177578909682390');
define('FB_APP_SECRET', '05b048951d38671bb1625efbdf3a0cf0');
define('FB_PAGE_ID', '124455234289890'); //Id de pagina (Tres cruces)


//Referencias vtiger
define('MODULENAME','Contacts');
define('TABLENAME', 'trescruces.vtiger_contactdetails');
define('FIELDNAME', 'id_facebook');

//Flags
define('TESTING',true);

//Array con flags de que importar
$IMPORT = array(
    'likes'     =>  true,
    'comments'  =>  true,
    'posts'     =>  true,
    'messages'  =>  false,
  );

//Buscar id usuario


//Pagination config
define("LIMIT_PER_PAGE",10);
define('TOTAL_FEED', 10);

define("COMMENTS_PER_PAGE",5);
define("MESSAGES_PER_PAGE",5);
define("LIKES_PER_PAGE",20);

?>

