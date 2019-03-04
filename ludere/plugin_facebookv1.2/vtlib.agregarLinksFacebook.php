<?php 

$Vtiger_Utils_Log = true;

include_once('vtlib/Vtiger/Module.php');

$moduleLink  	= 'index.php?module=Facebook';

$links = array ( 	
						array( 'linklabel' => 'Configurar api', 'linkurl' => $moduleLink.'&view=Index' )
					 ) ;

$moduleInstance = Vtiger_Module::getInstance('Facebook');

if( $moduleInstance ){
	$adb 			= PearDatabase::getInstance();
	foreach($links as $link){			
		$query = 'SELECT * FROM vtiger_links WHERE tabid = ? AND linklabel = ?';	
		
		$result = $adb->pquery($query,array($moduleInstance->getId(),$link['linklabel']));		//Busca si existe el link en la base de datos
		
		if(	$adb->num_rows($result)	==	0){		// En caso de que no exista lo crea 				
			$moduleInstance->addLink("LISTVIEW",$link['linklabel'], $link['linkurl']);
		}

	}
}
else{
	echo "El modulo no existe<br>";
}

echo "Todo Ok";
?>

