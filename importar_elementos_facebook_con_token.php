<?php


include_once('vtlib/Vtiger/Utils.php');
require_once('includes/Loader.php');
require_once 'includes/runtime/LanguageHandler.php';
require_once('include/database/PearDatabase.php');
//require_once __DIR__ . '/vendor/autoload.php'; // change path as needed
require_once('includes/facebook/graph-sdk/src/Facebook/autoload.php');

require_once('config.facebook.php');

// Get the list of Invoice for which Recurring is enabled.

global $adb, $log, $default_timezone;
global $site_URL, $application_unique_key;
global $default_language;
global $current_language;
global $default_theme;

$Vtiger_Utils_Log = true;
$VTIGER_BULK_SAVE_MODE = true;

vimport('includes.http.Request');
vimport('includes.runtime.Globals');
vimport('includes.runtime.BaseModel');
vimport('includes.runtime.Controller');

global $IMPORT;

//Inicializo la variable Facebook
$fb = new \Facebook\Facebook([
  'app_id' => FB_APP_ID,
  'app_secret' => FB_APP_SECRET,
  'default_graph_version' => 'v2.10',
  //'default_access_token' => $default_token, // optional
]);

// Use one of the helper classes to get a Facebook\Authentication\AccessToken entity.
//   $helper = $fb->getRedirectLoginHelper();
//   $helper = $fb->getJavaScriptHelper();
//   $helper = $fb->getCanvasHelper();
//   $helper = $fb->getPageTabHelper();
$accessToken = $fb->getDefaultAccessToken(); // Obtengo el token de acceso

$page_ids = array();

$adb = PearDatabase::getInstance();
$rs = $adb->pquery("SELECT fbpage_id,fbpaccess_token FROM vtiger_facebookpage WHERE fbpactive = 1 ");

if($adb->num_rows($rs)){
    while ($row = $adb->fetch_array($rs)) {
        $page_ids [] = array( 'id' => $row['fbpage_id'], 'token' => $row['fbpaccess_token']);
    }
}
// $page_ids = explode(" ",FB_PAGE_ID);
foreach ($page_ids as $page) {
  $fb->setDefaultAccessToken( $page['token'] ); //Si no existe setteo como las claves https://developers.facebook.com/docs/facebook-login/access-tokens/#apptokens
  try {
    // Get the \Facebook\GraphNodes\GraphUser object for the current user.
    // If you provided a 'default_access_token', the '{access-token}' is optional.
    $response = $fb->get('/me'); // Obtengo quien es la entidad sobre la cual se realizaran las acciones
  } catch(\Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    writeLog('Graph returned an error: ' . $e->getMessage());
    exit;
  } catch(\Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    writeLog('Facebook SDK returned an error: ' . $e->getMessage());
    exit;
  }

  $me = $response->getGraphUser();
  writeLog('Entidad de trabajo: ' . $me->getName());


  if (!$current_user) //Settea el usuario como admin para poder guardar las crmentity
  {
      $current_user = new Users();
      $current_user->id = 1;
      $current_user = $current_user->retrieve_entity_info($current_user->id, "Users");
  }

  $inicio = microtime(4);

  writeLog("Inicio de obtencion de datos");
  $limit = LIMIT_PER_PAGE;
  $after = "";
  $count = TOTAL_FEED;
  $pages = round($count / $limit);
  
  if ( $IMPORT['likes'] == true){  
    for($i = 0; $i < $pages; $i++){
        $after = getFeed($fb,$page['id'],'likes',$limit,$after);
        if ($after == false) $i = $pages;
    }
  }
  
  if ( $IMPORT['comments'] == true){  
    $after = "";
    for($i = 0; $i < $pages; $i++){
        $after = getFeed($fb,$page['id'],'comments',$limit,$after);
        if ($after == false) $i = $pages;
    }
  }

  if ( $IMPORT['posts'] == true){
    $after = "";
    for($i = 0; $i < $pages; $i++){
        $after = getFeed($fb,$page['id'],'posts',$limit,$after);
        if ($after == false) $i = $pages;
    }
  }

  if ( $IMPORT['messages'] == true){
    $after = "";
    for($i = 0; $i < $pages; $i++){
        $after = getFeed($fb,$page['id'],'messages',$limit,$after);
        if ($after == false) $i = $pages;
    }
  }

  $fin  = microtime(4);
  writeLog("Fin de ejecuccion");
  writeLog("Tiempo total: ".round($fin - $inicio)." seg");
}


function getFeed($fb /* Pasamos objeto de tipo facebook */, $page_id, $type , $limit,$after = ""){
  try {
        writeLog("Iniciando la funcion getLikes...");
        $hasData         = false; 
        $agregados       = 0; //Contador de agregados
        $data            = array(); 
        $entity          = $type == 'messages'? 'conversations' : 'feed';  
        $limit_per_page  = ".limit(".$limit.")";
        $after_page      = $after? ".after(".$after.")" : "";
        $query           = 'fields='.$entity.''.$limit_per_page.''.$after_page; 
        
        switch ($type) {
          case 'likes':
                  $query .= '{id,message,created_time,from,permalink_url,picture,likes{id,name}}';   
            break;
          case 'comments' : 
                  $query .= '{id,message,created_time,from,permalink_url,picture,comments{id,created_time,from,message}}'; 
            break;
          case 'posts' : 
                  $query .= '{id,message,created_time,from,permalink_url,picture}';
            break;
          case 'messages':
                  $query .= '{unread_count,updated_time,is_subscribed,link,can_reply,snippet,participants,messages{message,from,to,created_time}}';        
            break;
        }

        $db              = PearDatabase::getInstance();
        $tiempo_inicio   = microtime(4);
        //$query         = 'fields=feed';
      
        writeLog('Request: /me?'.$query);

        $get_inicio = microtime(4);
        $response   = $fb->get('/me?'.$query);
        $get_fin    = microtime(4);
        // Page 1        
        $graphNode = $response->getGraphNode();

        $feedNode  = $graphNode[$entity];     //Obtengo el feedNode
        $hasData = count($feedNode) > 0;
        
        foreach ($feedNode as $node) {
            switch ($type) {
              case 'likes':
                    $agregados += processForLikes($db,$node->asArray(),$page_id);
                break;
              case 'comments':
                    $agregados += processForComments($db,$node->asArray(),$page_id);
                break;
              case 'posts':
                    $agregados += processForPosts($db,$node->asArray(),$page_id);
                break;
              case 'messages':
                    $agregados += processForMessages($db,$node->asArray(),$page_id);
                break;                                                              
              default:
                # code...
                break;
            }
        }
        $tiempo_fin = microtime(4);
        writeLog("Tiempo total de ejecucion:     ".round($tiempo_fin - $tiempo_inicio,4)." seg");
        writeLog("Tiempo de ejecuccion GET: ".round($get_fin - $get_inicio,4)." seg");
        writeLog("Total Elementos Facebook agregadas:     $agregados");      
        writeLog("Saliendo de la funcion getFeed...");
        return $hasData? $feedNode->getNextCursor() : false; //Retorno el puntero hacia la proxima query

    } catch(\Facebook\Exceptions\FacebookResponseException $e) {
      writeLog('Graph returned an error: ' . $e->getMessage());
      return false;
    } catch(\Facebook\Exceptions\FacebookSDKException $e) {
      writeLog('Facebook SDK returned an error: ' . $e->getMessage());
      return false;
    }
    return false;    
}

echo "OK";

/*
* Funcion para procesar para likes
*/
function processForLikes($db,$nodo /* Array */,$page_id){
    writeLog("Inicio: ".__FUNCTION__);
    $agregados      = 0;
    $entity_id      = ""; //Vtiger
    $user_id        = "";
    $related_to     = "";
    $action_type    = "Like";
    $created_time   = isset($nodo["created_time"]) ? $nodo["created_time"]->format('Y-m-d') : "";
    $object_id      = isset($nodo['id']) ? $nodo['id'] : "";
    $link           = isset($nodo['permalink_url']) ? $nodo['permalink_url'] : "";
    $thumb          = isset($nodo['picture']) ? $nodo['picture'] : "";
    $description    = isset($nodo['message']) ? $nodo['message'] : "";   
    $creator        = ( isset($nodo['from']) ? $nodo['from']['id'] : "");
    $likes          = isset($nodo['likes'])? $nodo['likes'] : [];

    writeLog("Nuevo nodo: ".$object_id);
    
    foreach ($likes as $like) {
        $user_id    = $like['id'];
        $user_name  = $like['name'];
        //Aca deberia de hacer el insert
        /*
        $data[] = array(
                'fbuser_id'         => $user_id,
                'fbaction_type'     => $action_type,
                'fbcreated_time'    => $created_time,
                'fbobject_id'       => $object_id,
                'fblink'            => $link,
                'fbdescription'     => $description
            );
        */
        $query  = " SELECT 1 
                    FROM vtiger_facebook 
                    WHERE fbaction_type = '".$action_type."' AND fbuser_id = '".$user_id."' AND fbobject_id = '".$object_id."' ";
        $resultSet = $db->query($query);    

        if( $db->num_rows($resultSet) ){
          writeLog("Ya existe el elemento. User id: ". $user_id." Objecto: ".$action_type);
        }else{   

          writeLog("Buscando el contacto en la base");
          $resultContact = $db->query("SELECT contactid FROM ".TABLENAME." WHERE ".FIELDNAME. " = ".$user_id);
          $verified      = $db->num_rows($resultContact)? 'yes' : 'no';
          /*if($db->num_rows($resultContact)){
            $vt_user_id    = $db->query_result($resultContact,0,'contactid') == 2? 123 : 124 ;
            //$vt_user_id    = $db->num_rows($resultContact)? $db->query_result($resultContact,0,'contactid') : null;
          }else{
            $vt_user_id    = 123; 
          }*/
          $vt_user_id    = $db->num_rows($resultContact)? $db->query_result($resultContact,0,'contactid') : null;
          if(!!$vt_user_id || TESTING){ // $vt_user_id
            writeLog("Creando nuevo elemento facebook. User id: ". $user_id." Objecto: ".$action_type);                  
            $recordModel = Vtiger_Record_Model::getCleanInstance("Facebook");
            $recordModel->set('fbuser_id', $user_id);
            $recordModel->set('fbaction_type', $action_type);
            $recordModel->set('fbrelated_to', $vt_user_id);
            $recordModel->set('fbcreated_time', $created_time);
            $recordModel->set('fbobject_id', $object_id);
            $recordModel->set('fblink', $link);
            $recordModel->set('fbdescription', $description);
            $recordModel->set('fbpage_id', $page_id);
            $recordModel->set('fbverified',  $verified);
            $recordModel->set('fbuser_name',  $user_name);
            $recordModel->set('assigned_user_id', 1);
            $recordModel->set('mode', 'create');
            $recordModel->save();
            $agregados++;       
          }

        }
    }
    writeLog("Fin: ".__FUNCTION__);
    return $agregados;
}

/*
* Funcion para procesar para likes
*/
function processForComments($db, $nodo /* Array */,$page_id){
    $agregados      = 0;
    $entity_id      = ""; //Vtiger
    $user_id        = "";
    $related_to     = "";
    $action_type    = "Comentario";
    $created_time   = isset($nodo["created_time"]) ? $nodo["created_time"]->format('Y-m-d') : "";
    $object_id      = isset($nodo['id']) ? $nodo['id'] : "";
    $link           = isset($nodo['permalink_url']) ? $nodo['permalink_url'] : "";
    $thumb          = isset($nodo['picture']) ? $nodo['picture'] : "";
    $description    = isset($nodo['message']) ? $nodo['message'] : "";   
    $creator        = ( isset($nodo['from']) ? $nodo['from']['id'] : "");
    $likes          = isset($nodo['comments'])? $nodo['comments'] : [];

    writeLog("Nuevo nodo: ".$object_id);
    
    foreach ($likes as $like) {
        //$object_id    = $like['id'];
        $user_id      = isset($like['from'])? $like['from']['id'] : '';
        $user_name    = isset($like['from'])? $like['from']['name'] : '';
        $created_time = isset($like['created_time'])? $like['created_time']->format('Y-m-d H:i:s') : "";
        $description  = isset($like['message']) ? $like['message'] : "";   

        
        $query  = " SELECT 1 
                    FROM vtiger_facebook 
                    WHERE fbaction_type = '".$action_type."' AND fbuser_id = '".$user_id."' AND fbobject_id = '".$object_id."' ";
        $resultSet = $db->query($query);    

        if( $db->num_rows($resultSet) ){
          writeLog("Ya existe el elemento. User id: ". $user_id." Objecto: ".$action_type);
        }else{   

          writeLog("Buscando el contacto en la base");
          $resultContact = $db->query("SELECT contactid FROM ".TABLENAME." WHERE ".FIELDNAME. " = ".$user_id);
          $verified      = $db->num_rows($resultContact)? 'yes' : 'no';
          /*if($db->num_rows($resultContact)){
            $vt_user_id    = $db->query_result($resultContact,0,'contactid') == 2? 123 : 124 ;
            //$vt_user_id    = $db->num_rows($resultContact)? $db->query_result($resultContact,0,'contactid') : null;
          }else{
            $vt_user_id    = 123; 
          }*/
          $vt_user_id    = $db->num_rows($resultContact)? $db->query_result($resultContact,0,'contactid') : null;
          if(!!$vt_user_id || TESTING){ // $vt_user_id
            writeLog("Creando nuevo elemento facebook. User id: ". $user_id." Objecto: ".$action_type);                  
            $recordModel = Vtiger_Record_Model::getCleanInstance("Facebook");
            $recordModel->set('fbuser_id', $user_id);
            $recordModel->set('fbaction_type', $action_type);
            $recordModel->set('fbrelated_to', $vt_user_id);
            $recordModel->set('fbcreated_time', $created_time);
            $recordModel->set('fbobject_id', $object_id);
            $recordModel->set('fblink', $link);
            $recordModel->set('fbdescription', $description);
            $recordModel->set('fbpage_id', $page_id);
            $recordModel->set('fbverified',  $verified);
            $recordModel->set('fbuser_name',  $user_name);
            $recordModel->set('assigned_user_id', 1);
            $recordModel->set('mode', 'create');
            $recordModel->save();
            $agregados++;       
          }

        }
    }
    return $agregados;
}

/*
* Funcion para procesar para likes
*/
function processForPosts($db, $nodo /* Array */,$page_id){
    writeLog("Inicio de funcion ".__METHOD__);
    writeLog(json_encode($nodo));
    $agregados      = 0;
    $entity_id      = ""; //Vtiger
    $related_to     = "";
    $action_type    = "Post";
    $created_time   = isset($nodo["created_time"]) ? $nodo["created_time"]->format('Y-m-d') : "";
    $object_id      = isset($nodo['id']) ? $nodo['id'] : "";
    $link           = isset($nodo['permalink_url']) ? $nodo['permalink_url'] : "";
    $thumb          = isset($nodo['picture']) ? $nodo['picture'] : "";
    $description    = isset($nodo['message']) ? $nodo['message'] : "";   
    $user_id        = ( isset($nodo['from']) ? $nodo['from']['id'] : "");
    $user_name      = ( isset($nodo['from']) ? $nodo['from']['name'] : "");
    
    writeLog("Nuevo nodo: ".$object_id);
    
    $query  = " SELECT 1 
                FROM vtiger_facebook 
                WHERE fbaction_type = '".$action_type."' AND fbuser_id = '".$user_id."' AND fbobject_id = '".$object_id."' ";
    $resultSet = $db->query($query);    

    if( $db->num_rows($resultSet) || (!TESTING && $user_id == FB_PAGE_ID) ){
      writeLog("Ya existe el elemento. User id: ". $user_id." Objecto: ".$action_type);
    }else{   

      writeLog("Buscando el contacto en la base");
      $resultContact = $db->query("SELECT contactid FROM ".TABLENAME." WHERE ".FIELDNAME. " = ".$user_id);
      $verified      = $db->num_rows($resultContact)? 'yes' : 'no';
      /*if($db->num_rows($resultContact)){
        $vt_user_id    = $db->query_result($resultContact,0,'contactid') == 2? 123 : 124 ;
        //$vt_user_id    = $db->num_rows($resultContact)? $db->query_result($resultContact,0,'contactid') : null;
      }else{
        $vt_user_id    = 123; 
      }*/
      $vt_user_id    = $db->num_rows($resultContact)? $db->query_result($resultContact,0,'contactid') : null;
      if(!!$vt_user_id || TESTING){ // $vt_user_id
        writeLog("Creando nuevo elemento facebook. User id: ". $user_id." Objecto: ".$action_type);                  
        $recordModel = Vtiger_Record_Model::getCleanInstance("Facebook");
        $recordModel->set('fbuser_id', $user_id);
        $recordModel->set('fbaction_type', $action_type);
        $recordModel->set('fbrelated_to', $vt_user_id);
        $recordModel->set('fbcreated_time', $created_time);
        $recordModel->set('fbobject_id', $object_id);
        $recordModel->set('fblink', $link);
        $recordModel->set('fbdescription', $description);
        $recordModel->set('fbpage_id', $page_id);
        $recordModel->set('fbverified',  $verified);
        $recordModel->set('fbuser_name',  $user_name);
        $recordModel->set('assigned_user_id', 1);
        $recordModel->set('mode', 'create');
        $recordModel->save();
        $agregados++;       
      }
    }
    return $agregados;
}

function processForMessages($db, $nodo /* Array */,$page_id){

    /*{message_count,unread_count,updated_time,is_subscribed,link,can_reply,messages{message,from,to,created_time},snippet,thread_key,participants}*/

    $agregados      = 0;
    $entity_id      = ""; //Vtiger
    $user_id        = "";
    $related_to     = "";
    $action_type    = "Mensaje";
    $created_time   = "";
    $object_id      = "";
    $link           = isset($nodo['link']) ? $nodo['link'] : "";
    $thumb          = isset($nodo['picture']) ? $nodo['picture'] : "";
    $description    = "";   
    $messages       = isset($nodo['messages'])? $nodo['messages'] : [];
    $fbentityid     = isset($nodo['id'])? $nodo['id'] : "";

    writeLog("Nuevo nodo: ".$link." _ ".$fbentityid);
    $link = "https://facebook.com".$link; 

    //Agregado para incidencias
    $message_count  = isset($nodo['message_count'])? $nodo['message_count'] : 0;
    $unread_count   = isset($nodo['unread_count'])? $nodo['unread_count'] : 0; //Obtengo el conteo de mensajes sin leer

    foreach ($messages as $message) {
        writeLog(">>");

        //if ($message['from']['id'] == $page_id ) continue; //Si el emisor del mensaje es la pagina no se agrega

        $user_id      = isset($message['from']['id'])? $message['from']['id'] : "";
        $user_name    = isset($message['from']['name'])? $message['from']['name'] : "";
        $object_id    = isset($message['id'])? $message['id'] : "";
        $created_time = isset($message['created_time'])? $message['created_time']->format('Y-m-d') : "";
        $vtcreatedtime= isset($message['created_time'])? $message['created_time']->format('Y-m-d H:i:s') : "";
        $description  = isset($message['message'])? $message['message'] : ""; 
        $label        = substr($description, 0,10). ( count($description) > 10 ? "..." : "" );

        $query  = " SELECT facebookid 
                    FROM vtiger_facebook 
                    WHERE fbaction_type = '".$action_type."' AND fbuser_id = '".$user_id."' AND fbobject_id = '".$object_id."' ";
        $resultSet = $db->query($query);    

        if( $db->num_rows($resultSet) ){
          writeLog("Ya existe el elemento. User id: ". $user_id." Objecto: ".$action_type);
          if($unread_count == 0){
              //Pongo el HelpDesk como cerrad porque esto quiere decir que ya se leyo el mensaje
              $db->pquery("UPDATE vtiger_troubletickets SET status = 'Closed' WHERE related_facebook = ?",array($db->query_result($resultSet,0,'facebookid')) );
              /*$recordModel = Vtiger_Record_Model::getInstanceById($db->query_result($rs,0,'facebookid'));
              $recordModel->set('mode','edit');
              $recordModel->set('')*/
          }
        }else{   

            writeLog("Buscando el contacto en la base");
            $resultContact = $db->query("SELECT contactid FROM ".TABLENAME." WHERE ".FIELDNAME. " = ".$user_id);
            $verified      = $db->num_rows($resultContact)? 'yes' : 'no';

            /*if($db->num_rows($resultContact)){
            $vt_user_id    = $db->query_result($resultContact,0,'contactid') == 2? 123 : 124 ;
            //$vt_user_id    = $db->num_rows($resultContact)? $db->query_result($resultContact,0,'contactid') : null;
            }else{
            $vt_user_id    = 123; 
            }*/
            $vt_user_id    = $db->num_rows($resultContact)? $db->query_result($resultContact,0,'contactid') : null;
            if(!!$vt_user_id || TESTING){ // $vt_user_id
                writeLog("Creando nuevo elemento facebook. User id: ". $user_id." Objecto: ".$action_type);                  
                $recordModel = Vtiger_Record_Model::getCleanInstance("Facebook");
                $recordModel->set('fbuser_id', $user_id);
                $recordModel->set('fbaction_type', $action_type);
                $recordModel->set('fbrelated_to', $vt_user_id);
                $recordModel->set('fbcreated_time', $created_time);                
                $recordModel->set('fbobject_id', $object_id);
                $recordModel->set('fblink', $link);
                $recordModel->set('fbdescription', $description);
                $recordModel->set('fbpage_id', $page_id);
                $recordModel->set('fbverified',  $verified);
                $recordModel->set('fbuser_name',  $user_name);
                $recordModel->set('fbmessage_id',  $fbentityid);

                $recordModel->set('fbtimestamp', $vtcreatedtime);
                $recordModel->set('assigned_user_id', 1);
                $recordModel->set('mode', 'create');
                $recordModel->save();


                //$db->pquery('UPDATE vtiger_crmentity SET label=? WHERE crmid=?', array($label, $recordModel->getId()));

                $agregados++;       
            }

        }

        if($unread_count > 0  || true){
          $related_facebook  = !!$recordModel? $recordModel->getId() : $db->query_result($resultSet,0,'facebookid');

          $resultSetHelpDesk = $db->pquery('SELECT 1 FROM vtiger_troubletickets WHERE related_facebook IN ( SELECT facebookid FROM vtiger_facebook WHERE fblink = ? )',array($link));

          if( $db->num_rows($resultSetHelpDesk) == 0 ){
            //Query para ver que ya no tengo agregada dicha incidencia
            //Si no esta creada la creo
            writeLog("Creando nueva incidencia por mensaje");
            //Puede ser que aca se creen las incidencias
            $recordModelIncidencia = Vtiger_Record_Model::getCleanInstance('HelpDesk');
            $recordModelIncidencia->set('ticket_title',"Nuevo mensaje de: ".$user_name);
            if( $vt_user_id ) $recordModelIncidencia->set('contact_id',$vt_user_id);
            $recordModelIncidencia->set('ticketstatus',"Open");

            $recordModelIncidencia->set('ticketpriorities',"Normal");
            $recordModelIncidencia->set('related_facebook',$related_facebook);
            $recordModelIncidencia->set('ticketcategories',"Other Problem");
            $recordModelIncidencia->set('description',$description);
            // $recordModelIncidencia->set('description',$description); //Aca va el id de la entidad de face
            $recordModelIncidencia->save();

            //Hago el update a mano de el ticket numbner
            $db->pquery("UPDATE vtiger_troubletickets SET ticket_no = ? WHERE ticketid = ? ",array(getNewId($db,'HelpDesk'),$recordModelIncidencia->getId()));
            
          }else{
            writeLog("Ya existe la incidencia para este evento");
          }
          $unread_count--;
        }
    }
    return $agregados;
}

/*
    bloque para obtener nuevo id
*/
function getNewId($db,$modulename /* String */){
  
  $rs = $db->pquery("select cur_id,prefix from vtiger_modentity_num where semodule=? and active = 1",array($modulename));  
  if( $db->num_rows($rs) ){ //Si obtengo resultado
    $prefix = $db->query_result($rs,0,'prefix');
    $cur_id = $db->query_result($rs,0,'cur_id'); 
    
    $db->pquery("UPDATE vtiger_modentity_num SET cur_id=? where cur_id=? and active=1 AND semodule=?",array($cur_id+1,$cur_id,$modulename)); //Actualizo el indice en la base

    return $prefix.$cur_id; //Retorno el id
  }
  return '';
}
/*
* Funcion que retorna el token de acceso a partir de un id de pagina
*/
function getAccessToken($page_id){
  $tokens = array(
      '103533693085499'  => 'EAACVgnsiOZCUBAJJfa0x0Vn4sFqlVZAcatywdRCuBdAZBKr3VZCMgyUuFb9QDwv4KOWUIvvHz9RACTVLP2qKec2tJAzeJx3kaAuhTIDnx43Yir1fWZCd98czFJg7owlxV3333JdHEwVdtQ3jesgr7BGpkOmkGYoGxkkyzrPp89JhwJHon0Keapp0qvrTZCBCMVGCanEGhn4QZDZD');
  return isset($tokens[$page_id])? $tokens[$page_id] : FB_APP_ID."|".FB_APP_SECRE;
}


/*
* Funcion insertar nuevo elemento
*/
function insertElement($data /* MapArray */){

}

/*
* Funcion para escribir salida segun el tipo de recurso que se utilize para ejecutar el script
*/
function writeLog($cadena){
    echo $cadena.($_SERVER["REMOTE_ADDR"]? '<br>' : PHP_EOL);
}

?>