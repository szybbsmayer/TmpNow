<?php
require 'vendor/autoload.php';
 
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

$app->get('/get/devices', function (Request $request, Response $response, array $args) {
    //if(!isset($device)) return $response->withJson(array("Error" => "Wrong Parameters"));
 
    $client = new InfluxDB\Client("influx", "8086");
    $database = $client->selectDB("TmpNow");

    $result = $database->query('show tag values from data with key = device');
    
    $arr = $result->getPoints();
    
    return $response->withJson($arr);
    
});
$app->get('/get/current', function (Request $request, Response $response, array $args) {
    $data = $request->getQueryParams();
    $device = $data["device"];
    //if(!isset($device)) return $response->withJson(array("Error" => "Wrong Parameters"));
 
    $client = new InfluxDB\Client("influx", "8086");
    $database = $client->selectDB("TmpNow");

    $result = $database->query('select * from data where device= \''.$device.'\' LIMIT 1');
    
    $arr = $points = $result->getPoints();
    $arr = $arr['0'];
    
    
    return $response->withJson($arr);
    
});
$app->get('/get/list', function (Request $request, Response $response, array $args) {
    $data = $request->getQueryParams();
    $device = $data["device"];
    $starttime = $data['starttime'];
    $endtime = $data['endtime'];
    //if(!isset($device)) return $response->withJson(array("Error" => "Wrong Parameters"));
 
    $client = new InfluxDB\Client("influx", "8086");
    $database = $client->selectDB("TmpNow");

    $result = $database->query('select * from data where device= \''.$device.'\' and time < \''.$endtime.'\' and time > \''.$starttime.'\'');
    
    $arr = $points = $result->getPoints();
    $tmp = $arr;
    
    
    return $response->withJson($tmp);
    
});
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

$app->get('/get/tmp/list', function (Request $request, Response $response, array $args) {
    $data = $request->getQueryParams();
    $device = $data["device"];
    $starttime = $data['starttime'];
    $endtime = $data['endtime'];
    //if(!isset($device)) return $response->withJson(array("Error" => "Wrong Parameters"));
 
    $client = new InfluxDB\Client("influx", "8086");
    $database = $client->selectDB("TmpNow");

    $result = $database->query('select device,temperature from data where device= \''.$device.'\' and time < \''.$endtime.'\' and time > \''.$starttime.'\'');
    
    $arr = $points = $result->getPoints();
    $tmp = $arr;
    
    
    return $response->withJson(array("temperature" => $tmp));
    
});
$app->get('/get/p/list', function (Request $request, Response $response, array $args) {
    $data = $request->getQueryParams();
    $device = $data["device"];
    $starttime = $data['starttime'];
    $endtime = $data['endtime'];
    //if(!isset($device)) return $response->withJson(array("Error" => "Wrong Parameters"));
 
    $client = new InfluxDB\Client("influx", "8086");
    $database = $client->selectDB("TmpNow");

    $result = $database->query('select device,pressure from data where device= \''.$device.'\' and time < \''.$endtime.'\' and time > \''.$starttime.'\'');
    
    $arr = $points = $result->getPoints();
    $p = $arr;
    
    
    return $response->withJson(array("pressure" => $p));
    
});
$app->get('/get/hum/list', function (Request $request, Response $response, array $args) {
    $data = $request->getQueryParams();
    $device = $data["device"];
    $starttime = $data['starttime'];
    $endtime = $data['endtime'];
    //if(!isset($device)) return $response->withJson(array("Error" => "Wrong Parameters"));
 
    $client = new InfluxDB\Client("influx", "8086");
    $database = $client->selectDB("TmpNow");

    $result = $database->query('select device,humidity from data where device= \''.$device.'\' and time < \''.$endtime.'\' and time > \''.$starttime.'\'');
    
    $arr = $points = $result->getPoints();
    $hum = $arr;
    
    
    return $response->withJson(array("humidity" => $hum));
    
});


$app->run();
?>
