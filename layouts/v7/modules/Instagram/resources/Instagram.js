Vtiger_Index_Js("Instagram_Index_Js",{


	registerEventLoginButton(){
		document.getElementById('loginButton').addEventListener('click', (evt) => {
			jQuery.ajax({
				method : 'GET',
				url : 'insta_redirect.php',
				success : function (response){
					console.log(response);
					location.href = response; 
				},
				error : function(error){
					console.log(error);
				}
			})
		})
	},

	saveAjax(){
		let params  = location.search;
		let split	= params.split("&");
		let indexes = {};
		split.forEach(el => {
			indexes[el.split("=").shift()] = el.split("=").pop();
		})
		if(indexes['access_token'] && indexes['id']){
			console.log(indexes);
		}
	},

	registerEvents : function() {
		this.registerEventLoginButton();
		this.saveAjax();
		return this;
	}
});
