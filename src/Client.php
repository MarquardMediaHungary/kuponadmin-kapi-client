<?php

namespace KAPIClient;

use GuzzleHttp\Client as GuzzleClient;
use Psr\Http\Message\ResponseInterface;

class Client
{
  const API_ENDPOINT = 'http://dev.kuponapi.kuponadmin.joynapok.hu';

  private $apiKey;
  private $httpClient;

  public function __construct(string $apiKey)
  {
    $this->apiKey = $apiKey;
    $this->setHttpClient();
  }

  public function test()
  {
    try {
      $response = $this->httpClient->get('/');
      $response = $this->handleResponse($response);

      print_r($response);
    }
    catch (\Exception $e) {
      echo $e->getMessage();
    }
  }

  private function handleResponse(ResponseInterface $response)
  {
    $resp = json_decode($response->getBody(), true);

    if (!isset($resp['success']) || !$resp['success']) {
      throw new \Exception(!empty($resp['error']) ? $resp['error'] : 'Unknown error');
    }

    return $resp['payload'];
  }

  private function setHttpClient()
  {
    $headers = [
      'X-Api-Key' => $this->apiKey
    ];

    $this->httpClient = new GuzzleClient([
      'base_uri' => self::API_ENDPOINT,
      'headers' => $headers
    ]);
  }
}
