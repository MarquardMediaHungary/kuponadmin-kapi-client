<?php

namespace KAPIClient\Endpoint;

class Bundle extends Base
{
  public function getList()
  {
    return $this->client->get('bundle/list');
  }
}
