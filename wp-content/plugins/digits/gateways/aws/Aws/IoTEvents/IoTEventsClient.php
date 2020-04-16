<?php

namespace Aws\IoTEvents;

use Aws\AwsClient;
use Aws\Result;
use GuzzleHttp\Promise\Promise;

/**
 * This client is used to interact with the **AWS IoT Events** service.
 * @method Result createDetectorModel( array $args = [] )
 * @method Promise createDetectorModelAsync( array $args = [] )
 * @method Result createInput( array $args = [] )
 * @method Promise createInputAsync( array $args = [] )
 * @method Result deleteDetectorModel( array $args = [] )
 * @method Promise deleteDetectorModelAsync( array $args = [] )
 * @method Result deleteInput( array $args = [] )
 * @method Promise deleteInputAsync( array $args = [] )
 * @method Result describeDetectorModel( array $args = [] )
 * @method Promise describeDetectorModelAsync( array $args = [] )
 * @method Result describeInput( array $args = [] )
 * @method Promise describeInputAsync( array $args = [] )
 * @method Result describeLoggingOptions( array $args = [] )
 * @method Promise describeLoggingOptionsAsync( array $args = [] )
 * @method Result listDetectorModelVersions( array $args = [] )
 * @method Promise listDetectorModelVersionsAsync( array $args = [] )
 * @method Result listDetectorModels( array $args = [] )
 * @method Promise listDetectorModelsAsync( array $args = [] )
 * @method Result listInputs( array $args = [] )
 * @method Promise listInputsAsync( array $args = [] )
 * @method Result listTagsForResource( array $args = [] )
 * @method Promise listTagsForResourceAsync( array $args = [] )
 * @method Result putLoggingOptions( array $args = [] )
 * @method Promise putLoggingOptionsAsync( array $args = [] )
 * @method Result tagResource( array $args = [] )
 * @method Promise tagResourceAsync( array $args = [] )
 * @method Result untagResource( array $args = [] )
 * @method Promise untagResourceAsync( array $args = [] )
 * @method Result updateDetectorModel( array $args = [] )
 * @method Promise updateDetectorModelAsync( array $args = [] )
 * @method Result updateInput( array $args = [] )
 * @method Promise updateInputAsync( array $args = [] )
 */
class IoTEventsClient extends AwsClient {
}
