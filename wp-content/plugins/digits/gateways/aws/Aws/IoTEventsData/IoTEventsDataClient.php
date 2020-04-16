<?php

namespace Aws\IoTEventsData;

use Aws\AwsClient;
use Aws\Result;
use GuzzleHttp\Promise\Promise;

/**
 * This client is used to interact with the **AWS IoT Events Data** service.
 * @method Result batchPutMessage( array $args = [] )
 * @method Promise batchPutMessageAsync( array $args = [] )
 * @method Result batchUpdateDetector( array $args = [] )
 * @method Promise batchUpdateDetectorAsync( array $args = [] )
 * @method Result describeDetector( array $args = [] )
 * @method Promise describeDetectorAsync( array $args = [] )
 * @method Result listDetectors( array $args = [] )
 * @method Promise listDetectorsAsync( array $args = [] )
 */
class IoTEventsDataClient extends AwsClient {
}
