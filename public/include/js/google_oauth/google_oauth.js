var clientId = '537691637054-0haq9hqsq1q3rplj90ajvpff4bp3otlk.apps.googleusercontent.com';
var apiKey = 'AIzaSyB5JZFGBibhcW8yjEM01qXv93TCBIjbruk';
var scopes = 'https://www.googleapis.com/auth/plus.me';

function handleClientLoad() {
	gapi.client.setApiKey(apiKey);
	window.setTimeout(checkAuth,1);
}
function checkAuth() {
	gapi.auth.authorize({client_id: clientId, scope: scopes, immediate: true}, handleAuthResult);
}
function handleAuthResult(authResult) {
	if (authResult && !authResult.error) {
		makeApiCall();
    }else{
        alert('Can not Sign In Google, Please try again!');
    }
}
function handleAuthClick(event) {
	gapi.auth.authorize({client_id: clientId, scope: scopes, immediate: false}, handleAuthResult);
	return false;
}
// Load the API and make an API call.  Display the results on the screen.
function makeApiCall() {
	gapi.client.load('plus', 'v1', function() {
		var request = gapi.client.plus.people.get({
			'userId': 'me'
		});
		request.execute(function(resp) {
			//var resultJson = JSON.stringify(resp.result);
            //console.log(resultJson);
            sendGoogleAccoundInfo(resp.result);
			/*var heading = document.createElement('h4');
			var image = document.createElement('img');
			image.src = resp.image.url;
			heading.appendChild(image);
			heading.appendChild(document.createTextNode(resp.displayName));
			document.getElementById('content').appendChild(heading);*/
		});
	});
}

function sendGoogleAccoundInfo(results){
    $.ajax({
           url: configObject.GoogleSignInBack,
           type: "POST",
           data: results,
           dataType: 'JSON',
           async: false,
           success: function(rs){
               console.log(rs);
           },
           error: function(rs){
               console.log(rs);
           }
    });
}