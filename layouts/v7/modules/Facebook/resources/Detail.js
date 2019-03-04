/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

Vtiger_Detail_Js("Facebook_Detail_Js",{},{
	
	hasComments : 0,	//Variable que indica si hay comentarios para cargar
	hasLikes	: 0,	//Variable que indica si hay likes para cargar

	/**
	*	
	*/
	getPostData : function(){
		let recordId = this.getRecordId();
		let params 	= {
			module : 'Facebook',
			action : 'getPostData',
			record : recordId
		}
		AppConnector.request(params).then(response => {
			console.log(response);
			if(response.success){
				let data = response.result;
				document.getElementById('postText').innerHTML = data.message;
				if(data.image){
					document.getElementById('postImage').src  = data.image;
					document.getElementById('postImage').style.display = "";
				}
				if(data.shares ){
					//Agregar un contador de Compartidos
				}
			}else{
				Vtiger_Helper_Js.showMessage({type:'error',text:'No se pudieron obtener los datos del Post'});
			}
		}, error => {console.log(error)});
	},

	getComments : function(){
		if ( this.hasComments === true) return;

		let recordId = this.getRecordId();
		let params 	= {
			module : 'Facebook',
			action : 'RelatedForPost',
			record : recordId,
			type   : 'Comentario',
			page   : this.hasComments
		}
		AppConnector.request(params).then(response => {
			console.log(response);
			if(response.success){
				if(response.result.length == 0){
					document.getElementById('loadComments').disabled = this.hasComments = true;
				}else{
					response.result.forEach(el => this.addComment(el));
					this.hasComments++;
				}
			}else{
				Vtiger_Helper_Js.showMessage({type:'error',text:'No se pudieron obtener los comentarios del Post'});
			}
			document.getElementById('commentContainer').getElementsByClassName('imageHolder')[0].style.display = "none"; //Escondo el loader
		}, error => {console.log(error)});
	},

	getLikes : function(){
		if ( this.hasLikes === true) return;

		let recordId = this.getRecordId();
		let params 	= {
			module : 'Facebook',
			action : 'RelatedForPost',
			record : recordId,
			type   : 'Like',
			page  	: this.hasLikes
		}
		AppConnector.request(params).then(response => {
			console.log(response);
			if(response.success){
				if(response.result.length == 0){
					document.getElementById('loadLikes').disabled = this.hasLikes = true;
				}else{
					response.result.forEach(el => this.addLike(el));
					this.hasLikes++;
				}
			}else{
				Vtiger_Helper_Js.showMessage({type:'error',text:'No se pudieron obtener los Likes del Post'});
			}
			document.getElementById('likeContainer').getElementsByClassName('imageHolder')[0].style.display = "none"; //Escondo el loader
					
		}, error => {console.log(error)});
	},


	addComment : function (data){
		console.log("Nuevo Comentario",data);
		let container 	= document.getElementById('commentContainer');
		let newElement 	= document.createElement('div');
		let h4 			= document.createElement('h4');
		let p 			= document.createElement('p');
		let i 			= document.createElement('i');
		h4.innerHTML	= data.sender;
		p.innerHTML 	= data.message;
		i.innerHTML 	= data.date;

		newElement.classList.add('span4');

		container.appendChild(h4);
		container.appendChild(p);
		container.appendChild(i);

		container.appendChild(newElement);
		container.insertBefore(newElement, container.childNodes[0]);
	},

	addLike : function (data){
		console.log("Nuevo Like",data);
		let container 	= document.getElementById('likeContainer');
		let newElement 	= document.createElement('div');
		let h4 			= document.createElement('h4');
		let i 			= document.createElement('i');
		h4.innerHTML	= data.sender;
		i.innerHTML 	= data.date;

		container.appendChild(h4);
		container.appendChild(i);

		container.appendChild(newElement);
		container.insertBefore(newElement, container.childNodes[0]);
	},

	registerLoadLikesEvent : function(){
		document.getElementById('loadLikes').addEventListener('click', (evt) => {
			evt.preventDefault();
			document.getElementById('likeContainer').getElementsByClassName('imageHolder')[0].style.display = "";
			this.getLikes();
		})
	},

	registerLoadCommentsEvent : function (){
		document.getElementById('loadComments').addEventListener('click', (evt) => {
			evt.preventDefault();
			document.getElementById('commentContainer').getElementsByClassName('imageHolder')[0].style.display = "";
			this.getComments();
		})		
	},

	/**
	 * Function which will register all the events
	 */
    registerEvents : function() {
		var form = this.getForm();
		this._super();
		if( !document.getElementById('isMessage') ){
			this.getPostData();
			this.getComments();
			this.getLikes();

			this.registerLoadLikesEvent();
			this.registerLoadCommentsEvent();

			let el = document.body.childNodes[document.body.childNodes.length -1 ]; //Escondo el loader ese que nose porque aparecio
			if ( el.classList.contains('imageHolder') ) el.style.display = "none";
		}
	}
})