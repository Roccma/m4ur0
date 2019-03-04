jQuery.Class("Facebook_Index_Js",{

	addRow(data){
		let row 		= document.createElement('tr');
		let col1 		= document.createElement('td');
		let col2 		= document.createElement('td');
		let col3 		= document.createElement('td');
		let action 		= document.createElement('td');
		let chk 		= document.createElement('input');


		row.id 			= data.id;	//asigno la data a el row
		row.__data__ 	= data;

		col1.textContent = data.id;
		col2.textContent = data.name;
		col3.textContent = data.category;

		chk.type 		 = 'checkbox';
		chk.checked 	 = true;
		
		action.appendChild(chk);

		row.appendChild(col1);
		row.appendChild(col2);
		row.appendChild(col3);
		row.appendChild(action);

		document.getElementById('bodyFacebook').appendChild(row);
	},
	loadPages(){
		FB.api('/me?fields=accounts', response => {
			console.log(response);
			if(response && response.accounts){
				Vtiger_Helper_Js.showMessage({"text":"Se obtuvieron las paginas correctamente. Cantidad: " + response.accounts.data.length});
				response.accounts.data.forEach(page => this.addRow(page));
			}
		})
	}
},{	
	
	_appid : '147685465712005',

	loadScripts(){
		let thisInstance = this;
		(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = 'https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.12&appId='+thisInstance._appid;
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	},

	registerEventSaveButton(){
		document.getElementById('saveButton').addEventListener('click', (evt) => {
			let body = document.getElementById('bodyFacebook');
			let rows = body.getElementsByTagName('tr');
			for(let i = 0;i< rows.length;i++){
				if(rows[i].getElementsByTagName('input')[0].checked){

					this.save(rows[i].__data__);
				}
			}
		})
	},

	save(data){
		let params = {
			'module' : 'FacebookPage',
			'action' : 'SaveAjax',
			'datos'  : data
		};

	    AppConnector.request(params).then(function(response){
	    	console.log(response);
	    	Vtiger_Helper_Js.showMessage({"text":"Página guardada correctamente"});
	    });
	},

	registerEvents : function() {
		this.loadScripts();
		this.registerEventSaveButton();
		return this;
	}
});
