<script>
window.fbAsyncInit = function() {
	FB.init({
		appId      : '272436377626267',
		cookie     : true,
		xfbml      : true,
		version    : 'v10.0'
	});
	FB.AppEvents.logPageView();   
};

(function(d, s, id){
var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) {return;}
	js = d.createElement(s); js.id = id;
	js.src = "https://connect.facebook.net/en_US/sdk.js";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

function statusChangeCallback(response) {
	if (response.status === 'connected') {
		document.getElementById('fb-login').style.display = "none";
		testAPI();  
	}else{
		document.getElementById('fb-login').style.display = "block";
	}
}

function checkLoginState() {
	FB.getLoginStatus(function(response) {
		statusChangeCallback(response);
	});
}

function testAPI() {
	FB.api('/me', function(response) {
		document.getElementById('status').innerHTML = 'Thanks for logging in, ' + response.name + '!';
		document.getElementById('status').innerHTML += '<br><div id="fb-logout">LOG OUT OF FB</div>';
		
		document.getElementById('fb-logout').addEventListener('click',function(e){
			FB.logout(function(response) { 
				document.getElementById('status').innerHTML = '';
				document.getElementById('fb-logout').style.display = "none";
				document.getElementById('fb-login').style.display = "block";
			});
		});
		
	});
}


window.onload = function(){ 
	FB.getLoginStatus(function(response) {
		console.log( response );
		statusChangeCallback(response);
	});
 };
</script>


<style>
#fb-logout{width:150px;padding:5px; text-align:center; color:#fff; border:1px solid #000; background:#00a400; cursor:pointer;}
#fb-logout:hover{background:#8fdc33;}
</style>

<div id="status"></div>

<fb:login-button id="fb-login"
  scope="public_profile,email"
  onlogin="checkLoginState();">
</fb:login-button>

