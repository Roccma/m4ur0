<?php

/* +***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 * *********************************************************************************** */

class Vtiger_ExportData_Action extends Vtiger_Mass_Action {

    function checkPermission(Vtiger_Request $request) {
        $moduleName = $request->getModule();
        $moduleModel = Vtiger_Module_Model::getInstance($moduleName);

        $currentUserPriviligesModel = Users_Privileges_Model::getCurrentUserPrivilegesModel();
        if (!$currentUserPriviligesModel->hasModuleActionPermission($moduleModel->getId(), 'Export')) {
            throw new AppException('LBL_PERMISSION_DENIED');
        }
    }

    /**
     * Function is called by the controller
     * @param Vtiger_Request $request
     */
    function process(Vtiger_Request $request) {
        $this->ExportData($request);
    }

    private $moduleInstance;
    private $focus;

    /**
     * Function exports the data based on the mode
     * @param Vtiger_Request $request
     */
    function ExportData(Vtiger_Request $request) {
        $db = PearDatabase::getInstance();
        $moduleName = $request->get('source_module');
        $cvId = $request->get('viewname');
        $pageNumber = $request->get('page');

        $searchParams = $request->get('search_params');
        if (empty($pageNumber)) {
            $pageNumber = '1';
        }

        $pagingModel = new Vtiger_Paging_Model();
        $pagingModel->set('page', $pageNumber);
        
        $this->moduleInstance = Vtiger_Module_Model::getInstance($moduleName);
        $this->moduleFieldInstances = $this->moduleInstance->getFields();
        $this->focus = CRMEntity::getInstance($moduleName);

        $query = $this->getExportQuery($request);
        $result = $db->pquery($query, array());


        $mode = $request->getMode();
        global $log;

        switch ($mode) {
            case 'ExportFilter' :
                $listViewModel = Vtiger_ListView_Model::getInstance($moduleName, $cvId);

                $columnas = $listViewModel->getListViewHeaders();

                $datos = $listViewModel->getListViewEntriesFilter($pagingModel,$searchParams);

                $headers = array();
                foreach ($columnas as $value) {
                    $headers[] = vtranslate($value->get('label'), $moduleName);
                }


                $translatedHeaders = array();
                foreach ($headers as $header)
                    $translatedHeaders[] = vtranslate(html_entity_decode($header, ENT_QUOTES), $moduleName);


                $entries = array();

                foreach ($datos as $valueDatos) {
                    $fila = array();
                    foreach ($columnas as $valueColumna) {
                        $headerName = $valueColumna->get('name');
                        $fila[] = $valueDatos->get($headerName);
                    }
                    $entries[] = $fila;
                }
                break;

            default :
                $headers = array();
                //Query generator set this when generating the query
                if (!empty($this->accessibleFields)) {
                    $accessiblePresenceValue = array(0, 2);
                    foreach ($this->accessibleFields as $fieldName) {
                        $fieldModel = $this->moduleFieldInstances[$fieldName];
                        // Check added as querygenerator is not checking this for admin users
                        $presence = $fieldModel->get('presence');
                        if (in_array($presence, $accessiblePresenceValue)) {
                            $headers[] = $fieldModel->get('label');
                        }
                    }
                } else {
                    foreach ($this->moduleFieldInstances as $field)
                        $headers[] = $field->get('label');
                }
                $translatedHeaders = array();
                foreach ($headers as $header)
                    $translatedHeaders[] = vtranslate(html_entity_decode($header, ENT_QUOTES), $moduleName);

                $entries = array();
                for ($j = 0; $j < $db->num_rows($result); $j++) {
                    $entries[] = $this->sanitizeValuesModified($db->fetchByAssoc($result, $j));
                }
                break;
        }

        $this->output($request, $translatedHeaders, $entries);
    }

    /**
     * Function that generates Export Query based on the mode
     * @param Vtiger_Request $request
     * @return <String> export query
     */
    function getExportQuery(Vtiger_Request $request) {
        $currentUser = Users_Record_Model::getCurrentUserModel();
        $mode = $request->getMode();
        $cvId = $request->get('viewname');
        $moduleName = $request->get('source_module');

        $queryGenerator = new QueryGenerator($moduleName, $currentUser);
        $queryGenerator->initForCustomViewById($cvId);
        $fieldInstances = $this->moduleFieldInstances;

        $accessiblePresenceValue = array(0, 2);
        foreach ($fieldInstances as $field) {
            // Check added as querygenerator is not checking this for admin users
            $presence = $field->get('presence');
            if (in_array($presence, $accessiblePresenceValue)) {
                $fields[] = $field->getName();
            }
        }
        $queryGenerator->setFields($fields);
        $query = $queryGenerator->getQuery();

        if (in_array($moduleName, getInventoryModules())) {
            $query = $this->moduleInstance->getExportQuery($this->focus, $query);
        }

        $this->accessibleFields = $queryGenerator->getFields();

        switch ($mode) {
            case 'ExportAllData' : return $query;
                break;

            case 'ExportCurrentPage' : $pagingModel = new Vtiger_Paging_Model();
                $limit = $pagingModel->getPageLimit();

                $currentPage = $request->get('page');
                if (empty($currentPage))
                    $currentPage = 1;

                $currentPageStart = ($currentPage - 1) * $limit;
                if ($currentPageStart < 0)
                    $currentPageStart = 0;
                $query .= ' LIMIT ' . $currentPageStart . ',' . $limit;

                return $query;
                break;

            case 'ExportSelectedRecords' : $idList = $this->getRecordsListFromRequest($request);
                $baseTable = $this->moduleInstance->get('basetable');
                $baseTableColumnId = $this->moduleInstance->get('basetableid');
                if (!empty($idList)) {
                    if (!empty($baseTable) && !empty($baseTableColumnId)) {
                        $idList = implode(',', $idList);
                        $query .= ' AND ' . $baseTable . '.' . $baseTableColumnId . ' IN (' . $idList . ')';
                    }
                } else {
                    $query .= ' AND ' . $baseTable . '.' . $baseTableColumnId . ' NOT IN (' . implode(',', $request->get('excluded_ids')) . ')';
                }
                return $query;
                break;


            default : return $query;
                break;
        }
    }

    /**
     * Function returns the export type - This can be extended to support different file exports
     * @param Vtiger_Request $request
     * @return <String>
     */
    function getExportContentType(Vtiger_Request $request) {
        $type = $request->get('export_type');
        if (empty($type)) {
            return 'text/csv';
        }
    }

    function output($request, $headers, $entries) {

        if ($request->get("export_type") != 'excel') {
            $moduleName = $request->get('source_module');
            $fileName = str_replace(' ', '_', vtranslate($moduleName, $moduleName));
            $exportType = $this->getExportContentType($request);

            header("Content-Disposition:attachment;filename=$fileName.csv");
            header("Content-Type:$exportType;charset=UTF-8");
            header("Expires: Mon, 31 Dec 2000 00:00:00 GMT");
            header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
            header("Cache-Control: post-check=0, pre-check=0", false);

            $header = implode("\", \"", $headers);
            $header = "\"" . $header;
            $header .= "\"\r\n";
            echo $header;

            foreach ($entries as $row) {
                $line = implode("\",\"", $row);
                $line = "\"" . $line;
                $line .= "\"\r\n";
                echo $line;
            }
        } else {
            $data = array();
            $data = $entries;

            $rootDirectory = vglobal('root_directory');
            $tmpDir = vglobal('tmp_dir');

            $tempFileName = tempnam($rootDirectory . $tmpDir, 'xls');
            $moduleName = $request->get('source_module') . '.xls';
            $fileName = str_replace(' ', '_', decode_html(vtranslate($moduleName, $moduleName)));
            $this->writeReportToExcelFile($tempFileName, $headers, $data);

            if (isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE')) {
                header('Pragma: public');
                header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            }

            header('Content-Type: application/x-msexcel');
            header('Content-Length: ' . @filesize($tempFileName));
            header('Content-disposition: attachment; filename="' . $fileName . '"');

            $fp = fopen($tempFileName, 'rb');
            fpassthru($fp);
        }
    }

    function writeReportToExcelFile($fileName, $header, $data = '') {

        global $currentModule, $current_language;
        $mod_strings = return_module_language($current_language, $currentModule);

        require_once("libraries/PHPExcel/PHPExcel.php");

        $workbook = new PHPExcel();
        $worksheet = $workbook->setActiveSheetIndex(0);


        $arr_val = $data;



        $header_styles = array(
            'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => 'E1E0F7')),
                //'font' => array( 'bold' => true )
        );

        if (isset($arr_val)) {
            $count = 0;
            $rowcount = 1;
            //copy the first value details
            $arrayFirstRowValues = $header;
            //array_pop($arrayFirstRowValues);   // removed action link in details
            foreach ($arrayFirstRowValues as $key => $value) {
                $worksheet->setCellValueExplicitByColumnAndRow($count, $rowcount, $value, true);
                $worksheet->getStyleByColumnAndRow($count, $rowcount)->applyFromArray($header_styles);

                // NOTE Performance overhead: http://stackoverflow.com/questions/9965476/phpexcel-column-size-issues
                //$worksheet->getColumnDimensionByColumn($count)->setAutoSize(true);

                $count = $count + 1;
            }

            $rowcount++;
            foreach ($arr_val as $key => $array_value) {
                $count = 0;
                //array_pop($array_value); // removed action link in details
                foreach ($array_value as $hdr => $value) {
                    //if($hdr == 'ACTION') continue;
                    $value = decode_html($value);
                    // TODO Determine data-type based on field-type.
                    // String type helps having numbers prefixed with 0 intact.
                    $worksheet->setCellValueExplicitByColumnAndRow($count, $rowcount, $value, PHPExcel_Cell_DataType::TYPE_STRING);
                    $count = $count + 1;
                }
                $rowcount++;
            }
        }

        $workbookWriter = PHPExcel_IOFactory::createWriter($workbook, 'Excel5');
        $workbookWriter->save($fileName);
        return $arr_val;
    }

    private $picklistValues;
    private $fieldArray;
    private $fieldDataTypeCache = array();

    /**
     * this function takes in an array of values for an user and sanitizes it for export
     * @param array $arr - the array of values
     */
    function sanitizeValues($arr) {
        $db = PearDatabase::getInstance();
        $currentUser = Users_Record_Model::getCurrentUserModel();
        $roleid = $currentUser->get('roleid');
        if (empty($this->fieldArray)) {
            $this->fieldArray = $this->moduleFieldInstances;
            foreach ($this->fieldArray as $fieldName => $fieldObj) {
                //In database we have same column name in two tables. - inventory modules only
                if ($fieldObj->get('table') == 'vtiger_inventoryproductrel' && ($fieldName == 'discount_amount' || $fieldName == 'discount_percent')) {
                    $fieldName = 'item_' . $fieldName;
                    $this->fieldArray[$fieldName] = $fieldObj;
                } else {
                    $columnName = $fieldObj->get('column');
                    $this->fieldArray[$columnName] = $fieldObj;
                }
            }
        }
        $moduleName = $this->moduleInstance->getName();
        foreach ($arr as $fieldName => &$value) {
            if (isset($this->fieldArray[$fieldName])) {
                $fieldInfo = $this->fieldArray[$fieldName];
            } else {
                unset($arr[$fieldName]);
                continue;
            }
            $value = decode_html($value);
            $uitype = $fieldInfo->get('uitype');
            $fieldname = $fieldInfo->get('name');

            if (!$this->fieldDataTypeCache[$fieldName]) {
                $this->fieldDataTypeCache[$fieldName] = $fieldInfo->getFieldDataType();
            }
            $type = $this->fieldDataTypeCache[$fieldName];

            if ($fieldname != 'hdnTaxType' && ($uitype == 15 || $uitype == 16 || $uitype == 33)) {
                if (empty($this->picklistValues[$fieldname])) {
                    $this->picklistValues[$fieldname] = $this->fieldArray[$fieldname]->getPicklistValues();
                }
                // If the value being exported is accessible to current user
                // or the picklist is multiselect type.
                if ($uitype == 33 || $uitype == 16 || in_array($value, $this->picklistValues[$fieldname])) {
                    // NOTE: multipicklist (uitype=33) values will be concatenated with |# delim
                    $value = trim($value);
                } else {
                    $value = '';
                }
            } elseif ($uitype == 52 || $type == 'owner') {
                $value = Vtiger_Util_Helper::getOwnerName($value);
            } elseif ($type == 'reference') {
                $value = trim($value);
                if (!empty($value)) {
                    $parent_module = getSalesEntityType($value);
                    $displayValueArray = getEntityName($parent_module, $value);
                    if (!empty($displayValueArray)) {
                        foreach ($displayValueArray as $k => $v) {
                            $displayValue = $v;
                        }
                    }
                    if (!empty($parent_module) && !empty($displayValue)) {
                        $value = $parent_module . "::::" . $displayValue;
                    } else {
                        $value = "";
                    }
                } else {
                    $value = '';
                }
            } elseif ($uitype == 72 || $uitype == 71) {
                $value = CurrencyField::convertToUserFormat($value, null, true, true);
            } elseif ($uitype == 7 && $fieldInfo->get('typeofdata') == 'N~O' || $uitype == 9) {
                $value = decimalFormat($value);
            }
            if ($moduleName == 'Documents' && $fieldname == 'description') {
                $value = strip_tags($value);
                $value = str_replace('&nbsp;', '', $value);
                array_push($new_arr, $value);
            }
        }
        return $arr;
    }
    
     /**
     * this function takes in an array of values for an user and sanitizes it for export
     * @param array $arr - the array of values
     */
    function sanitizeValuesModified($arr) {
        $db = PearDatabase::getInstance();
        $currentUser = Users_Record_Model::getCurrentUserModel();
        $roleid = $currentUser->get('roleid');
        if (empty($this->fieldArray)) {
            $this->fieldArray = $this->moduleFieldInstances;
            foreach ($this->fieldArray as $fieldName => $fieldObj) {
                //In database we have same column name in two tables. - inventory modules only
                if ($fieldObj->get('table') == 'vtiger_inventoryproductrel' && ($fieldName == 'discount_amount' || $fieldName == 'discount_percent')) {
                    $fieldName = 'item_' . $fieldName;
                    $this->fieldArray[$fieldName] = $fieldObj;
                } else {
                    $columnName = $fieldObj->get('column');
                    $this->fieldArray[$columnName] = $fieldObj;
                }
            }
        }
        $moduleName = $this->moduleInstance->getName();
        foreach ($arr as $fieldName => &$value) {
            if (isset($this->fieldArray[$fieldName])) {
                $fieldInfo = $this->fieldArray[$fieldName];
            } else {
                unset($arr[$fieldName]);
                continue;
            }
            $value = decode_html($value);
            $uitype = $fieldInfo->get('uitype');
            $fieldname = $fieldInfo->get('name');

            if (!$this->fieldDataTypeCache[$fieldName]) {
                $this->fieldDataTypeCache[$fieldName] = $fieldInfo->getFieldDataType();
            }
            $type = $this->fieldDataTypeCache[$fieldName];

            if ($fieldname != 'hdnTaxType' && ($uitype == 15 || $uitype == 16 || $uitype == 33)) {
                if (empty($this->picklistValues[$fieldname])) {
                    $this->picklistValues[$fieldname] = $this->fieldArray[$fieldname]->getPicklistValues();
                }
                // If the value being exported is accessible to current user
                // or the picklist is multiselect type.
                if ($uitype == 33 || $uitype == 16 || in_array($value, $this->picklistValues[$fieldname])) {
                    // NOTE: multipicklist (uitype=33) values will be concatenated with |# delim
                    $value = trim($value);
                } else {
                    $value = '';
                }
            } elseif ($uitype == 52 || $type == 'owner') {
                $value = Vtiger_Util_Helper::getOwnerName($value);
            } elseif ($type == 'reference') {
                $value = trim($value);
                if (!empty($value)) {
                    $parent_module = getSalesEntityType($value);
                    $displayValueArray = getEntityName($parent_module, $value);
                    if (!empty($displayValueArray)) {
                        foreach ($displayValueArray as $k => $v) {
                            $displayValue = $v;
                        }
                    }
                    if (!empty($parent_module) && !empty($displayValue)) {
                        $value =  $displayValue;
                    } else {
                        $value = "";
                    }
                } else {
                    $value = '';
                }
            } elseif ($uitype == 72 || $uitype == 71) {
                $value = CurrencyField::convertToUserFormat($value, null, true, true);
            } elseif ($uitype == 7 && $fieldInfo->get('typeofdata') == 'N~O' || $uitype == 9) {
                $value = decimalFormat($value);
            }
            if ($moduleName == 'Documents' && $fieldname == 'description') {
                $value = strip_tags($value);
                $value = str_replace('&nbsp;', '', $value);
                array_push($new_arr, $value);
            }
        }
        return $arr;
    }

}