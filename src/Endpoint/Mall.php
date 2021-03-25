<?php

namespace KAPIClient\Endpoint;

class Mall extends Base
{
  public function getList()
  {
    return $this->client->get('mall/list');
  }
}
