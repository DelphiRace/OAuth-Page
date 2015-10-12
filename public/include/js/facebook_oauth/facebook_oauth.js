window.fbAsyncInit = function() {
	FB.init({
		appId      : '1249539155071484',
        status     : true,
		xfbml      : true,
        oauth: true,
		version    : 'v2.5'
	});  
};

// Load the SDK asynchronously
(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/en_US/sdk.js";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

function checkFacebookLoginState() {
    FB.login(function (response) {
        checkFBStatus()
    });
}

function checkFBStatus(){
    FB.getLoginStatus(function(response) {
        if (response.status === 'connected') {
            // Logged into your app and Facebook.
            //console.log(response);
            sendFacebookAccoundInfo(response);
        }else{
            alert('Can Not Login Your Facebook, Please Try Again!');
        }
    //testAPI();
    });

}

function sendFacebookAccoundInfo(response){
    $.ajax({
           url: configObject.FacebookSignInBack,
           type: "POST",
           data: response,
           dataType: 'JSON',
           async: false,
           success: function(rs){
			   //console.log(rs);
               redirectPage(rs);
           }
    });
}