var getCsrfToken = function() {
    return $("#csrfToken").html();
}

function getCookie(key) {
    var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
    return keyValue ? keyValue[2] : null;
}

function setCookie(key, value) {
    var expires = new Date();
    expires.setTime(expires.getTime() + (1 * 24 * 60 * 60 * 1000 * 30));//30 days
    document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
}

//$('#videoContainer').on('click', function() {
//    $(this).html('<iframe src="https://www.youtube.com/embed/vmNUSBhxtww?rel=0&autoplay=1" width="398" height="289" frameborder="0" allowfullscreen="true">').css('background', 'none');
//    $('#videoContainer').css('margin-left','0px');
//});

function getOTPincode(country, operator) {

    var request = $.ajax({
        url: '/actel/ajaxGetPinCode',
        type: 'POST',
        data: ({
            'country': country,
            'operator': operator,
            'CSRF_TOKEN': getCsrfToken()
        }),
        success: function(data) {
            obj = $.parseJSON(data);
            if (obj.success) {
                showPopupWrap(obj.success);
            }
            if (obj.error) {
                showPopupWrap(obj.error);
            }
        }
    });
}

function initialize() {
                    
    // Try HTML5 geolocation
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            //var pos = new google.maps.LatLng(position.coords.latitude,
            //        position.coords.longitude);
            var text = '<div style="color: #ffffff; font-size: 22px;padding: 10px;">Please wait while we check your location...</div><img src="/webassets/images/spinning-wheel.gif"/>';
            showPopupWrap2(text);
            setTimeout(function() {$('#popupWrap2').hide()}, 4000);

            var request = $.ajax({
                url: '/site/ajaxGeoCoordinates',
                type: 'POST',
                data: ({
                    'lat': position.coords.latitude,
                    'lng': position.coords.longitude,
                    //'CSRF_TOKEN': getCsrfToken()
                }),
                success: function(data) {
                    obj = $.parseJSON(data);
                    if (obj.success) {
//                        if (/android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(navigator.userAgent.toLowerCase())) {
//                            showPopupWrap(obj.success);
//                            $('.okButton').on('click', function(e) {
//                                e.preventDefault();
//                                window.location.href = '/login';
//                            });
//                        } else {
                            var url = "/";
                            if($("#game_id").val()) {
                                url = "/winlooseordraw/"+$("#game_id").val();
                            }
                    
                            setTimeout(function(){window.location.href = url;},500);
//                        }
                    }

                    if (obj.error) {
                        //showPopupWrap(obj.error);
                        //$('.okButton').on('click', function(e) {
                        //    e.preventDefault();
                        //    window.location.href = '/';
                        //});
                        setTimeout(function(){window.location.href = "/";},500);

                    }
                }
            });

        }, function() {
            handleNoGeolocation(true);
        });
    } else {
        // Browser doesn't support Geolocation
        handleNoGeolocation(false);
    }
}

function showPopupWrap(text) {
        $("#popupWrap .flashMobileContents").html(text);
        $("#popupWrap").css('display', 'table');
    }

function handleNoGeolocation(errorFlag) {
    if (errorFlag) {
        var request = $.ajax({
            url: '/site/ajaxGeoCoordinates',
            type: 'POST',
            data: ({
                'lat': 'unknown',
                'lng': 'unknown',
                //'CSRF_TOKEN': getCsrfToken()
            }),
            success: function(data) {
                setTimeout(function(){window.location.href = "/";},500);
                //var content = 'Please reset your geolocation settings. It might be currently turned off, or you have chosen to not share your location.';
                //showPopupWrap(content);
                //google.maps.event.addDomListener(window, 'load', initialize);
            }
        });
    } else {
        var content = 'Error: Your browser doesn\'t support geolocation.';
        showPopupWrap(content);
    }
}

$("#goToShareLocation").click(function() {
    //alert("/geocoordinatesshare/"+$("#game_id").val());
    var url = $("#game_id").val();
    window.location.href = "/geocoordinatesshare/"+url;
});


$("#notShareLocation").click(function() {
    handleNotPreShare();
});

function handleNotPreShare() {
    var request = $.ajax({
        url: '/site/ajaxGeoCoordinatesNotPreshare',
        type: 'POST',
        data: ({
            'lat': 'unknown',
            'lng': 'unknown',
        }),
        success: function(data) {
            window.location.href = "/";
        }
    });
}

if(window.location.pathname.indexOf("geocoordinatesshare") > -1) {
    google.maps.event.addDomListener(window, 'load', initialize);
}

var overlayHandlers = function() {
    if (getCookie("hideRecorderOverlay")) {
        setCookie("hideRecorderOverlay", 1);//renew 30day validation
        console.log('cookie set');
    }
    else {
        //console.log('cookie not set');
        //$('.dim').toggle();
    }
    $('.hide_dim').off('click');
    $('.hide_dim').on('click', function(e) {
        e.preventDefault();
        $('.dim').toggle();
        if ($('#hiderecorderhelp').is(':checked')) {
            setCookie("hideRecorderOverlay", 1);
        }
    });
}

var socialHandlers = function() {
    $('#tw_conn').off('click');
    $('#tw_conn').on('click', function(e) {
        e.preventDefault();
        if ($(this).attr('rel') == 1) {
            if (confirm('Are you sure you want to disconnect your twitter account?')) {
                var request = $.ajax({
                    url: "/user/ajaxTwitterDisconnect",
                    type: 'POST',
                    data: ({
                        'CSRF_TOKEN': getCsrfToken(),
                    }),
                    success: function(data) {
                        window.location.reload();
                    }
                });
            }
        } else {
            $.oauthpopup({
                path: '/user/twitterConnect',
                callback: function() {
                    window.location.reload();
                }
            })
        }
    });
    $('#fb_conn').off('click');
    $('#fb_conn').on('click', function(e) {
        e.preventDefault();
        if ($(this).attr('rel') == 1) {
            if (confirm('Are you sure you want to disconnect your facebook account?')) {
                var request = $.ajax({
                    url: "/user/ajaxFacebookDisconnect",
                    type: 'POST',
                    data: ({
                        'CSRF_TOKEN': getCsrfToken(),
                    }),
                    success: function(data) {
                        window.location.reload();
                    }
                });
            }
        } else {
            FB.login(function(response) {
                if (response.authResponse) {
                    var request = $.ajax({
                        url: "/user/ajaxFacebookConnect",
                        type: 'POST',
                        data: ({
                            'CSRF_TOKEN': getCsrfToken(),
                            'accessToken': response.authResponse.accessToken,
                            'expiresIn': response.authResponse.expiresIn,
                            'userID': response.authResponse.userID
                        }),
                        success: function(data) {
                            window.location.reload();
                        }
                    });
                }
            }, {
                scope: 'user_location,user_birthday,email,publish_actions'
            });
        }
    });

    $('.twreg').off('click');
    $('.twreg').on('click', function(e) {
        e.preventDefault();
        var elem = $(this).replaceWith($('<img></img>').attr({
            'id': 'spinner_tw',
            'src': '/core/webassets/images/socialSearch/ajaxSpinner.gif'
        }).css({
            'width': '25px'
        }));
        $.oauthpopup({
            path: '/user/twitter',
            callback: function() {
                window.location.reload();
            }
        })
    });
    $('.fbreg').off('click');
    $('.fbreg').on('click', function(e) {
        e.preventDefault();
        var elem = $(this).replaceWith($('<img></img>').attr({
            'id': 'spinner_fb',
            'src': '/core/webassets/images/socialSearch/ajaxSpinner.gif'
        }).css({
            'width': '25px'
        }));
        FB.login(function(response) {
            if (response.authResponse) {
                var request = $.ajax({
                    url: "/user/ajaxFacebook",
                    type: 'POST',
                    data: ({
                        'CSRF_TOKEN': getCsrfToken(),
                        'accessToken': response.authResponse.accessToken,
                        'expiresIn': response.authResponse.expiresIn,
                        'userID': response.authResponse.userID
                    }),
                    success: function(data) {
                        window.location.reload();
                    }
                });
            }
        }, {
            scope: 'user_location,user_birthday,email,publish_actions'
        });
    });
}

var reloadVideo = function(vid) {
    var request = $.ajax({
        url: '/video/ajaxPreviewVideo',
        type: 'POST',
        data: ({
            'CSRF_TOKEN': getCsrfToken(),
            'vID': vid
        }),
        success: function(data) {
            var obj = $.parseJSON(data);
            $('.videoObject').html(obj.html);
            if (obj.status == 'WAIT') {
                setTimeout('reloadVideo(' + vid + ')', 2000);
            }
        }
    });
};

jQuery(document).ready(function() {
    overlayHandlers();
    socialHandlers();
});


