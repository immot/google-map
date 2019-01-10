
var markers ;

$( document ).ready( function() 
{
    markers = new Markers() ;
} ) ;

function Markers()
{
    this.all = new Array() ;
}

Markers.prototype.add = function ( index , map , title , latitude , longitude , info , callback )
{
    var pos = { lat:Number( latitude ) , lng:Number( longitude ) } ;

    var marker = new google.maps.Marker(
    {
        position:pos ,
        map: map,
        title: title,
        label: 
        {
            text: ( 1 + index ).toString() ,
            color: 'white',
            fontSize: '16px',
            fontWeight: 'bold'
        }
    } ) ;

    marker.info = info ;

    marker.addListener( 'click' , function()
    {
        if( callback )
        {
            callback( index ) ;
        }

        markers.center( map , marker ) ;

    } ) ;

    this.all.push( marker ) ;

    return pos ;
}

Markers.prototype.clear = function ()
{
    var i ;

    for( i = 0 ; i < this.all.length ; i++ )
    {
        this.all[i].setMap( null ) ;
    }

    this.all = new Array() ;
}

Markers.prototype.centerByIndex = function ( map , index )
{
    this.center( map , this.all[ index ] ) ;
}

Markers.prototype.center = function ( map , marker )
{
    if( this.infoWindow )
    {
        this.infoWindow.close() ;
    }

    this.infoWindow = new google.maps.InfoWindow( 
    {
        content: marker.info
    } ) ;
    
    this.infoWindow.open( map , marker ) ;
}