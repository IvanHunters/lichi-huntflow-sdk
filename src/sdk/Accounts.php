<?php

declare(strict_types=1);

namespace Lichi\Huntflow\Sdk;

use GuzzleHttp\RequestOptions;

class Accounts extends Module
{

    public function get(array $filters = []): array
    {
        return $this->paginationRequest->get(
            "GET",
            "/v2/accounts",
            $filters
            );
    }


}