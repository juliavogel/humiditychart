<?php

class MySQL
{
    private $_mysqli;
    private $_result;

    public static function Create()
    {
        $db = new MySQL( dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'etc' . DIRECTORY_SEPARATOR . 'connection.ini' );
        return $db;
    }

    private function __construct( $ini )
    {
        $data = parse_ini_file( $ini );
        $this->_mysqli = new mysqli( $data['host'], $data['user'], $data['pw'], $data['db']);
    }

    public function __destruct()
    {
        $this->_mysqli->close();
    }

    public function query( $sql )
    {
        $this->_result = $this->_mysqli->query( $sql );
    }

    public function fetchObjects()
    {
        $array = array();

        while( $obj = $this->_result->fetch_object() ){
            array_push( $array, $obj );
        }

        $this->_result->close();

        return $array;
    }
}
?>
