<?php

declare(strict_types=1);

namespace Lichi\Huntflow\Sdk;

use GuzzleHttp\RequestOptions;

class Token extends Module
{

    public function refresh(string $refreshToken): array
    {
        return $this->apiProvider->callMethod(
            "POST",
            "/v2/token/refresh",
            [
                RequestOptions::JSON => [
                    "refresh_token" => $refreshToken
                ]
            ]
            );
    }


}