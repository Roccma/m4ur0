<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class Campaigns_exportarExcelPHP_Action extends Vtiger_Action_Controller {

	function checkPermission(Vtiger_Request $request) {
	}

	public function process(Vtiger_Request $request) {
		global $log,$adb;

		$log->debug("entre al process de Campaigns_exportarExcelPHP_Action");
		
		$json_data = array(); 
		

		$id=$request->get('id');
		$relacionado = $request->get('relacionado');

		$cabeceras= substr($request->get('fields'), 0, -1);

		$campos= substr($request->get('campos'), 0, -1);

		$log->debug("soy el id de la campania $id");
		$log->debug("soy el relacionado $relacionado");
		$log->debug("soy las cabeceras");
		$log->debug($cabeceras);

		$log->debug("soy los campos");
		$log->debug($campos);

		//si tiene accountid lo cambiamos por accountname
		$cabeceras = str_replace("accountid","accountname", $cabeceras);
		$cabeceras = str_replace("createdtime","vtiger_crmentity.createdtime", $cabeceras);
		$cabeceras = str_replace("modifiedtime","vtiger_crmentity.modifiedtime", $cabeceras);
		$cabeceras = str_replace("description","vtiger_crmentity.description", $cabeceras);

		$log->debug("soy las cabeceras");
		$log->debug($cabeceras);



		$cabeceras_array=array();
		$select =  explode(",",$cabeceras);
		$select_array = array_merge($cabeceras_array, $select);

		$select='';
		$cont=0;
		for ($i=0; $i < count($select_array); $i++) { 
			$select=$select.$select_array[$i]." AS campo".$i.", ";
			$cont++;
		}
		//$select= substr($select, 0, -2);

		$select= $select." IFNULL(campaignrelstatus, '') AS campo".$cont." ";
		$select = str_replace("smownerid","CONCAT (IFNULL(user_name,''),' ',IFNULL(groupname,'') ) ", $select);

		$select = str_replace("vtiger_crmentity.modifiedtime"," DATE_ADD(vtiger_crmentity.modifiedtime, INTERVAL -3 HOUR) ", $select);

		$select = str_replace("vtiger_crmentity.createdtime"," DATE_ADD(vtiger_crmentity.createdtime, INTERVAL -3 HOUR) ", $select);


		$log->debug("soy select");
		$log->debug($select);

		
		

		if ($relacionado=='Contacts') {
			$consulta ="
			SELECT $select
			FROM vtiger_contactdetails 
			INNER JOIN vtiger_campaigncontrel ON vtiger_campaigncontrel.contactid = vtiger_contactdetails.contactid 
			INNER JOIN vtiger_contactaddress ON vtiger_contactdetails.contactid = vtiger_contactaddress.contactaddressid 
			INNER JOIN vtiger_contactsubdetails ON vtiger_contactdetails.contactid = vtiger_contactsubdetails.contactsubscriptionid 
			INNER JOIN vtiger_customerdetails ON vtiger_contactdetails.contactid = vtiger_customerdetails.customerid 
			INNER JOIN vtiger_crmentity ON vtiger_crmentity.crmid = vtiger_contactdetails.contactid 
			LEFT JOIN vtiger_contactscf ON vtiger_contactdetails.contactid = vtiger_contactscf.contactid 
			LEFT JOIN vtiger_groups ON vtiger_groups.groupid=vtiger_crmentity.smownerid 
			LEFT JOIN vtiger_users ON vtiger_crmentity.smownerid=vtiger_users.id 
			LEFT JOIN vtiger_account ON vtiger_account.accountid = vtiger_contactdetails.accountid 
			LEFT JOIN vtiger_campaignrelstatus ON vtiger_campaignrelstatus.campaignrelstatusid = vtiger_campaigncontrel.campaignrelstatusid  
			WHERE vtiger_crmentity.deleted=? AND vtiger_campaigncontrel.campaignid = ? ";
		}

		if ($relacionado=='Accounts') {
			$consulta="	SELECT 	$select
						FROM vtiger_account 
						INNER JOIN vtiger_campaignaccountrel ON vtiger_campaignaccountrel.accountid = vtiger_account.accountid 
						INNER JOIN vtiger_crmentity ON vtiger_crmentity.crmid = vtiger_account.accountid 
						INNER JOIN vtiger_accountshipads ON vtiger_accountshipads.accountaddressid = vtiger_account.accountid 
						LEFT JOIN vtiger_groups ON vtiger_groups.groupid=vtiger_crmentity.smownerid 
						LEFT JOIN vtiger_users ON vtiger_crmentity.smownerid=vtiger_users.id 
						LEFT JOIN vtiger_accountbillads ON vtiger_accountbillads.accountaddressid = vtiger_account.accountid 
						LEFT JOIN vtiger_accountscf ON vtiger_account.accountid = vtiger_accountscf.accountid 
						LEFT JOIN vtiger_campaignrelstatus ON vtiger_campaignrelstatus.campaignrelstatusid = vtiger_campaignaccountrel.campaignrelstatusid  
						WHERE vtiger_crmentity.deleted=? AND vtiger_campaignaccountrel.campaignid = ?";
		}

		$result=$adb->pquery($consulta,array(0,$id));
		while ($fila = $adb->fetch_array($result)) {

			$registros[] =$fila;
		
		}

		$this->exportarExcel($registros,$relacionado,$campos);
	}

	

	public function exportarExcel($registros,$relacionado,$campos){
            global $log;
            
            if ($relacionado=='Contacts') {
            	$nombreArchivo="Contactos de campania";
            }
            if ($relacionado=='Accounts') {
            	$nombreArchivo="Cuentas de campania";
            }

            $log->debug("entre al exportarExcel");

            if (PHP_SAPI == 'cli')
            die('Este archivo solo se puede ver desde un navegador web');
        
            /** Se agrega la libreria PHPExcel */
            require_once 'libraries/PHPExcel/PHPExcel.php';

            // Se crea el objeto PHPExcel
            $objPHPExcel = new PHPExcel();
            //$log->debug($objPHPExcel);
            // Se asignan las propiedades del libro
            $objPHPExcel->getProperties()->setCreator("Luderepro") //Autor
                                 ->setLastModifiedBy("Luderepro") //Ultimo usuario que lo modificó
                                 ->setTitle($nombreArchivo)
                                 ->setSubject($nombreArchivo)
                                 ->setDescription($nombreArchivo)
                                 ->setKeywords($nombreArchivo)
                                 ->setCategory($nombreArchivo);
            $titulo=$nombreArchivo;
            $tituloReporte = $titulo;

            $log->debug("soy el relacionado!!!!!!!!!!!!");
            $log->debug($relacionado);

            if ($relacionado=='Contacts') {
            	
            	//en campos me vino la variable desde el js con las columnas que esta mostrando el relatedList
            	//Ejemplo de contacto : Nombre, Apellido,......
            	//Al final agregamos Estado que no viene desde el js 
            	$cabeceras_array=array();
				$cabeceras =  explode(",",$campos);
				$titulosColumnas = array_merge($cabeceras_array, $cabeceras);
				array_push($titulosColumnas, "Estado");
				
            }
            if ($relacionado=='Accounts') {
            	//$titulosColumnas = array("Nombre fantasia","Pagina Web","Email","Estado");
            	$cabeceras_array=array();
				$cabeceras =  explode(",",$campos);
				$titulosColumnas = array_merge($cabeceras_array, $cabeceras);
				array_push($titulosColumnas, "Estado");

            }
            
            $log->debug("soy los titulosColumnas");
            $log->debug(json_encode($titulosColumnas));
            $objPHPExcel->setActiveSheetIndex(0)
                        ->mergeCells('A1:A1');
                            

            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1',$tituloReporte);
            
            
            //voy seteando las columnas
            $cont=0;
            for ($i=0; $i < count($titulosColumnas); $i++) { 
            	$cont++;
            	$objPHPExcel->setActiveSheetIndex(0)->setCellValue( $this->getLetra($cont)."2",$titulosColumnas[$i]);
            }
			/*
            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A1',$tituloReporte)
                        ->setCellValue('A2',  $titulosColumnas[0])
                        ->setCellValue('B2',  $titulosColumnas[1])
                        ->setCellValue('C2',  $titulosColumnas[2])
                        ->setCellValue('D2',  $titulosColumnas[3]);*/
            
            //Se agregan los datos
            $contador=3;
            
            //$log->debug("soy los registros");
           //$log->debug(json_encode($registros));

            for ($i=0; $i <count($registros) ; $i++) { 
				
				
				//$log->debug($registros[$i]);
				//$log->debug(count($registros[$i]));
				$cont = 0;
				for ($t=0; $t < count($registros[$i]); $t++) {


					$cont ++;
					$valor = html_entity_decode( $registros[$i]["campo".$t]);
					if (strlen($valor)>0) {

						$letra = $this->getLetra($cont);

						//$log->debug($registros[$i]["campo".$t]);
						//$log->debug("LETRA: $letra $contador");
						
						$columna = $letra.$contador;
						
						//$log->debug("soy largo de valor");
						//$log->debug(strlen($valor));

						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columna,$valor);
					
					}

					
					
				}
				//$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columnaD,$estado);

				/*
				$columnaA= 'A'.$contador;

				$log->debug("soy la columnaA $columnaA");

                $columnaB= 'B'.$contador;
                $columnaC= 'C'.$contador;
                $columnaD= 'D'.$contador;

                $campo1 = $registros[$i]['campo1'];
                $campo2 = $registros[$i]['campo2'];
                $campo3 = $registros[$i]['campo3'];
                $estado = $registros[$i]['estado'];


                $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue($columnaA,$campo1)
                        ->setCellValue($columnaB,$campo2)
                        ->setCellValue($columnaC,$campo3)
                        ->setCellValue($columnaD,$estado);*/
                
                $contador++;
			}
                        
            $estiloTituloReporte = array(
                'font' => array(
                    'name'      => 'Verdana',
                    'bold'      => true,
                    'italic'    => false,
                    'strike'    => false,
                    'size' =>16,
                        'color'     => array(
                            'rgb' => 'FFFFFF'
                        )
                ),
                'fill' => array(
                    'type'  => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('argb' => 'FF220835')
                ),
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_NONE                    
                    )
                ), 
                'alignment' =>  array(
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                        'rotation'   => 0,
                        'wrap'          => TRUE
                )
            );

            $estiloTituloColumnas = array(
                'font' => array(
                    'name'      => 'Arial',
                    'bold'      => true,                          
                    'color'     => array(
                        'rgb' => 'FFFFFF'
                    )
                ),
                'fill'  => array(
                    'type'      => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
                    'rotation'   => 90,
                    'startcolor' => array(
                        'rgb' => 'c47cf2'
                    ),
                    'endcolor'   => array(
                        'argb' => 'FF431a5d'
                    )
                ),
                'borders' => array(
                    'top'     => array(
                        'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
                        'color' => array(
                            'rgb' => '143860'
                        )
                    ),
                    'bottom'     => array(
                        'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
                        'color' => array(
                            'rgb' => '143860'
                        )
                    )
                ),
                'alignment' =>  array(
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                        'wrap'          => TRUE
                ));
                
            $estiloInformacion = new PHPExcel_Style();
            $estiloInformacion->applyFromArray(
                array(
                    'font' => array(
                    'name'      => 'Arial',               
                    'color'     => array(
                        'rgb' => '000000'
                    )
                ),
                'fill'  => array(
                    'type'      => PHPExcel_Style_Fill::FILL_SOLID,
                    'color'     => array('argb' => 'FFd9b7f4')
                ),
                'borders' => array(
                    'left'     => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN ,
                        'color' => array(
                            'rgb' => '3a2a47'
                        )
                    )             
                )
            ));
             
            
            
            // Se asigna el nombre a la hoja
            $objPHPExcel->getActiveSheet()->setTitle('Licencias');

            // Se activa la hoja para que sea la que se muestre cuando el archivo se abre
            $objPHPExcel->setActiveSheetIndex(0);
            // Inmovilizar paneles 
            //$objPHPExcel->getActiveSheet(0)->freezePane('A4');
            $objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,3);
            
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            

            $rootDirectory = vglobal('root_directory');

            $objWriter->save($rootDirectory."/storage/".$nombreArchivo.".xlsx");
            
            $log->debug("final");
            echo json_encode("OK");
            return;
    }


    public function getLetra($numero){
    	$letras = array("","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","AA","AB");
    	return $letras[$numero];
    }
}
?>