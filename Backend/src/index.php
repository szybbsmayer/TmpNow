<?php
require 'vendor/autoload.php';
 
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

$app->get('/get/tmp/current', function (Request $request, Response $response, array $args) {
    $data = $request->getQueryParams();
    $device = $data["device"];
    //if(!isset($device)) return $response->withJson(array("Error" => "Wrong Parameters"));
 
    $client = new InfluxDB\Client("influx", "8086");
    $database = $client->selectDB("TmpNow");

    $result = $database->query('select * from data where device= \''.$device.'\' LIMIT 1');
    
    $arr = $points = $result->getPoints();
    $tmp = $arr['0']['temperature'];
    
    
    return $response->withJson(array("temperature" => $tmp));
    
});
$app->get('/get/p/current', function (Request $request, Response $response, array $args) {
    $data = $request->getQueryParams();
    $device = $data["device"];
    //if(!isset($device)) return $response->withJson(array("Error" => "Wrong Parameters"));
 
    $client = new InfluxDB\Client("influx", "8086");
    $database = $client->selectDB("TmpNow");

    $result = $database->query('select * from data where device= \''.$device.'\' LIMIT 1');
    
    $arr = $points = $result->getPoints();
    $p = $arr['0']['pressure'];
    
    
    return $response->withJson(array("pressure" => $p));
    
});
$app->get('/get/hum/current', function (Request $request, Response $response, array $args) {
    $data = $request->getQueryParams();
    $device = $data["device"];
    //if(!isset($device)) return $response->withJson(array("Error" => "Wrong Parameters"));
 
    $client = new InfluxDB\Client("influx", "8086");
    $database = $client->selectDB("TmpNow");

    $result = $database->query('select * from data where device= \''.$device.'\' LIMIT 1');
    
    $arr = $points = $result->getPoints();
    $hum = $arr['0']['humidity'];
    
    
    return $response->withJson(array("humidity" => $hum));
    
});


$app->run();
?>
