<?php

declare(strict_types=1);

namespace Lichi\Huntflow\Sdk;

use GuzzleHttp\RequestOptions;

class Vacancies extends Module
{

    public function get(string $company, array $filters = []): array
    {
        return $this->paginationRequest->get(
            "GET",
            sprintf("/v2/accounts/%s/vacancies", $company),
            [
                RequestOptions::QUERY => $filters
            ]
            );
    }


}