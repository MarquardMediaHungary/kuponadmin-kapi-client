<?php

namespace KAPIClient\Endpoint;

class Category extends Base
{
  public function getList()
  {
    return $this->client->get('category/list');
  }
}
