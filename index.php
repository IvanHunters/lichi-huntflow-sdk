<?php

include "vendor/autoload.php";

use Lichi\Huntflow\ApiProvider;
use GuzzleHttp\Client;

$client = new Client([
    'base_uri' => "https://api.huntflow.ru",
    'verify' => false,
    'timeout'  => 30.0
]);

$apiProvider = new ApiProvider($client, getenv('API_KEY'));

//$accounts = $apiProvider->accounts()->get();
$applicants = $apiProvider->applicants()->get(21543, []);

$a = 10;
//$groups = $apiProvider->groups()->get();
//$employees = $apiProvider->employees()->get();
//$customFields = $apiProvider->customFields()->get();
