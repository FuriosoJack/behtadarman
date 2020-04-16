<?php

namespace Aws\Pricing;

use Aws\AwsClient;
use Aws\Result;
use GuzzleHttp\Promise\Promise;

/**
 * This client is used to interact with the **AWS Price List Service** service.
 * @method Result describeServices( array $args = [] )
 * @method Promise describeServicesAsync( array $args = [] )
 * @method Result getAttributeValues( array $args = [] )
 * @method Promise getAttributeValuesAsync( array $args = [] )
 * @method Result getProducts( array $args = [] )
 * @method Promise getProductsAsync( array $args = [] )
 */
class PricingClient extends AwsClient {
}
