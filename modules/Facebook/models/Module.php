<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

/**
 * Vtiger Module Model Class
 */
class Facebook_Module_Model extends Vtiger_Module_Model {

	/**
	 * Function to get Module Header Links (for Vtiger7)
	 * @return array
	 */
	public function getModuleBasicLinks(){
		if(!$this->isEntityModule() && $this->getName() !== 'Users') {
			return array();
		}
		$createPermission = Users_Privileges_Model::isPermitted($this->getName(), 'CreateView');
		$moduleName = $this->getName();
		$basicLinks = array();
		if($createPermission) {
			$basicLinks[] = array(
				'linktype' => 'BASIC',
				'linklabel' => 'LBL_ADD_RECORD',
				'linkurl' => $this->getCreateRecordUrl(),
				'linkicon' => 'fa-plus'
			);

			$basicLinks[] = array(
				'linktype' => 'BASIC',
				'linklabel' => 'Configurar API',
				'linkurl' => "index.php?module=Facebook&view=Index",
				'linkicon' => 'fa-facebook'
			);


			$importPermission = Users_Privileges_Model::isPermitted($this->getName(), 'Import');
			if($importPermission && $createPermission) {
				$basicLinks[] = array(
					'linktype' => 'BASIC',
					'linklabel' => 'LBL_IMPORT',
					'linkurl' => $this->getImportUrl(),
					'linkicon' => 'fa-download'
				);
			}
		}
		return $basicLinks;
	}

}
