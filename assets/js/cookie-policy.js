// JavaScript Document
// Include at the bottom of your HTML

// Define the name of your cookie and the ID of your bar
var cookieName = "myCookieName";
var policyBarId = "myCookieBarId";

// Style myCookieBarId to be hidden on load, and then to appear when the class "active" is added to it.
// Your "Yes" function should call acceptCookie() below.


function showCookiePolicy () {
	
	var agreed = getCookie(cookieName);
	console.log("agreed: ", agreed);
	
	if (agreed !== "true") {
		setTimeout(function() {
			var policy = document.getElementById(policyBarId);
			// policy.style.display = "block";
			policy.classList.add("active");
		}, 1500); 
	}
	
}

function acceptCookie () {
	
	// Hide the overlay
	var policy = document.getElementById(policyBarId);
	policy.classList.remove("active");
	
	setCookie(cookieName, "true", 30);
	
}

function resetCookie() {
	setCookie(cookieName, "false", 7);
}

/* ----- COOKIE FUNCTIONS ----- */
function setCookie(c_name,value,exdays)
{
	var exdate=new Date();
	exdate.setDate(exdate.getDate() + exdays);
	var c_value=escape(value);// + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
	document.cookie=c_name + "=" + c_value + ";path=/";
	// alert("cookie set to " + value);
}

function getCookie(c_name)
{
	var i,x,y,ARRcookies=document.cookie.split(";");
	for (i=0;i<ARRcookies.length;i++)
	{
		x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
		y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
		x=x.replace(/^\s+|\s+$/g,"");
		if (x==c_name)
		{
			return unescape(y);
		}
	}
	
	return "";
}




showCookiePolicy();