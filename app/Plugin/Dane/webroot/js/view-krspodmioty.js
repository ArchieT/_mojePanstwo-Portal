/*global $,jQuery,mPHeart,google,googleMapAdres,connectionGraphObject,sticky*/
var googleMap, panorama, addLatLng;

function initialize() {
    "use strict";
    //SETTING DEFAULT CENTER TO GOOGLE MAP AT POLAND//
    var infowindow,
        element,
        contentStringHeightTemp,
        polandLatlng = new google.maps.LatLng(51.919438, 19.145136),
        mapOptions = {
            zoom: 15,
            center: polandLatlng
        },
        geocoder = new google.maps.Geocoder(),
        contentString = document.createElement("div");

    googleMap = new google.maps.Map(document.getElementById('googleMap'), mapOptions);

    contentString.innerHTML = googleMapAdres + '<a href="https://maps.google.com/maps?daddr=' + googleMapAdres.replace(/ /g, '+') + '&t=m" target="_blank" class="btn btn-info">Dojazd</a>';
    contentString.id = "googleMapsContent";
    contentString.style.width = "360px";

    /*GETTING HEIGHT OF CONTENT*/
    contentStringHeightTemp = contentString.cloneNode(true);
    contentStringHeightTemp.style.visibility = "hidden";
    document.body.appendChild(contentStringHeightTemp);

    /*ADDING HEIGHT TO ORIGIN NODE*/
    contentString.style.height = contentStringHeightTemp.clientHeight;

    /*REMOVING CLONED NODE*/
    element = document.getElementById("googleMapsContent");
    element.parentNode.removeChild(element);

    infowindow = new google.maps.InfoWindow({
        content: contentString
    });

    function wrapAngle(angle) {
        if (angle >= 360) {
            angle -= 360;
        } else if (angle < 0) {
            angle += 360;
        }
        return angle;
    }

    function computeAngle(endLatLng, startLatLng) {
        var DEGREE_PER_RADIAN = 57.2957795,
            RADIAN_PER_DEGREE = 0.017453,
            dlat = endLatLng.lat() - startLatLng.lat(),
            dlng = endLatLng.lng() - startLatLng.lng(),
            yaw;
        // We multiply dlng with cos(endLat), since the two points are very closeby,
        // so we assume their cos values are approximately equal.
        yaw = Math.atan2(dlng * Math.cos(endLatLng.lat() * RADIAN_PER_DEGREE), dlat) * DEGREE_PER_RADIAN;
        return wrapAngle(yaw);
    }

    function showPanoData(panoData, status) {
        if (status !== google.maps.StreetViewStatus.OK) {
            $('#streetView').html(mPHeart.translation.LC_DANE_VIEW_KRSPODMIOTY_NO_STREETVIEW_PICTURE_AVAILABLE).attr('style', 'text-align:center;font-weight:bold,position: relative; top: 50%; margin-top: -10px').show();
            return;
        }

        var angle = computeAngle(addLatLng, panoData.location.latLng),
            panoOptions = {
                position: addLatLng,
                addressControl: false,
                linksControl: false,
                panControl: false,
                zoomControlOptions: {
                    style: google.maps.ZoomControlStyle.SMALL
                },
                pov: {
                    heading: angle,
                    pitch: 10,
                    zoom: 1
                },
                enableCloseButton: false,
                visible: true
            };

        panorama.setOptions(panoOptions);
    }

    function createStreetview(lat, lng) {
        panorama = new google.maps.StreetViewPanorama(document.getElementById("streetView"));
        addLatLng = new google.maps.LatLng(lat, lng);
        var service = new google.maps.StreetViewService();
        service.getPanoramaByLocation(addLatLng, 50, showPanoData);
    }

    geocoder.geocode({'address': googleMapAdres}, function (results, status) {
        if (status === google.maps.GeocoderStatus.OK) {
            var gps = results[0].geometry.location,
                marker = new google.maps.Marker({
                    map: googleMap,
                    position: gps
                });

            createStreetview(gps.lat(), gps.lng());

            //CENTER ON MARKER
            googleMap.setCenter(results[0].geometry.location);

            google.maps.event.addListener(marker, 'click', function () {
                infowindow.open(googleMap, marker);
            });

            //NEED TO WAIT A LITTLE UNTIL MAP IDLE AND CAN CENTER ON AUTO OPEN INFOWINDOW//
            google.maps.event.addListenerOnce(googleMap, 'idle', function () {
                setTimeout(function () {
                    google.maps.event.trigger(marker, 'click');
                }, 2000);
            });
        }
    });
}

//ASYNC INIT GOOGLE MAP JS//
function loadScript() {
    "use strict";
    if ((typeof google !== "undefined") && google.maps) {
        initialize();
    } else {
        var script = document.createElement('script');
        script.type = 'text/javascript';
        script.src = 'https://maps.googleapis.com/maps/api/js?sensor=false&language=' + mPHeart.language.twoDig + '&callback=initialize';
        document.body.appendChild(script);
    }
}
jQuery(document).ready(function () {
    "use strict";
    var dataHighlights,
        objectMain = $('.objectMain'),
        banner = jQuery('.profile_baner'),
        mapsOptions = $('.mapsOptions '),
        menu = jQuery('.objectsPageContent .objectMenu'),
        menuAutoScroll = true,
        headerHeight = jQuery('header').outerHeight(),
        dataHighlightsOptions = jQuery('.dataHighlightsOptions'),
        $showHideSide = $('.showHideSide'),
        $objectSideInner = $('.objectSideInner');

    if (banner.length > 0) {
        banner.find('.bg img').css({'width': banner.outerWidth() + 'px', 'height': banner.outerHeight() + 'px'});

        /*ASYNCHRONIZE ACTION FOR GOOGLE MAP*/
        window.onload = loadScript();

        mapsOptions.find('button').click(function () {
            var that = $(this);

            if (that.hasClass('active')) {
                mapsOptions.find('.active').removeClass('active');

                banner.removeClass('big');
                banner.find('.bg').fadeIn();
            } else if (that.hasClass('googleMap')) {
                mapsOptions.find('.active').removeClass('active');

                banner.addClass('big');
                banner.find('#googleMap').show();
                banner.find('#streetView').hide();
                banner.find('.bg').fadeOut();

                $(this).addClass('active');
            } else if (that.hasClass('streetView')) {
                mapsOptions.find('.active').removeClass('active');

                banner.addClass('big');
                banner.find('#googleMap').hide();
                banner.find('#streetView').show();
                banner.find('.bg').fadeOut();

                $(this).addClass('active');
            }
        });
    }

    /*STICKY MENU*/
    menu.attr('id', 'stickyMenu').css('width', menu.outerWidth() + 'px');
    sticky('#stickyMenu');

    menu.find('.nav a').click(function (event) {
        var target = jQuery(this).attr('href'),
            padding = 10;
        event.preventDefault();

        menuAutoScroll = false;
        menu.find('li.active').removeClass('active');
        jQuery(this).parent('li').addClass('active');

        jQuery('body, html').stop(true, true).animate({
            scrollTop: jQuery(target).offset().top - jQuery('header').outerHeight() - padding
        }, 800, function () {
            menuAutoScroll = true;
        });
    });

    if (dataHighlightsOptions.length > 0) {
        dataHighlights = jQuery('.dataHighlights');

        dataHighlightsOptions.find('.btn').click(function () {
            if (jQuery(this).hasClass('showMore')) {
                dataHighlightsOptions.find('.showMore').addClass('hidden');
                dataHighlightsOptions.find('.showLess').removeClass('hidden');
                dataHighlights.find('.secondRow').show();
            } else if (jQuery(this).hasClass('showLess')) {
                dataHighlightsOptions.find('.showLess').addClass('hidden');
                dataHighlightsOptions.find('.showMore').removeClass('hidden');
                dataHighlights.find('.secondRow').hide();
            }
        });
    }

    jQuery(window).scroll(function () {
        if (menuAutoScroll) {
            var windscroll = jQuery(window).scrollTop(),
                searchHeight = (jQuery('._mojePanstwoCockpitSearchInput:visible') ? jQuery('._mojePanstwoCockpitSearchInput').outerHeight() : 0);
            if (windscroll >= 100) {
                jQuery('.objectsPageContent .object > .block').each(function (i) {
                    if (jQuery(this).position().top <= windscroll + headerHeight + searchHeight + 60) {
                        menu.find('li.active').removeClass('active');
                        menu.find('li').eq(i).addClass('active');
                    }
                });
            } else {
                menu.find('li.active').removeClass('active');
                menu.find('li:first').addClass('active');
            }
        }
    }).scroll();

    $showHideSide.find('> a').click(function () {
        var that = $(this);
        $showHideSide.find('>a').removeClass('hide');
        that.addClass('hide');
        if (that.hasClass('a-more')) {
            $objectSideInner.find('.dataHighlights.hide').removeClass('hide').hide().addClass('unhide').slideDown();
        } else if (that.hasClass('a-less')) {
            $objectSideInner.find('.dataHighlights.unhide').slideUp(function () {
                $objectSideInner.find('.dataHighlights.unhide').removeClass('uhhide').addClass('hide');
            });
        }
    });

    console.log(objectMain, objectMain.find('.text-iheight-toggle'));

    objectMain.find('.text-iheight-toggle > a').on('click', function (e) {
        var that = $(this),
            main = objectMain.find('.text-iheight');

        e.preventDefault();

        if (main.hasClass('show_all')) {
            main.removeClass('show_all');
            that.text('Więcej')
        } else {
            main.addClass('show_all');
            that.text('Mniej')
        }
    });
});