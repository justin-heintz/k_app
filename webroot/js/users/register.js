window.onload = function(){
	els = document.querySelectorAll('.sm-logos div');
	console.log(els);

	els.forEach(function(el){
			console.log(el)
			el.addEventListener("click", function(l){
				this.classList.toggle('activated')
			
		});		


	});
}



