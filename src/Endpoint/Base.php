<?php

namespace KAPIClient\Endpoint;

class Base
{
  /** @var KAPIClient\Client */
  protected $client;

  public function __construct($client)
  {
    $this->client = $client;
  }
}
