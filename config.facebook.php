<?php

// FB api config
define('FB_APP_ID', '147685465712005');// '164387644128245'); //'177578909682390');
define('FB_APP_SECRET', 'bdca5cc168162ecef8ebc4d9ca410bee');//'0b91e20b8c2831cf168aeeb53e2a1944'); //'05b048951d38671bb1625efbdf3a0cf0');
define('FB_PAGE_ID', '124455234289890'); //Id de pagina (Tres cruces)


//Referencias vtiger
define('MODULENAME','Contacts');
define('TABLENAME', 'vtiger7.vtiger_contactdetails');
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

