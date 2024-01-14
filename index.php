<?php

include "vendor/autoload.php";

use Lichi\Omnidesk\ApiProvider;
use GuzzleHttp\Client;

$client = new Client([
    'base_uri' => "https://api.huntflow.ru",
    'verify' => false,
    'timeout'  => 30.0
]);

$apiProvider = new ApiProvider($client, '');

//$accounts = $apiProvider->accounts()->get();
$applicants = $apiProvider->applicants()->get(21543, []);

$a = 10;
//$groups = $apiProvider->groups()->get();
//$employees = $apiProvider->employees()->get();
//$customFields = $apiProvider->customFields()->get();
