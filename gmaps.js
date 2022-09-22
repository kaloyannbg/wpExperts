//Add this to themes/theme/js/gmaps.js

(function($) {

    function new_map( $el ) {
      
      var $markers = $el.find('.marker');
      
      
      var args = {
        zoom    : 16,
        center    : new google.maps.LatLng(0, 0),
        mapTypeId : google.maps.MapTypeId.ROADMAP
      };
      
      
      var map = new google.maps.Map( $el[0], args);
      
      
      map.markers = [];
      
      
      $markers.each(function(){
        
          add_marker( $(this), map );
        
      });
      
      
      center_map( map );
      
      
      return map;
      
    }
    
    /*
    *  add_marker
    *
    *  This function will add a marker to the selected Google Map
    *
    *  @type  function
    *  @date  8/11/2013
    *  @since 4.3.0
    *
    *  @param $marker (jQuery element)
    *  @param map (Google Map object)
    *  @return  n/a
    */
    
    function add_marker( $marker, map ) { 
      
      var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );
        var icon = $marker.attr('data-img');
     
      var marker = new google.maps.Marker({
        position  : latlng,
        map     : map,
        icon        : icon
      });
    
     
      map.markers.push( marker );
      
     
      if( $marker.html() )
      {
       
        var infowindow = new google.maps.InfoWindow({
          content   : $marker.html()
        });
    
      
        google.maps.event.addListener(marker, 'click', function() {          
    
          infowindow.open( map, marker );
    
        });
      }
    
    }
    
    function center_map( map ) {
    
      var bounds = new google.maps.LatLngBounds();
    
      $.each( map.markers, function( i, marker ){
    
        var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );
    
        bounds.extend( latlng );
    
      });
    
      if( map.markers.length == 1 )
      {
          map.setCenter( bounds.getCenter() );
          map.setZoom( 16 );
      }
      else
      {
        map.fitBounds( bounds );
      }
    
    }

    var map = null;
    
    $(document).ready(function(){
    
      $('.acf-map').each(function(){
    
 
        map = new_map( $(this) );

      });
     
         
          google.maps.event.addListener( map, 'zoom_changed', function( e ) {
              
              var zoom = map.getZoom();   
          
                 if(zoom!= 5)           
                 {
          var bounds = map.getBounds();
          
                   myLatLngss = [];
                    $.each( map.markers, function( i, marker ){     
          var myLatLng = new google.maps.LatLng(marker.position.lat(), marker.position.lng() ); 
                
          if(bounds.contains(myLatLng)===true) {            
                     myLatLngss.push( myLatLng );
              }
              else {
                   
              }
          });
                   if(myLatLngss.length > 0)
                   { 
                     document.cookie = "coordn="+myLatLngss;
                     $("#customzm").load(location.href + " #customzm");                 
                   } 
                } 
                 
             });
       google.maps.event.addListener(map, 'dragend', function() {
     
       var bounds = map.getBounds();
          
                      myLatLngss = [];
                    $.each( map.markers, function( i, marker ){
    
          var myLatLng = new google.maps.LatLng(marker.position.lat(), marker.position.lng() ); 
              
          if(bounds.contains(myLatLng)===true) {            
                     myLatLngss.push( myLatLng );
              }
              else {
       
              }
               if(myLatLngss.length > 0)
                   {
                     document.cookie = "coordn="+myLatLngss;
                     $("#customzm").load(location.href + " #customzm");                 
                   }
          });
       
     } );
            
    
    });
    
    })(jQuery);
