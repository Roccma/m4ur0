<?php
ini_set('display_errors','on'); 
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);   // DEBUGGING
set_time_limit(0);

///////////////////////////////////////////////////
// Traer Articulos desde nodum
//
// este procedimiento mira la información existen ten las tablas de productos de nodum y los carga en el crm 
//
// Se agenda este proceso para que corra automaticamente.
//////////////////////////////////////////////////





echo "<br>voy a comenzar";


define('SQLSERVER', "189.240.202.203:2996");
define('SQLDATABASE', "MAYASIR");
define('SQLPASS', "L4sMej0resPl@yas");
define('SQLUSER', "crmsirenis");

//////////////// conexcion en linux
$link = mssql_connect(SQLSERVER, SQLUSER, SQLPASS);
echo "<br>luego del msql_connect";

if (!$link)
    die('Unable to connect!');
 
if (!mssql_select_db(SQLDATABASE, $link))
    die('Unable to select database!');


set_time_limit(0);

// vista con la información de articulos
$consulta = "select top 10 * from [Customer]";
echo $consulta;
$sqlserver = mssql_query( $consulta);
$myrow = mssql_fetch_array( $sqlserver);
$cmodificados = 0;
$ccreados = 0;
echo "hola";
while ($myrow = mssql_fetch_array( $sqlserver)){
	$codigo = $myrow["Name"];
	echo "<br>este es el codigo".$codigo;
	
}


?>
