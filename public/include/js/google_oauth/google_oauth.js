var clientId = '537691637054-0haq9hqsq1q3rplj90ajvpff4bp3otlk.apps.googleusercontent.com';
var apiKey = 'AIzaSyB5JZFGBibhcW8yjEM01qXv93TCBIjbruk';
var scopes = 'https://www.googleapis.com/auth/plus.me';

function handleClientLoad() {
	gapi.client.setApiKey(apiKey);
	window.setTimeout(checkAuth,1);
}

function checkAuth() {
	gapi.auth.authorize({client_id: clientId, scope: scopes, immediate: false}, handleAuthResult);
}

function handleAuthResult(authResult) {
	if (authResult && !authResult.error) {
		sendGoogleAccoundInfo(authResult);
    }else{
        alert('Can not Sign In Google, Please try again!');
    }
}

function sendGoogleAccoundInfo(results){
    $.ajax({
           url: configObject.GoogleSignInBack,
           type: "POST",
           data: results,
           dataType: 'JSON',
           async: false,
           success: function(rs){
               redirectPage(rs);
           }
    });
}