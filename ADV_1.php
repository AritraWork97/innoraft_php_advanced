<?php

require './vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;

$client = new Client();

$res = $client->request('GET', 'https://ir-revamp-dev.innoraft-sites.com/jsonapi/node/services');

$res_body = $res->getBody();
$json = json_decode($res_body);

$title = $json->data[0]->attributes->title; 
$value = $json->data[0]->attributes->body->value;

$points = $json->data[0]->attributes->field_services->value;
$image_location = $json->data[0]->relationships->field_image->links->related->href;

$image_req = $client->request('GET',$image_location);

$image_req_body = $image_req->getBody();
$image_json = json_decode($image_req_body);
$image_path = 'https://ir-revamp-dev.innoraft-sites.com/'.$image_json->data->attributes->uri->url;


echo "<h1>$title</h1>";
echo "<p>$value</p>";
echo "<p>$points</p>";
echo "<img src = '$image_path' width='100px' height='100px'>";




?>