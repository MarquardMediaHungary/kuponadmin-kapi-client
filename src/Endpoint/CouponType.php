<?php

namespace KAPIClient\Endpoint;

class CouponType extends Base
{
  public function getList()
  {
    return $this->client->get('coupon-types');
  }
}
