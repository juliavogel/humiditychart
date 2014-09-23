<?php
require dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'mysql.php';
$mysql = MySQL::Create();

$sql = "SELECT DATE_FORMAT( ts, '%H:%i') as ts, temperature, humidity FROM sensor_data WHERE DATE(ts) = CURRENT_DATE() ORDER BY ts ASC";
$mysql->query($sql);
$list = $mysql->fetchObjects();

function get_arrays( $list, &$labels, &$temp, &$hum )
{

    foreach( $list as $obj ){
        array_push( $labels, sprintf( '"%s"' , $obj->ts  ) );
        array_push( $temp, sprintf( '"%s"' , $obj->temperature  ) );
        array_push( $hum, sprintf( '"%s"' , $obj->humidity  ) );
    }


}

$lables = array();
$temp = array();
$hum = array();

get_arrays( $list, $lables, $temp, $hum );

$lables =  implode( ',', $lables );
$temp =   implode( ',', $temp );
$hum =  implode( ',', $hum );


$js = '
var lineChartData = {
    labels : [%s],
        datasets : [
            {
                label: "Temperatue",
               fillColor: "rgba(255,0,0,0.2)",
            strokeColor: "rgba(220,220,220,1)",
            pointColor: "rgba(255,0,0,0.5)",
            pointStrokeColor: "#f00",
            pointHighlightFill: "#f00",
            pointHighlightStroke: "rgba(220,220,220,1)",
                data : [%s]
            },
            {
            label: "Humidity",
            fillColor: "rgba(51,102,153,0.2)",
            strokeColor: "rgba(151,187,205,1)",
            pointColor: "rgba(151,187,205,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(151,187,205,1)",
                data : [%s]
            },
        ]
    }';

echo  sprintf( $js, $lables, $temp, $hum );
?>
