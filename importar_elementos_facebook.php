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
$fb->setDefaultAccessToken(FB_APP_ID."|".FB_APP_SECRET); //Si no existe setteo como las claves https://developers.facebook.com/docs/facebook-login/access-tokens/#apptokens

try {
  // Get the \Facebook\GraphNodes\GraphUser object for the current user.
  // If you provided a 'default_access_token', the '{access-token}' is optional.
  $response = $fb->get('/'.FB_PAGE_ID); // Obtengo quien es la entidad sobre la cual se realizaran las acciones
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

writeLog("Inicio de getLikes");
$limit = LIMIT_PER_PAGE;
$after = "";
$count = TOTAL_FEED;
$pages = round($count / $limit);

for($i = 0; $i < $pages; $i++){
    $after = getFeed($fb,FB_PAGE_ID,'likes',$limit,$after);
}
$after = "";
for($i = 0; $i < $pages; $i++){
    $after = getFeed($fb,FB_PAGE_ID,'comments',$limit,$after);
}

$after = "";
for($i = 0; $i < $pages; $i++){
    $after = getFeed($fb,FB_PAGE_ID,'posts',$limit,$after);
}

$fin  = microtime(4);
writeLog("Fin de ejecuccion");
writeLog("Tiempo total: ".round($fin - $inicio)." seg");


function getFeed($fb /* Pasamos objeto de tipo facebook */, $page_id, $type , $limit,$after = ""){
  try {
        writeLog("Iniciando la funcion getLikes...");
        $agregados       = 0; //Contador de agregados
        $data            = array(); 
        $entity          = 'feed';  
        $limit_per_page  = ".limit(".$limit.")";
        $after_page      = $after? ".after(".$after.")" : "";
        $query           = 'fields='.$entity.''.$limit_per_page.''.$after_page; 
        
        switch ($type) {
          case 'likes':
                  $query .= '{id,message,created_time,from,link,picture,likes{id,name}}';   
            break;
          case 'comments' : 
                  $query .= '{id,message,created_time,from,link,picture,comments{id,created_time,from,message}}'; 
            break;
          case 'posts' : 
                  $query .= '{id,message,created_time,from,link,picture}';
            break;
        }

        $db              = PearDatabase::getInstance();
        $tiempo_inicio   = microtime(4);
        //$query         = 'fields=feed';
      
        writeLog('Request: /'.$page_id.'?'.$query);

        $get_inicio = microtime(4);
        $response   = $fb->get('/'.$page_id.'?'.$query);
        $get_fin    = microtime(4);
        // Page 1        
        $graphNode = $response->getGraphNode();

        $feedNode  = $graphNode[$entity];     //Obtengo el feedNode

        foreach ($feedNode as $node) {
            switch ($type) {
              case 'likes':
                    $agregados += processForLikes($db,$node->asArray());
                break;
              case 'comments':
                    $agregados += processForComments($db,$node->asArray());
                break;
              case 'posts':
                    $agregados += processForPosts($db,$node->asArray());
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
        writeLog("Saliendo de la funcion getLikes...");
        return $feedNode->getNextCursor(); //Retorno el puntero hacia la proxima query

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
function processForLikes($db,$nodo /* Array */){
    $agregados      = 0;
    $entity_id      = ""; //Vtiger
    $user_id        = "";
    $related_to     = "";
    $action_type    = "Like";
    $created_time   = isset($nodo["created_time"]) ? $nodo["created_time"]->format('Y-m-d') : "";
    $object_id      = isset($nodo['id']) ? $nodo['id'] : "";
    $link           = isset($nodo['link']) ? $nodo['link'] : "";
    $thumb          = isset($nodo['picture']) ? $nodo['picture'] : "";
    $description    = isset($nodo['message']) ? $nodo['message'] : "";   
    $creator        = ( isset($nodo['from']) ? $nodo['from']['id'] : "");
    $likes          = isset($nodo['likes'])? $nodo['likes'] : [];

    writeLog("Nuevo nodo: ".$object_id);
    
    foreach ($likes as $like) {
        $user_id    = $like['id'];
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
            $recordModel->set('fbverified',  $verified);
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
function processForComments($db, $nodo /* Array */){
    $agregados      = 0;
    $entity_id      = ""; //Vtiger
    $user_id        = "";
    $related_to     = "";
    $action_type    = "Comentario";
    $created_time   = isset($nodo["created_time"]) ? $nodo["created_time"]->format('Y-m-d') : "";
    $object_id      = isset($nodo['id']) ? $nodo['id'] : "";
    $link           = isset($nodo['link']) ? $nodo['link'] : "";
    $thumb          = isset($nodo['picture']) ? $nodo['picture'] : "";
    $description    = isset($nodo['message']) ? $nodo['message'] : "";   
    $creator        = ( isset($nodo['from']) ? $nodo['from']['id'] : "");
    $likes          = isset($nodo['comments'])? $nodo['comments'] : [];

    writeLog("Nuevo nodo: ".$object_id);
    
    foreach ($likes as $like) {
        //$object_id    = $like['id'];
        $user_id      = isset($like['from'])? $like['from']['id'] : '';
        $created_time = isset($like['created_time'])? $like['created_time']->format('Y-m-d') : "";
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
            $recordModel->set('fbverified',  $verified);
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
function processForPosts($db, $nodo /* Array */){
    $agregados      = 0;
    $entity_id      = ""; //Vtiger
    $related_to     = "";
    $action_type    = "Post";
    $created_time   = isset($nodo["created_time"]) ? $nodo["created_time"]->format('Y-m-d') : "";
    $object_id      = isset($nodo['id']) ? $nodo['id'] : "";
    $link           = isset($nodo['link']) ? $nodo['link'] : "";
    $thumb          = isset($nodo['picture']) ? $nodo['picture'] : "";
    $description    = isset($nodo['message']) ? $nodo['message'] : "";   
    $user_id        = ( isset($nodo['from']) ? $nodo['from']['id'] : "");
    
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
        $recordModel->set('fbverified',  $verified);
        $recordModel->set('assigned_user_id', 1);
        $recordModel->set('mode', 'create');
        $recordModel->save();
        $agregados++;       
      }
    }
    return $agregados;
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