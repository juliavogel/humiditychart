<?php

$sensor_id = 'base';

$temperature_key = 't';
$temperature;

$humidity_key = 'h';
$humidity;

$timestamp_key = 'ts';
$timestamp;

$data = file( 'sensor.data' );

foreach( $data as $line ){

    list( $key, $val ) = explode( "=", $line );

    switch( $key )
    {
        case $temperature_key:
             $temperature = trim( $val );
            continue;

        case $humidity_key:
            $humidity = trim( $val );
            continue;

        case $timestamp_key:
            $timestamp = trim( $val );
            continue;
    }
}

$mysql = mysql_connect( 'localhost', 'root', '' ) or die( 'unable to connect to mysql' );
mysql_select_db( 'home_auto', $mysql ) or die( 'unable to select database');
$sql = "INSERT INTO sensor_data VALUES ( 0, '%s', FROM_UNIXTIME( %s ), '%s', '%s' )";
$sql = sprintf( $sql, $sensor_id, $timestamp, $temperature, $humidity );
mysql_query( $sql, $mysql) or die( 'unable to execute sql');
mysql_close( $mysql );
?>