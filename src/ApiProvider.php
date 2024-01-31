<?php


namespace Lichi\Huntflow;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Lichi\Huntflow\Sdk\Accounts;
use Lichi\Huntflow\Sdk\Applicants;
use Lichi\Huntflow\Sdk\Module;
use Lichi\Huntflow\Sdk\Statuses;
use Lichi\Huntflow\Sdk\Token;
use Lichi\Huntflow\Sdk\Vacancies;
use RuntimeException;

class ApiProvider
{
    private Client $client;
    private string $token;

    /**
     * ApiProvider constructor.
     * @param Client $client
     * @param string $token
     */
    public function __construct(Client $client, string $token)
    {
        $this->client = $client;
        $this->token = $token;
    }

    public function setToken(string $token)
    {
        $this->token = $token;
    }

    /**
     * @param string $typeRequest
     * @param string $method
     * @param array $params
     * @return mixed
     */
    public function callMethod(string $typeRequest, string $method, array $params = [])
    {
        usleep(380000);
        try {
            $params[RequestOptions::HEADERS]['Authorization'] = 'Bearer '. $this->token;
            $response = $this->client->request($typeRequest, $method, $params);
        } catch (GuzzleException $exception){
            try {
                $response = $exception->getResponse()->getBody(true);
            } catch (\Throwable $e) {
                throw new RuntimeException(sprintf(
                    "API ERROR, Method: %s\nParams: %s",
                    $method,
                    json_encode($params, JSON_UNESCAPED_UNICODE)
                ));
            }

            throw new RuntimeException(sprintf(
                "API ERROR, Method: %s\nParams: %s\nResponse: %s",
                $method,
                json_encode($params, JSON_UNESCAPED_UNICODE),
                $response,
            ));
        }

        if ($response->getStatusCode() != 200) {
            throw new RuntimeException(sprintf(
                "Http status code not 200, got %s status code, message: %s",
                $response->getStatusCode(),
                $response->getReasonPhrase()
            ));
        }

        /** @var string $content */
        $content = $response->getBody()->getContents();

        /** @var array $response */
        $response = json_decode($content, true);

        return $response;
    }

    public function accounts(){
        $self = clone $this;
        return new Accounts($self);
    }
    public function applicants(){
        $self = clone $this;
        return new Applicants($self);
    }
    public function module(){
        $self = clone $this;
        return new Module($self);
    }
    public function statuses(){
        $self = clone $this;
        return new Statuses($self);
    }
    public function vacancies(){
        $self = clone $this;
        return new Vacancies($self);
    }
    public function token(){
        $self = clone $this;
        return new Token($self);
    }

}