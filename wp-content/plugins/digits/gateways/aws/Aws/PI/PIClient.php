<?php

namespace Aws\PI;

use Aws\AwsClient;
use Aws\Result;
use GuzzleHttp\Promise\Promise;

/**
 * This client is used to interact with the **AWS Performance Insights** service.
 * @method Result describeDimensionKeys( array $args = [] )
 * @method Promise describeDimensionKeysAsync( array $args = [] )
 * @method Result getResourceMetrics( array $args = [] )
 * @method Promise getResourceMetricsAsync( array $args = [] )
 */
class PIClient extends AwsClient {
}
