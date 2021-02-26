<?php

namespace KAPIClient\Endpoint;

class Coupon extends Base
{
  public function getListByBundleId(int $bundleId)
  {
    return $this->client->get('coupon/list/by-bundle/' . $bundleId);
  }
}
