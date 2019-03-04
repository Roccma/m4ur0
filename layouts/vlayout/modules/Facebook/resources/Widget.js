
window.onload = function(){

	let loaded 		= false;
	let pageIndex 	= 0;
	let recordId;

	let MESSAGE_TIMEOUT = 3000;
	if( !!document.getElementById('quickBtnResponse') ){
		document.getElementById('quickBtnResponse').addEventListener('click',function(evt){
			evt.preventDefault();
			let quickResponse = this.getAttribute('quickResponse');

			let txt 	= document.getElementById(!!quickResponse? 'quickMessageText' : 'messageText').value;
			recordId 	= this.getAttribute('entityid');
			let params 	= {
				module : 'Facebook',
				action : 'PostMessages',
				record : recordId,
				message : txt
			}
			this.disabled = true;
			document.getElementById(!!quickResponse? 'quickMessageText' : 'messageText').value = "";

			!!quickResponse ? Vtiger_Helper_Js.showMessage({type:'info',text:'Enviando mensaje...'}) : showMessage("Enviando mensaje...");

			AppConnector.request(params).then(response => {
				console.log(response);
				if(response.success){				
					if( !quickResponse ){
						showMessage('Mensaje enviado satisfactoriamente',true);
						addRow(response.result,false);	
						//Hago el focus en el nuevo mensaje enviado
						window.location.hash = "#"+document.getElementById('tbodyChat').childNodes[document.getElementById('tbodyChat').childNodes.length - 1].id;
					}else{
						Vtiger_Helper_Js.showMessage({type:'info',text:'Mensaje enviado satisfactoriamente'});
					}
				}else{
					if (quickResponse) 
						Vtiger_Helper_Js.showMessage({type:'error',text:'Error al enviar el mensaje'});
					else
						showMessage('Error al enviar el mensaje',true,'error');
				}
				this.disabled = false;
			})
		})
	}

	document.getElementById('btnResponse').addEventListener('click',function(evt){
		evt.preventDefault();
		let quickResponse = this.getAttribute('quickResponse');

		let txt 	= document.getElementById(!!quickResponse? 'quickMessageText' : 'messageText').value;
		recordId 	= this.getAttribute('entityid');
		let params 	= {
			module : 'Facebook',
			action : 'PostMessages',
			record : recordId,
			message : txt
		}
		this.disabled = true;
		document.getElementById(!!quickResponse? 'quickMessageText' : 'messageText').value = "";

		!!quickResponse ? Vtiger_Helper_Js.showMessage({type:'info',text:'Enviando mensaje...'}) : showMessage("Enviando mensaje...");

		AppConnector.request(params).then(response => {
			console.log(response);
			if(response.success){				
				if( !quickResponse ){
					showMessage('Mensaje enviado satisfactoriamente',true);
					addRow(response.result,false);	
					//Hago el focus en el nuevo mensaje enviado
					window.location.hash = "#"+document.getElementById('tbodyChat').childNodes[document.getElementById('tbodyChat').childNodes.length - 1].id;
				}else{
					Vtiger_Helper_Js.showMessage({type:'info',text:'Mensaje enviado satisfactoriamente'});
				}
			}else{
				if (quickResponse) 
					Vtiger_Helper_Js.showMessage({type:'error',text:'Error al enviar el mensaje'});
				else
					showMessage('Error al enviar el mensaje',true,'error');
			}
			this.disabled = false;
		})
	})

	if ( !!document.getElementById('botonModal') ){
		document.getElementById('botonModal').addEventListener('click',function(evt){
			recordId = this.getAttribute('entityid');
			loadModal(recordId);
		})
	}

	document.getElementById('btnLoadMessage').addEventListener('click', evt => {
		evt.preventDefault();
		if (!recordId) recordId = document.getElementById('recordId').value;
		loadModal(recordId);
	})

	function loadModal(recordId){
		if ( loaded ) return;
		let params = {
			'module' : 'Facebook',
			'action' : 'RelatedMessages',
			'record'  : recordId,
			'page'	: pageIndex
		};

		showMessage("Obteniendo mensajes");

	    AppConnector.request(params).then(function(response){	 
	    	console.log(response);
	    	if( response.success ){
	    		if (response.data.length == 0){	    			
	    			document.getElementById('btnLoadMessage').disabled = loaded = true;
	    		}else{
	    			response.data.reverse().forEach(el => addRow(el));
	    			pageIndex++;
	    		}
	    	}
	    	hideMessage();
	    	document.getElementById('dashChartLoader') && (document.getElementById('dashChartLoader').style.display = 'none');
	    });
	    //loaded = true;

	}
	function addRow(data,prepend = true){
		console.log("Agregando fila",data);	
		let body 		= document.getElementById('tbodyChat');
		let row 		= document.createElement('div');
		let container	= document.createElement('div');
		let title 		= document.createElement('h4');
		let msg 		= document.createElement('p');
		let date 		= document.createElement('p');

		let hr 			= document.createElement('hr');


		row.id 			= data.id;	//asigno la data a el row
		row.__data__ 	= data;

		title.innerHTML 	= data.sender;
		msg.innerHTML 		= data.message;
		date.textContent 	= data.date;	

		container.appendChild(title);
		container.appendChild(hr);
		container.appendChild(msg);
		container.appendChild(date);

		container.classList.add('alert');
		container.classList.add('message');
		container.classList.add(data.sender == 'Yo' ? 'alert-info' : 'alert-primary');
		container.classList.add('span6');

		date.classList.add('message-date');

		if( data.sender == 'Yo' ){
			container.style.float = 'right';
		}

		row.classList.add('row-fluid');

		row.appendChild(container);

		body.appendChild(row);
		if ( prepend ) body.insertBefore(row,body.childNodes[0]);
	}

	function _addRow(data){
		console.log("Agregando fila",data);	
		let row 		= document.createElement('tr');
		let col1 		= document.createElement('td');
		let col2 		= document.createElement('td');


		row.id 			= data.id;	//asigno la data a el row
		row.__data__ 	= data;

		col1.textContent = data.sender+":";
		col2.textContent = data.message;	

		row.appendChild(col1);
		row.appendChild(col2);

		//col2.className = data.sender == 'Yo' ? "message-self" : "message-other";

		document.getElementById('tbodyChat').appendChild(row);
	}

	function showMessage(text,hide = false,type = 'info'){
		let msg = document.getElementById("divInfo");
		let txt = document.getElementById("infoText");
		txt.innerHTML 	= text;

		msg.firstElementChild.classList.add(type == 'info'? 'alert-info' : 'alert-error');
		msg.firstElementChild.classList.remove(type !== 'info'? 'alert-info' : 'alert-error');

		jQuery(msg).show('fade')
		if( hide ){
			setTimeout(() => {
				jQuery(msg).hide('fade')
			},MESSAGE_TIMEOUT);
		}else{		
		}
	}
	function hideMessage(){
		jQuery(document.getElementById('divInfo')).hide('fade');
	}
}