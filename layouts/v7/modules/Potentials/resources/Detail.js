/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

 Vtiger_Detail_Js("Potentials_Detail_Js",{

	//cache will store the convert Potential data(Model)
	cache : {},

	//Holds detail view instance
	detailCurrentInstance : false,

	/*
	 * function to trigger Convert Potential action
	 * @param: Convert Potential url, currentElement.
	 */
	 convertPotential : function(convertPotentialUrl, buttonElement) {
	 	var instance = Potentials_Detail_Js.detailCurrentInstance;
		//Initially clear the elements to overwtite earliear cache
		instance.convertPotentialContainer = false;
		instance.convertPotentialForm = false;
		instance.convertPotentialModules = false;
		if(jQuery.isEmptyObject(Potentials_Detail_Js.cache)) {
			app.request.get({"url": convertPotentialUrl}).then(function (err, data) {
				if(data) {
					Potentials_Detail_Js.cache = data;
					instance.displayConvertPotentialModel(data, buttonElement);
				}
			},
			function(error,err){

			}
			);
		} else {
			instance.displayConvertPotentialModel(Potentials_Detail_Js.cache, buttonElement);
		}
	}
},{

	//Contains the convert Potential form
	convertPotentialForm : false,

	//contains the convert Potential container
	convertPotentialContainer : false,

	//contains all the checkbox elements of modules
	convertPotentialModules : false,

	detailViewRecentContactsLabel : 'Contacts',
	detailViewRecentProductsTabLabel : 'Products',

	//constructor
	init : function() {
		this._super();
		Potentials_Detail_Js.detailCurrentInstance = this;
	},

	/*
	 * function to get Convert Potential Form
	 */
	 getConvertPotentialForm : function() {
	 	if(this.convertPotentialForm == false) {
	 		this.convertPotentialForm = jQuery('#convertPotentialForm');
	 	}
	 	return this.convertPotentialForm;
	 },

	/*
	 * function to get Convert Potential Container
	 */
	 getConvertPotentialContainer : function() {
	 	if(this.convertPotentialContainer == false) {
	 		this.convertPotentialContainer = jQuery('#potentialAccordion');
	 	}
	 	return this.convertPotentialContainer;
	 },

	/*
	 * function to get all the checkboxes which are representing the modules selection
	 */
	 getConvertPotentialModules : function() {
	 	var container = this.getConvertPotentialContainer();
	 	if(this.convertPotentialModules == false) {
	 		this.convertPotentialModules = jQuery('.convertPotentialModuleSelection', container);
	 	}
	 	return this.convertPotentialModules;
	 },

	/*
	 * function to disable the Convert Potential button
	 */
	 disableConvertPotentialButton : function(button) {
	 	jQuery(button).attr('disabled','disabled');
	 },

	/*
	 * function to enable the Convert Potential button
	 */
	 enableConvertPotentialButton : function(button) {
	 	jQuery(button).removeAttr('disabled');
	 },

	/*
	 * function to enable all the input and textarea elements
	 */
	 removeDisableAttr : function(moduleBlock) {
	 	moduleBlock.find('input,textarea,select').removeAttr('disabled');
	 },

	/*
	 * function to disable all the input and textarea elements
	 */
	 addDisableAttr : function(moduleBlock) {
	 	moduleBlock.find('input,textarea,select').attr('disabled', 'disabled');
	 },

	/*
	 * function to display the convert Potential model
	 * @param: data used to show the model, currentElement.
	 */
	 displayConvertPotentialModel : function(data, buttonElement) {
	 	var instance = this;
	 	var errorElement = jQuery(data).find('#convertPotentialError');
	 	if(errorElement.length != '0') {

	 	} else {
	 		var callBackFunction = function(data){
	 			var editViewObj = Vtiger_Edit_Js.getInstance();
	 			jQuery(data).find('.fieldInfo').collapse({
	 				'parent': '#potentialAccordion',
	 				'toggle' : false
	 			});
	 			app.helper.showVerticalScroll(jQuery(data).find('#potentialAccordion'), {'setHeight': '350px'});
	 			editViewObj.registerBasicEvents(data);
	 			var checkBoxElements = instance.getConvertPotentialModules();
	 			jQuery.each(checkBoxElements, function(index, element){
	 				instance.checkingModuleSelection(element);
	 			});
	 			instance.registerForReferenceField();
	 			instance.registerConvertPotentialEvents();
	 			instance.registerConvertPotentialSubmit();
	 		}
	 		app.helper.showModal(data, {"cb": callBackFunction});
	 	}
	 },

	/*
	 * function to check which module is selected 
	 * to disable or enable all the elements with in the block
	 */
	 checkingModuleSelection : function(element) {
	 	var instance = this;
	 	var module = jQuery(element).val();
	 	var moduleBlock = jQuery(element).closest('.accordion-group').find('#'+module+'_FieldInfo');
	 	if(jQuery(element).is(':checked')) {
	 		instance.removeDisableAttr(moduleBlock);
	 	} else {
	 		instance.addDisableAttr(moduleBlock);
	 	}
	 },

	 registerForReferenceField : function() {
	 	var container = this.getConvertPotentialContainer();
	 	var referenceField = jQuery('.reference', container);
	 	if(referenceField.length > 0) {
	 		jQuery('#ProjectModule').attr('readonly', 'readonly');
	 	}
	 },

	/*
	 * function to register Convert Potential Events
	 */
	 registerConvertPotentialEvents : function() {
	 	var container = this.getConvertPotentialContainer();
	 	var instance = this;

		//Trigger Event to change the icon while shown and hidden the accordion body 
		container.on('click', '.accordion-group', function (e) { 
			var currentElement = jQuery(e.currentTarget).find('.Project_faAngle');
			if (jQuery('.Project_FieldInfo').hasClass('in')) {
				currentElement.removeClass('fa-angle-up');
				currentElement.addClass('fa-angle-down');
			} else {
				currentElement.removeClass('fa-angle-down');
				currentElement.addClass('fa-angle-up');
			}
		});

		//Trigger Event on click of the Modules selection to convert the lead 
		container.on('click','.convertPotentialModuleSelection', function(e){
			var currentTarget = jQuery(e.currentTarget);
			var currentModuleName = currentTarget.val();
			var moduleBlock = currentTarget.closest('.accordion-group').find('#'+currentModuleName+'_FieldInfo');

			if(currentTarget.is(':checked')) {
				moduleBlock.collapse('show');
				instance.removeDisableAttr(moduleBlock);
			} else {
				moduleBlock.collapse('hide');
				instance.addDisableAttr(moduleBlock);
			}
			e.stopImmediatePropagation();
		});
	},

	/*
	 * function to register Convert Potential Submit Event
	 */
	 registerConvertPotentialSubmit : function() {
	 	var thisInstance = this;
	 	var formElement = this.getConvertPotentialForm();
	 	var params = {
	 		"ignore": "disabled",
	 		submitHandler: function (form) {
	 			var convertPotentialModuleElements = thisInstance.getConvertPotentialModules();
	 			var moduleArray = [];
	 			var projectModel = formElement.find('#ProjectModule');

	 			jQuery.each(convertPotentialModuleElements, function(index, element) {
	 				if(jQuery(element).is(':checked')) {
	 					moduleArray.push(jQuery(element).val());
	 				}
	 			});
	 			formElement.find('input[name="modules"]').val(JSON.stringify(moduleArray));

	 			var projectElement = projectModel.length;

	 			if(projectElement != '0') {
	 				if(jQuery.inArray('Project',moduleArray) == -1) {
	 					app.helper.showErrorNotification({message:app.vtranslate('JS_SELECT_PROJECT_TO_CONVERT_LEAD')});
	 					return false;
	 				} 
	 			}
	 			return true;
	 		}
	 	}
	 	formElement.vtValidate(params);
	 },

	 vaciarCampo: function(campo, record) {
	 	var params = {
	 		'module' : 'Potentials',
	 		'record' : record,
	 		'action' : 'SaveAjax',
	 		'field' : campo,
	 		'value' : '',
	 	};

	 	AppConnector.request(params).then(
	 		function(data) {
	 			console.log(data);
	 		},function(err, error) {
	 		});

	 },

	 eventosCampos: function() {
	 	var thisInstance = this;
		// seleccion de campos
		var oportunitytype = $('#Potentials_detailView_fieldValue_opportunity_type');
		var oprecovery = $('#Potentials_detailView_fieldValue_oprecovery');
		var oprecoveryother = $('#Potentials_detailView_fieldValue_oprecoveryother');
		var oprecoverycompasation = $('#Potentials_detailView_fieldValue_oprecoverycompensation');
		var opmotperdida = $('#Potentials_detailView_fieldValue_opmotperdida');
		var opmotperdidaotros = $('#Potentials_detailView_fieldValue_opmotperdidaotros');
		//guardamos el id de la oportunidad
		var record = $('#recordId').val();
		//sacamos la clase editAction al lapiz para no dejar editar
		oprecovery.children().last().children().first().removeClass('editAction');
		oprecoveryother.children().last().children().first().removeClass('editAction');
		oprecoverycompasation.children().last().children().first().removeClass('editAction');
		opmotperdidaotros.children().last().children().first().removeClass('editAction');
		//consultamos si el campo tipo de oportunidad es recovery y habilitar el editar de los 
		// campos Razón de Solicitud de Cancelación y Compensaciones
		if(oportunitytype.children().first().children().first().text().replace(/ /g,'').replace(/\n/g,'') === 'Recovery' || oportunitytype.children().first().children().first().text().replace(/ /g,'').replace(/\n/g,'') === 'Recuperación'){
			oprecovery.children().last().children().first().addClass('editAction');
			oprecoverycompasation.children().last().children().first().addClass('editAction');
		}
		//consultamos si el campo Razón de Solicitud de Cancelación es otro y habilitar el editar del 
		// campo Razon de cancelacion otros
		if (oprecovery.children().first().children().first().text().replace(/ /g,'').replace(/\n/g,'') === 'Other' || oprecovery.children().first().children().first().text().replace(/ /g,'').replace(/\n/g,'') === 'Otro') {
			oprecoveryother.children().last().children().first().addClass('editAction');
		}
		//consultamos si el campo Motivo de Perdida es otros y habilitar el editar del 
		// campo Motivo de Perdida Otros
		if (opmotperdida.children().first().children().first().text().replace(/ /g,'').replace(/\n/g,'') === 'Other' || oprecovery.children().first().children().first().text().replace(/ /g,'').replace(/\n/g,'') === 'Otro' || opmotperdida.children().first().children().first().text().replace(/ /g,'').replace(/\n/g,'') === 'Others' || oprecovery.children().first().children().first().text().replace(/ /g,'').replace(/\n/g,'') === 'Otros') {
			opmotperdidaotros.children().last().children().first().addClass('editAction');
		}
		//control para no asignar el evento varias veces
		var control = [false, false, false];
		//si el lapiz del campo tipo de oportunidad es presionado
		oportunitytype.children().last().children().first().click(function(e) {
			//se controla si el evento ya fue asignado
			if(!control[0]){
				//un delay luego del evento porque se agrega el select
				setTimeout(function() {
					//selecciona el select
					var selectOpType = oportunitytype.children().first().next().children().first().next().children().first();
					//agrega un evento al check
					selectOpType.next().next().children().first().click(function(e) {
						//si es recovery agrega la posibibilidad de editar a ciertos campos
						if(selectOpType.val() === 'Recovery'){
							oprecovery.children().last().children().first().addClass('editAction');
							oprecoverycompasation.children().last().children().first().addClass('editAction');
						}else{
							//si no los quita, vacia los span que contienen los valores y los vacia en la bd
							//queda guardado en el historial de modificaciones
							oprecovery.children().first().children().first().text('\n        \n');
							oprecoveryother.children().first().children().first().text('\n        \n');
							oprecoverycompasation.children().first().children().first().text('\n        \n');
							oprecovery.children().last().children().first().removeClass('editAction');
							oprecoveryother.children().last().children().first().removeClass('editAction');
							oprecoverycompasation.children().last().children().first().removeClass('editAction');
							thisInstance.vaciarCampo('oprecovery', record);
							thisInstance.vaciarCampo('oprecoveryother', record);
							thisInstance.vaciarCampo('oprecoverycompensation', record);
						}
					});
					//coloca el control a true
					control[0] = true;
				}, 100);
			}
		});
		//si el lapiz del campo tipo de oportunidad es presionado
		oprecovery.children().last().children().first().click(function(e) {
			//se controla si el evento ya fue asignado
			if(!control[1]){
				//un delay luego del evento porque se agrega el select
				setTimeout(function() {
					//selecciona el select
					var selectOpRec = oprecovery.children().first().next().children().first().next().children().first();
					//agrega un evento al check
					selectOpRec.next().next().children().first().click(function(e) {
						//si es otros agrega la posibibilidad de editar a ciertos campos
						if(selectOpType.val() == 'Other'){
							oprecoveryother.children().last().children().first().addClass('editAction');
						}else{
							//si no los quita, vacia los span que contienen los valores y los vacia en la bd
							//queda guardado en el historial de modificaciones
							oprecoveryother.children().first().children().first().text('\n        \n');
							oprecoveryother.children().last().children().first().removeClass('editAction');
							thisInstance.vaciarCampo('oprecoveryother', record);
						}
					});
					//coloca el control a true
					control[1] = true;
				}, 100);
			}
		});
		//si el lapiz del campo tipo de oportunidad es presionado
		opmotperdida.children().last().children().first().click(function(e) {
			//se controla si el evento ya fue asignado
			f(!control[2]){
				//un delay luego del evento porque se agrega el select
				setTimeout(function() {
					//selecciona el select
					var selectOpMotPer = opmotperdida.children().first().next().children().first().next().children().first();
					//agrega un evento al check
					selectOpMotPer.next().next().children().first().click(function(e) {
						//si es otros agrega la posibibilidad de editar a ciertos campos
						if(selectOpType.val() == 'Others' || selectOpType.val() == 'Other'){
							oprecoverycompasation.children().last().children().first().addClass('editAction');
						}else{
							//si no los quita, vacia los span que contienen los valores y los vacia en la bd
							//queda guardado en el historial de modificaciones
							opmotperdidaotros.children().first().children().first().text('\n        \n');
							opmotperdidaotros.children().last().children().first().removeClass('editAction');
							thisInstance.vaciarCampo('opmotperdidaotros', record);
						}
					});
					//coloca el control a true
					control[2] = true;
				}, 100);
			}
		});
	},

	/**
	 * Function which will register all the events
	 */
	 registerEvents : function() {
	 	this._super();
	 	var detailContentsHolder = this.getContentHolder();
	 	var thisInstance = this;

	 	detailContentsHolder.on('click','.moreRecentContacts', function(){ 
	 		var recentContactsTab = thisInstance.getTabByLabel(thisInstance.detailViewRecentContactsLabel); 
	 		recentContactsTab.trigger('click'); 
	 	}); 

	 	detailContentsHolder.on('click','.moreRecentProducts', function(){ 
	 		var recentProductsTab = thisInstance.getTabByLabel(thisInstance.detailViewRecentProductsTabLabel); 
	 		recentProductsTab.trigger('click'); 
	 	});
	 	thisInstance.eventosCampos();
	 }
	})