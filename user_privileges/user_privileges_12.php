<?php


//This is the access privilege file
$is_admin=false;

$current_user_roles='H7';

$current_user_parent_role_seq='H1::H2::H6::H7';

$current_user_profiles=array(3,);

$profileGlobalPermission=array('1'=>1,'2'=>1,);

$profileTabsPermission=array('1'=>0,'2'=>0,'3'=>0,'4'=>0,'6'=>0,'7'=>0,'8'=>0,'9'=>0,'10'=>0,'13'=>0,'14'=>1,'15'=>1,'16'=>0,'18'=>0,'19'=>0,'20'=>0,'21'=>0,'22'=>0,'23'=>0,'24'=>1,'25'=>0,'26'=>0,'27'=>1,'30'=>0,'31'=>0,'32'=>0,'33'=>0,'34'=>0,'35'=>0,'36'=>0,'37'=>0,'38'=>0,'39'=>0,'40'=>1,'41'=>0,'42'=>0,'43'=>0,'44'=>0,'45'=>0,'46'=>0,'47'=>1,'48'=>1,'49'=>1,'50'=>0,'51'=>1,'52'=>0,'53'=>1,'54'=>1,'55'=>1,'56'=>1,'57'=>0,'58'=>0,'59'=>0,'60'=>0,'28'=>0,);

$profileActionPermission=array(2=>array(0=>1,1=>1,2=>1,3=>0,4=>0,5=>1,6=>1,10=>0,),4=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>1,6=>1,8=>1,10=>0,),6=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>1,6=>1,8=>0,10=>0,),7=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>1,6=>1,8=>0,9=>0,10=>0,),8=>array(0=>0,1=>0,2=>0,3=>0,4=>0,6=>1,),9=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,),13=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>1,6=>1,8=>1,10=>0,),14=>array(0=>1,1=>1,2=>1,3=>0,4=>1,5=>1,6=>1,10=>0,),15=>array(0=>0,1=>0,2=>0,3=>0,4=>0,),16=>array(0=>0,1=>0,2=>0,3=>0,4=>0,),18=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>1,6=>1,10=>0,),19=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>1,6=>1,10=>0,),20=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,),21=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,),22=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,),23=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,),25=>array(0=>1,1=>1,2=>1,4=>1,6=>0,13=>0,),26=>array(0=>0,1=>0,2=>0,3=>0,4=>0,),34=>array(0=>0,1=>0,2=>0,3=>0,4=>0,11=>1,12=>1,),35=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,10=>0,),36=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,10=>0,),38=>array(0=>0,1=>0,2=>0,3=>0,4=>0,),42=>array(0=>0,1=>0,2=>0,3=>0,4=>0,),43=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,10=>0,),44=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,10=>0,),45=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,10=>0,),47=>array(0=>0,1=>0,2=>0,3=>0,4=>0,),50=>array(0=>0,1=>0,2=>0,3=>0,4=>0,),52=>array(0=>0,1=>0,2=>0,3=>0,4=>0,),53=>array(0=>0,1=>0,2=>0,3=>0,4=>0,),54=>array(0=>1,1=>1,2=>1,3=>0,4=>1,5=>0,6=>0,8=>1,),55=>array(0=>1,1=>1,2=>1,3=>0,4=>1,5=>0,6=>0,8=>1,),56=>array(0=>1,1=>1,2=>1,3=>0,4=>1,5=>0,6=>0,8=>1,),57=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,8=>1,),58=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,8=>1,),59=>array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0,8=>1,),60=>array(0=>0,1=>0,2=>0,3=>0,4=>0,),40=>array(5=>1,6=>1,10=>0,),);

$current_user_groups=array();

$subordinate_roles=array('H8',);

$parent_roles=array('H1','H2','H6',);

$subordinate_roles_users=array('H8'=>array(8,),);

$user_info=array('user_name'=>'jorge','is_admin'=>'off','user_password'=>'$1$jo000000$7l7XMII8Acj9ZAeHgoym91','confirm_password'=>'$1$jo000000$7l7XMII8Acj9ZAeHgoym91','first_name'=>'Jorge','last_name'=>'Escudero','roleid'=>'H7','email1'=>'jescudero@rutasdellitoral.com.uy','status'=>'Active','activity_view'=>'Today','lead_view'=>'Today','hour_format'=>'12','end_hour'=>'','start_hour'=>'00:00','title'=>'','phone_work'=>'','department'=>'','phone_mobile'=>'','reports_to_id'=>'','phone_other'=>'','email2'=>'','phone_fax'=>'','secondaryemail'=>'','phone_home'=>'','date_format'=>'dd-mm-yyyy','signature'=>'','description'=>'','address_street'=>'','address_city'=>'','address_state'=>'','address_postalcode'=>'','address_country'=>'','accesskey'=>'856eTM2vcmq7W6RN','time_zone'=>'America/Montevideo','currency_id'=>'1','currency_grouping_pattern'=>'123,456,789','currency_decimal_separator'=>'.','currency_grouping_separator'=>',','currency_symbol_placement'=>'$1.0','imagename'=>'','internal_mailer'=>'0','theme'=>'softed','language'=>'es_es','reminder_interval'=>'','phone_crm_extension'=>'','no_of_currency_decimals'=>'2','truncate_trailing_zeros'=>'0','dayoftheweek'=>'Monday','callduration'=>'5','othereventduration'=>'5','calendarsharedtype'=>'public','default_record_view'=>'Summary','leftpanelhide'=>'1','rowheight'=>'medium','defaulteventstatus'=>'Selecciona una Opci&oacute;n','defaultactivitytype'=>'Selecciona una Opci&oacute;n','hidecompletedevents'=>'0','is_owner'=>'0','currency_name'=>'USA, Dollars','currency_code'=>'USD','currency_symbol'=>'&#36;','conv_rate'=>'1.00000','record_id'=>'','record_module'=>'','id'=>'12');
?>