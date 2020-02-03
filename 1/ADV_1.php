<?php

require '../vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;

$i = 0;

$client = new Client();

$res = $client->request('GET', 'https://ir-revamp-dev.innoraft-sites.com/jsonapi/node/services');

$res_body = $res->getBody();
$json = json_decode($res_body);

$total = 7;

for($i = 0; $i < $total; $i++)
{
    $title = $json->data[$i]->attributes->title; 
    $value = $json->data[$i]->attributes->body->value;

    $points = $json->data[$i]->attributes->field_services->value;
    
    $image_location = $json->data[$i]->relationships->field_image->links->related->href;

    $image_req = $client->request('GET',$image_location);

    $image_req_body = $image_req->getBody();
    $image_json = json_decode($image_req_body);
    $image_path = 'https://ir-revamp-dev.innoraft-sites.com/'.$image_json->data->attributes->uri->url;


    echo "<h1>$title</h1>";
    echo "<p>$value</p>";
    echo "<p>$points</p>";
    echo "<img src = '$image_path' width='100px' height='100px'>";

}
?>