jQuery(document).ready(function ($) {
    if($('#map-container').is('div')){
        //set your google maps parameters    
        map_zoom = 16;

        //google map custom marker icon - .png fallback for IE11
        var is_internetExplorer11 = navigator.userAgent.toLowerCase().indexOf('trident') > -1;
        var marker_url = (is_internetExplorer11) ? '/img/icon-marker.png' : '/img/icon-marker.png';

        //define the basic color of your map, plus a value for saturation and brightness
        var main_color = '#cacaca',
                saturation_value = -100,
                brightness_value = 5;

        //we define here the style of the map
        var style = [
            {
                //set saturation for the labels on the map
                elementType: "labels",
                stylers: [
                    {saturation: saturation_value}
                ]
            },
            {//poi stands for point of interest - don't show these lables on the map 
                featureType: "poi",
                elementType: "labels",
                stylers: [
                    {visibility: "off"}
                ]
            },
            {
                //don't show highways lables on the map
                featureType: 'road.highway',
                elementType: 'labels',
                stylers: [
                    {visibility: "off"}
                ]
            },
            {
                //don't show local road lables on the map
                featureType: "road.local",
                elementType: "labels.icon",
                stylers: [
                    {visibility: "off"}
                ]
            },
            {
                //don't show arterial road lables on the map
                featureType: "road.arterial",
                elementType: "labels.icon",
                stylers: [
                    {visibility: "off"}
                ]
            },
            {
                //don't show road lables on the map
                featureType: "road",
                elementType: "geometry.stroke",
                stylers: [
                    {visibility: "off"}
                ]
            },
            //style different elements on the map
            {
                featureType: "transit",
                elementType: "geometry.fill",
                stylers: [
                    {hue: main_color},
                    {visibility: "on"},
                    {lightness: brightness_value},
                    {saturation: saturation_value}
                ]
            },
            {
                featureType: "poi",
                elementType: "geometry.fill",
                stylers: [
                    {hue: main_color},
                    {visibility: "on"},
                    {lightness: brightness_value},
                    {saturation: saturation_value}
                ]
            },
            {
                featureType: "poi.government",
                elementType: "geometry.fill",
                stylers: [
                    {hue: main_color},
                    {visibility: "on"},
                    {lightness: brightness_value},
                    {saturation: saturation_value}
                ]
            },
            {
                featureType: "poi.sport_complex",
                elementType: "geometry.fill",
                stylers: [
                    {hue: main_color},
                    {visibility: "on"},
                    {lightness: brightness_value},
                    {saturation: saturation_value}
                ]
            },
            {
                featureType: "poi.attraction",
                elementType: "geometry.fill",
                stylers: [
                    {hue: main_color},
                    {visibility: "on"},
                    {lightness: brightness_value},
                    {saturation: saturation_value}
                ]
            },
            {
                featureType: "poi.business",
                elementType: "geometry.fill",
                stylers: [
                    {hue: main_color},
                    {visibility: "on"},
                    {lightness: brightness_value},
                    {saturation: saturation_value}
                ]
            },
            {
                featureType: "transit",
                elementType: "geometry.fill",
                stylers: [
                    {hue: main_color},
                    {visibility: "on"},
                    {lightness: brightness_value},
                    {saturation: saturation_value}
                ]
            },
            {
                featureType: "transit.station",
                elementType: "geometry.fill",
                stylers: [
                    {hue: main_color},
                    {visibility: "on"},
                    {lightness: brightness_value},
                    {saturation: saturation_value}
                ]
            },
            {
                featureType: "landscape",
                stylers: [
                    {hue: main_color},
                    {visibility: "on"},
                    {lightness: brightness_value},
                    {saturation: saturation_value}
                ]

            },
            {
                featureType: "road",
                elementType: "geometry.fill",
                stylers: [
                    {hue: main_color},
                    {visibility: "on"},
                    {lightness: brightness_value},
                    {saturation: saturation_value}
                ]
            },
            {
                featureType: "road.highway",
                elementType: "geometry.fill",
                stylers: [
                    {hue: main_color},
                    {visibility: "on"},
                    {lightness: brightness_value},
                    {saturation: saturation_value}
                ]
            },
            {
                featureType: "water",
                elementType: "geometry",
                stylers: [
                    {hue: main_color},
                    {visibility: "on"},
                    {lightness: brightness_value},
                    {saturation: saturation_value}
                ]
            }
        ];
        var re = /\s*,\s*/;
        var point = $('.shops-nav li .title-1:first').attr('data-point').split(re);
        //set google map options
        var map_options = {
            center: new google.maps.LatLng(point[0], point[1]),
            zoom: map_zoom,
            panControl: false,
            zoomControl: false,
            mapTypeControl: false,
            streetViewControl: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            scrollwheel: false,
            styles: style,
        }
        //inizialize the map
        var map = new google.maps.Map(document.getElementById('map-container'), map_options);
        //add a custom marker to the map				
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(point[0], point[1]),
            map: map,
            visible: true,
            icon: marker_url,
        });
        $('.shops-nav li .title-1').click(function () {
            if (!$(this).hasClass('active')) {
                $('.shops-nav li .title-1').removeClass('active');
				$('.shops-nav li').removeClass('active');
                $(this).addClass('active');
				$(this).parent().addClass('active');
                var $dataMap = $(this).attr('data-map');
                $('.balloon-tab').each(function () {
                    if ($(this).attr('data-tab') == $dataMap) {
                        $(this).fadeIn();
                    }
                    else {
                        $(this).hide();
                    }
                })
                var re = /\s*,\s*/;
                var point = $(this).attr('data-point').split(re);
                var map_options = {
                    center: new google.maps.LatLng(point[0], point[1]),
                    zoom: map_zoom,
                    panControl: false,
                    zoomControl: false,
                    mapTypeControl: false,
                    streetViewControl: false,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    scrollwheel: false,
                    styles: style,
                }
                var map = new google.maps.Map(document.getElementById('map-container'), map_options);
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(point[0], point[1]),
                    map: map,
                    visible: true,
                    icon: marker_url,
                });
            }
        })
    }
});
  