<?php

namespace Aws\Translate;

use Aws\AwsClient;
use Aws\Result;
use GuzzleHttp\Promise\Promise;

/**
 * This client is used to interact with the **Amazon Translate** service.
 * @method Result deleteTerminology( array $args = [] )
 * @method Promise deleteTerminologyAsync( array $args = [] )
 * @method Result getTerminology( array $args = [] )
 * @method Promise getTerminologyAsync( array $args = [] )
 * @method Result importTerminology( array $args = [] )
 * @method Promise importTerminologyAsync( array $args = [] )
 * @method Result listTerminologies( array $args = [] )
 * @method Promise listTerminologiesAsync( array $args = [] )
 * @method Result translateText( array $args = [] )
 * @method Promise translateTextAsync( array $args = [] )
 */
class TranslateClient extends AwsClient {
}
