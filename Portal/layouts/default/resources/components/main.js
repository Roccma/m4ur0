/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.2
 * ("License.txt"); You may not use this file except in compliance with the License
 * The Original Code is: Vtiger CRM Open Source
 * The Initial Developer of the Original Code is Vtiger.
 * Portions created by Vtiger are Copyright (C) Vtiger.
 * All Rights Reserved.
 *************************************************************************************/

function MainController($scope, $api, $webapp, $modal, $translate, $translatePartialLoader, localStorageService) {


	$translatePartialLoader.addPart('login');
	$translatePartialLoader.addPart('home');
	$scope.loginUser = null;
	$scope.modules = [];
	$scope.modulesCount = 0;
	$scope.language = "es_es";

	$scope.titleLogin = 'Por favor, ingrese sus credenciales';
	$scope.passwordPlaceholder = 'Contraseña';
	$scope.loginButton = 'Aceptar';
	$scope.contraseniaOlvidada = '¿Has olvidado tu contraseña?';
	$scope.emptyEmail = "Ingrese su correo electrónico";
	$scope.emptyPassword = "Ingrese su contraseña";
	$scope.errorLogin = "El Portal no se encuentra habilitado para estas credenciales";
	$scope.invalidEmail = "Ingrese un e-mail válido";
	$scope.sendMail = "Enviar";

	$scope.$watch("language", function(newValue, oldValue){
		if($scope.language == 'es_es'){
			$scope.titleLogin = 'Por favor, ingrese sus credenciales';
			$scope.passwordPlaceholder = 'Contraseña';
			$scope.loginButton = 'Aceptar';
			$scope.contraseniaOlvidada = '¿Has olvidado tu contraseña?';
			$scope.emptyEmail = "Ingrese su correo electrónico";
			$scope.emptyPassword = "Ingrese su contraseña";
			$scope.errorLogin = "El Portal no se encuentra habilitado para estas credenciales";
			$scope.invalidEmail = "Ingrese un e-mail válido";
			$scope.sendMail = "Enviar";
		}
		else if($scope.language == 'en_us'){
			$scope.titleLogin = 'Please provide your portal credentials';
			$scope.passwordPlaceholder = 'Password';
			$scope.loginButton = 'Accept';
			$scope.contraseniaOlvidada = 'Forgot password?';
			$scope.emptyEmail = "Enter your e-mail address";
			$scope.emptyPassword = "Enter your password";
			$scope.errorLogin = "Portal access has not been enabled for this account";
			$scope.invalidEmail = "Please enter a valid e-mail address";
			$scope.sendMail = "Send";
		}
	});
	$api.get('Portal/Ping').success(function (user) {
		if (user) {
			$scope.loginUser = true;
			$translate.use(user.language);
			$scope.language = user.language;
			if (localStorage.getItem('modules') !== null && localStorage.getItem('modules') !== 'null') {
				$scope.modules = JSON.parse(localStorage.getItem('modules'));
				$scope.modulesCount = Object.keys($scope.modules).length;

				/*$scope.modules = [];
				$scope.modulesCount = 0;*/
				if (localStorage.getItem('orgName') == undefined) {
					$scope.companyDetails();
				}
				$scope.$root.$emit('LoginUser.Ready');
			} else {
				$scope.fecthModules($scope.language);
				$scope.$root.$emit('LoginUser.Ready');
			}
			/*if(location.href.includes('view=Login'))
				$scope.setLanguage($scope.language)*/
		}
	});

	$api.get('Portal'+'/FetchProfile').success(function (profile) {
		$webapp.busy(false);
		$scope.contactDetails = profile.customer_details;
		$scope.contact_name = profile.customer_details.firstname + " " + profile.customer_details.lastname;
	});

	$scope.fecthModules = function (language) {

		$api.get('/FetchModules', {language: language}).success(function (result) {

			console.log(result);
			delete(result.language);	
			$scope.modules = result.moduleInfo;
			$scope.modulesCount = Object.keys($scope.modules).length;
			localStorage.setItem('modules', JSON.stringify($scope.modules));
			if (result.endDate !== undefined)
				localStorage.setItem('supportNotification', result.endDate)
		});
	}

	$scope.changePassword = function () {
		var modalInstance = $modal.open({
			templateUrl: 'changePassword.template',
			controller: Main_Setting_Component,
			backdrop: 'static',
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
					return $scope.module;
				},
				translatePartialLoader: function () {
					return $translatePartialLoader;
				}
			}
		});
	}

	$scope.forgotPassword = function () {
		if($scope.language == 'es_es'){
			var modalInstance = $modal.open({
				templateUrl: 'forgotPassword.template',
				controller: ForgotPassword_Component,
				backdrop: 'static',
				keyboard: 'false',
				resolve: {
					api: function () {
						return $api;
					},
					webapp: function () {
						return $webapp;
					},
					translatePartialLoader: function () {
						return $translatePartialLoader;
					}
				}
			});
		}
		else if($scope.language == 'en_us'){
			var modalInstance = $modal.open({
				templateUrl: 'forgotPasswordEnglish.template',
				controller: ForgotPassword_Component,
				backdrop: 'static',
				keyboard: 'false',
				resolve: {
					api: function () {
						return $api;
					},
					webapp: function () {
						return $webapp;
					},
					translatePartialLoader: function () {
						return $translatePartialLoader;
					}
				}
			});
		}
		
	};

	$scope.setLanguage = function (lang) {
		$translate.use(lang);
	};
	$scope.logout = function () {
		localStorage.clear();
		window.location.href = "index.php?module=Portal&view=Logout";
	}
	$scope.isActive = function (module) {
		var url = purl();
		var routeModule = url.param('module');
		if (routeModule !== undefined) {
			if (module === routeModule) {
				return true;
			}
			else {
				return false;
			}
		}
		if (module == 'Home' && routeModule === undefined) {
			return true;
		}
	}
	$scope.companyDetails = function () {
		$api.get('/FetchCompanyDetails').success(function (data) {
			if (data.message === undefined && data.code === undefined)
				$scope.companyInfo = angular.copy(data);
			else if (data.message === 'Contacts module is disabled') {
				alert(data.message);
				localStorage.clear();
				window.location.href = 'index.php?module=Portal&view=Logout';
			}
		})
	}
	$scope.disableSearch = true;
	$scope.Query = {};
	$scope.searchEvent = function (Query) {
		$scope.$broadcast('searchFor', $scope.Query.search);
	}

	$scope.makeAutoComplete = function () {
		$scope.$broadcast("autofill:update");
	}

	$scope.login = function (validity) {
		q = {};
		q.username = $scope.username;
		q.password = $scope.password;
		q.language = $scope.language;

		localStorage.setItem("language",  $scope.language);

		if (validity) {
			$scope.noUserName = false;
			$scope.noPassword = false;
			$api.post('Portal/Login', {q: q}).success(function (response) {
				if (response.success) {
					window.location.href = 'index.php';
				}
				else {
					$scope.loginFailed = true;
					$scope.loginMessage = response.error.message;
				}
			});
		}
		else if (!validity) {
			if (q.username === undefined && q.password === undefined) {
				$scope.noUserName = true;
				$scope.loginFailed = false;
				return false;
			}
			if (q.password !== undefined && q.username === undefined) {
				$scope.noUserName = true;
				$scope.noPassword = false;
				$scope.loginFailed = false;
				return false;
			}
			if (q.username !== undefined && q.password === undefined) {
				$scope.noPassword = true;
				$scope.noUserName = false;
				$scope.loginFailed = false;
				return false;
			}
		}
	}

	$api.get('Portal/FetchCompanyTitle').then(function (err, data) {
		if (err) {
			//Error fetching company title.
			$scope.companyTitle = '';
		}
		if (data) {
			$scope.companyTitle = data.result;
		}
	})
}

function Main_Setting_Component($scope, $modalInstance, record, api, $webapp, module, translatePartialLoader) {
	if (translatePartialLoader !== undefined) {
		translatePartialLoader.addPart('home');
	}
	$scope.editRecord = angular.copy(record);
	$scope.data = {'oldPassword': "", 'newPassword': "", 'confirmPassword': ""};

	$scope.$watch('data.oldPassword', function(newValue, oldValue){
		//console.log("aca cambioo");
		if($scope.data.oldPassword != null && $scope.data.newPassword != null && $scope.data.confirmPassword != null && 
			$scope.data.oldPassword != '' && $scope.data.newPassword != '' && $scope.data.confirmPassword != '' &&
			$scope.data.oldPassword != $scope.data.newPassword && $scope.data.newPassword == $scope.data.confirmPassword){
			$('#btnChangePassword').removeAttr('disabled');
		}
		else{
			$('#btnChangePassword').attr('disabled', 'disabled');
		}
	});

	$scope.$watch('data.newPassword', function(newValue, oldValue){
		console.log($scope.data.oldPassword + " - " + $scope.data.newPassword + " - " + $scope.data.confirmPassword);
		if($scope.data.oldPassword != null && $scope.data.newPassword != null && $scope.data.confirmPassword != null && 
			$scope.data.oldPassword != '' && $scope.data.newPassword != '' && $scope.data.confirmPassword != '' &&
			$scope.data.oldPassword != $scope.data.newPassword && $scope.data.newPassword == $scope.data.confirmPassword){
			$('#btnChangePassword').removeAttr('disabled');
		}
		else{
			$('#btnChangePassword').attr('disabled', 'disabled');
		}
	});

	$scope.$watch('data.confirmPassword', function(newValue, oldValue){
		//console.log("aca cambioo");
		if($scope.data.oldPassword != null && $scope.data.newPassword != null && $scope.data.confirmPassword != null && 
			$scope.data.oldPassword != '' && $scope.data.newPassword != '' && $scope.data.confirmPassword != '' &&
			$scope.data.oldPassword != $scope.data.newPassword && $scope.data.newPassword == $scope.data.confirmPassword){
			$('#btnChangePassword').removeAttr('disabled');
		}
		else{
			$('#btnChangePassword').attr('disabled', 'disabled');
		}
	});

	$scope.save = function () {
		api.post('Portal/ChangePassword', {record: $scope.data}).success(function (result) {
			$modalInstance.dismiss();
			if (result.result.message === undefined) {
				alert(result.result);
				$webapp.busy(false);
				localStorage.clear();
				window.location.href = 'index.php?module=Portal&view=Logout';
			}
			else if (result.result.message !== undefined) {
				alert(result.result.message)
				$webapp.busy(false);
			}
		});
	}

	$scope.cancel = function () {
		$modalInstance.dismiss('cancel');
	}
}

function ForgotPassword_Component($scope, $modalInstance, api, $webapp, translatePartialLoader) {
	if (translatePartialLoader !== undefined) {
		translatePartialLoader.addPart('home');
	}
	$scope.data = {'email': ""};

	$scope.$watch('data.email', function(newValue, oldValue){
		if(newValue != undefined && newValue != ""){
			$('#btnForgotPassword').removeAttr('disabled');
		}
		else{
			$('#btnForgotPassword').attr('disabled', 'disabled');
		}
	});

	$scope.updatePassword = function () {
		$webapp.busy(true);
		api.post('Portal/ForgotPassword', {email: $scope.data.email}).success(function (data) {
			$modalInstance.dismiss();
			if (data.result.message === undefined) {
				alert(data.result);
			}
			else if (data.result.message !== undefined) {
				alert(data.result.message);
			}
			$webapp.busy(false);
		});
	};

	$scope.cancel = function () {
		$modalInstance.dismiss('cancel');
	}
}

function globalSearchController($scope, $http, $timeout, $webapp, $translate) {

	jQuery(".search-icon").on('click', function (e) {
		jQuery(".search-box").focus();
	})

	$scope.search = '';

	$scope.getModuleLabelClass = function (module) {
		return 'label label-info';
	}

	$scope.searchItemSelected = function (item, $timeout) {
		if (item.model.count > 0) {
			var module = item.model.module.module;
			var url = "index.php?module=" + module + "&view=Detail&id=" + item.model.id;
			window.location.href = url;
		}
		else {
			$scope.search = '';
			return false;
		}
	}

	$scope.searchRecords = function (searchKey, $timeout) {
		var params = {
			"api": "SearchRecords",
			"searchKey": searchKey,
			"module": "Portal"
		};
		var result = [];
		return $http.get("index.php", {params: params}).then(function (response) {
			$webapp.busy();
			var data = response.data.result;
			angular.forEach(data, function (moduleInfo, i) {
				if (angular.isObject(moduleInfo) && moduleInfo.length !== 0) {
					if (i !== 'language') {
						var labelField = 'label';
						angular.forEach(moduleInfo, function (recordInfo) {
							if (recordInfo.hasOwnProperty('id')) {
								var res = {value: recordInfo[labelField], module: {"module": i, "uiLabel": moduleInfo.uiLabel}, id: recordInfo.id, count: 1};
								result.push(res);
							}
						});
					}
				}
			});
			if (result.length < 1) {
				//No results found
				$scope.noMatchFound = true;
				var noRecords = {value: $translate.instant('No matches found.'), module: {}, count: 0};
				result.push(noRecords);
			}
			$webapp.busy(false);
			return result;
		});
	}
}
