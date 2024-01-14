<?php

declare(strict_types=1);

namespace Lichi\Omnidesk\Sdk;

use GuzzleHttp\RequestOptions;

class Applicants extends Module
{

    public function get(string $company, array $filters = []): array
    {
        return $this->paginationRequest->get(
            "GET",
            sprintf("/v2/accounts/%s/applicants", $company),
            [
                RequestOptions::QUERY => $filters
            ]
            );
    }


}