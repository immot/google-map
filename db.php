
<?php

define( 'MYSQL_BOTH' , MYSQLI_BOTH ) ;
define( 'MYSQL_NUM' , MYSQLI_NUM ) ;
define( 'MYSQL_ASSOC' , MYSQLI_ASSOC ) ;

class Database
{
 
    // specify your own database credentials
    public $host ;
    public $db_name ;
    public $username ;
    public $password ;
    public $conn ;

    public function __construct() 
    {

        $this->host = "localhost";
        $this->db_name = "test2";
        $this->username = "root";
        $this->password = "";

    }
 
    // get the database connection
    public function open()
    { 

        $this->conn = new mysqli( $this->host , $this->username , $this->password , $this->db_name ) ;

        if ( $this->conn->connect_errno ) 
        {
            echo "connect failed" ;
        }
        else
        {           
            //echo 'Current PHP version: ' . phpversion() ;
        }
    }

    public function close()
    { 
        $this->conn->close() ;
    }

    public function GetCityList()
    {
        $sql = "SELECT city FROM store_location group by city order by city" ;

        $this->getList( $sql , 'city' ) ;
    }

    public function GetStateList()
    {
        $sql = "SELECT state FROM `store_location` GROUP by STATE order by STATE" ;

        $this->getList( $sql , 'state' ) ;
    }

    public function SearchByPinCode( $pinCode )
    {
        $sql = "select * from store_location where PIN_CODE = %d" ;

        $sql = sprintf( $sql , $pinCode ) ;

        $this->query( $sql ) ;
    }

    public function SearchByCity( $city )
    {
        $sql = "select * from store_location where CITY = '%s'" ;

        $sql = sprintf( $sql , $city ) ;

        $this->query( $sql ) ;
    }

    public function SearchByState( $state )
    {
        //$sql = "select * from store_location where STATE = '%s'" ;

        $sql = "SELECT city FROM `store_location` WHERE state = '%s' GROUP by city order by city" ;

        $sql = sprintf( $sql , $state ) ;

        //$this->query( $sql ) ;
        $this->getList( $sql , 'city' ) ;
    }

    public function query( $sql )
    {
        $rows = Array() ;

        if ( $result = $this->conn->query( $sql ) ) 
        {
            while( $row = $result->fetch_array( MYSQL_ASSOC ) ) 
            {
                $rows[] = $row ;
            }

            echo json_encode( $rows ) ;

            $result->close() ;
        }
        else
        {
            echo $this->conn->error ;
        }
    }

    public function getList( $sql , $item )
    {
        $s = "<option selected>Choose...</option>" ;

        if ( $result = $this->conn->query( $sql ) ) 
        {

            while( $row = $result->fetch_array( MYSQL_ASSOC ) ) 
            {
                $opt = '<option>' . $row[ $item ] . '</option>' ;
                $s = $s . $opt ;
            }

            echo $s ;

            $result->close() ;
        }
        else
        {
            echo $this->conn->error ;
        }
    }


}

?>