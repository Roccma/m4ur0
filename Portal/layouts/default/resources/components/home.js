/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.2
 * ("License.txt"); You may not use this file except in compliance with the License
 * The Original Code is: Vtiger CRM Open Source
 * The Initial Developer of the Original Code is Vtiger.
 * Portions created by Vtiger are Copyright (C) Vtiger.
 * All Rights Reserved.
 *************************************************************************************/

function Home_Component($scope, $api, $webapp, $modal, sharedModalService, $translatePartialLoader) {
	$translatePartialLoader.addPart('home');
	$scope.supportNotification = false;
	$scope.announcementExists = false;
	$scope.profileFetched = false;

	$scope.fetchAnnouncement = function () {
		$api.get( 'Portal/FetchAnnouncement' ).success( function ( result ) {
			if ( result.announcement !== '' ) {
				$scope.announcementExists = true;
				$scope.announcement = result.announcement;
			} else if ( result.announcement == '' && ( result.message === 'Contacts module is disabled' || result.message === 'Login failed' ) ) {
					alert( result.message );
					localStorage.clear();
					window.location.href = "index.php?view=Logout";
			}
		} );
	}

	$scope.orgName = function () {
		if (localStorage.getItem('orgName') !== null) {
			$scope.org = localStorage.getItem('orgName');
			$scope.profileFetched = true;
		} else {
			$api.get('Portal'+'/FetchCompanyTitle').success(function (profile) {
				if (profile.result !== null) {
					$scope.accountDetails = profile.result;
					$scope.org = $scope.accountDetails;
					localStorage.setItem('orgName', $scope.org);
				}
				$scope.profileFetched = true;
			});
		}
	}

	$scope.fetchShortcuts = function () {
		console.log("aca mauro");
		$api.get('Portal/FetchShortcuts').success(function (result) {
			console.log(result);
			var availableModules = $scope.$parent.modules;

			if (result.shortcut) {
				$scope.showShortcuts = true;
				if (availableModules['HelpDesk'] !== undefined && result.shortcut.HelpDesk !== undefined) {
					var uiLabel = availableModules['HelpDesk'].uiLabel;
					result.shortcut[uiLabel] = result.shortcut.HelpDesk;
					if (uiLabel !== 'HelpDesk')
						delete result.shortcut['HelpDesk'];
				}
				if (availableModules['Documents'] !== undefined && result.shortcut.Documents !== undefined) {
					var uiLabel = availableModules['Documents'].uiLabel;
					result.shortcut[uiLabel] = result.shortcut.Documents;
					if (uiLabel !== 'Documents')
						delete result.shortcut['Documents'];
				}

				$scope.shortcuts = result.shortcut;
			} else {
				$scope.showShortcuts = false;
			}
		})
	}
	$scope.openShortcut = function (module, action) {
		var actionConfig = {
			'LBL_ADD_DOCUMENT': 'Documents',
			'LBL_CREATE_TICKET': 'HelpDesk',
		};
		var serviceConfig = {
			'LBL_OPEN_TICKETS': 'HelpDesk',
		};
		if (actionConfig.hasOwnProperty(action)) {
			sharedModalService.prepForModal(actionConfig[action]);
		}
		if (serviceConfig.hasOwnProperty(action)) {
			sharedModalService.loadService(serviceConfig[action]);
		}

	}

	$scope.activateSaldo = false;
	$scope.getSaldo = function(){
		$api.get('Portal/getSaldo').success(function (result) {
			console.log(result);
			$scope.saldo = result;
			if($scope.saldo.dias_reservas == null) $scope.saldo.dias_reservas = 0;
			$scope.activateSaldo = true;
		});
	}

	$scope.getNoticias = function(){
		var language = localStorage.getItem('language');
		var lang = "";
		$scope.noticias = [];
		switch(language){
			case 'es_es':
				lang = 'Spanish';
				break;
		 	case 'en_us':
		 		lang = 'English';
		 		break;
		 	case 'fr_fr':
		 		lang = 'French';
		 		break;
		 	case 'de_de':
		 		lang = 'German';
		 		break;
 			default:
		 		lang = 'Other';
		 		break;
		 
		}
		console.log("Language -----> " + lang);
		$scope.noticias = [];
		$api.get('Portal/getNoticias',{
				query: lang
		}).success(function(result){
			if(result != null){
				$scope.noticias = result;
				setTimeout(function(){
					for(var i = 0; i < $scope.noticias.length; i++){
						console.log("-----> " + $scope.noticias[i].noticiasid);
						$scope.noticias[i].notnoticia = $scope.noticias[i].notnoticia.replace("background-color:rgb(255,255,255);", "");
						$('#' + $scope.noticias[i].noticiasid).html($scope.noticias[i].notnoticia);
					}
				}, 500);
				
			}


		});

	}

	$scope.fetchRecentRecords = function () {
		$scope.activateRecentTickets = false;
		$scope.activateRecentSolicitudesReservas = false;
		$scope.activateRecentRedimirDias = false;
		var availableModules = JSON.parse(localStorage.getItem('modules'));
		$api.get('Portal/FetchRecentRecords').success(function (result) {
			//alert("acaaa");
			console.log(result);
			if (result.records) {
				if (result.records.HelpDesk !== undefined && result.records.HelpDesk !== '') {
					var uiLabel = availableModules['HelpDesk'].label;
					result.records[uiLabel] = result.records.HelpDesk;
					if (uiLabel !== 'HelpDesk') {
						delete result.records['HelpDesk'];
					}
					$scope.recentTickets = result.records[uiLabel];
					$scope.ticketsUiLabel = uiLabel;
					$scope.activateRecentTickets = true;
				}
				if (result.records.Faq !== undefined && result.records.Faq !== '') {
					var uiLabel = availableModules['Faq'].uiLabel;
					result.records[uiLabel] = result.records.Faq;
					if (uiLabel !== 'Faq') {
						delete result.records['Faq'];
					}
				}
				if (result.records.Documents !== undefined && result.records.Documents !== '') {
					var uiLabel = availableModules['Documents'].uiLabel;
					result.records[uiLabel] = result.records.Documents;
					if (uiLabel !== 'Documents') {
						delete result.records['Documents'];
					}
				}
				if (result.records.SolicitudesReservas !== undefined && result.records.SolicitudesReservas !== '') {
					var uiLabel = availableModules['SolicitudesReservas'].uiLabel;
					result.records[uiLabel] = result.records.SolicitudesReservas;
					if (uiLabel !== 'SolicitudesReservas') {
						delete result.records['SolicitudesReservas'];
					}
					$scope.recentSolicitudesReservas = result.records[uiLabel];
					$scope.pedidosUiLabel = availableModules['SolicitudesReservas'].uiLabel;
					$scope.activateRecentSolicitudesReservas = true;
				}
				if (result.records.RedimirDias !== undefined && result.records.RedimirDias !== '') {
					var uiLabel = availableModules['RedimirDias'].uiLabel;
					result.records[uiLabel] = result.records.RedimirDias;
					if (uiLabel !== 'RedimirDias') {
						delete result.records['RedimirDias'];
					}
					$scope.recentRedimirDias = result.records[uiLabel];
					$scope.pedidosUiLabel = availableModules['RedimirDias'].uiLabel;
					$scope.activateRecentRedimirDias = true;
				}
				$scope.recentRecords = result.records;
			}
		})
	}

	$scope.determineStatus = function (status) {
		if (status === 'Closed') {
			return 'label-success';
		} else if (status === 'Open') {
			return 'label-danger';
		} else if (status === 'In Progress') {
			return 'label-warning';
		} else if (status === 'Wait For Response') {
			return 'label-info';
		} else if (status === 'Closed') {
			return 'label-success';
		} else if (status === 'Wait') {
			return 'label-info';
		} else if (status === 'New') {
			return 'label-damnger';
		} else if (status === 'Assigned') {
			return 'label-info';
		} else if (status === 'Rsolved') {
			return 'label-success';
		} else {
			return 'label-primary';
		}
	}
	$scope.moduleCheck = function (module) {
		return false;
	}
	angular.extend(this, new HelpDesk_IndexView_Component($scope, $api, $webapp, $modal, sharedModalService, $translatePartialLoader));

	angular.extend(this, new Documents_IndexView_Component($scope, $api, $webapp, $modal));

	setTimeout(function () {
		loadContents();

	}, 3000);

	$scope.searchEnabled = false;

	function loadContents() {
		$webapp.busy();
		$scope.orgName();
		$scope.fetchAnnouncement();
		$scope.fetchShortcuts();
		$scope.fetchRecentRecords();
		$scope.getSaldo();
		$scope.getNoticias();
		$webapp.busy(false);
		if (localStorage.getItem('currentStatus') !== undefined) {
			localStorage.removeItem('currentStatus');
		}
	}

	$scope.isObj = function (content) {
		if (angular.isObject(content))
			return true;
	}

	$scope.loadRecentRecord = function (module, id) {
		//alert("aca: " + module + " - " + id);
		var availableModules = $scope.$parent.modules;
		if (module == 'SolicitudesReservas') {
			//alert("entre");
			window.location.href = "index.php?module=SolicitudesReservas&view=Detail&id="+id;
		}
		if (module == 'RedimirDias') {
			//alert("entre");
			window.location.href = "index.php?module=RedimirDias&view=Detail&id="+id;
		}
		if (module == 'Noticias') {
			//alert("entre");
			window.location.href = "index.php?module=Noticias&view=Detail&id=48x"+id;
		}
		if (availableModules['HelpDesk'] !== undefined && (availableModules['HelpDesk'].label === module) || availableModules['HelpDesk'].uiLabel === module) {
			window.location.href = "index.php?module=HelpDesk&view=Detail&id="+id;
		}
		
		if (availableModules['Documents'] !== undefined && (availableModules['Documents'].label === module) || availableModules['Documents'].uiLabel === module) {
			window.location.href = "index.php?module=Documents&view=Detail&id="+id;
		}
		if (availableModules['Faq'] !== undefined && (availableModules['Faq'].label === module) || availableModules['Faq'].uiLabel === module) {
			window.location.href = "index.php?module=Faq&record="+id;
		}
	}

	$scope.ifNotTickets = function (module) {
		var availableModules = $scope.$parent.modules;
		if (availableModules['HelpDesk'] !== undefined && availableModules['HelpDesk'].label === module) {
			return false;
		}
		return true;
	}

	$scope.ifNotSolicitudesReservas = function (module) {
		var availableModules = $scope.$parent.modules;
		if (availableModules['SolicitudesReservas'] !== undefined && availableModules['SolicitudesReservas'].uiLabel === module) {
			return false;
		}
		return true;
	}

	$scope.ifNotRedimirDias = function (module) {
		var availableModules = $scope.$parent.modules;
		if (availableModules['RedimirDias'] !== undefined && availableModules['RedimirDias'].uiLabel === module) {
			return false;
		}
		return true;
	}
}
