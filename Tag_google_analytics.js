var tagAnalyticsCNIL = {}

tagAnalyticsCNIL.CookieConsent = function () {
	function showBanner() {
		var bodytag = document.getElementsByTagName('body')[0];
		var div = document.createElement('div');
		div.setAttribute('id', 'cookie-banner');
		div.setAttribute('width', '70%');
		div.innerHTML = '<div style="background-color:#eee;text-align:center;padding:5px;font-size:12px;border-bottom:1px solid #eeeeee;" id="cookie-banner-message" align="center">Ce site utilise Google Analytics.\
		En continuant à naviguer, vous nous autorisez à déposer un cookie à des fins de \
		mesure d\'audience. \
		<a href="javascript:tagAnalyticsCNIL.CookieConsent.showInform()" style="text-decoration:underline;"> En savoir plus ou s\'opposer</a>.</div>';
		bodytag.insertBefore(div, bodytag.firstChild);
		document.getElementsByTagName('body')[0].className += ' cookiebanner';
		createInformAndAskDiv();
	}

	function createInformAndAskDiv() {
		var bodytag = document.getElementsByTagName('body')[0];
		var div = document.createElement('div');
		div.setAttribute('id', 'inform-and-ask');
		div.style.width = window.innerWidth + "px";
		div.style.height = window.innerHeight + "px";
		div.style.display = "none";
		div.style.position = "fixed";
		div.style.zIndex = "100000";
		div.style.backgroundColor = "rgba(0,0,0,.35)"
		div.innerHTML = '<div style="width: 300px; background-color: white; repeat scroll 0% 0% white; border: 1px solid #cccccc; padding :10px 10px;text-align:center; position: fixed; top:30px; left:50%; margin-top:0px; margin-left:-150px; z-index:100000; opacity:1" id="inform-and-consent">\
		<div><span><b>Les cookies Google Analytics</b></span></div><br><div>Ce site utilise  des cookies de Google Analytics,\
		ces cookies nous aident à identifier le contenu qui vous intéresse le plus ainsi qu\'à repérer certains \
		dysfonctionnements. Vos données de navigations sur ce site sont envoyées à Google Inc</div><div style="padding :10px 10px;text-align:center;"><button style="margin-right:50px;" class="btn-mat btn-small orange" \
		name="S\'opposer" onclick="tagAnalyticsCNIL.CookieConsent.gaOptout();tagAnalyticsCNIL.CookieConsent.hideInform();" id="optout-button" >S\'opposer</button><button class="btn-mat btn-small cyan" name="cancel" onclick="tagAnalyticsCNIL.CookieConsent.hideInform()" >Accepter</button></div></div>';
		bodytag.insertBefore(div, bodytag.firstChild);
	}



	function isClickOnOptOut(evt) {
		return (evt.target.parentNode.id == 'cookie-banner' || evt.target.parentNode.parentNode.id == 'cookie-banner' || evt.target.id == 'optout-button')
	}

	function consent(evt) {
		if (!isClickOnOptOut(evt)) {
			if (!clickprocessed) {
				evt.preventDefault();
				clickprocessed = true;
				window.setTimeout(function () {
					evt.target.click();
				}, 1000)
			} else {
				document.removeEventListener("click", consent, false);
			}
		}
	}


	return {
		gaOptout: function () {
			var div = document.getElementById('cookie-banner');
			clickprocessed = true;
			if (div != null) div.innerHTML = '<div style="background-color:#fff;text-align:center;padding:5px;font-size:12px;border-bottom:1px solid #eeeeee;" id="cookie-message"> Vous vous êtes opposé \
			au dépôt de cookies de mesures d\'audience dans votre navigateur </div>'
		},

		showInform: function () {
			var div = document.getElementById("inform-and-ask");
			div.style.display = "";
		},

		hideInform: function () {
			var div = document.getElementById("inform-and-ask");
			div.style.display = "none";
			var div = document.getElementById("cookie-banner");
			div.style.display = "none";
		},

		start: function () {
			if (window.addEventListener) {
				window.addEventListener("load", showBanner, false);
				document.addEventListener("click", consent, false);
			} else {
				window.attachEvent("onload", showBanner);
				document.attachEvent("onclick", consent);
			}
		}
	}
}();

tagAnalyticsCNIL.CookieConsent.start();