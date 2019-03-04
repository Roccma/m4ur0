<?php


$FILENAME 		= str_replace(__DIR__.DIRECTORY_SEPARATOR,"", __FILE__);

$BASE_PATH 		= __DIR__;

$DEST_PATH 		= __DIR__;

$DEST_PATH 		= implode(DIRECTORY_SEPARATOR, explode(DIRECTORY_SEPARATOR, $DEST_PATH,-2) ); //Voy dos carpetas mas atras para llegar al crm

$PLUGIN_NAME 	= 'Facebook';

$VERSION  	 	= '1.2';

$CREDITS 	 	= 'KMaidana';

$LAST_UPDATE 	= '2017/09/13'; 


echo "Script de instalacion de plugin ".$PLUGIN_NAME.PHP_EOL;
echo "Version: ".$VERSION.PHP_EOL;
if($CREDITS) 		echo "Creado por: ".$CREDITS.PHP_EOL;	
if($LAST_UPDATE) 	echo "Ultima actualizacion: ".$LAST_UPDATE.PHP_EOL;

echo "Iniciando instalacion...".PHP_EOL;

echo "Scaneando directorio: ".$BASE_PATH.PHP_EOL;
$scaned_dir = array_slice(scandir($BASE_PATH), 2);

//Elimino el propio archivo del escaneo
$key = array_search($FILENAME, $scaned_dir);
unset($scaned_dir[$key]);

copy_files($scaned_dir,'');


function copy_files($dir,$path){
	global $BASE_PATH,$DEST_PATH;
	foreach($dir as $obj){
		$obj_path = $BASE_PATH.DIRECTORY_SEPARATOR.($path? $path.DIRECTORY_SEPARATOR : '').$obj;
		if(is_file($obj_path)){
			$dest_path = $DEST_PATH.DIRECTORY_SEPARATOR.($path? $path.DIRECTORY_SEPARATOR : '').$obj;
			echo "Copiando archivo desde: ".$obj_path." a: ".$dest_path.PHP_EOL;
			//Si existe el archivo hacer un diff
			$result = copy($obj_path,$dest_path);
			echo ($result? "Archivo copiado satisfactoriamente" : "Error al copiar el archivo").PHP_EOL; 
		}
		if(is_dir($obj_path)){
			$dest_path = $DEST_PATH.DIRECTORY_SEPARATOR.($path? $path.DIRECTORY_SEPARATOR : '').$obj;

			if( !file_exists($dest_path) ){ //Checkeo que exista en el crm
				echo "Creando el directorio: ".$dest_path.PHP_EOL; 
				$result = mkdir($dest_path); 

			}
			 
			echo "Scaneando directorio: ".$obj_path.PHP_EOL;
			$scaned_dir = array_slice(scandir($obj_path), 2);
			copy_files($scaned_dir,($path? $path.DIRECTORY_SEPARATOR : '').$obj);
		}
	}
}

echo "Fin de instalacion...".PHP_EOL;
echo "Plugin instalado correctamente".PHP_EOL;


?>