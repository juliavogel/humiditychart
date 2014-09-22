<?php
require dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'mysql.php';

define( 'T_KEY' , 't' );
define( 'H_KEY' , 'h' );
define( 'TS_KEY', 'ts' );

class Job
{
    private $_t;
    private $_h;
    private $_ts;
    private $_id;

    public function __construct( $sensor_id )
    {
        $this->_id = $sensor_id;
    }

    public function run( $sensor_file )
    {
        $data = file( $sensor_file );

        foreach( $data as $line ){

            list( $key, $val ) = explode( "=", $line );

            switch( $key )
            {
                case T_KEY:
                    $this->t = trim( $val );
                    continue;

                case H_KEY:
                    $this->_h = trim( $val );
                    continue;

                case TS_KEY:
                    $this->_ts = trim( $val );
                    continue;
            }
        }

        $mysql = MySQL::Create();
        $sql = "INSERT INTO sensor_data VALUES ( 0, '%s', FROM_UNIXTIME( %s ), '%s', '%s' )";
        $sql = sprintf( $sql, $this->_id, $this->_ts, $this->t, $this->_h );
        $mysql->query( $sql );
    }
}
?>