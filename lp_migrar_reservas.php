<?php

/*error_reporting(E_ALL);
ini_set("display_errors", 1);*/

//require_once('config.ludere.php');
require_once('include/database/PearDatabase.php');
require_once('include/utils/utils.php');
require_once('includes/Loader.php');
require_once('includes/runtime/LanguageHandler.php');
//require_once('meli.php');
//equire_once('ml_funciones_mensajes.php');
require_once('modules/Reservations/Reservations.php');
require_once('modules/Contacts/Contacts.php');
require_once('modules/ModComments/ModComments.php');
require_once('lp_config.php');

global $adb, $log, $default_timezone;
global $current_language;
global $current_user;
global $default_language;
global $default_theme;
global $site_URL, $application_unique_key;
global $lpconfig;

vimport('includes.http.Request');
vimport('includes.runtime.BaseModel');
vimport('includes.runtime.Controller');
vimport('includes.runtime.Globals');

$json_string = file_get_contents(CONFIG_DB_FILE);
$json_databases = json_decode($json_string, TRUE);

ini_set('display_errors','on'); error_reporting(E_ERROR);

set_time_limit(0);
$databases = $json_databases['databases'];

$tipo_facturacion = Array("Agencia", "Directo");
$estado = Array("Reserva", "Anulada", "Entrada", "Salida", "No Show");
$trato = Array("Cliente", "Invitado", "Personal", "VIP", "TS Fijo", "TS Flotante", "TS Alq. Prop.", "TS Alq. Emp.", "TS Intercambio", "TS Puntos"); 

foreach ($databases as $db) {
//define('SQLSERVER', "189.240.202.203:2996");
//define('SQLDATABASE', "MAYASIR");
//define('SQLPASS', "L4sMej0resPl@yas");
//define('SQLUSER', "crmsirenis");

	$link = mssql_connect($db['sql_server'], $db['sql_user'], $db['sql_pass']);
	
	if (!$link)
	    die('Unable to connect!');

	if (!mssql_select_db($db['sql_db'], $link))
	    die('Unable to select database!');

	echo "Me conecté a la BD <br>";	

	foreach ($db['sql_prefixes'] as $prefix) {
		//$prefix = "KAIBAMEX SA DE CV$";
		$prefix = $prefix['prefix_name'];
		$table_name = $prefix . "Reservas";
		//$sql = "SELECT TOP 10 * FROM [" . $table_name . "] WHERE [Fecha venta] > '01/01/2019 00:00:00'";
		$sql = "SELECT TOP 10 *, " . utf8_decode( 'Año' ) . " AS Anio, " . utf8_decode('[Tipo habitación uso]') . " AS [Tipo habitacion uso], " . utf8_decode('[Tipo habitación factura]') . " AS [Tipo habitacion factura], " . utf8_decode( '[Nº Tarjeta Fidelización]' ) . " AS [N Tarjeta Fidelizacion], " . utf8_decode('[Tipo facturación estancia]') . " AS [Tipo facturacion estancia], " . utf8_decode( '[Cód_ Subtrato]' ) . " AS Cod_Subtrato, CONVERT(VARCHAR(10), [Fecha venta], 103) AS fecha_venta, CONVERT(VARCHAR(10), [Fecha entrada], 103) AS fecha_entrada, CONVERT(VARCHAR(10), [Fecha salida], 103) AS fecha_salida, CONVERT(VARCHAR(10), [Fecha borrado], 103) AS fecha_borrado, CONVERT(VARCHAR(8), [Hora llegada], 108) AS hora_llegada FROM [" . $table_name . "]";
		//mssql_query("SET NAMES utf8");
		$result = mssql_query($sql);

		while ($row = mssql_fetch_array($result)) {
			//echo "hola\n";
			
			echo "Datos de la reserva:" . $row['Hotel'] . " " . $row['Anio'] . " " . $row['Reserva'] . " "  . $row['Desglose'] . "<br>";
			//var_dump( $row );
			if(!exists_reservation($row['Hotel'], $row['Anio'], $row['Reserva'], $row['Desglose'])){
				echo "No existe<br>";
				$table_name_ocupantes = $prefix . "Ocupantes";
				$sql_data = "SELECT TOP 1 [Apellido 1], Nacionalidad FROM [" . $table_name_ocupantes . "] WHERE Hotel = '" . $row['Hotel'] . "' AND " .utf8_decode( 'Año' ) . " = " . $row['Anio'] . " AND Reserva = " . $row['Reserva'] . "";
				$result_data = mssql_query($sql_data);

				echo "<strong>Antes del while rows: SELECT TOP 1 [Apellido 1], Nacionalidad FROM [" . $table_name_ocupantes . "] WHERE Hotel = '" . $row['Hotel'] . "' AND " .utf8_decode( 'Año' ) . " = " . $row['Anio'] . " AND Reserva = " . $row['Reserva'] . "</strong><br>";

				$apellido = "";
				$nacionalidad = "";

				while($row_data = mssql_fetch_array($result_data)){
					$apellido = $row_data['[Apellido 1]'];
					$nacionalidad = $row_data['Nacionalidad'];
					echo "$apellido - $nacionalidad<br>";
				}

				echo "<strong>Después del while rows</strong><br>";
				$adb = PearDatabase::getInstance();

				$reservation = Vtiger_Record_Model::getCleanInstance("Reservations");
				echo "Asigné una instancia de reservas<br>";
				$reservation->set('hotel', $row['Hotel']);
				$reservation->set('anio', $row['Anio']);
				$reservation->set('reserva', $row['Reserva']);			
				$reservation->set('desglose', $row['Desglose']);
				$reservation->set('fecha_venta', date_to_english_format($row['fecha_venta']));
				$reservation->set('agencia', $row['Agencia']);
				$reservation->set('fecha_entrada', date_to_english_format($row['fecha_entrada']));
				$reservation->set('fecha_salida', date_to_english_format($row['fecha_salida']));
				$reservation->set('noches', $row['Noches']);
				$reservation->set('trato', $trato[$row['Trato']]);
				$reservation->set('habuso', $row['Tipo habitacion uso']);
				$reservation->set('habfac', $row['Tipo habitacion factura']);
				$reservation->set('club_fidelizacion', $row['N Tarjeta Fidelizacion']);
				echo "<strong>Antes del get membresia</strong><br>";
				if(get_membresia($row['N Tarjeta Fidelizacion']) != null) 
					$reservation->set('membresia', get_membresia($row['N Tarjeta Fidelizacion'])); 
				echo "<strong>Después del get membresia</strong><br>";
				//$reservation->set('promcod', '1234'); //No encontrado
				//$reservation->set('imerial_week', '1234'); //No encontrado
				$reservation->set('tipofacturacion', $tipo_facturacion[$row['Tipo facturacion estancia']]);
				$reservation->set('ttoo', $row['TTOO']);
				$reservation->set('cliente', $row['Cliente']);
				$reservation->set('estado', $estado[$row['Estado reserva']]);
				$reservation->set('tarifa', $row['Tarifa']);
				$reservation->set('subtrato', $row['Cod_Subtrato']); //No encontrado
				$reservation->set('coddingus', $row['Id_ CRX']); //No encontrado
				$reservation->set('salimpre', $row['Salida imprevista']); //No encontrado
				$reservation->set('cantadultos',  $row['AD']);
				$reservation->set('cantadol',  $row['JR']);
				$reservation->set('cantninos',  $row['NI']);
				$reservation->set('cantcunas',  $row['CU']);
				$reservation->set('horllegada', $row['hora_llegada']);
				$reservation->set('bono', $row['Bono']);
				$reservation->set('nacionalidad', $nacionalidad);
				$reservation->set('apellido_primer_ocupante', $apellido);
				//$reservation->set('hora_venta', $row['hora_venta']);
				$reservation->set('fecha_borrado', date_to_english_format($row['fecha_borrado']));
				//$reservation->set('nacionalidad', $row['Bono']);
				//[Nº Tarjeta Fidelización]
				$reservation->set('assigned_user_id', 1);
				$reservation->set('mode', '');
				$reservation->save();
				echo "Se creó la reserva<br>";
				$table_name_ocupantes = $prefix . "Ocupantes";
				$sql_ocupantes = "SELECT *, " . utf8_decode( 'Año' ) . " AS Anio, " . utf8_decode( '[País residencia]' ) . " AS [Pais residencia], " . utf8_decode( '[Tel_ Móvil]' ) . " AS [Tel_Movil], CONVERT(VARCHAR(10), [Fecha nacimiento], 103) AS fecha_nacimiento FROM [" . $table_name_ocupantes . "] WHERE Hotel = '" . $row['Hotel'] . "' AND " . utf8_decode( 'Año' ) . " = " . $row['Anio'] . " AND Reserva = " . $row['Reserva'];
				$result_ocupantes = mssql_query($sql_ocupantes);
				echo "--->Consulta de ocupantes: $sql_ocupantes<br>";
				echo "---->Cantidad de ocupantes: " . mssql_num_rows( $result_ocupantes ) . "<br>";
				while ($row2 = mssql_fetch_array($result_ocupantes)) {
					echo "---->En el fetch row<br>";
					if(!exists_contact($row2['Nombre'], $row2['Apellido 1'], date_to_english_format($row2['fecha_nacimiento']), $row2['Pais residencia'])){ // fecha de nacimiento
						echo "------>Hay ocupante!<br>";
						$contact = Vtiger_Record_Model::getCleanInstance("Contacts");
						$contact->set('firstname', $row2['Nombre']);
						$contact->set('lastname', $row2['Apellido 1']);
						$contact->set('secondlastname', $row2['Apellido 2']);
						$contact->set('email', $row2['E-mail']);
						$contact->set('mobile', $row2['Tel_Movil']);
						$contact->set('idioma', $row2['Idioma']);						
						$contact->set('fax', $row2['Fax']);				
						$contact->set('tipodoc', $row2['Documento']);		
						$contact->set('documento', $row2['Documento']);
						$contact->set('birthday', date_to_english_format($row2['fecha_nacimiento']));
						$contact->set('nacionalidad', $row2['Nacionalidad']);
						$contact->set('mailingcountry', $row2['Pais residencia']);
						$contact->set('assigned_user_id', 1);
						$contact->set('mode', '');
						$contact->save();
						echo "<b>Ocupante agregado</b><br>";
					}

					$sql = "INSERT INTO vtiger_crmentityrel VALUES (?, ?, ?, ?)";
					$adb->pquery($sql, array(get_reservationsid($row['Hotel'], $row['Anio'], $row['Reserva'], $row['Desglose']), 'Reservations', get_contactid($row2['Nombre'], $row2['Apellido 1'], $row2['Pais residencia']), 'Contacts'));
				}

				$table_name_comentarios = $prefix . utf8_decode( 'Lín_ comentario Reserva' );
				$sql_comentarios = "SELECT * FROM [" . $table_name_comentarios . "] WHERE Hotel = '" . $row['Hotel'] . "' AND " . utf8_decode( 'Año' ) . " = " . $row['Anio'] . " AND Reserva = " . $row['Reserva'];
				$result_comentarios = mssql_query($sql_comentarios);
				while ($row_comentarios = mssql_fetch_array($result_comentarios)) {
					echo "<b>Agregando comentario...</b><br>";
					$comentario = Vtiger_Record_Model::getCleanInstance("ModComments");
					$comentario->set('related_to', get_reservationsid($row['Hotel'], $row['Anio'], $row['Reserva'], $row['Desglose']));
					$comentario->set('commentcontent', $row_comentarios['Comentario']);
					$comentario->set('mode', '');
					$comentario->set('assigned_user_id', 1);
					$comentario->save();
				}
			}		
		}
	}
}

function date_to_english_format($date){
	$dateExplode = explode("/", $date);
	$newDate = $dateExplode[2] . "-" . $dateExplode[1] . "-" . $dateExplode[0];
	return $newDate;
}

function exists_contact($firstname, $lastname, $birthday, $mailingcountry){
	global $adb;
	$sql = "SELECT contactid FROM vtiger_contactdetails cd INNER JOIN vtiger_contactaddress ca ON cd.contactid = ca.contactaddressid INNER JOIN vtiger_contactsubdetails csd ON cd.contactid = csd.contactsubscriptionid INNER JOIN vtiger_crmentity crm ON cd.contactid = crm.crmid WHERE deleted = 0 AND cd.firstname = ? AND cd.lastname = ? AND csd.birthday = ? AND ca.mailingcountry = ? ";
	echo "<b>Consulta SQL: $sql</b><br>";
	echo "($firstname, $lastname, $birthday, $mailingcountry)<br>";
	$result =  $adb->pquery($sql, array($firstname, $lastname, $birthday, $mailingcountry));

	

	if($adb->num_rows($result) > 0)
		return true;
	else
		return false;
}

function get_contactid($firstname, $lastname, $mailingcountry){
	global $adb;
	
	$sql = "SELECT contactid FROM vtiger_contactdetails cd INNER JOIN vtiger_contactaddress ca ON cd.contactid = ca.contactaddressid INNER JOIN vtiger_crmentity crm ON cd.contactid = crm.crmid WHERE deleted = 0 AND cd.firstname = ? AND cd.lastname = ? AND ca.mailingcountry = ? ";
	echo "<strong>GET CONTACT ID: $sql</strong><br>";
	echo "($firstname, $lastname, $mailingcountry)<br>";
	$result =  $adb->pquery($sql, array($firstname, $lastname, $mailingcountry));
	$contacid = $adb->query_result($result, 0, 'contactid');
	return $contactid;
}


function exists_reservation($hotel, $anio, $reserva, $desglose){
	global $adb;
	echo "<strong>En la función para verificar existencia de reserva</strong>";
	$sql = "SELECT reservationsid  FROM vtiger_reservations INNER JOIN vtiger_crmentity ON reservationsid = crmid WHERE hotel = ?  AND anio = ? AND reserva = ? AND desglose = ? AND deleted = 0";
	$result = $adb->pquery($sql, array($hotel, $anio, $reserva, $desglose));
	if($adb->num_rows($result) > 0){
		echo "<br>Devuelvo existe<br>";
		return true;
	}
	else{
		echo "<br>Devuelvo no existe<br>";
		return false;
	}
	//return true
}

function get_reservationsid($hotel, $anio, $reserva, $desglose){
	global $adb;
	echo "<strong>GET RESERVATION ID</strong><br>";
	$sql = "SELECT reservationsid  FROM vtiger_reservations INNER JOIN vtiger_crmentity ON reservationsid = crmid WHERE hotel = ?  AND anio = ? AND reserva = ? AND desglose = ? AND deleted = 0";
	$result = $adb->pquery($sql, array($hotel, $anio, $reserva, $desglose));
	$reservationsid = $adb->query_result($result, 0, 'reservationsid');
	return $reservationsid;
}

function get_membresia($pin){
	global $adb;
	$sql = "SELECT accountid FROM vtiger_account WHERE account_no = ?";
	$result = $adb->pquery($sql, array($pin));
	if($adb->num_rows($result) < 1)
		return null;
	else
		return $adb->query_result($result, 0, 'accountid');
}

function add_comment(){

}

?>