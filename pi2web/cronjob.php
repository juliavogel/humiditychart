<?php
/**
 * Created by PhpStorm.
 * User: axel
 * Date: 22.09.14
 * Time: 15:38
 */

require 'job.php';

$job = new Job( 'basement' );
$job->run( 'sensor.data' );