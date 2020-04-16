<?php

namespace Aws\ComprehendMedical;

use Aws\AwsClient;
use Aws\Result;
use GuzzleHttp\Promise\Promise;

/**
 * This client is used to interact with the **AWS Comprehend Medical** service.
 * @method Result detectEntities( array $args = [] )
 * @method Promise detectEntitiesAsync( array $args = [] )
 * @method Result detectPHI( array $args = [] )
 * @method Promise detectPHIAsync( array $args = [] )
 */
class ComprehendMedicalClient extends AwsClient {
}
