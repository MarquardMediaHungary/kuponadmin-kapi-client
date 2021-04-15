<?php

namespace KAPIClient;

use GuzzleHttp\Client as GuzzleClient;
use Psr\Http\Message\ResponseInterface;

class Client
{
  const API_ENDPOINT = 'https://kuponapi.kuponadmin.joynapok.hu';

  /** @var KAPIClient\Endpoint\Bundle */
  public $bundles;

  /** @var KAPIClient\Endpoint\Coupon */
  public $coupons;

  /** @var KAPIClient\Endpoint\Category */
  public $categories;

  /** @var KAPIClient\Endpoint\Event */
  public $events;

  /** @var KAPIClient\Endpoint\Mall */
  public $malls;

  private $apiKey;
  private $httpClient;

  public function __construct(string $apiKey)
  {
    $this->apiKey = $apiKey;
    $this->setHttpClient();

    $this->bundles = new Endpoint\Bundle($this);
    $this->coupons = new Endpoint\Coupon($this);
    $this->categories = new Endpoint\Category($this);
    $this->events = new Endpoint\Event($this);
    $this->malls = new Endpoint\Mall($this);
  }

  public function get(string $endpoint, array $params = [])
  {
    $options = (!empty($params) ? ['query' => $params] : []);

    try {
      $response = $this->httpClient->get($endpoint, $options);

      return $this->handleResponse($response);
    }
    catch (\Exception $e) {
      echo 'Error: ' . $e->getMessage();
    }
  }

  public function post(string $endpoint, array $params = [])
  {
    $options = (!empty($params) ? ['json' => $params] : []);

    try {
      $response = $this->httpClient->post($endpoint, $options);

      return $this->handleResponse($response);
    }
    catch (\Exception $e) {
      echo 'Error: ' . $e->getMessage();
    }
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
