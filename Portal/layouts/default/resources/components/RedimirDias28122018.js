/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.2
 * ("License.txt"); You may not use this file except in compliance with the License
 * The Original Code is: Vtiger CRM Open Source
 * The Initial Developer of the Original Code is Vtiger.
 * Portions created by Vtiger are Copyright (C) Vtiger.
 * All Rights Reserved.
 *************************************************************************************/

function RedimirDias_IndexView_Component($scope, $api, $webapp, $modal, sharedModalService, $translatePartialLoader, $rootScope, $http, $translate) {

	if ($translatePartialLoader !== undefined) {
		$translatePartialLoader.addPart('home');
		$translatePartialLoader.addPart('RedimirDias');
	}


	var availableModules = JSON.parse(localStorage.getItem('modules'));
	var currentModule = 'RedimirDias';
	//set creatable SolicitudesReservas
	if (availableModules !== null && availableModules[ currentModule ] !== undefined) {
		$scope.isCreatable = availableModules[ currentModule ].create;
		$scope.filterPermissions = availableModules[currentModule].recordvisibility;
	}
	angular.extend(this, new Portal_IndexView_Component($scope, $api, $webapp, sharedModalService));
	$scope.exportEnabled = false;
	console.log("solciitudes reservas 1");
	$scope.$on('RedimirDias', function () {

		console.log("solciitudes reservas 2");
		window.location.href = "index.php?module=RedimirDias&status=Open";
	});

	$scope.$on('editRecordModalRedimirDias.Template', function () {

		console.log("acaaa");

		$modal.open({
			templateUrl: 'editRecordModalRedimirDias.template',
			controller: RedimirDias_EditView_Component,
			backdrop: 'static',
			size: 'lg',
			keyboard: 'false',
			resolve: {
				record: function () {
					return {};
				},
				api: function () {
					return $api;
				},
				webapp: function () {
					return $webapp;
				},
				module: function () {
					return 'RedimirDias';
				},
				language: function () {
					return $scope.$parent.language;
				},
				editStatus: function () {
					return false;
				}
			}
		});
	});

	var url = purl();
	var status = url.param('status');
	var loadStatus = '';
	$scope.activateStatusElement = false;
	if (status !== undefined && status === 'Open') {
		loadStatus = 'Open';
	}

	if (loadStatus !== undefined && loadStatus !== '') {
		$scope.loadOpenStatus = true;
		var stateObject = {};
		var title = "Portal";
		var newUrl = "index.php?module=RedimirDias";
		history.pushState(stateObject, title, newUrl);
		localStorage.setItem('currentStatus', JSON.stringify({
			"label": "Open",
			"value": "Open"
		}));
	}
	$scope.isCreateable = true;
	$scope.viewLoading = false;

	//$scope.date = "";

	$scope.$watch('searchQ.ticketstatus', function (nvalue, ovalue) {
		if (nvalue !== ovalue) {
			localStorage.setItem('currentStatus', JSON.stringify($scope.searchQ.ticketstatus));
			$scope.loadRecords();
			$scope.currentPage = 1;
		}
	});

	$scope.create = function () {
		console.log("acaaa 4");
		var modalInstance = $modal.open({
			templateUrl: 'editRecordModalRedimirDias.template',
			controller: RedimirDias_EditView_Component,
			backdrop: 'static',
			keyboard: 'false',
			size: 'lg',
			resolve: {
				record: function () {
					return {};
				},
				api: function () {
					return $api;
				},
				webapp: function () {
					return $webapp;
				},
				module: function () {
					return $scope.module;
				},
				language: function () {
					return $scope.$parent.language;
				},
				editStatus: function () {
					return false;
				}
			}
		});
	}


	$scope.loadRecords = function (pageNo) {

		console.log("solciitudes reservas 3");
		$scope.viewLoading = true;
		$scope.module = 'RedimirDias';
		var language = $scope.$parent.language;
		var params = {};
		$webapp.busy(false);
		$scope.itemsPerPage = 10;
		if ($scope.searchQ.onlymine) {
			$scope.searchQ.mode = 'mine';
		} else {
			$scope.searchQ.mode = 'all';
		}

		var filter = {};
		/*if ($scope.searchQ.ticketstatus !== undefined) {
			if ($scope.searchQ.ticketstatus.value.toUpperCase() !== 'ALL') {
				filter = {
					'ticketstatus': $scope.searchQ.ticketstatus.value
				}
			}
		}*/

		if ($scope.sortParams === undefined) {
			params = {
				'mode': $scope.searchQ.mode,
				'page': pageNo
			}
		} else if ($scope.sortParams !== undefined) {
			params = $scope.sortParams;
		}
		$api.get($scope.module + '/FetchRecords', {
			q: params,
			filter: filter,
			label: 'RedimirDias',
			language: language
		})
				.success(function (result) {
					$scope.pageInitialized = true;
					var availableModules = JSON.parse(localStorage.getItem('modules'));
					var currentModule = 'RedimirDias';
					var ptitleLabel = availableModules[ currentModule ].uiLabel;
					$scope.ptitle = ptitleLabel
					$scope.headers = result.headers;
					$scope.records = result.records;
					$scope.totalPages = result.count;
					$scope.edits = result.editLabels;
					$scope.viewLoading = false;
					$webapp.busy(false);
				});
	}

	var ticketStatuses = [];
	$scope.loadValues = function () {

		console.log("solciitudes reservas 4");
		var language = $scope.$parent.language;
		if ($scope.module === 'RedimirDias') {
			$api.get($scope.module + '/DescribeModule', {
				language: language
			})
					.success(function (structure) {

						var describeStructure = structure.describe.fields;
						if (structure.describe === undefined && structure.message === 'Contacts module is disabled') {
							alert("Contacts module has been disabled.");
							window.location.href = "index.php?view=Logout";
						}
						var k = true;
						angular.forEach(describeStructure, function (field) {
							if (k) {
								if (field.name === 'ticketstatus') {
									$scope.ticketStatus = field.type.picklistValues;
									k = false;
								}
							}
						})
						var all = {
							"label": $translate.instant('All Tickets'),
							"value": "all"
						};
						if ($scope.ticketStatus !== undefined) {
							$scope.ticketStatus.unshift(all);
							$scope.searchQ.ticketstatus = $scope.ticketStatus[ 0 ];
							if (localStorage.getItem('currentStatus') !== undefined) {
								$scope.currentStatus = JSON.parse(localStorage.getItem('currentStatus'));
								if ($scope.currentStatus !== null && loadStatus == 'Open') {
									var existingStatusLabel = $scope.currentStatus.label;
									var existingStatusValue = $scope.currentStatus.value;
								} else {
									var existingStatusLabel = $translate.instant('All Tickets');
									var existingStatusValue = "all";
								}
								var continueLoop = true;
								angular.forEach($scope.ticketStatus, function (status, i) {
									if (continueLoop) {
										if (status.value === existingStatusValue) {
											continueLoop = false;
											$scope.searchQ.ticketstatus = $scope.ticketStatus[ i ];
										}
									}
								})
							}
							$scope.activateStatus = true;
							if ($scope.loadOpenStatus) {
								$scope.searchQ.ticketstatus = $scope.ticketStatus[ 1 ];
							}
						} else {
							$scope.activateStatus = false;
							$scope.searchQ.ticketstatus = {
								"label": $translate.instant('All Tickets'),
								"value": "all"
							};
						}
					})
		}
	}
	$scope.status = [];
	ticketStatuses = $scope.loadValues();

	$scope.pageChanged = function (pageNo) {
		$scope.loadPage = pageNo - 1;
		if ($scope.sortParams !== undefined) {
			$scope.sortParams.page = pageNo - 1;
			$scope.loadRecords();
		} else {
			$scope.loadRecords(pageNo - 1);
		}
	}

	$scope.setSortOrder = function (header) {
		var order = 'ASC';
		if (header == $scope.OrderBy) {
			$scope.reverse = !$scope.reverse;
		}
		if ($scope.reverse && $scope.OrderBy !== undefined) {
			order = 'DESC';
		}
		$scope.OrderBy = header;
		var params = {
			'page': $scope.currentPage - 1,
			'mode': $scope.searchQ.mode,
			'order': order,
			'orderBy': $scope.edits[ header ]
		}
		if ($scope.loadPage !== undefined) {
			params.page = $scope.loadPage;
		}
		$scope.sortParams = params;
		$scope.loadRecords();
	}

	$scope.exportRecords = function (module) {
		$scope.csvHeaders = [];
		$scope.filename = $scope.ptitle;
		if ($scope.searchQ.ticketstatus.label !== undefined) {
			$scope.filename = $scope.ptitle + '_' + $scope.searchQ.ticketstatus.label;
		}
		var params1 = {};
		var filter = {};
		var language = $scope.$parent.language;
		params1 = {
			'mode': $scope.searchQ.mode
		}
		if ($scope.searchQ.ticketstatus.value.toUpperCase() !== 'ALL') {
			filter = {
				'ticketstatus': $scope.searchQ.ticketstatus.value
			}
		}
		angular.forEach($scope.headers, function (header) {
			if (header !== 'id') {
				$scope.csvHeaders.push(header);
			}
		})
		return $http.get('index.php?module=' + module + '&api=ExportRecords', {
			params: {
				q: params1,
				filter: filter,
				label: 'RedimirDias'
			}
		})
				.then(function (response) {
					return response.data.result.records;
				});

	}
}

function RedimirDias_DetailView_Component($scope, $api, $webapp, $translatePartialLoader, sharedModalService, $modal, $http) {
	$scope.module = 'RedimirDias';
	if ($translatePartialLoader !== undefined) {
		$translatePartialLoader.addPart('home');
		$translatePartialLoader.addPart('RedimirDias');
		$translatePartialLoader.addPart('Documents');
	}
	let url = location.href;
	let urlSplit = url.split("=");
	let longitud = urlSplit.length - 1;
	let id = urlSplit[longitud];
	let idSplit = id.split("x");
	$scope.idSolicitud = idSplit[1];
	console.log(idSplit[1]);


	//$scope.record = {header : "mauro"};
	$scope.solicitud = {};

	$http.get('index.php?module=RedimirDias&api=getDataRedimirDias', {
		params: {
			query: idSplit[1]
		}
	}).then(response => {
		$scope.solicitud = response['data'].result[0];
		console.log($scope.solicitud);
	});
	 

	$scope.documentsEnabled = false;
	//Enable or disable edit button
	var availableModules = JSON.parse(localStorage.getItem('modules'));
	var currentModule = $scope.module;
	$scope.isEditable = availableModules[currentModule].edit
	angular.extend(this, new Portal_DetailView_Component($scope, $api, $webapp));
	$scope.$watch('RedimirDias', function (nvalue, ovalue) {
		$scope.closeButtonDisabled = false;
		if (nvalue != ovalue) {
			if (nvalue.toUpperCase() != 'CLOSED') {
				$scope.isCommentCreateable = true;
				$scope.closeButtonDisabled = true;
			}
		}
	});



	$scope.$on('editRecordModalRedimirDias.Template', function () {
		console.log("acaaa 1");
		$modal.open({
			templateUrl: 'editRecordModalRedimirDias.template',
			controller: Documents_EditView_Component,
			backdrop: 'static',
			keyboard: 'false',
			resolve: {
				record: function () {
					return {
						'parentId': $scope.id,
						'parentModule': $scope.module
					};
				},
				api: function () {
					return $api;
				},
				webapp: function () {
					return $webapp;
				},
				module: function () {
					return 'Documents';
				}
			}
		});
	});

	$scope.close = function () {
		var params = {
			'ticketstatus': 'Closed'
		}
		$api.post($scope.module + '/SaveRecord', {
			record: params,
			recordId: $scope.id
		})
				.success(function (savedRecord) {
					if (savedRecord.record !== undefined) {
						$webapp.busy();
						// Update client data-structure to reflect Closed status.
						var recordStatus = savedRecord.record.ticketstatus;
						$scope.RedimirDiasStatus = recordStatus;
						var statusField = $scope.edits[ 'ticketstatus' ];
						$scope.record[ statusField ] = $scope.RedimirDiasCloseLabel;
						$scope.closeButtonDisabled = false;
						$webapp.busy(false)
						$scope.isCommentCreateable = (recordStatus.toUpperCase() != 'CLOSED');
					} else {
						alert("Mandatory fields are missing," + savedRecord.message + '.');
					}
				});
	}


	$scope.selectedTab = function (selected) {
		$scope.selection = selected;
	}



	$scope.attachDocument = function (module, action) {
		var actionConfig = {
			'LBL_ADD_DOCUMENT': 'Documents'
		};
		if (actionConfig.hasOwnProperty(action)) {
			sharedModalService.prepForModal(actionConfig[ action ]);
		}
	}

	$scope.edit = function (module, id) {
		console.log("aca mauro en el controller!");
		var modalInstance = $modal.open({
			templateUrl: 'editRecordModalRedimirDias.template',
			controller: RedimirDias_EditView_Component,
			backdrop: 'static',
			keyboard: 'false',
			size: 'lg',
			resolve: {
				record: function () {
					return {};
				},
				api: function () {
					return $api;
				},
				webapp: function () {
					return $webapp;
				},
				module: function () {
					return $scope.module;
				},
				language: function () {
					return $scope.$parent.language;
				},
				editStatus: function () {
					return false;
				}
			}
		});

	}
}

function RedimirDias_EditView_Component($scope, $modalInstance, record, api, webapp, module, $timeout, $translatePartialLoader, language, $filter, $http, editStatus) {

	$scope.data = {};

	$scope.datepickerOptions = {
	    format: 'dd/mm/yyyy',
	    language: 'es',
	    autoclose: true,
	    weekStart: 0
	}

	$scope.contactos = [];
	$scope.contactoSeleccionado = {};
	$scope.hoteles = [];
	$scope.hotelSeleccionado = {};
	$scope.redpasajeros = 0;

	console.log("llegue aca mauro!");

	api.get(module + '/getHoteles', {})
	.success(function (response) {
		console.log(response);
		$scope.hoteles = response;
		$scope.hotel = $scope.hoteles[0];
	});   

	$scope.errorSolicitudDia = false;               

	/*api.get(module + '/getContactsPortal', {})
	.success(function (response) {
		console.log(response);
		$scope.contactos = response;
		$scope.rescontacto = $scope.contactos[0];
	});*/

	$scope.estados = [{id : 'Pendiente', name : 'Pendiente'}, {id : 'Confirmada', name : 'Confirmada'}];
	$scope.redestado = {id : 'Pendiente', name : 'Pendiente'};

	$scope.idSolicitud = null;
	$scope.solicitud = {};
	let url = location.href;
	if(url.indexOf("&id=") > -1){
		let urlSplit = url.split("=");
		let longitud = urlSplit.length - 1;
		let id = urlSplit[longitud];
		let idSplit = id.split("x");
	 	$scope.idSolicitud = idSplit[1];

		$http.get('index.php?module=RedimirDias&api=getDataRedimirDias', {
			params: {
				query: idSplit[1]
			}
		}).then(response => {
			$scope.solicitud = response['data'].result[0];
			console.log(JSON.stringify($scope.solicitud));
			//$scope.rescontacto = {id : $scope.solicitud['contactid'], name : $scope.solicitud['rescontacto']};
			$scope.redestado = {id : $scope.solicitud['redestado'], name : $scope.solicitud['redestado']};
			$scope.redhotel = {id : $scope.solicitud['hotel'], name : $scope.solicitud['hotel']};
			$scope.$watch("solicitud.redpasajeros", function(newValue, oldValue){
				if(newValue < 1){
					jQuery('#redpasajero1').attr('disabled', 'disabled');
					jQuery('#redpasajero2').attr('disabled', 'disabled');
					jQuery('#redpasajero3').attr('disabled', 'disabled');
					jQuery('#redpasajero4').attr('disabled', 'disabled');
					jQuery('#redpasajero5').attr('disabled', 'disabled');

					$scope.solicitud.redpasajero1 = "";
					$scope.solicitud.redpasajero2 = "";
					$scope.solicitud.redpasajero3 = "";
					$scope.solicitud.redpasajero4 = "";
					$scope.solicitud.redpasajero5 = "";
				}
				else if(newValue == 1){
					jQuery('#redpasajero1').attr('disabled', false);
					jQuery('#redpasajero2').attr('disabled', 'disabled');
					jQuery('#redpasajero3').attr('disabled', 'disabled');
					jQuery('#redpasajero4').attr('disabled', 'disabled');
					jQuery('#redpasajero5').attr('disabled', 'disabled');

					$scope.solicitud.redpasajero2 = "";
					$scope.solicitud.redpasajero3 = "";
					$scope.solicitud.redpasajero4 = "";
					$scope.solicitud.redpasajero5 = "";
				}
				else if(newValue == 2){
					jQuery('#redpasajero1').attr('disabled', false);
					jQuery('#redpasajero2').attr('disabled', false);
					jQuery('#redpasajero3').attr('disabled', 'disabled');
					jQuery('#redpasajero4').attr('disabled', 'disabled');
					jQuery('#redpasajero5').attr('disabled', 'disabled');

					$scope.solicitud.redpasajero3 = "";
					$scope.solicitud.redpasajero4 = "";
					$scope.solicitud.redpasajero5 = "";
				}
				else if(newValue == 3){
					jQuery('#redpasajero1').attr('disabled', false);
					jQuery('#redpasajero2').attr('disabled', false);
					jQuery('#redpasajero3').attr('disabled', false);
					jQuery('#redpasajero4').attr('disabled', 'disabled');
					jQuery('#redpasajero5').attr('disabled', 'disabled');

					$scope.solicitud.redpasajero4 = "";
					$scope.solicitud.redpasajero5 = "";
				}
				else if(newValue == 4){
					jQuery('#redpasajero1').attr('disabled', false);
					jQuery('#redpasajero2').attr('disabled', false);
					jQuery('#redpasajero3').attr('disabled', false);
					jQuery('#redpasajero4').attr('disabled', false);
					jQuery('#redpasajero5').attr('disabled', 'disabled');

					$scope.solicitud.redpasajero5 = "";
				}
				else if(newValue >= 5){
					jQuery('#redpasajero1').attr('disabled', false);
					jQuery('#redpasajero2').attr('disabled', false);
					jQuery('#redpasajero3').attr('disabled', false);
					jQuery('#redpasajero4').attr('disabled', false);
					jQuery('#redpasajero5').attr('disabled', false);
				}
			});
		});
	}
	
	$scope.$watch("redpasajeros", function(newValue, oldValue){
		console.log(newValue);
		if(newValue < 1){
			jQuery('#redpasajero1').attr('disabled', 'disabled');
			jQuery('#redpasajero2').attr('disabled', 'disabled');
			jQuery('#redpasajero3').attr('disabled', 'disabled');
			jQuery('#redpasajero4').attr('disabled', 'disabled');
			jQuery('#redpasajero5').attr('disabled', 'disabled');

		}
		else if(newValue == 1){
			jQuery('#redpasajero1').attr('disabled', false);
			jQuery('#redpasajero2').attr('disabled', 'disabled');
			jQuery('#redpasajero3').attr('disabled', 'disabled');
			jQuery('#redpasajero4').attr('disabled', 'disabled');
			jQuery('#redpasajero5').attr('disabled', 'disabled');
		}
		else if(newValue == 2){
			jQuery('#redpasajero1').attr('disabled', false);
			jQuery('#redpasajero2').attr('disabled', false);
			jQuery('#redpasajero3').attr('disabled', 'disabled');
			jQuery('#redpasajero4').attr('disabled', 'disabled');
			jQuery('#redpasajero5').attr('disabled', 'disabled');
		}
		else if(newValue == 3){
			jQuery('#redpasajero1').attr('disabled', false);
			jQuery('#redpasajero2').attr('disabled', false);
			jQuery('#redpasajero3').attr('disabled', false);
			jQuery('#redpasajero4').attr('disabled', 'disabled');
			jQuery('#redpasajero5').attr('disabled', 'disabled');

		}
		else if(newValue == 4){
			jQuery('#redpasajero1').attr('disabled', false);
			jQuery('#redpasajero2').attr('disabled', false);
			jQuery('#redpasajero3').attr('disabled', false);
			jQuery('#redpasajero4').attr('disabled', false);
			jQuery('#redpasajero5').attr('disabled', 'disabled');
		}
		else if(newValue >= 5){
			jQuery('#redpasajero1').attr('disabled', false);
			jQuery('#redpasajero2').attr('disabled', false);
			jQuery('#redpasajero3').attr('disabled', false);
			jQuery('#redpasajero4').attr('disabled', false);
			jQuery('#redpasajero5').attr('disabled', false);
		}
	});

	

	let d = new Date();

	let fechaHoy = d.getDate() + "/" + (d.getMonth() + 1) + "/" + d.getFullYear();
	$scope.redfechacom = fechaHoy;
	$scope.redfechafin = fechaHoy;
	$scope.datemodel = {};
	$scope.timemodel = {};
	$scope.editRecord = angular.copy(record);
	$scope.serviceContractFieldPresent = false;
	$scope.structure = null;
	var availableModules = JSON.parse(localStorage.getItem('modules'));
	if (availableModules[ 'ServiceContracts' ] !== undefined) {
		$scope.serviceContractFieldPresent = true;
	}
	if ($translatePartialLoader !== undefined) {
		$translatePartialLoader.addPart('home');
		$translatePartialLoader.addPart('RedimirDias');
	}

	function splitFields(arr, size) {
		var newArr = [];
		for (var i = 0; i < arr.length; i += size) {
			newArr.push(arr.slice(i, i + size));
		}
		return newArr;
	}
	$scope.openDatePicker = function ($event, elementOpened) {
		$event.preventDefault();
		$event.stopPropagation();
		$scope.datemodel[ elementOpened ] = !$scope.datemodel[ elementOpened ];
	};

	$scope.openTimePicker = function ($event, elementOpened) {
		$event.preventDefault();
		$event.stopPropagation();
		$scope.timemodel[ elementOpened ] = !$scope.timemodel[ elementOpened ];
	};
	// Disable weekend selection
	$scope.disabled = function (date, mode) {
		return (mode === 'day' && (date.getDay() === 0 || date.getDay() === 6));
	};

	$scope.minDate = new Date();

	if (!editStatus) {
		api.get(module + '/DescribeModule', {
			language: language
		})
				.success(function (structure) {
					var editables = [];
					var editablesText = [];
					$scope.timeLabels = [];
					$scope.multipicklistFields = [];
					$scope.referenceFields = [];
					$scope.nonAvailableReferenceFields = [];
					$scope.descriptionEnabled = false;
					$scope.disabledFields = [];
					angular.forEach(structure.describe.fields, function (field) {
						//If not editable push the field to disabledFields
						if (!field.editable) {
							$scope.disabledFields[ field.name ] = true;
						}
						if (field.name === 'ticketpriorities' && !field.editable) {
							$scope.ticketprioritiesNotPresent = true;
							if (field.default !== '') {
								$scope.defaultPriority = field.default;
							} else {
								$scope.defaultPriority = 'Normal';
							}
						}
						if (field.name === 'ticketstatus' && !field.editable) {
							$scope.ticketstatusNotPresent = true;
							if (field.default !== '') {
								$scope.defaultStatus = field.default;
							} else {
								$scope.defaultStatus = 'In Progress';
							}
						}
						if (field.name !== 'contact_id' && field.name !== 'parent_id' && field.name !== 'assigned_user_id' && field.name !== 'related_to' && field.editable && field.type.name !== "text") {
							//If not editable push the field to disabledFields
							if (!field.editable) {
								$scope.disabledFields[ field.name ] = true;
							}
							if (field.type.name == 'string' && field.editable) {
								$scope.data[ field.name ] = field.default;
								if (field.name == 'ticket_title') {
									$scope.ticketTitleLabel = field.label;
									$scope.data[ 'ticket_title' ] = field.default;
								}
							}

							if (field.type.name == 'integer' && field.editable) {

								$scope.data[ field.name ] = field.default;

							}

							if (field.type.name == 'phone' || field.type.name == 'skype' && field.editable) {
								$scope.data[ field.name ] = field.default;
							}

							if (field.type.name == 'boolean' && field.editable) {
								if (field.default == "on") {
									$scope.data[ field.name ] = true;
								} else {
									$scope.data[ field.name ] = false;
								}
							}

							if (field.type.name == 'email' && field.editable) {
								$scope.data[ field.name ] = field.default;
							}

							if (field.type.name == 'url' && field.editable) {
								$scope.data[ field.name ] = field.default;
							}

							if (field.type.name == 'double' && field.editable) {
								$scope.data[ field.name ] = field.default;
							}

							if (field.type.name == 'currency' && field.editable) {
								$scope.data[ field.name ] = field.default;
							}

							if (field.type.name == 'time' && field.editable) {
								var date = new Date();
								$scope.timeField = true;
								$scope.timeLabels.push(field.name);
								if (field.default !== '') {
									var defaultTime = field.default.split(':');
									date.setHours(defaultTime[ 0 ]);
									date.setMinutes(defaultTime[ 1 ]);
									$scope.data[ field.name ] = date;
								} else {
									$scope.data[ field.name ] = date;
								}
							}
							if (field.type.name == 'date' && field.editable) {
								if (!isNaN(field.default)) {
									var date = new Date();
									$scope.data[ field.name ] = $filter('date')(date, "yyyy-MM-dd");
									$scope.minDate = $filter('date')(date, "yyyy-MM-dd");
								} else {
									$scope.data[ field.name ] = $filter('date')(field.default, "yyyy-MM-dd");
									$scope.minDate = $filter('date')(field.default, "yyyy-MM-dd");
								}
							}

							if (field.type.name == 'multipicklist' && field.editable) {
								$scope.multipicklistFields.push(field.name);
								var defaultValues = [];
								if (field.default !== null) {
									defaultValues = field.default.split(' |##| ');
								}
								var selectedValues = [];
								if (defaultValues.length !== 0) {
									angular.forEach(defaultValues, function (values, i) {
										var o = {};
										o.label = defaultValues[ i ];
										o.value = defaultValues[ i ];
										selectedValues.push(o);
									});
								}
								$scope.data[ field.name ] = selectedValues;
							}

							if (field.type.name == 'picklist' && field.editable) {
								var continueLoop = true;
								var defaultValue = field.default;
								angular.forEach(field.type.picklistValues, function (pickList, i) {
									if (continueLoop) {
										if (defaultValue !== '' && pickList.value == defaultValue) {
											field.value = field.type.picklistValues[ i ];
											field.index = i;
											continueLoop = false;
										} else if (defaultValue === '') {
											field.value = field.type.picklistValues[ i ];
											field.defaultIndex = i;
											continueLoop = false;
										}
									}
								});
								if (field.index === undefined) {
									$scope.data[ field.name ] = field.type.picklistValues[ 0 ].value;
								} else {
									$scope.data[ field.name ] = field.type.picklistValues[ field.index ].value;
								}
							}
							if (field.name !== 'ticket_title') {
								editables.push(field)
							}
						}
						if (field.type.name === "text" && field.editable) {
							$scope.data[ field.name ] = field.default;
							editablesText.push(field);
						}
					});
					var newEditables = [];
					angular.forEach(editables, function (field, i) {
						var isDeleted = false;
						if (field.type.name === "reference") {
							if (field.type.refersTo[ 0 ] === undefined || availableModules[ field.type.refersTo[ 0 ] ] === undefined) {
								isDeleted = true;
							}
						}
						if (!isDeleted) {
							if (field.type.name === "reference") {
								$scope.referenceFields.push(field.name);
							}
							newEditables.push(field);
						}
					});
					editables = newEditables;
					$scope.fields = splitFields(editables, 2);
					if (editablesText.length !== 0) {
						$scope.textFieldsEnabled = true;
						$scope.editableText = editablesText;
					}
				});

	}

	$scope.fetchReferenceRecords = function (module, query) {
		var records = [];
		return $http.get('index.php?module=' + module + '&api=FetchReferenceRecords', {
			params: {
				module: module,
				query: query
			}
		})
				.then(function (response) {
					angular.forEach(response.data.result, function (record, i) {
						if (angular.isObject(record)) {
							records.push(response.data.result[ i ]);
						}
					})
					return records;
				});
	}

	$scope.save = function (editar) {
		/*if (!validity) {
			$scope.submit = true;
			return false;
		}*/

		//if ($scope.referenceFields.length > 0) {
			angular.forEach($scope.referenceFields, function (label) {
				if ($scope.data[ label ] !== undefined && $scope.data[ label ] !== '') {
					$scope.data[ label ] = $scope.data[ label ].id;
				} else {
					$scope.data[ label ] = '';
				}
			});
			//console.log($scope.data)
			if(!editar){
				//alert("entro aca");
				let fechaComSplit = $scope.redfechacom.split('/');
				let fc = fechaComSplit[2] + "-" + fechaComSplit[1] + "-" + fechaComSplit[0];
				let fechaFinSplit = $scope.redfechafin.split('/');
				let ff = fechaFinSplit[2] + "-" + fechaFinSplit[1] + "-" + fechaFinSplit[0];

				//$scope.data['rescontacto'] = "12x" + $scope.rescontacto.id;
				$scope.data['redestado'] = $scope.redestado.id;
				$scope.data['redfechacom'] = fc;
				$scope.data['redfechafin'] = ff;
				$scope.data['redcorreo'] = $scope.redcorreo;
				$scope.data['rednroconf'] = $scope.rednroconf;
				$scope.data['redpasajeros'] = $scope.redpasajeros;
				$scope.data['redpasajero1'] = $scope.redpasajero1;
				$scope.data['redpasajero2'] = $scope.redpasajero2;
				$scope.data['redpasajero3'] = $scope.redpasajero3;
				$scope.data['redpasajero4'] = $scope.redpasajero4;
				$scope.data['redpasajero5'] = $scope.redpasajero5;
				$scope.data['hotel'] = $scope.hotel.id;
				$scope.data['redcomentarios'] = $scope.resdomentarios;
			}
			else{
				let fechaComSplit2 = $scope.solicitud.redfechacom.split('/');
				let fc2 = fechaComSplit2[2] + "-" + fechaComSplit2[1] + "-" + fechaComSplit2[0];
				let fechaFinSplit2 = $scope.solicitud.redfechafin.split('/');
				let ff2 = fechaFinSplit2[2] + "-" + fechaFinSplit2[1] + "-" + fechaFinSplit2[0];

				//$scope.data['rescontacto'] = "12x" + $scope.rescontacto.id;
				$scope.data['redestado'] = $scope.redestado.id;
				$scope.data['redfechacom'] = fc2;
				$scope.data['redfechafin'] = ff2;
				$scope.data['redcorreo'] = $scope.solicitud.redcorreo;
				$scope.data['rednroconf'] = $scope.solicitud.rednroconf;
				$scope.data['redpasajeros'] = $scope.solicitud.redpasajeros;
				$scope.data['redpasajero1'] = $scope.solicitud.redpasajero1;
				$scope.data['redpasajero2'] = $scope.solicitud.redpasajero2;
				$scope.data['redpasajero3'] = $scope.solicitud.redpasajero3;
				$scope.data['redpasajero4'] = $scope.solicitud.redpasajero4;
				$scope.data['redpasajero5'] = $scope.solicitud.redpasajero5;
				$scope.data['hotel'] = $scope.hotel.id;
				$scope.data['redcomentarios'] = $scope.solicitud.redcomentarios;

				//console.log($scope.rescontacto);
			}

		var record = "";
		var params = {
			record: $scope.data
		};

		if(editar == true){
			
			params.recordId = "44x" + $scope.idSolicitud;
			record = $scope.idSolicitud;
		}

		console.log(JSON.stringify(params.record));

		if (editStatus)
			params.recordId = $scope.editRecord.id;

		$http.get('index.php?module=RedimirDias&api=getDiasDisponibles', {
			params: {
				fechaDesde : $scope.data['redfechacom'],
				fechaHasta : $scope.data['redfechafin'], 
				record : record
			}
		}).then(response => {
			//console.log(response['data'].result.result);
			if(response['data'].result.result == false){
				$scope.errorSolicitudDia = true;
			}
			else{
				$modalInstance.close($scope.data);
				api.post(module + '/SaveRecord', params)
				.then(function (savedRecord) {
					webapp.busy(false);
					$scope.errorSolicitudDia = false;
					window.location.href = 'index.php?module=RedimirDias';
				}, function(error){

				});
			}
		});

		/*$modalInstance.close($scope.data);
		api.post(module + '/SaveRecord', params)
				.then(function (savedRecord) {
					webapp.busy(false);

					//window.location.href = 'index.php?module=RedimirDias';
				}, function(error){

				});*/
	}

	$scope.cancel = function () {
		$modalInstance.dismiss('cancel');
	}

	if (editStatus) {
		var editFields = [];
		var editableTextFields = [];
		$scope.referenceFields = [];
		$scope.nonAvailableReferenceFields = [];
		$scope.multipicklistFields = [];
		$scope.timeLabels = [];
		$scope.header = record.identifierName.label;
		$scope.modalTitle = record[ $scope.header ]
		$scope.disabledFields = [];
		api.get(module + '/DescribeModule')
				.success(function (describe) {
					var editableFields = describe.describe.fields;
					$scope.data[ 'ticket_title' ] = record[ record.identifierName.label ];
					angular.forEach(editableFields, function (field) {
						//If not editable push the field to disabledFields
						if (!field.editable) {
							$scope.disabledFields[ field.name ] = true;
						}
						if (field.name !== 'contact_id' && field.name !== 'parent_id' && field.name !== 'assigned_user_id' && field.name !== 'related_to' && field.type.name !== 'text' && field.editable) {
							if (field.type.name == 'string') {
								if (field.name == 'ticket_title') {
									$scope.ticketTitleLabel = field.label;
								}
								if (record[ field.label ] === '') {
									$scope.data[ field.name ] = field.default;
								} else {
									$scope.data[ field.name ] = record[ field.label ];
								}
							}

							if (field.type.name == 'integer') {
								if (record[ field.label ] === '') {
									$scope.data[ field.name ] = field.default;
								} else {
									$scope.data[ field.name ] = record[ field.label ];
								}
							}

							if (field.type.name == 'phone' || field.type.name == 'skype') {
								if (record[ field.label ] === '') {
									$scope.data[ field.name ] = field.default;
								} else {
									$scope.data[ field.name ] = record[ field.label ];
								}
							}

							if (field.type.name == 'boolean') {
								if (record[ field.label ] === '') {
									$scope.data[ field.name ] = false;
								}
								if (record[ field.label ] == "Yes" || field.default == "on") {
									$scope.data[ field.name ] = true;
								} else {
									$scope.data[ field.name ] = false;
								}
							}

							if (field.type.name == 'email') {
								if (record[ field.label ] === '') {
									$scope.data[ field.name ] = field.default;
								} else {
									$scope.data[ field.name ] = record[ field.label ];
								}
							}

							if (field.type.name == 'url') {
								if (record[ field.label ] === '') {
									$scope.data[ field.name ] = field.default;
								} else {
									$scope.data[ field.name ] = record[ field.label ];
								}
							}

							if (field.type.name == 'reference') {
								if (record[ field.label ] === '' || record[ field.label ] === 0) {
									$scope.data[ field.name ] = '';
								} else {
									$scope.data[ field.name ] = record.referenceFields[ field.label ];
								}
							}

							if (field.type.name == 'double') {
								if (record[ field.label ] === '') {
									$scope.data[ field.name ] = field.default;
								} else {
									$scope.data[ field.name ] = record[ field.label ];
								}
							}

							if (field.type.name == 'currency') {
								if (record[ field.label ] === '') {
									$scope.data[ field.name ] = field.default;
								} else {
									$scope.data[ field.name ] = record[ field.label ];
								}
							}

							if (field.type.name == 'picklist') {
								var continueLoop = true;
								var defaultValue = field.default;
								angular.forEach(field.type.picklistValues, function (pickList, i) {
									if (continueLoop) {
										if (pickList.label == record[ field.label ] && record[ field.label ] !== '') {
											field.value = field.type.picklistValues[ i ];
											field.index = i;
											continueLoop = false;
										} else if (record[ field.label ] == '' && pickList.value == defaultValue) {
											field.value = field.type.picklistValues[ i ];
											field.index = i;
											continueLoop = false;
										}
									}
								});
								if (field.index === undefined) {
									$scope.data[ field.name ] = field.type.picklistValues[ 0 ].value;
								} else {
									$scope.data[ field.name ] = field.type.picklistValues[ field.index ].value;
								}
							}

							if (field.type.name == 'multipicklist') {
								$scope.multipicklistFields.push(field.name);
								var defaultValues = [];
								var recordValues = record[ field.label ].split(',');
								if (field.default !== null) {
									defaultValues = field.default.split(' |##| ');
								}
								var selectedValues = [];
								if (recordValues.length > 0 && recordValues[ 0 ] !== '') {
									angular.forEach(recordValues, function (values, i) {
										var o = {};
										o.label = values;
										o.value = values;
										selectedValues.push(o);
									});
								} else if ((recordValues.length > 0 || recordValues[ 0 ] !== '') && defaultValues.length > 0) {
									angular.forEach(defaultValues, function (values, i) {
										var o = {};
										o.label = values;
										o.value = values;
										selectedValues.push(o);
									});
								}
								$scope.data[ field.name ] = selectedValues;
							}

							if (field.type.name == 'date') {
								if (record[ field.label ] === '' && !isNaN(field.default)) {
									var date = new Date();
									$scope.data[ field.name ] = $filter('date')(date, "yyyy-MM-dd");
									$scope.minDate = $filter('date')(record[ field.label ], "yyyy-MM-dd");
								} else if (record[ field.label ] === '' && isNaN(field.default)) {
									$scope.data[ field.name ] = $filter('date')(field.default, "yyyy-MM-dd");
									$scope.minDate = $filter('date')(field.default, "yyyy-MM-dd");
								} else {
									$scope.data[ field.name ] = $filter('date')(record[ field.label ], "yyyy-MM-dd");
									$scope.minDate = $filter('date')(record[ field.label ], "yyyy-MM-dd");
								}
							}

							if (field.type.name == 'time') {
								var date = new Date();
								$scope.timeField = true;
								$scope.timeLabels.push(field.name);
								if (record[ field.label ] !== '') {
									var selectedTime = record[ field.label ].split(':');
									date.setHours(selectedTime[ 0 ]);
									date.setMinutes(selectedTime[ 1 ]);
									$scope.data[ field.name ] = date;
								} else if (field.default !== '') {
									var defaultTime = field.default.split(':');
									date.setHours(defaultTime[ 0 ]);
									date.setMinutes(defaultTime[ 1 ]);
									$scope.data[ field.name ] = date;
								} else {
									$scope.data[ field.name ] = date;
								}
							}
							if (field.name !== 'ticket_title') {
								editFields.push(field)
							}
						}
						if (field.type.name === "text" && field.editable) {
							editableTextFields.push(field);
							if (record[ field.label ] !== '') {
								$scope.data[ field.name ] = record[ field.label ];
							} else {
								$scope.data[ field.name ] = field.default;
							}
						}
					});

					var newEditFields = [];
					angular.forEach(editFields, function (field, i) {
						var isDeleted = false;
						if (field.type.name === "reference") {
							if (field.type.refersTo[ 0 ] === undefined || availableModules[ field.type.refersTo[ 0 ] ] === undefined) {
								isDeleted = true;
							}
						}
						if (!isDeleted) {
							if (field.type.name === "reference") {
								$scope.referenceFields.push(field.name);
							}
							newEditFields.push(field);
						}
						if (field.type.name === 'reference' && availableModules[ field.type.refersTo[ 0 ] ] === undefined) {
							$scope.nonAvailableReferenceFields.push(field.name);
						}
					});
					editFields = newEditFields;
					$scope.fields = splitFields(editFields, 2);
					if (editableTextFields.length !== 0) {
						$scope.textFieldsEnabled = true;
						$scope.editableText = editableTextFields;
					}
				})
	}
}
