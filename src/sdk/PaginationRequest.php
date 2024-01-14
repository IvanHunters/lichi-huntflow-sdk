<?php

declare(strict_types=1);


namespace Lichi\Omnidesk\Sdk;


use GuzzleHttp\RequestOptions;
use Lichi\Omnidesk\ApiProvider;

class PaginationRequest
{

    /**
     * @var ApiProvider
     */
    protected ApiProvider $apiProvider;

    public function __construct(ApiProvider $provider)
    {
        $this->apiProvider = $provider;
    }

    public function get($type, $method, $body): array
    {
        $page = 1;
        $body[RequestOptions::QUERY]['page'] = $page;
        $response = $this->apiProvider->callMethod(
            $type,
            $method,
            $body
        );

        if (!isset($response['total_items'])) {
            $totalCount = 1000000;
        } else {
            $totalCount = $response['total_items'];
            unset($response['total_items']);
        }

        $countInResponse = count($response['items']);

        if ($countInResponse < $totalCount)
        {
            $responseData = $response;
            while($countInResponse < $totalCount)
            {
                $page++;
                $body[RequestOptions::QUERY]['page'] = $page;
                $response = $this->apiProvider->callMethod(
                    $type,
                    $method,
                    $body
                );

                unset($response['total_count']);

                $responseData['items'] = array_merge($responseData['items'], $response['items']);
                $countInResponse+= count($response['items']);
            }
            $responseData['total_count'] = $totalCount;

            return $responseData;
        } else {
            $response['total_count'] = $totalCount;
            return $response;
        }

    }


}