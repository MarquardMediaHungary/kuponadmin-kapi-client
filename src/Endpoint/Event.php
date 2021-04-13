<?php

namespace KAPIClient\Endpoint;

class Event extends Base
{
  /**
   * Create event
   *
   * @param int $couponId         Kuponadmin coupon ID
   * @param string $event         Kuponadmin coupon event type slug
   * @param array | string $data  Event data
   */
  public function create(int $couponId, string $event, $data = null)
  {
    $params = [
      'coupon_id'  => $couponId,
      'event'      => $event,
      'data'       => $data
    ];

    return $this->client->post('event', $params);
  }
}
