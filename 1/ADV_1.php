<html>
    <head>
    </head>
    <body>
    </body>
    <link rel="stylesheet" type="text/css" href="./style.css">
</html>
<?php

require '../vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;

$i = 1;

$client = new Client();

$res = $client->request('GET', 'https://ir-revamp-dev.innoraft-sites.com/jsonapi/node/services');

$res_body = $res->getBody();
$json = json_decode($res_body);

foreach($json->data as $key => $val){
    
    $title = $val->attributes->title; 
    $value = $val->attributes->body->value;

    $points = $val->attributes->field_services->value;
    
    $image_location = $val->relationships->field_image->links->related->href;

    $image_req = $client->request('GET',$image_location);

    $image_req_body = $image_req->getBody();
    $image_json = json_decode($image_req_body);
    $image_path = 'https://ir-revamp-dev.innoraft-sites.com/'.$image_json->data->attributes->uri->url;

    if($i % 2 == 0)
    {
        $main_class = 'main-div-even';
        $img_class = 'image-div-even';
        $text_class = 'text-div-even';
    } else {
        $main_class = 'main-div-odd';
        $img_class = 'image-div-odd';
        $text_class = 'text-div-odd';
    }

    echo "<div class='$main_class'>";
        echo "<div class='$img_class'>";
            echo "<img src = '$image_path'width='300px' height='300px'>";
        echo "</div>";
        echo "<div class='$text_class'>";
            echo "<div class = 'title-div'>";
            echo "<h1> $i </h1>";
                echo "<h2>$title</h2>";
            echo "</div>";
            echo "<p>$value</p>";
            echo "<p>$points</p>";
        echo "</div>";
    echo "</div>";
    $i++;
}

/*for($i = 0; $i <= $total; $i++)
{
    
}*/
?>