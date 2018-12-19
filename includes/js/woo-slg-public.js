jQuery(document).ready( function($) {	
	
	if ( document.URL.indexOf('code=') != -1 && WOOSlg.fbappid != '' && navigator.userAgent.match('CriOS') ){
		facebookTimer = setInterval(function() {
			if(typeof FB != "undefined")  {
				FB.getLoginStatus(function(response) {
			    	if ( response.status === 'connected') {
						var object = $( 'a.woo-slg-social-login-facebook' );
					  	woo_slg_social_connect( 'facebook', object );
					  	clearInterval( facebookTimer );
				  	}
				}, true);
			}
		} , 300);
	}
	
	// login with facebook
//	$( document ).on( 'click', 'a.woo-slg-social-login-facebook', function() {		
//		var object = $(this);
//		var errorel = $(this).parents('.woo-slg-social-container').find('.woo-slg-login-error');
//		
//		errorel.hide();
//		errorel.html('');
//		
//		if( WOOSlg.fberror == '1' ) {
//			errorel.show();
//			errorel.html( WOOSlg.fberrormsg );
//			return false;
//		} else if( navigator.userAgent.match('CriOS') && WOOSlg.fbappid != '' ) {
//				FB.getLoginStatus(function(response) {
//				 	if( response.status === 'connected' ) {
//				 		woo_slg_social_connect( 'facebook', object );
//				 	} else {
//						var redirect_uri = document.location.href;
//				 		var url = 'https://www.facebook.com/dialog/oauth?client_id='+WOOSlg.fbappid+'&redirect_uri='+redirect_uri+'&scope=email';
//				 		var win =   window.open(url, '_parent' );
//				 	}
//				});
//		} else {
//			FB.login(function(response) {
//			
//				if (response.status === 'connected') {
//				  	//creat user to site
//				  	woo_slg_social_connect( 'facebook', object );
//				}
//			}, {scope:'email'});
//		 }
//	});

        
	
	// login with google+
	$( document ).on( 'click', 'a.woo-slg-social-login-googleplus', function() {
		
		var object = $(this);
		var errorel = $(this).parents('.woo-slg-social-container').find('.woo-slg-login-error');
		
		errorel.hide();
		errorel.html('');
		
		if( WOOSlg.gperror == '1' ) {
			errorel.show();
			errorel.html( WOOSlg.gperrormsg );
			return false;
		} else {
			
			var googleurl = $(this).closest('.woo-slg-social-container').find('.woo-slg-social-gp-redirect-url').val();
			
			if(googleurl == '') {
				alert( WOOSlg.urlerror );
				return false;
			}
			
			var googleLogin = window.open(googleurl, "google_login", "scrollbars=yes,resizable=no,toolbar=no,location=no,directories=no,status=no,menubar=no,copyhistory=no,height=400,width=600");
			var gTimer = setInterval(function () { //set interval for executing the code to popup
				try {
					if (googleLogin.location.hostname == window.location.hostname) { //if login domain host name and window location hostname is equal then it will go ahead
						clearInterval(gTimer);
						googleLogin.close();
						woo_slg_social_connect( 'googleplus', object );
					}
				} catch (e) {}
			}, 500);
		}
	});
	
	// login with linkedin
	$( document ).on( 'click', 'a.woo-slg-social-login-linkedin', function(){
		
		var object = $(this);
		var errorel = $(this).parents('.woo-slg-social-container').find('.woo-slg-login-error');
		
		errorel.hide();
		errorel.html('');
		
		if( WOOSlg.lierror == '1' ) {
			errorel.show();
			errorel.html( WOOSlg.lierrormsg );
			return false;
		} else {
			
			var linkedinurl = $(this).closest('.woo-slg-social-container').find('.woo-slg-social-li-redirect-url').val();
			
			if(linkedinurl == '') {
				alert( WOOSlg.urlerror );
				return false;
			}
			
			var linkedinLogin = window.open(linkedinurl, "linkedin", "scrollbars=yes,resizable=no,toolbar=no,location=no,directories=no,status=no,menubar=no,copyhistory=no,height=400,width=600");
			var lTimer = setInterval(function () { //set interval for executing the code to popup
				try {
					if (linkedinLogin.location.hostname == window.location.hostname) { //if login domain host name and window location hostname is equal then it will go ahead
						clearInterval(lTimer);
						linkedinLogin.close();
						woo_slg_social_connect( 'linkedin', object );
					}
				} catch (e) {}
			}, 300);
		}
	});
	
	// login with twitter
	$( document ).on( 'click', 'a.woo-slg-social-login-twitter', function() {
		
		var object = $(this);
		var errorel = $(this).parents('.woo-slg-social-container').find('.woo-slg-login-error');
		//var redirect_url = $(this).parents('.woo-slg-social-container').find('.woo-slg-redirect-url').val();
		var parents = $(this).parents( 'div.woo-slg-social-container' );
		var appendurl = '';
		
		//check button is clicked form widget
		if( parents.hasClass('woo-slg-widget-content') ) {
			appendurl = '&container=widget';
		}
		
		errorel.hide();
		errorel.html('');
		
		if( WOOSlg.twerror == '1' ) {
			errorel.show();
			errorel.html( WOOSlg.twerrormsg );
			return false;
		} else {
			
			var twitterurl = $(this).closest('.woo-slg-social-container').find('.woo-slg-social-tw-redirect-url').val();
			if( twitterurl == '' ) {
				alert( WOOSlg.urlerror );
				return false;
			}
			
			var twLogin = window.open(twitterurl, "twitter_login", "scrollbars=yes,resizable=no,toolbar=no,location=no,directories=no,status=no,menubar=no,copyhistory=no,height=400,width=600");
			var tTimer = setInterval(function () { //set interval for executing the code to popup
				try {
					if ( twLogin.location.hostname == window.location.hostname ) { //if login domain host name and window location hostname is equal then it will go ahead
						clearInterval(tTimer);
						twLogin.close();
						if( WOOSlg.userid != '' ) {
							woo_slg_social_connect( 'twitter', object );
						} else {
							window.parent.location = WOOSlg.socialloginredirect+appendurl;
						}
					}
				} catch (e) {}
			}, 300);
		}
	});
	
	// login with yahoo
	$( document ).on( 'click', 'a.woo-slg-social-login-yahoo', function() {
		
		var object = $(this);
		var errorel = $(this).parents('.woo-slg-social-container').find('.woo-slg-login-error');
		
		errorel.hide();
		errorel.html('');
		
		if( WOOSlg.yherror == '1' ) {
			errorel.show();
			errorel.html( WOOSlg.yherrormsg );
			return false;
		} else {
			
			var yahoourl = $(this).closest('.woo-slg-social-container').find('.woo-slg-social-yh-redirect-url').val();
			
			if(yahoourl == '') {
				alert( WOOSlg.urlerror );
				return false;
			}
			var yhLogin = window.open(yahoourl, "yahoo_login", "scrollbars=yes,resizable=no,toolbar=no,location=no,directories=no,status=no,menubar=no,copyhistory=no,height=400,width=600");
			var yTimer = setInterval(function () { //set interval for executing the code to popup
				try {
					if (yhLogin.location.hostname == window.location.hostname) { //if login domain host name and window location hostname is equal then it will go ahead
						clearInterval(yTimer);
						yhLogin.close();
						woo_slg_social_connect( 'yahoo', object );
					}
				} catch (e) {}
			}, 300);
		}
	});
	
	// login with foursquare
	$( document ).on( 'click', 'a.woo-slg-social-login-foursquare', function() {
		
		var object = $(this);
		var errorel = $(this).parents('.woo-slg-social-container').find('.woo-slg-login-error');
		
		errorel.hide();
		errorel.html('');
		
		if( WOOSlg.fserror == '1' ) {
			errorel.show();
			errorel.html( WOOSlg.fserrormsg );
			return false;
		} else {
			
			var foursquareurl = $(this).closest('.woo-slg-social-container').find('.woo-slg-social-fs-redirect-url').val();
			
			if(foursquareurl == '') {
				alert( WOOSlg.urlerror );
				return false;
			}
			var fsLogin = window.open(foursquareurl, "foursquare_login", "scrollbars=yes,resizable=no,toolbar=no,location=no,directories=no,status=no,menubar=no,copyhistory=no,height=400,width=600");
			var fsTimer = setInterval(function () { //set interval for executing the code to popup
				try {
					if (fsLogin.location.hostname == window.location.hostname) { //if login domain host name and window location hostname is equal then it will go ahead
						clearInterval(fsTimer);
						fsLogin.close();
						woo_slg_social_connect( 'foursquare', object );
					}
				} catch (e) {}
			}, 300);
		}
	});
	
	// login with windows live
	$( document ).on( 'click', 'a.woo-slg-social-login-windowslive', function() {
		
		var object = $(this);
		var errorel = $(this).parents('.woo-slg-social-container').find('.woo-slg-login-error');
		
		errorel.hide();
		errorel.html('');
		
		if( WOOSlg.wlerror == '1' ) {
			errorel.show();
			errorel.html( WOOSlg.wlerrormsg );
			return false;
		} else {
			
			var windowsliveurl = $(this).closest('.woo-slg-social-container').find('.woo-slg-social-wl-redirect-url').val();
			
			if(windowsliveurl == '') {
				alert( WOOSlg.urlerror );
				return false;
			}
			var wlLogin = window.open(windowsliveurl, "windowslive_login", "scrollbars=yes,resizable=no,toolbar=no,location=no,directories=no,status=no,menubar=no,copyhistory=no,height=400,width=600");
			var wlTimer = setInterval(function () { //set interval for executing the code to popup
				try {
					if (wlLogin.location.hostname == window.location.hostname) { //if login domain host name and window location hostname is equal then it will go ahead
						clearInterval(wlTimer);
						wlLogin.close();
						woo_slg_social_connect( 'windowslive', object );
					}
				} catch (e) {}
			}, 300);
		}
	});
	
	// login with VK.com
	$( document ).on( 'click', 'a.woo-slg-social-login-vk', function(){
		
		var object = $(this);
		var errorel = $(this).parents('.woo-slg-social-container').find('.woo-slg-login-error');
		
		errorel.hide();
		errorel.html('');
		
		if( WOOSlg.vkerror == '1' ) {
			errorel.show();
			errorel.html( WOOSlg.vkerrormsg );
			return false;
		} else {
			
			var vkurl = $(this).closest('.woo-slg-social-container').find('.woo-slg-social-vk-redirect-url').val();
			
			if(vkurl == '') {
				alert( WOOSlg.urlerror );
				return false;
			}
			
			var vkLogin = window.open(vkurl, "vk_login", "scrollbars=yes,resizable=no,toolbar=no,location=no,directories=no,status=no,menubar=no,copyhistory=no,height=400,width=600");
			var vkTimer = setInterval(function () { //set interval for executing the code to popup
				try {
					if (vkLogin.location.hostname == window.location.hostname) { //if login domain host name and window location hostname is equal then it will go ahead
						clearInterval(vkTimer);
						vkLogin.close();
						woo_slg_social_connect( 'vk', object );
					}
				} catch (e) {}
			}, 300);
		}
	});
	
	// login with Instagram
	$( document ).on( 'click', 'a.woo-slg-social-login-instagram', function(){
		
		var object = $(this);
		var errorel = $(this).parents('.woo-slg-social-container').find('.woo-slg-login-error');
		
		errorel.hide();
		errorel.html('');
		
		if( WOOSlg.insterror == '1' ) {
			errorel.show();
			errorel.html( WOOSlg.insterrormsg );
			return false;
		} else {
			
			var instagramurl = $(this).closest('.woo-slg-social-container').find('.woo-slg-social-inst-redirect-url').val();
			
			if(instagramurl == '') {
				alert( WOOSlg.urlerror );
				return false;
			}
			
			var instLogin = window.open(instagramurl, "instagram_login", "scrollbars=yes,resizable=no,toolbar=no,location=no,directories=no,status=no,menubar=no,copyhistory=no,height=400,width=600");
			var instTimer = setInterval(function () { //set interval for executing the code to popup
				try {
					if (instLogin.location.hostname == window.location.hostname) { //if login domain host name and window location hostname is equal then it will go ahead
						clearInterval(instTimer);
						instLogin.close();
						woo_slg_social_connect( 'instagram', object );
					}
				} catch (e) {}
			}, 300);
		}
	});
	
	// Social login toggle on checkout, shortcode page
	//$('.woo-slg-social-container-checkout').hide();
	$(document).on('click', '.woo-slg-show-social-login', function() {
		$('.woo-slg-social-container-checkout').slideToggle();
	});
	
	// Social login toggle on widget area
	$(document).on('click', '.woo-slg-show-social-login-widget', function() {
		$('.woo-slg-social-container-widget').slideToggle();
	});
	
	// Social login toggle on widget area
	$(document).on('click', '.woo-slg-login-page .woo-slg-show-social-login', function() {
		$("html, body").animate({ scrollTop: $(document).height() }, "slow");
	});
	
	//My Account Show Link Buttons "woo-slg-show-link"
	$( document ).on( 'click', '.woo-slg-show-link', function() {
		$( '.woo-slg-show-link' ).hide();
		$( '.woo-slg-profile-link-container' ).show();
	});
	
	// login with paypal
	$( document ).on( 'click', 'a.woo-slg-social-login-paypal', function() {
		
		var object	= $( this );
		var errorel	= $( this ).parents( '.woo-slg-social-container' ).find( '.woo-slg-login-error' );
		
		errorel.hide();
		errorel.html( '' );
		
		if( WOOSlg.paypalerror == '1' ) {
			
			errorel.show();
			errorel.html( WOOSlg.paypalerrormsg );
			return false;
			
		} else {		
			
			var paypalurl = $(this).closest('.woo-slg-social-container').find('.woo-slg-social-paypal-redirect-url').val();			
			if(paypalurl == '') {
				alert( WOOSlg.urlerror );
				return false;
			}
			var paypalLogin = window.open( paypalurl, "paypal_login", "scrollbars=yes,resizable=no,toolbar=no,location=no,directories=no,status=no,menubar=no,copyhistory=no,height=400,width=600");
			var paypalTimer = setInterval(function () { //set interval for executing the code to popup
				try { 
					if (paypalLogin.location.hostname == window.location.hostname) { //if login domain host name and window location hostname is equal then it will go ahead
						clearInterval(paypalTimer);
						paypalLogin.close();
						woo_slg_social_connect( 'paypal', object );
					}
				} catch (e) {}
			}, 300);			
		}
	});
	
	
	// login with amazon
	$( document ).on( 'click', 'a.woo-slg-social-login-amazon', function() {
		
		var object	= $( this );
		var errorel	= $( this ).parents( '.woo-slg-social-container' ).find( '.woo-slg-login-error' );
		
		errorel.hide();
		errorel.html( '' );
		
		if( WOOSlg.amazonerror == '1' ) {
			
			errorel.show();
			errorel.html( WOOSlg.amazonerrormsg );
			return false;
			
		} else {		
			
			var amazonurl = $(this).closest('.woo-slg-social-container').find('.woo-slg-social-amazon-redirect-url').val();			
			if(amazonurl == '') {
				alert( WOOSlg.urlerror );
				return false;
			}
			var amazonLogin = window.open(amazonurl, "amazon_login", "scrollbars=yes,resizable=no,toolbar=no,location=no,directories=no,status=no,menubar=no,copyhistory=no,height=400,width=600");
			var amazonTimer = setInterval(function () { //set interval for executing the code to popup
				try { 
					if (amazonLogin.location.hostname == window.location.hostname) { //if login domain host name and window location hostname is equal then it will go ahead
						clearInterval(amazonTimer);
						amazonLogin.close();
						woo_slg_social_connect( 'amazon', object );
					}
				} catch (e) {}
			}, 300);			
		}
	});
	
});

// Social Connect Process
function woo_slg_social_connect( type, object ) {
	var data = {
					action	:	'woo_slg_social_login',
					type	:	type
				};
	
	//show loader
	//jQuery('.woo-slg-login-loader').show();
	jQuery(object).parents('.woo-slg-social-container').find('.woo-slg-login-loader').show();
	//jQuery('.woo-slg-social-wrap').hide();
	jQuery(object).parents('.woo-slg-social-container').find('.woo-slg-social-wrap').hide();
	
	jQuery.post( WOOSlg.ajaxurl,data,function(response) {		
		
		// hide loader
		jQuery(object).parents('.woo-slg-social-container').find('.woo-slg-login-loader').hide();
		jQuery(object).parents('.woo-slg-social-container').find('.woo-slg-social-wrap').show();

		var redirect_url = object.parents('.woo-slg-social-container').find('.woo-slg-redirect-url').val();
		if( response != '' ) {			
			var result = jQuery.parseJSON( response );
			if( redirect_url != '' ) {
				window.location = removeParam( redirect_url, 'code' );				
			} else {
				//if user created successfully then reload the page
				var current_url  = window.location.href;
				current_url		= removeParam( current_url, 'code' );
				window.location = current_url;
			}
		}
	});
}

function removeParam( url, parameter ) { 
	 var urlparts= url.split('?');   
    if ( urlparts.length>=2 ) {

        var prefix= encodeURIComponent(parameter)+'=';
        var pars= urlparts[1].split(/[&;]/g);

        //reverse iteration as may be destructive
        for (var i= pars.length; i-- > 0;) {
            //idiom for string.startsWith
            if (pars[i].lastIndexOf(prefix, 0) !== -1) {
                pars.splice(i, 1);
            }
        }
        url= urlparts[0] + (pars.length > 0 ? '?' + pars.join('&') : "");
        return url;
    } else {
        return url;
    }
}

var targetWindow ="prefer-popup";
window.NSLPopupCenter = function (url, title, w, h) {
    var userAgent = navigator.userAgent,
            mobile = function () {
                return /\b(iPhone|iP[ao]d)/.test(userAgent) ||
                        /\b(iP[ao]d)/.test(userAgent) ||
                        /Android/i.test(userAgent) ||
                        /Mobile/i.test(userAgent);
            },
            screenX = window.screenX !== undefined ? window.screenX : window.screenLeft,
            screenY = window.screenY !== undefined ? window.screenY : window.screenTop,
            outerWidth = window.outerWidth !== undefined ? window.outerWidth : document.documentElement.clientWidth,
            outerHeight = window.outerHeight !== undefined ? window.outerHeight : document.documentElement.clientHeight - 22,
            targetWidth = mobile() ? null : w,
            targetHeight = mobile() ? null : h,
            V = screenX < 0 ? window.screen.width + screenX : screenX,
            left = parseInt(V + (outerWidth - targetWidth) / 2, 10),
            right = parseInt(screenY + (outerHeight - targetHeight) / 2.5, 10),
            features = [];
    if (targetWidth !== null) {
        features.push('width=' + targetWidth);
    }
    if (targetHeight !== null) {
        features.push('height=' + targetHeight);
    }
    features.push('left=' + left);
    features.push('top=' + right);
    features.push('scrollbars=1');

    var newWindow = window.open(url, title, features.join(','));

    if (window.focus) {
        newWindow.focus();
    }

    return newWindow;
};

var isWebView = null;

function checkWebView() {
    if (isWebView === null) {
        //Based on UserAgent.js {@link https://github.com/uupaa/UserAgent.js}
        function _detectOS(ua) {
            switch (true) {
                case / Android / .test(ua):
                    return "Android";
                case / iPhone | iPad | iPod / .test(ua):
                    return "iOS";
                case / Windows / .test(ua):
                    return "Windows";
                case / Mac OS X / .test(ua):
                    return "Mac";
                case / CrOS / .test(ua):
                    return "Chrome OS";
                case / Firefox / .test(ua):
                    return "Firefox OS";
            }
            return "";
        }

        function _detectBrowser(ua) {
            var android = /Android/.test(ua);

            switch (true) {
                case / CriOS / .test(ua):
                    return "Chrome for iOS"; // https://developer.chrome.com/multidevice/user-agent
                case / Edge / .test(ua):
                    return "Edge";
                case android && /Silk\//.test(ua):
                    return "Silk"; // Kidle Silk browser
                case / Chrome / .test(ua):
                    return "Chrome";
                case / Firefox / .test(ua):
                    return "Firefox";
                case android:
                    return "AOSP"; // AOSP stock browser
                case / MSIE | Trident / .test(ua):
                        return "IE";
                    case / Safari\//.test(ua):
                            return "Safari";
                case / AppleWebKit / .test(ua):
                    return "WebKit";
            }
            return "";
        }

        function _detectBrowserVersion(ua, browser) {
            switch (browser) {
                case "Chrome for iOS":
                    return _getVersion(ua, "CriOS/");
                case "Edge":
                    return _getVersion(ua, "Edge/");
                case "Chrome":
                    return _getVersion(ua, "Chrome/");
                case "Firefox":
                    return _getVersion(ua, "Firefox/");
                case "Silk":
                    return _getVersion(ua, "Silk/");
                case "AOSP":
                    return _getVersion(ua, "Version/");
                case "IE":
                    return /IEMobile/.test(ua) ? _getVersion(ua, "IEMobile/") :
                            /MSIE/.test(ua) ? _getVersion(ua, "MSIE ") // IE 10
                            :
                            _getVersion(ua, "rv:"); // IE 11
                case "Safari":
                    return _getVersion(ua, "Version/");
                case "WebKit":
                    return _getVersion(ua, "WebKit/");
            }
            return "0.0.0";
        }

        function _getVersion(ua, token) {
            try {
                return _normalizeSemverString(ua.split(token)[1].trim().split(/[^\w\.]/)[0]);
            } catch (o_O) {
                // ignore
            }
            return "0.0.0";
        }

        function _normalizeSemverString(version) {
            var ary = version.split(/[\._]/);
            return (parseInt(ary[0], 10) || 0) + "." +
                    (parseInt(ary[1], 10) || 0) + "." +
                    (parseInt(ary[2], 10) || 0);
        }

        function _isWebView(ua, os, browser, version, options) {
            switch (os + browser) {
                case "iOSSafari":
                    return false;
                case "iOSWebKit":
                    return _isWebView_iOS(options);
                case "AndroidAOSP":
                    return false; // can not accurately detect
                case "AndroidChrome":
                    return parseFloat(version) >= 42 ? /; wv/.test(ua) : /\d{2}\.0\.0/.test(version) ? true : _isWebView_Android(options);
            }
            return false;
        }

        function _isWebView_iOS(options) { // @arg Object - { WEB_VIEW }
            // @ret Boolean
            // Chrome 15++, Safari 5.1++, IE11, Edge, Firefox10++
            // Android 5.0 ChromeWebView 30: webkitFullscreenEnabled === false
            // Android 5.0 ChromeWebView 33: webkitFullscreenEnabled === false
            // Android 5.0 ChromeWebView 36: webkitFullscreenEnabled === false
            // Android 5.0 ChromeWebView 37: webkitFullscreenEnabled === false
            // Android 5.0 ChromeWebView 40: webkitFullscreenEnabled === false
            // Android 5.0 ChromeWebView 42: webkitFullscreenEnabled === ?
            // Android 5.0 ChromeWebView 44: webkitFullscreenEnabled === true
            var document = (window["document"] || {});

            if ("WEB_VIEW" in options) {
                return options["WEB_VIEW"];
            }
            return !("fullscreenEnabled" in document || "webkitFullscreenEnabled" in document || false);
        }

        function _isWebView_Android(options) {
            // Chrome 8++
            // Android 5.0 ChromeWebView 30: webkitRequestFileSystem === false
            // Android 5.0 ChromeWebView 33: webkitRequestFileSystem === false
            // Android 5.0 ChromeWebView 36: webkitRequestFileSystem === false
            // Android 5.0 ChromeWebView 37: webkitRequestFileSystem === false
            // Android 5.0 ChromeWebView 40: webkitRequestFileSystem === false
            // Android 5.0 ChromeWebView 42: webkitRequestFileSystem === false
            // Android 5.0 ChromeWebView 44: webkitRequestFileSystem === false
            if ("WEB_VIEW" in options) {
                return options["WEB_VIEW"];
            }
            return !("requestFileSystem" in window || "webkitRequestFileSystem" in window || false);
        }

        var options = {};
        var nav = window.navigator || {};
        var ua = nav.userAgent || "";
        var os = _detectOS(ua);
        var browser = _detectBrowser(ua);
        var browserVersion = _detectBrowserVersion(ua, browser);

        isWebView = _isWebView(ua, os, browser, browserVersion, options);
    }

    return isWebView;
}
if (typeof jQuery !== 'undefined') {
    var targetWindow = 'prefer-popup';
    (function ($) {
        $('a[data-plugin="woo-slg"][data-action="connect"],a[data-plugin="woo-slg"][data-action="link"]').on('click', function (e) {
        	
            var $target = $(this),
                    href = $target.attr('href'),
                    success = false;
            if (href.indexOf('?') !== -1) {
                href += '&';
            } else {
                href += '?';
            }
            var redirectTo = $target.data('redirect');
            if (redirectTo === 'current') {
                href += 'redirect=' + encodeURIComponent(window.location.href) + '&';
            } else if (redirectTo && redirectTo !== '') {
                href += 'redirect=' + encodeURIComponent(redirectTo) + '&';
            }


            if (NSLPopupCenter(href + 'display=popup', 'nsl-social-connect', $target.data('popupwidth'), $target.data('popupheight'))) {
                success = true;
                e.preventDefault();
            }
            if (!success) {
                window.location = href;
                e.preventDefault();
            }
        });


    })(jQuery);
}
function hideLoaderAgain(){
    jQuery('a.woo-slg-social-login-facebook').parents('.woo-slg-social-container').find('.woo-slg-login-loader').hide();
    jQuery('a.woo-slg-social-login-facebook').parents('.woo-slg-social-container').find('.woo-slg-social-wrap').show();
}
function showLoaderNow() {
    jQuery('a.woo-slg-social-login-facebook').parents('.woo-slg-social-container').find('.woo-slg-login-loader').show();
    //jQuery('.woo-slg-social-wrap').hide();
    jQuery('a.woo-slg-social-login-facebook').parents('.woo-slg-social-container').find('.woo-slg-social-wrap').hide();
}