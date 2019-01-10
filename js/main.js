

var mapUtility ;

function initMap() 
{
    mapUtility = new MapUtility() ;
}

function MapUtility()
{
    this.map = new google.maps.Map( document.getElementById( 'map' ) , 
    {
        center: { lat: 24.714445 , lng: 120.913931 } ,
        zoom: 16
    } ) ;

    this.callAjax( function( result )
    {
        document.getElementById( 'selectState' ).innerHTML = result ;
        //$( '#debugging' ).val( result ) ;

    } , 'GET_STATE_LIST' ) ;

    if ( navigator.geolocation ) 
    {
        navigator.geolocation.getCurrentPosition( function( position ) 
        {
            mapUtility.currentPosition = 
            {
                lat: position.coords.latitude ,
                lng: position.coords.longitude
            } ;
        } , function() 
        {
        } ) ;
    } 
    else 
    {
        // Browser doesn't support Geolocation
    }
}

MapUtility.prototype.callAjax = function ( callback , action , p )
{
    var url ;
    var xmlhttp = new XMLHttpRequest() ;

    xmlhttp.onreadystatechange = function() 
    {
        if ( this.readyState == 4 && this.status == 200 ) 
        {
            if( callback )
            {
                callback( this.responseText ) ;
            }
        }
    };

    url = "mapFunction.php?action=" + action ;

    if( p )
    {
        url += '&para=' + p ;
    }

    xmlhttp.open( "POST", url , true ) ;
    xmlhttp.send() ;
}

MapUtility.prototype.onStateChange = function()
{
    var geocoder ;
    var state = $( "#selectState option:selected" ).text() ;

    if( state != 'Choose...' )
    {
        geocoder = new google.maps.Geocoder();

        geocoder.geocode( { 'address': state } , function( results , status ) 
        {
            if ( status === 'OK' ) 
            {
                mapUtility.callAjax( function( result )
                {
                    //$( '#debugging' ).val( result ) ;

                    //mapUtility.showSearchResult( result ) ;

                    //mapUtility.map.setCenter( results[0].geometry.location ) ;

                    $( '#selectCity' )[0].innerHTML = result ;

                } , 'SEARCH_BY_STATE' , state ) ;

            } 
            else 
            {
            }
        } ) ;
    }
}

MapUtility.prototype.onCityChange = function()
{
    var geocoder ;
    var city = $( "#selectCity option:selected" ).text() ;

    if( city != 'Choose...' )
    {
        geocoder = new google.maps.Geocoder();

        geocoder.geocode( { 'address': city } , function( results , status ) 
        {
            if ( status === 'OK' ) 
            {
                mapUtility.callAjax( function( result )
                {
                    //$( '#debugging' ).val( result ) ;

                    mapUtility.showSearchResult( result ) ;

                    mapUtility.map.setCenter( results[0].geometry.location ) ;

                } , 'SEARCH_BY_CITY' , city ) ;

            } 
            else 
            {
            }
        } ) ;
    }
}

MapUtility.prototype.search = function()
{
    this.callAjax( function( result )
    {
        mapUtility.showSearchResult( result ) ;
        
    } , 'SEARCH_BY_PIN_CODE' , $( '#pinCode' ).val() ) ;
}

MapUtility.prototype.showSearchResult = function( result )
{
    var i , s = '' , info , pos , res ;

    // <div class="list-group-item list-group-item-action" data-toggle="list" role="tab" >
    //     <h3>Profile</h3>
    //     <p>67890</p>
    //     <button type="button" class="btn btn-warning">dark</button>
    // </div>

    try
    {
        res = JSON.parse( result ) ;

        if( res.length > 0 )
        {
            markers.clear() ;

            for( i = 0 ; i < res.length ; i++ )
            {
                // info = '<div style="margin-bottom:30px" >' ;
                info = '<h6>' + ( 1 + i ).toString() + '. ' + res[i].STORE_NAME + '</h6>' ;
                info += '<p style="font-size:.7rem" >' + res[i].ADDRESS + '</p>' ;
                info += '<button type="button" class="btn btn-warning" style="float:right" >Guidings</button>' ;
                // info += '</div>' ;

                // s += '<li>' + info + '</li>' ;

                s += '<div class="list-group-item list-group-item-action" data-toggle="list" style="width:230px;" role="tab" onclick="mapUtility.onStoreClick( ' + i + ' )" >' ;
                s += info ;
                s += '</div>' ;

                pos = markers.add( i , mapUtility.map , res[i].STORE_NAME , res[i].LATITUDE , res[i].LONGITUDE , info ) ;
            }

            mapUtility.map.setZoom( 14 ) ;
            mapUtility.map.setCenter( pos ) ;
        }

        $( '#listResult' )[0].innerHTML = s ;
    }
    catch( exception )
    {
        alert( exception.message ) ;
    }
}

MapUtility.prototype.onStoreClick = function( index )
{
    markers.centerByIndex( this.map , index ) ;
}