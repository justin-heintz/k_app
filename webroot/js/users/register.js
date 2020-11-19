window.onload = function(){
	els = document.querySelectorAll('.sm-logos div');
	els.forEach(function(e){
		console.log( e.lastElementChild.value )
	});
}



