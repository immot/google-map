<?php
    include_once "db.php";

    $action = $_REQUEST[ "action" ] ;

    $db = new Database() ;

    $db->open() ;

    switch( $action )
    {
        case "GET_CITY_LIST" :
            $db->GetCityList() ;
            break ;

        case "GET_STATE_LIST" :
            $db->GetStateList() ;
            break ;

        case 'SEARCH_BY_PIN_CODE' :
            $db->SearchByPinCode( $_REQUEST[ "para" ] ) ;
            break ;

        case 'SEARCH_BY_CITY' :
            $db->SearchByCity( $_REQUEST[ "para" ] ) ;
            break ;

        case 'SEARCH_BY_STATE' :
            $db->SearchByState( $_REQUEST[ "para" ] ) ;
            break ;
    }

    $db->close() ;

?>